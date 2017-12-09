<?php $settings->autoplay_time = ($settings->autoplay_time != '') ? $settings->autoplay_time : '15'; ?>
<div class="uabb-module-content uabb-info-circle-wrap on-<?php echo $settings->info_trigger_type; ?>" <?php echo ($settings->autoplay == 'yes') ? 'data-interval-time="'.$settings->autoplay_time .'"' : ''; ?> data-active-animation="<?php echo $settings->active_animation; ?>">

	<div class="uabb-info-circle uabb-info-circle-out"></div>
	<?php 
		$circle_item_count = 0;
		foreach( $settings->add_circle_item as $item ) { 
			if( !is_object( $item ) ) { continue; }

			$circle_item_count++;
			$img_active_effect = ( $item->photo_active_type != 'none' ) ? $item->photo_active_type : '';
	?>
			<div class="uabb-info-circle-icon-content uabb-ic-<?php echo $circle_item_count; ?> <?php echo ( $circle_item_count == 1 ) ? 'active' : ''; ?>">
				
				<?php if( $settings->info_trigger_type == 'hover' && ( $item->cta == 'icon' || $item->cta == 'both' ) ) : ?>
					<a href='<?php echo $item->cta_link; ?>' target='<?php echo $item->cta_link_target; ?>' <?php BB_Ultimate_Addon_Helper::get_link_rel( $item->cta_link_target, 0, 1 ); ?>> <!-- Link on Icon -->
				<?php endif; ?>
					
					<div class="uabb-info-circle uabb-info-circle-small uabb-circle-<?php echo $circle_item_count; ?> <?php echo $img_active_effect; ?>" data-circle-id="<?php echo $circle_item_count; ?>">
						<div>
							<?php $module->render_icon_image( $item ); ?>
							<?php 
								if( $item->image_type == 'photo' && $item->photo_active_type == 'change-img' ) {
									$module->render_icon_image( $item, 'active-img' );
								} 
							?>
						</div>
					</div>

				<?php if( $settings->info_trigger_type == 'hover' && ( $item->cta == 'icon' || $item->cta == 'both' ) ) : ?>
					</a>
				<?php endif; ?>

				<div class="uabb-info-circle uabb-info-circle-in uabb-info-circle-in-<?php echo $circle_item_count; ?>" <?php echo ( $circle_item_count == 1 ) ? 'style="display:block;"' : ''; ?>>
					<div class="uabb-info-circle-content">
						<?php if( $settings->info_area_icon != 'no' ) : ?>
							<?php $module->render_icon_image( $item ); ?>
						<?php endif; ?>
						
						<<?php echo $settings->tag_selection; ?> class="uabb-info-circle-title"><?php echo $item->circle_item_title; ?></<?php echo $settings->tag_selection; ?>>
						
						<?php if( $settings->info_separator_style != 'none' ) : ?> 
							<span class="uabb-ic-separator"></span>
						<?php endif; ?>
						
						<div class="uabb-info-circle-desc uabb-text-editor"><?php echo $item->circle_item_description; ?></div>

						<!-- CTA -->
						<?php if( $item->cta == 'desc' || $item->cta == 'both' ) : ?>
							<div class='uabb-info-circle-cta uabb-info-circle-cta-<?php echo $item->desc_cta_type; ?>'>
								<?php $module->render_cta( $item );  ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
	<?php 
		} 
	?>

</div>