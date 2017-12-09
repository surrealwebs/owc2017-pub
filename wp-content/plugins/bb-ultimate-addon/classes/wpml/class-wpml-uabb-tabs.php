<?php
class WPML_UABB_Tabs extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->items;
	}

	public function get_fields() {
		return array( 'label', 'ct_content' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'label':
				return esc_html__( 'Tabs Item Label', 'uabb' );

			case 'ct_content':
				return esc_html__( 'Tabs Item Content', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'label':
				return 'LINE';

			case 'ct_content':
				return 'VISUAL';

			default:
				return '';
		}
	}
}
?>