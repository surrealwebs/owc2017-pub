<?php
$photo_src = ( $settings->photo_source != 'url' ) ? ( ( isset( $settings->photo_src ) && $settings->photo_src != '' ) ? $settings->photo_src : '' ) : ( ( $settings->photo_url != '' ) ? $settings->photo_url : '' ); 

if( $photo_src != '' ) {
	if( count( $settings->hotspot_marker ) > 0 ) {
		for( $i = 0; $i < count( $settings->hotspot_marker ); $i++ ) {

			$coordinate = explode( ',', $settings->hotspot_marker[$i]->co_ordinates );
			//var_dump($coordinate);
			$x_coordinate = ( isset( $coordinate[1] ) ) ? $coordinate[1] : '0';
			$y_coordinate = ( isset( $coordinate[0] ) ) ? $coordinate[0] : '0';

			$settings->hotspot_marker[$i]->tooltip_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'tooltip_color' );
			$settings->hotspot_marker[$i]->text_typography_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'text_typography_color' );
			//$settings->hotspot_marker[$i]->text_typography_hover_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'text_typography_hover_color' );
			$settings->hotspot_marker[$i]->text_typography_active_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'text_typography_active_color' );
			$settings->hotspot_marker[$i]->tooltip_bg_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'tooltip_bg_color' );
			$settings->hotspot_marker[$i]->text_typography_bg_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'text_typography_bg_color', true );
			//$settings->hotspot_marker[$i]->text_typography_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'text_typography_bg_hover_color', true );
			$settings->hotspot_marker[$i]->text_typography_bg_active_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[$i], 'text_typography_bg_active_color', true );
			$settings->hotspot_marker[$i]->icon_size = ( $settings->hotspot_marker[$i]->icon_size != '' ) ? $settings->hotspot_marker[$i]->icon_size : '30';
			$settings->hotspot_marker[$i]->text_typography_line_height = ( array ) $settings->hotspot_marker[$i]->text_typography_line_height;
			$settings->hotspot_marker[$i]->text_typography_font_size = ( array ) $settings->hotspot_marker[$i]->text_typography_font_size;
			$settings->hotspot_marker[$i]->text_typography_font_family = ( array ) $settings->hotspot_marker[$i]->text_typography_font_family;

			$settings->hotspot_marker[$i]->tooltip_line_height = ( array ) $settings->hotspot_marker[$i]->tooltip_line_height;
			$settings->hotspot_marker[$i]->tooltip_font_size = ( array ) $settings->hotspot_marker[$i]->tooltip_font_size ;
			$settings->hotspot_marker[$i]->tooltip_font_family = ( array ) $settings->hotspot_marker[$i]->tooltip_font_family;
			
			if ( $settings->hotspot_marker[$i]->hotspot_marker_type != "text" ) {
				$imageicon_array = array(
			      
			      	/* General Section */
			      	'image_type' => $settings->hotspot_marker[$i]->hotspot_marker_type,
			 
			      	/* Icon Basics */
			      	'icon' => $settings->hotspot_marker[$i]->icon,
			      	'icon_size' => $settings->hotspot_marker[$i]->icon_size,
			      	'icon_align' => '',
			 
			      	/* Image Basics */
			      	'photo_source' => $settings->hotspot_marker[$i]->photo_source,
			      	'photo' => $settings->hotspot_marker[$i]->photo,
			      	'photo_url' => $settings->hotspot_marker[$i]->photo_url,
			      	'img_size' => $settings->hotspot_marker[$i]->img_size,
			      	'img_align' => '',
			      	'photo_src' => ( isset( $settings->hotspot_marker[$i]->photo_src ) ) ? $settings->hotspot_marker[$i]->photo_src : '' ,
			 
			      	/* Icon Style */
			      	'icon_style' => $settings->hotspot_marker[$i]->icon_style,
			      	'icon_bg_size' => $settings->hotspot_marker[$i]->icon_bg_size,
			      	'icon_border_style' => $settings->hotspot_marker[$i]->icon_border_style,
			      	'icon_border_width' => $settings->hotspot_marker[$i]->icon_border_width,
			      	'icon_bg_border_radius' => $settings->hotspot_marker[$i]->icon_bg_border_radius,
			 
			      	/* Image Style */
			      	'image_style' => $settings->hotspot_marker[$i]->image_style,
			      	'img_bg_size' => $settings->hotspot_marker[$i]->img_bg_size,
			      	'img_border_style' => $settings->hotspot_marker[$i]->img_border_style,
			      	'img_border_width' => $settings->hotspot_marker[$i]->img_border_width,
			      	'img_bg_border_radius' => $settings->hotspot_marker[$i]->img_bg_border_radius,
			 		
			 		/* Preset Color variable new */
			      	'icon_color_preset' => $settings->hotspot_marker[$i]->icon_color_preset,

			      	/* Icon Colors */ 
			      	'icon_color' => $settings->hotspot_marker[$i]->icon_color,
			      	'icon_hover_color' => $settings->hotspot_marker[$i]->icon_hover_color,
			      	'icon_bg_color' => $settings->hotspot_marker[$i]->icon_bg_color,
			      	'icon_bg_hover_color' => $settings->hotspot_marker[$i]->icon_bg_hover_color,
			      	'icon_bg_color_opc' => $settings->hotspot_marker[$i]->icon_bg_color_opc,
			      	'icon_bg_hover_color_opc' => $settings->hotspot_marker[$i]->icon_bg_hover_color_opc,
			      	'icon_border_color' => $settings->hotspot_marker[$i]->icon_border_color,
			      	'icon_border_hover_color' => $settings->hotspot_marker[$i]->icon_border_hover_color,
			      	'icon_three_d' => $settings->hotspot_marker[$i]->icon_three_d,
			 
			      	/* Image Colors */
			      	'img_bg_color' => $settings->hotspot_marker[$i]->img_bg_color,
			      	'img_bg_color_opc' => $settings->hotspot_marker[$i]->img_bg_color_opc,
			      	'img_bg_hover_color' => $settings->hotspot_marker[$i]->img_bg_hover_color,
			      	'img_bg_hover_color_opc' => $settings->hotspot_marker[$i]->img_bg_hover_color_opc,
			      	'img_border_color' => $settings->hotspot_marker[$i]->img_border_color,
			      	'img_border_hover_color' => $settings->hotspot_marker[$i]->img_border_hover_color,
			 	);
			 
			 	/* CSS Render Function */ 
			 	FLBuilder::render_module_css( 'image-icon', $id . ' .uabb-hotspot-item-' . $i, $imageicon_array );

			 	if( $settings->hotspot_marker[$i]->show_animation == 'yes' ) {
			 	?>
			 	.fl-node-<?php echo $id; ?> .uabb-hotspot .uabb-hotspot-hover .uabb-hotspot-wrap .uabb-imgicon-wrap {
			 		position: relative;
    				z-index: 2;
			 	}
			<?php
				}
			}
			
		 	if ( $settings->hotspot_marker[$i]->hotspot_marker_type == "text" ) {
		 		//if( $settings->hotspot_marker[$i]->on_click_action == 'link' ) {
		 	?>
		 		.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>.uabb-hotspot-hover .uabb-hotspot-text {
			 		color: <?php echo uabb_theme_text_color( $settings->hotspot_marker[$i]->text_typography_active_color ); ?>;
			 	}

			 	.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>:hover .uabb-hotspot-text {
					background: <?php echo uabb_theme_base_color( $settings->hotspot_marker[$i]->text_typography_bg_active_color ); ?>;
			 	}
		 	<?php
		 		//}
		 		if( $settings->hotspot_marker[$i]->tooltip_trigger_on == 'click' ) {
		 	?>
		 		.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>.uabb-hotspot-hover .uabb-hotspot-text {
			 		<?php
			 		$color = ( $settings->hotspot_marker[$i]->text_typography_active_color != '' ) ? $settings->hotspot_marker[$i]->text_typography_active_color : $settings->hotspot_marker[$i]->text_typography_color;
			 		echo 'color: ' . uabb_theme_text_color( $color ) . ';' ; ?>
			 	}

			 	.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>.uabb-hotspot-hover .uabb-hotspot-text {
			 		<?php
			 		$bg_color = ( $settings->hotspot_marker[$i]->text_typography_bg_active_color != '' ) ? $settings->hotspot_marker[$i]->text_typography_bg_active_color : $settings->hotspot_marker[$i]->text_typography_bg_color;
			 		?>
			 		background: <?php echo uabb_theme_base_color( $bg_color ); ?>;
			 	}
		 	<?php
		 		}
		 	?>

			 	.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-text {
			 		<?php
					echo 'color: ' . uabb_theme_text_color( $settings->hotspot_marker[$i]->text_typography_color ) . ';' ;
					echo ( $settings->hotspot_marker[$i]->text_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->hotspot_marker[$i]->text_typography_line_height['desktop'] . 'px;' : '';
					echo ( $settings->hotspot_marker[$i]->text_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->hotspot_marker[$i]->text_typography_font_size['desktop'] . 'px;' : '';

					if( $settings->hotspot_marker[$i]->text_typography_font_family['family'] != 'Default' ) {
						UABB_Helper::uabb_font_css( $settings->hotspot_marker[$i]->text_typography_font_family );
					}
					
					?>
			 	}
			 	.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-text {
			 		background: <?php echo uabb_theme_base_color( $settings->hotspot_marker[$i]->text_typography_bg_color ); ?>;
			 		<?php echo $settings->hotspot_marker[$i]->text_typography_padding; ?>
			 	}

			 	.fl-node-<?php echo $id; ?> .uabb-hotspot-container .uabb-hotspot-items .uabb-hotspot-item-<?php echo $i; ?> {
			 		-webkit-transform: translate(-50%, 5px);
    				transform: translate(-50%, 5px);
			 	}
		 	<?php
		 	}
		 	?>

		 	<?php
		 	
		 	if ( $settings->hotspot_marker[$i]->hotspot_marker_type == "icon" ) {
		        $im_icon_backside = 0;
		        $im_icon_size =  0;
		        if ( $settings->hotspot_marker[$i]->icon != "" && $settings->hotspot_marker[$i]->icon_style == "custom" ) {
		            $im_icon_backside = $settings->hotspot_marker[$i]->icon_bg_size + ($settings->hotspot_marker[$i]->icon_border_width * 2);
		            $im_icon_size = $settings->hotspot_marker[$i]->icon_size;
		        } else if ( $settings->hotspot_marker[$i]->icon != "" && $settings->hotspot_marker[$i]->icon_style == "circle" || $settings->hotspot_marker[$i]->icon_style == "square" ) {
		            $im_icon_size = $settings->hotspot_marker[$i]->icon_size * 2;
		        } else if ( $settings->hotspot_marker[$i]->icon != "" && $settings->hotspot_marker[$i]->icon_style == "simple" ) {
		            $im_icon_size = $settings->hotspot_marker[$i]->icon_size;
		        } else {
		            $im_icon_backside = 0;
		            $im_icon_size = 0;
		        }

		        $element_width = $im_icon_size + $im_icon_backside;
		    } else if ( $settings->hotspot_marker[$i]->hotspot_marker_type == "photo" ) {
		        if ( $settings->hotspot_marker[$i]->image_style == "custom" ) {
		            $im_backside = ($settings->hotspot_marker[$i]->img_bg_size * 2) + ( $settings->hotspot_marker[$i]->img_border_width * 2 );
		        } else {
		            $im_backside = 0;
		        }
		        
		        $element_width = $settings->hotspot_marker[$i]->img_size + $im_backside;
		    } else {
		        $element_width = 0;   
		    }

		 	?>
			.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> {
				top:calc( <?php echo $x_coordinate; ?>% - <?php echo ( $element_width / 2 ); ?>px);
				left: calc( <?php echo $y_coordinate; ?>% - <?php echo ( $element_width / 2 ); ?>px);
				<?php
				if ( $settings->hotspot_marker[$i]->hotspot_marker_type != "text" ) {
					echo 'width: ' . $element_width . 'px;';
				}
				?>
			}

			<?php
			if( $settings->hotspot_marker[$i]->on_click_action == 'tooltip' ) {
			?>

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-tooltip-content {
					color: <?php echo uabb_theme_text_color( $settings->hotspot_marker[$i]->tooltip_color ); ?>;
					background: <?php echo uabb_theme_base_color( $settings->hotspot_marker[$i]->tooltip_bg_color ); ?>;
					<?php echo $settings->hotspot_marker[$i]->tooltip_padding; ?>;

					<?php
					echo ( $settings->hotspot_marker[$i]->tooltip_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->hotspot_marker[$i]->tooltip_line_height['desktop'] . 'px;' : '';
					echo ( $settings->hotspot_marker[$i]->tooltip_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->hotspot_marker[$i]->tooltip_font_size['desktop'] . 'px;' : '';
					
					if( $settings->hotspot_marker[$i]->tooltip_font_family['family'] != 'Default' ) {
						UABB_Helper::uabb_font_css( $settings->hotspot_marker[$i]->tooltip_font_family );
					}
					
					?>
				}


				/* Curved Tooltip Style */

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-curved.uabb-tooltip-right .uabb-hotspot-tooltip-content {
					left: <?php echo ( $settings->hotspot_marker[$i]->hotspot_marker_type != 'text' ) ? ( $element_width + 10 ) . 'px' : 'calc( 100% + 20px )'; ?>;
				    -webkit-transform-origin: -2em 50%;
				    transform-origin: -2em 50%;
				    -webkit-transform: translate3d(0,50%,0) rotate3d(1,1,1,30deg);
				    transform: translate3d(0,50%,0) rotate3d(1,1,1,30deg);
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-curved.uabb-tooltip-left .uabb-hotspot-tooltip-content {
			    	right: <?php echo ( $settings->hotspot_marker[$i]->hotspot_marker_type != 'text' ) ? ( $element_width + 10 ) . 'px' : 'calc( 100% + 20px )'; ?>;
				    -webkit-transform-origin: calc(100% + 2em) 50%;
				    transform-origin: calc(100% + 2em) 50%;
				    -webkit-transform: translate3d(0,50%,0) rotate3d(1,1,1,-30deg);
				    transform: translate3d(0,50%,0) rotate3d(1,1,1,-30deg);
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-curved.uabb-tooltip-left .uabb-hotspot-svg {
					transform: scale3d(-1,1,1) translateY(-50%);
					left: calc( 100% - 2px );
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-curved.uabb-tooltip-right .uabb-hotspot-svg {
					transform: translateY(-50%);
					right: calc( 100% - 2px );
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>.uabb-hotspot-hover .uabb-tooltip-style-curved .uabb-hotspot-tooltip-content {
				    opacity: 1;
				    -webkit-transform: translate3d(0,50%,0) rotate3d(0,0,0,0);
				    transform: translate3d(0,50%,0) rotate3d(0,0,0,0);
				    pointer-events: auto;
				}

				/* Classic Tooltip Style */

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-left .uabb-hotspot-tooltip-content::after {
					border-left-color: <?php echo uabb_theme_base_color( $settings->hotspot_marker[$i]->tooltip_bg_color ); ?>;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-right .uabb-hotspot-tooltip-content::after {
					border-right-color: <?php echo uabb_theme_base_color( $settings->hotspot_marker[$i]->tooltip_bg_color ); ?>;
				}


				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-top .uabb-hotspot-tooltip-content::after {
					border-top-color: <?php echo uabb_theme_base_color( $settings->hotspot_marker[$i]->tooltip_bg_color ); ?>;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-bottom .uabb-hotspot-tooltip-content::after {
					border-bottom-color: <?php echo uabb_theme_base_color( $settings->hotspot_marker[$i]->tooltip_bg_color ); ?>;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-left .uabb-hotspot-tooltip-content {
					right: 100%;
				    top: 50%;
				    transform: translateY(-50%) !important;
				    margin-right: 10px;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-top .uabb-hotspot-tooltip-content {
					bottom: 100%;
				    margin-bottom: 10px;
				    left: 50%;
				    transform: translateX(-50%)!important;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-right .uabb-hotspot-tooltip-content {
					left: 100%;
				    top: 50%;
				    transform: translateY(-50%) !important;
				    margin-left: 10px;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-bottom .uabb-hotspot-tooltip-content {
			       	top: 100%;
				    margin-top: 10px;
				    left: 50%;
				    transform: translateX(-50%)!important;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-top .uabb-hotspot-tooltip-content::after {
					top: 100%;
			    	left: 50%;
			    	margin-left: -10px;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-bottom .uabb-hotspot-tooltip-content::after {
					bottom: 100%;
			       	left: 50%;
			       	margin-left: -10px;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-left .uabb-hotspot-tooltip-content::after {
					top: 50%;
				    left: 100%;
				    margin-top: -10px;
				}

				.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-tooltip-style-classic.uabb-tooltip-right .uabb-hotspot-tooltip-content::after {
					top: 50%;
				    right: 100%;
				    margin-top: -10px;
				}

				/* Sharp Tooltip Style */

			<?php
			}
			?>

			<?php
			if($global_settings->responsive_enabled) { // Global Setting If started 
			?>
				@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
					.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-text {
				 		<?php
						echo ( $settings->hotspot_marker[$i]->text_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->hotspot_marker[$i]->text_typography_line_height['medium'] . 'px;' : '';
						echo ( $settings->hotspot_marker[$i]->text_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->hotspot_marker[$i]->text_typography_font_size['medium'] . 'px;' : '';					
						?>
				 	}

				 	.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-tooltip-content {
				 		<?php
						echo ( $settings->hotspot_marker[$i]->tooltip_line_height['medium'] != '' ) ? 'line-height: ' . $settings->hotspot_marker[$i]->tooltip_line_height['medium'] . 'px;' : '';
						echo ( $settings->hotspot_marker[$i]->tooltip_font_size['medium'] != '' ) ? 'font-size: ' . $settings->hotspot_marker[$i]->tooltip_font_size['medium'] . 'px;' : '';
						
						?>
				 	}
				 	.fl-node-<?php echo $id; ?> .uabb-hotspot-hover .uabb-hspot-sonar {
					    width: 100px;
					    height: 100px;
					}
				}

				@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
					.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-text {
				 		<?php
						echo ( $settings->hotspot_marker[$i]->text_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->hotspot_marker[$i]->text_typography_line_height['small'] . 'px;' : '';
						echo ( $settings->hotspot_marker[$i]->text_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->hotspot_marker[$i]->text_typography_font_size['small'] . 'px;' : '';					
						?>
				 	}

				 	.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-tooltip-content {
				 		<?php
						echo ( $settings->hotspot_marker[$i]->tooltip_line_height['small'] != '' ) ? 'line-height: ' . $settings->hotspot_marker[$i]->tooltip_line_height['small'] . 'px;' : '';
						echo ( $settings->hotspot_marker[$i]->tooltip_font_size['small'] != '' ) ? 'font-size: ' . $settings->hotspot_marker[$i]->tooltip_font_size['small'] . 'px;' : '';
						
						?>
				 	}
				}
			<?php
			}
		}
	}
	if( $settings->photo_size != '' ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-hotspot-container {
		width: <?php echo $settings->photo_size; ?>px;
	}
	<?php
	}
}
?>