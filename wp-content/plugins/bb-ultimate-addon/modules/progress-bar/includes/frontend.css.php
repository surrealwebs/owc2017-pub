
<?php 
$settings->text_color = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );
$settings->number_color = UABB_Helper::uabb_colorpicker( $settings, 'number_color' );
$settings->border_color = UABB_Helper::uabb_colorpicker( $settings, 'border_color' );
$settings->before_after_color = UABB_Helper::uabb_colorpicker( $settings, 'before_after_color' );
?>

<?php if( $settings->layout == 'vertical' || $settings->layout == 'circular' || $settings->layout == 'semi-circular' ) { ?>

.fl-node-<?php echo $id; ?> .uabb-pb-list{
    text-align: <?php echo $settings->overall_alignment; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-pb-list li {
	display: inline-block;
	
	<?php if( $settings->overall_alignment == 'left' ) : ?>
		margin: 0 <?php echo ( $settings->spacing != '' ) ? $settings->spacing : '10'; ?>px 30px 0;
	
	<?php elseif( $settings->overall_alignment == 'right' ) : ?>
		margin: 0 0 30px <?php echo ( $settings->spacing != '' ) ? $settings->spacing : '10'; ?>px;
	
	<?php else: ?>
		margin: 0 <?php echo ( $settings->spacing != '' ) ? $settings->spacing / 2 : '5'; ?>px 30px <?php echo ( $settings->spacing != '' ) ? $settings->spacing / 2 : '5'; ?>px;
	<?php endif; 

	if( $settings->layout == 'circular' ) { ?>
		width: <?php echo !empty( $settings->circular_thickness ) ? $settings->circular_thickness : '300'; ?>px;
		height: <?php echo !empty( $settings->circular_thickness ) ? $settings->circular_thickness : '300'; ?>px;
		max-width: 100%;
	
	<?php } else if( $settings->layout == 'semi-circular' ) { ?>
		width: <?php echo !empty( $settings->circular_thickness ) ? $settings->circular_thickness : '300'; ?>px;
		height: auto;
		max-width: 100%;
		<?php } else { ?>
		width: <?php echo !empty( $settings->vertical_width ) ? $settings->vertical_width : '300'; ?>px;
		max-width: 100%;
	<?php } ?>
}

<?php
} else if( $settings->layout == 'horizontal' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-pb-list li {
	display: block;
	margin: 0 0 <?php echo ( $settings->spacing != '' ) ? $settings->spacing : '10'; ?>px 0;
}
.fl-node-<?php echo $id; ?> .uabb-pb-list li:last-of-type {
    margin-bottom: 0;
}
<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-progress-wrap {
	<?php
	if( $settings->border_style != 'none' ) {
		$border_size = ( $settings->border_size != '' ) ? $settings->border_size : '1';
		echo 'border: ' . $border_size . 'px ' . $settings->border_style . ' ' . $settings->border_color . ';';
	} else {
		echo ( $settings->border_radius != '' ) ? 'border-radius: ' . $settings->border_radius . 'px;' : '';
	}
	
	?>
	overflow: hidden;
}

.fl-node-<?php echo $id; ?> .uabb-progress-bar {
<?php
	if( $settings->border_style == 'none' ) {
		echo ( $settings->border_radius != '' ) ? 'border-radius: ' . $settings->border_radius . 'px;' : '';
	}
?>
}

.fl-node-<?php echo $id; ?> .uabb-progress-title {
	color: <?php echo $settings->text_color; ?>;
	<?php
	if( $settings->text_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->text_font_family );
	}

	echo ( $settings->text_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->text_font_size['desktop'] . 'px;' : '';

	echo ( $settings->text_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->text_line_height['desktop'] . 'px;' : '';


	if( $settings->layout == 'horizontal' ) {

		if( $settings->horizontal_style == 'style1' ) {

			echo ( $settings->horizontal_space_below != '' ) ? 'padding-bottom: ' . $settings->horizontal_space_below . 'px;' : 'padding-bottom: 5px;';

		} else if( $settings->horizontal_style == 'style2' ) {

			echo ( $settings->horizontal_space_above != '' ) ? 'padding-top: ' . $settings->horizontal_space_above . 'px;' : 'padding-top: 5px;';

		} else if( $settings->horizontal_style == 'style3' ) {
			$horizontal_vert_padding = ( $settings->horizontal_vert_padding != '' ) ? $settings->horizontal_vert_padding : '5';

			$horizontal_horz_padding = ( $settings->horizontal_horz_padding != '' ) ? $settings->horizontal_horz_padding : '10';

			echo 'padding: ' . $horizontal_vert_padding . 'px ' . $horizontal_horz_padding . 'px;';
		} else if( $settings->horizontal_style == 'style4' ) {

			if( $settings->text_position == 'below' ) {

				echo ( $settings->horizontal_space_above != '' ) ? 'padding-top: ' . $settings->horizontal_space_above . 'px;' : 'padding-top: 5px;';
			} else {

				echo ( $settings->horizontal_space_below != '' ) ? 'padding-bottom: ' . $settings->horizontal_space_below . 'px;' : 'padding-bottom: 5px;';
			}
		}

		//echo ( $settings->horizontal_style == 'style1' || ( $settings->horizontal_style == 'style4' && $settings->text_position == 'above' ) ) ? 'padding-bottom: 10px;' : ( ( $settings->horizontal_style == 'style2' || ( $settings->horizontal_style == 'style4' && $settings->text_position == 'below' ) ) ? 'padding-top: 10px;' : 'padding: 10px;' );

	} else if( $settings->layout == 'vertical' ) {
		echo ( $settings->vertical_style == 'style1' ) ? 'padding-bottom: 10px;' : ( ( $settings->vertical_style == 'style2' ) ? 'padding-top: 10px;' : 'padding: 10px 0;' );
	}
	?>
}

.fl-node-<?php echo $id; ?> .uabb-ba-text {
	color: <?php echo uabb_theme_text_color( $settings->before_after_color ); ?>;
	<?php
	if( $settings->before_after_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->before_after_font_family );
	}

	echo ( $settings->before_after_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->before_after_font_size['desktop'] . 'px;' : '';

	echo ( $settings->before_after_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->before_after_line_height['desktop'] . 'px;' : '';

	?>
}

.fl-node-<?php echo $id; ?> .uabb-progress-value,
.fl-node-<?php echo $id; ?> .uabb-percent-counter {
	color: <?php echo uabb_theme_text_color( $settings->number_color ); ?>;
	<?php
	if( $settings->number_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->number_font_family );
	}

	echo ( $settings->number_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->number_font_size['desktop'] . 'px;' : '';

	echo ( $settings->number_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->number_line_height['desktop'] . 'px;' : '';


	if( $settings->layout == 'horizontal' ) {
		if( $settings->horizontal_style == 'style1' ) {
			echo ( $settings->horizontal_space_below != '' ) ? 'padding-bottom: ' . $settings->horizontal_space_below . 'px;' : 'padding-bottom: 5px;';
		} else if( $settings->horizontal_style == 'style2' ) {
			echo ( $settings->horizontal_space_above != '' ) ? 'padding-top: ' . $settings->horizontal_space_above . 'px;' : 'padding-top: 5px;';
		} else if( $settings->horizontal_style == 'style3' || $settings->horizontal_style == 'style4' ) {
			$horizontal_vert_padding = ( $settings->horizontal_vert_padding != '' ) ? $settings->horizontal_vert_padding : '5';

			$horizontal_horz_padding = ( $settings->horizontal_horz_padding != '' ) ? $settings->horizontal_horz_padding : '10';

			echo 'padding: ' . $horizontal_vert_padding . 'px ' . $horizontal_horz_padding . 'px;';
		}

		//echo ( $settings->horizontal_style == 'style1' ) ? 'padding-bottom: 10px;' : ( ( $settings->horizontal_style == 'style2' ) ? 'padding-top: 10px;' : 'padding: 10px;' );

	} else if( $settings->layout == 'vertical' ) {
		echo ( $settings->vertical_style == 'style1' ) ? 'padding-bottom: 10px;' : ( ( $settings->vertical_style == 'style2' ) ? 'padding-top: 10px;' : 'padding: 10px;' );
	}
	?>
}

<?php
if( count( $settings->horizontal ) > 0 ) {
	for( $i = 0; $i < count( $settings->horizontal ); $i++ ) {
		$tmp = $settings->horizontal;
		if( is_object( $tmp[$i] ) ) {

			$tmp[$i]->background_color = UABB_Helper::uabb_colorpicker( $tmp[$i], 'background_color', true );
			$tmp[$i]->gradient_color = UABB_Helper::uabb_colorpicker( $tmp[$i], 'gradient_color', true );
?>
.fl-node-<?php echo $id; ?> .uabb-progress-bar-<?php echo $i; ?> .uabb-progress-wrap {
	background: <?php echo $tmp[$i]->background_color; ?>;
}

<?php
			if( $settings->layout == 'horizontal' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-layout-horizontal.uabb-progress-bar-<?php echo $i; ?> .uabb-progress-bar {
	<?php if( $tmp[$i]->progress_bg_type == 'image' && trim(FLBuilderPhoto::get_attachment_data($tmp[$i]->progress_bg_img)->url) != '' ) : ?>
		background-image: url(<?php echo FLBuilderPhoto::get_attachment_data($tmp[$i]->progress_bg_img)->url; ?>);
		background-position: <?php echo $tmp[$i]->progress_bg_img_pos; ?>;
		background-size: <?php echo $tmp[$i]->progress_bg_img_size; ?>;
		background-repeat: <?php echo $tmp[$i]->progress_bg_img_repeat; ?>;
	<?php elseif( $tmp[$i]->progress_bg_type == 'gradient' ) :
		$tmp[$i]->gradient_field = (array ) $tmp[$i]->gradient_field;
		UABB_Helper::uabb_gradient_css( $tmp[$i]->gradient_field );
	elseif( $settings->stripped == 'yes' ) : ?>
		background-color: <?php echo uabb_theme_base_color( $tmp[$i]->gradient_color ); ?>;
		background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		-webkit-background-size: 40px 40px;

		background-size: 40px 40px;
	<?php else : ?>
		background: <?php echo uabb_theme_base_color( $tmp[$i]->gradient_color ); ?>;
	<?php endif;	?>
}

.fl-node-<?php echo $id; ?> .uabb-layout-horizontal.uabb-progress-bar-style-style4.uabb-progress-bar-<?php echo $i; ?> .uabb-progress-box .uabb-progress-info {
    width: 0%;    
}
<?php
			} else if( $settings->layout == 'vertical' ) {
?>

.fl-node-<?php echo $id; ?> .uabb-layout-vertical.uabb-progress-bar-<?php echo $i; ?> .uabb-progress-bar {
	width: 100%;
	<?php if( $tmp[$i]->progress_bg_type == 'image' && trim(FLBuilderPhoto::get_attachment_data($tmp[$i]->progress_bg_img)->url) != '' ) : ?>
		background-image: url(<?php echo FLBuilderPhoto::get_attachment_data($tmp[$i]->progress_bg_img)->url; ?>);
		background-position: <?php echo $tmp[$i]->progress_bg_img_pos; ?>;
		background-size: <?php echo $tmp[$i]->progress_bg_img_size; ?>;
		background-repeat: <?php echo $tmp[$i]->progress_bg_img_repeat; ?>;
	<?php elseif( $tmp[$i]->progress_bg_type == 'gradient' ) :
		$tmp[$i]->gradient_field = (array ) $tmp[$i]->gradient_field;
		UABB_Helper::uabb_gradient_css( $tmp[$i]->gradient_field );
	elseif( $settings->stripped == 'yes' ) : ?>
		background-color: <?php echo uabb_theme_base_color( $tmp[$i]->gradient_color ); ?>;
		background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		-webkit-background-size: 40px 40px;

		background-size: 40px 40px;
	
	<?php else : ?>
		background: <?php echo uabb_theme_base_color( $tmp[$i]->gradient_color ); ?>;
	
	<?php endif; ?>
}

<?php
			} else if( $settings->layout == 'circular' || $settings->layout == 'semi-circular' ) {
?>

.fl-node-<?php echo $id; ?> .uabb-layout-<?php echo $settings->layout; ?>.uabb-progress-bar-<?php echo $i; ?> .uabb-svg-wrap svg circle {
<?php 
	$stroke_thickness = ( $settings->stroke_thickness != '' ) ? $settings->stroke_thickness : '10';
	echo 'stroke-width: '. $stroke_thickness .'px;';
?>
}

.fl-node-<?php echo $id; ?> .uabb-layout-<?php echo $settings->layout; ?>.uabb-progress-bar-<?php echo $i; ?> .uabb-svg-wrap svg .uabb-bar {
	<?php echo 'stroke: '. uabb_theme_base_color( $tmp[$i]->gradient_color ).';'; ?>
}

.fl-node-<?php echo $id; ?> .uabb-layout-<?php echo $settings->layout; ?>.uabb-progress-bar-<?php echo $i; ?> .uabb-svg-wrap svg .uabb-bar-bg {
<?php
	if( !empty( $tmp[$i]->background_color ) ) {
		echo 'stroke: '. $tmp[$i]->background_color .';';
	} else {
		echo 'stroke: transparent;';
	}
	//echo 'stroke: '. uabb_theme_base_color( $tmp[$i]->gradient_color ) .';';
	
?>
}
<?php
			}
		}
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-progress-bar-wrapper.uabb-layout-circular {
	max-width: <?php echo !empty( $settings->circular_thickness ) ? $settings->circular_thickness : '300'; ?>px;
	max-height: <?php echo !empty( $settings->circular_thickness ) ? $settings->circular_thickness : '300'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-progress-bar-wrapper.uabb-layout-semi-circular {
	max-width: <?php echo !empty( $settings->circular_thickness ) ? $settings->circular_thickness : '300'; ?>px;
	max-height: <?php echo !empty( $settings->circular_thickness ) ? $settings->circular_thickness / 2 : '150'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-layout-vertical.uabb-progress-bar-style-style3 .uabb-progress-title {
	text-align: <?php echo $settings->title_alignment ?>;
}

.fl-node-<?php echo $id; ?> .uabb-layout-vertical .uabb-progress-wrap {
	height: <?php echo ( $settings->vertical_thickness != '' ) ? $settings->vertical_thickness : '200'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-layout-horizontal.uabb-progress-bar-style-style2 .uabb-progress-box,
.fl-node-<?php echo $id; ?> .uabb-layout-horizontal.uabb-progress-bar-style-style1 .uabb-progress-box {
	height: <?php echo ( $settings->horizontal_thickness != '' ) ? $settings->horizontal_thickness : '20'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-layout-horizontal.uabb-progress-bar-style-style4 .uabb-progress-box .uabb-progress-info {
	width: 100%;
}

<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
    	.fl-node-<?php echo $id; ?> .uabb-progress-title {
			<?php
			echo ( $settings->text_font_size['medium'] != '' ) ? 'font-size: ' . $settings->text_font_size['medium'] . 'px;' : '';

			echo ( $settings->text_line_height['medium'] != '' ) ? 'line-height: ' . $settings->text_line_height['medium'] . 'px;' : '';
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-progress-value,
		.fl-node-<?php echo $id; ?> .uabb-percent-counter {
			<?php
			echo ( $settings->number_font_size['medium'] != '' ) ? 'font-size: ' . $settings->number_font_size['medium'] . 'px;' : '';

			echo ( $settings->number_line_height['medium'] != '' ) ? 'line-height: ' . $settings->number_line_height['medium'] . 'px;' : '';
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-ba-text {
			<?php
			echo ( $settings->before_after_font_size['medium'] != '' ) ? 'font-size: ' . $settings->before_after_font_size['medium'] . 'px;' : '';

			echo ( $settings->before_after_line_height['medium'] != '' ) ? 'line-height: ' . $settings->before_after_line_height['medium'] . 'px;' : ''; ?>
		}

		<?php
        if( $settings->layout == 'circular' ) {
        	if( $settings->circular_responsive == 'yes' ) {
        	?>
		        .fl-node-<?php echo $id; ?> .uabb-pb-list li {
		            height: <?php echo ( $settings->circular_responsive_width != '' ) ? $settings->circular_responsive_width : '200'; ?>px;
		            width: <?php echo ( $settings->circular_responsive_width != '' ) ? $settings->circular_responsive_width : '200'; ?>px;
		            max-width: 100%;
		        }
        	<?php
        	}
        } else if( $settings->layout == 'semi-circular' ) {
        	if( $settings->circular_responsive == 'yes' ) {
	        ?>
		        .fl-node-<?php echo $id; ?> .uabb-pb-list li {
		            height: auto;
		            width: <?php echo ( $settings->circular_responsive_width != '' ) ? $settings->circular_responsive_width : '200'; ?>px;
		        }
        	<?php
        	}
        } else if( $settings->layout == 'vertical' ) {
        	if( $settings->vertical_responsive == 'yes' ) {
        ?>
        .fl-node-<?php echo $id; ?> .uabb-pb-list li { 
            width: <?php echo ( $settings->vertical_responsive_width != '' ) ? $settings->vertical_responsive_width : '150'; ?>px;
        }
        .fl-node-<?php echo $id; ?> .uabb-layout-vertical .uabb-progress-wrap {
        	height: <?php echo ( $settings->vertical_responsive_thickness != '' ) ? $settings->vertical_responsive_thickness : '200'; ?>px;
        }

        <?php
        if( $settings->vertical_style == 'style1' || $settings->vertical_style == 'style2' ) {
        ?>
        .fl-node-<?php echo $id; ?> .uabb-responsive-list li {
		    position: relative;
		}

		.fl-node-<?php echo $id; ?> .uabb-responsive-list .uabb-progress-info {
			position: relative;
			transform: translateX(-50%);
			left: 50%;	
		}

		.fl-node-<?php echo $id; ?> .uabb-responsive-list .uabb-progress-title {
			display: block;
			text-align: center;
		}

		.fl-node-<?php echo $id; ?> .uabb-responsive-list .uabb-progress-value {
		    display: block;
		    width: auto;
		    text-align: center;
		    padding-left: 0;
		}
        <?php
        } else {
        ?>
        .fl-node-<?php echo $id; ?> .uabb-responsive-list li {
		    position: relative;
		}

		.fl-node-<?php echo $id; ?> .uabb-responsive-list .uabb-progress-bar-style-style3 .uabb-progress-title {
		    position: relative;
		    left: 50%;
		    transform: translateX(-50%);
		}
        <?php
        }
        ?>
        <?php
        	}
        }
        ?>
    }
 
     @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
     	.fl-node-<?php echo $id; ?> .uabb-progress-title {
			<?php
			echo ( $settings->text_font_size['small'] != '' ) ? 'font-size: ' . $settings->text_font_size['small'] . 'px;' : '';

			echo ( $settings->text_line_height['small'] != '' ) ? 'line-height: ' . $settings->text_line_height['small'] . 'px;' : '';
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-progress-value,
		.fl-node-<?php echo $id; ?> .uabb-percent-counter {
			<?php
			echo ( $settings->number_font_size['small'] != '' ) ? 'font-size: ' . $settings->number_font_size['small'] . 'px;' : '';

			echo ( $settings->number_line_height['small'] != '' ) ? 'line-height: ' . $settings->number_line_height['small'] . 'px;' : '';
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-ba-text {
			<?php
			echo ( $settings->before_after_font_size['small'] != '' ) ? 'font-size: ' . $settings->before_after_font_size['small'] . 'px;' : '';

			echo ( $settings->before_after_line_height['small'] != '' ) ? 'line-height: ' . $settings->before_after_line_height['small'] . 'px;' : ''; ?>
		}
    }
<?php
}
?>