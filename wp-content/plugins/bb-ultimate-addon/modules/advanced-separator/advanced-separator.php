<?php

/**
 * @class AdvancedSeparatorModule
 */
class AdvancedSeparatorModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Advanced Separator', 'uabb'),
			'description'   	=> __('A divider line to separate content.', 'uabb'),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/advanced-separator/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/advanced-separator/',
            'editor_export' 	=> false,
			'partial_refresh'	=> true,
			'icon'				=> 'minus.svg',
		));
	}

	/**
	 * @method render_image
	 */
	public function render_image()
	{
		if( $this->settings->separator == 'line_image' || $this->settings->separator == 'line_icon' ) {
			$imageicon_array = array(
	 
				/* General Section */
				'image_type' => ( $this->settings->separator == 'line_image' ) ? 'photo' : ( ( $this->settings->separator == 'line_icon' ) ? 'icon' : '' ),

				/* Icon Basics */
				'icon' => $this->settings->icon,
				'icon_size' => $this->settings->icon_size,
				'icon_align' => 'center',//$this->settings->icon_align,

				/* Image Basics */
				'photo_source' => $this->settings->photo_source,
				'photo' => $this->settings->photo,
				'photo_url' => $this->settings->photo_url,
				'img_size' => $this->settings->img_size,
				'img_align' => 'center',//$this->settings->img_align,
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
			if( $this->settings->separator == 'line_image' ) {
				echo '<div class="uabb-image-outter-wrap">';
			}
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			if( $this->settings->separator == 'line_image' ) {
				echo '</div>';
			}
		}
	}
}

	


/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('AdvancedSeparatorModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
			'separator'		=> array(
				'title'         => '', // Section Title
				'fields'		=>array(
					'separator'	=> array(
							'type'          => 'select',
							'label'         => __('Separator Style', 'uabb'),
							'default'       => 'line',
							'options'       => array(
								'line'      => __( 'Line', 'uabb' ),
								'line_icon'        => __( 'Line With Icon', 'uabb' ),
								'line_image'       => __( 'Line With Image', 'uabb' ),
								'line_text'		   => __( 'Line With Text', 'uabb' ),
							),
							'help'          => __('Choose Separator Style.', 'uabb'),
							'toggle'		=> array(
								'line'		=> array(
									'fields' => array(),
									'sections' => array( 'separator_style' ),
									//'tabs'		=> array(),
								),
						    	'line_icon'		=> array(
						    		'fields' => array( 'icon_photo_position', 'icon_spacing' ),
						    		'sections'		=> array( 'icon_basic',  'icon_style', 'icon_colors', 'separator_style' ),
						    		//'tabs'		=> array( 'design' )
						    	),
						    	'line_image'	=> array(
						    		'fields' => array( 'icon_photo_position', 'icon_spacing' ),
						    		'sections'		=> array( 'img_basic', 'img_style', 'separator_style' ),
						    		//'tabs'		=> array( 'design' ),
						    	),
						    	'line_text'	=> array(
						    		'fields' => array( 'icon_photo_position', 'icon_spacing', 'responsive_compatibility' ),
						    		'sections'		=> array( 'text', 'text_typography', 'separator_style' ),
						    		//'tabs'		=> array( 'design' ),
						    	),
						    ),
					),
				),
			),
			'icon_basic' 	=> 	array( // Section
		        'title'         => __( 'Icon Basics', 'uabb'), // Section Title
		        'fields'        => array( // Section Fields
		            'icon'          => array(
		                'type'          => 'icon',
		                'label'         => __('Icon', 'uabb'),
		                'show_remove'   => true
		            ),
		            'icon_size'     => array(
		                'type'          => 'text',
		                'label'         => __('Size', 'uabb'),
		                'placeholder'   => '30',
		                'maxlength'     => '5',
		                'size'          => '6',
		                'description'   => 'px',
		            ),
		        )
		    ),
			'img_basic' 	=> array( // Section
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
		                'show_remove'   => true,
		                'connections'	=> array( 'photo' )
		            ),
		            'photo_url'     => array(
		                'type'          => 'text',
		                'label'         => __('Photo URL', 'uabb'),
		                'placeholder'   => 'http://www.example.com/my-photo.jpg',
		            ),
		            'img_size'     => array(
		                'type'          => 'text',
		                'label'         => __('Size', 'uabb'),
		                'maxlength'     => '5',
		                'size'          => '6',
		                'description'   => 'px',
						'placeholder' => '50',
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-image-outter-wrap, .uabb-image .uabb-photo-img',
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
						'help'			=> __( 'Image size below medium devices. Leave it blank if you want to keep same size', 'uabb' ),
						'preview'		=> array(
							'type'	=> 'none'
						)
					),
		        )
		    ),
			'icon_style'	=> array(
		        'title'           => __('Style','uabb'),
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
		                    'none'   => __( 'None', 'uabb' ),
		                    'solid'  => __( 'Solid', 'uabb' ),
		                    'dashed' => __( 'Dashed', 'uabb' ),
		                    'dotted' => __( 'Dotted', 'uabb' ),
		                    'double' => __( 'Double', 'uabb' )
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
			'img_style'		=> array(
		        'title'         => __('Style','uabb'),
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
		                'help'          => __( 'Spacing between Image edge & Background edge','uabb'),
		                'maxlength'     => '3',
		                'size'          => '6',
		                'description'   => 'px',
		            ),

		            /* Border Style and Radius for Image */
		            'img_border_style'   => array(
		                'type'          => 'select',
		                'label'         => __('Border Style', 'uabb'),
		                'default'       => 'none',
		                'help'          => __('The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb'),
		                'options'       => array(
		                    'none'   => __( 'None', 'uabb' ),
		                    'solid'  => __( 'Solid', 'uabb' ),
		                    'dashed' => __( 'Dashed', 'uabb' ),
		                    'dotted' => __( 'Dotted', 'uabb' ),
		                    'double' => __( 'Double', 'uabb' )
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
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-image .uabb-image-content',
                            'property'      => 'border-style',
                        )
		            ),
		            'img_border_width'    => array(
		                'type'          => 'text',
		                'label'         => __('Border Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '6',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-image .uabb-image-content',
                            'property'      => 'border-width',
                            'unit'			=> 'px'
                        )
		            ),
		            'img_bg_border_radius'    => array(
		                'type'          => 'text',
		                'label'         => __('Border Radius', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '6',
		                'placeholder'   => '0',
    	                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-image .uabb-image-content',
                            'property'      => 'border-radius',
                            'unit'			=> 'px'
                        )
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
                    'icon_color' => array( 
						'type'       => 'color',
		                'label'     => __('Icon Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
					'icon_hover_color' => array( 
						'type'       => 'color',
	                    'label'         => __('Icon Hover Color', 'uabb'),
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
						'label'         => __('Background Hover Color', 'uabb'),
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
						'label'         => __('Border Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
		            'icon_border_hover_color' => array( 
						'type'       => 'color',
						'label'         => __('Border Hover Color', 'uabb'),
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
		        	'img_bg_color' => array( 
						'type'       => 'color',
						'label'         => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-image .uabb-image-content',
                            'property'      => 'background',
                        )
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
						'label'         => __('Background Hover Color', 'uabb'),
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
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-image .uabb-image-content',
                            'property'      => 'border-color',
                        )
					),
		            'img_border_hover_color' => array( 
						'type'       => 'color',
						'label'         => __('Border Hover Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
		        )
		    ),
			'text'			=> array(
				'title'			=> __('Text', 'uabb'),
				'fields'		=> array(
					'text_inline'        => array(
						'type'          => 'text',
						'label'         => __('Text', 'uabb'),
						'default'       => 'Ultimate',
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-divider-text',
						),
						'connections' => array( 'string' )
					),
				)
			),
			'text_typography' => array(
                'title' => __( 'Text Typography', 'uabb' ),
		        'fields'    => array(
		            'text_tag_selection'   => array(
		                'type'          => 'select',
		                'label'         => __('Title Tag', 'uabb'),
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
		            'text_font_family'       => array(
		                'type'          => 'font',
		                'label'         => __('Font Family', 'uabb'),
		                'default'       => array(
		                    'family'        => 'Default',
		                    'weight'        => 'Default'
		                ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-divider-text'
                        )
		            ),
		            'text_font_size'     => array(
		                'type'          => 'uabb-simplify',
		                'label'         => __( 'Font Size', 'uabb' ),
		                'default'       => array(
		                    'desktop'       => '',
		                    'medium'        => '',
		                    'small'         => '',
		                ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-divider-text',
                            'property'	=> 'font-size',
                            'unit'		=> 'px',
                        )
		            ),
		            'text_line_height'    => array(
		                'type'          => 'uabb-simplify',
		                'label'         => __( 'Line Height', 'uabb' ),
		                'default'       => array(
		                    'desktop'       => '',
		                    'medium'        => '',
		                    'small'         => '',
		                ),
		                'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-divider-text',
                            'property'	=> 'line-height',
                            'unit'		=> 'px',
                        )
		            ),
		            'text_color'        => array(
						'type'       => 'color',
						'label'      => __('Text Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-divider-text',
                            'property'	=> 'color',
                        )
					),
		        )
		    ),
		)
	),
	'design'		=> array(
		'title'		=> __('Style', 'uabb'), //tab title
		'sections'		=> array(
			'design'	=>array(
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'icon_photo_position'	=> array(
						'type'          => 'text',
						'label'         => __('Position', 'uabb'),
						'help'			=> __('Adjust the position of Icon / Image / Text. 0% for very left & 100% for very right.', 'uabb'),
						'placeholder'   => '50',
						'maxlength'     => '3',
						'size'          => '5',
						'description'   => '%',
					),
					'icon_spacing'	=> array(
						'type'          => 'text',
						'label'         => __('Spacing', 'uabb'),
						'help'         => __('Adjust the spacing between separator line edges & your Icon / Image / Text.', 'uabb'),
						'placeholder'   => '10',
						'maxlength'     => '2',
						'size'          => '5',
						'description'   => 'px',
					),
					'responsive_compatibility' => array(
						'type' => 'select',
						'label' => __('Responsive Compatibility', 'uabb'),
						'help' => __('There might be responsive issues for long texts. If you are facing such issues then select appropriate devices width to make your module responsive.', 'uabb'),
						'default' => '',
						'options' => array(
							'' => __('None','uabb'),
							'uabb-responsive-mobile' => __('Small Devices','uabb'),
							'uabb-responsive-medsmall' => __('Medium & Small Devices','uabb'),
						),
					),
				)
			),
			'separator_style'	=> array(
				'title'		=> __('Line Style', 'uabb'), //tab title
				'fields'	=> array(
					'style'		=> array(
						'type'          => 'select',
						'label'         => __('Style', 'uabb'),
						'default'       => 'solid',
						'options'       => array(
							'solid'         => __( 'Solid', 'uabb' ),
							'dashed'        => __( 'Dashed', 'uabb' ),
							'dotted'        => __( 'Dotted', 'uabb' ),
							'double'        => __( 'Double', 'uabb' )
						),
						'help'          => __('The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb'),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator, .uabb-separator-line > span',
							'property'      => 'border-top-style'
						)
					),
					'color' => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator, .uabb-separator-line > span',
							'property'      => 'border-top-color'
						)
					),
					'height'     => array(
						'type'          => 'text',
						'label'         => __('Thickness', 'uabb'),
						'placeholder'   => '1',
						'maxlength'     => '2',
						'size'          => '3',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator, .uabb-separator-line > span',
							'property'      => 'border-top-width',
							'unit'          => 'px'
						),
						'help'			=> __( 'Thickness of Border', 'uabb' )
					),
					'width'      => array(
						'type'          => 'text',
						'label'         => __('Width', 'uabb'),
						'placeholder'   => '100',
						'maxlength'     => '3',
						'size'          => '5',
						'description'   => '%'
					),
					'alignment'	 => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'center',
						'options'       => array(
							'center'      => __( 'Center', 'uabb' ),
							'left'        => __( 'Left', 'uabb' ),
							'right'       => __( 'Right', 'uabb' )
						),
					),
				)
			)
		)
	),
	
));
