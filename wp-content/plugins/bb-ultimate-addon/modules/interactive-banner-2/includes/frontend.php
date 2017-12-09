
<div class="uabb-module-content uabb-ib2-outter uabb-new-ib uabb-ib-effect-<?php echo $settings->banner_style; ?>  <?php echo ( $settings->banner_height != '' ) ? 'uabb-ib2-min-height' : ''; ?> " >
	<?php
		if( $settings->banner_image != '' ) {
	?>
	<?php
		$alt      = $module->get_alt();
	?>
	<img class="uabb-new-ib-img" src="<?php echo $settings->banner_image_src; ?>" alt="<?php echo $alt; ?>">
	<?php
		}
	?>
	<div class="uabb-new-ib-desc">
	<?php
	if( $settings->banner_title != '' ) {
	?>
		<<?php echo $settings->title_typography_tag_selection; ?> class="uabb-new-ib-title uabb-simplify"><?php echo $settings->banner_title; ?></<?php echo $settings->title_typography_tag_selection; ?>>
	<?php
	}
	?>
		<div class="uabb-new-ib-content uabb-text-editor uabb-simplify"><?php echo $settings->banner_desc; ?></div>
	</div>
	<?php
	if( $settings->link_url != '' ) {
	?>
	<a class="uabb-new-ib-link" href="<?php echo $settings->link_url; ?>" target="<?php echo $settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, 0, 1 ); ?>></a>
	<?php
	}
	?>
</div>
