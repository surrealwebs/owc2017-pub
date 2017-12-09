<?php

/**
 *
 * @class InfoBannerModule
 */
class InfoBannerModule extends FLBuilderModule {

    /**
     * @property $data
     */
    public $data = null;

    /**
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Info Banner', 'uabb'),
            'description'   => __('Info Banner', 'uabb'),
            'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
            'group'         => UABB_CAT,
            'dir'           => BB_ULTIMATE_ADDON_DIR . 'modules/info-banner/',
            'url'           => BB_ULTIMATE_ADDON_URL . 'modules/info-banner/',
            'partial_refresh'   => true
        ));
    }

    /**
     * @method update
     * @param $settings {object}
     */
    public function update($settings)
    {
        // Make sure we have a photo_src property.
        if(!isset($settings->banner_image_src)) {
            $settings->banner_image_src = '';
        }

        //echo $settings->banner_image;
        // Cache the attachment data.
        $data = FLBuilderPhoto::get_attachment_data($settings->banner_image);

        if($data) {
            $settings->data = $data;
        }

        return $settings;
    }

    /**
     * @method get_data
     */
    public function get_data()
    {
        if(!$this->data) {

            $this->data = FLBuilderPhoto::get_attachment_data($this->settings->banner_image);

            // Data object is empty, use the settings cache.
            if(!$this->data && isset($this->settings->data)) {
                $this->data = $this->settings->data;
            }
        }

        return $this->data;
    }

    /**
     * @method get_alt
     */
    public function get_alt()
    {
        $photo = $this->get_data();

        if(!empty($photo->alt)) {
            return htmlspecialchars($photo->alt);
        }
        else {
            return '';
        }
    }

    /**
     * @method render_link
     */
    public function render_link()
    {
        if($this->settings->cta_type == 'link') {
            $nofollow = ( isset( $this->settings->link_nofollow ) ) ? $this->settings->link_nofollow : '0';
            echo '<a href="' . $this->settings->link . '" target="' . $this->settings->link_target . '" '. BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->link_target, $nofollow, 0 ) .' class="uabb-infobanner-cta-link">' . $this->settings->cta_text . '</a>';
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
                'link_nofollow'       => $this->settings->btn_link_nofollow,
                
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
                'hover_attribute'   => $this->settings->hover_attribute,

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
                'align'              => $this->settings->banner_alignemnt,
                'mob_align'          => '',

                /* Typography */
                'font_size'         => $this->settings->tbtn_font_size,
                'line_height'       => $this->settings->tbtn_line_height,
                'font_family'       => $this->settings->tbtn_font_family,
            );

            FLBuilder::render_module_html('uabb-button', $btn_settings);
        }
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('InfoBannerModule', array(
    'banner'       => array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Info Banner', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'banner_title'     => array(
                        'type'          => 'text',
                        'label'         => __('Title', 'uabb'),
                        'default'       => __('Info Banner','uabb'),
                        'help'          => __('Perhaps, this is the most highlighted text.','uabb'),
                        'preview'         => array(
                            'type'             => 'text',
                            'selector'         => '.uabb-ultb3-title',
                        ),
                        'connections'   => array( 'string', 'html' )
                    ),
                )
            ),
            'description'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
                    'banner_desc'     => array(
                        'type'          => 'editor',
                        'media_buttons' => false,
                        'rows'          => 10,
                        'label'         => __('', 'uabb'),
                        'default'       => '<p>' . __('Enter description text here.','uabb') . '</p>',
                        'preview'         => array(
                            'type'             => 'text',
                            'selector'         => '.uabb-ultb3-desc',
                        ),
                        'connections'   => array( 'string', 'html' )
                    ),
                )
            ),
            'styles' => array( // Section
                'title'         => __('Style', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'background_color'    => array( 
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => 'f2f2f2',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-ultb3-box',
                            'property'      => 'background',
                        )
                    ),
                    'background_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'banner_alignemnt'     => array(
                        'type'          => 'select',
                        'label'         => __('Information Alignment', 'uabb'),
                        'default'       => 'left',
                        'options'       => array(
                            'uabb-ultb3-align-left' => __('Left', 'uabb'),
                            'uabb-ultb3-align-center' => __('Center', 'uabb'),
                            'uabb-ultb3-align-right' => __('Right', 'uabb'),
                        ),
                    ),
                    'min_height_switch'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Minimum Height', 'uabb' ),
                        'default'       => 'auto',
                        'options'       => array(
                            'auto'      => __('Default','uabb'),
                            'custom'        => __('Custom','uabb'),
                        ),
                        'toggle'    => array(
                            'custom'    => array(
                                'fields'    => array( 'min_height', 'vertical_align' ),
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
                        'help'          => __('Apply minimum height to complete Info Banner. It will useful when multiple Info Banner are in same row.', 'uabb'),
                    ),
                    'vertical_align'         => array(
                        'type'          => 'select',
                        'label'         => __('Overall Vertical Alignment', 'uabb'),
                        'default'       => 'middle',
                        'options'       => array(
                            'top'    => __('Top', 'uabb'),
                            'middle' => __('Middle', 'uabb'),
                            'bottom' => __('Bottom', 'uabb'),
                        ),
                    ),
                    'responsive_min_height_switch'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Responsive Minimum Height', 'uabb' ),
                        'default'       => 'auto',
                        'options'       => array(
                            'auto'      => __('Default','uabb'),
                            'custom'        => __('Custom','uabb'),
                        ),
                        'toggle'    => array(
                            'custom'    => array(
                                'fields'    => array( 'responsive_min_height', 'responsive_vertical_align' ),
                            )
                        ),
                        'help'      => __( 'It will apply minimum height in mobile devices', 'uabb' )
                    ),
                    'responsive_min_height'          => array(
                        'type'          => 'text',
                        'label'         => __('Enter Height', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '4',
                        'size'          => '5',
                        'placeholder'   => 'auto',
                        'help'          => __('Apply minimum height to complete Info Banner. It will useful in mobile when multiple Info Banner are in same row.', 'uabb'),
                    ),
                    'responsive_vertical_align'         => array(
                        'type'          => 'select',
                        'label'         => __('Overall Vertical Alignment', 'uabb'),
                        'default'       => 'middle',
                        'options'       => array(
                            'top'    => __('Top', 'uabb'),
                            'middle' => __('Middle', 'uabb'),
                            'bottom' => __('Bottom', 'uabb'),
                        ),
                    ),
                )
            ),
        )
    ),
    'image'       => array( // Tab
        'title'         => __('Image', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'   => array( // Section
                'title'         => __('Image', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'banner_image' => array(
                        'type'          => 'photo',
                        'label'         => __('Banner Image', 'uabb'),
                        'show_remove'   => true,
                        'help'          => __('The image that would be appear as Background. Make sure overlay color you\'ve chosen must be transparent, to work this setting.', 'uabb'),
                        'connections'   => array( 'photo' )
                    ),
                    'banner_image_alignemnt'     => array(
                        'type'          => 'select',
                        'label'         => __('Image Alignment', 'uabb'),
                        'default'       => 'uabb-ultb3-img-center',
                        'options'       => array(
                            "uabb-ultb3-img-top-left" => __("Top Left","uabb"),
                            "uabb-ultb3-img-top-center" => __("Top Center","uabb"),
                            "uabb-ultb3-img-top-right" => __("Top Right","uabb"),
                            "uabb-ultb3-img-center-left" => __("Center Left","uabb"),
                            "uabb-ultb3-img-center" => __("Center","uabb"),
                            "uabb-ultb3-img-center-right" => __("Center Right","uabb"),
                            "uabb-ultb3-img-bottom-left" => __("Bottom Left","uabb"),
                            "uabb-ultb3-img-bottom-center" => __("Bottom Center","uabb"),
                            "uabb-ultb3-img-bottom-right" => __("Bottom Right","uabb"),
                        ),
                    ),
                    'overlay_color'    => array( 
                        'type'       => 'color',
                        'label'      => __('Overlay Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'overlay_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'responsive_nature' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Responsive Nature', 'uabb' ),
                        'default'       => 'auto',
                        'options'       => array(
                            'auto'          => __( 'Default', 'uabb' ),
                            'custom'        => __( 'Custom', 'uabb' ),
                        ),
                        'toggle'    => array(
                            'custom'    => array(
                                'fields'    => array( 'res_medium_width', 'res_small_width' ),
                            )
                        ),
                        'help' => __( 'The breakpoints of Medium and Small device is decided form BB-Global Settings', 'uabb' )
                    ),
                    'res_medium_width'          => array(
                        'type'          => 'text',
                        'label'         => __('Medium Device Width', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '4',
                        'size'          => '5',
                        'placeholder'   => 'auto',
                    ),
                    'res_small_width'          => array(
                        'type'          => 'text',
                        'label'         => __('Small Device Width', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '4',
                        'size'          => '5',
                        'placeholder'   => 'auto',
                    ),
                ),
                
            ),
            'animation' => array( // Section
                'title'         => __('Animation', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'banner_image_effect'     => array(
                        'type'          => 'select',
                        'label'         => __('Effect', 'uabb'),
                        'default'       => '',
                        'options'       => array(
                            "" => __("No Effect","uabb"),
                            "uabb-ib-slide-up"      => __("Slide Up","uabb"),
                            "uabb-ib-slide-down"    => __("Slide Down","uabb"),
                            "uabb-ib-slide-left"    => __("Slide Left","uabb"),
                            "uabb-ib-slide-right"   => __("Slide Right","uabb"),
                            "uabb-ib-zoom-in"       => __("Zoom In","uabb"),
                            "uabb-ib-zoom-out"      => __("Zoom Out","uabb"),
                            "uabb-ib-pan"           => __("Pan","uabb"),
                        ),
                    ),
                    'spacer'            => array(
                        'type'      => 'uabb-blank-spacer',
                        'height'    => '100px'
                    ),
                    'preview'         => array(
                        'type'            => 'none'
                    ),
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
                            'module'        => __('Link To Module','uabb'),
                        ),
                        'toggle'        => array(
                            'none'          => array(),
                            'link'          => array(
                                'fields'        => array('cta_text'),
                                'sections'      => array('link', 'link_typography')
                            ),
                            'button'        => array(
                                'sections'      => array('btn-general', 'btn-icon', 'btn-link', 'btn-colors', 'btn-style', 'btn-structure', 'btn_typography')
                            ),
                            'module'          => array(
                                'sections'      => array('link')
                            ),

                        )
                    ),
                    'cta_text'      => array(
                        'type'          => 'text',
                        'label'         => __('Text', 'uabb'),
                        'default'       => __('Read More', 'uabb'),
                        'connections'   => array( 'string', 'html' ),
                        'preview'       => array(
                            'type'            => 'text',
                            'selector'        => '.uabb-infobanner-cta-link'
                        ),
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
                        'connections'   => array( 'string', 'html' ),
                        'preview'       => array(
                            'type'            => 'text',
                            'selector'        => '.uabb-creative-button-text'
                        ),
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
                            'threed'        => __('3D', 'uabb'),
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
                            'type'            => 'css',
                            'selector'        => '.uabb-creative-button-wrap a, .uabb-creative-button-wrap span',
                            'property'         => 'color',
                        ),
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
                        'description'   => 'px'
                    ),
                    'btn_custom_height'  => array(
                        'type'          => 'text',
                        'label'         => __('Custom Height', 'uabb'),
                        'default'       => '45',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
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
                        'description'   => 'px'
                    ),
                    'btn_border_radius' => array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'uabb'),
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
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
                        'connections'   => array( 'url' )
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
                        'help'          => __('Enable this to make this link nofollow', 'uabb'),
                        'options'       => array(
                            '1'       => __('Yes','uabb'),
                            '0'       => __('No','uabb'),
                        ),
                    ),
                )
            ),
        )
    ),
    'typography'       => array( // Tab
        'title'         => __('Typography', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'title_typography'    =>  array(
                'title' => __('Title', 'uabb' ),
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
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => '.uabb-ultb3-title'
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
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-title',
                            'property'  => 'font-size',
                            'unit'      => 'px'
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
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-title',
                            'property'  => 'line-height',
                            'unit'      => 'px'
                        ),
                    ),
                    'color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-title',
                            'property'  => 'color',
                        ),
                    ),
                    'title_margin_top' => array(
                        'type'          => 'text',
                        'label'         => __('Margin Top', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '4',
                        'size'          => '8',
                        'default'       => '0',
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-title',
                            'property'  => 'margin-top',
                            'unit'      => 'px',
                        ),
                    ),
                    'title_margin_bottom' => array(
                        'type'          => 'text',
                        'label'         => __('Margin Bottom', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '4',
                        'size'          => '8',
                        'default'       => '0',
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-title',
                            'property'  => 'margin-bottom',
                            'unit'      => 'px',
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
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => '.uabb-ultb3-desc'
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
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-desc',
                            'property'  => 'font-size',
                            'unit'      => 'px'
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
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-desc',
                            'property'  => 'line-height',
                            'unit'      => 'px'
                        ),
                    ),
                    'desc_color'        => array( 
                        'type'       => 'color',
                        'label'     => __('Description Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-desc',
                            'property'  => 'color',
                        ),
                    ),
                    'desc_margin_top' => array(
                        'type'          => 'text',
                        'label'         => __('Margin Top', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '4',
                        'size'          => '8',
                        'default'       => '0',
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-desc',
                            'property'  => 'margin-top',
                            'unit'      => 'px',
                        ),
                    ),
                    'desc_margin_bottom' => array(
                        'type'          => 'text',
                        'label'         => __('Margin Bottom', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '4',
                        'size'          => '8',
                        'default'       => '0',
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-ultb3-desc',
                            'property'  => 'margin-bottom',
                            'unit'      => 'px',
                        ),
                    ),
                )
            ),
            'btn_typography'    =>  array(
                'title' => __('Button', 'uabb' ),
                'fields'    => array(
                    'tbtn_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => 'a.uabb-button'
                        ),
                    ),
                    'tbtn_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => 'a.uabb-button',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),
                    'tbtn_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => 'a.uabb-button',
                            'property'  => 'line-height',
                            'unit'      => 'px'
                        ),
                    ),
                )
            ),
            'link_typography'    =>  array(
                'title' => __( 'Link Text', 'uabb' ),
                'fields'    => array(
                    'link_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => '.uabb-infobanner-cta-link'
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
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-infobanner-cta-link',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),
                    'link_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-infobanner-cta-link',
                            'property'  => 'line-height',
                            'unit'      => 'px'
                        ),
                    ),
                    'link_color'        => array(
                        'type'       => 'color',
                        'label'         => __('Link Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-infobanner-cta-link',
                            'property'  => 'color',
                        ),
                    ),
                )
            ),
        )
    ),
));