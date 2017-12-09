<?php 
if( !function_exists( 'uabb_gf_function' ) ) {

	function uabb_gf_function() {
		$field_options = array();
	
		if ( class_exists( 'GFForms' ) ) {
			$forms = RGFormsModel::get_forms( null, 'title' );

			if ( is_array( $forms ) ) {
				foreach ( $forms as $form ) {
					$field_options[$form->id] = $form->title;
				}
			}
		}

		if( empty( $field_options ) ) {
			$field_options = array( '-1' => __( 'You have not added any Gravity Forms yet.', 'uabb' ) );
		}

		return $field_options;
	}	
}

if( !function_exists( 'uabb_gf_get_form_id' ) ) {

	function uabb_gf_get_form_id() {
		
		if ( class_exists( 'GFForms' ) ) {
			$forms = RGFormsModel::get_forms( null, 'title' );

			if ( is_array( $forms ) ) {
				foreach ( $forms as $form ) {
					return $form->id;
				}
			}
		}

		return -1;
	}	
}