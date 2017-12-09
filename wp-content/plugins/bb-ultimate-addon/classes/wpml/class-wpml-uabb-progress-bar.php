<?php
class WPML_UABB_Progres_Bar extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->horizontal;
	}

	public function get_fields() {
		return array( 'circular_before_number', 'circular_after_number', 'horizontal_before_number' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'circular_before_number':
				return esc_html__( 'Progress Bar: Text Before Number', 'uabb' );

			case 'circular_after_number':
				return esc_html__( 'Progress Bar: Text After Number', 'uabb' );
              
			case 'horizontal_before_number':
				return esc_html__( 'Progress Bar: Title', 'uabb' );


			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'circular_before_number':
				return 'LINE';

			case 'circular_after_number':
				return 'LINE';

			case 'horizontal_before_number':
				return 'LINE';

			default:
				return '';
		}
	}
}
?>