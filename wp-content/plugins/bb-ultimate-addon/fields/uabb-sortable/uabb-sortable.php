<?php
/*
 *	Static Sortable Param
 */

/**
 * 'sortable' => array(
 *                      'type'           => 'uabb-sortable',
 *                      'label'          => '',
 *                      'options'        => array(
                              'option1' => 'Option 1',
                              'option2' => 'Option 2',
                              'option3' => 'Option 3',
                        )
 *			),
 **/

if(!class_exists('UABB_Sortable_Field'))
{
	class UABB_Sortable_Field
	{
		function __construct()
		{	
			add_action( 'fl_builder_control_uabb-sortable', array($this, 'uabb_sortable'), 1, 4 );
		}
		
		function uabb_sortable($name, $value, $field, $settings) {
      		
                  $custom_class = isset( $field['class'] ) ? $field['class'] : '';

                  $default = ( isset( $field['default'] ) && $field['default'] != '' ) ? $field['default'] : '';

                  $assign_val = ( $value != '' ) ? $value : $default;

                  $preview = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );

      		$msg_content = '';

                  if( isset( $field['options'] ) ) {
                        if( $field['options'] != '' ) {
                              $output = '<script> jQuery(function(){ UABBSortable._init({name: "' . $name . '"}); });</script>
                              <div class="uabb-sortable-wrap fl-field" data-type="text" data-preview=\'' . $preview . '\'>
                                    <ul class="uabb-sortable ' . $custom_class . '">';
                              $old_val = explode( ',', $assign_val );
                              $options = $field['options'];

                              for ($i=0; $i < count( $old_val ); $i++) { 
                                    if( isset( $options[$old_val[$i]] ) ) {
                                          $output .= '<li class="' . $old_val[$i] . '">' . $options[$old_val[$i]] . '</span></li>';
                                          unset( $options[$old_val[$i]] );
                                    }
                              }

                              foreach ($options as $key => $option) {
                                    $output .= '<li class="' . $key . '">' . $option . '</span></li>';  
                              }

                              $output .= '</ul><input type="hidden" value="' . $assign_val . '" name="' . $name . '"/></div>';
                              
                              echo $output;
                        }
                  }
            }
      }
	$UABB_Sortable_Field = new UABB_Sortable_Field();
}
