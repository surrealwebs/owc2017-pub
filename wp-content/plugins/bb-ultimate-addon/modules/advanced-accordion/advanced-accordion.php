<?php

/**
 * @class UABBAdvancedAccordionModule
 */
class UABBAdvancedAccordionModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Advanced Accordion', 'uabb'),
			'description'   	=> __('Display a collapsible accordion of items.', 'uabb'),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/advanced-accordion/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/advanced-accordion/',
			'partial_refresh'	=> true,
			'icon'				=> 'layout.svg',
		));

		add_filter( 'fl_builder_render_settings_field', array( $this , 'uabb_accordion_render_settings_field' ), 10, 3 );
		
		$this->add_css('font-awesome');
	}

	function uabb_accordion_render_settings_field( $field, $name, $settings ) {
		
		if ( isset( $field['form'] ) && $field['form'] == 'uabb_advAccordion_items_form' ) {
			
			foreach( $settings->acc_items as $acc_item ) {

				if( is_object( $acc_item ) && isset( $acc_item->acc_content ) && $acc_item->ct_content == ''  ) {
					$acc_item->ct_content = $acc_item->acc_content;
				}

			}
		}

	    return $field;
	}

	function get_accordion_content( $settings ) {
        $content_type = $settings->content_type;
        switch($content_type) {
            case 'content':
            	global $wp_embed;
                return wpautop( $wp_embed->autoembed( $settings->ct_content ) );
            break;
            case 'photo':
            	if ( isset( $settings->ct_photo_src ) ) {
                	return '<img src="' . $settings->ct_photo_src . '" />';
            	}
                return '<img src="" />';
            break;
            case 'video':
                global $wp_embed;
                return $wp_embed->autoembed($settings->ct_video);
            break;
            case 'saved_rows':
            	ob_start();
                echo '[fl_builder_insert_layout id="'.$settings->ct_saved_rows.'" type="fl-builder-template"]';
                return ob_get_clean();
            case 'saved_modules':
            	ob_start();
                echo '[fl_builder_insert_layout id="'.$settings->ct_saved_modules.'" type="fl-builder-template"]';
                return ob_get_clean();
            case 'saved_page_templates':
                ob_start();
                echo '[fl_builder_insert_layout id="'.$settings->ct_page_templates.'" type="fl-builder-template"]';
                return ob_get_clean();
            break;
            default:
                return;
            break;
        }
    }

	function render_icon( $pos )
	{
		if ( $pos == $this->settings->icon_position && ( $this->settings->open_icon != '' || $this->settings->close_icon != '' ) ) {
			
			if ( $this->settings->icon_animation == 'none' ) {
				$output = '<div class="uabb-adv-accordion-icon-wrap">';
				$output .= '<i class="uabb-adv-accordion-button-icon '.$this->settings->close_icon.'"></i>';
				$output .= '</div>';
			}else {
				$output = '<div class="uabb-adv-accordion-icon-wrap uabb-adv-'.$this->settings->icon_animation.'">';
				$output .= '<div class="uabb-adv-accordion-icon-animation">';

				if ( $this->settings->icon_animation == 'push-out-top' || $this->settings->icon_animation == 'push-out-left' ) {
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-open-icon '.$this->settings->open_icon.'"></i>';
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-close-icon '.$this->settings->close_icon.'"></i>';
				}elseif ( $this->settings->icon_animation == 'push-out-bottom' || $this->settings->icon_animation == 'push-out-right' ) {
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-close-icon '.$this->settings->close_icon.'"></i>';
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-open-icon '.$this->settings->open_icon.'"></i>';
				}
				
				$output .= '</div>';
				$output .= '</div>';
			}
			return $output;
		}
		return '';
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBAdvancedAccordionModule', array(
	'items'         => array(
		'title'         => __('Items', 'uabb'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'acc_items'         => array(
						'type'          => 'form',
						'label'         => __('Item', 'uabb'),
						'form'          => 'uabb_advAccordion_items_form', // ID from registered form below
						'preview_text'  => 'acc_title', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			)
		)
	),
	'acc_setting'			=> array(
		'title'		 => __('Settings', 'uabb'),
		'sections'	 => array(
			'panel'		=> array(
				'title'	 	=> '',
				'fields'	=> array(
					'collapse'   => array(
						'type'          => 'select',
						'label'         => __('Inactive Other Items', 'uabb'),
						'default'       => 'yes',
						'options'       => array(
							'yes'             => __('Yes', 'uabb'),
							'no'             => __('No', 'uabb')
						),
						'help'          => __('Choosing yes will keep only one item open at a time. Choosing no will allow multiple items to be open at the same time.', 'uabb'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'enable_first'       => array(
						'type'          => 'select',
						'label'         => __('Expand First Item', 'uabb'),
						'default'       => 'yes',
						'options'       => array(
							'no'             => __('No', 'uabb'),
							'yes'             => __('Yes', 'uabb')
						),
						'help' 			=> __('Choosing yes will expand the first item by default.', 'uabb')
					)
				)
			)
		)
	),
	'acc_title_style'       => array(
		'title'         => __('Title', 'uabb'),
		'sections'      => array(
			'title_style'	=> array(
				'title'         => __('Title Style', 'uabb'),
				'fields'		=> array(
					'title_spacing'		=> array(
						'type'          => 'uabb-spacing',
                        'label'         => __( 'Padding', 'uabb' ),
                        'mode'			=> 'padding',
                        'default'       => 'padding: 15px;', // Optional
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-button',
                            'property'      => 'padding',
                            'unit'			=> 'px'
                        )
					),
					'title_margin'     => array(
						'type'          => 'text',
						'label'         => __('Spacing Between Titles', 'uabb'),
						'placeholder'   => '10',
						'maxlength'     => '2',
						'size'          => '6',
						'description'   => 'px',
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-item',
                            'property'      => 'margin-bottom',
                            'unit'			=> 'px'
                        )
					),
					'title_align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'left',
						'help' 			=> __('To change the alignment of title you can use this options', 'uabb'),
						'options'       => array(
							'center'        => __('Center', 'uabb'),
							'left'          => __('Left', 'uabb'),
							'right'         => __('Right', 'uabb')
						),
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-button-label',
                            'property'      => 'text-align',
                        )
					),
					'title_color' => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button-label',
                            'property'      => 'color',
                        )
					),
                    'title_hover_color' => array( 
						'type'       => 'color',
						'label'      => __('Hover Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-item-active .uabb-adv-accordion-button-label',
                            'property'      => 'color',
                        )
					),
					'title_bg_color' => array(
						'type'       => 'color',
						'label'      => __('Background Color', 'uabb'),
						'default'	 => 'f6f6f6',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'background',
                        )
					),
                    'title_bg_color_opc' => array(
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
					'title_bg_hover_color' => array(
						'type'       => 'color',
						'label'      => __('Background Hover/Focus Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-item-active .uabb-adv-accordion-button',
                            'property'      => 'background',
                        )
					),
                    'title_bg_hover_color_opc' => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
				)
			),
			'title_border'	=> array(
				'title'         => __('Title Border', 'uabb'),
				'fields'        => array(
					'title_border_type'   => array(
		                'type'          => 'select',
		                'label'         => __('Type', 'uabb'),
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
		                    ''              => array(
		                        'fields'        => array()
		                    ),
		                    'solid'         => array(
		                        'fields'        => array('title_border_color', 'title_border_top', 'title_border_bottom', 'title_border_left', 'title_border_right' )
		                    ),
		                    'dashed'        => array(
		                        'fields'        => array('title_border_color', 'title_border_top', 'title_border_bottom', 'title_border_left', 'title_border_right' )
		                    ),
		                    'dotted'        => array(
		                        'fields'        => array('title_border_color', 'title_border_top', 'title_border_bottom', 'title_border_left', 'title_border_right' )
		                    ),
		                    'double'        => array(
		                        'fields'        => array('title_border_color', 'title_border_top', 'title_border_bottom', 'title_border_left', 'title_border_right' )
		                    )
		                ),
		                'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'border-style',
                        )
		            ),
		            'title_border_top'    => array(
		                'type'          => 'text',
		                'label'         => __('Top Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'border-top-width',
                            'unit'			=>	'px',
                        )
		            ),
		            'title_border_bottom' => array(
		                'type'          => 'text',
		                'label'         => __('Bottom Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'border-bottom-width',
                            'unit'			=>	'px',
                        )
		            ),
		            'title_border_left'   => array(
		                'type'          => 'text',
		                'label'         => __('Left Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'border-left-width',
                            'unit'			=>	'px',
                        )
		            ),
		            'title_border_right'  => array(
		                'type'          => 'text',
		                'label'         => __('Right Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'border-right-width',
                            'unit'			=>	'px',
                        )
		            ),
		            'title_border_radius'   => array(
		                'type'          => 'text',
		                'label'         => __('Border Radius', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '0',
		                'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'border-radius',
                            'unit'			=>	'px',
                        )
		            ),
		            'title_border_color' => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button',
                            'property'      => 'border-color',
                        )
					),
		        )
			),
			'title_icon'       => array(
				'title'         => __('Title Icon', 'uabb'),
				'fields'        => array(
					'close_icon'          => array(
						'type'          => 'icon',
						'label'         => __('Close Icon', 'uabb'),
						'default'		=> 'fa fa-plus',
						'show_remove'	=> true
					),
					'open_icon'          => array(
						'type'          => 'icon',
						'label'         => __('Open Icon', 'uabb'),
						'default'		=> 'fa fa-minus',
						'show_remove'	=> true
					),
					'icon_size'    => array(
		                'type'          => 'text',
		                'label'         => __('Icon Size', 'uabb'),
		                'placeholder'   => '16',
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button-icon',
                            'property'      => 'font-size',
                            'unit'			=> 'px',
                        )
		            ),
					'icon_position' => array(
						'type'          => 'select',
						'label'         => __('Icon Position', 'uabb'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'uabb'),
							'after'         => __('After Text', 'uabb')
						)
					),
					'icon_animation' => array(
						'type'          => 'select',
						'label'         => __('Icon Animation', 'uabb'),
						'default'       => 'none',
						'options'       => array(
							'none'        => __('None', 'uabb'),
							'push-out-top'        => __('Push Out from Top', 'uabb'),
							'push-out-right'        => __('Push Out from Right', 'uabb'),
							'push-out-bottom'        => __('Push Out from Bottom', 'uabb'),
							'push-out-left'        => __('Push Out from Left', 'uabb'),
						)
					),
					'icon_color' => array( 
						'type'       => 'color',
                        'label'      => __('Icon Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-button-icon',
                            'property'      => 'color',
                        )
					),
					'icon_hover_color' => array( 
						'type'       => 'color',
						'label'      => __('Icon Hover/Focus Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-item-active .uabb-adv-accordion-button-icon',
                            'property'      => 'color',
                        )
					),
				)
			),
		)
	),
	'acc_content_style'     => array(
		'title'         => __('Content', 'uabb'),
		'sections'      => array(
			'content_style'	=> array(
				'title'         => __('Content Style', 'uabb'),
				'fields'	=> array(
					'content_spacing'		=> array(
						'type'          => 'uabb-spacing',
                        'label'         => __( 'Padding', 'uabb' ),
                        'mode'			=> 'padding',
                        'default'       => 'padding: 20px;', // Optional
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'padding',
                            'unit'			=> 'px'
                        )
					),
					'content_align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'left',
						'help' 			=> __('To change the content alignment you can use this options', 'uabb'),
						'options'       => array(
							'center'        => __('Center', 'uabb'),
							'left'          => __('Left', 'uabb'),
							'right'         => __('Right', 'uabb')
						),
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'text-align',
                        )
					),
					'content_color' => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'color',
                        )
					),
					'content_bg_color' => array( 
						'type'       => 'color',
						'label'      => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'background',
                        )
					),
                    'content_bg_color_opc' => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
				)
			),
			'content-section'       => array(
				'title'         => __('Content Border', 'uabb'),
				'fields'        => array(
					'content_border_type'   => array(
		                'type'          => 'select',
		                'label'         => __('Type', 'uabb'),
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
		                    ''              => array(
		                        'fields'        => array()
		                    ),
		                    'solid'         => array(
		                        'fields'        => array('content_border_color', 'content_border_top', 'content_border_bottom', 'content_border_left', 'content_border_right', 'responsive_border')
		                    ),
		                    'dashed'        => array(
		                        'fields'        => array('content_border_color', 'content_border_top', 'content_border_bottom', 'content_border_left', 'content_border_right', 'responsive_border')
		                    ),
		                    'dotted'        => array(
		                        'fields'        => array('content_border_color', 'content_border_top', 'content_border_bottom', 'content_border_left', 'content_border_right', 'responsive_border')
		                    ),
		                    'double'        => array(
		                        'fields'        => array('content_border_color', 'content_border_top', 'content_border_bottom', 'content_border_left', 'content_border_right', 'responsive_border')
		                    )
		                ),
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'border-style',
                        )
		            ),
		            'content_border_top'    => array(
		                'type'          => 'text',
		                'label'         => __('Top Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'border-top-width',
                            'unit'			=> 'px',
                        )
		            ),
		            'content_border_bottom' => array(
		                'type'          => 'text',
		                'label'         => __('Bottom Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'border-bottom-width',
                            'unit'			=> 'px',
                        )
		            ),
		            'content_border_left'   => array(
		                'type'          => 'text',
		                'label'         => __('Left Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'border-left-width',
                            'unit'			=> 'px',
                        )
		            ),
		            'content_border_right'  => array(
		                'type'          => 'text',
		                'label'         => __('Right Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '1',
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'border-right-width',
                            'unit'			=> 'px',
                        )
		            ),
		            'content_border_radius'   => array(
		                'type'          => 'text',
		                'label'         => __('Border Radius', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '5',
		                'placeholder'   => '0',
		                'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'border-radius',
                            'unit'			=> 'px',
                        )
		            ),
		            'content_border_color' => array(
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-adv-accordion-content',
                            'property'      => 'border-color',
                        )
					),
				)
			)
		)
	),
	'acc_typography'		=> array(
		'title'		=> __('Typography', 'uabb'),
		'sections'	=> array(
			'title_typogrphy'	=> array(
                'title'     => __('Title', 'uabb' ) ,
                'fields'    => array(
                    'tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h4',
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
                            'selector'        => '.uabb-adv-accordion-button-label'
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
                            'selector'        => '.uabb-adv-accordion-button-label',
                            'property'      => 'font-size',
                            'unit'      => 'px',
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
                            'selector'        => '.uabb-adv-accordion-button-label',
                            'property'      => 'line-height',
                            'unit'      => 'px',
                        )
                    ),
                )
            ),
			'content_typogrphy'	=> array(
                'title'     => __('Content', 'uabb' ) ,
                'fields'    => array(
                    'content_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-adv-accordion-content, .uabb-adv-accordion-content *'
                        )
                    ),
                    'content_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-content, .uabb-adv-accordion-content *',
                            'property'      => 'font-size',
                            'unit'      => 'px',
                        )
                    ),
                    'content_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-adv-accordion-content, .uabb-adv-accordion-content *',
                            'property'      => 'line-height',
                            'unit'      => 'px',
                        )
                    ),
                )
            ),
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('uabb_advAccordion_items_form', array(
	'title' => __('Add Item', 'uabb'),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'uabb'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(
						'acc_title'         => array(
							'type'          => 'text',
							'label'         => __('Title', 'uabb'),
							'default'		=> 'Nuper quisque evolvit praebebat turba hunc viseret foret vultus.',
							'connections'   => array( 'string', 'html' )
						)
					)
				),
				'content_type' => array(
			        'title'     => __('Content', 'uabb'),
			        'fields'    => array(
			            'content_type'       => array(
			                'type'          => 'select',
			                'label'         => __('Type', 'uabb'),
			                'default'       => 'content',
			                'options'       => array(
								'content' 		=> __('Content', 'uabb'),
								'photo'   		=> __('Photo', 'uabb'),
								'video'   		=> __('Video Embed Code', 'uabb'),
								'saved_rows'		=> array(
									'label'         => __('Saved Rows', 'uabb'),
									'premium'       => true
								),
								'saved_modules'		=> array(
									'label'         => __('Saved Modules', 'uabb'),
									'premium'       => true
								),
								'saved_page_templates'		=> array(
									'label'         => __('Saved Page Templates', 'uabb'),
									'premium'       => true
								),
			                ),
			                'toggle'        => array(
			                    'content'       => array(
			                        'fields'        => array('ct_content')
			                    ),
			                    'photo'        => array(
			                        'fields'        => array('ct_photo')
			                    ),
			                    'video'         => array(
			                        'fields'        => array('ct_video')
			                    ),
			                    'saved_rows'     => array(
			                        'fields'        => array('ct_saved_rows')
			                    ),
			                    'saved_modules'     => array(
			                        'fields'        => array('ct_saved_modules')
			                    ),
			                    'saved_page_templates'     => array(
			                        'fields'        => array('ct_page_templates')
			                    )
			                )
			            ),
			            'ct_content'   => array(
			                'type'                  => 'editor',
			                'label'                 => '',
			                'default'				=> '',
			                'connections'			=> array( 'string', 'html' )
			            ),
			            'ct_photo'     => array(
			                'type'                  => 'photo',
			                'label'                 => __('Select Photo', 'uabb'),
			                'show_remove'			=> true,
			            ),
			            'ct_video'     => array(
			                'type'                  => 'textarea',
			                'label'                 => __('Embed Code / URL', 'uabb'),
			                'rows'                  => 6
			            ),
			            'ct_saved_rows'      => array(
			                'type'                  => 'select',
			                'label'                 => __('Select Row', 'uabb'),
			                'options'               => UABB_Model_Helper::get_saved_row_template(),
			            ),
			            'ct_saved_modules'      => array(
			                'type'                  => 'select',
			                'label'                 => __('Select Module', 'uabb'),
			                'options'               => UABB_Model_Helper::get_saved_module_template(),
			            ),
			            'ct_page_templates'      => array(
			                'type'                  => 'select',
			                'label'                 => __('Select Page Template', 'uabb'),
			                'options'               => UABB_Model_Helper::get_saved_page_template(),
			            )
			        )
			    )
			)
		)
	)
));
