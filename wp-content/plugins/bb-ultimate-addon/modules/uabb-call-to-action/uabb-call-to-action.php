<?php

/**
 * @class UABBCtaModule
 */
class UABBCtaModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Call to Action', 'uabb'),
			'description'   => __('Display a heading, subheading and a button.', 'uabb'),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
            'group'         => UABB_CAT,
			'dir'           => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-call-to-action/',
            'url'           => BB_ULTIMATE_ADDON_URL . 'modules/uabb-call-to-action/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'  => true,
            'icon'             => 'megaphone.svg',
		));
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'uabb-cta-wrap uabb-cta-' . $this->settings->layout;

		if($this->settings->layout == 'stacked') {
			$classname .= ' uabb-cta-' . $this->settings->alignment;
		}

		return $classname;
	}

	/**
	 * @method render_button
	 */
	public function render_button()
	{
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
            'align'              => '',
            'mob_align'          => '',

            /* Typography */
            'font_size'         => $this->settings->btn_font_size,
            'line_height'       => $this->settings->btn_line_height,
            'font_family'       => $this->settings->btn_font_family,
		);

		FLBuilder::render_module_html('uabb-button', $btn_settings);
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBCtaModule', array(
	'general'       => array(
		'title'         => __('General', 'uabb'),
		'sections'      => array(
			'title'         => array(
				'title'         => '',
				'fields'        => array(
					'title'         => array(
						'type'          => 'text',
						'label'         => __('Title', 'uabb'),
						'default'       => __('Call To Action', 'uabb'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-cta-title'
						),
                        'connections'   => array( 'string', 'html' )
					)
				)
			),
			'text'          => array(
				'title'         => __('Description', 'uabb'),
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'			=> 8,
						'default'       => __('Enter description text here.', 'uabb'),
                        'connections'   => array( 'string', 'html' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-cta-text-content'
						)
					)
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'uabb'),
		'sections'      => array(
			'structure'     => array(
				'title'         => __('Structure', 'uabb'),
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'uabb'),
						'default'       => 'stacked',
						'options'       => array(
							'inline'        => __('Inline', 'uabb'),
							'stacked'       => __('Stacked', 'uabb')
						),
						'toggle'        => array(
							'inline'		=> array(
								'sections'		=> array( 'inline_btn_structure' )
							),
							'stacked'       => array(
								'fields'        => array( 'alignment' ),
								'sections'		=> array( 'btn_structure' )
							)
						)
					),
					'alignment'     => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'center',
						'help'          => __( 'This is the overall content alignment', 'uabb'),
						'options'       => array(
							'left'      =>  __('Left', 'uabb'),
							'center'    =>  __('Center', 'uabb'),
							'right'     =>  __('Right', 'uabb')
						),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-cta-left',
                            'property'      => 'text-align',
                        )
					),
					'spacing'       => array(
						'type'          => 'text',
						'label'         => __('Spacing', 'uabb'),
						'placeholder'   => '0',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'help'			=> __('Apply padding to your element from all sides.','uabb'),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-module-content',
							'property'      => 'padding',
							'unit'          => 'px'
						)
					),
					'bg_color'    => array( 
						'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.fl-module-content',
                            'property'      => 'background',
                        )
					),
                    'bg_color_opc'    => array( 
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
	//'button' => BB_Ultimate_Addon_Helper::uabb_object_get( 'button' ),
	'button'        => array(
		'title'         => __('Button', 'uabb'),
		'sections'      => array(
			'btn-general'    => array( // Section
		        'title'         => __( 'General', 'uabb' ),
		        'fields'        => array(
		            'btn_text'          => array(
		                'type'          => 'text',
		                'label'         => __('Text', 'uabb'),
		                'default'       => __('Click Here', 'uabb'),
                        'connections'   => array( 'string', 'html' ),
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
                        'connections'   => array( 'url' )
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
                        'help'          => __('Enable this to make this link nofollow', 'uabb'),
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
                    'btn_transparent_button_options'         => array(
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
                            'property'      => 'color'
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
                            'property'      => 'background'
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
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a',
                            'property'      => 'width',
                            'unit'          => 'px'
                        )
                    ),
                    'btn_custom_height'  => array(
                        'type'          => 'text',
                        'label'         => __('Custom Height', 'uabb'),
                        'default'       => '45',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a',
                            'property'      => 'height',
                            'unit'          => 'px'
                        )
                    ),
                    'btn_padding_top_bottom'       => array(
                        'type'          => 'text',
                        'label'         => __('Padding Top/Bottom', 'uabb'),
                        'placeholder'   => '0',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
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
                                    'selector'     => '.selector-1',
                                    'property'     => 'padding-top',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'     => '.selector-2',
                                    'property'     => 'padding-bottom',
                                    'unit'          => 'px'
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
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a',
                            'property'      => 'border-radius',
                            'unit'          => 'px'
                        )
                    ),
                )
            ),
		)
	),
	'typography'         => array(
		'title'         => __('Typography', 'uabb'),
		'sections'      => array(
			'title_typography'    =>  array(
				'title' => __('Title', 'uabb' ),
                'fields'    => array(
                    'title_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Title Tag', 'uabb'),
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
                    'title_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-cta-title'
                        )
                    ),
                    'title_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-cta-title',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    'title_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-cta-title',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    'title_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-cta-title',
                            'property'        => 'color',
                        )
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
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-cta-text-content p'
                        )
                    ),
                    'subhead_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'        => 'css',
                            'selector'    => '.uabb-cta-text-content p',
                            'property'    => 'font-size',
                            'unit'        =>  'px'
                        )
                    ),
                    'subhead_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'        => 'css',
                            'selector'    => '.uabb-cta-text-content p',
                            'property'    => 'line-height',
                            'unit'        => 'px'
                        )
                    ),
                    'subhead_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Description Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'        => 'css',
                            'selector'    => '.uabb-cta-text-content p',
                            'property'    => 'color',
                        )
                    ),
                )
            ),
			'typography'    =>  array(
				'title' => __( 'CTA Button Text', 'uabb' ),
				'fields'    => array(
                    'btn_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-creative-button-wrap a, .uabb-creative-button-wrap a:visited'
                        )
                    ),
                    'btn_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a, .uabb-creative-button-wrap a:visited',
                            'property'      =>   'font-size',
                            'unit'          => 'px',
                        )
                    ),
                    'btn_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a, .uabb-creative-button-wrap a:visited',
                            'property'      =>  'line-height',
                            'unit'          => 'px',
                        )
                    ),
                )
            ),
		)
	)
));
