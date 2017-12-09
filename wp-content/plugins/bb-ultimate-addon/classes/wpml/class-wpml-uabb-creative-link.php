<?php
class WPML_UABB_Creative_Link extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->screens;
	}

	public function get_fields() {
		return array( 'title', 'link' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'title':
				return esc_html__( 'Creative Link: Title', 'uabb' );

			case 'link':
				return esc_html__( 'Creative Link: Link', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';

			case 'link':
				return 'LINK';

			default:
				return '';
		}
	}
}
?>