<?php

/**
 * @class ModalPopupModule
 */
class ModalPopupModule extends FLBuilderModule {

	
	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Modal Popup', 'uabb'),
			'description'   => __('Video Popup', 'uabb'),
			'category'      	=> UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/modal-popup/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/modal-popup/',
		));

		$this->add_css( 'font-awesome' );
      	/*$this->add_js('uabbpopup-classie', $this->url . 'js/classie.js', array(), '', true);*/
		$this->add_js('jquery-fitvids');
      	$this->add_js('uabbpopup-cookies', $this->url . 'js/js_cookie.js', array(), '', true);
	}

	/*public function enqueue_scripts()
	{
		
		if( $this->settings->modal_on == 'automatic' && $this->settings->enable_cookies ) {
	    }
	}*/

	/**
	 * Render Button
	 */
	public function render_button( $module_id ) {
        $btn_settings = array(
            
            /* General Section */
            'text'              => $this->settings->btn_text,
            
            /* Link Section */
            'link'              => 'javascript:void(0)',//$this->settings->btn_link,
            'link_target'       => '_self',//$this->settings->btn_link_target,
            
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
            'align'              => $this->settings->btn_align,
            'mob_align'          => $this->settings->btn_mob_align,

            /* Typography */
            //'font_size'         => $this->settings->btn_font_size,
            //'line_height'       => $this->settings->btn_line_height,
            //'font_family'       => $this->settings->btn_font_family,

            'a_data' 	=> 'data-modal='.$module_id.' ',
			'a_class'	=> 'uabb-trigger'
        );

        FLBuilder::render_module_html('uabb-button', $btn_settings);
    }

    /**
     * Get Modal Content
     */
    public function get_modal_content( $settings ) {
        $content_type = $settings->content_type;
        switch($content_type) {
            case 'content':
                return $settings->ct_content;
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
            case 'iframe':
                return '<iframe src="' . $settings->iframe_url . '" class="uabb-content-iframe" frameborder="0" width="100%" height="100%"></iframe>';
            break;
            /*case 'html':
                return $settings->ct_html;
            break;*/
            case 'saved_rows':
            	ob_start();
                echo do_shortcode('[fl_builder_insert_layout id="'.$settings->ct_saved_rows.'" type="fl-builder-template"]');
                return ob_get_clean();
            case 'saved_modules':
            	ob_start();
                echo do_shortcode('[fl_builder_insert_layout id="'.$settings->ct_saved_modules.'" type="fl-builder-template"]');
                return ob_get_clean();
            case 'saved_page_templates':
                ob_start();
                echo do_shortcode('[fl_builder_insert_layout id="'.$settings->ct_page_templates.'" type="fl-builder-template"]');
                return ob_get_clean();
            break;
            case 'youtube':
            	return $this->get_video_embed();
            case 'vimeo':
            	return $this->get_video_embed();
            default:
                return;
            break;
        }
    }

	/**
	 * Get video Id
	 */
	public function get_video_embed()
	{
		if ( $this->settings->video_url == '' ) {
			return '';
		}
		
		$url 	= $this->settings->video_url;
		$vid_id = '';
		//$width = '640';
		//$height = '385'; width="854" height="480" 
		$html = '';

		if ( $this->settings->content_type == 'youtube' ) {
			if( preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches) ){
				$vid_id = $matches[1];
			}

			//var_dump( $this->get_width_height() );
			//$size = ( $this->get_width_height() ) ? $this->get_width_height() : '';

			// echo "<pre>";
			// print_r( $this );
			// echo "</pre>";
			// die();
			// $html = print_r( $this->node );
			$html = '<iframe id="uabb-'.$this->node.'" class="uabb-modal-iframe" src="https://www.youtube.com/embed/'.$vid_id.'?version=3&enablejsapi=1" frameborder="0" allowfullscreen></iframe>';
			return $html;
		}elseif( $this->settings->content_type == 'vimeo' ){
			$vid_id = preg_replace("/[^\/]+[^0-9]|(\/)/", "", rtrim($url, "/"));
			$html = '<iframe id="uabb-'.$this->node.'" class="uabb-modal-iframe" src="https://player.vimeo.com/video/'.$vid_id.'?title=0&byline=0&portrait=0&badge=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			return $html;
		}
		


		
		/*<iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
		    src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
		    frameborder="0" allowfullscreen></iframe> 

		preg_match("/^(?:http(?:s)?:\/\/)?
		    (?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|
		    (?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);*/
	}

	public function get_width_height()
	{
		$size['width'] 	= '';
		$size['height'] = '';
		if ( /*$this->settings->modal_size == 'custom' &&*/ is_numeric($this->settings->modal_width) && $this->settings->modal_width > 0 ) {
			
			$temp_width = $this->settings->modal_width;

			/*if( isset( $this->settings->uabb_modal_spacing['simplify'] ) ) {
				if ( $this->settings->uabb_modal_spacing['simplify'] == 'collapse' ) {
					$temp_width = intval($temp_width) - ( intval( $this->settings->uabb_modal_spacing['all'] ) * 2 );
				}else{
					$temp_width = intval($temp_width) - intval( $this->settings->uabb_modal_spacing['left'] ) - intval( $this->settings->uabb_modal_spacing['right'] );
				}
			}else{
				$temp_width = $this->settings->modal_width - 50;
			}*/

			$size['width'] = $temp_width;

			if( $this->settings->video_ratio == '16_9' ) {
				$size['height'] = ( ( $temp_width / 16 ) * 9 );
				
			}else {
				$size['height'] = ( ( $temp_width / 4 ) * 3 );
			}
			return $size;
		}
		return false;	
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('ModalPopupModule', array(
	'general'       => array( // Tab
		'title'         => __('Content', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
			'preview'		=> array(
				'title'		 => '',
				'fields'	 => array(
					'preview_modal'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Preview Modal Popup', 'uabb' ),
                        'default'       => '1',
                        'options'       => array(
                          	'1'		=> __('Yes','uabb'),
                         	'0'		=> __('No','uabb'),
                        ),
                        'help'			=> __('If enabled, you will see preview of modal popup at backend. This option is just for preview purpose.', 'uabb')
                    ),
				)
			),
			'title'		=> array(
				'title'		 => __( 'Title', 'uabb' ),
				'fields'	 => array(
					'enable_title'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Enable Title', 'uabb' ),
                        'default'       => '0',
                        'options'       => array(
                          	'1'      => __('Yes','uabb'),
                            '0'     => __('No','uabb'),
                        ),
                        'toggle' 		=> array(
							'1'	 => array(
								'fields' 	=> array( 'title', 'title_spacing', 'title_alignment' ),
								'sections'	=> array( 'title_typo' )
							),
						)
                    ),
                    'title'         => array(
						'type'          => 'text',
						'label'         => __('Enter Title', 'uabb'),
						'placeholder'	=> __('This is modal title', 'uabb'),
						
					),
					'title_alignment'   => array(
                        'type'          => 'select',
                        'label'         => __('Title Alignment', 'uabb'),
                        'default'       => 'left',
                        'options'       => array(
                            'left'          => __('Left', 'uabb'),
                            'right'         => __('Right', 'uabb'),
                            'center'        => __('Center', 'uabb')
                        ),
                    ),
					'title_spacing'     => array(
						'type'          => 'uabb-spacing',
						'label'         => __('Title Padding', 'uabb'),
                        'mode'			=> 'padding',
                        'default'       => '',
                        'placeholder'	=> array(
                        	'top'		=> '5',
                        	'right'		=> '25',
                        	'bottom'	=> '5',
                        	'left'		=> '25'
                        )
					),
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
                            'content'       => __('Content', 'uabb'),
                            'photo'         => __('Photo', 'uabb'),
                            'video'         => __('Video Embed Code', 'uabb'),
                            'saved_rows'        => array(
                                'label'         => __('Saved Rows', 'uabb'),
                                'premium'       => true
                            ),
                            'saved_modules'     => array(
                                'label'         => __('Saved Modules', 'uabb'),
                                'premium'       => true
                            ),
                            'saved_page_templates'      => array(
                                'label'         => __('Saved Page Templates', 'uabb'),
                                'premium'       => true
                            ),
							'youtube'		=> __('YouTube', 'uabb'),
							'vimeo'			=> __('Vimeo', 'uabb'),
							'iframe'		=> __('iFrame', 'uabb' )
                        ),
                        'toggle'        => array(
                            'content'       => array(
								'sections' 		=> array( 'ct_content_typo' ),
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
                            ),
							'youtube'	 => array(
								'sections'  => array( 'video_setting' )
							),
							'vimeo'	 => array(
								'sections'  => array( 'video_setting' )
							),
							'iframe'	 => array(
								'sections'  => array( 'iframe_setting' )
							),
                        )
                    ),
                    'ct_content'   => array(
                        'type'                  => 'editor',
                        'label'                 => '',
                        'default'       => __('Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.','uabb'),
                    ),
                    'ct_photo'     => array(
                        'type'                  => 'photo',
                        'label'                 => __('Select Photo', 'uabb'),
                        'show_remove'           => true,
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
            ),
			'video_setting'		=> array( // Section
				'title'         => __( 'Video Setting', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'video_url'     => array(
						'type'          => 'text',
						'label'         => __( 'Video URL', 'uabb' ),
					),
					'video_ratio'         => array(
						'type'          => 'select',
						'label'         => __('Aspect Ratio', 'uabb'),
						'default'       => 'center',
						'options'       => array(
							'16_9'			=> __('16:9', 'uabb'),
							'4_3'        	=> __('4:3', 'uabb'),
						),
					),
                    'video_autoplay' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Autoplay', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'    => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
				)
			),
			'iframe_setting'		=> array( // Section
				'title'         => __( 'iFrame Setting', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'iframe_url'     => array(
						'type'          => 'text',
						'label'         => __( 'URL', 'uabb' ),
					),
					'iframe_height' => array(
						'type'          => 'text',
						'label'         => __('Height of iFrame', 'uabb'),
						'default'       => '360',
						'placeholder'   => 'auto',
						'maxlength'     => '6',
						'size'          => '8',
						'description'   => 'px',
						'help'         => __('Keep this empty for auto', 'uabb'),
					),
				)
			),
			'type_general'		=> array( // Section
				'title'         => __('Modal Popup Setting', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					/*'modal_size'       => array(
						'type'          => 'select',
						'label'         => __('Modal Content Size', 'uabb'),
						'default'       => 'Custom',
						'options'       => array(
							'full'		=> __('Full Screen', 'uabb'),
							'custom'	=> __('Custom', 'uabb')
						),
						'toggle'        => array(
							'full'	=> array(
								'fields'	 => array('modal_spacing')
							), 
							'custom'     	=> array(
								'fields'      => array('modal_width', 'video_ratio')
							)
						)
					),*/
					'modal_width'     => array(
						'type'          => 'text',
						'label'         => __('Maximum Width of Content', 'uabb'),
						'default'       => '500',
						/*'placeholder'   => '500',*/
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'help'         => __('If you keep this empty title will not display', 'uabb'),
					),
					'modal_spacing'     => array(
						'type'          => 'uabb-spacing',
						'label'         => __('Content Padding', 'uabb'),
                        'mode'			=> 'padding',
                        'default'       => 'padding: 25px;' // Optional
					),
					'modal_effect'         => array(
                    	'type'          => 'select',
                    	'label'         => __('Modal Appear Effect', 'uabb'),
                    	'default'       => 'uabb-effect-1',
                    	'options'       => array(
                        	'uabb-effect-1'			=>	__( 'Fade in &amp; Scale', 'uabb' ),
							'uabb-effect-2'			=>	__( 'Slide in (right)', 'uabb' ),
							'uabb-effect-3'			=>	__( 'Slide in (bottom)', 'uabb' ),
							'uabb-effect-4'			=>	__( 'Newspaper', 'uabb' ),
							'uabb-effect-5'			=>	__( 'Fall', 'uabb' ),
							'uabb-effect-6'			=>	__( 'Side Fall', 'uabb' ),
							/*'uabb-effect-7'			=>	__( 'Sticky Up', 'uabb' ),*/
							'uabb-effect-8'			=>	__( '3D Flip (horizontal)', 'uabb' ),
							'uabb-effect-9'			=>	__( '3D Flip (vertical)', 'uabb' ),
							'uabb-effect-10'		=>	__( '3D Sign', 'uabb' ),
							'uabb-effect-11'		=>	__( 'Super Scaled', 'uabb' ),
							/*'uabb-effect-12'		=>	__( 'Just Me', 'uabb' ),*/
							'uabb-effect-13'		=>	__( '3D Slit', 'uabb' ),
							'uabb-effect-14'		=>	__( '3D Rotate Bottom', 'uabb' ),
							'uabb-effect-15'		=>	__( '3D Rotate In Left', 'uabb' ),
							/*'uabb-effect-16'		=>	__( 'Blur', 'uabb' ),*/
							'uabb-effect-17'		=>	__( 'Let me in', 'uabb' ),
							'uabb-effect-18'		=>	__( 'Make way!', 'uabb' ),
							'uabb-effect-19'		=>	__( 'Slip from top', 'uabb' ),
                    	),
						'preview'       => array(
		                    'type'      => 'none',
		                )
                	),
					'content_bg_color'     => array( 
						'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'	 => 'ffffff',
						'show_reset' => true,
					),
					'overlay_color'        => array( 
						'type'       => 'color',
                        'label'      => __('Overlay Color', 'uabb'),
						'default'    => '000000',
						'show_reset' => true,
					),
                    'overlay_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '75',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
				)
			),
		)
	),
	'modal'			=> array(
		'title'			=> __('Display Settings', 'uabb'),
		'sections'		=> array(
			'modal_sec'		=> array( // Section
				//'title'         => __('Display Modal', 'uabb' ), // Section Title
				'fields'        => array( // Section Fields
					'modal_on'  => array(
						'type'          => 'select',
						'label'         => __('Display Modal On', 'uabb'),
						'default'       => 'button',
						'options'       => array(
							'icon'       	=> __('Icon', 'uabb'),
							'photo'         => __('Image', 'uabb'),
							'text'          => __('Text', 'uabb'),
							'button'        => __('Button', 'uabb'),
							'custom'        => __('Custom Class / ID', 'uabb'),
							'automatic'		=> __('Automatic', 'uabb')
						),
						'toggle'        => array(
							'icon'       => array(
								'fields'		=> array('all_align'),
								'sections'      => array('modal_icon'),
							),
							'photo'       => array(
								'fields'		=> array('all_align'),
								'sections'        => array('modal_photo')
							),
							'text'       => array(
								'fields'		=> array('all_align'),
								'sections'      => array('modal_text', 'text_typography'),
							),
							'button'       => array(
								'sections'        => array('btn-general', 'btn-link', 'btn-style', 'btn-icon', 'btn-colors', 'btn-structure', 'btn_typography'),
							),
							'custom'       => array(
								'sections'        => array('modal_custom')
							),
							'automatic'       => array(
								'sections'        => array('trigger_sec', 'repeat_control_sec')
							),
						)
					),
					'all_align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'uabb'),
						'default'       => 'left',
						'help'			=> __('To align Icon/Image/text use this settings', 'uabb'),
						'options'       => array(
							'center'        => __('Center', 'uabb'),
							'left'          => __('Left', 'uabb'),
							'right'         => __('Right', 'uabb')
						)
					),
				)
			),
			'modal_icon'	=>	array(
				'title'		=> __('Icon', 'uabb' ),
				'fields'	=> array(
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'uabb'),
						'show_remove'	=> true,
					),
					'icon_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'uabb'),
						'default'       => '30',
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
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
				)
			),	
			'modal_photo'	=>	array(
				'title'		=> __('Image', 'uabb' ),
				'fields'	=> array(
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Image', 'uabb'),
						'show_remove'	=> true,
					),
					'img_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'uabb'),
						'default'       => '',
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
					),
				)
			),
			'modal_text'		=> array( // Section
				'title'         => __('Text', 'uabb' ), // Section Title
				'fields'        => array( // Section Fields
					'modal_text'     => array(
						'type'          => 'text',
						'label'         => __('Text', 'uabb'),
						'default'       => __('Click Here','uabb'),
					),
					'text_color' => array( 
						'type'       => 'color',
	                    'label'     => __('Text Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
		            'text_hover_color' => array( 
						'type'       => 'color',
	                    'label'     => __('Text Hover Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
				)
			),
			
			/* Button Start */
			'btn-general'    => array( // Section
                'title'         => __( 'General', 'uabb' ),
                'fields'        => array(
                    'btn_text'          => array(
                        'type'          => 'text',
                        'label'         => __('Text', 'uabb'),
                        'default'       => __('Click Here', 'uabb'),
                    ),
                )
            ),
            //'btn-link'       => BB_Ultimate_Addon_Helper::uabb_section_get( 'btn-link' ),
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
        		'title'	=> __( 'Button Icons', 'uabb'),
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
                    'btn_align'         => array(
                        'type'          => 'select',
                        'label'         => __('Alignment', 'uabb'),
                        'default'       => 'left',
                        'options'       => array(
                            'center'        => __('Center', 'uabb'),
                            'left'          => __('Left', 'uabb'),
                            'right'         => __('Right', 'uabb')
                        )
                    ),
                    'btn_mob_align'         => array(
                        'type'          => 'select',
                        'label'         => __('Mobile Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'center'        => __('Center', 'uabb'),
                            'left'          => __('Left', 'uabb'),
                            'right'         => __('Right', 'uabb')
                        )
                    ),
                )
            ),
			/* Button End */
			'modal_custom'		=> array( // Section
				'title'         => __('Custom', 'uabb' ), // Section Title
				'fields'        => array( // Section Fields
					'modal_custom'     => array(
						'type'          => 'text',
						'label'         => __('Class and/or ID', 'uabb'),
						'default'       => '',
						'placeholder'   => '',
						'help'			=> __( 'Add .Class and/or #ID to open your modal. Multiple ID or Classes separated by comma.', 'uabb' )
					),
				)
			),

			/* Automatic Modal */
			'trigger_sec'		=> array( // Section
				'title'         => __('Smart Launch', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					/* Style Options */
					'exit_intent'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Before User Leaves / Exit Intent', 'uabb' ),
                        'default'       => '0',
                        'options'       => array(
                          	'1'      => __('Yes','uabb'),
                            '0'     => __('No','uabb'),
                        ),
                        'help'			=> __('If enabled, modal popup will load right before user is about to leave your website.', 'uabb')
                    ),
                    'after_second'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'After Few Seconds', 'uabb' ),
                        'default'       => '0',
                        'options'       => array(
                          	'1'      => __('Yes','uabb'),
                            '0'     => __('No','uabb'),
                        ),
						'toggle'        => array(
							'1'       => array(
								'fields'		=> array('after_second_value'),
							),
						),
                        'help'			=> __('If enabled, modal popup will load automatically after few seconds.', 'uabb')
                    ),
                    'after_second_value' => array(
						'type'          => 'text',
						'label'         => __('Load After Seconds', 'uabb'),
						'default'       => '0',
						'maxlength'     => '6',
						'size'          => '8',
						'description'   => 's',
						'help'   		=> __('How long the modal should take to be displayed after the page is loaded? If set to 5, the modal popup will appear after 5 seconds.','uabb'),
					),
				)
			),
			'repeat_control_sec'		=> array( // Section
				'title'         => __('Repeat Control', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'enable_cookies'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Enable Cookies', 'uabb' ),
                        'default'       => '0',
                        'options'       => array(
                          	'1'      => __('Yes','uabb'),
                            '0'     => __('No','uabb'),
                        ),
                        'toggle'        => array(
							'1'       => array(
								'fields'		=> array('close_cookie_days'),
							),
						),
                        'help'			=> __('This will check user history and limit repeat occurrence of modal popup when cookies are enabled. No more annoying modals!', 'uabb')
                    ),
                    'close_cookie_days' => array(
						'type'          => 'text',
						'label'         => __('Do Not Show After Closing', 'uabb'),
						'default'       => '30',
						'maxlength'     => '6',
						'size'          => '8',
						'description'   => 'days',
						'help'   		=> __('How many days this modal should not be displayed after user closes the modal?','uabb'),
					),
				)
			),
		)
	),
	'close'			=> array(
		'title'			=> __('Close Button', 'uabb'),
		'sections'		=> array(
			/* Icon Basic Setting */
			'close_button'		=> array( // Section
				'title'         => __( 'Close Button', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'close_source'         => array(
                    	'type'          => 'select',
                    	'label'         => __('Close as', 'uabb'),
                    	'default'       => 'icon',
                    	'options'       => array(
                        	'icon'        	=> __('Icon', 'uabb'),
                        	'image'        	=> __('Image', 'uabb'),
                    	),
                    	'toggle'		=> array(
                    		'icon'	=> array(
                    			'fields' => array('close_icon', 'close_icon_color')
                    		),
                    		'image'	=> array(
                    			'fields' => array('close_photo')
                    		)
                    	)
                	),
					'close_icon'          => array(
						'type'          => 'icon',
						'label'         => __('Close Icon', 'uabb'),
						'default'		=> 'fa fa-close',
						'show_remove'	=> true,
					),
                    'close_photo'         => array(
						'type'          => 'photo',
						'label'         => __('Image', 'uabb'),
						'show_remove'	=> true,
					),
					'close_icon_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'uabb'),
						'default'       => '',
						'placeholder'	=> '25',
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
					),
					'close_icon_color'        => array( 
						'type'       => 'color',
						'label'      => __('Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
					'icon_position'         => array(
                    	'type'          => 'select',
                    	'label'         => __('Image / Icon Position', 'uabb'),
                    	'default'       => 'top-right',
                    	'options'       => array(
                        	'top-left'        		=> __('Window - Top Left', 'uabb'),
                        	'top-right'        		=> __('Window - Top Right', 'uabb'),
                        	'popup-top-left'    	=> __('Popup - Top Left', 'uabb'),
                        	'popup-top-right'   	=> __('Popup - Top Right', 'uabb'),
                        	'popup-edge-top-left'    => __('Popup Edge - Top Left', 'uabb'),
                        	'popup-edge-top-right'   => __('Popup Edge - Top Right', 'uabb'),
                    	),
                	),
				)
			),
			'close_modal_on'		=> array( // Section
				'title'         => __( 'Close Modal On', 'uabb'), // Section Title
				'fields'        => array( // Section Fields
					'esc_keypress'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'ESC Keypress', 'uabb' ),
                        'default'       => '0',
                        'options'       => array(
                          	'1'      => __('Yes','uabb'),
                            '0'     => __('No','uabb'),
                        ),
                    ),
					'overlay_click'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Overlay Click', 'uabb' ),
                        'default'       => '0',
                        'options'       => array(
                          	'1'      => __('Yes','uabb'),
                            '0'     => __('No','uabb'),
                        ),
                    ),
				)
			),
		)
	),
	'typography'	=> array(
		'title'         => __('Typography', 'uabb'), // Tab title
		'sections'		=> array(
			'title_typo'    =>  array(
                'title'     => __('Title', 'uabb' ) ,
                'fields'    => array(
                    'title_tag_selection'   => array(
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
                    'title_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-modal-title'
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
                    ),
                    'title_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'title_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'title_bg_color' => array( 
						'type'       => 'color',
	                    'label'         => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
		            'title_bg_color_opc' => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                )
            ),
			'ct_content_typo'    =>  array(
            	'title'     => __('Content', 'uabb' ) ,
                'fields'    => array(
                    'ct_content_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-modal-text'
                        )
                    ),
                    'ct_content_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'ct_content_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'ct_content_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
            'text_typography'    =>  array(
                'title'     => __('Modal Appear On - Text Typography', 'uabb' ) ,
            	'fields'    => array(
                    'font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-modal-action'
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
                    ),
                    'line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                )
            ),
            'btn_typography'    =>  array(
                'title'     => __('Modal Appear On - Button Typography', 'uabb' ) ,
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
                            'selector'        => '.uabb-creative-button'
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
                    ),
                    'btn_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                )
            ),
		)
	)
));
