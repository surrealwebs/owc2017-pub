<?php

class UABBDualButtonModule extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'Dual Button', 'uabb' ),
            'description'     => __( 'A totally awesome module!', 'uabb' ),
            'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
            'group'         => UABB_CAT,
            'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/dual-button/',
            'url'             => BB_ULTIMATE_ADDON_URL . 'modules/dual-button/',
            'partial_refresh' => true,
            'icon'              => 'button.svg',
        ));
    }

    function render_own_imgicon( $image_icon_arr ) {
        $image_icon_arr = (object) $image_icon_arr;
        $output = '';        
        if ( $image_icon_arr->image_type != 'none' ) {
            $output = '<div class="uabb-imgicon-wrap">';
            if( $image_icon_arr->image_type == 'icon' ) {
                $output .= '<span class="uabb-icon-wrap">';
                $output .= '<span class="uabb-icon">';
                $output .= '<i class="'.$image_icon_arr->icon.'"></i>'; 
                $output .= '</span>';
                $output .= '</span>';
            } // Icon Html End

            if( $image_icon_arr->image_type == 'photo' ) { // Photo Html
                $src = isset($image_icon_arr->photo_src) ? $image_icon_arr->photo_src : '';
                $output .= '<div class="uabb-image-simple">';
                $output .= '<div class="uabb-image-content">';
                $output .= '<img class="uabb-img-src" src="'.$src.'"/>';
                $output .= '</div>';
                $output .= '</div>';

            } // Photo Html End
            $output .= '</div>'; /* End Module Wrap */ 
            echo $output;
        }
    }
    function render_image_icon( $image_icon_arr ) {
        $image_icon_arr = (object) $image_icon_arr;
        $imageicon_array = array(
     
            /* General Section */
            'image_type' => $image_icon_arr->image_type,
         
            /* Icon Basics */
            'icon' => $image_icon_arr->icon,
            'icon_size' => "30",
            'icon_align' => "center",
         
            /* Image Basics */
            'photo_source' => $image_icon_arr->photo_source,
            'photo' => $image_icon_arr->photo,
            'photo_url' => $image_icon_arr->photo_url,
            'img_size' => "30",
            'img_align' => "center",
            'photo_src' => ( isset( $image_icon_arr->photo_src ) ) ? $image_icon_arr->photo_src : '' ,
         
            /* Icon Style */
            'icon_style' => "",
            'icon_bg_size' => "",
            'icon_border_style' => "",
            'icon_border_width' => "",
            'icon_bg_border_radius' => "0",
         
            /* Image Style */
            'image_style' => "",
            'img_bg_size' => "",
            'img_border_style' => "",
            'img_border_width' => "",
            'img_bg_border_radius' => "0",
        ); 
        /* Render HTML Function */
        FLBuilder::render_module_html( 'image-icon', $imageicon_array );
    }

    function render_image_icon_css( $id, $image_icon_arr ) {
        $image_icon_arr = (object) $image_icon_arr;
        $imageicon_array = array(
     
            /* General Section */
            'image_type' => $image_icon_arr->image_type,
         
            /* Icon Basics */
            'icon' => $image_icon_arr->icon,
            'icon_size' => $image_icon_arr->icon_size,
            'icon_align' => "center",
         
            /* Image Basics */
            'photo_source' => $image_icon_arr->photo_source,
            'photo' => $image_icon_arr->photo,
            'photo_url' => $image_icon_arr->photo_url,
            'img_size' => $image_icon_arr->img_size,
            'img_align' => "center",
            'photo_src' => ( isset( $image_icon_arr->photo_src ) ) ? $image_icon_arr->photo_src : '' ,
         
            /* Icon Style */
            'icon_style' => "",
            'icon_bg_size' => "",
            'icon_border_style' => "",
            'icon_border_width' => "",
            'icon_bg_border_radius' => "0",
         
            /* Image Style */
            'image_style' => "",
            'img_bg_size' => "",
            'img_border_style' => "",
            'img_border_width' => "",
            'img_bg_border_radius' => "0",

            /* Icon Colors */ 
            'icon_color' => $image_icon_arr->icon_color,
            'icon_hover_color' => $image_icon_arr->icon_hover_color,
            'icon_bg_color' => "",
            'icon_bg_hover_color' => "",
            'icon_border_color' => "",
            'icon_border_hover_color' => "",
            'icon_three_d' => "",
         
            /* Image Colors */
            'img_bg_color' => "",
            'img_bg_hover_color' => "",
            'img_border_color' => "",
            'img_border_hover_color' => "",
        ); 
        /* CSS Render Function */ 
        FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
    }
}

FLBuilder::register_module('UABBDualButtonModule', array(
    'dual_button'       => array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'dual_button'       => array( // Section
                'title'         => __('Button Settings', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'dual_button_type'   => array(
                        'type'          => 'select',
                        'label'         => __('Button Type', 'uabb'),
                        'default'       => 'horizontal',
                        'options'       => array(
                            'horizontal'      => __('Horizontal', 'uabb'),
                            'vertical'      => __('Vertical', 'uabb'),
                        ),
                        'toggle'    => array(
                            'horizontal'        => array(
                                'fields'    => array( 'responive_dual_button', 'join_buttons' )
                            )
                        )
                    ),
                    'join_buttons'   => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Join Button', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __('Yes', 'uabb'),
                            'no'        => __('No', 'uabb'),
                        ),
                    ),
                    'spacing_between_buttons' => array(
                        'type'          => 'text',
                        'label'         => __('Space between', 'uabb'),
                        'size'          => '6',
                        'placeholder'   => '10',
                        'description'   => 'px'
                    ),
                    'dual_button_width_type'   => array(
                        'type'          => 'select',
                        'label'         => __('Button Width', 'uabb'),
                        'default'       => 'auto',
                        'options'       => array(
                            'auto'      => __('Auto', 'uabb'),
                            'full'      => __('Full width', 'uabb'),
                            'custom'      => __('Custom', 'uabb'),
                        ),
                        'toggle'          => array(
                            'auto' => array(
                                'fields'    => array( 'dual_button_align' ),
                            ),
                            'custom'   => array(
                                'fields'    => array( 'dual_button_align', 'dual_button_width','dual_button_height','dual_button_pad_top_bot','dual_button_pad_lef_rig' ),
                            ),
                        )
                    ),
                    'dual_button_width' => array(
                        'type'          => 'text',
                        'label'         => __('Custom Width', 'uabb'),
                        'size'          => '6',
                        'placeholder'   => '100',
                        'help'          => __('Custom Width of Single Button.', 'uabb'),
                        'description'   => 'px',
                    ),
                    'dual_button_height' => array(
                        'type'          => 'text',
                        'label'         => __('Custom Height', 'uabb'),
                        'size'          => '6',
                        'placeholder'   => '45',
                        'help'          => __('Custom Height of Single Button.', 'uabb'),
                        'description'   => 'px'
                    ),
                    'dual_button_pad_top_bot' => array(
                        'type'          => 'text',
                        'label'         => __('Padding Top/Bottom', 'uabb'),
                        'size'          => '6',
                        'description'   => 'px'
                    ),
                    'dual_button_pad_lef_rig' => array(
                        'type'          => 'text',
                        'label'         => __('Padding Left/Right', 'uabb'),
                        'size'          => '6',
                        'description'   => 'px'
                    ),
                    'dual_button_align'   => array(
                        'type'          => 'select',
                        'label'         => __('Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'left'      => __('Left', 'uabb'),
                            'right'      => __('Right', 'uabb'),
                            'center'      => __('Center', 'uabb'),
                        ),
                    ),
                    'dual_button_radius'   => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius', 'uabb'),
                        'placeholder'   => '0',
                        'size'          => '6',
                        'description'   => 'px'
                    ),
                    'responive_dual_button'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Enable Responsive Mode', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'no'       => __('No','uabb'),
                            'yes'      => __('Yes','uabb'),
                        ),
                        'help'          => __('Convert Horizontal style to Vertical style on Small Devices', 'uabb')
                    ),

                )
            ),
            'dual_button_styles'       => array( // Section
                'title'         => __('Styles', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'dual_button_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Button Style', 'uabb'),
                        'default'       => 'gradient',
                        'options'       => array(
                            'flat'              => __('Flat', 'uabb'),
                            'gradient'          => __('Gradient', 'uabb'),
                            'transparent'       => __('Transparent', 'uabb'),
                        ),
                        'toggle'        => array(
                            'transparent'   => array(
                                'sections'  => array( 'dual_border_section' ),
                                'fields'    => array( 'transparent_button_options' ),
                            ),
                            'flat'   => array(
                                'fields'    => array( 'flat_button_options', '_btn_one_back_color', '_btn_one_back_color_opc', '_btn_two_back_color', '_btn_two_back_color_opc' )
                            ),
                            'gradient'   => array(
                                'fields'    => array( '_btn_one_back_color', '_btn_one_back_color_opc', '_btn_two_back_color', '_btn_two_back_color_opc' )
                            )
                        )
                    ),
                    'transparent_button_options'         => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'transparent-fade',
                        'options'       => array(
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
                    'flat_button_options'         => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __('None', 'uabb'),
                            'animate_to_right'          => __('Appear Icon/Image From Left', 'uabb'),
                            'animate_to_left'      => __('Appear Icon/Image From Right', 'uabb'),
                            'animate_from_top'      => __('Appear Icon/Image From Top', 'uabb'),
                            'animate_from_bottom'     => __('Appear Icon/Image From Bottom', 'uabb'),
                        ),
                    ),
                )
            ),
            'dual_border_section'       => array( // Section
                'title'         => __('Border Styles', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'dual_button_border_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'solid',
                        'options'       => array(
                            'none'      => __('None', 'uabb'),
                            'solid'      => __('Solid', 'uabb'),
                            'dashed'      => __('Dashed', 'uabb'),
                            'dotted'      => __('Dotted', 'uabb'),
                            'double'      => __('Double', 'uabb'),
                            'inset'      => __('Inset', 'uabb'),
                            'outset'      => __('Outset', 'uabb'),
                        ),
                        'toggle'        => array(
                            'solid'     => array(
                                'fields' => array( 'button_border_color', 'button_border_width' )
                            ),
                            'dashed'     => array(
                                'fields' => array( 'button_border_color', 'button_border_width' )
                            ),
                            'dotted'     => array(
                                'fields' => array( 'button_border_color', 'button_border_width' )
                            ),
                            'double'     => array(
                                'fields' => array( 'button_border_color', 'button_border_width' )
                            ),
                            'inset'     => array(
                                'fields' => array( 'button_border_color', 'button_border_width' )
                            ),
                            'outset'     => array(
                                'fields' => array( 'button_border_color', 'button_border_width' )
                            ),
                        )
                    ),
                    'button_border_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'button_border_width' => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'uabb'),
                        'size'          => '6',
                        'placeholder'   => '2',
                        'description'   => 'px'
                    ),
                    
                )
            )
            
        )
    ),
    'dual_button_one'       => array( // Tab
        'title'         => __('Button 1', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'dual_button_one'       => array( // Section
                'title'         => __('Button 1 Options', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'button_one_title'   => array(
                        'type'          => 'text',
                        'label'         => __('Button Text', 'uabb'),
                        'placeholder'   => "Button One",
                        'default'       => __('Check Demo','uabb'),
                        'connections'   => array( 'string', 'html' ),
                        'preview'       => array(
                            'type'          => 'text',
                            'selector'      => '.uabb-btn-one-text',
                        )
                    ),
                    'button_one_link'   => array(
                        'type'          => 'link',
                        'label'         => __('Button Link', 'uabb'),
                        'default'       => '#',
                        'connections'   => array( 'url' )
                    ),
                    'button_one_class'          => array(
                        'type'          => 'text',
                        'label'         => __('Class', 'uabb'),
                        'default'       => '',
                        'preview'       => array(
                            'type'          => 'none'
                        ),
                    ),
                    'button_one_link_target'   => array(
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
                    '_btn_one_back_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    '_btn_one_back_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    '_btn_one_back_hover_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Background Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                                'type'      => 'none',
                        )
                    ),
                    '_btn_one_back_hover_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                )
            ),

            /* Icon Image Param Code Starts */
            'type_general'      => array( // Section
                'title'         => 'Image / Icon', // Section Title
                'fields'        => array( // Section Fields
                    'image_type_btn_one'    => array(
                        'type'          => 'select',
                        'label'         => __('Image Type', 'uabb'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __( 'None', 'Image type.', 'uabb' ),
                            'icon'          => __('Icon', 'uabb'),
                            'photo'         => __('Photo', 'uabb'),
                        ),
                        'toggle'        => array(
                            'icon'          => array(
                                'fields'   => array( 'icon_btn_one', 'icon_position_btn_one', 'img_icon_width_btn_one' ),
                            ),
                            'photo'         => array(
                                'fields'   => array( 'photo_btn_one', 'icon_position_btn_one', 'img_icon_width_btn_one' ),
                            )
                        ),
                    ),
                    'icon_btn_one'          => array(
                        'type'          => 'icon',
                        'label'         => __('Icon', 'uabb'),
                        'show_remove' => true
                    ),
                    'photo_btn_one'         => array(
                        'type'          => 'photo',
                        'label'         => __('Photo', 'uabb'),
                        'show_remove'   => true,
                    ),
                    'icon_position_btn_one' => array(
                        'type'          => 'select',
                        'label'         => __('Photo/Icon Position', 'uabb'),
                        'default'       => 'before',
                        'options'       => array(
                            'before'       => __('Before Text', 'uabb'),
                            'after'           => __('After Text', 'uabb')
                        ),
                    ),
                    'img_icon_width_btn_one' => array(
                        'type'          => 'text',
                        'label'         => __('Photo/Icon Width', 'uabb'),
                        'placeholder'   => '30',
                        'description'   => 'px',
                        'size'          => '8'
                    )
                )
            ),
            /* Icon Image Param Code Ends */
        )
    ),
    'dual_button_two'       => array( // Tab
        'title'         => __('Button 2', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'dual_button_two'       => array( // Section
                'title'         => __('Button 2 Options', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'button_two_title'   => array(
                        'type'          => 'text',
                        'label'         => __('Button Text', 'uabb'),
                        'placeholder'   => "Button two",
                        'default'       => __('Learn More','uabb'),
                        'connections'   => array( 'string', 'html' ),
                        'preview'       => array(
                            'type'          => 'text',
                            'selector'      => '.uabb-btn-one-text',
                        )
                    ),

                    'button_two_link'   => array(
                        'type'          => 'link',
                        'label'         => __('Button Link', 'uabb'),
                        'default'       => '#',
                        'connections'   => array( 'url' )
                    ),
                    'button_two_class'          => array(
                        'type'          => 'text',
                        'label'         => __('Class', 'uabb'),
                        'default'       => '',
                        'preview'       => array(
                            'type'          => 'none'
                        ),
                    ),
                    'button_two_link_target'   => array(
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
                    '_btn_two_back_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    '_btn_two_back_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    '_btn_two_back_hover_color' => array( 
                        'type'       => 'color',
                        'default'    => '',
                        'show_reset' => true,
                        'label'         => __('Background Hover Color', 'uabb'),
                        'preview'       => array(
                                'type'      => 'none',
                        )
                    ),
                    '_btn_two_back_hover_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                )
            ),

            /* Icon Image Param Code Starts */
            'type_general_btn_two'      => array( // Section
                'title'         => __('Image / Icon','uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'image_type_btn_two'    => array(
                        'type'          => 'select',
                        'label'         => __('Image Type', 'uabb'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __( 'None', 'uabb' ),
                            'icon'          => __('Icon', 'uabb'),
                            'photo'         => __('Photo', 'uabb'),
                        ),
                        'toggle'        => array(
                            'icon'          => array(
                                'fields'   => array( 'icon_btn_two', 'icon_position_btn_two', 'img_icon_width_btn_two' ),
                            ),
                            'photo'         => array(
                                'fields'   => array( 'photo_btn_two', 'icon_position_btn_two', 'img_icon_width_btn_two' ),
                            )
                        ),
                    ),
                    'icon_btn_two'          => array(
                        'type'          => 'icon',
                        'label'         => __('Icon', 'uabb'),
                        'show_remove' => true
                    ),
                    'photo_btn_two'         => array(
                        'type'          => 'photo',
                        'label'         => __('Photo', 'uabb'),
                        'show_remove'   => true,
                    ),
                    'icon_position_btn_two' => array(
                        'type'          => 'select',
                        'label'         => __('Photo/Icon Position', 'uabb'),
                        'default'       => 'before',
                        'options'       => array(
                            'before'       => __('Before Text', 'uabb'),
                            'after'           => __('After Text', 'uabb')
                        ),
                    ),
                    'img_icon_width_btn_two' => array(
                        'type'          => 'text',
                        'label'         => __('Photo/Icon Width', 'uabb'),
                        'placeholder'   => '30',
                        'description'   => 'px',
                        'size'          => '8'
                    )

                )
            ),
            /* Icon Image Param Code Ends */
        )
    ),
    'dual_button_divider'       => array( // Tab
        'title'         => __('Divider', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'dual_button_divider'       => array( // Section
                'title'         => __('Divider Settings', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'divider_options'   => array(
                        'type'          => 'select',
                        'label'         => __('Select Divider', 'uabb'),
                        'default'       => 'text',
                        'options'       => array(
                            'none'      => __('None', 'uabb' ),
                            'text'      => __('Text', 'uabb'),
                            'icon'      => __('Icon', 'uabb'),
                            'photo'     => __('Image', 'uabb'),
                        ),
                        'toggle'        => array(
                            'text'   => array(
                                'sections'  => array( 'dual_btn_divider_color', 'dual_btn_divider_border', 'divider_text' ),
                                'fields'    => array( 'divider_text', 'divider_color' ),
                            ),
                            'icon'   => array(
                                'sections'  => array( 'dual_btn_divider_color', 'dual_btn_divider_border' ),
                                'fields'    => array( 'divider_icon', 'divider_color' )
                            ),
                            'photo'   => array(
                                'sections'  => array( 'dual_btn_divider_border' ),
                                'fields'    => array( 'divider_photo' ),
                            )
                        )
                    ),
                    'divider_text'   => array(
                        'type'          => 'text',
                        'label'         => __('Text', 'uabb'),
                        'default'       => 'or',
                        'connections' => array( 'string' ),
                        'preview'       => array(
                            'type'          => 'text',
                            'selector'      => '.uabb-middle-text',
                        )
                    ),
                    'divider_icon'   => array(
                        'type'          => 'icon',
                        'label'         => __('Select Icon', 'uabb'),
                        'show_remove' => true
                    ),
                    'divider_photo'         => array(
                        'type'          => 'photo',
                        'label'         => __('Photo', 'uabb'),
                        'connections' => array( 'photo' )
                    ),
                )
            ),
            'dual_btn_divider_color'       => array( // Section
                'title'         => __('Divider Colors', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'divider_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Text / Icon Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-middle-text',
                            'property'      => 'color',
                        )
                    ),
                    'divider_background_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Background Color', 'uabb'),
                        'default'    => 'ffffff',
                        'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-middle-text',
                            'property'      => 'background',
                        )
                    ),
                    'divider_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                )
            ),
            'dual_btn_divider_border'       => array( // Section
                'title'         => __('Divider Border', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'divider_border_radius'   => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'placeholder'   => '50',
                        'size'          => '5',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-middle-text',
                            'property'      => 'border-radius',
                            'unit'          => 'px',
                        )
                    ),
                    'divider_border'   => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => '',
                        'options'       => array(
                            ""     => __( 'None', 'uabb'),    
                            "solid"     => __( 'Solid', 'uabb'),    
                            "dashed"    => __( 'Dashed', 'uabb'),
                            "dotted"    => __( 'Dotted', 'uabb'),
                            "double"    => __( 'Double', 'uabb'),
                            "inset"     => __( 'Inset', 'uabb'),
                            "outset"    => __( 'Outset', 'uabb'),
                        ),
                        'toggle'        => array(
                            'solid'     => array(
                                'fields'    => array( 'divider_border_color', 'divider_border_width' )
                            ),
                            'dashed'     => array(
                                'fields'    => array( 'divider_border_color', 'divider_border_width' )
                            ),
                            'dotted'     => array(
                                'fields'    => array( 'divider_border_color', 'divider_border_width' )
                            ),
                            'double'     => array(
                                'fields'    => array( 'divider_border_color', 'divider_border_width' )
                            ),
                            'inset'     => array(
                                'fields'    => array( 'divider_border_color', 'divider_border_width' )
                            ),
                            'outset'     => array(
                                'fields'    => array( 'divider_border_color', 'divider_border_width' )
                            ),
                        ),
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-middle-text',
                            'property'      => 'border-style',
                        )
                    ),
                    'divider_border_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-middle-text',
                            'property'      => 'border-color',
                        )
                    ),
                    'divider_border_width'   => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '5',
                        'placeholder'   => '1',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-middle-text',
                            'property'      => 'border-width',
                            'unit'          => 'px',
                        )
                    ),
                    
                )
            ),

        )
    ),
    'dual_button_typography'       => array( // Tab
        'title'         => __('Typography', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'typography_btn_one'    =>  array(
                'title'     => __('Button 1', 'uabb' ),
                'fields'    => array(
                    '_btn_one_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-btn-one-text'
                        )
                    ),
                    '_btn_one_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-btn.uabb-btn-one',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    '_btn_one_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-btn.uabb-btn-one',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    '_btn_one_text_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Button Color', 'uabb'),  
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-btn-one-text',
                            'property'        => 'color',
                        )
                    ),
                    '_btn_one_text_hover_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Button Hover Color', 'uabb'),  
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'none',
                        )
                    ),
                )
            ),
            'typography_btn_two'    =>  array(
                'title'     => __('Button 2', 'uabb' ),
                'fields'    => array(
                    '_btn_two_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-btn-two-text'
                        )
                    ),
                    '_btn_two_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-btn.uabb-btn-two',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    '_btn_two_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-btn.uabb-btn-two',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    '_btn_two_text_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Button Color', 'uabb'), 
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-btn-two-text',
                            'property'        => 'color',
                        )
                    ),
                    '_btn_two_text_hover_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Button Hover Color', 'uabb'), 
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
            'divider_text'    =>  array(
                'title'     => __('Divider Text', 'uabb' ),
                'fields'    => array(
                    '_divider_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-middle-text'
                        )
                    ),
                    '_divider_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'help'  => __( 'Divider width and height will adjust according to font size', 'uabb' ),
                         'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-middle-text',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                )
            ),
        )
    )
));

?>
