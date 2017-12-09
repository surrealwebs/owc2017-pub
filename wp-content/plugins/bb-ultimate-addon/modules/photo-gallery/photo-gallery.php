<?php

/**
 * @class UABBPhotoGalleryModule
 */
class UABBPhotoGalleryModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Photo Gallery', 'uabb'),
			'description'   	=> __('Display multiple photos in a gallery view.', 'uabb'),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/photo-gallery/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/photo-gallery/',
			'editor_export'  	=> false,
			'partial_refresh'	=> true,
			'icon'				=> 'format-gallery.svg',
		));

		$this->add_js('jquery-magnificpopup-uabb', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery.magnificpopup.min.js', array('jquery'), '', true);
		$this->add_css('jquery-magnificpopup-uabb', BB_ULTIMATE_ADDON_URL . 'assets/css/global-styles/jquery.magnificpopup.css', array(), '');
		//$this->add_js('jquery-magnificpopup');
		//$this->add_css('jquery-magnificpopup');
		$this->add_js('jquery-masonry');
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Cache the photo data if using the WordPress media library.
		$settings->photo_data = $this->get_wordpress_photos();

		return $settings;
	}

	/**
	 * @method get_photos
	 */
	public function get_photos()
	{
		$default_order 	= $this->get_wordpress_photos();
		$photos_id 		= array();
		// WordPress

		if ( $this->settings->photo_order == 'random' && is_array( $default_order )) {

			$keys = array_keys( $default_order ); 
			shuffle($keys); 
			
			foreach ($keys as $key) { 
				$photos_id[$key] = $default_order[$key]; 
			}

		}else{
			$photos_id = $default_order;
		} 

		return $photos_id;

	}

	/**
	 * @method get_wordpress_photos
	 */
	public function get_wordpress_photos()
	{
		$photos     = array();
		$ids        = $this->settings->photos;
		$medium_w   = get_option('medium_size_w');
		$large_w    = get_option('large_size_w');
		
		/* Template Cache */ 
		$photo_from_template = false;
		$photo_attachment_data = false;

		if(empty($this->settings->photos)) {
			return $photos;
		}

		/* Check if all photos are available on host */
		foreach ($ids as $id) {
			$photo_attachment_data[$id] = FLBuilderPhoto::get_attachment_data($id);

			if ( ! $photo_attachment_data[$id] ) {
				$photo_from_template = true;
			}

		}

		foreach($ids as $id) {

			$photo = $photo_attachment_data[$id];

			// Use the cache if we didn't get a photo from the id.
			if ( ! $photo && $photo_from_template ) {
				
				if ( ! isset( $this->settings->photo_data ) ) {
					continue;
				}
				else if ( is_array( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data[ $id ];
				}
				else if ( is_object( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data->{$id};
				}
				else {
					continue;
				}
			}
			

			// Only use photos who have the sizes object.
			if(isset($photo->sizes)) {

				$data = new stdClass();
				
				// Photo data object
				$data->id = $id;
				$data->alt = $photo->alt;
				$data->caption = $photo->caption;
				$data->description = $photo->description;
				$data->title = $photo->title;

				$photo_size = $this->settings->photo_size;

				$photo->sizes = (array)( $photo->sizes );

				if( isset($photo->sizes[$photo_size]) ) {
					$data->src = $photo->sizes[$photo_size]->url;
				} else {
					$data->src = $photo->sizes['full']->url;
				}

				// Photo Link
				if(isset($photo->sizes['full'])) {
					$data->link = $photo->sizes['full']->url;
				}
				else {
					$data->link = $photo->sizes['large']->url;
				}
				
				// Push the photo data
				
				/* Add Custom field attachment data to object */
	 			$cta_link = get_post_meta( $id, 'uabb-cta-link', true );
	 			$data->cta_link = $cta_link;
				
				$photos[$id] = $data;
			}

		}

		return $photos;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBPhotoGalleryModule', array(
	'general'       => array(
		'title'         => __('General', 'uabb'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'uabb'),
						'default'       => 'collage',
						'options'       => array(
							'grid'     => __('Grid', 'uabb'),
							'masonary' => __( 'Masonry', 'uabb' )
						),
						'toggle'        => array(
							'grid'			=> array(
								'fields'	  => array()
							),
							'masonary'       => array(
								'fields'       => array()
							)
						)
					),
					'photos'        => array(
						'type'          => 'multiple-photos',
						'label'         => __('Photos', 'uabb'),
						'connections'	=> array( 'multiple-photos' )
					),
					'photo_size'    => array(
						'type'          => 'select',
						'label'         => __('Photo Size', 'uabb'),
						'default'       => 'medium',
						'options'       => apply_filters('uabb_photo_gallery_image_sizes', array(
                                'thumbnail'  => __( 'Thumbnail', 'uabb' ),
								'medium'     => __( 'Medium', 'uabb' ),
								'full'       => __( 'Full', 'uabb')
                            )
						)
					),
					'photo_spacing' => array(
						'type'          => 'text',
						'label'         => __('Photo Spacing', 'uabb'),
                        'mode'			=> 'padding',
						'placeholder'   => '20',
						'size'   		=> '5',
						'description'   => 'px',
					),
					'photo_order'        => array(
						'type'          => 'select',
						'label'         => __('Display Order', 'uabb'),
						'default'       => 'normal',
						'options'       => array(
							'normal'     			=> __( 'Normal', 'uabb'),
							'random' 		=> __( 'Random', 'uabb' )
						),
						'toggle'        => array(
							'grid'			=> array(
								'fields'	  => array()
							),
							'masonary'       => array(
								'fields'       => array()
							)
						)
					),
				)
			),
			'column_settings' => array(
				'title' => __('Number of Photos to Show', 'uabb'),
				'fields' => array(
					'grid_column' => array(
						'type'          => 'select',
						'label'         => __('Desktop Grid', 'uabb'),
						'default'       => '4',
						'help'			=> __( 'This is how many images you want to show at one time on desktop.', 'uabb' ),
						'options'       => array(
							'1'		=> __('1 Column','uabb'),
							'2'		=> __('2 Columns','uabb'),
							'3'		=> __('3 Columns','uabb'),
							'4'     => __('4 Columns','uabb'),
							'5'     => __('5 Columns','uabb'),
							'6'     => __('6 Columns','uabb'),
							'7'     => __('7 Columns','uabb'),
							'8'     => __('8 Columns','uabb'),
							'9'     => __('9 Columns','uabb'),
							'10'    => __('10 Columns','uabb'),
						),
					),
					'medium_grid_column' => array(
						'type'          => 'select',
						'label'         => __('Medium Device Grid', 'uabb'),
						'default'       => '4',
						'options'       => array(
							'1'		=> __('1 Column','uabb'),
							'2'		=> __('2 Columns','uabb'),
							'3'		=> __('3 Columns','uabb'),
							'4'     => __('4 Columns','uabb'),
							'5'     => __('5 Columns','uabb'),
							'6'     => __('6 Columns','uabb'),
							'7'     => __('7 Columns','uabb'),
							'8'     => __('8 Columns','uabb'),
							'9'     => __('9 Columns','uabb'),
							'10'    => __('10 Columns','uabb'),
						),
						'help'   		=> __('This is how many images you want to show at one time on tablet devices.','uabb')
					),
					'responsive_grid_column' => array(
						'type'          => 'select',
						'label'         => __('Small Device Grid', 'uabb'),
						'default'       => '4',
						'options'       => array(
							'1'		=> __('1 Column','uabb'),
							'2'		=> __('2 Columns','uabb'),
							'3'		=> __('3 Columns','uabb'),
							'4'     => __('4 Columns','uabb'),
							'5'     => __('5 Columns','uabb'),
							'6'     => __('6 Columns','uabb'),
							'7'     => __('7 Columns','uabb'),
							'8'     => __('8 Columns','uabb'),
							'9'     => __('9 Columns','uabb'),
							'10'    => __('10 Columns','uabb'),
						),
						'help'   		=> __('This is how many images you want to show at one time on mobile devices.','uabb')
					),
					
				)
			),
			'photo_settings' => array(
				'title' => __('Photo Settings', 'uabb'),
				'fields' => array(
					'show_captions' => array(
						'type'          => 'select',
						'label'         => __('Show Captions', 'uabb'),
						'default'       => 'hover',
						'options'       => array(
							'0'             => __('Never', 'uabb'),
							'hover'         => __('On Hover', 'uabb'),
							'below'         => __('Below Photo', 'uabb')
						),
						'help'          => __('The caption pulls from whatever text you put in the caption area in the media manager for each image.', 'uabb'),
						'toggle'		=> array(
							'hover'	=> array(
								'tabs'		=> array( 'typography' ),
							),
							'below'	=> array(
								'tabs'		=> array( 'typography' ),
								'fields'	=> array( 'caption_bg_color', 'caption_bg_color_opc' ),
							),
						)
					),
					'click_action'  => array(
						'type'          => 'select',
						'label'         => __('Click Action', 'uabb'),
						'default'       => 'lightbox',
						'options'       => array(
							'none'          => _x( 'None', 'Click action.', 'uabb' ),
							'lightbox'      => __('Lightbox', 'uabb'),
							'link'          => __('Photo Link', 'uabb'),
							'cta-link'      => __('Custom Link', 'uabb'),
						),
						'toggle' => array(
							'link' => array(
								'fields' => array( 'click_action_target' )
							),
							'cta-link' => array(
								'fields' => array( 'click_action_target' )
							),
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'click_action_target'   => array(
                        'type'          => 'select',
                        'label'         => __('Link Target', 'uabb'),
                        'help'          => __( 'Controls where CTA link will open after click.', 'uabb' ),
                        'default'       => '_blank',
                        'options'       => array(
                            '_self'         => __('Same Window', 'uabb'),
                            '_blank'        => __('New Window', 'uabb')
                        ),
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    )
				)
			)
		)
	),
	'style'       => array(
		'title'         => __('Style', 'uabb'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'hover_effects' => array(
						'type'          => 'select',
						'label'         => __('Image Hover Effect', 'uabb'),
						'default'       => 'zoom-in',
						'options'       => array(
							'none' 			=> __('None', 'uabb'),
							'from-left'		=> __('Overlay From Left', 'uabb'),
							'from-right'	=> __('Overlay From Right', 'uabb'),
							'from-top'		=> __('Overlay From Top', 'uabb'),
							'from-bottom'	=> __('Overlay From Bottom', 'uabb'),
							'zoom-in'		=> __('Zoom In', 'uabb'),
							'zoom-out'		=> __('Zoom Out', 'uabb'),
						),
						'toggle'		=> array(
							'from-left'	=> array(
								'sections' => array( 'overlay' ),
							),
							'from-right'	=> array(
								'sections' => array( 'overlay' ),
							),
							'from-top'	=> array(
								'sections' => array( 'overlay' ),
							),
							'from-bottom'	=> array(
								'sections' => array( 'overlay' ),
							),
							'zoom-in'	=> array(
								'sections' => array( 'overlay' ),
							),
							'zoom-out'	=> array(
								'sections' => array( 'overlay' ),
							),
						),
						'preview'	=> 'none',
					),
				)
			),
			'overlay'       => array(
				'title'         => __( 'Overlay', 'uabb' ),
				'fields'        => array(
					'overlay_color' => array( 
						'type'       => 'color',
						'label'     => __('Overlay Color', 'uabb'),
						'default'	=> '000000',
						'show_reset' => true,
						'preview'	=> 'none',
					),
					'overlay_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '70',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
					'icon' => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Overlay Icon', 'uabb'),
						'default'       => '0',
						'options'       => array(
							'1'				=> __('Enable', 'uabb'),
							'0' 			=> __('Disable', 'uabb'),
						),
						'toggle'		=> array(
							'1'	=> array(
								'fields' => array( 'overlay_icon', 'overlay_icon_size', 'overlay_icon_color' ),
							),
						),
						'preview'	=> 'none',
					),
					'overlay_icon'          => array(
						'type'          => 'icon',
						'label'         => __('Overlay Icon', 'uabb'),
						'preview'	=> 'none',
						'show_remove' => true
					),
					'overlay_icon_size'     => array(
						'type'          => 'text',
						'label'         => __('Overlay Icon Size', 'uabb'),
						'placeholder'   => '16',
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'preview'	=> 'none',
					),
					'overlay_icon_color' => array( 
						'type'       => 'color',
						'label'     => __('Overlay Icon Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'	=> 'none',
					),
				)
			)
		)
	),
	'typography'        => array(
		'title'         => __( 'Typography', 'uabb' ),
		'sections'      => array(
			'typography' => array(
                'title' => __('Caption', 'uabb' ),
                'fields'    => array(
                    'tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h3',
                        'options'       => array(
                            'h1'      => __('H1', 'uabb'),
                            'h2'      => __('H2', 'uabb'),
                            'h3'      => __('H3', 'uabb'),
                            'h4'      => __('H4', 'uabb'),
                            'h5'      => __('H5', 'uabb'),
                            'h6'      => __('H6', 'uabb'),
                            'div'     => __('Div', 'uabb'),
                            'p'       => __('p', 'uabb'),
                            'span'    => __('span', 'uabb'),
                        )
                    ),
                    'font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-photo-gallery-caption'
                        )
                    ),
                    'font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-photo-gallery-caption',
                            'property'		=> 'font-size',
                            'unit'			=> 'px',
                        )
                    ),
                    'line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-photo-gallery-caption',
                            'property'		=> 'line-height',
                            'unit'			=> 'px',
                        )
                    ),
                    'color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-photo-gallery-caption',
                            'property'		=> 'color',
                        )
                    ),
                    'caption_bg_color' => array( 
						'type'       => 'color',
						'label'     => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-photo-gallery-caption',
                            'property'		=> 'background',
                        )
					),
					'caption_bg_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                )
            ),
		)
	)
));
