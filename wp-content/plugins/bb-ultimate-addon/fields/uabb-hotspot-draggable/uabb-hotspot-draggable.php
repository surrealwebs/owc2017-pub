<?php
/*
 *	Draggable pointer on an Image param
 */

if(!class_exists('UABB_Hotspot_Draggable'))
{
	class UABB_Hotspot_Draggable
	{
		function __construct() {	
			add_action( 'fl_builder_control_uabb-draggable', array($this, 'uabb_draggable'), 1, 4 );
		}
		
		function uabb_draggable($name, $value, $field, $settings) {

                  $val = ( isset( $value ) && $value != '' ) ? $value : '0,0';
                  $coord = explode( ',', $val );
                  $preview = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );

                  echo "<script>jQuery(function(){ UABBHotspotDraggable._init({name:'". $name ."'}); });</script><div class='uabb-hotspot-draggable-wrap fl-field' data-type='text' data-preview='" . $preview . "'><div class='uabb-hotspot-draggable'></div><div class='uabb-hotspot-draggable-point' style='top:".$coord[1]."%;left:".$coord[0]."%;'></div></div><input type='hidden' value='" . $val . "' name='" . $name . "' />";
            }
	}

	new UABB_Hotspot_Draggable();
}
