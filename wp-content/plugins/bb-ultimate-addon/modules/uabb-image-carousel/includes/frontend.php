<div class="uabb-module-content uabb-image-carousel uabb-img-col-<?php echo $settings->grid_column; ?> <?php echo ( $settings->hover_effects != 'none' ) ? $settings->hover_effects : ''; ?>"><?php 
	foreach($module->get_photos() as $photo) : 
	?><div class="uabb-image-carousel-item <?php echo ( ( $settings->click_action != 'none' ) && !empty( $photo->link ) ) ? 'uabb-image-carousel-link' : ''; ?>">
		<div class="uabb-image-carousel-content">
			<?php if( $settings->click_action != 'none' ) : ?>
				<?php $click_action_link = ''; 
					  $click_action_target = '_self';
					if ( $settings->click_action == 'lightbox' && !empty( $photo->link ) ) {
						$click_action_link 	 = $photo->link;
						$click_action_target = '_self';
					}elseif ( $settings->click_action == 'cta-link' && !empty( $photo->cta_link ) ) {
						$click_action_link = $photo->cta_link;
						$click_action_target = ( isset( $settings->click_action_target ) ) ? $settings->click_action_target : '_blank';

					} 
				?>
			<a href="<?php echo $click_action_link; ?>" target="<?php echo $click_action_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $click_action_target, 0, 1 ); ?> data-caption="<?php echo $photo->caption; ?>">
			<?php endif; ?>

			<?php if ( $settings->lazyload == 'yes' ) {
				$img_src = 'data-lazy="'.$photo->src.'"';
			}else{
				$img_src = 'src="'.$photo->src.'"';
			} ?>
			
			<img class="uabb-gallery-img" <?php echo $img_src; ?> alt="<?php echo $photo->alt; ?>" />
			
			<?php if( $settings->hover_effects != 'none' ) : ?>
				<!-- Overlay Wrapper -->
				<div class="uabb-background-mask <?php echo $settings->hover_effects; ?>">
					<div class="uabb-inner-mask">
						
						<?php if( $settings->show_captions == 'hover' ) : ?>
							<<?php echo $settings->tag_selection; ?> class="uabb-caption">
								<?php echo $photo->caption; ?>
							</<?php echo $settings->tag_selection; ?>>
						<?php endif; ?>
						
						<?php if( $settings->icon == '1' && $settings->overlay_icon != '' ) : ?>
						<div class="uabb-overlay-icon">
							<i class="<?php echo $settings->overlay_icon; ?>" ></i>
						</div>
						<?php endif; ?>
					
					</div>
				</div> <!-- Overlay Wrapper Closed -->
			<?php endif; ?>
			<?php if( $settings->click_action != 'none' ) : ?>
			</a>
			<?php endif; ?>    
			<?php if($photo && !empty($photo->caption) && 'hover' == $settings->show_captions && $settings->hover_effects == 'none' ) : ?>
			<<?php echo $settings->tag_selection; ?> class="uabb-image-carousel-caption uabb-image-carousel-caption-hover" itemprop="caption"><?php echo $photo->caption; ?></<?php echo $settings->tag_selection; ?>>
			<?php endif; ?>
		</div>
		<?php if($photo && !empty($photo->caption) && 'below' == $settings->show_captions) : ?>
		<<?php echo $settings->tag_selection; ?> class="uabb-image-carousel-caption uabb-image-carousel-caption-below" itemprop="caption"><?php echo $photo->caption; ?></<?php echo $settings->tag_selection; ?>>
		<?php endif; ?>
	<?php 
		
		//var_dump( $photo );	
	?></div><?php 
	endforeach; 
?></div>