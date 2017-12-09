<div class="uabb-module-content uabb-ib1-outter">
	<?php if( $settings->show_button == 'complete' ) : ?>
	<a href="<?php echo $settings->cta_link; ?>" target="<?php echo $settings->cta_link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->cta_link_target, 0, 1 ); ?>>
	<?php endif; ?>
	<div class="uabb-banner-<?php echo $settings->banner_style; ?> <?php echo ( $settings->banner_height_options == 'custom' ) ? ( ( $settings->banner_height != '' ) ? 'uabb-banner-block-custom-height' : '' ) : ''; ?> uabb-adjust-bottom-margin uabb-bb-box uabb-ib1-block <?php echo ( $settings->banner_height_options == 'custom' && $settings->image_size_compatibility == 'yes' ) ? 'uabb-ib1-img-compatibility' : ''; ?>" data-style="<?php echo $settings->banner_height_options; ?>">
		<div class="uabb-image-wrap">
			<?php
			if( isset( $settings->banner_image_src ) ) {
				if( $settings->banner_image_src != '' ) {
			?>
			<?php
				$alt      = $module->get_alt();
			?>
			<img src="<?php echo $settings->banner_image_src; ?>" alt="<?php echo $alt; ?>">
			<?php
				}
			}
			?>
			<div class="mask uabb-background <?php echo ( isset( $settings->overlay_background_color ) ) ? 'opaque-background' : 'solid-background'; ?>">
				<div class="uabb-inner-mask">
					<?php
					if( $settings->icon != '' ) {
					?>
					<div class="uabb-back-icon">
					<?php $module->render_icon(); ?>
					</div>
					<?php
					}
					?>
					<div class="uabb-ib1-description uabb-text-editor">
					<?php echo $settings->banner_desc; ?>
					</div>
					<?php
					if( $settings->button != '' ) {
						$module->render_button();
					}
					?>
				</div>
			</div>
		</div>
		<?php
		if( $settings->banner_title != '' ) {
		?>
		<<?php echo $settings->title_typography_tag_selection; ?> class="uabb-ib1-title title-<?php echo $settings->banner_title_location; ?>">
			<?php echo $settings->banner_title; ?>
		</<?php echo $settings->title_typography_tag_selection; ?>>
		<?php
		}
		?>
	</div>
	<?php if( $settings->show_button == 'complete' ) : ?>
	</a>
	<?php endif; ?>
</div>