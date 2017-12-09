<?php
class WPML_UABB_Testimonials extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->testimonials;
	}

	public function get_fields() {
		return array( 'testimonial_author', 'testimonial_designation', 'testimonial' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'testimonial_author':
				return esc_html__( 'Testimonials : Author Name', 'uabb' );

			case 'testimonial_designation':
				return esc_html__( 'Testimonials : Designation', 'uabb' );

			case 'testimonial':
				return esc_html__( 'Testimonial', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'testimonial_author':
				return 'LINE';

			case 'testimonial_designation':
				return 'LINE';

			case 'testimonial':
				return 'VISUAL';

			default:
				return '';
		}
	}
}
?>