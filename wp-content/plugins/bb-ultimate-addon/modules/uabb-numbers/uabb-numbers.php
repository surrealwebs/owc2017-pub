<?php

/**
 * @class UABBNumbersModule
 */
class UABBNumbersModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Counter', 'uabb'),
			'description'   => __('Renders an animated number counter.', 'uabb'),
			'category'      	=> UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/uabb-numbers/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/uabb-numbers/',
		));

		$this->add_js( 'jquery-waypoints' );
		$this->add_css( 'font-awesome' );
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings){
		// Cache the photo data.
		if(!empty($settings->photo)) {

			$data = FLBuilderPhoto::get_attachment_data($settings->photo);

			if($data) {
				$settings->photo_data = $data;
			}
		}

		return $settings;
	}


	public function render_number(){

		$number = 0;//$this->settings->number ? $this->settings->number : 0;
		$layout = $this->settings->layout ? $this->settings->layout : 'default';
		$type   = $this->settings->number_type ? $this->settings->number_type : 'percent';
		$prefix = $type == 'percent' ? '' : $this->settings->number_prefix;
		$suffix = $type == 'percent' ? '%' : $this->settings->number_suffix;
		$tag = ( $this->settings->num_tag_selection != 'default' ) ? $this->settings->num_tag_selection : 'div';


		$html = '<' . $tag . ' class="uabb-number-string">' . $prefix . '<span class="uabb-number-int">'. number_format( $number ) .'</span>' . $suffix . '</' . $tag . '>';

		echo $html;
	}

	public function render_before_number_text(){
		$html = '';
		if( !empty( $this->settings->before_number_text ) ) {
			$html .= '<span class="uabb-number-before-text">' . esc_html( $this->settings->before_number_text ) . '</span>';
		}
		echo $html;
	}

	public function render_after_number_text(){
		$html = '';
		if( !empty( $this->settings->after_number_text ) ) {
			$html .= '<span class="uabb-number-after-text">' . esc_html( $this->settings->after_number_text ) . '</span>';
		}
		echo $html;
	}

	public function render_circle_bar(){

		$width = !empty( $this->settings->circle_width ) ? $this->settings->circle_width : 300;
		$pos = ( $width / 2 );
		$radius = $pos - 10;
		$dash = number_format( ( ( M_PI * 2 ) * $radius ), 2, '.', '');

		$html = '<div class="svg-container">';
		$html .= '<svg class="svg" viewBox="0 0 '. $width .' '. $width .'" version="1.1" preserveAspectRatio="xMinYMin meet">
			<circle class="uabb-bar-bg" r="'. $radius .'" cx="'. $pos .'" cy="'. $pos .'" fill="transparent" stroke-dasharray="'. $dash .'" stroke-dashoffset="0"></circle>
			<circle class="uabb-bar" r="'. $radius .'" cx="'. $pos .'" cy="'. $pos .'" fill="transparent" stroke-dasharray="'. $dash .'" stroke-dashoffset="'. $dash .'" transform="rotate(-90.1 '. $pos .' '. $pos .')"></circle>
		</svg>';
		$html .= '</div>';

		echo $html;
	}

	/**
	 * @method render_button
	 */
	public function render_separator() {


		if( $this->settings->show_separator == 'yes' ) {
			$separator_settings = array(
				'color'			=> $this->settings->separator_color,
				'height'		=> $this->settings->separator_height,
				'width'			=> $this->settings->separator_width,
				'alignment'		=> $this->settings->separator_alignment,
				'style'			=> $this->settings->separator_style
			);

			echo '<div class="uabb-number-separator">';
			FLBuilder::render_module_html('uabb-separator', $separator_settings);
			echo '</div>';
		}
	}

	/**
	 * @method render_image
	 */
	public function render_image( $position )
	{ 		
		if( $this->settings->image_type != 'none' ) {

			/* Get setting pos according to image type */
			$set_pos = '';
			if( $this->settings->layout == 'circle' ){
				$set_pos 		= $this->settings->circle_position;
			}elseif( $this->settings->layout == 'default' ){
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
				    'icon_align' => $this->settings->align,

				    /* Image Basics */
				    'photo_source' => $this->settings->photo_source,
				    'photo' => $this->settings->photo,
				    'photo_url' => $this->settings->photo_url,
				    'img_size' => $this->settings->img_size,
				    'img_align' => $this->settings->align,
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

	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBNumbersModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
			/* Counter Genral Setting */
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'layout' => array(
					    'type'          => 'select',
					    'label'         => __( 'Layout', 'uabb' ),
					    'default'       => 'default',
					    'options'       => array(
					    	'default'		=> __( 'Only Numbers', 'uabb' ),
					    	'circle'		=> __( 'Circle Counter', 'uabb' ),
					    	'bars'			=> __( 'Bars Counter', 'uabb' ),
					    ),
					    'toggle'		=> array(
					    	'default'	=> array(
					    		'sections'		=> array( 'separator', 'overall_structure' ),
					    		'tabs'          => array( 'imageicon' ),
					    		'fields'		=> array( )
					    	),
					    	'circle'		=> array(
					    		'sections'		=> array( 'circle_bar_style', 'separator', 'overall_structure' ),
					    		'tabs'          => array( 'imageicon' ),
					    		'fields'		=> array( )
					    	),
					    	'bars'			=> array(
					    		'sections'		=> array( 'bar_style' ),
					    		'fields'		=> array( 'number_position' ),
					    	),
					    ),
					),
					'number_type' => array(
					    'type'          => 'select',
					    'label'         => __( 'Number Type', 'uabb' ),
					    'default'       => 'standard',
					    'options'       => array(
					    	'percent'		=> __( 'Percent', 'uabb' ),
					    	'standard'		=> __( 'Standard', 'uabb' ),
					    ),
					    'toggle'		=> array(
					    	'standard'		=> array(
					    		'fields'		=> array( 'number_prefix', 'number_suffix' )
					    	),
					    ),
					),
					'number' => array(
						'type'          => 'text',
						'label'         => __('Number', 'uabb'),
						'size'          => '5',
						'placeholder'	=> '100',
						'help'			=> 'Enter counter value'
					),
					'max_number' => array(
						'type'          => 'text',
						'label'         => __('Total', 'uabb'),
						'size'          => '5',
						'help'			=> __( 'The total number of units for this counter. For example, if the Number is set to 250 and the Total is set to 500, the counter will animate to 50%.', 'uabb' ),
					),
					'number_position'	=> array(
						'type'          => 'select',
						'label'         => __('Number Position', 'uabb'),
						'size'          => '5',
						'help'			=> __( 'Where to display the number in relation to the bar.', 'uabb' ),
						'default'		=> 'default',
						 'options'       => array(
						 	'none'		=> __( 'None', 'uabb' ),
					    	'default'	=> __( 'Inside Bar', 'uabb' ),
					    	'above'		=> __( 'Above Bar', 'uabb' ),
					    	'below'		=> __( 'Below Bar', 'uabb' ),
					    ),
					),
					'before_number_text' => array(
						'type'          => 'text',
						'label'         => __('Text Before Number', 'uabb'),
						'size'          => '20',
						'help'			=> __( 'Text to appear above the number. Leave it empty for none.', 'uabb' )
					),
					'after_number_text' => array(
						'type'          => 'text',
						'label'         => __('Text After Number', 'uabb'),
						'default'       => __('Years', 'uabb'),
						'size'          => '20',
						'help'			=> __( 'Text to appear after the number. Leave it empty for none.', 'uabb' )
					),
					'number_prefix' => array(
						'type'          => 'text',
						'label'         => __('Number Prefix', 'uabb'),
						'size'          => '10',
						'help'			=> __( 'For example, if your number is US$ 10, your prefix would be "US$ ".', 'uabb' )
					),
					'number_suffix' => array(
						'type'          => 'text',
						'label'         => __('Number Suffix', 'uabb'),
						'size'          => '10',
						'help'			=> __( 'For example, if your number is 10%, your prefix would be "%".', 'uabb' )
					),
				)
			),
			/* Separator Settings */
			'separator'       => array( // Section
				'title'         => __('Separator ( Below Number )','uabb'), // Section Title
				'fields'        => array( // Section Fields
					'show_separator' => array(
					    'type'          => 'select',
					    'label'         => __( 'Show separator', 'uabb' ),
					    'default'       => 'no',
					    'options'       => array(
					        'yes'      => __( 'Yes', 'uabb' ),
					        'no'      => __( 'No', 'uabb' )
					    ),
					    'toggle'        => array(
					        'yes'      => array(
					            'fields'        => array( 'separator_color', 'separator_height', 'separator_width', 'separator_style', 'separator_top_margin', 'separator_bottom_margin' ),
					            'sections'		=> array( 'seprator_margin_style' )
					        ),
					        'no'      => array()
					    )
					),
					'separator_style' => array(
						'type'          => 'select',
						'label'         => __( 'Style', 'uabb' ),
						'default'       => 'solid',
						'options'       => array(
							'solid'		=> __( 'Solid', 'uabb' ),
							'dashed'		=> __( 'Dashed', 'uabb' ),
							'dotted'		=> __( 'Dotted', 'uabb' ),
							'double'		=> __( 'Double', 'uabb' ),
						),
						'help'         	=> __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
					),
					'separator_color'    => array( 
						'type'       => 'color',
                    	'label'         => __('Separator Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
                    	'preview'      => array(
					        'type'         	=> 'css',
					        'selector'		=> '.uabb-separator',
					        'property'		=> 'border-top-color'
					    )
					),
					'separator_height' => array(
						'type'          => 'text',
						'label'         => __('Thickness', 'uabb'),
						'size'          => '5',
						'placeholder'	=> '1',
						'description'   => 'px',
						'help'         	=> __( 'Adjust thickness of border.', 'uabb' ),
					),
					'separator_width' => array(
						'type'          => 'text',
						'label'         => __('Width', 'uabb'),
						'size'          => '5',
						'placeholder'	=> '100',
						'description'   => '%',
					),
					'separator_alignment' => array(
					    'type'          => 'select',
					    'label'         => __( 'Alignment', 'uabb' ),
					    'default'       => 'inherit',
					    'options'       => array(
					    	'inherit'	=> __( 'Default', 'uabb' ),
					    	'left'		=> __( 'Left', 'uabb' ),
					    	'right'		=> __( 'Right', 'uabb' ),
					    	'center'	=> __( 'Center', 'uabb' ),
					    ),
					),
				)
			),
			'animation'       => array( // Section
				'title'         => __('Animation','uabb'), // Section Title
				'fields'        => array( // Section Fields
					'animation_speed' => array(
						'type'          => 'text',
						'label'         => __('Animation Speed', 'uabb'),
						'size'          => '5',
						'placeholder'	=> '1',
						'description'	=> __( 'second(s)', 'uabb' ),
						'help'			=> __( 'Number of seconds to complete the animation.', 'uabb' )
					),
					'delay' 		 => array(
						'type'          => 'text',
						'label'         => __('Animation Delay', 'uabb'),
						'size'          => '5',
						'placeholder'	=> '1',
						'description'	=> __( 'second(s)', 'uabb' )
					),
				)
			),
		)
	),
	'imageicon' => array(
		'title'         => __('Image / Icon', 'uabb'),
		'sections'      => array(
			'type_general' 		=> array( // Section
		        'title'         => __('Image / Icon', 'uabb'), // Section Title
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
					),
					'photo_url'     => array(
						'type'          => 'text',
						'label'         => __('Photo URL', 'uabb'),
						'placeholder'   => 'http://www.example.com/my-photo.jpg',
					),
					'img_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'uabb'),
						'placeholder'   => '150',
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
					),
				)
			),
			'icon_style'	=> 	array(
		        'title'           => __('Style', 'uabb'),
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
		        'title'         => __('Style', 'uabb'),
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
	'style'         => array( // Tab
		'title'         => __('Style', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
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
						'toggle'			=> array(
							'above-title'	=> array(
								'fields'	=> array( 'align' ),
							),
							'below-title'	=> array(
								'fields'	=> array( 'align' ),
							)
						)
					),
					'circle_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'uabb'),
						'default'       => 'above-title',
						'options'       => array(
							'above-title'   => __('Above Heading', 'uabb'),
							'below-title'   => __('Below Heading', 'uabb'),
						)
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Overall Alignment', 'uabb'),
						'default'       => 'center',
						'options'       => array(
							'center'        => __('Center', 'uabb'),
							'left'          => __('Left', 'uabb'),
							'right'         => __('Right', 'uabb')
						),
					),
				)
			),
			'margin_style'    => array(
				'title'         => __('Number Margins', 'uabb'),
				'fields'        => array(
					'number_top_margin' => array(
						'type'          => 'text',
						'label'         => __('Number Top Margin', 'uabb'),
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					),
					'number_bottom_margin' => array(
						'type'          => 'text',
						'label'         => __('Number Bottom Margin', 'uabb'),
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					),
				)
			),
			'seprator_margin_style'    => array(
				'title'         => __('Separator Margins', 'uabb'),
				'fields'        => array(
					'separator_top_margin' => array(
						'type'          => 'text',
						'label'         => __('Separator Top Margin', 'uabb'),
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					),
					'separator_bottom_margin' => array(
						'type'          => 'text',
						'label'         => __('Separator Bottom Margin', 'uabb'),
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					),
				)
			),
			'img_icon_margins' => array(
				'title'         => __( 'Image / Icon Margins', 'uabb' ),
				'fields'        => array(
					'img_icon_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Top', 'uabb'),
						'placeholder'		=> '',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
					),
					'img_icon_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Bottom', 'uabb'),
						'placeholder'		=> '',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
					)
				)
			),
			'circle_bar_style'    => array(
				'title'         => __('Circle Bar Styles', 'uabb'),
				'fields'        => array(
					'circle_width' => array(
						'type'          => 'text',
						'label'         => __('Circle Size', 'uabb'),
						'placeholder'   => '300',
						'maxlength'     => '4',
						'size'          => '4',
						'description'   => 'px',
					),
					'circle_dash_width' => array(
						'type'          => 'text',
						'label'         => __('Circle Stroke Size', 'uabb'),
						'placeholder'   => '10',
						'maxlength'     => '2',
						'size'          => '4',
						'description'   => 'px',
					    /*'preview'      => array(
					        'type'         => 'css',
					        'selector'     => '.svg circle',
					        'property'     => 'stroke-width',
					        'unit'		   => 'px'
					    )*/
					),

					'circle_color'    => array( 
						'type'       => 'color',
                    	'label'         => __('Circle Foreground Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
                    'circle_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
					'circle_bg_color'    => array( 
						'type'       => 'color',
                    	'label'      => __('Circle Background Color', 'uabb'),
                    	'default'	 => 'fafafa',
						'show_reset' => true,
					),
                    'circle_bg_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
				)
			),
			'bar_style'    => array(
				'title'         => __('Bar Styles', 'uabb'),
				'fields'        => array(
					'bar_color'    => array( 
						'type'       => 'color',
                        'label'         => __('Bar Foreground Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
                    'bar_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
					'bar_bg_color'    => array( 
						'type'       => 'color',
                    	'label'      => __('Bar Background Color', 'uabb'),
                    	'default'	 => 'fafafa',
						'show_reset' => true,
					),
                    'bar_bg_color_opc'    => array( 
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
	),
	'typography'	=> array(
		'title'			=> __('Typography', 'uabb'),
		'sections'		=> array(
			'number_typography' => array(
				'title' => __('Number Text', 'uabb' ),
                'fields'    => array(
                    'num_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h2',
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
                    'num_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-number-string'
                    	),
                    ),
                    'num_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'num_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'num_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
			'ba_text_typography' => array(
				'title' => __('Before - After Text', 'uabb' ),
                'fields'    => array(
                    'ba_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-number-before-text, .uabb-number-after-text'
                    	),
                    ),
                    'ba_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'ba_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'ba_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
		)
	)
));
