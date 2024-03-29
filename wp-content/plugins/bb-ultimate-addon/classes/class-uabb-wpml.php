<?php
/**
 * UABB WPML Translatable
 *
 * @since 1.6.7
 */

if( !class_exists( 'UABB_WPML_Translatable' ) ) {

final class UABB_WPML_Translatable {

	/** 
	 * Call nodes.
	 *
	 * @since 1.6.7
	 * @return void
	 */
	static public function init()
	{
		add_filter( 'wpml_beaver_builder_modules_to_translate',   __CLASS__ . '::wpml_uabb_modules_translate' );
		UABB_WPML_Translatable::load_files();
	}

	static public function load_files()
	{

		if( class_exists( 'WPML_Page_Builders_Defined' ) ) {
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-progress-bar.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-info-circle.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-ihover.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-creative-link.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-accordion.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-tabs.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-hotspot.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-testimonials.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-googlemap.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-infolist.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-advanced-icon.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-list-icon.php';
		}

	}

	/**
	 * initialize nodes to translate
	 *
	 * @since 1.6.7
	 * @param array  $form
	 * @param string $slug
	 * @return array
	 */
	static public function wpml_uabb_modules_translate( $form ) {

		// Heading Module
		$form['uabb-heading'] = array(
			'conditions' => array( 'type' => 'uabb-heading' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Text Editor', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Button Module
		$form['uabb-button'] = array(
			'conditions' => array( 'type' => 'uabb-button' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Button', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'link',
					'type'        => __( 'Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Call to Action Module
		$form['uabb-call-to-action'] = array(
			'conditions' => array( 'type' => 'uabb-call-to-action' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Call to Action: Heading', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'text',
					'type'        => __( 'Call to Action: Text', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Call to Action: Button text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_link',
					'type'        => __( 'Call to Action: Button link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Countdown Module
		$form['uabb-countdown'] = array(
			'conditions' => array( 'type' => 'uabb-countdown' ),
			'fields'     => array(
				array(
					'field'       => 'expire_message',
					'type'        => __( 'Countdown: Timer expiry message', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		// Advanced Accordion Module
		$form['advanced-accordion'] = array(
			'conditions'        => array( 'type' => 'advanced-accordion' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Accordion',
		);

		// Advanced Tabs
		$form['advanced-tabs'] = array(
			'conditions'        => array( 'type' => 'advanced-tabs' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Tabs',
		);

		// Info Box
		$form['info-box'] = array(
			'conditions'        => array( 'type' => 'info-box' ),
			'fields'     => array(
				array(
					'field'       => 'heading_prefix',
					'type'        => __( 'Info Box: Title Prefix', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'title',
					'type'        => __( 'Info Box: Title', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'text',
					'type'        => __( 'Info Box: Desciption', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'cta_text',
					'type'        => __( 'Info Box: Call to action text ', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Info Box: Button text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_link',
					'type'        => __( 'Info Box: Button link', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'link',
					'type'        => __( 'Info Box: Entire Module link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Ribbon
		$form['ribbon'] = array(
			'conditions' => array( 'type' => 'ribbon' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Ribbon Message', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Modal
		$form['modal-popup'] = array(
			'conditions' => array( 'type' => 'modal-popup' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Modal Title', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'modal_text',
					'type'        => __( 'Display Modal Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Modal Button Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'ct_content',
					'type'        => __( 'Modal Content', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		// Subscription Form
		$form['mailchimp-subscribe-form'] = array(
			'conditions' => array( 'type' => 'mailchimp-subscribe-form' ),
			'fields'     => array(
				array(
					'field'       => 'heading',
					'type'        => __( 'Subscription Form Heading', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'subheading',
					'type'        => __( 'Subscription Form Subheading', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'fname_label',
					'type'        => __( 'First Name Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'lname_label',
					'type'        => __( 'Last Name Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'email_placeholder',
					'type'        => __( 'Email Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Email Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'bottom_text',
					'type'        => __( 'Subscription Form : Bottom text', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'success_message',
					'type'        => __( 'Subscription Form : Success Message', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'success_url',
					'type'        => __( 'Subscription Form : Success URL', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Gravity Form Styler
		$form['uabb-gravity-form'] = array(
			'conditions' => array( 'type' => 'uabb-gravity-form' ),
			'fields'     => array(
				array(
					'field'       => 'form_title',
					'type'        => __( 'Gravity Form Title', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'form_desc',
					'type'        => __( 'Gravity Form Description', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		// CF7 Styler
		$form['uabb-contact-form7'] = array(
			'conditions' => array( 'type' => 'uabb-contact-form7' ),
			'fields'     => array(
				array(
					'field'       => 'form_title',
					'type'        => __( 'Gravity Form Title', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'form_desc',
					'type'        => __( 'Gravity Form Description', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		//Contact Form
		$form['uabb-contact-form'] = array(
			'conditions' => array( 'type' => 'uabb-contact-form' ),
			'fields'     => array(
				array(
					'field'       => 'name_label',
					'type'        => __( 'Contact Form : Name Label', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'name_placeholder',
					'type'        => __( 'Contact Form : Name Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'email_label',
					'type'        => __( 'Contact Form : Email Label', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'email_placeholder',
					'type'        => __( 'Contact Form : Email Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'subject_label',
					'type'        => __( 'Contact Form : Subject Label', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'subject_placeholder',
					'type'        => __( 'Contact Form : Subject Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'phone_label',
					'type'        => __( 'Contact Form : Phone Label', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'phone_placeholder',
					'type'        => __( 'Contact Form : Phone Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'msg_label',
					'type'        => __( 'Contact Form : Message Label', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'msg_placeholder',
					'type'        => __( 'Contact Form : Message Placeholder', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'success_message',
					'type'        => __( 'Contact Form : Success Message', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'success_url',
					'type'        => __( 'Contact Form : Success URL', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Contact Form : Button Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// hotspot module
		$form['uabb-hotspot'] = array(
			'conditions'        => array( 'type' => 'uabb-hotspot' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Hotspot',
		);

		// Countdown
		$form['uabb-countdown'] = array(
			'conditions' => array( 'type' => 'uabb-countdown' ),
			'fields'     => array(
				array(
					'field'       => 'expire_message',
					'type'        => __( 'Countdown : Expire Message', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'redirect_link',
					'type'        => __( 'Countdown : Redirect Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'year_plural_label',
					'type'        => __( 'Countdown : Years Label ( Plural )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'year_singular_label',
					'type'        => __( 'Countdown : Year Label ( Singular )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'month_plural_label',
					'type'        => __( 'Countdown : Months Label ( Plural )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'month_singular_label',
					'type'        => __( 'Countdown : Month Label ( Singular )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'day_plural_label',
					'type'        => __( 'Countdown : Days Label ( Plural )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'day_singular_label',
					'type'        => __( 'Countdown : Day Label ( Singular )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'hour_plural_label',
					'type'        => __( 'Countdown : Hours Label ( Plural )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'hour_singular_label',
					'type'        => __( 'Countdown : Hour Label ( Singular )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'minute_plural_label',
					'type'        => __( 'Countdown : Minutes Label ( Plural )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'minute_singular_label',
					'type'        => __( 'Countdown : Minute Label ( Singular )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'second_plural_label',
					'type'        => __( 'Countdown : Seconds Label ( Plural )', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'second_singular_label',
					'type'        => __( 'Countdown : Second Label ( Singular )', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Before After Slider
		$form['uabb-beforeafterslider'] = array(
			'conditions' => array( 'type' => 'uabb-beforeafterslider' ),
			'fields'     => array(
				array(
					'field'       => 'before_label_text',
					'type'        => __( 'Before After Slider : Before text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'after_label_text',
					'type'        => __( 'Before After Slider : After text', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Advanced Testimonials
		$form['adv-testimonials'] = array(
			'conditions'        => array( 'type' => 'adv-testimonials' ),
			'fields'            => array(
				array(
					'field'       => 'testimonial_author_no_slider',
					'type'        => __( 'Testimonials : Author Name', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'testimonial_designation_no_slider',
					'type'        => __( 'Testimonials : Designation', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'testimonial_description',
					'type'        => __( 'Testimonials : Description', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
			),
			'integration-class' => 'WPML_UABB_Testimonials',
		);

		// Team
		$form['team'] = array(
			'conditions' => array( 'type' => 'team' ),
			'fields'     => array(
				array(
					'field'       => 'name',
					'type'        => __( 'Team : Name', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'designation',
					'type'        => __( 'Team : Designation', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __( 'Team : Description', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'custom_link',
					'type'        => __( 'Team : Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Counter Module
		$form['uabb-numbers'] = array(
			'conditions' => array( 'type' => 'uabb-numbers' ),
			'fields'     => array(
				array(
					'field'       => 'before_number_text',
					'type'        => __( 'Counter : Text Above Number', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'before_counter_text',
					'type'        => __( 'Counter : Text Before Counter', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'after_number_text',
					'type'        => __( 'Counter : Text Below Number', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'after_counter_text',
					'type'        => __( 'Counter : Text After Counter', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'number_prefix',
					'type'        => __( 'Counter :  Number Prefix', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'number_suffix',
					'type'        => __( 'Counter :  Number Suffix', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Dual Button Module
		$form['dual-button'] = array(
			'conditions' => array( 'type' => 'dual-button' ),
			'fields'     => array(
				array(
					'field'       => 'button_one_title',
					'type'        => __( 'Dual Button : Button One Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'button_one_link',
					'type'        => __( 'Dual Button : Button One Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'button_two_title',
					'type'        => __( 'Dual Button : Button Two Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'button_two_link',
					'type'        => __( 'Dual Button : Button Two Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'divider_text',
					'type'        => __( 'Dual Button : Divider Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Dual Color Heading Module
		$form['dual-color-heading'] = array(
			'conditions' => array( 'type' => 'dual-color-heading' ),
			'fields'     => array(
				array(
					'field'       => 'first_heading_text',
					'type'        => __( 'Dual Color Heading : First Heading', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'second_heading_text',
					'type'        => __( 'Dual Color Heading : Second Heading', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Fancy Text Module
		$form['fancy-text'] = array(
			'conditions' => array( 'type' => 'fancy-text' ),
			'fields'     => array(
				array(
					'field'       => 'prefix',
					'type'        => __( 'Fancy Text : Prefix', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'fancy_text',
					'type'        => __( 'Fancy Text : Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'suffix',
					'type'        => __( 'Fancy Text : Suffix', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'cursor_text',
					'type'        => __( 'Fancy Text : Cursor Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Flip Box Module
		$form['flip-box'] = array(
			'conditions' => array( 'type' => 'flip-box' ),
			'fields'     => array(
				array(
					'field'       => 'title_front',
					'type'        => __( 'Flip Box : Title on Front', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'desc_front',
					'type'        => __( 'Flip Box : Description on Front', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'title_back',
					'type'        => __( 'Flip Box : Title on Back', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'desc_back',
					'type'        => __( 'Flip Box : Description on Back', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		// Image Separator Module
		$form['image-separator'] = array(
			'conditions' => array( 'type' => 'image-separator' ),
			'fields'     => array(
				array(
					'field'       => 'link',
					'type'        => __( 'Image Separator : Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Interactive Banner 2 Module
		$form['interactive-banner-2'] = array(
			'conditions' => array( 'type' => 'interactive-banner-2' ),
			'fields'     => array(
				array(
					'field'       => 'link_url',
					'type'        => __( 'Interactive Banner 2 : Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'banner_title',
					'type'        => __( 'Interactive Banner 2 : Title', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'banner_desc',
					'type'        => __( 'Interactive Banner 2 : Description', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
			),
		);
		
		// Slide Box Module
		$form['slide-box'] = array(
			'conditions' => array( 'type' => 'slide-box' ),
			'fields'     => array(
				array(
					'field'       => 'title_front',
					'type'        => __( 'Slide Box : Title on Front', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'desc_front',
					'type'        => __( 'Slide Box : Description on Front', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'title_back',
					'type'        => __( 'Slide Box : Title on Back', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'desc_back',
					'type'        => __( 'Slide Box : Description on Back', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'link',
					'type'        => __( 'Slide Box : CTA Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'cta_text',
					'type'        => __( 'Slide Box : CTA Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Advanced Separator Module
		$form['advanced-separator'] = array(
			'conditions' => array( 'type' => 'advanced-separator' ),
			'fields'     => array(
				array(
					'field'       => 'text_inline',
					'type'        => __( 'Advanced Separator : Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Creative Link Module
		$form['creative-link'] = array(
			'conditions'        => array( 'type' => 'creative-link' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Creative_Link',
		);

		// iHover Module
		$form['ihover'] = array(
			'conditions'        => array( 'type' => 'ihover' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Ihover',
		);

		// Info Circle Module
		$form['info-circle'] = array(
			'conditions'        => array( 'type' => 'info-circle' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Info_Circle',
		);


		// Progress Bar Module
		$form['progress-bar'] = array(
			'conditions'        => array( 'type' => 'progress-bar' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Progres_Bar',
		);

		// Google Map Module
		$form['google-map'] = array(
			'conditions'        => array( 'type' => 'google-map' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Googlemap',
		);

		// Info Banner
		$form['info-banner'] = array(
			'conditions' => array( 'type' => 'info-banner' ),
			'fields'     => array(
				array(
					'field'       => 'banner_title',
					'type'        => __( 'Info Banner: Title', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'banner_desc',
					'type'        => __( 'Info Banner: Description', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'cta_text',
					'type'        => __( 'Info Banner: Call to action text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Info Banner: Button text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_link',
					'type'        => __( 'Info Banner : Call to action button link', 'uabb' ),
					'editor_type' => 'LINK'
				),
				array(
					'field'       => 'link',
					'type'        => __( 'Info Banner: Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Info list Module
		$form['info-list'] = array(
			'conditions'        => array( 'type' => 'info-list' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Infolist',
		);

		// Photo
		$form['uabb-photo'] = array(
			'conditions' => array( 'type' => 'uabb-photo' ),
			'fields'     => array(
				array(
					'field'       => 'link_url',
					'type'        => __( 'Photo : Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Advanced icon
		$form['advanced-icon'] = array(
			'conditions'        => array( 'type' => 'advanced-icon' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_AdvanceIcons',
		);

		// Advanced posts
		$form['blog-posts'] = array(
			'conditions' => array( 'type' => 'blog-posts' ),
			'fields'     => array(
				array(
					'field'       => 'cta_text',
					'type'        => __( 'Advanced Posts : Call to action text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Advanced Posts : Button Text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'no_results_message',
					'type'        => __( 'Advanced Posts : No Results Message', 'uabb' ),
					'editor_type' => 'LINE'
				),
			),
		);

		// Info Table
		$form['info-table'] = array(
			'conditions' => array( 'type' => 'info-table' ),
			'fields'     => array(
				array(
					'field'       => 'it_title',
					'type'        => __( 'Info Table : Heading', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'sub_heading',
					'type'        => __( 'Info Table : Sub Heading', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'it_long_desc',
					'type'        => __( 'Info Table : Description', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'button_text',
					'type'        => __( 'Info Table : Call to action button text', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'it_link',
					'type'        => __( 'Info Table : Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// Interactive banner 1
		$form['interactive-banner-1'] = array(
			'conditions' => array( 'type' => 'interactive-banner-1' ),
			'fields'     => array(
				array(
					'field'       => 'banner_title',
					'type'        => __( 'Interactive Banner : Title', 'uabb' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'banner_desc',
					'type'        => __( 'Interactive Banner : Description', 'uabb' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'cta_link',
					'type'        => __( 'Interactive Banner : Link', 'uabb' ),
					'editor_type' => 'LINK'
				),
			),
		);

		// List icon
		$form['list-icon'] = array(
			'conditions'        => array( 'type' => 'list-icon' ),
			'fields'            => array(),
			'integration-class' => 'WPML_UABB_Listicon',
		);


		return $form;
	}
}
	UABB_WPML_Translatable::init();
}