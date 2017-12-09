<?php

class UABBDualColorModule extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'Dual Color Heading', 'uabb' ),
            'description'     => __( 'A totally awesome module!', 'uabb' ),
            'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
            'group'         => UABB_CAT,
            'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/dual-color-heading/',
            'url'             => BB_ULTIMATE_ADDON_URL . 'modules/dual-color-heading/',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => true, // Defaults to false and can be omitted.
            'icon'            => 'text.svg',
        ));
    }
}

FLBuilder::register_module('UABBDualColorModule', array(
    'dual_color'       => array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'dual_color_heading'       => array( // Section
                'title'         => __('Heading Text', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'first_heading_text'     => array(
                        'type'          => 'text',
                        'label'         => __('First Heading', 'uabb'),
                        'default'       => 'I love ',
                        'class'         => 'uabb-first-heading',
                        'description'   => '',
                        'preview'         => array(
                            'type'            => 'text',
                            'selector'        => '.uabb-first-heading-text'
                        ),
                        'help'          => __( 'Enter first part of heading.', 'uabb' ),
                        'connections'   => array( 'string', 'html' )
                    ),
                    'second_heading_text'     => array(
                        'type'          => 'text',
                        'label'         => __('Second Heading', 'uabb'),
                        'default'       => 'this website!',
                        'class'         => 'uabb-second-heading',
                        'description'   => '',
                        'preview'         => array(
                            'type'            => 'text',
                            'selector'        => '.uabb-second-heading-text'
                        ),
                        'help'          => __( 'Enter second part of heading.', 'uabb' ),
                        'connections'   => array( 'string', 'html' )
                    ),
                )
            ),
            'dual_color'       => array( // Section
                'title'         => __('Style', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'add_spacing_option'   => array(
                        'type'          => 'select',
                        'label'         => __('Spacing Between Headings', 'uabb'),
                        'default'       => 'no',
                        'class'         => 'dual-color-spacing-option',
                        'options'       => array(
                            'yes'      => __('Yes', 'uabb'),
                            'no'      => __('No', 'uabb')
                        ),
                        'toggle' => array(
                            'yes' => array(
                                'fields' => array('heading_margin')
                            ),
                            'no' => array(
                                'fields' => array()
                            )
                        ),
                        'help'          => __( 'Adjust spacing between first & second part of heading.', 'uabb' ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-first-heading-text',
                            'property'        => 'margin-right',
                            'unit'            => 'px'
                        )
                       
                    ),
                    'heading_margin'     => array(
                        'type'          => 'text',
                        'label'         => __('Spacing', 'uabb'),
                        'placeholder'   => '10',
                        'size'          => '8',
                        'class'         => 'uabb-add-spacing',
                        'description'   => 'px',
                        'help'          => __( 'Enter value for the spacing between first & second heading.', 'uabb' )
                    ),
                    'first_heading_color' => array( 
                        'type'       => 'color',
                        'label'         => __('First Heading Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-first-heading-text',
                            'property'        => 'color'
                        ),
                        'help'          => __( 'Select color for first part of heading.', 'uabb' )
                    ),
                    'second_heading_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Second Heading Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-second-heading-text',
                            'property'        => 'color'
                        ),
                        'help'          => __( 'Select color for second part of heading.', 'uabb' )
                    ),
                    'dual_color_alignment'   => array(
                        'type'          => 'select',
                        'label'         => __('Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'left'          => __('Left', 'uabb'),
                            'right'         => __('Right', 'uabb'),
                            'center'        => __('Center', 'uabb')
                        ),
                        'help'          => __( 'Select alignment for complete element.', 'uabb' ),
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
            )
        )
    ),

    'dual_typography'       => array( // Tab
        'title'         => __('Typography', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'dual_typography'    =>  array(
                'title'     => '',
                'fields'    => array(
                    'dual_tag_selection'   => array(
                        'type'          => 'select',
                        'label'     => __('Select Tag', 'uabb'),
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
                    'dual_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-dual-color-heading *'
                        )
                    ),
                    'dual_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-dual-color-heading *',
                            'property'        => 'font-size',
                            'unit'           => 'px'
                        )
                    ),
                    'dual_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-dual-color-heading *',
                            'property'        => 'line-height',
                            'unit'           => 'px'
                        )
                    ),
                )
            ),
        )
    )
));
