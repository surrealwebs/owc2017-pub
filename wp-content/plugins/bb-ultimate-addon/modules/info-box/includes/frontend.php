<?php
$stacked_class = '';
if( $settings->image_type != 'none' ) {
	if( $settings->img_icon_position == 'right' ) {
		if( $settings->mobile_view == 'stack' ) {
			if( $settings->stacking_order == 'reversed' ) {
				$stacked_class = 'uabb-reverse-order';
			}
		}
	}
}
?>
<div class="uabb-module-content <?php echo $module->get_classname(); ?> <?php echo $stacked_class; ?>">
	<div class="uabb-infobox-left-right-wrap">
	<?php 
	if( $settings->cta_type == 'module' && !empty($settings->link) ) {
		echo '<a href="' . $settings->link . '" target="' . $settings->link_target . '" '. BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, 0, 0 ) .' class="uabb-infobox-module-link"></a>';
	}
	// Image left
	$module->render_image('left'); 
	
	?><div class="uabb-infobox-content">
			<?php 
			// Image above title
			$module->render_image('above-title');
			// Title
			$module->render_title();
			// Image below title
			$module->render_image('below-title');
			// Separator
			$module->render_separator();
			
			if( $settings->text != "" || $settings->cta_type == 'link' || $settings->cta_type == 'button' ) {
			?>
			<div class="uabb-infobox-text-wrap">
				<?php 
				// Text 
				$module->render_text();
				// Link CTA
				$module->render_link();
				// Button CTA 
				$module->render_button();
				?>
			</div> 
			<?php
			}
			?>
		</div><?php
		// Image right
		$module->render_image('right'); 
		?>
	</div>
</div>