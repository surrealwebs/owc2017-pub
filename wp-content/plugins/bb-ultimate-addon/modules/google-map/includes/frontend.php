<?php
$gerror = false;
$style = '';
// echo "<xmp>"; print_r($settings); echo "</xmp>";
$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];
if ( !isset( $uabb_setting_options['uabb-google-map-api'] ) || ( isset( $uabb_setting_options['uabb-google-map-api'] ) && empty( $uabb_setting_options['uabb-google-map-api'] ) ) ) { 
	$gerror = true;
	$style = 'style="position: relative"';
} ?>


<?php /* Google Map Markup */ ?>
<div class='uabb-module-content uabb-google-map-wrapper' id="uabb-google-map" <?php echo $style; ?> >
	
	<?php if ( $gerror == true && current_user_can('delete_users') ) { ?>
	<div class='uabb-google-map-error' style="line-height: 1.5em;padding: 50px;text-align: center;position: absolute;top: 50%;width: 100%;left: 50%;transform: translate(-50%,-50%);">
		<span style=" line-height: 1.45em;">It seems that you have not yet configured Google Map API key. To display advanced Google map, please set up API key in <a href="<?php echo admin_url( 'options-general.php?page=uabb-builder-settings#uabb' ); ?>" class="uabb-google-map-notice" target="_blank" rel="noopener"><span style="font-weight:bold;">General Settings</span></a></span>.
	</div>
	<?php } ?>
</div>
