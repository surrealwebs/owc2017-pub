<?php 
	$settings->overlay_color = ( $settings->overlay_color == '' ) ? '000000' : $settings->overlay_color;
	$settings->overlay_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );
	$settings->caption_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'caption_bg_color', true );
	$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
	$settings->overlay_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_icon_color' );

	$settings->photo_spacing = ( $settings->photo_spacing != '' ) ? $settings->photo_spacing : '20';
	$settings->caption_bg_color = ( $settings->caption_bg_color != '' ) ? $settings->caption_bg_color : '#f7f7f7';
?>

.fl-node-<?php echo $id; ?> .uabb-photo-gallery,
.fl-node-<?php echo $id; ?> .uabb-masonary-content {
	margin: -<?php echo $settings->photo_spacing / 2; ?>px;
}

<?php if($settings->layout == 'grid') { ?>
	.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item {
		width: <?php echo 100/$settings->grid_column; ?>%;
		padding: <?php echo $settings->photo_spacing / 2; ?>px;
	}
	<?php if ( $settings->grid_column > 1 ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->grid_column; ?>n+1){
		clear: left;
	}
	.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->grid_column; ?>n+0){
		clear: right;
	}
	<?php } ?>

<?php }elseif($settings->layout == 'masonary'){ ?>

.fl-node-<?php echo $id; ?> .uabb-grid-sizer {
	width: <?php echo 100/$settings->grid_column; ?>%;
}

.fl-node-<?php echo $id; ?> .uabb-masonary-item {
	width: <?php echo 100/$settings->grid_column; ?>%;
	padding: <?php echo $settings->photo_spacing / 2; ?>px;
}
<?php } ?>

<?php if($settings->click_action == 'lightbox' && !empty($settings->show_captions)) : ?>
.mfp-gallery img.mfp-img {
	padding: 40px 0;
}	

.mfp-counter {
	display: block !important;
}
<?php endif; ?>

<?php if( $settings->hover_effects != 'none' ) : ?>
.fl-node-<?php echo $id; ?> .uabb-background-mask {
	background: <?php echo ($settings->overlay_color != '' ) ? $settings->overlay_color : 'rgba(0,0,0,.5)'; ?>;
}
.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-overlay-icon i {
	color: <?php echo $settings->overlay_icon_color; ?>;
	font-size: <?php echo ( $settings->overlay_icon_size ) ? $settings->overlay_icon_size : '16'; ?>px;
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .uabb-photo-gallery-caption {
	background-color: <?php echo $settings->caption_bg_color; ?>;
}
.fl-node-<?php echo $id; ?> .uabb-photo-gallery-caption,
.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {
	<?php if( $settings->font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->color != '' ) : ?>
	color: <?php echo $settings->color; ?>;
	<?php endif; ?>
}

<?php if($global_settings->responsive_enabled) { // Global Setting If started ?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
		
		.fl-node-<?php echo $id; ?> .uabb-photo-gallery-caption,
		.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {
			<?php if( $settings->font_size['medium'] != '' ) : ?>
			font-size: <?php echo $settings->font_size['medium']; ?>px;
			<?php endif; ?>
	
			<?php if( $settings->line_height['medium'] != '' ) : ?>
			line-height: <?php echo $settings->line_height['medium']; ?>px;
			<?php endif; ?>
		}

		<?php if ( $settings->layout == 'grid' && $settings->grid_column != $settings->medium_grid_column ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item {
				width: <?php echo 100/$settings->medium_grid_column; ?>%;
			}
			<?php if ( $settings->grid_column > 1 ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->grid_column; ?>n+1),
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->grid_column; ?>n+0) {
				clear: none;
			}
			<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->medium_grid_column; ?>n+1){
				clear: left;
			}
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->medium_grid_column; ?>n+0){
				clear: right;
			}
		<?php } elseif($settings->layout == 'masonary' && $settings->grid_column != $settings->medium_grid_column) { ?>	
			.fl-node-<?php echo $id; ?> .uabb-grid-sizer {
				width: <?php echo 100/$settings->medium_grid_column; ?>%;
			}

			.fl-node-<?php echo $id; ?> .uabb-masonary-item {
				width: <?php echo 100/$settings->medium_grid_column; ?>%;
			}
		<?php } ?>
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
		
		.fl-node-<?php echo $id; ?> .uabb-photo-gallery-caption,
		.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {
			<?php if( $settings->font_size['small'] != '' ) : ?>
			font-size: <?php echo $settings->font_size['small']; ?>px;
			<?php endif; ?>
	
			<?php if( $settings->line_height['small'] != '' ) : ?>
			line-height: <?php echo $settings->line_height['small']; ?>px;
			<?php endif; ?>
		}

		<?php if ( $settings->layout == 'grid' && $settings->grid_column != $settings->responsive_grid_column ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item {
				width: <?php echo 100/$settings->responsive_grid_column; ?>%;
			}
			<?php if ( $settings->grid_column > 1 ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->grid_column; ?>n+1),
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->grid_column; ?>n+0)
			<?php if ( $settings->grid_column != $settings->medium_grid_column ) { ?>
			, .fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->medium_grid_column; ?>n+1),
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->medium_grid_column; ?>n+0) 
			<?php } ?> {
				clear: none;
			}
			<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->responsive_grid_column; ?>n+1){
				clear: left;
			}
			.fl-node-<?php echo $id; ?> .uabb-photo-gallery-item:nth-child(<?php echo $settings->responsive_grid_column; ?>n+0){
				clear: right;
			}
		<?php } elseif($settings->layout == 'masonary' && $settings->grid_column != $settings->responsive_grid_column) { ?>	
			.fl-node-<?php echo $id; ?> .uabb-grid-sizer {
				width: <?php echo 100/$settings->responsive_grid_column; ?>%;
			}

			.fl-node-<?php echo $id; ?> .uabb-masonary-item {
				width: <?php echo 100/$settings->responsive_grid_column; ?>%;
			}
		<?php } ?>
		}
<?php } ?>