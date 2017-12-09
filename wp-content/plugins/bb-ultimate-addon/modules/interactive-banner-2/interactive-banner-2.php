<?php

/**
 *
 * @class InteractiveBanner2Module
 */
class InteractiveBanner2Module extends FLBuilderModule {

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
            'name'          => __('Interactive Banner 2', 'uabb'),
            'description'   => __('Interactive Banner 2', 'uabb'),
            'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
            'group'         => UABB_CAT,
            'dir'           => BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-2/',
            'url'           => BB_ULTIMATE_ADDON_URL . 'modules/interactive-banner-2/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true,
        ));
    }

    /**
     * @method get_data
     */
    public function get_data()
    {
        // Make sure we have a banner_image_src property.
        if(!isset($this->settings->banner_image_src)) {
            $this->settings->banner_image_src = '';
        }

        // Cache the attachment data.
        $this->data = FLBuilderPhoto::get_attachment_data($this->settings->banner_image);
        if(!$this->data) {

            // Photo source is set to "library".
            if(is_object($this->settings->banner_image_src)) {
                $this->data = $this->settings->banner_image_src;
            }
            else {
                $this->data = FLBuilderPhoto::get_attachment_data($this->settings->banner_image_src);
            }

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
        else if(!empty($photo->description)) {
            return htmlspecialchars($photo->description);
        }
        else if(!empty($photo->caption)) {
            return htmlspecialchars($photo->caption);
        }
        else if(!empty($photo->title)) {
            return htmlspecialchars($photo->title);
        }
    }
}



/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('InteractiveBanner2Module', array(
    'style'       => array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Banner Styles', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'banner_style'     => array(
                        'type'          => 'select',
                        'label'         => __('Banner Style', 'uabb'),
                        'default'       => 'style1',
                        'help'          => __('Select appear effect for description text.','uabb'),
                        'options'       => array(
                            'style1'      => __('Style 1', 'uabb'),
                            'style2'      => __('Style 2', 'uabb'),
                            /*'style3'      => __('Style 3', 'uabb'),*/
                            'style4'      => __('Style 3', 'uabb'),
                            'style5'      => __('Style 4', 'uabb'),
                            /*'style6'      => __('Style 6', 'uabb'),*/
                            'style7'      => __('Style 5', 'uabb'),
                            'style8'      => __('Style 6', 'uabb'),
                            'style9'      => __('Style 7', 'uabb'),
                            'style10'     => __('Style 8', 'uabb'),
                            'style11'     => __('Style 9', 'uabb'),
                            /*'style12'     => __('Style 12', 'uabb'),*/
                            'style13'     => __('Style 10', 'uabb'),
                            'style14'     => __('Style 11', 'uabb'),
                            /*'style15'     => __('Style 14', 'uabb'),*/
                        ),
                        'toggle' => array(
                            'style5' => array(
                                'fields' => array( 'title_background_color', 'title_background_color_opc' )
                            )
                        )
                    ),
                    'title_background_color'    => array( 
                        'type'       => 'color',
                        'label'         => __('Title Background Color', 'uabb'),
                        'default'    => 'fafafa',
                        'show_reset' => true,
                    ),
                    'title_background_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'banner_image' => array(
                        'type'          => 'photo',
                        'label'         => __('Banner Image', 'uabb'),
                        'show_remove'   => true,
                        'connections'   => array( 'photo' )
                    ),
                    'banner_height'     => array(
                        'type'          => 'text',
                        'label'         => __('Custom Banner Height', 'uabb'),
                        'default'       => '',
                        'size'          => '3',
                        'description'   => 'px',
                        'help'          => __('How big would you like it?','uabb'),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-new-ib',
                            'property'      => 'height',
                            'unit'          => 'px'
                        )
                    ),
                    'img_overlay_color'    => array( 
                        'type'       => 'color',
                        'label'         => __('Image Overlay Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'help'          => __('Use this color setting if you have a bright image and your text is not readable.','uabb'),
                    ),
                    'img_overlay_color_opc'    => array(
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'img_background_color'    => array( 
                        'type'       => 'color',
                        'label'         => __('Image Hover Overlay Color', 'uabb'),
                        'default'    => 'cccccc',
                        'show_reset' => true,
                    ),
                    'img_background_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                )
            ),
            'link'       => array( // Section
                'title'         => __('Link', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'link_url'    => array(
                        'type'          => 'text',
                        'label'         => __( 'Link URL', 'uabb' ),
                        'placeholder'   => __( 'URL', 'uabb' ),
                        'connections'   => array( 'url' )
                    ),
                    'link_target'    => array(
                        'type'          => 'select',
                        'label'         => __('Link target', 'uabb'),
                        'default'       => '_blank',
                        'options'       => array(
                            '_blank'      => __('New Page', 'uabb'),
                            ''      => __('Same Page', 'uabb'),
                        ),
                    ),
                )
            ),
        )
    ),
    'title'       => array( // Tab
        'title'         => __('Title', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Title', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'banner_title'     => array(
                        'type'          => 'text',
                        'label'         => __('Title', 'uabb'),
                        'default'       => __('Interactive Banner 2','uabb'),
                        'preview'       => array(
                            'type' => 'text',
                            'selector' => '.uabb-new-ib-title'
                        ),
                        'connections'   => array( 'string', 'html' )
                    ),
                )
            ),
            'title_typography' => array(
                'title' => __( 'Title Typography', 'uabb' ),
                'fields'    => array(
                    'title_typography_tag_selection'   => array(
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
                    'title_typography_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-new-ib-title'
                        )
                    ),
                    'title_typography_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-new-ib-title',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    'title_typography_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-new-ib-title',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    'title_typography_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview' => array(
                            'type' => 'css',
                            'property' => 'color',
                            'selector' => '.uabb-new-ib-title',
                        ),
                    ),
                )
            ),
        )
    ),
    'description'       => array( // Tab
        'title'         => __('Description', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'description'       => array( // Section
                'title'         => __('Description', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'banner_desc'     => array(
                        'type'          => 'editor',
                        'media_buttons' => false,
                        'rows'          => 10,
                        'label'         => __('', 'uabb'),
                        'default'       => __('Enter description text here.','uabb'),
                        'preview'         => array(
                            'type'             => 'text',
                            'selector'         => '.uabb-new-ib-content',
                        ),
                        'connections'   => array( 'string', 'html' )
                    ),
                )
            ),
            'desc_typography' => array(
                'title' => __( 'Description Typography', 'uabb' ),
                'fields'    => array(
                    'desc_typography_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-new-ib-content'
                        )
                    ),
                    'desc_typography_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-new-ib-content',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    'desc_typography_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-new-ib-content',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    'desc_typography_color'        => array( 
                        'type'       => 'color',
                        'label' => __('Description Text Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-new-ib-content',
                            'property'        => 'color'
                        )
                    ),
                )
            ),
        )
    ),
));
