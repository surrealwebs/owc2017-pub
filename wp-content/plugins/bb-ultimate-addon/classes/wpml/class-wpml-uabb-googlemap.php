<?php
class WPML_UABB_Googlemap extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->uabb_gmap_addresses;
	}

	public function get_fields() {
		return array( 'map_name', 'info_window_text' );
	}

	protected function get_title( $field ) {
		switch( $field ) {

			case 'map_name':
				return esc_html__( 'Google Map : Map Name', 'uabb' );

			case 'info_window_text':
				return esc_html__( 'Google Map : Info Text', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'map_name':
				return 'LINE';

			case 'info_window_text':
				return 'VISUAL';

			default:
				return '';
		}
	}
}
?>