<?php

$grayscale_class = '';
if( $settings->photo_style == 'simple' ) {
	if( $settings->img_grayscale_simple != 'yes' ) {
		$grayscale_class = 'uabb-img-color-gray';
	} else {
		$grayscale_class = '';
	}
} else if( $settings->photo_style == 'grayscale' ) {
	if( $settings->img_grayscale_grayscale != 'yes' ) {
		$grayscale_class = 'uabb-img-grayscale uabb-img-gray-color';
	} else {
		$grayscale_class = 'uabb-img-grayscale';
	}
}

?>

<div class="uabb-module-content uabb-team-wrap">
	<div class="uabb-team-member-wrap">
		<div class="uabb-team-image <?php echo $grayscale_class; ?>">
		<?php 
			// Render Team Image
			$module->render_image(); 
		?>
		</div> 
		<?php	
			$module->render_separator('below_image');
		?>
		<div class="uabb-team-content">
		<?php 
			// Text 
			$module->render_name();
			$module->render_separator('below_name');
			$module->render_desgn();
			$module->render_separator('below_desg');
			$module->render_desc();
			$module->render_separator('below_desc');
		?>
			<?php if ( $settings->enable_social_icons == 'yes' ) { ?>
				<div class="uabb-team-social">
				<?php 
					$module->render_social_icons();
				?>
				</div> 
			<?php } ?>
		</div>
	</div>
</div>
