<?php
/*
 *	Switch Param
 */

if(!class_exists('UABB_Hide_Field'))
{
	class UABB_Hide_Field
	{
		function __construct()
		{	
			add_action( 'fl_builder_control_uabb-hide-field', array($this, 'uabb_hide_field'), 1, 4 );
			//add_action( 'wp_enqueue_scripts', array( $this, 'hide_field_scripts' ) );
		}

		/*function hide_field_scripts() {
	    	if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
	    		wp_enqueue_style( 'hide_field-styles', plugins_url( 'css/uabb-hide-field.css', __FILE__ ) );
	      	}
		}*/
		
		function uabb_hide_field($name, $value, $field) {
      		 
			$output = "<div class='uabb-hide-field'>";
      		$output .= '<input type="hidden" name="'.$name.'" value="">';
      		$output .= '</div>';

      		echo $output;
    	}
	}

	new UABB_Hide_Field();
}
