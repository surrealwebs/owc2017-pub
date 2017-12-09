<?php
class WPML_UABB_Ihover extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->ihover_item;
	}

	public function get_fields() {
		return array( 'title', 'description','link_url' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'title':
				return esc_html__( 'ihover : Title', 'uabb' );

			case 'description':
				return esc_html__( 'ihover : Description', 'uabb' );

			case 'link_url':
				return esc_html__( 'ihover : Link', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';

			case 'description':
				return 'VISUAL';

			case 'link_url':
				return 'LINK';

			default:
				return '';
		}
	}
}
?>