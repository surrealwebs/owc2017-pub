<?php
class WPML_UABB_Hotspot extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->hotspot_marker;
	}

	public function get_fields() {
		return array( 'marker_text', 'tooltip_content', 'link' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'marker_text':
				return esc_html__( 'Hotspot: Marker Text', 'uabb' );

			case 'tooltip_content':
				return esc_html__( 'Hotspot: Tooltip Content', 'uabb' );

			case 'link':
				return esc_html__( 'Hotspot: Link', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'marker_text':
				return 'VISUAL';

			case 'tooltip_content':
				return 'VISUAL';

			case 'link':
				return 'LINK';

			default:
				return '';
		}
	}
}
?>