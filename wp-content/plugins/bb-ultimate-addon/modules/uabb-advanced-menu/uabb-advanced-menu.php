<?php

/**
 *
 * @class UABBCreativeMenu
 */
class UABBCreativeMenu extends FLBuilderModule {

    /**
     * Parent class constructor.
     * @method __construct
     */
    public function __construct() {
		parent::__construct(array(
            'name'          	=> __('Advanced Menu', 'uabb'),
            'description'   	=> __('Advanced Menu', 'uabb'),
            'category'      	=> BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
            'group'         	=> UABB_CAT,
            'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/uabb-advanced-menu/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/uabb-advanced-menu/',
            'editor_export' 	=> true, // Defaults to true and can be omitted.
            'enabled'       	=> true, // Defaults to true and can be omitted.
            'partial_refresh'   => true,
            'icon'              => 'hamburger-menu.svg',
        ));
        $this->add_css('font-awesome');
	}

	public static function render_menus() {
		$nav_menus =  get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$fields = array(
		    'type'          => 'select',
		    'label'         => __( 'Menu', 'uabb' ),
		    'helper'		=> __( 'Select a WordPress menu that you created in the admin under Appearance > Menus.', 'uabb' )
		);

		if( $nav_menus ) {

			foreach( $nav_menus as $key => $menu ) {

				if( 0 == $key ) {
					$fields['default'] = $menu->name;
				}

				$menus[ $menu->slug ] = $menu->name;
			}

			$fields['options'] = $menus;

		} else {
			$fields['options'] = array( '' => __( 'No Menus Found', 'uabb' ) );
		}

		return $fields;

	}

	public function get_toggle_button() {

		$toggle = $this->settings->creative_menu_mobile_toggle;
		if( isset( $toggle ) && 'expanded' != $toggle ) {

			if( in_array( $toggle, array( 'hamburger', 'hamburger-label' ) ) ) {
                echo '<div class="uabb-creative-menu-mobile-toggle-container">';
				echo '<div class="uabb-creative-menu-mobile-toggle '. $toggle .'"><div class="uabb-svg-container">';
				include FL_BUILDER_DIR .'img/svg/hamburger-menu.svg';
				echo '</div>';

				if( 'hamburger-label' == $toggle ) {
					echo '<span class="uabb-creative-menu-mobile-toggle-label">' ;
					echo ( isset( $this->settings->creative_menu_mobile_toggle_text ) && !empty( $this->settings->creative_menu_mobile_toggle_text ) ) ? $this->settings->creative_menu_mobile_toggle_text : __( 'Menu', 'uabb' );
					echo '</span>';
				}

				echo '</div></div>';

			} elseif( 'text' == $toggle ) {
                echo '<div class="uabb-creative-menu-mobile-toggle-container">';
				echo '<div class="uabb-creative-menu-mobile-toggle text"><span class="uabb-creative-menu-mobile-toggle-label">' ;
				echo ( isset( $this->settings->creative_menu_mobile_toggle_text ) && !empty( $this->settings->creative_menu_mobile_toggle_text ) ) ? $this->settings->creative_menu_mobile_toggle_text : __( 'Menu', 'uabb' );
				echo '</span></div></div>';

			}

		}
	}

	/**
	 * Render menu class
	 */
	public static function render_menu_class( $settings ) {

		if( isset( $settings->creative_menu_layout ) ) {

			if( in_array( $settings->creative_menu_layout, array( 'vertical', 'horizontal' ) ) && isset( $settings->creative_submenu_hover_toggle ) ) {
				$toggle = ' uabb-toggle-'. $settings->creative_submenu_hover_toggle;
			} elseif ( $settings->creative_menu_layout == 'accordion' && isset( $settings->creative_submenu_click_toggle ) ) {
				$toggle = ' uabb-toggle-'. $settings->creative_submenu_click_toggle;
			} else {
				$toggle = ' uabb-toggle-arrows';
			}
		} else {
				$toggle = ' uabb-toggle-arrows';
		}

		$layout = isset( $settings->creative_menu_layout ) ? 'uabb-creative-menu-'. $settings->creative_menu_layout : 'uabb-creative-menu-horizontal';

		$menu_class = 'menu '. $layout . $toggle;

		return $menu_class;
	}

	public function media_breakpoint() {
		$global_settings = FLBuilderModel::get_global_settings();
		$media_width = $global_settings->responsive_breakpoint;
		$mobile_breakpoint = $this->settings->creative_menu_mobile_breakpoint;

		if ( isset( $mobile_breakpoint ) && 'expanded' != $this->settings->creative_menu_mobile_toggle ) {
			if ( 'medium-mobile' == $mobile_breakpoint ) {
				$media_width = $global_settings->medium_breakpoint;
			} elseif ( 'mobile' == $this->settings->creative_menu_mobile_breakpoint ) {
				$media_width = $global_settings->responsive_breakpoint;
			} elseif ( 'always' == $this->settings->creative_menu_mobile_breakpoint ) {
				$media_width = 'always';
			} elseif ( 'custom' == $this->settings->creative_menu_mobile_breakpoint ) {
				$media_width = $this->settings->custom_breakpoint;
			}
		}

		return $media_width;
	}

    public function get_responsive_media( $settings, $module ) {

        if( 'default' != $settings->creative_mobile_menu_type ) {

            if( $settings->creative_mobile_menu_type == 'full-screen' ) {
                $classes = '<div class="uabb-menu-overlay uabb-overlay-'. $settings->creative_menu_full_screen_effects .'"> <div class="uabb-menu-close-btn"></div>';
            } else if( $settings->creative_mobile_menu_type == 'off-canvas' ) {
                $classes = '<div class="uabb-off-canvas-menu uabb-menu-'. $settings->creative_menu_offcanvas_direction .'"> <div class="uabb-menu-close-btn">×</div>';
            }

            $module->get_toggle_button(); ?>
            <div class="uabb-creative-menu<?php if ( $settings->creative_menu_collapse ) echo ' uabb-creative-menu-accordion-collapse'; ?> <?php echo $settings->creative_mobile_menu_type; ?>">
                <div class="uabb-clear"></div>
                <?php echo $classes ?>
                <?php echo $module->get_menu( $settings, $module ); ?>
                </div>
            </div>
        <?php }
    }

    public function get_menu( $settings, $module ) {
        do_action( 'uabb_advanced_menu_before', $settings ); ?>
        <?php if( !empty( $settings->wp_menu ) ) {

           $defaults = array(
                'menu'          => $settings->wp_menu,
                'container'     => false,
                'menu_class'    => $module->render_menu_class( $settings ),
                'walker'        => new Creative_Menu_Walker( $settings ),
           );

           wp_nav_menu( $defaults );
        }
        do_action( 'uabb_advanced_menu_after', $settings );
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBCreativeMenu', array(
    'general'       	=> array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
					'wp_menu' => UABBCreativeMenu::render_menus(),
					'creative_menu_layout' => array(
					    'type'          => 'uabb-toggle-switch',
					    'label'         => __( 'Layout', 'uabb' ),
					    'default'       => 'horizontal',
					    'options'       => array(
					    	'horizontal'	=> __( 'Horizontal', 'uabb' ),
					    	'vertical'		=> __( 'Vertical', 'uabb' ),
					    	'accordion'		=> __( 'Accordion', 'uabb' ),
					    	'expanded'		=> __( 'Expanded', 'uabb' ),
					    ),
					    'toggle'		=> array(
					    	'horizontal'	=> array(
					    		'fields'		=> array( 'creative_submenu_hover_toggle', 'menu_align' ),
					    	),
					    	'vertical'		=> array(
					    		'fields'		=> array( 'creative_submenu_hover_toggle' ),
					    	),
					    	'accordion'		=> array(
					    		'fields'		=> array( 'creative_submenu_click_toggle', 'creative_menu_collapse' ),
					    	),
					    )
					),
					'creative_submenu_hover_toggle' => array(
					    'type'          => 'uabb-toggle-switch',
					    'label'         => __( 'Submenu Icon', 'uabb' ),
					    'default'       => 'none',
					    'options'       => array(
					    	'arrows'		=> __( 'Arrows', 'uabb' ),
					    	'plus'			=> __( 'Plus Sign', 'uabb' ),
					    	'none'			=> __( 'None', 'uabb' ),
					    )
					),
					'creative_submenu_click_toggle' => array(
					    'type'          => 'uabb-toggle-switch',
					    'label'         => __( 'Submenu Icon click', 'uabb' ),
					    'default'       => 'arrows',
					    'options'       => array(
					    	'arrows'		=> __( 'Arrows', 'uabb' ),
					    	'plus'			=> __( 'Plus Sign', 'uabb' ),
					    )
					),
					'creative_menu_collapse'   => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Collapse Inactive', 'uabb'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Yes', 'uabb'),
							'0'             => __('No', 'uabb')
						),
						'help'          => __('Choosing yes will keep only one item open at a time. Choosing no will allow multiple items to be open at the same time.', 'uabb'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
                )
            ),
        )
    ),
    'menu'       		=> array( // Tab
        'title'         => __('Menu', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Style', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'creative_menu_alignment'    => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Menu Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'left'         	=> __('Left', 'uabb'),
                            'center'        => __( 'Center', 'uabb' ),
                            'right'        	=> __('Right', 'uabb'),
                        ),
                    ),
                    'creative_menu_link_margin' 	=> array(
                        'type'          => 'uabb-spacing',
                        'label'         => __( 'Link Margin', 'uabb' ),
                        'mode'			=> 'margin',
                        'default'       => 'margin:5px;', // Optional 
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-creative-menu .menu > li',
                            'property'        => 'margin',
                            'unit'            => 'px'
                        )                    
                    ),
                    'creative_menu_link_spacing'    => array(
                        'type'          => 'uabb-spacing',
                        'label'         => __( 'Link Padding', 'uabb' ),
                        'mode'          => 'padding',
                        'default'       => 'padding:10px;', // Optional
                    ),
                )
            ),
            'creative_menu_color_settings'       => array( // Section
                'title'         => __('Color Settings', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'creative_menu_link_color' => array(
                        'type'       => 'color',
                        'label'      => __('Link Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.menu > li > a, .menu > li > .uabb-has-submenu-container > a, .uabb-creative-menu .menu > li > a, .uabb-creative-menu .menu > .uabb-has-submenu-container > a, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a span.uabb-menu-toggle:before, .uabb-creative-menu.uabb-menu-default .menu > li > a, .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container a, .uabb-creative-menu.uabb-menu-default .menu > li > a span.menu-item-text, .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container a span.menu-item-text, .uabb-creative-menu.uabb-menu-default .menu > li > a span.menu-item-text:before, .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container a span.menu-item-text:before',
                            'property'        => 'color',
                        )
                    ),
                    'creative_menu_link_hover_color' => array(
                        'type'       => 'color',
                        'label'      => __('Link Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'creative_menu_background_color' => array(
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
						'show_alpha' => true,
                    ),
                    'creative_menu_background_hover_color' => array(
                        'type'       => 'color',
                        'label'      => __('Background Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
						'show_alpha' => true,
                    ),
                )
            ),
            'creative_menu_border_settings'       => array( // Section
                'title'         => __('Border Settings', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'creative_menu_border_style' => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'solid',
                        'options'       => array(
                            'none'         => __('None', 'uabb'),
                            'solid'        => __('Solid', 'uabb'),
                            'dashed'       => __('Dashed', 'uabb'),
                            'double'       => __('Double', 'uabb'),
                            'dotted'       => __('Dotted', 'uabb'),
                        ),
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .menu > li > a, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a',
							'property'        => 'border-style',
						),
                        'toggle'        => array(
                            'solid'        => array(
                                'fields'        => array( 'creative_menu_border_width', 'creative_menu_border_color', 'creative_menu_border_hover_color' )
                            ),
                            'dashed'        => array(
                                'fields'        => array( 'creative_menu_border_width', 'creative_menu_border_color', 'creative_menu_border_hover_color' )
                            ),
                            'double'        => array(
                                'fields'        => array( 'creative_menu_border_width', 'creative_menu_border_color', 'creative_menu_border_hover_color' )
                            ),
                            'dotted'        => array(
                                'fields'        => array( 'creative_menu_border_width', 'creative_menu_border_color', 'creative_menu_border_hover_color' )
                            )
                        )
                    ),
                    'creative_menu_border_width'    => array(
		                'type'          => 'uabb-spacing',
		                'label'         => __('Border Width', 'uabb'),
		                'maxlength'     => '2',
		                'mode'			=> 'padding',
                        'default'       => 'padding:0px',
		                'size'          => '6',
		            ),
                    'creative_menu_border_color' => array(
                        'type'       => 'color',
                        'label'      => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .menu > li > a, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a',
							'property'        => 'border-color',
						)
                    ),
                    'creative_menu_border_hover_color' => array(
                        'type'       => 'color',
                        'label'      => __('Border Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .menu > li > a:hover, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a:hover, .uabb-creative-menu .menu > li > a:focus, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a:focus',
							'property'        => 'border-color',
						)
                    ),
                )
            ),
        )
    ),
	'submenu'       	=> array( // Tab
        'title'         => __('Submenu', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
        	'creative_menu_submenu_style'	=> array(
				'title'		=> __( 'Style', 'uabb' ),
				'fields'	=> array(
					'creative_submenu_link_padding' 	=> array(
                    	'type' 			=> 'uabb-spacing',
                    	'label' 		=> __('Padding', 'uabb'),
                        'mode'   		=> 'padding',
                        'default'       => 'padding:15px;',
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-creative-menu .sub-menu > li > a, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
                            'property'        => 'padding',
                            'unit'            => 'px'
                        )
                    ),
					'submenu_width'   => array(
						'type'          => 'text',
						'label'         => __('Width', 'uabb'),
						'default'       => '220',
						'size'		 	=> '5',
						'description'	=> 'px',
						'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-creative-menu:not(.off-canvas) :not(.full-screen) .sub-menu',
                            'property'        => 'min-width',
                            'unit'            => 'px'
                        )
					),
				)
			),
			
			'creative_menu_submenu_color'	=> array(
				'title'		=> __( 'Color Settings', 'uabb' ),
				'fields'	=> array(
					'creative_submenu_link_color' => array(
                        'type'       => 'color',
                        'label'      => __('Link Color', 'uabb'),
                        'default'    => '333333',
                        'show_reset' => true,
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.sub-menu > li > a *, .sub-menu > li > .uabb-has-submenu-container > a *',
							'property'        => 'color',
						)
                    ),
                    'creative_submenu_link_hover_color' => array(
                        'type'       => 'color',
                        'label'      => __('Link Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
					'creative_submenu_background_color' => array(
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => 'edecec',
                        'show_reset' => true,
                        'show_alpha' => true,
                    ),
                    'creative_submenu_background_hover_color' => array(
                        'type'       => 'color',
                        'label'      => __('Background Hover Color', 'uabb'),
                        'default'    => 'f5f5f5',
                        'show_reset' => true,
                        'show_alpha' => true,
                    ),
				)
			),
			'creative_menu_shadow_style'	=> array(
				'title'		=> __( 'Shadow Settings', 'uabb' ),
				'fields'	=> array(
                    'creative_submenu_drop_shadow'	=> array(
						'type'          => 'uabb-toggle-switch',
					    'label'         => __( 'Drop Shadow', 'uabb' ),
					    'default'       => 'yes',
					    'options'       => array(
					    	'yes'			=> __( 'Yes', 'uabb' ),
					    	'no'			=> __( 'No', 'uabb' ),
					    ),
					    'toggle'        => array(
							'yes'        => array(
								'fields'        => array( 'creative_submenu_shadow_color_hor', 'creative_submenu_shadow_color_ver', 'creative_submenu_shadow_color_blur', 'creative_submenu_shadow_color_spr', 'creative_submenu_shadow_color', 'creative_submenu_shadow_color_opc' )
							)
						)
					),
					'creative_submenu_shadow_color_hor' => array(
                        'type'       	=> 'text',
                        'label'      	=> __('Horizontal Length', 'uabb'),
                        'default'    	=> '2',
                        'size'		 	=> '5',
                        'description'	=> 'px',
                    ),
                    'creative_submenu_shadow_color_ver' => array(
                        'type'       	=> 'text',
                        'label'      	=> __('Vertical Length', 'uabb'),
                        'default'    	=> '2',
                        'size'		 	=> '5',
                        'description'	=> 'px',
                    ),
                    'creative_submenu_shadow_color_blur' => array(
                        'type'       	=> 'text',
                        'label'      	=> __('Blur Radius', 'uabb'),
                        'default'    	=> '4',
                        'size'		 	=> '5',
                        'description'	=> 'px',
                    ),
                    'creative_submenu_shadow_color_spr' => array(
                        'type'       	=> 'text',
                        'label'      	=> __('Spread Radius', 'uabb'),
                        'default'    	=> '1',
                        'size'		 	=> '5',
                        'description'	=> 'px',
                    ),
					'creative_submenu_shadow_color' => array(
                        'type'       => 'color',
                        'label'      => __('Shadow Color', 'uabb'),
                        'default'    => '000000',
                        'show_reset' => true,
                    ),
					'creative_submenu_shadow_color_opc' => array(
                        'type'       	=> 'text',
                        'label'      	=> __('Shadow Color Opacity', 'uabb'),
                        'default'    	=> '30',
                        'placeholder'	=> '100',
                        'size'		 	=> '5',
                        'description'	=> '%',
                    ),

				)
			),
			'creative_submenu_border_settings'       => array( // Section
                'title'         => __('Border Settings', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'creative_submenu_border_settings_option'  => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Border', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'           => __( 'Yes', 'uabb' ),
                            'no'            => __( 'No', 'uabb' ),
                        ),
                        'toggle'        => array(
                            'yes'        => array(
                                'fields'        => array( 'creative_submenu_border_style', 'creative_submenu_border_width', 'creative_submenu_border_color' )
                            )
                        )
                    ),
                    'creative_submenu_border_style' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'solid',
                        'options'       => array(
                            'solid'        => __('Solid', 'uabb'),
                            'dashed'       => __('Dashed', 'uabb'),
                            'double'       => __('Double', 'uabb'),
                            'dotted'       => __('Dotted', 'uabb'),
                        ),
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .sub-menu',
							'property'        => 'border-style',
						)
                    ),
                    'creative_submenu_border_width'    => array(
		                'type'          => 'uabb-spacing',
		                'label'         => __('Border Width', 'uabb'),
		                'default'		=> 'padding:1px',
		                'mode'			=> 'padding',
		                'size'          => '6',		                
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .sub-menu',
							'property'        => 'border-width',
							'unit'			=> 'px',
						),
		            ),
                    'creative_submenu_border_color' => array(
                        'type'       => 'color',
                        'label'      => __('Border Color', 'uabb'),
                        'default'    => '000000',
                        'show_reset' => true,
                        'show_alpha' => true,
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .sub-menu',
							'property'        => 'border-color',
						)
                    ),
                )
            ),
			'creative_submenu_separator_settings'	=> array(
				'title'		=> __( 'Separator Settings', 'uabb' ),
				'fields'	=> array(
                    'creative_submenu_separator_settings_option'  => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Separator', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'           => __( 'Yes', 'uabb' ),
                            'no'            => __( 'No', 'uabb' ),
                        ),
                        'toggle'        => array(
                            'yes'        => array(
                                'fields'        => array( 'creative_submenu_separator_style', 'creative_submenu_separator_size', 'creative_submenu_separator_color' )
                            )
                        )
                    ),
					'creative_submenu_separator_style' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Separator Style', 'uabb'),
                        'default'       => 'solid',
                        'options'       => array(
                            'solid'        => __('Solid', 'uabb'),
                            'dashed'       => __('Dashed', 'uabb'),
                            'double'       => __('Double', 'uabb'),
                            'dotted'       => __('Dotted', 'uabb'),
                        ),
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .sub-menu > li',
							'property'        => 'border-bottom-style',
						)
                    ),
                    'creative_submenu_separator_size'    => array(
                        'type'          => 'text',
                        'label'         => __( 'Separator Size', 'uabb' ),
                        'default'		=> '1',
                        'placeholder'   => '1',
                        'size'          => '8',
                        'description'   => 'px',
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .sub-menu > li, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
							'property'        => 'border-bottom-width',
							'unit'			  => 'px'
						)
                    ),
                    'creative_submenu_separator_color' => array(
                        'type'       => 'color',
                        'label'      => __('Separator Color', 'uabb'),
                        'default'    => 'e3e2e3',
                        'show_reset' => true,
                        'show_alpha' => true,
                        'preview'         => array(
							'type'            => 'css',
							'selector'        => '.uabb-creative-menu .sub-menu > li, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
							'property'        => 'border-bottom-color',
						)
                    ),
				)
			),
			
        )
    ),
	'responsive'       	=> array( // Tab
        'title'         => __('Responsive', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'creative_menu_responsive_navigation_style'    => array(
                'title' => __( 'Responsive Navigation', 'uabb' ),
                'fields'    => array(
                    'creative_menu_mobile_toggle' => array(
                        'type'          => 'select',
                        'label'         => __( 'Responsive Navigation', 'uabb' ),
                        'default'       => 'hamburger',
                        'options'       => array(
                            'hamburger'         => __( 'Hamburger Icon', 'uabb' ),
                            'hamburger-label'   => __( 'Hamburger Icon + Label', 'uabb' ),
                            'text'              => __( 'Menu Button', 'uabb' ),
                            'expanded'          => __( 'None', 'uabb' ),
                        ),
                        'toggle'        => array(
                            'hamburger' => array(
                                'fields'        => array( 'creative_mobile_menu_type', 'creative_menu_mobile_breakpoint', 'creative_menu_responsive_alignment', 'creative_menu_mobile_toggle_color' ),
                                'sections'      => array( 'creative_menu_responsive_mobile_style', 'creative_menu_responsive_style' )
                            ),
                            'hamburger-label'   => array(
                                'fields'        => array( 'creative_mobile_menu_type', 'creative_menu_mobile_breakpoint', 'creative_menu_responsive_alignment', 'creative_menu_mobile_toggle_color', 'creative_menu_mobile_toggle_text' ),
                                'sections'      => array( 'creative_menu_responsive_mobile_style', 'creative_menu_responsive_style' )
                            ),
                            'text'  => array(
                                'fields'        => array( 'creative_mobile_menu_type', 'creative_menu_mobile_breakpoint', 'creative_menu_responsive_alignment', 'creative_menu_mobile_toggle_color', 'creative_menu_mobile_toggle_text' ),
                                'sections'      => array( 'creative_menu_responsive_mobile_style', 'creative_menu_responsive_style' )
                            ),
                        )
                    ),
                    'creative_menu_mobile_toggle_text'   => array(
                        'type'              => 'text',
                        'label'             => __('Navigation Label', 'uabb'),
                        'default'           => '',
                        'placeholder'       => __('Menu', 'uabb'),
                        'connections'       => array('string')
                    ),
                    'creative_menu_mobile_toggle_color' => array(
                        'type'       => 'color',
                        'label'      => __('Navigation Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'    => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-creative-menu-mobile-toggle',
                            'property'  => 'color'
                        )
                    ),
                )
            ),
        	'creative_menu_responsive_mobile_style'       => array(
				'title'         => __( 'Responsive Layout', 'uabb' ),
				'fields'        => array(
					'creative_mobile_menu_type'	=> array(
						'type'          => 'select',
					    'label'         => __( 'Responsive Layout', 'uabb' ),
					    'default'       => 'default',
					    'options'       => array(
					    	'default'		=> __( 'Accordion', 'uabb' ),
					    	'full-screen'	=> __( 'Overlay', 'uabb' ),
                            'off-canvas'    => __( 'Off Canvas', 'uabb' ),
					    ),
						'toggle'	=> array(
							'off-canvas'	=> array(
								'fields'	=> array( 'creative_menu_responsive_link_color', 'creative_menu_responsive_link_hover_color', 'creative_menu_responsive_link_border_color', 'creative_menu_offcanvas_direction', 'creative_menu_animation_speed', 'creative_menu_responsive_overlay_bg_color', 'creative_menu_responsive_overlay_padding', 'creative_menu_close_icon_size', 'creative_menu_close_icon_color', 'creative_menu_responsive_overlay_color', 'creative_menu_off_canvas_shadow', 'creative_menu_responsive_toggle' ),
                                'sections'   => array( 'creative_menu_responsive_close_style' )
							),
							'full-screen'	=> array(
								'fields'	=> array( 'creative_menu_responsive_link_color', 'creative_menu_responsive_link_hover_color', 'creative_menu_responsive_link_border_color', 'creative_menu_full_screen_effects', 'creative_menu_animation_speed', 'creative_menu_responsive_overlay_bg_color', 'creative_menu_close_icon_size', 'creative_menu_close_icon_color', 'creative_menu_responsive_toggle'  ),
                                'sections'   => array( 'creative_menu_responsive_close_style' )
							)
						)
					),
					'creative_menu_full_screen_effects'	=> array(
						'type'          => 'select',
					    'label'         => __( 'Effects', 'uabb' ),
					    'default'       => 'fade',
					    'options'       => array(
					    	'fade'			=> __( 'Fade', 'uabb' ),
					    	'slide-down'	=> __( 'Slide Down', 'uabb' ),
					    	'scale'			=> __( 'Scale', 'uabb' ),
					    	'door'			=> __( 'Door', 'uabb' ),
					    ),
					),
					'creative_menu_offcanvas_direction'	=> array(
						'type'          => 'select',
					    'label'         => __( 'Direction', 'uabb' ),
					    'default'       => 'left',
					    'options'       => array(
					    	'left'			=> __( 'From Left', 'uabb' ),
					    	'right'			=> __( 'From Right', 'uabb' ),
					    ),
					),
					'creative_menu_animation_speed'   => array(
                        'type'              => 'text',
                        'label'             => __('Animation Speed', 'uabb'),
                        'default'       	=> 500,
                        'description'       => __('ms', 'uabb'),
                        'size'              => 5
                    ),
					'creative_menu_mobile_breakpoint' => array(
						'type'          => 'select',
						'label'         => __( 'Responsive Breakpoint', 'uabb' ),
						'default'       => 'mobile',
						'options'       => array(
							'always'		=> __( 'Display on All Devices', 'uabb' ),
							'medium-mobile'	=> __( 'Display on Medium & Small Devices Only', 'uabb' ),
							'mobile'		=> __( 'Display on Small Devices Only', 'uabb' ),
							'custom'		=> __( 'Enter Custom Breakpoint', 'uabb' ),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	 => array('custom_breakpoint'),
                                'sections'     => array()
							),
						)
					),
					'custom_breakpoint'	=> array(
						'type'				=> 'text',
						'label'             => __('Custom Breakpoint', 'uabb'),
						'default'       	=> '768',
                        'description'       => __('px', 'uabb'),
                        'size'              => 5
					),
                )
            ),
            'creative_menu_responsive_style'    => array(
                'title' => __( 'Styling', 'uabb' ),
                'fields'    => array(
                    'creative_menu_responsive_overlay_bg_color' => array(
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'show_alpha' => true,
                    ),
					'creative_menu_responsive_link_color' => array(
                        'type'       => 'color',
                        'label'      => __('Link Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
						'preview'	 => array(
							'type'		=> 'css',
							'rules'		=> array(
								array(
									'selector'	=> '.uabb-creative-menu.full-screen .menu li a span.menu-item-text, .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a span.menu-item-text, .uabb-creative-menu.off-canvas .menu li a span.menu-item-text, .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a span.menu-item-text',
									'property'	=> 'color'
								),
								array(
									'selector'	=> '.uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-menu-toggle:before, .uabb-creative-menu.off-canvas .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before, .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-menu-toggle:before,
									.uabb-creative-menu.off-canvas .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before, .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-menu-toggle:before, .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before,
									 .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-menu-toggle:before, .uabb-creative-menu.full-screen .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before',
									'property'	=> 'color'
								)
							)
						)
                    ),
                    'creative_menu_responsive_link_hover_color' => array(
                        'type'       => 'color',
                        'label'      => __('Link Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'creative_menu_responsive_link_border_color' => array(
                        'type'       => 'color',
                        'label'      => __('Submenu Separator Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'    => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-creative-menu.full-screen .sub-menu li, .uabb-creative-menu.off-canvas .sub-menu li',
                            'property'  => 'border-bottom-color'
                        )
                    ),
                    'creative_menu_responsive_overlay_color' => array(
                        'type'       => 'color',
                        'label'      => __('Off Canvas Overlay Color', 'uabb'),
                        'default'    => 'rgba(0,0,0,0)',
                        'show_reset' => true,
                        'show_alpha' => true,
                    ),
                    'creative_menu_responsive_overlay_padding'  => array(
                        'type'          => 'uabb-spacing',
                        'label'         => __('Off Canvas Padding', 'uabb'),
                        'mode'          => 'padding',
                        'default'       => 'padding:10px',
                    ),
                    'creative_menu_off_canvas_shadow'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Off Canvas Shadow', 'uabb'),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       =>  __('Yes', 'uabb'),
                            'no'        =>  __('No', 'uabb')
                        ),
                        'toggle'        => array(
                            'yes'        => array(
                                'fields'        => array('creative_menu_off_canvas_shadow_color')
                            )
                        )
                    ),
                    'creative_menu_off_canvas_shadow_color' => array(
                        'type'       => 'color',
                        'label'      => __('Off Canvas Shadow Color', 'uabb'),
                        'default'    => 'rgba(0,0,0,.5)',
                        'show_reset' => true,
                        'show_alpha' => true,
                    ),
                    'creative_menu_responsive_alignment'    => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Overall Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'left'          => __('Left', 'uabb'),
                            'center'        => __( 'Center', 'uabb' ),
                            'right'         => __('Right', 'uabb'),
                        ),
                    ),
                    'creative_menu_responsive_toggle' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Submenu Icon', 'uabb' ),
                        'default'       => 'default',
                        'options'       => array(
                            'default'       => __( 'Default', 'uabb' ),
                            'arrows'        => __( 'Arrows', 'uabb' ),
                            'plus'          => __( 'Plus Sign', 'uabb' ),
                        )
                    ),
                )
            ),
            'creative_menu_responsive_close_style'    => array(
                'title' => __( 'Close Icon', 'uabb' ),
                'fields'    => array(
                    'creative_menu_close_icon_size'    => array(
                        'type'          => 'text',
                        'label'         => __( 'Close Icon Size', 'uabb' ),
                        'placeholder'   => '30',
                        'size'          => '8',
                        'description'   => 'px',
                        'preview'         => array(
                            'type'            => 'css',
                            'rules'           => array(
                                array(
                                    'selector'        => '.uabb-creative-menu.off-canvas .uabb-off-canvas-menu .uabb-menu-close-btn',
                                    'property'        => 'font-size',
                                    'unit'            => 'px'
                                ),
                                array(
                                    'selector'        => '.uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn',
                                    'property'        => 'width',
                                    'unit'            => 'px'
                                ),
                                array(
                                    'selector'        => '.uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn, .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:before, .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:after',
                                    'property'        => 'height',
                                    'unit'            => 'px'
                                ),
                            )
                        ),
                    ),
                    'creative_menu_close_icon_color' => array(
                        'type'       => 'color',
                        'label'      => __('Close Icon Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'    => array(
                            'type'      => 'css',
                            'rules'     => array(
                                array(
                                    'selector'  => '.uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:before, .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:after',
                                    'property'  => 'background-color'
                                ),
                                array(
                                    'selector'  => '.uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn',
                                    'property'  => 'color'
                                ),
                            )
                        )
                    ),
                )
            ),        
        )
    ),
    'typography'       	=> array( // Tab
        'title'         => __('Typography', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'link_typography' => array(
                'title' => __('Menu Typography', 'uabb' ),
                'fields'    => array(
                    'creative_menu_link_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.menu > li > a, .menu > li > .uabb-has-submenu-container > a, .uabb-creative-menu-mobile-toggle-label'
                        )
                    ),
					'creative_menu_link_font_size'     => array(
                        'type'          => 'uabb-toggle-switch',
						'label'         => __('Font Size', 'uabb'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'uabb'),
							'custom'        =>  __('Custom', 'uabb')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('creative_menu_link_font_size_custom')
							)
						)
                    ),
					'creative_menu_link_font_size_custom' => array(
						'type' => 'unit',
						'label' => __('Custom Font Size', 'uabb'),
						'description' => 'px',
						'preview' => array(
							'type' 		=> 'css',
							'selector'	=> '.menu > li > a, .menu > li > .uabb-has-submenu-container > a, .uabb-creative-menu-mobile-toggle-label',
							'property'	=> 'font-size',
							'unit' 		=> 'px'
						),
						'responsive' => array(
							'placeholder' => array(
								'default' => '18',
								'medium' => '',
								'responsive' => '',
							),
						),
					),
                    'creative_menu_link_line_height'   => array(
                        'type'          => 'uabb-toggle-switch',
						'label'         => __('Line Height', 'uabb'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'uabb'),
							'custom'        =>  __('Custom', 'uabb')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('creative_menu_link_line_height_custom')
							)
						)
                    ),
					'creative_menu_link_line_height_custom' => array(
						'type' => 'unit',
						'label' => __('Custom Line Height', 'uabb'),
						'preview' => array(
							'type' 		=> 'css',
							'selector'	=> '.menu > li > a, .menu > li > .uabb-has-submenu-container > a, .uabb-creative-menu-mobile-toggle-label',
							'property'	=> 'line-height',
						),
						'responsive' => array(
							'placeholder' => array(
								'default' => '1.4',
								'medium' => '',
								'responsive' => '',
							),
						),
					),
					'creative_menu_link_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'uabb'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'uabb'),
                            'uppercase'                => __('UPPERCASE', 'uabb'),
                            'lowercase'                => __('lowercase', 'uabb'),
                          	'capitalize'               => __('Capitalize', 'uabb'),  
                        ),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.uabb-creative-menu .menu > li > a, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a, .uabb-creative-menu-mobile-toggle-label',
							'property'      => 'text-transform',
						),
                    ),
                )
            ),
            'submenu_link_typography' => array(
                'title' => __('Submenu Typography', 'uabb' ),
                'fields'    => array(
                    'creative_submenu_link_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-creative-menu .sub-menu a'
                        )
                    ),
					'creative_submenu_link_font_size'     => array(
                        'type'          => 'uabb-toggle-switch',
						'label'         => __('Font Size', 'uabb'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'uabb'),
							'custom'        =>  __('Custom', 'uabb')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('creative_submenu_link_font_size_custom')
							)
						)
                    ),
					'creative_submenu_link_font_size_custom' => array(
						'type' => 'unit',
						'label' => __('Custom Font Size', 'uabb'),
						'description' => 'px',
						'preview' => array(
							'type' 		=> 'css',
							'selector'	=> '.uabb-creative-menu .sub-menu a, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
							'property'	=> 'font-size',
							'unit' 		=> 'px'
						),
						'responsive' => array(
							'placeholder' => array(
								'default' 	 => '18',
								'medium' 	 => '',
								'responsive' => '',
							),
						),
					),
                    'creative_submenu_link_line_height'   => array(
                        'type'          => 'uabb-toggle-switch',
						'label'         => __('Line Height', 'uabb'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'uabb'),
							'custom'        =>  __('Custom', 'uabb')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('creative_submenu_link_line_height_custom')
							)
						)
                    ),
					'creative_submenu_link_line_height_custom' => array(
						'type' => 'unit',
						'label' => __('Custom Line Height', 'uabb'),
						'preview' => array(
							'type' 		=> 'css',
							'selector'	=> '.uabb-creative-menu .sub-menu a, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
							'property'	=> 'line-height',
						),
						'responsive' => array(
							'placeholder' => array(
								'default' => '1.4',
								'medium' => '',
								'responsive' => '',
							),
						),
					),
					'creative_submenu_link_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'uabb'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'uabb'),
                            'uppercase'                => __('UPPERCASE', 'uabb'),
                            'lowercase'                => __('lowercase', 'uabb'),
                          	'capitalize'               => __('Capitalize', 'uabb'),  
                        ),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.uabb-creative-menu .sub-menu a',
							'property'      => 'text-transform',
						),
                    ),
                )
            ),
        )
    ),
));
