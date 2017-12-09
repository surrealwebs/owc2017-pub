<?php
/*
 *	Static Date Param
 */

/**
 * 'data_variable' => array(
 *                      'type'           => 'uabb-normal-date',
 *                      'label'         => __( 'Select Date & Time', 'uabb' ),
                        'default'       => '',
                        'class'         => '',
 *			),
 **/

/**
 * 'data_variable' => array(
 *                      'type'           => 'uabb-evergreen-date',
 *                      'label'         => __( 'Select Date & Time', 'uabb' ),
                        'default'       => '',
                        'class'         => '',
 *                ),
 **/

if(!class_exists('UABB_Date_Field')) {
	class UABB_Date_Field {
		function __construct() {
                  add_action('fl_builder_control_uabb-normal-date', array( $this, 'uabb_normal_date' ), 1, 4);
                  add_action('fl_builder_control_uabb-evergreen-date', array( $this, 'uabb_evergreen_date' ), 1, 4);
		}

            function uabb_normal_date($name, $value, $field, $settings) {

                  $custom_class = isset( $field['class'] ) ? $field['class'] : '';

                  $preview = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );

                  echo '<div class="uabb-date-wrap fl-field" data-type="select" data-preview=\'' . $preview . '\'><div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_days" ><option value="0">' . __( 'Date', 'uabb' ) . '</option>';

                  for ( $i=1; $i <= 31; $i++ ) {
                        $selected = "";
                        if ( isset( $settings->fixed_date_days ) ) {
                              if ( $i == $settings->fixed_date_days ) {
                                  $selected = "selected";
                              } else{
                                  $selected = "";
                              }
                        } else if( $i == 29 ) {
                              $selected = "selected";
                        }

                        if( $i <= 9 ) {
                              echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
                        } else {
                              echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                        }

                  }

                  echo '</select></br><label>' . __( 'Date', 'uabb' ) . '</label></div>';

                  echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_month" >';
                  echo '<option value="0">' . __( 'Month', 'uabb' ) . '</option>';
                  echo '<option value="01" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "01" ) ? 'selected' : '' ) . ' >Jan</option>';
                  echo '<option value="02" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "02" ) ? 'selected' : '' ) . ' >Feb</option>';
                  echo '<option value="03" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "03" ) ? 'selected' : '' ) . ' >Mar</option>';
                  echo '<option value="04" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "04" ) ? 'selected' : '' ) . ' >Apr</option>';
                  echo '<option value="05" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "05" ) ? 'selected' : '' ) . ' >May</option>';
                  echo '<option value="06" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "06" ) ? 'selected' : '' ) . ' >Jun</option>';
                  echo '<option value="07" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "07" ) ? 'selected' : '' ) . ' >Jul</option>';
                  echo '<option value="08" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "08" ) ? 'selected' : '' ) . ' >Aug</option>';
                  echo '<option value="09" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "09" ) ? 'selected' : '' ) . ' >Sep</option>';
                  echo '<option value="10" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "10" ) ? 'selected' : '' ) . ' >Oct</option>';
                  echo '<option value="11" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "11" ) ? 'selected' : '' ) . ' >Nov</option>';
                  echo '<option value="12" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == "12" ) ? 'selected' : '' ) . ' >Dec</option>';
                  echo '</select></br><label>' . __( 'Months', 'uabb' ) . '</label></div>';

                  echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="'.$name.'_year" >';
                  echo '<option value="0">' . __( 'Year', 'uabb' ) . '</option>';
                  for ( $i = date('Y'); $i < date('Y') + 6; $i++ ) {
                        $selected = "";
                        if ( isset( $settings->fixed_date_year ) ) {
                            if ( $i == $settings->fixed_date_year ) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                        } else if ( $i == date('Y') + 5 ) {
                            $selected = "selected";
                        }
                        echo '<option value="'.$i.'" '. $selected .'>'.$i.'</option>';
                  }
                  echo '</select></br><label>' . __( 'Years', 'uabb' ) . '</label></div>';
                  echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="'.$name.'_hour" >';
                  echo '<option value="0">' . __( 'Hour', 'uabb' ) . '</option>';
                  for ( $i = 0; $i < 24; $i++ ) {
                  $selected = "";
                  if ( isset( $settings->fixed_date_hour ) ) {
                      if ( $i == $settings->fixed_date_hour ) {
                          $selected = "selected";
                      } else {
                          $selected = "";
                      }
                  } else if( $i == 23 ) {
                      $selected = "selected";
                  }

                  if( $i <= 9 ){
                      echo '<option value="'.$i.'" '.$selected.'>0'.$i.'</option>';
                  } else {
                      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                  }
                  }
                  echo '</select></br><label>' . __( 'Hours', 'uabb' ) . '</label></div>';
                  echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="'.$name.'_minutes" >';
                  echo '<option value="0">' . __( 'Minutes', 'uabb' ) . '</option>';
                  for ( $i = 0; $i < 60; $i++ ) {
                        $selected = "";
                        if ( isset( $settings->fixed_date_minutes ) ) {
                            if ( $i == $settings->fixed_date_minutes ) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                        } else if( $i == 59 ) {
                            $selected = "selected";
                        }

                        if( $i <= 9 ) {
                            echo '<option value="'.$i.'" '.$selected.'>0'.$i.'</option>';
                        } else {
                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                        }
                  }
                  echo '</select></br><label>' . __( 'Minutes', 'uabb' ) . '</label></div><div>';   
            }

            function uabb_evergreen_date($name, $value, $field, $settings) {

                  $custom_class = isset( $field['class'] ) ? $field['class'] : '';
                  $selected = '';
                  $preview = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );


                  echo '<div class="fl-field uabb-evergreen-wrap" data-type="select" data-preview=\'' . $preview . '\'><div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_days" >';
                  echo '<option value="0">' . __( 'Days', 'uabb' ) . '</option>';
                  for ( $i=0; $i <= 31; $i++ ) {
                        if ( isset( $settings->evergreen_date_days ) ) {
                              if ( $i == $settings->evergreen_date_days ) {
                                  $selected = "selected";
                              } else {
                                  $selected = "";
                              }
                        } else if( $i == 30 ) {
                              $selected = "selected";
                        }
                        if( $i <= 9 ) {
                              echo '<option value="'.$i.'" '.$selected.'>0'.$i.'</option>';
                        } else {
                              echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                        }
                  }
                  echo '</select></br><label>' . __( 'Days', 'uabb' ) . '</label></div>';



                  echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_hour" >';
                  echo '<option value="0">' . __( 'Hours', 'uabb' ) . '</option>';
                  for ( $i = 0; $i < 24; $i++ ) {
                        if ( isset( $settings->evergreen_date_hour ) ) {
                            if ( $i == $settings->evergreen_date_hour ) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                        } else if( $i == 23 ) {
                            $selected = "selected";
                        }
                        if( $i <= 9 ) {
                            echo '<option value="'.$i.'" '.$selected.'>0'.$i.'</option>';
                        } else {
                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                        }
                  }
                  echo '</select></br><label>' . __( 'Hours', 'uabb' ) . '</label></div>';
                  echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_minutes" >';
                  echo '<option value="0">' . __( 'Minutes', 'uabb' ) . '</option>';
                  for ( $i = 0; $i < 60; $i++ ) {
                        if ( isset( $settings->evergreen_date_minutes ) ) {
                            if ( $i == $settings->evergreen_date_minutes ) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                        } else if( $i == 59 ) {
                            $selected = "selected";
                        }

                        if( $i <= 9 ) {
                            echo '<option value="'.$i.'" '.$selected.'>0'.$i.'</option>';
                        } else {
                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                        }
                  }
                  echo '</select></br><label>' . __( 'Minutes', 'uabb' ) . '</label></div>';
                  echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_seconds" >';
                  echo '<option value="0">' . __( 'Seconds', 'uabb' ) . '</option>';
                  for ( $i = 0; $i < 60; $i++ ) {
                        if ( isset( $settings->evergreen_date_seconds ) ) {
                            if ( $i == $settings->evergreen_date_seconds ) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                        } else if ( $i == 59 ) {
                            $selected = "selected";
                        }
                        if( $i <= 9 ){
                            echo '<option value="'.$i.'" '.$selected.'>0'.$i.'</option>';
                        } else {
                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                        }
                  }
                  echo '</select></br><label>' . __( 'Seconds', 'uabb' ) . '</label></div></div>';  
            }
      }
	
      $UABB_Date_Field = new UABB_Date_Field();
}