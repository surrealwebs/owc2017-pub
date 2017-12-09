<?php 
	$settings->title_color = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
	$settings->title_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'title_hover_color' );
	
	$settings->title_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'title_bg_color', true );
	$settings->title_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'title_bg_hover_color', true );

	$settings->title_border_color = UABB_Helper::uabb_colorpicker( $settings, 'title_border_color' );

	$settings->icon_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
	$settings->icon_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color' );

	$settings->content_color = UABB_Helper::uabb_colorpicker( $settings, 'content_color' );
	$settings->content_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'content_bg_color', true );

	$settings->content_border_color = UABB_Helper::uabb_colorpicker( $settings, 'content_border_color' );
	
	$settings->title_margin = ( $settings->title_margin != '' ) ? $settings->title_margin : '10';
	$settings->icon_size = ( $settings->icon_size != '' ) ? $settings->icon_size : '16';
	$settings->title_border_top = ( $settings->title_border_top != '' ) ? $settings->title_border_top : '1';
	$settings->title_border_bottom = ( $settings->title_border_bottom != '' ) ? $settings->title_border_bottom : '1';
	$settings->title_border_radius = ( $settings->title_border_radius != '' ) ? $settings->title_border_radius : '0';
	$settings->content_border_radius = ( $settings->content_border_radius != '' ) ? $settings->content_border_radius : '0';
?>

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-item {
	<?php if ( is_numeric( $settings->title_margin ) ) { ?>
		margin-bottom: <?php echo $settings->title_margin; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> {
	<?php echo $settings->title_spacing; ?>;
	background: <?php echo $settings->title_bg_color; ?>;
<?php if ( $settings->title_border_type != 'none' ) {// var_dump( $settings->title_border_top); die(); ?>
	border: <?php echo $settings->title_border_type; ?> <?php echo $settings->title_border_color; ?>;
	border-top-width: <?php echo $settings->title_border_top; ?>px;
	border-bottom-width: <?php echo $settings->title_border_bottom; ?>px;
	border-left-width: <?php echo ( $settings->title_border_left != '' ) ? $settings->title_border_left : '1'; ?>px;
	border-right-width: <?php echo ( $settings->title_border_right != '' ) ? $settings->title_border_right : '1'; ?>px;
	<?php if( ( $settings->title_margin == 0 ) && ( $settings->title_border_top != 0 ) ) { ?>
	border-bottom-width: 0;
	<?php } ?>
    -webkit-transition: all 15ms linear;
       -moz-transition: all 15ms linear;
         -o-transition: all 15ms linear;
			transition: all 15ms linear;
<?php } ?>
	border-radius: <?php echo $settings->title_border_radius; ?>px;	

	<?php if( $settings->open_icon == '' && $settings->close_icon == '' ) : ?>
	width: 100%;
	<?php endif; ?>
}

<?php if( ( $settings->title_margin == 0 ) && ( $settings->title_border_top != 0 ) ) : ?>

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-item:last-child .uabb-adv-accordion-button<?php echo $id; ?>,
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-item-active > .uabb-adv-accordion-button<?php echo $id; ?> {
	<?php if ( $settings->title_border_type != 'none' ) { ?>
		border-bottom-width: <?php echo $settings->title_border_bottom; ?>px;
	<?php } ?>
}

<?php endif; ?>

<?php if( $settings->open_icon == '' && $settings->close_icon == '' ) : ?>
.fl-node-<?php echo $id; ?> .uabb-adv-before-text .uabb-adv-accordion-button-label {
	padding-left: 0;
}
.fl-node-<?php echo $id; ?> .uabb-adv-after-text .uabb-adv-accordion-button-label {
	padding-right: 0;
}
<?php endif; ?>

/* Color */
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-label {
	color: <?php echo $settings->title_color; ?>;
	text-align: <?php echo $settings->title_align; ?>;
    -webkit-transition: all 15ms linear;
       -moz-transition: all 15ms linear;
         -o-transition: all 15ms linear;
			transition: all 15ms linear;
}

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-icon {
	color: <?php echo $settings->icon_color; ?>;
    -webkit-transition: color 15ms linear, transform 60ms linear;
       -moz-transition: color 15ms linear, transform 60ms linear;
         -o-transition: color 15ms linear, transform 60ms linear;
			transition: color 15ms linear, transform 60ms linear;
}



/* Content css */

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-content<?php echo $id; ?> {
	background: <?php echo $settings->content_bg_color; ?>;
	<?php echo $settings->content_spacing; ?>;
	text-align: <?php echo $settings->content_align; ?>;
	<?php if ( $settings->content_border_type != 'none' ) { ?>
		border: <?php echo $settings->content_border_type ?> <?php echo $settings->content_border_color; ?>;
		border-top-width: <?php echo ( $settings->content_border_top != '')  ? $settings->content_border_top : '1'; ?>px;
		border-bottom-width: <?php echo ( $settings->content_border_bottom != '')  ? $settings->content_border_bottom : '1'; ?>px;
		border-left-width: <?php echo ( $settings->content_border_left != '')  ? $settings->content_border_left : '1'; ?>px;
		border-right-width: <?php echo ( $settings->content_border_right != '')  ? $settings->content_border_right : '1'; ?>px;
	<?php } ?>
	border-radius: <?php echo $settings->content_border_radius; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-content<?php echo $id; ?>.uabb-accordion-desc {
	color: <?php echo $settings->content_color; ?>;
}

/* Hover State */
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?>:hover .uabb-adv-accordion-button-label,
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-item-active > .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-label {
	color: <?php echo $settings->title_hover_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?>:hover,
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-item-active > .uabb-adv-accordion-button<?php echo $id; ?> {
	background: <?php echo $settings->title_bg_hover_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?>:hover .uabb-adv-accordion-button-icon,
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-item-active > .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-icon {
	color: <?php echo $settings->icon_hover_color; ?>;
}


/* Typography */
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-label {
	<?php if( $settings->font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
	<?php endif; ?>
	<?php if( $settings->font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
	<?php endif; ?>
	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-icon,
.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-icon.dashicons:before {
	<?php if( $settings->icon_size != '' ) : ?>
		font-size: <?php echo $settings->icon_size; ?>px;
		line-height: <?php echo $settings->icon_size + 2; ?>px;
		height: <?php echo $settings->icon_size + 2; ?>px;
		width: <?php echo $settings->icon_size + 2; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-adv-accordion-content<?php echo $id; ?>.uabb-accordion-desc {
	<?php if( $settings->content_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->content_font_family ); ?>
	<?php endif; ?>
	<?php if( $settings->content_font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->content_font_size['desktop']; ?>px;
	line-height: <?php echo $settings->content_font_size['desktop'] + 2; ?>px;
	<?php endif; ?>
	<?php if( $settings->content_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->content_line_height['desktop']; ?>px;
	<?php endif; ?>
}


<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" ) { ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-label {
				<?php if( $settings->font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['medium']; ?>px;
				line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php } ?>
	<?php if( $settings->font_size['small'] != "" || $settings->line_height['small'] != "" ) {
		/* Small Breakpoint media query */	
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-adv-accordion-button<?php echo $id; ?> .uabb-adv-accordion-button-label {
				<?php if( $settings->font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['small']; ?>px;
				line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php
	}

	/* Content Responsive */
	if( $settings->content_font_size['medium'] != "" || $settings->content_line_height['medium'] != "" ) { ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-adv-accordion-content<?php echo $id; ?>.uabb-accordion-desc {
				<?php if( $settings->content_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->content_font_size['medium']; ?>px;
				line-height: <?php echo $settings->content_font_size['medium'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->content_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->content_line_height['medium']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php } ?>
	<?php if( $settings->content_font_size['small'] != "" || $settings->content_line_height['small'] != "" ) {
		/* Small Breakpoint media query */	
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-adv-accordion-content<?php echo $id; ?>.uabb-accordion-desc {
				<?php if( $settings->content_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->content_font_size['small']; ?>px;
				line-height: <?php echo $settings->content_font_size['small'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->content_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->content_line_height['small']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php
	}
} ?>