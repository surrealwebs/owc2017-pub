<?php

/**
 * @class UABBPhotoModule
 */
class UABBPhotoModule extends FLBuilderModule {

	/**
	 * @property $data
	 */
	public $data = null;

	/**
	 * @property $_editor
	 * @protected
	 */
	protected $_editor = null;

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Photo', 'uabb'),
			'description'   	=> __('Upload a photo or display one from the media library.', 'uabb'),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/uabb-photo/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/uabb-photo/',
			'partial_refresh'	=> true,
			'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
			'icon'				=> 'format-image.svg',
		));
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts()
	{
		if($this->settings && $this->settings->link_type == 'lightbox') {
			$this->add_js('jquery-magnificpopup');
			$this->add_css('jquery-magnificpopup');
		}
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Make sure we have a photo_src property.
		if(!isset($settings->photo_src)) {
			$settings->photo_src = '';
		}

		// Cache the attachment data.
		$data = FLBuilderPhoto::get_attachment_data($settings->photo);

		if($data) {
			$settings->data = $data;
		}

		// Save a crop if necessary.
		$this->crop();

		return $settings;
	}

	/**
	 * @method delete
	 */
	public function delete()
	{
		$cropped_path = $this->_get_cropped_path();

		if(file_exists($cropped_path['path'])) {
			unlink($cropped_path['path']);
		}
	}

	/**
	 * @method crop
	 */
	public function crop()
	{
		// Delete an existing crop if it exists.
		$this->delete();

		// Do a crop.
		if(!empty($this->settings->style) && $this->settings->style != "simple" && $this->settings->style != "custom" ) {

			$editor = $this->_get_editor();

			if(!$editor || is_wp_error($editor)) {
				return false;
			}

			$cropped_path = $this->_get_cropped_path();
			$size         = $editor->get_size();
			$new_width    = $size['width'];
			$new_height   = $size['height'];

			// Get the crop ratios.
			if($this->settings->style == 'landscape') {
				$ratio_1 = 1.43;
				$ratio_2 = .7;
			}
			elseif($this->settings->style == 'panorama') {
				$ratio_1 = 2;
				$ratio_2 = .5;
			}
			elseif($this->settings->style == 'portrait') {
				$ratio_1 = .7;
				$ratio_2 = 1.43;
			}
			elseif($this->settings->style == 'square') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}
			elseif($this->settings->style == 'circle') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}

			// Get the new width or height.
			if($size['width'] / $size['height'] < $ratio_1) {
				$new_height = $size['width'] * $ratio_2;
			}
			else {
				$new_width = $size['height'] * $ratio_1;
			}

			// Make sure we have enough memory to crop.
			@ini_set('memory_limit', '300M');

			// Crop the photo.
			$editor->resize($new_width, $new_height, true);

			// Save the photo.
			$editor->save($cropped_path['path']);

			// Return the new url.
			return $cropped_path['url'];
		}

		return false;
	}

	/**
	 * @method get_data
	 */
	public function get_data()
	{
		if(!$this->data) {

			// Photo source is set to "url".
			if($this->settings->photo_source == 'url') {
				$this->data = new stdClass();
				$this->data->alt = $this->settings->caption;
				$this->data->caption = $this->settings->caption;
				$this->data->link = $this->settings->photo_url;
				$this->data->url = $this->settings->photo_url;
				$this->settings->photo_src = $this->settings->photo_url;
			}

			// Photo source is set to "library".
			else if(is_object($this->settings->photo)) {
				$this->data = $this->settings->photo;
			}
			else {
				$this->data = FLBuilderPhoto::get_attachment_data($this->settings->photo);
			}

			// Data object is empty, use the settings cache.
			if(!$this->data && isset($this->settings->data)) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * @method get_classes
	 */
	public function get_classes()
	{
		$classes = array( 'uabb-photo-img' );
		
		if ( ! empty( $this->settings->photo ) ) {
			
			$data = self::get_data();
			
			if ( is_object( $data ) ) {
				
				$classes[] = 'wp-image-' . $data->id;

				if ( isset( $data->sizes ) ) {

					foreach ( $data->sizes as $key => $size ) {
						
						if ( $size->url == $this->settings->photo_src ) {
							$classes[] = 'size-' . $key;
							break;
						}
					}
				}
			}
		}
		
		return implode( ' ', $classes );
	}

	/**
	 * @method get_src
	 */
	public function get_src()
	{
		$src = $this->_get_uncropped_url();

		// Return a cropped photo.
		if($this->_has_source() && !empty($this->settings->style)) {

			$cropped_path = $this->_get_cropped_path();

			// See if the cropped photo already exists.
			if(file_exists($cropped_path['path'])) {
				$src = $cropped_path['url'];
			}
			// It doesn't, check if this is a demo image.
			elseif(stristr($src, FL_BUILDER_DEMO_URL) && !stristr(FL_BUILDER_DEMO_URL, $_SERVER['HTTP_HOST'])) {
				$src = $this->_get_cropped_demo_url();
			}
			// It doesn't, check if this is a OLD demo image.
			elseif(stristr($src, FL_BUILDER_OLD_DEMO_URL)) {
				$src = $this->_get_cropped_demo_url();
			}
			// A cropped photo doesn't exist, try to create one.
			else {

				$url = $this->crop();

				if($url) {
					$src = $url;
				}
			}
		}

		return $src;
	}

	/**
	 * @method get_link
	 */
	public function get_link()
	{
		$photo = $this->get_data();

		if($this->settings->link_type == 'url') {
			$link = $this->settings->link_url;
		}
		else if($this->settings->link_type == 'lightbox') {
			$link = $photo->url;
		}
		else if($this->settings->link_type == 'file') {
			$link = $photo->url;
		}
		else if($this->settings->link_type == 'page') {
			$link = $photo->link;
		}
		else {
			$link = '';
		}

		return $link;
	}

	/**
	 * @method get_alt
	 */
	public function get_alt()
	{
		$photo = $this->get_data();

		if(!empty($photo->alt)) {
			return htmlspecialchars($photo->alt);
		}
		else if(!empty($photo->description)) {
			return htmlspecialchars($photo->description);
		}
		else if(!empty($photo->caption)) {
			return htmlspecialchars($photo->caption);
		}
		else if(!empty($photo->title)) {
			return htmlspecialchars($photo->title);
		}
	}

	/**
	 * @method get_attributes
	 */
	public function get_attributes()
	{
		$attrs = '';
		
		if ( isset( $this->settings->attributes ) ) {
			foreach ( $this->settings->attributes as $key => $val ) {
				$attrs .= $key . '="' . $val . '" ';
			}
		}
		
		return $attrs;
	}

	/**
	 * @method _has_source
	 * @protected
	 */
	protected function _has_source()
	{
		if($this->settings->photo_source == 'url' && !empty($this->settings->photo_url)) {
			return true;
		}
		else if($this->settings->photo_source == 'library' && !empty($this->settings->photo_src)) {
			return true;
		}

		return false;
	}

	/**
	 * @method _get_editor
	 * @protected
	 */
	protected function _get_editor()
	{
		if($this->_has_source() && $this->_editor === null) {

			$url_path  = $this->_get_uncropped_url();
			$file_path = str_ireplace(home_url(), ABSPATH, $url_path);

			if(file_exists($file_path)) {
				$this->_editor = wp_get_image_editor($file_path);
			}
			else {
				$this->_editor = wp_get_image_editor($url_path);
			}
		}

		return $this->_editor;
	}

	/**
	 * @method _get_cropped_path
	 * @protected
	 */
	protected function _get_cropped_path()
	{
		$crop        = empty($this->settings->style) ? 'none' : $this->settings->style;
		$url         = $this->_get_uncropped_url();
		$cache_dir   = FLBuilderModel::get_cache_dir();

		if(empty($url)) {
			$filename    = uniqid(); // Return a file that doesn't exist.
		}
		else {
			
			if ( stristr( $url, '?' ) ) {
				$parts = explode( '?', $url );
				$url   = $parts[0];
			}
			
			$pathinfo    = pathinfo($url);
			$dir         = $pathinfo['dirname'];
			$ext         = isset( $pathinfo['extension'] ) ? $pathinfo['extension'] :'';
			$name        = wp_basename($url, ".$ext");
			$new_ext     = strtolower($ext);
			$filename    = "{$name}-{$crop}.{$new_ext}";
		}

		return array(
			'filename' => $filename,
			'path'     => $cache_dir['path'] . $filename,
			'url'      => $cache_dir['url'] . $filename
		);
	}

	/**
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_uncropped_url()
	{
		if($this->settings->photo_source == 'url') {
			$url = $this->settings->photo_url;
		}
		else if(!empty($this->settings->photo_src)) {
			$url = $this->settings->photo_src;
		}
		else {
			$url = FL_BUILDER_URL . 'img/pixel.png';
		}

		return $url;
	}

	/**
	 * @method _get_cropped_demo_url
	 * @protected
	 */
	protected function _get_cropped_demo_url()
	{
		$info = $this->_get_cropped_path();

		return FL_BUILDER_DEMO_CACHE_URL . $info['filename'];
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBPhotoModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'photo_source'  => array(
						'type'          => 'select',
						'label'         => __('Photo Source', 'uabb'),
						'default'       => 'library',
						'options'       => array(
							'library'       => __('Media Library', 'uabb'),
							'url'           => __('URL', 'uabb')
						),
						'toggle'        => array(
							'library'       => array(
								'fields'        => array('photo')
							),
							'url'           => array(
								'fields'        => array('photo_url', 'caption')
							)
						)
					),
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'uabb'),
						'show_remove'	=> true,
						'connections'	=> array( 'photo' ),
					),
					'photo_size'         => array(
						'type'          => 'text',
						'label'         => __('Photo Size', 'uabb'),
						'description'	=> 'px',
						'size'			=> '8',
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-photo-content img',
                            'property'      => 'width',
                            'unit'			=> 'px',
                        )
					),
					'photo_url'     => array(
						'type'          => 'text',
						'label'         => __('Photo URL', 'uabb'),
						'placeholder'   => 'http://www.example.com/my-photo.jpg',
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'center',
						'options'       => array(
							'left'          => __('Left', 'uabb'),
							'center'        => __('Center', 'uabb'),
							'right'         => __('Right', 'uabb')
						),
						'preview'  => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-photo',
                            'property'  => 'text-align',
                        )
					),
					'responsive_align'         => array(
						'type'          => 'select',
						'label'         => __('Mobile Alignment', 'uabb'),	
						'default'       => 'center',
						'help'          => __('This alignment will apply on Mobile', 'uabb'),
						'options'       => array(
							'left'          => __('Left', 'uabb'),
							'center'        => __('Center', 'uabb'),
							'right'         => __('Right', 'uabb')
						)
					)
				)
			),
			'caption'       => array(
				'title'         => __('Caption', 'uabb'),
				'fields'        => array(
					'show_caption'  => array(
						'type'          => 'select',
						'label'         => __('Show Caption', 'uabb'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('Never', 'uabb'),
							'hover'         => __('On Hover', 'uabb'),
							'below'         => __('Below Photo', 'uabb')
						)
					),
					'caption'       => array(
						'type'          => 'text',
						'label'         => __('Caption', 'uabb'),
						'preview'         => array(
                            'type'          => 'text',
                            'selector'      => '.uabb-photo-caption',
                        )
					)
				)
			),
			'link'          => array(
				'title'         => __('Link', 'uabb'),
				'fields'        => array(
					'link_type'     => array(
						'type'          => 'select',
						'label'         => __('Link Type', 'uabb'),
						'options'       => array(
							''              => _x( 'None', 'Link type.', 'uabb' ),
							'url'           => __('URL', 'uabb'),
							'lightbox'      => __('Lightbox', 'uabb'),
							'file'          => __('Photo File', 'uabb'),
							'page'          => __('Photo Page', 'uabb')
						),
						'toggle'        => array(
							''              => array(),
							'url'           => array(
								'fields'        => array('link_url', 'link_target')
							),
							'file'          => array(),
							'page'          => array()
						),
						'help'          => __('Link type applies to how the image should be linked on click. You can choose a specific URL, the individual photo or a separate page with the photo.', 'uabb'),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'link_url'     => array(
						'type'          => 'link',
						'label'         => __('Link URL', 'uabb'),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'uabb'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'uabb'),
							'_blank'        => __('New Window', 'uabb')
						),
						'preview'         => array(
							'type'            => 'none'
						)
					)
				)
			)
		)
	),
	'style'       => array( // Tab
		'title'         => __('Style', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'style'         => array(
                        'type'          => 'select',
                        'label'         => __('Photo Style', 'uabb'),
                        'default'       => 'simple',
                        'options'       => array(
                            'simple'        => __('Simple', 'uabb'),
							'circle'          => __('Circle Background', 'uabb'),
                            'square'         => __('Square Background', 'uabb'),
                            'landscape'     => __('Landscape', 'uabb'),
							'panorama'      => __('Panorama', 'uabb'),
							'portrait'      => __('Portrait', 'uabb'),
							'custom'         => __('Custom', 'uabb'),
                        ),
                        'toggle' => array(
                            'simple' => array(
                                'fields' => array()
                            ),
                            'circle' => array(
                                'fields' => array( 'style_bg_color', 'style_bg_color_opc', 'bg_size' )
                            ),
                            'square' => array(
                                'fields' => array( 'style_bg_color', 'style_bg_color_opc', 'bg_size' )
                            ),
                            'landscape' => array(
                                'fields' => array( 'style_bg_color', 'style_bg_color_opc', 'bg_size' )
                            ),
                            'panorama' => array(
                                'fields' => array( 'style_bg_color', 'style_bg_color_opc', 'bg_size' )
                            ),
                            'portrait' => array(
                                'fields' => array( 'style_bg_color', 'style_bg_color_opc', 'bg_size' )
                            ),
                            'custom' => array(
                                'fields' => array( 'style_bg_color', 'style_bg_color_opc', 'bg_size', 'bg_border_radius' )
                            )
                        )
                    ),

					'bg_size'          => array(
                        'type'          => 'text',
                        'label'         => __('Background Size', 'uabb'),
                        'default'       => '',
                        'help'          => __('Space between icon and background','uabb'),
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'  => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-photo .uabb-photo-content',
                            'property'  => 'padding',
                            'unit'		=> 'px'
                        )
                    ),

                    'style_bg_color'    => array( 
						'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'  => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-photo .uabb-photo-content',
                            'property'  => 'background-color',
                        )
					),
                    'style_bg_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                    'bg_border_radius'          => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius ( For Background )', 'uabb'),
                        'default'       => '',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
                    ),
                    'hover_effect'         => array(
                        'type'          => 'select',
                        'label'         => __('Image Effect', 'uabb'),
                        'default'       => 'style1',
                        'options'       => array(
                            'style1'		=> __('Opacity', 'uabb'),
                            'style2'		=> __('Grayscale', 'uabb'),
                            /*'style3'		=> __('Blur', 'uabb'),
                            'style4'		=> __('Sepia', 'uabb'),
                            'style5'		=> __('Saturate', 'uabb'),*/
                            'style6'		=> __('Hue Rotate', 'uabb'),
                            /*'style7'		=> __('Invert', 'uabb'),
                            'style8'		=> __('Brightness', 'uabb'),
                            'style9'		=> __('Contrast', 'uabb'),*/
                            'simple'		=> __('Simple', 'uabb'),
                        ),
                        'toggle' => array(
                            'style1' => array(
                                'fields' => array( 'opacity', 'hover_opacity' )
                            ),
                            'style2' => array(
                                'fields' => array( 'img_grayscale_grayscale' )
                            ),
                            'simple' => array(
                            	'fields' => array( 'img_grayscale_simple' )
                            )
                        )
                    ),
					'opacity' => array(
						'type'          => 'text',
						'label'         => __('Image Opacity', 'uabb'),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '100'
					),
					'hover_opacity' => array(
						'type'          => 'text',
						'label'         => __('Image Hover Opacity', 'uabb'),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '100'
					),
					'img_grayscale_simple' => array(
						'type'          => 'select',
		                'label'         => __( 'Image Hover Effect', 'uabb' ),
		                'default'       => 'no',
		                'options'       => array(
		                 	'yes'			=> 'Simple',
							'color_gray'	=> 'Grayscale on Hover',
		                ),
					),
					'img_grayscale_grayscale' => array(
						'type'          => 'select',
		                'label'         => __( 'Image Hover Effect', 'uabb' ),
		                'default'       => 'no',
		                'options'       => array(
		                 	'yes'			=> 'Simple',
							'gray_color'	=> 'Color on Hover',
		                ),
					),
				)
			)
		)
	)
));
