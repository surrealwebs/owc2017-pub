<?php 

if( !function_exists( 'uabb_cf7_function' ) ) {

	function uabb_cf7_function() {
		$field_options = array(); 
	
		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$args = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
			$forms = get_posts( $args );

			if ( $forms ) {
				foreach ( $forms as $form ) {
					$field_options[$form->ID] = $form->post_title;
				}
			}
		}

		if( empty( $field_options ) ) {
			$field_options = array( '-1' => __( 'You have not added any Contact Form 7 yet.', 'uabb' ) );
		}

		return $field_options;
	}	
}

if( !function_exists( 'uabb_cf7_get_form_id' ) ) {

	function uabb_cf7_get_form_id() {
		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$args = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
			$forms = get_posts( $args );

			if ( $forms ) {
				foreach ( $forms as $form ) {
					return $form->ID;
				}
			}
		}

		return -1;
	}	
}