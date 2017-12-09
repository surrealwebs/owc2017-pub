<?php if ( isset( $settings->before_label_text ) && $settings->before_label_text != "" ) {?>
	.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-before-label:before
	{
	    content: "<?php echo $settings->before_label_text;?>"; 
	}
<?php } ?>

<?php if ( isset( $settings->after_label_text ) && $settings->after_label_text != "" ) {?>
	.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-after-label:before
	{
	    content: "<?php echo $settings->after_label_text;?>"; 
	}
<?php } ?>

<?php 
$settings->handle_color = UABB_Helper::uabb_colorpicker( $settings, 'handle_color' ); 
$settings->handle_triangle_color = UABB_Helper::uabb_colorpicker( $settings, 'handle_triangle_color' );
$settings->handle_color = ( $settings->handle_color != '' ) ? $settings->handle_color : '#fff';
$settings->handle_triangle_color = ( $settings->handle_triangle_color != '' ) ? $settings->handle_triangle_color : $settings->handle_color;


$settings->slider_label_back_color = UABB_Helper::uabb_colorpicker( $settings, 'slider_label_back_color' );
$settings->slider_color = UABB_Helper::uabb_colorpicker( $settings, 'slider_color' ); 
$settings->handle_back_overlay = UABB_Helper::uabb_colorpicker( $settings, 'handle_back_overlay', true ); 
if ( isset( $settings->handle_shadow_color ) ) {
$settings->handle_shadow_color = UABB_Helper::uabb_colorpicker( $settings, 'handle_shadow_color' );
}

?>

.fl-node-<?php echo $id;?> .uabb-ba-container {
<?php
if( $settings->overall_alignment == 'center' ) {
?>
	margin: auto;
<?php
} else if( $settings->overall_alignment == 'left' ) {
?>
	margin-right: auto;
<?php
} else {
?>
	margin-left: auto;
<?php
}
?>	
}

<?php if ( $settings->handle_thickness == "" ) { $settings->handle_thickness = 5; } ?>
<?php if ( $settings->handle_circle_width == "" || $settings->advance_opt == '' ) { $settings->handle_circle_width = 40; } ?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle {
	border-color: <?php echo $settings->handle_color;?>;
	<?php if ( $settings->handle_thickness != "" ) { ?>
	
	border-width:<?php echo $settings->handle_thickness; ?>px;
	<?php } ?>
	
	<?php 
	if ( $settings->advance_opt == 'Y' && isset( $settings->handle_radius ) && $settings->handle_radius == "" ){
		$settings->handle_radius = 100;
	}
	if ( $settings->advance_opt == 'Y' && $settings->handle_radius != "" ) { ?>
	border-radius: <?php echo $settings->handle_radius; ?>px;
	<?php } ?>
	<?php if ( $settings->advance_opt == 'Y' && $settings->shadow_opt == "Y" ) {
		if ( $settings->handle_shadow == "" ) {
			$settings->handle_shadow = 5;
		}
		if ( $settings->handle_shadow_color == "" ) {
			$settings->handle_shadow_color = "#fcfcfc";
		}
	?>
		webkit-box-shadow: 0px 0px <?php echo $settings->handle_shadow;?>px <?php echo $settings->handle_shadow_color;?>;
    	-moz-box-shadow: 0px 0px <?php echo $settings->handle_shadow;?>px <?php echo $settings->handle_shadow_color;?>;
    	box-shadow: 0px 0px <?php echo $settings->handle_shadow;?>px <?php echo $settings->handle_shadow_color;?>;
	<?php } ?>

	<?php if ( $settings->handle_circle_width != "" ) { ?>
	height: <?php echo $settings->handle_circle_width; ?>px;
	width: <?php echo $settings->handle_circle_width; ?>px;
	margin-left:-<?php echo $settings->handle_circle_width/2; ?>px;
	margin-top:-<?php echo $settings->handle_circle_width/2; ?>px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle:before{
	<?php if ( $settings->before_after_orientation == "vertical" && $settings->handle_thickness != "" ) { ?>
	<?php if ( $settings->handle_circle_width != 45 ) { ?>
	margin-left: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php }else{ ?>
	margin-left: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>
	
	box-shadow: 0 0 0 <?php echo $settings->handle_color;?>;
	<?php } ?>
	<?php if ( $settings->before_after_orientation == "horizontal" && $settings->handle_thickness != "" ) { ?>

	<?php if ( $settings->handle_circle_width != 45 ) { ?>
	margin-bottom: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php }else{ ?>
	margin-bottom: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>

	box-shadow: 0 0 0 <?php echo $settings->handle_color;?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle:after{
	
	<?php if ( $settings->before_after_orientation == "vertical" && $settings->handle_thickness != "" ) { ?>
	<?php if ( $settings->handle_circle_width != 45 ) { ?>
	margin-right: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php } else { ?>
	margin-right: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>
	
	box-shadow: 0 0 0 <?php echo $settings->handle_color;?>;
	<?php } ?>

	<?php if ( $settings->before_after_orientation == "horizontal" && $settings->handle_thickness != "" ) { ?>

	<?php if ( $settings->handle_circle_width != 45 ) { ?>
	margin-top: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php }else{ ?>
	margin-top: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>

	box-shadow: 0 0 0 <?php echo $settings->handle_color;?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle:before,
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle:after {
	background: <?php echo $settings->handle_color;?>;

	<?php if ( $settings->before_after_orientation == "vertical" && $settings->handle_thickness != "" ) { ?>
	height: <?php echo $settings->handle_thickness; ?>px;
	margin-top: -<?php echo $settings->handle_thickness/2; ?>px;
	<?php } ?>
	<?php if ( $settings->before_after_orientation == "horizontal" && $settings->handle_thickness != "" ) { ?>
	width: <?php echo $settings->handle_thickness; ?>px;
	margin-left: -<?php echo $settings->handle_thickness/2; ?>px;
	<?php } ?>
}
<?php
if( $settings->move_on_hover == 'false' ) {
?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-overlay:hover {
	background: <?php echo $settings->handle_back_overlay;?>;
}
<?php
}
?>

<?php if ( $settings->advance_opt == 'Y' && $settings->before_after_orientation == "vertical" ){ 
	if ( $settings->handle_triangle_size != "" ) { $triangle_size = $settings->handle_triangle_size; }else{ $triangle_size = 6; }
?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-up-arrow {
	border-bottom: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_triangle_color;?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-down-arrow {
	border-top: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_triangle_color;?>;
}
<?php }
if ( $settings->advance_opt == 'Y' && $settings->before_after_orientation == "horizontal" ){ 
	if ( $settings->handle_triangle_size != "" ) { $triangle_size = $settings->handle_triangle_size; }else{ $triangle_size = 6; }
?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-left-arrow {
	border-right: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_triangle_color;?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-right-arrow {
	border-left: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_triangle_color;?>;
}
<?php }

if( $settings->advance_opt == 'Y' ) {
?>
.fl-node-<?php echo $id; ?> .twentytwenty-left-arrow,
.fl-node-<?php echo $id; ?> .twentytwenty-right-arrow,
.fl-node-<?php echo $id; ?> .twentytwenty-up-arrow,
.fl-node-<?php echo $id; ?> .twentytwenty-down-arrow {
	border: <?php echo $triangle_size; ?>px inset transparent;
}
<?php
}

if ( $settings->advance_opt == '' && $settings->before_after_orientation == "vertical" ){ 
	$triangle_size = 6;
?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-up-arrow {
	border-bottom: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_color;?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-down-arrow {
	border-top: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_color;?>;
}
<?php }
if ( $settings->advance_opt == '' && $settings->before_after_orientation == "horizontal" ){ 
	$triangle_size = 6;
?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-left-arrow {
	border-right: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_color;?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node ;?> .twentytwenty-handle .twentytwenty-right-arrow {
	border-left: <?php echo $triangle_size;?>px solid <?php echo $settings->handle_color;?>;
}
<?php } ?>




.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-before-label,
.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-after-label {
	<?php if( $settings->before_after_orientation == "horizontal" ):
			if( isset( $settings->slider_label_position ) && $settings->slider_label_position == 'center' ) : ?>
			-webkit-box-align:center;
	    	-ms-flex-align:center;
	        -ms-grid-row-align:center;
	        align-items:center;
		<?php endif; ?>
		<?php if( isset( $settings->slider_label_position ) && $settings->slider_label_position == 'top' ) : ?>
			-webkit-box-align:start;
    		-ms-flex-align:start;
            -ms-grid-row-align:flex-start;
	        align-items:flex-start;
			margin-top:10px;
		<?php endif; ?>
		<?php if( isset( $settings->slider_label_position ) && $settings->slider_label_position == 'bottom' ) : ?>
			-webkit-box-align:end;
	    	-ms-flex-align:end;
	        -ms-grid-row-align:flex-end;
	        align-items:flex-end;
			padding-bottom:10px;
		<?php endif; ?>
	<?php endif; ?>

	<?php if( $settings->before_after_orientation == "vertical" ):
			if( isset( $settings->slider_vertical_label_position ) && $settings->slider_vertical_label_position == 'center' ) : ?>
			justify-content:center;
		<?php endif; ?>
		<?php if( isset( $settings->slider_vertical_label_position ) && $settings->slider_vertical_label_position == 'left' ) : ?>
			justify-content:flex-start;
			padding-left:10px;
		<?php endif; ?>
		<?php if( isset( $settings->slider_vertical_label_position ) && $settings->slider_vertical_label_position == 'right' ) : ?>
			justify-content:flex-end;
			padding-right:10px;
		<?php endif; ?>
	<?php endif; ?>
}

<?php
if( isset( $settings->slider_label_padding ) && $settings->slider_label_padding == '' ){ $settings->slider_label_padding = 10; }
if( isset( $settings->slider_label_letter_spacing ) && $settings->slider_label_letter_spacing == '' ){ $settings->slider_label_letter_spacing = 1; }
/* Typography style */
if ( ( isset( $settings->slider_font_family['family'] ) && $settings->slider_font_family['family'] != "Default" ) || ( isset( $settings->slider_font_size['desktop'] ) && $settings->slider_font_size['desktop'] != '' ) || ( isset( $settings->slider_line_height['desktop'] ) && $settings->slider_line_height['desktop'] != '' ) || ( isset( $settings->slider_color ) && $settings->slider_color != '' ) || ( isset( $settings->slider_label_back_color ) && $settings->slider_label_back_color != '' ) || ( isset( $settings->slider_label_padding ) && $settings->slider_label_padding != '' ) || ( isset( $settings->slider_label_letter_spacing ) && $settings->slider_label_letter_spacing != '' ) ) { ?>

.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-before-label:before,
.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-after-label:before {
	<?php if( isset( $settings->slider_font_family['family'] ) && $settings->slider_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->slider_font_family ); ?>
	<?php endif; ?>
	<?php if( isset( $settings->slider_font_size['desktop'] ) && $settings->slider_font_size['desktop'] != '' ) : ?>
		font-size: <?php if ( isset( $settings->slider_font_size['desktop'] ) ) { echo $settings->slider_font_size['desktop']; } ?>px;
	<?php endif; ?>
	<?php if( isset( $settings->slider_line_height['desktop'] ) && $settings->slider_line_height['desktop'] != '' ) : ?>
		line-height: <?php if ( isset( $settings->slider_line_height['desktop'] ) ) { echo $settings->slider_line_height['desktop']; } ?>px;
	<?php endif; ?>
	<?php if( isset( $settings->slider_color ) && $settings->slider_color != '' ) : ?>
		color: <?php echo $settings->slider_color; ?>;
	<?php endif; ?>

	<?php if( isset( $settings->slider_label_back_color ) && $settings->slider_label_back_color != '' ) : ?>
		background: <?php echo $settings->slider_label_back_color; ?>;
	<?php endif; ?>
	<?php if( isset( $settings->slider_label_padding ) && $settings->slider_label_padding != '' ) : ?>
		padding: <?php echo $settings->slider_label_padding; ?>px;
	<?php endif; ?>
	<?php if( isset( $settings->slider_label_letter_spacing ) && $settings->slider_label_letter_spacing != '' ) : ?>
		letter-spacing: <?php echo $settings->slider_label_letter_spacing; ?>px;
	<?php endif; ?>
	width:auto;
	

	
}
<?php } ?>


/* Typography responsive layout starts here */ 
<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( ( isset( $settings->slider_font_size['medium'] ) && $settings->slider_font_size['medium'] !="" ) || ( isset( $settings->slider_line_height['medium'] ) && $settings->slider_line_height['medium'] != "" ) ) {
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			<?php if( $settings->slider_font_size['medium'] !="" || $settings->slider_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-before-label:before,
				.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-after-label:before {
					<?php if( isset( $settings->slider_font_size['medium'] ) && $settings->slider_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->slider_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( isset( $settings->slider_line_height['medium'] ) && $settings->slider_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->slider_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>
	    }
	<?php
	}

	if( ( isset( $settings->slider_font_size['small'] ) && $settings->slider_font_size['small'] != "" ) || ( isset( $settings->slider_line_height['small'] ) && $settings->slider_line_height['small'] != "" ) || ( isset( $settings->mobile_view ) && $settings->mobile_view == 'stack' ) ) {
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			<?php if( ( isset( $settings->slider_font_size['small'] ) && $settings->slider_font_size['small'] !="" ) || ( isset( $settings->slider_line_height['small'] ) && $settings->slider_line_height['small'] != "" ) ) { ?>
				
				.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-before-label:before,
				.fl-node-<?php echo $id;?> .baslider-<?php echo $module->node ;?> .twentytwenty-after-label:before {
					<?php if( isset( $settings->slider_font_size['small'] ) && $settings->slider_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->slider_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( isset( $settings->slider_line_height['small'] ) && $settings->slider_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->slider_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>
	    }
	<?php
	}
}
?>
/* Typography responsive layout Ends here */