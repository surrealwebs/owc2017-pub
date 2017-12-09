/* Global Number Counter CSS */
<?php 
    $settings->separator_color = UABB_Helper::uabb_colorpicker( $settings, 'separator_color' );
    $settings->circle_color = UABB_Helper::uabb_colorpicker( $settings, 'circle_color', true );
    $settings->circle_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'circle_bg_color', true );
    $settings->bar_color = UABB_Helper::uabb_colorpicker( $settings, 'bar_color', true );
    $settings->bar_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'bar_bg_color', true );
    $settings->num_color = UABB_Helper::uabb_colorpicker( $settings, 'num_color' );
    $settings->ba_color = UABB_Helper::uabb_colorpicker( $settings, 'ba_color' );

    $settings->icon_size = ( trim($settings->icon_size) !== '' ) ? $settings->icon_size : '30';
    $settings->icon_bg_size = ( trim($settings->icon_bg_size) !== '' ) ? $settings->icon_bg_size : '30';
    $settings->icon_border_width = ( trim($settings->icon_border_width) !== '' ) ? $settings->icon_border_width : '1';
    $settings->img_size = ( trim($settings->img_size) !== '' ) ? $settings->img_size : '150';
    $settings->img_border_width = ( trim($settings->img_border_width) !== '' ) ? $settings->img_border_width : '1';
    $settings->circle_width = ( trim($settings->circle_width) !== '' ) ? $settings->circle_width : '300';
    $settings->circle_dash_width = ( trim($settings->circle_dash_width) !== '' ) ? $settings->circle_dash_width : '10';
?>
/* Alignment */
<?php
if( $settings->layout == "default" ) {

	if( $settings->image_type != 'none' ) {
		if ( $settings->img_icon_position == 'above-title' || $settings->img_icon_position == 'below-title'  ) { ?>
		.fl-node-<?php echo $id ?> .fl-module-content {
			text-align: <?php echo $settings->align; ?>;
		}
	<?php }elseif ( $settings->img_icon_position == 'left-title' || $settings->img_icon_position == 'left' ) { ?>
		.fl-node-<?php echo $id ?> .fl-module-content {
			text-align: left;
		}
	<?php }elseif ( $settings->img_icon_position == 'right-title' || $settings->img_icon_position == 'right' ) { ?>
		.fl-node-<?php echo $id ?> .fl-module-content {
			text-align: right;
		}
	<?php }
	} else {
	?>
		.fl-node-<?php echo $id ?> .fl-module-content {
			text-align: <?php echo $settings->align; ?>;
		}
	<?php
	}
} else { ?>
	.fl-node-<?php echo $id ?> .fl-module-content {
		text-align: center; ?>;
	}
<?php } ?>


/* Number Text Typography */
.fl-node-<?php echo $id; ?> <?php echo $settings->num_tag_selection; ?>.uabb-number-string {
   	<?php if( $settings->num_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->num_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->num_font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->num_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->num_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->num_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->num_color != '' ) : ?>
	color: <?php echo $settings->num_color; ?>;
	<?php endif; ?>
}

/* Before After Text Typography */
.fl-node-<?php echo $id; ?> .uabb-number-before-text,
.fl-node-<?php echo $id; ?> .uabb-number-after-text,
.fl-node-<?php echo $id; ?> .uabb-counter-before-text,
.fl-node-<?php echo $id; ?> .uabb-counter-after-text {
   	<?php if( $settings->ba_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->ba_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->ba_font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->ba_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->ba_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->ba_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->ba_color != '' ) : ?>
	color: <?php echo $settings->ba_color; ?>;
	<?php endif; ?>
}

/* Custom Spacing Style Css */ 
<?php if( $settings->layout == "default" ) { ?>
	<?php if( $settings->number_bottom_margin != '' || $settings->number_top_margin != '' ) { ?>
		<?php if( $settings->img_icon_position == 'left-title' || $settings->img_icon_position == 'right-title' ) { ?>
			.fl-node-<?php echo $id ?> .uabb-default-<?php echo $settings->img_icon_position; ?>-wrap {
		<?php }else{ ?>
			.fl-node-<?php echo $id ?> <?php echo $settings->num_tag_selection; ?>.uabb-number-string {
		<?php } ?>
		<?php 
			
			if( isset( $settings->number_bottom_margin ) && $settings->number_bottom_margin != '' ) {
				echo 'margin-bottom: '. $settings->number_bottom_margin .'px;';
			}
			if( isset( $settings->number_top_margin ) && $settings->number_top_margin != '' ) {
				echo 'margin-top: '. $settings->number_top_margin .'px;';
			} 
		?>
		}
	<?php } ?>
<?php }else{ ?>
	<?php if( ( $settings->number_bottom_margin != '' ) || ( $settings->number_top_margin != '' ) ) { ?>
		.fl-node-<?php echo $id ?> <?php echo $settings->num_tag_selection; ?>.uabb-number-string{
		<?php 
			
			if( isset( $settings->number_bottom_margin ) && $settings->number_bottom_margin != '' ) {
				echo 'margin-bottom: '. $settings->number_bottom_margin .'px;';
			}
			if( isset( $settings->number_top_margin ) && $settings->number_top_margin != '' ) {
				echo 'margin-top: '. $settings->number_top_margin .'px;';
			} 
		?>
		}
	<?php }?>
<?php } ?>

/* Icon Margin */
<?php if ( $settings->image_type == 'icon' ) { ?>
	<?php 
		$pos = '';
		if( $settings->layout == 'circle' || $settings->layout == 'semi-circle'  ){
			$pos = $settings->circle_position;
		}elseif( $settings->layout == 'default' ){
			$pos = $settings->img_icon_position;
		}
	if ( $pos == 'above-title' || $pos == 'below-title' || $pos == 'left' || $pos == 'right' ) { ?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-imgicon-wrap {
		margin-top: <?php echo ( $settings->img_icon_margin_top != '' ) ? $settings->img_icon_margin_top : ''; ?>px;
		margin-bottom: <?php echo ( $settings->img_icon_margin_bottom != '' ) ? $settings->img_icon_margin_bottom : ''; ?>px;
	}
	<?php } ?>
<?php } ?>
/* Image Margin */
<?php if ( $settings->image_type == 'photo' ) { ?>
	<?php 
		$pos = '';
		if( $settings->layout == 'circle' || $settings->layout == 'semi-circle'  ){
			$pos = $settings->circle_position;
		}elseif( $settings->layout == 'default' ){
			$pos = $settings->img_icon_position;
		}
	if ( $pos == 'above-title' || $pos == 'below-title' || $pos == 'left' || $pos == 'right' ) { ?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-imgicon-wrap {
		margin-top: <?php echo ( $settings->img_icon_margin_top != '' ) ? $settings->img_icon_margin_top : '5'; ?>px;
		margin-bottom: <?php echo ( $settings->img_icon_margin_bottom != '' ) ? $settings->img_icon_margin_bottom : '0'; ?>px;
	}
	<?php } ?>
<?php } ?>


/* Icon Image Render */
<?php if( $settings->layout != 'bars' && $settings->image_type != 'none' ) {

	/* CSS "$settings" Array */
 	$imageicon_array = array(
      
      	/* General Section */
      	'image_type' => $settings->image_type,
 
      	/* Icon Basics */
      	'icon' => $settings->icon,
      	'icon_size' => $settings->icon_size,
      	'icon_align' => ( $settings->layout == 'default' ) ? $settings->align : 'center',
 
      	/* Image Basics */
      	'photo_source' => $settings->photo_source,
      	'photo' => $settings->photo,
      	'photo_url' => $settings->photo_url,
      	'img_size' => $settings->img_size,
      	'img_align' => ( $settings->layout == 'default' ) ? $settings->align : 'center',
      	'photo_src' => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '' ,
 
      	/* Icon Style */
      	'icon_style' => $settings->icon_style,
      	'icon_bg_size' => $settings->icon_bg_size,
      	'icon_border_style' => $settings->icon_border_style,
      	'icon_border_width' => $settings->icon_border_width,
      	'icon_bg_border_radius' => $settings->icon_bg_border_radius,
 
      	/* Image Style */
      	'image_style' => $settings->image_style,
      	'img_bg_size' => $settings->img_bg_size,
      	'img_border_style' => $settings->img_border_style,
      	'img_border_width' => $settings->img_border_width,
      	'img_bg_border_radius' => $settings->img_bg_border_radius,
 		
 		/* Preset Color variable new */
      	'icon_color_preset' => $settings->icon_color_preset,

      	/* Icon Colors */ 
      	'icon_color' => $settings->icon_color,
      	'icon_hover_color' => $settings->icon_hover_color,
      	'icon_bg_color' => $settings->icon_bg_color,
      	'icon_bg_color_opc' => $settings->icon_bg_color_opc,
      	'icon_bg_hover_color' => $settings->icon_bg_hover_color,
      	'icon_bg_hover_color_opc' => $settings->icon_bg_hover_color_opc,
      	'icon_border_color' => $settings->icon_border_color,
      	'icon_border_hover_color' => $settings->icon_border_hover_color,
      	'icon_three_d' => $settings->icon_three_d,
 
      	/* Image Colors */
      	'img_bg_color' => $settings->img_bg_color,
      	'img_bg_color_opc' => $settings->img_bg_color_opc,
      	'img_bg_hover_color' => $settings->img_bg_hover_color,
      	'img_bg_hover_color_opc' => $settings->img_bg_hover_color_opc,
      	'img_border_color' => $settings->img_border_color,
      	'img_border_hover_color' => $settings->img_border_hover_color,
 	);
 
 	/* CSS Render Function */ 
 	FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
} ?>


/* Render Seperator */
<?php if( $settings->show_separator == 'yes' ) {
	FLBuilder::render_module_css('uabb-separator', $id, array(
		'color'			=> $settings->separator_color,
		'height'		=> $settings->separator_height,
		'width'			=> $settings->separator_width,
		'alignment'		=> $settings->separator_alignment,
		'style'			=> $settings->separator_style
	)); ?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-separator {
		<?php
		if( $settings->separator_top_margin != '' ) {
		?>
		margin-top: <?php echo $settings->separator_top_margin; ?>px;
		<?php
		}
		if( $settings->separator_bottom_margin != '' ) {
		?>
		margin-bottom: <?php echo $settings->separator_bottom_margin; ?>px;
		<?php
		}
		?>
	}
<?php } ?>

<?php if( isset( $settings->layout ) && $settings->layout == 'circle' || $settings->layout == 'semi-circle'  ) : ?>
	.fl-node-<?php echo $id ?> .uabb-number-text {
		position: absolute;
		left: 50%;
		<?php if( $settings->layout == 'semi-circle' ) {
		?>
		top: 100%;
		-webkit-transform: translate(-50%,-100%);
		   -moz-transform: translate(-50%,-100%);
		    -ms-transform: translate(-50%,-100%);
		        transform: translate(-50%,-100%);
		<?php }
		else { ?>
		top: 50%;
		-webkit-transform: translate(-50%,-50%);
		   -moz-transform: translate(-50%,-50%);
		    -ms-transform: translate(-50%,-50%);
		        transform: translate(-50%,-50%);
        <?php } ?>
	}
	.fl-node-<?php echo $id ?> .uabb-number-circle-container, .fl-node-<?php echo $id ?> .uabb-number-semi-circle-container {
		<?php 
			if( !empty( $settings->circle_width ) ) {
				echo 'max-width: '. $settings->circle_width .'px;';
			} else {
				echo 'max-width: 100px;';
			}
		?>
		text-align: <?php echo $settings->align; ?>;
		margin-top: 0;
		margin-bottom: 0;
		margin-left: <?php echo ( $settings->align != 'left' ) ? 'auto' : '0' ?>;
		margin-right: <?php echo ( $settings->align != 'right' ) ? 'auto' : '0' ?>;
	}

	.fl-node-<?php echo $id ?> .uabb-number-circle-container {
		<?php 
			if( !empty( $settings->circle_width ) ) {
				echo 'max-height: '. $settings->circle_width .'px;';
			} else {
				echo 'max-height: 100px;';
			}
		?>
	}

	.fl-node-<?php echo $id ?> .uabb-number-semi-circle-container {
		<?php 
			if( !empty( $settings->circle_width ) ) {
				$circle_height = $settings->circle_width / 2;
				echo 'max-height: '. $circle_height .'px;';
			} else {
				echo 'max-height: 50px;';
			}
		?>
	}

	.fl-node-<?php echo $id ?> .svg circle, .fl-node-<?php echo $id ?> .semi-circle-svg circle{
	<?php 
		if( !empty( $settings->circle_dash_width ) ) {
			echo 'stroke-width: '. $settings->circle_dash_width .'px;';
		}
	?>
	}

	.fl-node-<?php echo $id ?> .svg .uabb-bar-bg, .fl-node-<?php echo $id ?> .semi-circle-svg .uabb-bar-bg{
	<?php 
		if( !empty( $settings->circle_bg_color ) ) {
			echo 'stroke: '. $settings->circle_bg_color .';';
		} else {
			echo 'stroke: transparent;';
		}
	?>
	}

	.fl-node-<?php echo $id ?> .svg .uabb-bar, .fl-node-<?php echo $id ?> .semi-circle-svg .uabb-bar{
	<?php 
			echo 'stroke: '. uabb_theme_base_color( $settings->circle_color ).';';
	?>
	}
<?php elseif( isset( $settings->layout ) && $settings->layout == 'bars' ) : ?>
	.fl-node-<?php echo $id ?> .uabb-number-bars-container{
		width: 100%;
		background-color: <?php echo $settings->bar_bg_color ?>;
	}
	.fl-node-<?php echo $id ?> .uabb-number-bar{
		width: 0;
		background-color: <?php echo uabb_theme_base_color( $settings->bar_color ) ?>;
	}
<?php endif; ?>


/* Calculation Width */
<?php $class 		= '';
		$pos 		= '';
		$cal_width 	= '';
if( $settings->image_type == 'icon' && $settings->layout == 'default' ) { 
	$class = 'uabb-number-'.$settings->image_type.'-'.$settings->img_icon_position;
	$pos = $settings->img_icon_position;
	if ( $pos == 'left' || $pos == 'right' || $pos == 'left-title' || $pos == 'right-title'  ) {
		$cal_width = $settings->icon_size;
		if ( $settings->icon_style != 'simple' ) {
			$cal_width = $settings->icon_size * 2;
			if ( $settings->icon_style == 'custom' ) {
				$cal_width = $settings->icon_size + intval($settings->icon_bg_size);
				if ( $settings->icon_border_style != 'none' ) {
					$cal_width = $cal_width + ( intval($settings->icon_border_width) * 2 );
				}
			}
		}
		$cal_width = $cal_width + 20;
	}

}elseif ( $settings->image_type == 'photo' && $settings->layout == 'default' ) {
	$class = 'uabb-number-'.$settings->image_type.'-'.$settings->img_icon_position;
	$pos = $settings->img_icon_position;
	if ( $pos == 'left' || $pos == 'right' || $pos == 'left-title' || $pos == 'right-title'  ) {
		$cal_width = $settings->img_size;
		if ( $settings->image_style == 'custom' ) {
			$cal_width = $cal_width + intval($settings->img_bg_size) * 2;
			if ( $settings->img_border_style != 'none' ) {
				$cal_width = $cal_width + ( intval($settings->img_border_width) * 2 );
			}
		}
		$cal_width = $cal_width + 20;
	}
}
?>
<?php /*var_dump( $cal_width );
die();*/
?>
<?php if ( $settings->layout == 'default' && $cal_width != '' ) { ?>
	<?php if ( $pos == 'left-title' || $pos == 'right-title' ) { ?>
	.fl-builder-content .fl-node-<?php echo $id.' .'.$class; ?> <?php echo $settings->num_tag_selection; ?>.uabb-number-string {
		width: calc(100% - <?php echo $cal_width?>px);
	}
	<?php } ?>
	<?php if ( $pos == 'left' || $pos == 'right' ) { ?>
	.fl-builder-content .fl-node-<?php echo $id.' .'.$class; ?> .uabb-number-text {
		width: calc(100% - <?php echo $cal_width?>px);
	}
	<?php } ?>
<?php } ?>



/* Responsive Typography */


<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( $settings->num_font_size['medium'] != "" || $settings->num_line_height['medium'] != "" || 
		$settings->ba_font_size['medium'] != "" || $settings->ba_line_height['medium'] != "" )
	{
		/* Medium Breakpoint media query */
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			/* Number Text Typography */
			.fl-node-<?php echo $id; ?> <?php echo $settings->num_tag_selection; ?>.uabb-number-string {
				<?php if( $settings->num_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->num_font_size['medium']; ?>px;
				line-height: <?php echo $settings->num_font_size['medium'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->num_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->num_line_height['medium']; ?>px;
				<?php endif; ?>
			}

			/* Before After Text */
			.fl-node-<?php echo $id; ?> .uabb-number-before-text,
			.fl-node-<?php echo $id; ?> .uabb-number-after-text,
			.fl-node-<?php echo $id; ?> .uabb-counter-before-text,
			.fl-node-<?php echo $id; ?> .uabb-counter-after-text {
				<?php if( $settings->ba_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->ba_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->ba_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->ba_line_height['medium']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php
	}
	if( $settings->num_font_size['small'] != "" || $settings->num_line_height['small'] != "" || 
		$settings->ba_font_size['small'] != "" || $settings->ba_line_height['small'] != "" )
	{
		/* Small Breakpoint media query */	
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			/* Number Text Typography */
			.fl-node-<?php echo $id; ?> <?php echo $settings->num_tag_selection; ?>.uabb-number-string {
				<?php if( $settings->num_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->num_font_size['small']; ?>px;
				line-height: <?php echo $settings->num_font_size['small'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->num_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->num_line_height['small']; ?>px;
				<?php endif; ?>
			}

			/* Before After Text */
			.fl-node-<?php echo $id; ?> .uabb-number-before-text,
			.fl-node-<?php echo $id; ?> .uabb-number-after-text,
			.fl-node-<?php echo $id; ?> .uabb-counter-before-text,
			.fl-node-<?php echo $id; ?> .uabb-counter-after-text {
				<?php if( $settings->ba_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->ba_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->ba_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->ba_line_height['small']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php
	}
} /* Typography responsive layout Ends here*/ ?>



