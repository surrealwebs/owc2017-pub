<?php

/**
 * @class UABBInfoBoxModule
 */
class UABBInfoBoxModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Info Box', 'uabb'),
			'description'   	=> __('A heading and snippet of text with an optional link, icon and image.', 'uabb'),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/info-box/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/info-box/',
            'partial_refresh'	=> true
		));

	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = '';
		if( $this->settings->image_type == 'photo' ) {
			if ( $this->settings->img_icon_position == 'above-title' || $this->settings->img_icon_position == 'below-title' ) {
				$classname = 'uabb-infobox infobox-' . $this->settings->align;
				if( $this->settings->mobile_align != '' ) {
					$classname .= ' infobox-responsive-'. $this->settings->mobile_align;
				}
			}

			if ( $this->settings->img_icon_position == 'left-title' || $this->settings->img_icon_position == 'left' ) {
				$classname = 'uabb-infobox infobox-left';
			}
			if ( $this->settings->img_icon_position == 'right-title' || $this->settings->img_icon_position == 'right' ) {
				$classname = 'uabb-infobox infobox-right';
			}
			$classname .= ' infobox-has-photo infobox-photo-' . $this->settings->img_icon_position;
		} else if( $this->settings->image_type == 'icon' ) {
			if ( $this->settings->img_icon_position == 'above-title' || $this->settings->img_icon_position == 'below-title' ) {
				$classname = 'uabb-infobox infobox-' . $this->settings->align;
				if( $this->settings->mobile_align != '' ) {
					$classname .= ' infobox-responsive-'. $this->settings->mobile_align;
				}
			}

			if ( $this->settings->img_icon_position == 'left-title' || $this->settings->img_icon_position == 'left' ) {
				$classname = 'uabb-infobox infobox-left';
			}
			if ( $this->settings->img_icon_position == 'right-title' || $this->settings->img_icon_position == 'right' ) {
				$classname = 'uabb-infobox infobox-right';
			}
			$classname .= ' infobox-has-icon infobox-icon-' . $this->settings->img_icon_position;
		} else {
			$classname = 'uabb-infobox infobox-' . $this->settings->align;
			if( $this->settings->mobile_align != '' ) {
				$classname .= ' infobox-responsive-'. $this->settings->mobile_align;
			}
		}


		return $classname;
	}

	/**
	 * @method render_title
	 */
	public function render_title()
	{
		$flag = false;
		if ( ($this->settings->image_type == 'photo' && $this->settings->img_icon_position == 'left-title') || ( $this->settings->image_type == 'icon' && $this->settings->img_icon_position == 'left-title' ) ) {
			echo '<div class="left-title-image">';
			$flag = true;
		}
		if ( ($this->settings->image_type == 'photo' && $this->settings->img_icon_position == 'right-title') || ( $this->settings->image_type == 'icon' && $this->settings->img_icon_position == 'right-title' ) ) {
			echo '<div class="right-title-image">';
			$flag = true;
		}
		$this->render_image('left-title');echo "<div class='uabb-infobox-title-wrap'>";
		if ( $this->settings->heading_prefix != "" ) {
			echo '<' . $this->settings->prefix_tag_selection . ' class="uabb-infobox-title-prefix">'. $this->settings->heading_prefix.'</' . $this->settings->prefix_tag_selection . '>';
		}

		echo '<' . $this->settings->title_tag_selection . ' class="uabb-infobox-title">';
		//echo '<span>';
		echo $this->settings->title;
		//echo '</span>';
		echo '</' . $this->settings->title_tag_selection . '>';
		echo '</div>';$this->render_image('right-title');

		if ($flag) {
			echo '</div>';
		}
	}

	/**
	 * @method render_text
	 */
	public function render_text()
	{
		global $wp_embed;

		echo '<div class="uabb-infobox-text uabb-text-editor">' . wpautop( $wp_embed->autoembed( $this->settings->text ) ) . '</div>';
	}

	/**
	 * @method render_link
	 */
	public function render_link()
	{
		if($this->settings->cta_type == 'link') {
			$nofollow = ( isset( $this->settings->link_nofollow ) ) ? $this->settings->link_nofollow : '0';
			echo '<a href="' . $this->settings->link . '" target="' . $this->settings->link_target . '" '. BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->link_target, $nofollow, 0 ) .' class="uabb-infobox-cta-link">' . $this->settings->cta_text . '</a>';
		}
	}

	/**
	 * @method render_button
	 */
	public function render_button()
	{

		if($this->settings->cta_type == 'button') {
			$btn_settings = array(

				/* General Section */
                'text'              => $this->settings->btn_text,

                /* Link Section */
                'link'              => $this->settings->btn_link,
                'link_target'       => $this->settings->btn_link_target,
                'link_nofollow'     => $this->settings->btn_link_nofollow,

                /* Style Section */
                'style'             => $this->settings->btn_style,
                'border_size'       => $this->settings->btn_border_size,
                'transparent_button_options' => $this->settings->btn_transparent_button_options,
                'threed_button_options'      => $this->settings->btn_threed_button_options,
                'flat_button_options'        => $this->settings->btn_flat_button_options,

                /* Colors */
                'bg_color'          => $this->settings->btn_bg_color,
                'bg_hover_color'    => $this->settings->btn_bg_hover_color,
                'text_color'        => $this->settings->btn_text_color,
                'text_hover_color'  => $this->settings->btn_text_hover_color,
                'hover_attribute'	=> $this->settings->hover_attribute,

                /* Icon */
                'icon'              => $this->settings->btn_icon,
                'icon_position'     => $this->settings->btn_icon_position,

                /* Structure */
                'width'              => $this->settings->btn_width,
                'custom_width'       => $this->settings->btn_custom_width,
                'custom_height'      => $this->settings->btn_custom_height,
                'padding_top_bottom' => $this->settings->btn_padding_top_bottom,
                'padding_left_right' => $this->settings->btn_padding_left_right,
                'border_radius'      => $this->settings->btn_border_radius,
                'custom_class'       => $this->settings->custom_class,
                'align'              => '',
                'mob_align'          => '',

                /* Typography */
                'font_size'         => $this->settings->btn_font_size,
                'line_height'       => $this->settings->btn_line_height,
                'font_family'       => $this->settings->btn_font_family,
			);

			echo '<div class="uabb-infobox-button">';
			FLBuilder::render_module_html('uabb-button', $btn_settings);
			echo '</div>';
		}
	}

	/**
	 * @method render_image
	 */
	public function render_image($position)
	{
		$set_pos = '';
		if( $this->settings->image_type == 'icon' ){
			$set_pos 		= $this->settings->img_icon_position;
		}elseif( $this->settings->image_type == 'photo' ){
			$set_pos 		= $this->settings->img_icon_position;
		}

		/* Render Image / icon */
		if( $position == $set_pos ){
			$imageicon_array = array(

			    /* General Section */
			    'image_type' => $this->settings->image_type,

			    /* Icon Basics */
			    'icon' => $this->settings->icon,
			    'icon_size' => $this->settings->icon_size,
			    'icon_align' => '',

			    /* Image Basics */
			    'photo_source' => $this->settings->photo_source,
			    'photo' => $this->settings->photo,
			    'photo_url' => $this->settings->photo_url,
			    'img_size' => $this->settings->img_size,
			    'img_align' => '',
			    'photo_src' => ( isset( $this->settings->photo_src ) ) ? $this->settings->photo_src : '' ,

			 	/* Icon Style */
			    'icon_style' => $this->settings->icon_style,
			    'icon_bg_size' => $this->settings->icon_bg_size,
			    'icon_border_style' => $this->settings->icon_border_style,
			    'icon_border_width' => $this->settings->icon_border_width,
			    'icon_bg_border_radius' => $this->settings->icon_bg_border_radius,

			 	/* Image Style */
			    'image_style' => $this->settings->image_style,
			    'img_bg_size' => $this->settings->img_bg_size,
			    'img_border_style' => $this->settings->img_border_style,
			    'img_border_width' => $this->settings->img_border_width,
			    'img_bg_border_radius' => $this->settings->img_bg_border_radius,
			);

			/* Render HTML Function */
			//echo '<div class="infobox-photo">';
				FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			//echo '</div>';
		}


	}

	/**
	 * @method render_button
	 */
	public function render_separator() {

		if( $this->settings->enable_separator == 'block' ) {
			$separator_settings = array(
				'color'			=> $this->settings->separator_color,
				'height'		=> $this->settings->separator_height,
				'width'			=> $this->settings->separator_width,
				'alignment'		=> $this->settings->separator_alignment,
				'style'			=> $this->settings->separator_style
			);

			echo '<div class="uabb-infobox-separator">';
			FLBuilder::render_module_html('uabb-separator', $separator_settings);
			echo '</div>';
		}
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBInfoBoxModule', array(
	'general'       => array(
		'title'         => __('General', 'uabb'),
		'sections'      => array(
			'title'         => array(
				'title'         => __('Title', 'uabb'),
				'fields'        => array(
					'heading_prefix'          => array(
						'type'          => 'text',
						'label'         => __('Title Prefix','uabb'),
						'help'			=> __('The small text appear above the title. You can leave it empty if not required.','uabb'),
						'connections'	=> array( 'string', 'html' ),
						'preview'       => array(
                            'type'            => 'text',
                            'selector'        => '.uabb-infobox-title-prefix'
                        ),
					),
					'title'         => array(
						'type'          => 'text',
						'label'         => __('Title', 'uabb'),
						'default'		=> __('Info Box','uabb'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-infobox-title'
						),
						'connections'	=> array( 'string', 'html' )
					),
				)
			),
			'text'          => array(
				'title'         => __('Description', 'uabb'),
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'			=> 6,
						'default'		=> __('Enter description text here.','uabb'),
						'connections'	=> array( 'string', 'html' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-infobox-text'
						),
					),
				)
			),
			'separator'       => array( // Section
				'title'         => __('Separator', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'enable_separator'	=> array(
		                'type'			=> 'select',
		                'label'			=> __('Separator', 'uabb'),
		                'default'		=> 'none',
		                'options'		=> array(
		                    'none'			=> _x( 'No', 'Enable Separator', 'uabb' ),
		                    'block' 		=> _x( 'Yes', 'Enable Separator', 'uabb' )
		                ),
					),
					'separator_style'	=> array(
						'type'          => 'select',
						'label'         => __('Style', 'uabb'),
						'default'       => 'solid',
						'options'       => array(
							'solid'         => _x( 'Solid', 'Border type.', 'uabb' ),
							'dashed'        => _x( 'Dashed', 'Border type.', 'uabb' ),
							'dotted'        => _x( 'Dotted', 'Border type.', 'uabb' ),
							'double'        => _x( 'Double', 'Border type.', 'uabb' )
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'border-top-style'
						),
						'help'          => __('The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb'),
					),
					'separator_color' => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'border-top-color',
						),
					),
					'separator_height'	=> array(
						'type'          => 'text',
						'label'         => __('Thickness', 'uabb'),
						'placeholder'   => '1',
						'maxlength'     => '2',
						'size'          => '3',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'border-top-width',
							'unit'          => 'px'
						),
						'help'			=> __('Adjust thickness of border.', 'uabb'),
					),
					'separator_width'        => array(
						'type'          => 'text',
						'label'         => __('Width', 'uabb'),
						'placeholder'       => '100',
						'maxlength'     => '3',
						'size'          => '5',
						'description'   => '%',
					),
					'separator_alignment'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'inherit',
						'options'       => array(
							'inherit'		=> _x( 'Default', 'uabb'),
							'center'		=> _x( 'Center', 'uabb' ),
							'left'			=> _x( 'Left', 'uabb' ),
							'right'			=> _x( 'Right', 'uabb' )
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator-parent',
							'property'      => 'text-align'
						),
					),
				)
			),
			'border'	=> array(
		        'title'     => __('Border', 'uabb'),
		        'fields'    => array(
		            'uabb_border_type'   => array(
						'type'    => 'select',
						'label'   => __('Type', 'uabb'),
						'default' => 'none',
						'help'    => __('The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb'),
						'options' => array(
		                    'none'   => _x( 'None', 'Border type.', 'uabb' ),
		                    'solid'  => _x( 'Solid', 'Border type.', 'uabb' ),
		                    'dashed' => _x( 'Dashed', 'Border type.', 'uabb' ),
		                    'dotted' => _x( 'Dotted', 'Border type.', 'uabb' ),
		                    'double' => _x( 'Double', 'Border type.', 'uabb' )
		                ),
		                'toggle'        => array(
		                    'solid'         => array(
		                        'fields'        => array('uabb_border_color', 'uabb_border_top', 'uabb_border_bottom', 'uabb_border_left', 'uabb_border_right', 'responsive_border', 'medium_border')
		                    ),
		                    'dashed'        => array(
		                        'fields'        => array('uabb_border_color', 'uabb_border_top', 'uabb_border_bottom', 'uabb_border_left', 'uabb_border_right', 'responsive_border', 'medium_border')
		                    ),
		                    'dotted'        => array(
		                        'fields'        => array('uabb_border_color', 'uabb_border_top', 'uabb_border_bottom', 'uabb_border_left', 'uabb_border_right', 'responsive_border', 'medium_border')
		                    ),
		                    'double'        => array(
		                        'fields'        => array('uabb_border_color', 'uabb_border_top', 'uabb_border_bottom', 'uabb_border_left', 'uabb_border_right', 'responsive_border', 'medium_border')
		                    )
		                ),
		                'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox',
							'property'      => 'border-style',
						),
		            ),
		            'uabb_border_top'    => array(
		                'type'          => 'text',
		                'label'         => __('Top Width', 'uabb'),
		                'default'       => '1',
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '0',
		                'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox',
							'property'      => 'border-top-width',
							'unit'			=> 'px',
						),
					),
		            'uabb_border_bottom' => array(
		                'type'          => 'text',
		                'label'         => __('Bottom Width', 'uabb'),
		                'default'       => '1',
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '0',
		                'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox',
							'property'      => 'border-bottom-width',
							'unit'			=> 'px',
						),
		            ),
		            'uabb_border_left'   => array(
		                'type'          => 'text',
		                'label'         => __('Left Width', 'uabb'),
		                'default'       => '1',
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '0',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox',
							'property'      => 'border-left-width',
							'unit'			=> 'px',
						),
		            ),
		            'uabb_border_right'  => array(
		                'type'          => 'text',
		                'label'         => __('Right Width', 'uabb'),
		                'default'       => '1',
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '0',
		                'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox',
							'property'      => 'border-right-width',
							'unit'			=> 'px',
						),
		            ),
		            'uabb_border_color'        => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox',
							'property'      => 'border-color',
						),
					),
		            'responsive_border'   => array(
		                'type'          => 'select',
		                'label'         => __('Hide on Small Screen Devices', 'uabb'),
		                'default'       => 'no',
		                'options'       => array(
		                    'yes'   => _x( 'Yes', 'Border type.', 'uabb' ),
		                    'no'  => _x( 'No', 'Border type.', 'uabb' )
		                )
		            ),
		            'medium_border'   => array(
		                'type'          => 'select',
		                'label'         => __('Hide on Medium Screen Devices', 'uabb'),
		                'default'       => 'no',
		                'options'       => array(
		                    'yes'   => _x( 'Yes', 'Border type.', 'uabb' ),
		                    'no'  	=> _x( 'No', 'Border type.', 'uabb' )
		                )
		            ),
		        )
		    ),
		)
	),
	'imageicon' => array(
		'title'         => __('Image / Icon', 'uabb'),
		'sections'      => array(
			'type_general' 		=> array( // Section
                'title'         => __('Image / Icon','uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'image_type'    => array(
                        'type'          => 'select',
                        'label'         => __('Image Type', 'uabb'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __( 'None', 'Image type.', 'uabb' ),
                            'icon'          => __('Icon', 'uabb'),
                            'photo'         => __('Photo', 'uabb'),
                        ),
                        'class'         => 'class_image_type',
                        'toggle'        => array(
                            'icon'          => array(
                                'sections'   => array( 'icon_basic',  'icon_style', 'icon_colors' ),
                            ),
                            'photo'         => array(
                                'sections'   => array( 'img_basic', 'img_style' ),
                            )
                        ),
                    ),
                )
            ),
			'icon_basic'		=> array( // Section
				'title'         => __('Icon Basics','uabb'), // Section Title
				'fields'        => array( // Section Fields
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'uabb'),
						'show_remove' => true
					),
					'icon_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'uabb'),
						'placeholder'   => '30',
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'preview'	=> array(
                        	'type'		=> 'refresh',
                        ),
					),
				)
			),
			/* Image Basic Setting */
			'img_basic'		=> array( // Section
				'title'         => __('Image Basics','uabb'), // Section Title
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
								'fields'        => array('photo_url' )
							)
						)
					),
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'uabb'),
						'show_remove'	=> true,
						'connections'   => array( 'photo' )
					),
					'photo_url'     => array(
						'type'          => 'text',
						'label'         => __('Photo URL', 'uabb'),
						'placeholder'   => 'http://www.example.com/my-photo.jpg',
						'connections'	=> array( 'url' )
					),
					'img_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'uabb'),
						'placeholder'   => '150',
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-photo-img',
                            'property'      => 'width',
                            'unit'			=> 'px'
                        )
					),
					'responsive_img_size'     => array(
						'type'          => 'text',
						'label'         => __('Responsive Size', 'uabb'),
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'help'			=> __( 'Image size below medium devices. Leve it blank if you want to keep same size', 'uabb' )
					),
				)
			),
			'icon_style'	=> 	array(
                'title'           => 'Style',
                'fields'        => array(
                    /* Icon Style */
                   'icon_style'         => array(
                        'type'          => 'select',
                        'label'         => __('Icon Background Style', 'uabb'),
                        'default'       => 'simple',
                        'options'       => array(
                            'simple'        => __('Simple', 'uabb'),
                            'circle'          => __('Circle Background', 'uabb'),
                            'square'         => __('Square Background', 'uabb'),
                            'custom'         => __('Design your own', 'uabb'),
                        ),
                        'toggle' => array(
                            'simple' => array(
                                'fields' => array(),
                                /*'sections' => array( 'colors' )*/
                            ),
                            'circle' => array(
                                /*'sections' => array( 'colors' ),*/
                                'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
                            ),
                            'square' => array(
                                /*'sections' => array( 'colors' ),*/
                                'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
                            ),
                            'custom' => array(
                                /*'sections' => array( 'colors' ),*/
                                'fields' => array( 'icon_color_preset', 'icon_border_style', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d', 'icon_bg_size', 'icon_bg_border_radius' ),
                            )
                        ),
                        'trigger' => array(
                            'custom' => array(
                                'fields' => array( 'icon_border_style' ),
                            )
                        ),
                    ),
                    
                    /* Icon Background SIze */
                    'icon_bg_size'          => array(
                        'type'          => 'text',
                        'label'         => __('Background Size', 'uabb'),
                        'help'          => __('Spacing between Icon & Background edge','uabb'),
                        'placeholder'   => '30',
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => 'px'
                    ),

                    /* Border Style and Radius for Icon */
                    'icon_border_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'none',
                        'help'          => __('The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb'),
                        'options'       => array(
                            'none'   => __( 'None', 'Border type.', 'uabb' ),
                            'solid'  => __( 'Solid', 'Border type.', 'uabb' ),
                            'dashed' => __( 'Dashed', 'Border type.', 'uabb' ),
                            'dotted' => __( 'Dotted', 'Border type.', 'uabb' ),
                            'double' => __( 'Double', 'Border type.', 'uabb' )
                        ),
                        'toggle'        => array(
                            'solid'         => array(
                                'fields'        => array('icon_border_width', 'icon_border_color','icon_border_hover_color' )
                            ),
                            'dashed'        => array(
                                'fields'        => array('icon_border_width', 'icon_border_color','icon_border_hover_color' )
                            ),
                            'dotted'        => array(
                                'fields'        => array('icon_border_width', 'icon_border_color','icon_border_hover_color' )
                            ),
                            'double'        => array(
                                'fields'        => array('icon_border_width', 'icon_border_color','icon_border_hover_color' )
                            )
                        ),
                    ),
                    'icon_border_width'    => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '6',
                        'placeholder'   => '1',
                        'preview'	=> array(
                        	'type'		=> 'refresh',
                        ),
                    ),
                    'icon_bg_border_radius'    => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '6',
                        'placeholder'   => '20',
                    ),
                )
            ),
			'img_style'		=> 	array(
                'title'         => 'Style',
                'fields'        => array(
                    /* Image Style */
                    'image_style'         => array(
                        'type'          => 'select',
                        'label'         => __('Image Style', 'uabb'),
                        'default'       => 'simple',
                        'help'          => __('Circle and Square style will crop your image in 1:1 ratio','uabb'),
                        'options'       => array(
                            'simple'        => __('Simple', 'uabb'),
                            'circle'        => __('Circle', 'uabb'),
                            'square'        => __('Square', 'uabb'),
                            'custom'        => __('Design your own', 'uabb'),
                        ),
                        'class' => 'uabb-image-icon-style',
                        'toggle' => array(
                            'simple' => array(
                                'fields' => array()
                            ),
                            'circle' => array(
                                'fields' => array( ),
                            ),
                            'square' => array(
                                'fields' => array( ),
                            ),
                            'custom' => array(
                                'sections'  => array( 'img_colors' ),
                                'fields'    => array( 'img_bg_size', 'img_border_style', 'img_border_width', 'img_bg_border_radius' ) 
                            )
                        ),
                        'trigger'       => array(
                            'custom'           => array(
                                'fields'        => array('img_border_style')
                            ),
                            
                        )
                    ),

                    /* Image Background Size */
                    'img_bg_size'          => array(
                        'type'          => 'text',
                        'label'         => __('Background Size', 'uabb'),
                        'help'          => __('Spacing between Image edge & Background edge','uabb'),
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => 'px',
                        'preview'	=> array(
                        	'type'		=> 'refresh',
                        ),
                    ),

                    /* Border Style and Radius for Image */
                    'img_border_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'none',
                        'help'          => __('The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb'),
                        'options'       => array(
                            'none'   => __( 'None', 'Border type.', 'uabb' ),
                            'solid'  => __( 'Solid', 'Border type.', 'uabb' ),
                            'dashed' => __( 'Dashed', 'Border type.', 'uabb' ),
                            'dotted' => __( 'Dotted', 'Border type.', 'uabb' ),
                            'double' => __( 'Double', 'Border type.', 'uabb' )
                        ),
                        'toggle'        => array(
                            'solid'         => array(
                                'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
                            ),
                            'dashed'        => array(
                                'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
                            ),
                            'dotted'        => array(
                                'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
                            ),
                            'double'        => array(
                                'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
                            )
                        ),
                    ),
                    'img_border_width'    => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '6',
                        'placeholder'   => '1',
                        'preview'	=> array(
                        	'type'		=> 'refresh',
                        ),
                    ),
                    'img_bg_border_radius'    => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '6',
                        'placeholder'   => '0',
                    ),
                )
            ),
			'icon_colors'	=> array( // Section
                'title'         => __('Colors', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                            
                    /* Style Options */
                    'icon_color_preset'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Icon Color Presets', 'uabb' ),
                        'default'       => 'preset1',
                        'options'       => array(
                            'preset1'       => __('Preset 1','uabb'),
                            'preset2'       => __('Preset 2','uabb'),
                            /*'preset3'     => 'Preset 3',*/
                        ),
                        'help'          => __('Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb')
                    ),
                    /* Icon Color */
                    'icon_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Icon Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'icon_hover_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Icon Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                               'type'      => 'none',
                        )
                    ),

                    /* Background Color Dependent on Icon Style **/
                    'icon_bg_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'icon_bg_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'icon_bg_hover_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Background Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                                'type'      => 'none',
                        )
                    ),
                    'icon_bg_hover_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),

                     /* Border Color Dependent on Border Style for ICon */
                    'icon_border_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'icon_border_hover_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    
                    /* Gradient Color Option */
                    'icon_three_d'       => array(
                        'type'          => 'select',
                        'label'         => __('Gradient', 'uabb'),
                        'default'       => '0',
                        'options'       => array(
                            '0'             => __('No', 'uabb'),
                            '1'             => __('Yes', 'uabb')
                        )
                    ),
                )
            ),
			'img_colors'	=> array( // Section
                'title'         => __('Colors', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    /* Background Color Dependent on Icon Style **/
                    'img_bg_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'img_bg_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'img_bg_hover_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Background Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                                'type'      => 'none',
                        )
                    ),
                    'img_bg_hover_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),

                     /* Border Color Dependent on Border Style for Image */
                    'img_border_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'img_border_hover_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Border Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
		)
	),
	'style'         => array(
		'title'         => __('Style', 'uabb'),
		'sections'      => array(
			'overall_structure' => array(
				'title'         => __('Structure', 'uabb'),
				'fields'        => array(
					'img_icon_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'uabb'),
						'default'       => 'above-title',
						'help'	=> __( 'Image Icon position', 'uabb' ),
						'options'       => array(
							'above-title'   => __('Above Heading', 'uabb'),
							'below-title'   => __('Below Heading', 'uabb'),
							'left-title'    => __( 'Left of Heading', 'uabb' ),
							'right-title'   => __( 'Right of Heading', 'uabb' ),
							'left'          => __('Left of Text and Heading', 'uabb'),
							'right'         => __('Right of Text and Heading', 'uabb')
						),
						/*'toggle'			=> array(
							'above-title'	=> array(
								'fields'	=> array( 'align', 'mobile_align' ),
							),
							'below-title'	=> array(
								'fields'	=> array( 'align', 'mobile_align' ),
							),
							'left' => array(
								'fields' => array( 'align_items', 'mobile_view' )
							),
							'right' => array(
								'fields' => array( 'align_items', 'mobile_view' )
							),
							'left-title' => array(
								'fields' => array( 'align_items' )
							),
							'right-title' => array(
								'fields' => array( 'align_items' )
							)
						)*/
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Overall Alignment', 'uabb'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'uabb'),
							'left'          => __('Left', 'uabb'),
							'right'         => __('Right', 'uabb')
						),
						'help'          => __('The alignment that will apply to all elements within the infobox.', 'uabb'),
					),
					'mobile_align'         => array(
						'type'          => 'select',
						'label'         => __('Mobile Alignment', 'uabb'),
						'default'       => '',
						'options'       => array(
							''        		=> __('Default', 'uabb'),
							'center'        => __('Center', 'uabb'),
							'left'          => __('Left', 'uabb'),
							'right'         => __('Right', 'uabb')
						),
						'help'          => __('This alignment will apply on Mobile', 'uabb'),
					),
					'align_items' => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Icon Vertical Alignment', 'uabb'),
						'default'       => 'center',
						'options'       => array(
							'center'        => __('Center', 'uabb'),
							'top'          => __('Top', 'uabb'),
						),
					),
					'mobile_view' => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Mobile Structure', 'uabb'),
						'default'       => '',
						'options'       => array(
							''        => __('Inline', 'uabb'),
							'stack'	  => __('Stack', 'uabb'),
						),
						'preview'		=> array(
							'type'	  => 'none'
						),
					),
					'stacking_order' => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Stacking Order', 'uabb'),
						'default'       => 'default',
						'options'       => array(
							'reversed'        => __('Reversed', 'uabb'),
							'default'          => __('Default', 'uabb'),
						),
						'help'          => __( 'Use this option to show Icon / Image above title in small devices.', 'uabb'),
					),
					'bg_type' => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Select Background', 'uabb'),
						'default'       => 'color',
						'options'       => array(
							''				=> __('None', 'uabb'),
							'color'			=> __('Color', 'uabb'),
							'gradient'      => __('Gradient', 'uabb'),
						),
						'toggle'		=> array(
							'color' =>	array(
								'fields'	=> array( 'bg_color', 'bg_color_opc')
							),
							'gradient' =>	array(
								'fields'	=> array( 'bg_gradient' )
							),
						)
					),
					'bg_color' => array( 
						'type'       => 'color',
						'label'         => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox',
							'property'      => 'background',
						),
					),
		            'bg_color_opc' => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
		            'bg_gradient'         => array(
						'type'          => 'uabb-gradient',
						'label'         => __('Gradient', 'uabb'),
						'default'       => array(
							'color_one' => '',
							'color_two' => '',
							'direction' => 'left_right',
							'angle'		=> '0'
						),
					),
					'info_box_padding'		=> array(
						'type'          => 'uabb-spacing',
                        'label'         => __( 'Content Padding', 'uabb' ),
                        'mode'			=> 'padding',
                        'help'     => __( 'To apply padding to Info Box use this setting', 'uabb' ),
                        'default'       => 'padding: 20px;' // Optional
					),
		            'min_height_switch'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Minimum Height', 'uabb' ),
                        'default'       => 'auto',
                        'options'       => array(
                          	'custom'		=> __('Yes','uabb'),
                         	'auto'		=> __('No','uabb'),
                        ),
                        'toggle'	=> array(
                        	'custom'	=> array(
                        		'fields'	=> array( 'min_height', 'vertical_align' ),
                        	)
                        ),
                    ),
					'min_height'          => array(
						'type'          => 'text',
		                'label'         => __('Enter Height', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '4',
		                'size'          => '5',
		                'placeholder'   => 'auto',
		                'help'          => __('Apply minimum height to complete Info Box. It is useful when multiple Info Boxes are in same row.', 'uabb'),
					),
					'vertical_align'         => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Overall Vertical Alignment', 'uabb'),
						'default'       => 'center',
						'help'			=> __('If enabled, the Content would align vertically center', 'uabb'),
						'options'       => array(
							'center'        => __('Center', 'uabb'),
							'inherit'       => __('Top', 'uabb')
						),
					),
				)
			),
			'heading_margins' => array(
				'title'         => __( 'Title Margins', 'uabb' ),
				'fields'        => array(
					'heading_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Top', 'uabb'),
						'default'           => '',
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox-title',
							'property'      => 'margin-top',
							'unit'          => 'px'
						),
					),
					'heading_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Bottom', 'uabb'),
						'placeholder'		=> '10',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox-title',
							'property'      => 'margin-bottom',
							'unit'          => 'px'
						),
					),
					'prefix_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Prefix Top', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox-title-prefix',
							'property'      => 'margin-top',
							'unit'          => 'px'
						),
					)
				)
			),
			'img_icon_margins' => array(
				'title'         => __( 'Image / Icon Margins', 'uabb' ),
				'fields'        => array(
					'img_icon_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Top', 'uabb'),
						'placeholder'		=> '5',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
					),
					'img_icon_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Bottom', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
					)
				)
			),
			'content_margins' => array(
				'title'         => __( 'Description Margins', 'uabb' ),
				'fields'        => array(
					'content_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Top', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox-text',
							'property'      => 'margin-top',
							'unit'          => 'px'
						),
					),
					'content_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Bottom', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-infobox-text',
							'property'      => 'margin-bottom',
							'unit'          => 'px'
						),
					)
				)
			),
			'separator_margins' => array(
				'title'         => __( 'Separator Margins', 'uabb' ),
				'fields'        => array(
					'separator_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Top', 'uabb'),
						'placeholder'		=> '20',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'margin-top',
							'unit'          => 'px'
						),
					),
					'separator_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Bottom', 'uabb'),
						'placeholder'		=> '20',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'margin-bottom',
							'unit'          => 'px'
						),
					)
				)
			),
		)
	),
	'cta'           => array(
		'title'         => __('Link', 'uabb'),
		'sections'      => array(
			'cta'           => array(
				'title'         => __('Call to Action', 'uabb'),
				'fields'        => array(
					'cta_type'      => array(
						'type'          => 'select',
						'label'         => __('Type', 'uabb'),
						'default'       => 'none',
						'options'       => array(
							'none'          => _x( 'None', 'Call to action.', 'uabb' ),
							'link'          => __('Text', 'uabb'),
							'button'        => __('Button', 'uabb'),
							'module'		=> __('Complete Box','uabb'),
						),
						'toggle'        => array(
							'none'          => array(),
							'link'          => array(
								'fields'        => array('cta_text'),
								'sections'		=> array('link', 'link_typography')
							),
							'button'        => array(
								'sections'      => array('btn-general', 'btn-link', 'btn-icon', 'btn-colors', 'btn-style', 'btn-structure', 'btn_typography')
							),
							'module'          => array(
								'sections'		=> array('link')
							),

						)
					),
					'cta_text'      => array(
						'type'          => 'text',
						'label'         => __('Text', 'uabb'),
						'default'		=> __('Read More', 'uabb'),
						'connections'	=> array( 'string', 'html' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-infobox-cta-link',
						)
					),
				)
			),
			'btn-general'    => array( // Section
                'title'         => __( 'General', 'uabb' ),
                'fields'        => array(
                    'btn_text'          => array(
                        'type'          => 'text',
                        'label'         => __('Text', 'uabb'),
                        'default'       => __('Click Here', 'uabb'),
                        'connections'	=> array( 'string', 'html' ),
                        'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-button-text',
						)
                    ),
                )
            ),
            'btn-link'       => array( // Section
                'title'         => __('Link', 'uabb'),
                'fields'        => array(
                    'btn_link'          => array(
                        'type'          => 'link',
                        'label'         => __('Link', 'uabb'),
                        'placeholder'   => 'http://www.example.com',
                        'preview'       => array(
                            'type'          => 'none'
                        ),
                        'connections'	=> array( 'url' )
                    ),
                    'btn_link_target'   => array(
                        'type'          => 'select',
                        'label'         => __('Link Target', 'uabb'),
                        'default'       => '_self',
                        'options'       => array(
                            '_self'         => __('Same Window', 'uabb'),
                            '_blank'        => __('New Window', 'uabb')
                        ),
                        'preview'       => array(
                            'type'          => 'none'
                        )
					),
					'btn_link_nofollow'   => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Link nofollow', 'uabb'),
						'description'   => '',
						'default'       => '0',
						'help'			=> __('Enable this to make this link nofollow', 'uabb'),
						'options'       => array(
							'1'       => __('Yes','uabb'),
							'0'       => __('No','uabb'),
						),
					),
                )
            ),
            'btn-style'      => array(
                'title'         => __('Style', 'uabb'),
                'fields'        => array(
                    'btn_style'         => array(
                        'type'          => 'select',
                        'label'         => __('Style', 'uabb'),
                        'default'       => 'flat',
                        'class'         => 'creative_button_styles',
                        'options'       => array(
                            'flat'          => __('Flat', 'uabb'),
                            'gradient'      => __('Gradient', 'uabb'),
                            'transparent'   => __('Transparent', 'uabb'),
                            'threed'          => __('3D', 'uabb'),
                        ),
                    ),
                    'btn_border_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Border Size', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '5',
                        'placeholder'   => '2'
                    ),
                    'btn_transparent_button_options'  => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'transparent-fade',
                        'options'       => array(
                            'none'          => __('None', 'uabb'),
                            'transparent-fade'          => __('Fade Background', 'uabb'),
                            'transparent-fill-top'      => __('Fill Background From Top', 'uabb'),
                            'transparent-fill-bottom'      => __('Fill Background From Bottom', 'uabb'),
                            'transparent-fill-left'     => __('Fill Background From Left', 'uabb'),
                            'transparent-fill-right'     => __('Fill Background From Right', 'uabb'),
                            'transparent-fill-center'       => __('Fill Background Vertical', 'uabb'),
                            'transparent-fill-diagonal'     => __('Fill Background Diagonal', 'uabb'),
                            'transparent-fill-horizontal'  => __('Fill Background Horizontal', 'uabb'),
                        ),
                    ),
                    'btn_threed_button_options'         => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'threed_down',
                        'options'       => array(
                            'threed_down'          => __('Move Down', 'uabb'),
                            'threed_up'      => __('Move Up', 'uabb'),
                            'threed_left'      => __('Move Left', 'uabb'),
                            'threed_right'     => __('Move Right', 'uabb'),
                            'animate_top'     => __('Animate Top', 'uabb'),
                            'animate_bottom'     => __('Animate Bottom', 'uabb'),
                            /*'animate_left'     => __('Animate Left', 'uabb'),
                            'animate_right'     => __('Animate Right', 'uabb'),*/
                        ),
                    ),
                    'btn_flat_button_options'         => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __('None', 'uabb'),
                            'animate_to_left'      => __('Appear Icon From Right', 'uabb'),
                            'animate_to_right'          => __('Appear Icon From Left', 'uabb'),
                            'animate_from_top'      => __('Appear Icon From Top', 'uabb'),
                            'animate_from_bottom'     => __('Appear Icon From Bottom', 'uabb'),
                        ),
                    ),
                )
            ),
            'btn-icon'       => array( // Section
                'title'         => __('Icons', 'uabb'),
                'fields'        => array(
                    'btn_icon'          => array(
                        'type'          => 'icon',
                        'label'         => __('Icon', 'uabb'),
                        'show_remove'   => true
                    ),
                    'btn_icon_position' => array(
                        'type'          => 'select',
                        'label'         => __('Icon Position', 'uabb'),
                        'default'       => 'before',
                        'options'       => array(
                            'before'        => __('Before Text', 'uabb'),
                            'after'         => __('After Text', 'uabb')
                        )
                    )
                )
            ),
            'btn-colors'     => array( // Section
                'title'         => __('Colors', 'uabb'),
                'fields'        => array(
                    'btn_text_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Text Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-creative-button-wrap a *',
							'property'		=> 'color',
						)
                    ),
                    'btn_text_hover_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Text Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
                    'btn_bg_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-creative-button-wrap a',
							'property'		=> 'background',
						)
                    ),
                    'btn_bg_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),

                    'btn_bg_hover_color'        => array( 
                        'type'       => 'color',
                        'label'         => __('Background Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
                    'btn_bg_hover_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'hover_attribute' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Apply Hover Color To', 'uabb' ),
                        'default'       => 'bg',
                        'options'       => array(
                            'border'    => __( 'Border', 'uabb' ),
                            'bg'        => __( 'Background', 'uabb' ),
                        ),
                        'width' => '75px'
                    ),
                )
            ),
            'btn-structure'  => array(
                'title'         => __('Structure', 'uabb'),
                'fields'        => array(
                    'btn_width'         => array(
                        'type'          => 'select',
                        'label'         => __('Width', 'uabb'),
                        'default'       => 'auto',
                        'options'       => array(
                            'auto'          => _x( 'Auto', 'Width.', 'uabb' ),
                            'full'          => __('Full Width', 'uabb'),
                            'custom'        => __('Custom', 'uabb')
                        ),
                        'toggle'        => array(
                            'auto'          => array(
                                'fields'        => array('btn_align', 'btn_mob_align')
                            ),
                            'full'          => array(
                                'fields'        => array( )
                            ),
                            'custom'        => array(
                                'fields'        => array('btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom', 'btn_padding_left_right' )
                            )
                        )
                    ),
                    'btn_custom_width'  => array(
                        'type'          => 'text',
                        'label'         => __('Custom Width', 'uabb'),
                        'default'       => '200',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-creative-button-wrap a',
                            'property'  => 'width',
                            'unit'		=> 'px'
                        ),
                    ),
                    'btn_custom_height'  => array(
                        'type'          => 'text',
                        'label'         => __('Custom Height', 'uabb'),
                        'default'       => '45',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-creative-button-wrap a',
                            'property'  => 'min-height',
                            'unit'		=> 'px'
                        ),
                    ),
                    'btn_padding_top_bottom'       => array(
                        'type'          => 'text',
                        'label'         => __('Padding Top/Bottom', 'uabb'),
                        'placeholder'   => '0',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'       => array(
					        'type'          => 'css',
					        'rules'           => array(
					            array(
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-top',
					                'unit'		=> 'px'
					            ),
					            array(
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-bottom',
					                'unit'		=> 'px'
					            ),    
					        )
					    )
                    ),
                    'btn_padding_left_right'       => array(
                        'type'          => 'text',
                        'label'         => __('Padding Left/Right', 'uabb'),
                        'placeholder'   => '0',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'       => array(
					        'type'          => 'css',
					        'rules'           => array(
					            array(
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-left',
					                'unit'		=> 'px'
					            ),
					            array(
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-right',
					                'unit'		=> 'px'
					            ),
					        )
					    )
                    ),
                    'btn_border_radius' => array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'uabb'),
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-creative-button-wrap a',
                            'property'  => 'border-radius',
                            'unit'		=> 'px'
                        ),
                    ),
					'custom_class'          => array(
						'type'          => 'text',
						'label'         => __('Custom Class', 'uabb'),
						'default'		=> '',
						'preview'       => array(
							'type'          => 'none'
						),
					),
                )
            ),
			'link'          => array(
				'title'         => __('Link', 'uabb'),
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'uabb'),
						'help'          => __('The link applies to the entire module. If choosing a call to action type below, this link will also be used for the text or button.', 'uabb'),
						'preview'       => array(
							'type'          => 'none'
						),
						'connections'	=> array( 'url' )
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'uabb'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'uabb'),
							'_blank'        => __('New Window', 'uabb')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_nofollow'   => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Link nofollow', 'uabb'),
						'description'   => '',
						'default'       => '0',
						'help'			=> __('Enable this to make this link nofollow', 'uabb'),
						'options'       => array(
							'1'       => __('Yes','uabb'),
							'0'       => __('No','uabb'),
						),
					),
				)
			),
		)
	),
	'typography'         => array(
		'title'         => __('Typography', 'uabb'),
		'sections'      => array(
			'prefix_typography'    =>  array(
                'title' => __('Title Prefix', 'uabb' ),
                'fields'    => array(
                    'prefix_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h5',
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
                    'prefix_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-infobox-title-prefix'
                    	),
                    ),
                    'prefix_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-title-prefix',
                            'property'	=> 'font-size',
                            'unit'		=> 'px'
                    	),
                    ),
                    'prefix_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-title-prefix',
                            'property'	=> 'line-height',
                            'unit'		=> 'px'
                    	),
                    ),
                    'prefix_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-title-prefix',
                            'property'	=> 'color',
                    	),
                    ),
                )
            ),
			'title_typography'    =>  array(
                'title' => __('Title', 'uabb' ),
                'fields'    => array(
                    'title_tag_selection'   => array(
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
                    'title_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-infobox-title'
                    	),
                    ),
                    'title_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-title',
                            'property'	=> 'font-size',
                            'unit'		=> 'px',
                    	),
                    ),
                    'title_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-title',
                            'property'	=> 'line-height',
                            'unit'		=> 'px',
                    	),
                    ),
                    'title_color'        => array(
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-title',
                            'property'	=> 'color',
                    	),
                    ),
                )
            ),
			'subhead_typography'    =>  array(
                'title' => __('Description', 'uabb' ),
                'fields'    => array(
                    'subhead_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-infobox-text, .uabb-infobox-text * '
                    	),
                    ),
                    'subhead_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-text, .uabb-infobox-text * ',
                            'property'	=> 'font-size',
                            'unit'		=> 'px',
                    	),
                    ),
                    'subhead_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-text, .uabb-infobox-text * ',
                            'property'	=> 'line-height',
                            'unit'		=> 'px',
                    	),
                    ),
                    'subhead_color'        => array( 
                        'type'       => 'color',
                        'label'         => __('Description Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-text, .uabb-infobox-text * ',
                            'property'	=> 'color',
                    	),
                    ),
                )
            ),
			'btn_typography'    =>  array(
                'title' => __( 'CTA Button Text', 'uabb' ),
                'fields'    => array(
                    'btn_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> 'a.uabb-button'
                    	),
                    ),
                    'btn_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> 'a.uabb-button',
                            'property'	=> 'font-size',
                            'unit'		=> 'px',
                    	),
                    ),
                    'btn_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> 'a.uabb-button',
                            'property'	=> 'line-height',
                            'unit'		=> 'px',
                    	),
                    ),
                    'btn_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Top', 'uabb'),
						'placeholder'		=> '10',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-button',
                            'property'	=> 'margin-top',
                            'unit'		=> 'px',
                    	),
					),
					'btn_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Bottom', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-button',
                            'property'	=> 'margin-bottom',
                            'unit'		=> 'px',
                    	),
					),
                )
            ),
			'link_typography'    =>  array(
                'title' => __( 'CTA Link Text', 'uabb' ),
                'fields'    => array(
                    'link_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-infobox-cta-link'
                    	),
                    ),
                    'link_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-cta-link',
                            'property'	=> 'font-size',
                            'unit'		=> 'px',
                    	)
                    ),
                    'link_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-infobox-cta-link',
                            'property'	=> 'line-height',
                            'unit'		=> 'px',
                    	)
                    ),
                    'link_color'        => array(
                        'type'       => 'color',
                        'label'         => __('Link Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'link_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Margin Top', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
					),
					'link_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Margin Bottom', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
					),
                )
            ),
		)
	)
));
