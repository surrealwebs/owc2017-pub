<?php

/**
 * A module that adds a simple subscribe form to your layout
 * with third party optin integration.
 *
 * @since 1.5.2
 */
class UABBSubscribeFormModule extends FLBuilderModule {

	/** 
	 * @since 1.5.2
	 * @return void
	 */  
	public function __construct()
	{
		parent::__construct( array(
			'name'          	=> __( 'Subscription Form', 'uabb' ),
			'description'   	=> __( 'Adds a simple subscribe form to your layout.', 'uabb' ),
			'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/mailchimp-subscribe-form/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/mailchimp-subscribe-form/',
			'partial_refresh'	=> true,
			'icon'				=> 'editor-table.svg',
		));
		
		add_action( 'wp_ajax_uabb_subscribe_form_submit', array( $this, 'submit' ) );
		add_action( 'wp_ajax_nopriv_uabb_subscribe_form_submit', array( $this, 'submit' ) );
	}

	/** 
	 * Called via AJAX to submit the subscribe form. 
	 *
	 * @since 1.5.2
	 * @return string The JSON encoded response.
	 */  
	public function submit()
	{
		$fname       		= isset( $_POST['fname'] ) ? sanitize_text_field( $_POST['fname'] ) : false;
		$lname       		= isset( $_POST['lname'] ) ? sanitize_text_field( $_POST['lname'] ) : false;
		$name       		= ( isset( $fname ) || isset( $lname ) ) ? sanitize_text_field( $fname . ' ' . $lname ) : false;
		$email      		= isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : false;
		$node_id    		= isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$template_id    	= isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
		$template_node_id   = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
		$result    			= array(
			'action'    		=> false,
			'error'     		=> false,
			'message'   		=> false,
			'url'       		=> false
		);
		
		if ( $email && $node_id ) {
			
			// Get the module settings.
			if ( $template_id ) {
				$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
				$data	  = FLBuilderModel::get_layout_data( 'published', $post_id );
				$settings = $data[ $template_node_id ]->settings;
			}
			else {
				$module   = FLBuilderModel::get_module( $node_id );
				$settings = $module->settings;
			}
			
			// Subscribe.
			$instance = FLBuilderServices::get_service_instance( $settings->service );
			$response = $instance->subscribe( $settings, $email, $name );
			
			// Check for an error from the service.
			if ( $response['error'] ) {
				$result['error'] = $response['error'];
			}
			// Setup the success data.
			else {
				
				$result['action'] = $settings->success_action;
				
				if ( 'message' == $settings->success_action ) {
					$result['message']  = $settings->success_message;
				}
				else {
					$result['url']  = $settings->success_url;
				}
			}
		}
		else {
			$result['error'] = __( 'There was an error subscribing. Please try again.', 'uabb' );
		}
		
		echo json_encode( $result );
		
		die();
	}
}

$notice = '';
$p = '#(\.0+)+($|-)#';
$ver1 = preg_replace($p, '', FL_BUILDER_VERSION);
$ver2 = preg_replace($p, '', '1.8.4');
if( version_compare( $ver1, $ver2 ) < 0 ) {
	$notice = __( 'Subscription Form requires Beaver Builder versions above 1.8.4. Make sure you use latest Beaver Builder to view best results.' , 'uabb' );
}


/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'UABBSubscribeFormModule', array(
	'general'       => array(
		'title'         => __( 'General', 'uabb' ),
		'sections'      => array(
			'service_msg'       => array(
				'title'         => '',
				'fields'          => array(
					'mailchimp_warning_msg' => array(
						'type'     => 'uabb-msgbox',
						'label'    => '',
						'msg-type' => 'warning',
						'content'  => $notice,
					),
				),

			),
			'service'       => array(
				'title'         => '',
				'file'          => plugin_dir_path( __FILE__ ) . 'includes/service-settings.php',
				'services'      => 'autoresponder'
			),
			'heading'        => array(
				'title'         => __( 'Heading', 'uabb' ),
				'fields'        => array(
					'heading'        => array(
						'type'          => 'text',
						'label'         => __('Heading', 'uabb'),
						'default'		=> __('SIGN UP NOW FOR A FREE COURSE', 'uabb'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-sf-heading'
						),
						'connections' => array( 'string', 'html' )
					),
					'subheading'     => array(
						'type'          => 'text',
						'label'         => __('Sub-Heading', 'uabb'),
						'default'		=> __('Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'uabb'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.uabb-sf-subheading'
						),
						'connections' => array( 'string', 'html' )
					),
				)
			),
			'form_fields'        => array(
				'title'         => __( 'Form Fields', 'uabb' ),
				'fields'        => array(
					'show_fname' => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Show First Name', 'uabb'),
						'default'       => 'yes',
						'options'       => array(
							'yes'        => __('Yes', 'uabb'),
							'no'          => __('No', 'uabb'),
						),
						'toggle' => array(
							'yes' => array(
								'fields' => array( 'fname_label' )
							)
						)
					),
					'fname_label'     => array(
						'type'          => 'text',
						'label'         => __('First Name Placeholder', 'uabb'),
						'placeholder' => __('Your Name', 'uabb'),
					),
					'show_lname' => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __('Show Last Name', 'uabb'),
						'default'       => 'no',
						'options'       => array(
							'yes'        => __('Yes', 'uabb'),
							'no'          => __('No', 'uabb'),
						),
						'toggle' => array(
							'yes' => array(
								'fields' => array( 'lname_label' )
							)
						)
					),
					'lname_label'     => array(
						'type'          => 'text',
						'label'         => __('Last Name Placeholder', 'uabb'),
						'placeholder' 	=> __('Last Name', 'uabb'),
					),
					'email_placeholder'     => array(
						'type'          => 'text',
						'label'         => __('Email Placeholder', 'uabb'),
						'placeholder' 	=> __('Your Email', 'uabb'),
					),
				)
			),
			'bottom_text'        => array(
				'title'         => __( 'Bottom Text', 'uabb' ),
				'fields'        => array(
					'bottom_text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'			=> 6,
						'default'		=> __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'uabb'),
						'connections'	=> array( 'string', 'html' ),
						'preview'         => array(
                            'type'          => 'text',
                            'selector'      => '.uabb-sf-bottom-text',
                        )
					),
				)
			),
			'success'       => array(
				'title'         => __( 'Success', 'uabb' ),
				'fields'        => array(
					'success_action' => array(
						'type'          => 'select',
						'label'         => __( 'Success Action', 'uabb' ),
						'options'       => array(
							'message'       => __( 'Show Message', 'uabb' ),
							'redirect'      => __( 'Redirect', 'uabb' )
						),
						'toggle'        => array(
							'message'       => array(
								'fields'        => array( 'success_message' )
							),
							'redirect'      => array(
								'fields'        => array( 'success_url' )
							)
						),
						'preview'       => array(
							'type'             => 'none'  
						)
					),
					'success_message' => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'          => 8,
						'default'       => __( 'Thanks for subscribing! Please check your email for further instructions.', 'uabb' ),
						'preview'       => array(
							'type'             => 'none'  
						),
						'connections'	=> array( 'string', 'html' )
					),
					'success_url'  => array(
						'type'          => 'link',
						'label'         => __( 'Success URL', 'uabb' ),
						'preview'       => array(
							'type'             => 'none'  
						),
						'connections' => array( 'url' )
					)
				)
			)
		)
	),
	'style'        => array(
		'title'         => __( 'Style', 'uabb' ),
		'sections'      => array(
			'structure'        => array(
				'title'         => __( '', 'uabb' ),
				'fields'        => array(
					'overall_alignment'        => array(
						'type'          => 'select',
						'label'         => __( 'Overall Alignment', 'uabb' ),
						'default'       => 'left',
						'help'          => __( 'This is the overall content alignment', 'uabb'),
						'options'       => array(
							'left'       => __( 'Left', 'uabb' ),
							'right'        => __( 'Right', 'uabb' ),
							'center'        => __( 'Center', 'uabb' ),
						)
					),
					'resp_overall_alignment'        => array(
						'type'          => 'select',
						'label'         => __( 'Responsive Alignment', 'uabb' ),
						'default'       => 'default',
						'help'          => __( 'This is the Responsive overall content alignment', 'uabb'),
						'options'       => array(
							'default'		=> __( 'Default', 'uabb' ),
							'left'			=> __( 'Left', 'uabb' ),
							'right'			=> __( 'Right', 'uabb' ),
							'center'		=> __( 'Center', 'uabb' ),
						)
					),
					'padding' => array(
                        'type'      => 'uabb-spacing',
                        'label'     => __( 'Padding', 'uabb' ),
                        'mode'      => 'padding',                        
						'help'          => __( 'Apply padding to your element from all sides.', 'uabb'),
                    ),
                    'background_color' => array( 
						'type'       => 'color',
                        'label'         => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-subscribe-form',
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
                    'layout'        => array(
						'type'          => 'uabb-toggle-switch',
						'label'         => __( 'Layout', 'uabb' ),
						'default'       => 'stacked',
						'help'          => __( 'The appearance of the Subscribe Form', 'uabb'),
						'options'       => array(
							'stacked'       => __( 'Stacked', 'uabb' ),
							'inline'        => __( 'Inline', 'uabb' ),
						),
						'toggle'		=> array(
							'inline'	=> array(
								'fields'	=> array( 'responsive' ),
							)
						),
					),
					'responsive'        => array(
						'type'          => 'select',
						'label'         => __( 'Responsive Compatibility', 'uabb' ),
						'default'       => 'left',
						'help'          => __( 'There might be responsive issues with inline style. If you are facing such issues then select appropriate devices width to make your module responsive.', 'uabb'),
						'options'       => array(
							'none'			=> __( 'None', 'uabb' ),
							'small'			=> __( 'Small Device', 'uabb' ),
							'small_medium'	=> __( 'Medium and Small Device', 'uabb' ),
						),
						'toggle'		=> array(
							'small'	=> array(
								'fields'	=> array( 'res_spacing' ),
							),
							'small_medium'	=> array(
								'fields'	=> array( 'res_spacing' ),
							)
						),
					),
					'res_spacing' => array(
						'type'              => 'text',
						'label'             => __('Responsive Spacing', 'uabb'),
						'size'              => '8',
						'placeholder'		=> '10',
						'description'       => 'px',
						'help'          => __( 'Space between form fields in responsive view.', 'uabb'),
					),
				)
			),
			'style'        => array(
				'title'         => __( 'Form Input Style', 'uabb' ),
				'fields'        => array(
					'spacing' => array(
						'type'              => 'text',
						'label'             => __('Spacing', 'uabb'),
						'size'              => '8',
						'placeholder'		=> '10',
						'description'       => 'px',
						'help'          => __( 'Space between form fields.', 'uabb'),
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-form-field',
                            'property'      => 'margin-bottom',
                            'unit'			=> 'px'
                        )
					),
					'form_style'        => array(
						'type'          => 'select',
						'label'         => __( 'Form Style', 'uabb' ),
						'default'       => 'style1',
						'options'       => array(
							'style1'       => __( 'Style 1', 'uabb' ),
							'style2'        => __( 'Style 2', 'uabb' ),
						),
						'toggle' => array(
							'style1' => array(
								'fields' => array( 'input_background_color', 'input_background_color_opc' )
							)
						)
					),
					'input_text_color' => array( 
						'type'       => 'color',
                        'label'         => __('Text Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-form-field input',
                            'property'      => 'color',
                        )
					),
                    'input_background_color' => array( 
						'type'       => 'color',
                        'label'         => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-form-field input',
                            'property'      => 'background',
                        )
					),
                    'input_background_color_opc'    => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                    'border_width' => array(
						'type'              => 'text',
						'label'             => __('Border Width', 'uabb'),
						'default'           => '',
						'placeholder'		=> '1',
						'size'              => '8',
						'description'       => 'px',
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-form-field input',
                            'property'      => 'border-width',
                            'unit'			=> 'px'
                        )
					),
					'border_color' => array( 
						'type'       => 'color',
                        'label'         => __('Border Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
						'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-form-field input',
                            'property'      => 'border-color',
                        )
					),
                    'border_active_color' => array( 
						'type'       => 'color',
                        'label'         => __('Border Active Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
                    'vertical_padding' => array(
						'type'              => 'text',
						'label'             => __('Vertical Padding', 'uabb'),
						'default'           => '',
						'placeholder'		=> '12',
						'size'              => '8',
						'description'       => 'px',
						'preview'       => array(
					        'type'          => 'css',
					        'rules'           => array(
					            array(
					                'selector'     => '.uabb-form-field input',
					                'property'     => 'padding-top',
					                'unit'		=> 'px'
					            ),
					            array(
					                'selector'     => '.uabb-form-field input',
					                'property'     => 'padding-bottom',
					                'unit'		=> 'px'
					            ),    
					        )
					    )
					),
					'horizontal_padding' => array(
						'type'              => 'text',
						'label'             => __('Horizontal Padding', 'uabb'),
						'default'           => '',
						'placeholder'		=> '15',
						'size'              => '8',
						'description'       => 'px',
						'preview'       => array(
					        'type'          => 'css',
					        'rules'           => array(
					            array(
					                'selector'     => '.uabb-form-field input',
					                'property'     => 'padding-left',
					                'unit'		=> 'px'
					            ),
					            array(
					                'selector'     => '.uabb-form-field input',
					                'property'     => 'padding-right',
					                'unit'		=> 'px'
					            ),    
					        )
					    )
					),
				)
			),
		)
	),
	'button'        => array(
		'title'         => __( 'Button', 'uabb' ),
		'sections'      => array(
			'btn-general'    => array(
				'title'         => __( 'General', 'uabb' ),
		        'fields'        => array(
		            'btn_text'          => array(
		                'type'          => 'text',
		                'label'         => __('Text', 'uabb'),
		                'default'       => __('Subscribe', 'uabb'),
		                'preview'         => array(
                            'type'          => 'text',
                            'selector'      => '.uabb-form-button .uabb-button-text',
                        )
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
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-form-button .uabb-button-text',
                            'property'		=> 'color'
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
					        'rules'           => array(
					            array(
					                'selector'     => '.uabb-form-button .uabb-button-wrap a',
					                'property'     => 'border-color'
					            ),
					            array(
					                'selector'     => '.uabb-form-button .uabb-button-wrap a',
					                'property'     => 'background'
					            ),    
					        )
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
                                'fields'        => array()
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
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a',
                            'property'      => 'width',
                            'unit'			=> 'px'
                        )
                    ),
                    'btn_custom_height'  => array(
                        'type'          => 'text',
                        'label'         => __('Custom Height', 'uabb'),
                        'default'       => '45',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a',
                            'property'      => 'min-height',
                            'unit'			=> 'px'
                        )
                    ),
                    'btn_padding_top_bottom'       => array(
                        'type'          => 'text',
                        'label'         => __('Padding Top/Bottom', 'uabb'),
                        'placeholder'   => '0',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'       => array(
					        'type'          => 'css',
					        'rules'           => array(
					            array(
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-top',
					                'unit'			=> 'px'
					            ),
					            array(
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-bottom',
					                'unit'			=> 'px'
					            ),    
					        )
					    )
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
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-left',
					                'unit'			=> 'px'
					            ),
					            array(
					                'selector'     => '.uabb-creative-button-wrap a',
					                'property'     => 'padding-right',
					                'unit'			=> 'px'
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
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-creative-button-wrap a',
                            'property'      => 'border-radius',
                            'unit'			=> 'px'
                        )
                    ),
                )
            ),
		)
	),
	'typography'        => array(
		'title'         => __( 'Typography', 'uabb' ),
		'sections'      => array(
			'heading_typography' => array(
                'title' => __('Heading', 'uabb' ),
                'fields'    => array(
                    'heading_tag_selection'   => array(
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
                    'heading_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-sf-heading'
                        )
                    ),
                    'heading_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-sf-heading',
                            'property'		=> 'font-size',
                            'unit'			=> 'px'
                        )
                    ),
                    'heading_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                       	'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-sf-heading',
                            'property'		=> 'line-height',
                            'unit'			=> 'px'
                        )
                    ),
                    'heading_color'        => array(
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-sf-heading',
                            'property'		=> 'color',
                        )
                    ),
					'heading_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Margin Bottom', 'uabb'),
						'size'              => '5',
						'placeholder'		=> '0',
						'description'       => 'px',
						'preview'         => array(
							'type'				=> 'css',
							'property'			=> 'margin-bottom',
							'selector'			=> '.uabb-sf-heading',
							'unit'				=> 'px'
						)
					),
                )
            ),
            'subheading_typography' => array(
                'title' => __('Sub Heading', 'uabb' ),
                'fields'    => array(
                    'subheading_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h6',
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
                    'subheading_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
						'preview'         => array(
						    'type'            => 'font',
						    'selector'        => '.uabb-sf-subheading'
						)
                    ),
                    'subheading_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
						    'type'            => 'css',
						    'selector'        => '.uabb-sf-subheading',
						    'property'		=> 'font-size',
						    'unit'			=> 'px'
						)
                    ),
                    'subheading_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
						    'type'            => 'css',
						    'selector'        => '.uabb-sf-subheading',
						    'property'		=> 'line-height',
						    'unit'			=> 'px'
						)
                    ),
                    'subheading_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
						    'type'            => 'css',
						    'selector'        => '.uabb-sf-subheading',
						    'property'		=> 'color',
						)
                    ),
                    'subheading_margin_bottom' => array(
						'type'              => 'text',
						'label'             => __('Margin Bottom', 'uabb'),
						'size'              => '5',
						'placeholder'		=> '20',
						'description'       => 'px',
						'preview'         => array(
							'type'				=> 'css',
							'property'			=> 'margin-bottom',
							'selector'			=> '.uabb-sf-subheading',
							'unit'				=> 'px'
						)
					),
                )
            ),
            'text_typography' => array(
                'title' => __('Bottom Text', 'uabb' ),
                'fields'    => array(
                    'text_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-sf-bottom-text'
                        )
                    ),
                    'text_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-sf-bottom-text',
                            'property'		=> 'font-size',
                            'unit'			=> 'px'
                        )
                    ),
                    'text_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                    	   'type'            => 'css',
                            'selector'        => '.uabb-sf-bottom-text',
                            'property'		=> 'line-height',
                            'unit'			=> 'px'
                        )
                    ),
                    'text_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                    	    'type'            => 'css',
                            'selector'        => '.uabb-sf-bottom-text',
                            'property'		=> 'color',
                        )
                    ),
                    'text_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Margin Top', 'uabb'),
						'size'              => '5',
						'placeholder'		=> '20',
						'description'       => 'px',
						'preview'         => array(
							'type'				=> 'css',
							'property'			=> 'margin-top',
							'selector'			=> '.uabb-sf-bottom-text',
							'unit'				=> 'px'
						)
					),
                )
            ),
			'input_typography'    =>  array(
				'title' => __( 'Input Text', 'uabb' ),
                'fields'    => array(
                    'input_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> 'input[type="text"], input[type="text"] ~ label'
                    	),
                    ),
                    'input_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> 'input[type="text"], input[type="text"] ~ label',
                            'property'	=> 'font-size',
                            'unit'		=> 'px'
                    	),
                    ),
                    'input_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                       'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> 'input[type="text"], input[type="text"] ~ label',
                            'property'	=> 'line-height',
                            'unit'		=> 'px'
                    	),
                    ),
                )
            ),
            'btn_typography'    =>  array(
				'title' => __( 'Button Text', 'uabb' ),
                'fields'    => array(
                    'btn_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'	=> array(
                            'type'		=> 'font',
                            'selector'	=> 'a.uabb-button'
                    	),
                    ),
                    'btn_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> 'a.uabb-button',
                            'property'	=> 'font-size',
                            'unit'		=> 'px'
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
                        'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> 'a.uabb-button',
                            'property'	=> 'line-height',
                            'unit'		=> 'px'
                    	),
                    ),
                    'btn_margin_top' => array(
						'type'              => 'text',
						'label'             => __('Margin Top', 'uabb'),
						'size'              => '5',
						'description'       => 'px',
						'preview'	=> array(
                            'type'		=> 'css',
                            'selector'	=> 'a.uabb-button',
                            'property'	=> 'margin-top',
                            'unit'		=> 'px'
                    	),
					),
                )
            ),
		)
	)
));
