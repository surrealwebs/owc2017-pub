<?php

$settings->first_heading_color = UABB_Helper::uabb_colorpicker( $settings, 'first_heading_color' );
$settings->second_heading_color = UABB_Helper::uabb_colorpicker( $settings, 'second_heading_color' );
?>
/* First heading styling */
<?php if ( $settings->first_heading_color != "" || $settings->add_spacing_option == "yes" ) { ?>
.fl-node-<?php echo $id; ?> .uabb-dual-color-heading .uabb-first-heading-text {
	<?php if ( !empty( $settings->first_heading_color ) ) { ?>
	color: <?php echo $settings->first_heading_color; ?>;
	<?php } ?>
    <?php 
    if( $settings->add_spacing_option === "yes"  ){
    ?>
 		margin-right:<?php echo ( isset( $settings->heading_margin ) && $settings->heading_margin != '' ) ? $settings->heading_margin . 'px' : '10px' ; ?>;
    <?php	
    }
    ?>
}
<?php } ?>

<?php if( $settings->add_spacing_option === "yes"  ) { ?>
	[dir="rtl"] .fl-node-<?php echo $id; ?> .uabb-dual-color-heading .uabb-first-heading-text {
	 	margin-left:<?php echo ( isset( $settings->heading_margin ) && $settings->heading_margin != '' ) ? $settings->heading_margin . 'px' : '10px' ; ?>;
	 	margin-right: 0;
	}
<?php } ?>

<?php if( $settings->add_spacing_option === "yes"  ) { ?>
	[dir="ltr"] .fl-node-<?php echo $id; ?> .uabb-dual-color-heading .uabb-first-heading-text {
	 	margin-right:<?php echo ( isset( $settings->heading_margin ) && $settings->heading_margin != '' ) ? $settings->heading_margin . 'px' : '10px' ; ?>;
	 	margin-left: 0;
	}
<?php } ?>


/* Second heading styling */
<?php //if ( $settings->second_heading_color != "" ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-dual-color-heading .uabb-second-heading-text {
		<?php //if ( !empty( $settings->second_heading_color ) ) { ?>
	    color: <?php echo uabb_theme_base_color( $settings->second_heading_color ); ?>;
	    <?php //} ?>
	}
<?php //} ?>
/* Alignment styling */
.fl-node-<?php echo $id; ?> .uabb-dual-color-heading.left {	text-align: left; }
.fl-node-<?php echo $id; ?> .uabb-dual-color-heading.right { text-align: right; }
.fl-node-<?php echo $id; ?> .uabb-dual-color-heading.center { text-align: center; }


/* Typography styling for desktop */

<?php 
if( $settings->dual_font_family['family'] != "Default" || $settings->dual_font_size['desktop'] != '' || $settings->dual_line_height['desktop'] != '') { ?>
	.fl-node-<?php echo $id; ?> .uabb-dual-color-heading * {
		<?php if( $settings->dual_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->dual_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->dual_font_size['desktop'] != '' ) : ?>
		font-size: <?php echo $settings->dual_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->dual_line_height['desktop'] != '' ) : ?>
		line-height: <?php echo $settings->dual_line_height['desktop']; ?>px;
		<?php endif; ?>
	}
<?php } ?>


/* Typography responsive layout starts here */ 


<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( $settings->dual_font_size['medium'] != "" || $settings->dual_line_height['medium'] != "" || $settings->responsive_compatibility == 'uabb-responsive-medsmall' ) {
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-dual-color-heading * {
				<?php if( $settings->dual_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->dual_font_size['medium']; ?>px;
				<?php endif; ?>
				<?php if( $settings->dual_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->dual_line_height['medium']; ?>px;
				<?php endif; ?>
			}
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-first-heading-text,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-second-heading-text {
				display: inline-block;
			}
	    }
	<?php
	}
	if( $settings->dual_font_size['small'] != "" || $settings->dual_line_height['small'] != "" || $settings->responsive_compatibility == 'uabb-responsive-mobile' ) {
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-dual-color-heading * {
				<?php if( $settings->dual_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->dual_font_size['small']; ?>px;
				<?php endif; ?>
				<?php if( $settings->dual_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->dual_line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-first-heading-text,
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-second-heading-text {
				display: inline-block;
			}
	    }
	<?php
	}
}
?>

/* Typography responsive layout Ends here */