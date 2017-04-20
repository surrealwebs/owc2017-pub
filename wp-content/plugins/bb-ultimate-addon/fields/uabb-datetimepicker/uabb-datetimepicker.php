<?php
/*
 *	DateTime Picker Param
 */

if( !class_exists( 'UABB_DateTimePicker_Param' ) ) {

	class UABB_DateTimePicker_Param {


		function __construct()
		{	
			add_action('fl_builder_control_uabb-datetimepicker', array( $this, 'uabb_datetimepicker' ), 1, 4);
			add_action( 'wp_enqueue_scripts', array( $this, 'uabb_datetimepicker_assets' ), 100 );
		}


		/**
		 * Custom fields
		 */
		function uabb_datetimepicker( $name, $value, $field, $settings ) {

			echo 	'<input type="text" class="cs-wp-datetime-picker" value="' . $value . '" />
		    		<input type="hidden" name="' . $name . '" class="fl-datetime-picker-value" value="' . $value . '"/>';
		}


		/**
		 * Custom field styles and scripts
		 */
		function uabb_datetimepicker_assets() {
		    if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
				/*wp_enqueue_script(
				    'iris',
				    admin_url( 'js/iris.min.js' ),
				    array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
				    false,
				    1
				);
				wp_enqueue_script(
				    'wp-color-picker-new',
				    admin_url( 'js/color-picker.min.js' ),
				    array( 'iris' ),
				    false,
				    1
				);*/
				//wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'bootstrap-datetimepicker.min', BB_ULTIMATE_ADDON_URL . 'fields/uabb-datetimepicker/css/bootstrap-datetimepicker.min.css', array( 'bootstrap-datetimepicker.min' ), '1.0.0', 'all' );
				wp_enqueue_script( 'moment-with-locales', BB_ULTIMATE_ADDON_URL . 'fields/uabb-datetimepicker/js/moment-with-locales.js', array( 'moment-with-locales' ), '1.0.0', true );
				wp_enqueue_script( 'bootstrap-datetimepicker', BB_ULTIMATE_ADDON_URL . 'fields/uabb-datetimepicker/js/bootstrap-datetimepicker.js', array( 'bootstrap-datetimepicker' ), '1.0.0', true );
				/*$colorpicker_l10n = array(
				    'clear' => __( 'Clear' ),
				    'defaultString' => __( 'Default' ),
				    'pick' => __( 'Select Color' ),
				    'current' => __( 'Current Color' ),
				);
				wp_localize_script( 'wp-color-picker-new', 'wpColorPickerL10n', $colorpicker_l10n );*/
		    }
		}

	}

	//Instantiation
	new UABB_DateTimePicker_Param();
}
?>