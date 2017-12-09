<?php 
	$settings->overlay_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );
	$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
	$settings->caption_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'caption_bg_color', true );
	$settings->overlay_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_icon_color' );

	$settings->photo_spacing = ( $settings->photo_spacing != '' ) ? $settings->photo_spacing : '20';
	$settings->caption_bg_color = ( $settings->caption_bg_color != '' ) ? $settings->caption_bg_color : '#f7f7f7';

	$settings->arrow_color = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color' );
	$settings->arrow_background_color = UABB_Helper::uabb_colorpicker( $settings, 'arrow_background_color', true);
	$settings->arrow_color_border = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color_border' );
?>

.fl-node-<?php echo $id; ?> .uabb-image-carousel {
	margin: -<?php echo $settings->photo_spacing / 2; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-image-carousel-item {
	width: <?php echo 100/$settings->grid_column; ?>%;
	padding: <?php echo $settings->photo_spacing / 2; ?>px;
}

/* Arrow Style */

.fl-node-<?php echo $id; ?> .slick-prev i,
.fl-node-<?php echo $id; ?> .slick-next i,
.fl-node-<?php echo $id; ?> .slick-prev i:hover,
.fl-node-<?php echo $id; ?> .slick-next i:hover,
.fl-node-<?php echo $id; ?> .slick-prev i:focus,
.fl-node-<?php echo $id; ?> .slick-next i:focus {
	outline: none;
	<?php 	$color = uabb_theme_base_color( $settings->arrow_color );
			$arrow_color = ( $color != '' ) ? $color : '#fff'; ?>
	color: <?php echo $arrow_color; ?>;
	<?php 	switch ( $settings->arrow_style ) {
				case 'square': ?>
				background: <?php echo ( $settings->arrow_background_color != '' ) ? $settings->arrow_background_color : '#efefef'; ?>;
	<?php 		break;
		
				case 'circle': ?>
				border-radius: 50%;
				background: <?php echo ( $settings->arrow_background_color != '' ) ? $settings->arrow_background_color : '#efefef'; ?>;
	<?php		break;

				case 'square-border': ?>
				border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border ?>;
	<?php		break;

				case 'circle-border': ?>
				border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border ?>;
				border-radius: 50%;
	<?php		break;
			} ?>
}

<?php if( $settings->arrow_position == 'inside' ) { ?>
	.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-prev,
	.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-next {
	    left: <?php echo $settings->photo_spacing / 2; ?>px;

	}
	.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-next,
	.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-prev
	{
	    right: <?php echo $settings->photo_spacing / 2; ?>px;
	    transform: translate(50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:hover,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:focus,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:focus,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:hover {
	    width: 28px;
	    height: 28px;
	    line-height: 28px;
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

.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption {
	background-color: <?php echo $settings->caption_bg_color; ?>;
}
.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption,
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
		
		.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption,
		.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {
			<?php if( $settings->font_size['medium'] != '' ) : ?>
			font-size: <?php echo $settings->font_size['medium']; ?>px;
			<?php endif; ?>
	
			<?php if( $settings->line_height['medium'] != '' ) : ?>
			line-height: <?php echo $settings->line_height['medium']; ?>px;
			<?php endif; ?>
		}
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
		
		.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-prev,
		.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-next {
		    left: <?php echo $settings->photo_spacing / 2; ?>px;
			
		}
		.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-next,
		.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-prev
		{
		    right: <?php echo $settings->photo_spacing / 2; ?>px;
		    transform: translate(50%, -50%);
		}
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:hover,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:focus,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:focus,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:hover {
		    width: 20px;
    		height: 20px;
    		line-height: 20px;
    		font-size: 15px;
		}
		.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption,
		.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {
			<?php if( $settings->font_size['small'] != '' ) : ?>
			font-size: <?php echo $settings->font_size['small']; ?>px;
			<?php endif; ?>
	
			<?php if( $settings->line_height['small'] != '' ) : ?>
			line-height: <?php echo $settings->line_height['small']; ?>px;
			<?php endif; ?>
		}
	}
<?php } ?>