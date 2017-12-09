<?php

$photo    = $module->get_data();
$classes  = $module->get_classes();
$src      = $module->get_src();
$link     = $module->get_link();
$alt      = $module->get_alt();
$attrs    = $module->get_attributes();

$grayscale_class = '';
if( $settings->hover_effect == 'simple' ) {
	if( $settings->img_grayscale_simple != 'yes' ) {
		$grayscale_class = 'uabb-img-color-gray';
	} else {
		$grayscale_class = '';
	}
} else if( $settings->hover_effect == 'style2' ) {
	if( $settings->img_grayscale_grayscale != 'yes' ) {
		$grayscale_class = 'uabb-img-grayscale uabb-img-gray-color';
	} else {
		$grayscale_class = 'uabb-img-grayscale';
	}
}

?>
<div class="uabb-module-content uabb-photo<?php if ( ! empty( $settings->crop ) ) echo ' uabb-photo-crop-' . $settings->crop ; ?> uabb-photo-align-<?php echo $settings->align; ?> uabb-photo-mob-align-<?php echo $settings->responsive_align; ?>" itemscope itemtype="http://schema.org/ImageObject">
	<div class="uabb-photo-content <?php echo $grayscale_class; ?>">

		<?php if(!empty($link)) : ?>
		<a href="<?php echo $link; ?>" target="<?php echo $settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, 0, 1 ); ?> itemprop="url">
		<?php endif; ?>
		<img class="<?php echo $classes; ?>" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" itemprop="image" <?php echo $attrs; ?> />

		<?php if($photo && !empty($photo->caption) && 'hover' == $settings->show_caption) : ?>
		<div class="uabb-photo-caption uabb-photo-caption-hover" itemprop="caption"><?php echo $photo->caption; ?></div>
		<?php endif; ?>
		<?php if(!empty($link)) : ?>
		</a>
		<?php endif; ?>
	</div>
	<?php if($photo && !empty($photo->caption) && 'below' == $settings->show_caption) : ?>
	<div class="uabb-photo-caption uabb-photo-caption-below" itemprop="caption"><?php echo $photo->caption; ?></div>
	<?php endif; ?>
</div>