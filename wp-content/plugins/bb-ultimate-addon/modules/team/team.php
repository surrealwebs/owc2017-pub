<?php

/**
 * @class UABBTeamModule
 */
class UABBTeamModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Team', 'uabb'),
			'description'   	=> __('A Team module to show team member.', 'uabb'),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/team/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/team/',
            'partial_refresh'	=> true
		));
	}
	

	/**
	 * @method render_image
	 */
	public function render_image()
	{
		if( isset( $this->settings->photo_src ) && $this->settings->photo_src != '' ) {
			/* Render Team Member Image */
			$imageicon_array = array(

			    /* General Section */
			    'image_type' => 'photo',
			 
			    /* Icon Basics */
			    'icon' => '',
			    'icon_size' => '',
			    'icon_align' => '',
			 
			    /* Image Basics */
			    'photo_source' => $this->settings->photo_source,
			    'photo' => $this->settings->photo,
			    'photo_url' => $this->settings->photo_url,
			    'img_size' => $this->settings->img_size,
			    'img_align' => '',
			    'photo_src' => ( isset( $this->settings->photo_src ) ) ? $this->settings->photo_src : '' ,
			 	
			 	/* Icon Style */
			    'icon_style' => '',
			    'icon_bg_size' => '',
			    'icon_border_style' => '',
			    'icon_border_width' => '',
			    'icon_bg_border_radius' => '',
			 	
			 	/* Image Style */
			    'image_style' => $this->settings->image_style,
			    'img_bg_size' => '',// $this->settings->img_bg_size,
			    'img_border_style' => '', // $this->settings->img_border_style,
			    'img_border_width' => '', // $this->settings->img_border_width,
			    'img_bg_border_radius' => '', // $this->settings->img_bg_border_radius,
			); 
			
			/* Render HTML Function */
			echo ( isset( $this->settings->enable_custom_link ) && $this->settings->enable_custom_link != 'no' ) ? '<a href="' . $this->settings->custom_link . '" target ="' . $this->settings->custom_link_target . '">' : '';
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			echo ( isset( $this->settings->enable_custom_link ) && $this->settings->enable_custom_link != '' ) ? '</a>' : '';
		}
	}


	/**
	 * @method Render Name
	 */
	public function render_name()
	{
		if ( !empty( $this->settings->name ) ) {
			$output  = '<div class="uabb-team-name" >';
			$output .= '<'.$this->settings->tag_selection.' class="uabb-team-name-text">';
			$output .= ( isset( $this->settings->enable_custom_link ) && $this->settings->enable_custom_link != 'no' ) ? '<a href="' . $this->settings->custom_link . '" target ="' . $this->settings->custom_link_target . '" '. BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->custom_link_target, 0, 0 ) .'>' . $this->settings->name . '</a>' : $this->settings->name;
			$output .= '</'.$this->settings->tag_selection.'>';
			$output .= '</div>';
			echo $output;
		}
	}
	
	/**
	 * @method Render Designation
	 */
	public function render_desgn()
	{
		if ( !empty( $this->settings->designation ) ) {
			$output  = '<div class="uabb-team-desgn">';
			$output .= '<span class="uabb-team-desgn-text">'.$this->settings->designation.'</span>';
			$output .= '</div>';
			echo $output;
		}
	}
	
	/**
	 * @method Render Desc
	 */
	public function render_desc()
	{
		if ( !empty( $this->settings->description ) ) {
			$output  = '<div class="uabb-team-desc">';
			$output .= '<span class="uabb-team-desc-text">'.$this->settings->description.'</span>';
			$output .= '</div>';
			echo $output;
		}
	}

	/**
	 * @method render_social_icons
	 */
	public function render_social_icons()
	{	
		if ( $this->settings->enable_social_icons == 'yes'  ) {
			$icon_count = 1;
			foreach( $this->settings->icons as $icon ) {

				if(!is_object($icon)) {
					continue;
				}
				$icon->link_target = ( isset( $icon->link_target ) ) ? $icon->link_target : '_blank';
				echo '<a class="uabb-team-icon-link uabb-team-icon-'.$icon_count.'" href="'.$icon->link.'" target="' . $icon->link_target . '" '. BB_Ultimate_Addon_Helper::get_link_rel( $icon->link_target, 0, 0 ) .'>';
				$imageicon_array = array(

				  /* General Section */
				  'image_type' 	=> 'icon',

				  /* Icon Basics */
				  'icon' 		=> $icon->icon,
				  'icon_size' 	=> $this->settings->icon_size,
				  'icon_align' 	=> 'center',

				  /* Image Basics */
				  'photo_source' 	=> '',
				  'photo' 			=> '',
				  'photo_url' 		=> '',
				  'img_size' 		=> '',
				  'img_align' 		=> '',
				  'photo_src' 		=> '' ,

				  /* Icon Style */
				  'icon_style' 				=> $this->settings->icon_style,
				  'icon_bg_size' 			=> $this->settings->icon_bg_size,
				  'icon_border_style' 		=> $this->settings->icon_border_style,
				  'icon_border_width' 		=> $this->settings->icon_border_width,
				  'icon_bg_border_radius' 	=> $this->settings->icon_bg_border_radius,

				  /* Image Style */
				  'image_style' 			=> '',
				  'img_bg_size' 			=> '',
				  'img_border_style' 		=> '',
				  'img_border_width' 		=> '',
				  'img_bg_border_radius' 	=> '',

				  /* Preset Color variable new */
				  'icon_color_preset' => $this->settings->icon_color_preset, 
				  
				  /* Icon Colors */
				  'icon_color' 				=> ( !empty($icon->icocolor) ) ? $icon->icocolor : $this->settings->icon_color,
				  'icon_hover_color' 		=> ( !empty($icon->icohover_color) ) ? $icon->icohover_color : $this->settings->icon_hover_color,
				  'icon_bg_color' 			=> ( !empty($icon->icobg_color) ) ? $icon->icobg_color : $this->settings->icon_bg_color,
				  'icon_bg_hover_color' 	=> ( !empty($icon->icobg_hover_color) ) ? $icon->icobg_hover_color : $this->settings->icon_bg_hover_color,
				  'icon_border_color' 		=> ( !empty($icon->icoborder_color) ) ? $icon->icoborder_color : $this->settings->icon_border_color,
				  'icon_border_hover_color' => ( !empty($icon->icoborder_hover_color) ) ? $icon->icoborder_hover_color : $this->settings->icon_border_hover_color,
				  'icon_three_d' 			=> $this->settings->icon_three_d,

				  /* Image Colors */
				  'img_bg_color' 			=> '',
				  'img_bg_hover_color' 		=> '',
				  'img_border_color' 		=> '',
				  'img_border_hover_color' 	=> '',
				);
				FLBuilder::render_module_html('image-icon', $imageicon_array);
				echo '</a>';
				$icon_count = $icon_count + 1 ;
			}
		}
	}

	/**
	 * @method render_button
	 */
	public function render_separator( $pos ) {

		if( $this->settings->enable_separator == 'block' && ($pos == $this->settings->separator_pos) )
		{
			$separator_settings = array(
				'color'			=> $this->settings->separator_color,
				'height'		=> $this->settings->separator_height,
				'width'			=> $this->settings->separator_width,
				'alignment'		=> $this->settings->separator_alignment,
				'style'			=> $this->settings->separator_style
			);

			echo '<div class="uabb-team-separator">';
			FLBuilder::render_module_html('uabb-separator', $separator_settings);
			echo '</div>';
		}		
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBTeamModule', array(
	'imageicon' => array(
		'title'         => __('Image', 'uabb'),
		'sections'      => array(
			 
			
			/* Image Basic Setting */
			'img_basic'	=> 	array( // Section
                'title'         => __('Image Basics','uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'photo_source'  => array(
                        'type'          => 'select',
						'label'         => __( 'Member Image Source', 'uabb' ),
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
						'label'         => __( 'Member Image', 'uabb' ),
                        'show_remove'   => true,
                        'connections' => array( 'photo' )
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
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-image .uabb-photo-img',
                            'property'      => 'width',
                            'unit'			=> 'px'
                        )
                    ),
                )
            ),
			'img_styles'		=> array(
				'title'		 => __('Image Style', 'uabb' ),
				'fields'	 => array(
					'image_style'	=> array(
						'type'   		=> 'select',
						'label'  		=> __('Image Type', 'uabb'),
						'default'		=> 'simple',
						'help'			=> __('Circle and Square style will crop your image in 1:1 ratio','uabb'),
						'options'		=> array(
							'simple'		=> __('Simple', 'uabb'),
							'circle'		=> __('Circle', 'uabb'),
							'square'		=> __('Square', 'uabb'),
						),
						'class'			=> 'uabb-image-icon-style',
					),
					'img_spacing'		=> array(
						'type'          => 'uabb-spacing',
			            'label'         => __( 'Image Section Padding', 'uabb' ),
			            'mode'			=> 'padding',
			            'default'       => 'padding: 0px;', // Optional
			            'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-team-image',
                            'property'      => 'padding',
                            'unit'			=> 'px'
                        )
					),
					'img_bg_color'    => array( 
						'type'       => 'color',
                    	'label'      => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
                    	'help'		 => __('For Image with padding, you can give background color for styling', 'uabb'),
                    	'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-team-image',
                            'property'      => 'background',
                        )
					),
                    'img_bg_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                    'photo_style' => array(
						'type'          => 'select',
		                'label'         => __( 'Image Style', 'uabb' ),
		                'default'       => 'simple',
		                'options'       => array(
		                 	'simple'			=> __('Simple','uabb'),
							'grayscale'			=> __('Grayscale','uabb'),
		                ),
		                'toggle'		 => array(
		                    'simple'				=> array(
		                        'fields'		=> array( 'img_grayscale_simple' )
		                    ),
		                    'grayscale'			=> array(
		                        'fields'		=> array( 'img_grayscale_grayscale' ),
		                    )
		                )
					),
					'img_grayscale_simple' => array(
						'type'          => 'select',
		                'label'         => __( 'Image Hover Effect', 'uabb' ),
		                'default'       => 'no',
		                'options'       => array(
		                 	'yes'			=> __('Simple', 'uabb'),
							'color_gray'	=> __('Grayscale on Hover', 'uabb'),
		                ),
					),
					'img_grayscale_grayscale' => array(
						'type'          => 'select',
		                'label'         => __( 'Image Hover Effect', 'uabb' ),
		                'default'       => 'no',
		                'options'       => array(
		                 	'yes'			=> __('Simple','uabb'),
							'gray_color'	=> __('Color on Hover', 'uabb'),
		                ),
					),
				),
			)
		)
	),
	'team_text'         => array(
		'title'         => __('Information', 'uabb'),
		'sections'      => array(
			'member_info' => array(
				'title'         => __('Member Information', 'uabb'),
				'fields'        => array(
					'name'         => array(
						'type'          => 'text',
						'label'         => __('Name', 'uabb'),
						'default'		=> __('John Doe', 'uabb'),
						'connections' => array( 'string', 'html' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-team-name-text'
						)
					),
					'designation'	=> array(
						'type'          => 'text',
						'label'         => __('Designation', 'uabb'),
						'default'       => __('CEO, Example Inc.', 'uabb'),
						'connections' => array( 'string', 'html' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-team-desgn-text',
						)
					),
					'description'	=> array(
						'type'          => 'textarea',
						'label'         => __('Description', 'uabb'),
						'default'         => __('Use this space to tell a little about your team member. Make it interesting by mentioning his expertise, achievements, interests, hobbies and more.', 'uabb'),
						'rows'          => '5',
						'connections' => array( 'string', 'html' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-team-desc-text',
						)
					),
				)
			),
			'text_style' => array(
				'title'         => __('Content Style', 'uabb'),
				'fields'        => array(
					'text_spacing'		=> array(
						'type'          => 'uabb-spacing',
                        'label'         => __( 'Padding', 'uabb' ),
                        'mode'			=> 'padding',
                        'default'       => 'padding: 15px;', // Optional
                        'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-team-content',
							'property'		=> 'padding',
							'unit'			=> 'px',
						)
					),
					'text_bg_color'    => array( 
						'type'       => 'color',
                    	'label'      => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-team-content',
							'property'		=> 'background',
						)
					),
                    'text_bg_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                    'text_alignment' => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'center',
						'help'			=> __('Overall Content Alignment', 'uabb'),
						'options'       => array(
							'center'		=> __( 'Center', 'uabb' ),
							'left'			=> __( 'Left', 'uabb' ),
							'right'			=> __( 'Right', 'uabb' )
						),
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-team-content, .uabb-team-social',
                            'property'      => 'text-align',
                        )
					),
					'module_border_radius'	=> array(
						'type'          => 'text',
						'label'         => __('Box Radius', 'uabb'),
						'placeholder'   => '0',
						'maxlength'     => '3',
						'size'          => '6',
						'description'   => 'px',
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-team-wrap',
                            'property'      => 'border-radius',
                            'unit'			=> 'px'
                        )
					),
				)
			),
			'cta'       => array( // Section
				'title'         => __('Custom Link', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'enable_custom_link' =>	array(
		                'type'          => 'uabb-toggle-switch',
		                'label'         => __( 'Enable Custom Link', 'uabb' ),
		                'default'       => 'no',
		                'options'       => array(
		                 	'yes'		=> 'Yes',
		                  	'no'		=> 'No',
		                ),
		                'help' => __('Add a custom link to employee page','uabb'),
		                'toggle'	=> array(
		                	'yes'	=> array(
		                		'fields'	=> array( 'custom_link', 'custom_link_target' )
		                	)
		                )
		            ),
					'custom_link'          => array(
                        'type'          => 'link',
                        'label'         => __('Link', 'uabb'),
                        'placeholder'   => 'http://www.example.com',
                        'connections' => array( 'url' )
                    ),
                    'custom_link_target' => array(
                        'type'          => 'select',
                        'label'         => __('Target', 'uabb'),
                        'default'       => '',
                        'options'       => array(
                            '_blank'        => __('New Page', 'uabb'),
                            ''              => __('Same Page', 'uabb'),
                        ),
                    )
				)
			),
			'separator'       => array( // Section
				'title'         => __('Separator', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'enable_separator'	=> array(
		                'type'			=> 'select',
		                'label'			=> __('Separator', 'uabb'),
		                'default'		=> 'block',
		                'options'		=> array(
		                    'none'			=> __( 'No', 'uabb' ),
		                    'block' 		=> __( 'Yes', 'uabb' )
		                ),
		                'toggle'		 => array(
		                    'none'				=> array(
		                        'fields'		=> array()
		                    ),
		                    'block'			=> array(
		                        'fields'		=> array( 'separator_pos','separator_color', 'separator_height', 'separator_style', 'separator_width', 'separator_alignment','separator_margin_top', 'separator_margin_bottom' ),
		                        'sections'		=> array( 'separator_margins')
		                    )
		                )
					),
					'separator_pos'	=> array(
						'type'          => 'select',
						'label'         => __('Position', 'uabb'),
						'default'       => 'below_desg',
						'options'       => array(
							'below_name'	=> __( 'Below Name', 'uabb' ),
							/*'below_image'	=> __( 'Below Image', 'uabb' ),*/
							'below_desg'    => __( 'Below Designation', 'uabb' ),
							'below_desc'   => __( 'Below Description', 'uabb' )
						),
					),
					'separator_style'	=> array(
						'type'          => 'select',
						'label'         => __('Style', 'uabb'),
						'default'       => 'solid',
						'options'       => array(
							'solid'         => __( 'Solid', 'uabb' ),
							'dashed'        => __( 'Dashed', 'uabb' ),
							'dotted'        => __( 'Dotted', 'uabb' ),
							'double'        => __( 'Double', 'uabb' )
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'border-top-style'
						),
						'help'          => __('The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb'),
					),
					'separator_color'    => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'border-top-color'
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
					'separator_width'	=> array(
						'type'          => 'text',
						'label'         => __('Width', 'uabb'),
						'placeholder'   => '100',
						'maxlength'     => '3',
						'size'          => '5',
						'description'   => '%'
					),
					'separator_alignment' => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'inherit',
						'options'       => array(
							'inherit'		=> __( 'Default', 'uabb'),
							'center'		=> __( 'Center', 'uabb' ),
							'left'			=> __( 'Left', 'uabb' ),
							'right'			=> __( 'Right', 'uabb' )
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator-parent',
							'property'      => 'text-align'
						),
					),
					'separator_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Margin Top', 'uabb'),
						'placeholder'		=> '10',
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
						'label'             => __('Margin Bottom', 'uabb'),
						'placeholder'		=> '10',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.uabb-separator',
							'property'      => 'margin-bottom',
							'unit'          => 'px'
						),
					),
				)
			),
		)
	),
	
	'social_links_section'           => array(
		'title'         => __('Social Links', 'uabb'),
		'sections'      => array(
			'social_icons_switch'     => array(
				'title'         => '',
				'fields'        => array(
					'enable_social_icons' =>	array(
		                'type'          => 'uabb-toggle-switch',
		                'label'         => __( 'Enable Social Icons', 'uabb' ),
		                'default'       => 'yes',
		                'options'       => array(
		                 	'yes'		=> 'Yes',
		                  	'no'		=> 'No',
		                ),
		                'toggle'	=> array(
		                	'yes'	=> array(
		                		'sections'	=> array( 'social_links', 'icon_basic', 'icon_style', 'icon_colors' )
		                	)
		                )
		            )
	            )
            ),
			'social_links'           => array(
				'title'         => __( 'Social Icons', 'uabb'),
				'fields'        => array(
					'icons'         => array(
						'type'          => 'form',
						'label'         => __('Icon', 'uabb'),
						'form'          => 'uabb_social_icon_form', // ID from registered form below
						'preview_text'  => 'icon', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			),
			'icon_basic'		=>	array( // Section
                'title'         => __('Icon Basics','uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'icon_size'     => array(
                        'type'          => 'text',
                        'label'         => __('Size', 'uabb'),
                        'placeholder'   => '30',
                        'maxlength'     => '5',
                        'size'          => '6',
                        'description'   => 'px',
                    ),
					'spacing'       => array(
						'type'          => 'text',
						'label'         => __('Spacing Between Icons', 'uabb'),
						'placeholder'   => '10',
						'maxlength'     => '2',
						'size'          => '6',
						'description'   => 'px'
					),
                )
            ),
			'icon_style'		=> 	array(
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
			'icon_colors'		=> 	array( // Section
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
		)
	),
	'typography'         => array(
		'title'         => __('Typography', 'uabb'),
		'sections'      => array(
			'name_typography'    =>  array(
				'title' => __('Name', 'uabb' ),
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
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-team-name-text'
                    	),
                    ),
                    'font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-name-text, .uabb-team-name-text a',
                            'property'	=> 'font-size',
                            'unit'		=> 'px',
                    	),
                    ),
                    'line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-name-text',
                            'property'	=> 'line-height',
                            'unit'		=> 'px',
                    	),
                    ),
                    'color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-name-text, .uabb-team-name-text a',
                            'property'	=> 'color',
                    	),
                    ),
                    'name_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Margin Top', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-name-text',
                            'property'	=> 'margin-top',
                            'unit'		=> 'px'
                    	),
					),
					'name_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Margin Bottom', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-name-text',
                            'property'	=> 'margin-bottom',
                            'unit'		=> 'px'
                    	),
					),
                )
            ),
			'desg_typography'    =>  array(
				'title' => __('Designation', 'uabb' ),
                'fields'    => array(
                    'desg_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-team-desgn-text'
                    	),
                    ),
                    'desg_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desgn-text',
                            'property'	=> 'font-size',
                            'unit'		=> 'px',
                    	),
                    ),
                    'desg_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desgn-text',
                            'property'	=> 'line-height',
                            'unit'		=> 'px',
                    	),
                    ),
                    'desg_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desgn-text',
                            'property'	=> 'color',
                    	),
                    ),
                    'desg_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Margin Top', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desgn-text',
                            'property'	=> 'margin-top',
                            'unit'		=> 'px'
                    	),
					),
					'desg_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Margin Bottom', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desgn-text',
                            'property'	=> 'margin-bottom',
                            'unit'		=> 'px'
                    	),
					),
                )
            ),
			'desc_typography'    =>  array(
                'title' => __('Description', 'uabb' ),
                'fields'    => array(
                    'desc_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> '.uabb-team-desc-text'
                    	),
                    ),
                    'desc_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desc-text',
                            'property'	=> 'font-size',
                            'unit'		=> 'px'
                    	),
                    ),
                    'desc_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desc-text',
                            'property'	=> 'line-height',
                            'unit'		=> 'px'
                    	),
                    ),
                    'desc_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desc-text',
                            'property'	=> 'color',
                    	),
                    ),
                    'desc_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Margin Top', 'uabb'),
						'placeholder'		=> '0',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desc-text',
                            'property'	=> 'margin-top',
                            'unit'		=> 'px',
                    	),
					),
					'desc_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Margin Bottom', 'uabb'),
						'placeholder'       => '15',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> '.uabb-team-desc-text',
                            'property'	=> 'margin-bottom',
                            'unit'		=> 'px',
                    	),
					),
                )
            ),
		)
	)
));


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('uabb_social_icon_form', array(
	'title' => __('Add Icon', 'uabb'),
	'tabs'  => array(
		'general'       => array( // Tab
			'title'         => __('General', 'uabb'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array( // Section
					'title'         => '', // Section Title
					'fields'        => array( // Section Fields
						'icon'          => array(
							'type'          => 'icon',
							'label'         => __( 'Icon', 'uabb' ),
							'show_remove'	=> true,
							'default' 		=> 'ua-icon ua-icon-linkedin-with-circle'
						),
						'link'          => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' )
						),
						'link_target'   => array(
	                        'type'          => 'select',
	                        'label'         => __('Link Target', 'uabb'),
	                        'help'          => __( 'Controls where link will open after click.', 'uabb' ),
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
		'style'         => array( // Tab
			'title'         => __('Style', 'uabb'), // Tab title
			'sections'      => array( // Tab Sections
				'message'        => array( // Section
					'title'         => '', // Section Title
					'fields'        => array( // Section Fields
						'social_message' => array(
							'type'     => 'uabb-msgbox',
							'msg-type' => 'info',
							'content'  => 'Below Background / Border color properties will work only when Icon background style is not simple.',
						),
					)
				),
				'colors'        => array( // Section
					'title'         => __('Colors', 'uabb'), // Section Title
					'fields'        => array( // Section Fields
						'icocolor'    => array( 
							'type'       => 'color',
							'label'      => __('Color', 'uabb'),
							'default'    => '',
							'show_reset' => true,
						),
						'icohover_color'    => array( 
							'type'       => 'color',
					    	'label'      => __('Hover Color', 'uabb'),
							'default'    => '',
							'show_reset' => true,
						),
						'icobg_color'    => array( 
							'type'       => 'color',
					    	'label'      => __('Background Color', 'uabb'),
							'default'    => '',
							'show_reset' => true,
						),
						'icobg_color_opc'    => array( 
							'type'        => 'text',
							'label'       => __('Opacity', 'uabb'),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'icobg_hover_color'    => array(
							'type'       => 'color',
					    	'label'         => __('Background Hover Color', 'uabb'),
							'default'    => '',
							'show_reset' => true,
					    	'preview'       => array(
								'type'          => 'none'
							)
						),
						'icobg_hover_color_opc'    => array( 
							'type'        => 'text',
							'label'       => __('Opacity', 'uabb'),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
					    	'preview'       => array(
								'type'          => 'none'
							)
						),
						'icoborder_color'    => array( 
							'type'       => 'color',
					    	'label'      => __('Border Color', 'uabb'),
							'default'    => '',
							'show_reset' => true,
						),

						'icoborder_hover_color'    => array( 
							'type'       => 'color',
					    	'label'         => __('Border Hover Color', 'uabb'),
							'default'    => '',
							'show_reset' => true,
					    	'preview'       => array(
								'type'          => 'none'
							)
						),
					)
				)
			)
		)
	)
));
