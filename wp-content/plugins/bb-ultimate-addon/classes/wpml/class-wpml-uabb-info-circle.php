<?php
class WPML_UABB_Info_Circle extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->add_circle_item;
	}

	public function get_fields() {
		return array( 'circle_item_title', 'circle_item_description', 'cta_text', 'cta_link' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
			case 'circle_item_title':
				return esc_html__( 'Info Circle: Title', 'uabb' );

			case 'circle_item_description':
				return esc_html__( 'Info Circle: Description', 'uabb' );
              
			case 'cta_text':
				return esc_html__( 'Info Circle: CTA Text', 'uabb' );

			case 'cta_link':
				return esc_html__( 'Info Circle: CTA Link', 'uabb' );

			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'circle_item_title':
				return 'LINE';

			case 'circle_item_description':
				return 'VISUAL';

			case 'cta_text':
				return 'LINE';

			case 'cta_link':
				return 'LINK';

			default:
				return '';
		}
	}
}
?>