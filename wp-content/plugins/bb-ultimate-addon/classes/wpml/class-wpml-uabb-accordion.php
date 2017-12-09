<?php
class WPML_UABB_Accordion extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->acc_items;
	}

	public function get_fields() {
		return array( 'acc_title', 'ct_content' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'acc_title':
				return esc_html__( 'Accordion Item Label', 'uabb' );

			case 'ct_content':
				return esc_html__( 'Accordion Item Content', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'acc_title':
				return 'LINE';

			case 'ct_content':
				return 'VISUAL';

			default:
				return '';
		}
	}
}
?>