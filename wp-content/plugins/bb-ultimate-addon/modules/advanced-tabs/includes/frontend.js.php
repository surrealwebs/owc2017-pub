(function($) {

	$(function() {
		new UABBTabs({
			id: '<?php echo $id ?>'
		});
	});

})(jQuery);
<?php
$settings->responsive_breakpoint = ( isset( $settings->responsive_breakpoint ) && $settings->responsive_breakpoint != '' ) ? $settings->responsive_breakpoint : $global_settings->responsive_breakpoint;
if( $settings->responsive == 'accordion' ) {
?>
	jQuery(window).resize(function() {
		var breakpoint_val = parseInt( '<?php echo $settings->responsive_breakpoint; ?>' );
		if( jQuery(document).width() <= breakpoint_val ) {

			<?php
			if( $settings->enable_first == 'yes' ) {
			?>
			jQuery('.fl-node-<?php echo $id; ?> .uabb-tabs').find('.uabb-content-current .uabb-content').slideUp('normal');
			<?php
			}
			?>
		}
	});

	jQuery(document).ready(function() {
		var breakpoint_val = parseInt( '<?php echo $settings->responsive_breakpoint; ?>' );
		if( jQuery(document).width() <= breakpoint_val ) {

			<?php
			if( $settings->enable_first == 'yes' ) {
			?>
			jQuery('.fl-node-<?php echo $id; ?> .uabb-tabs').find('.uabb-content-current .uabb-content').slideUp('normal');
			<?php
			}
			?>
		}
	});
<?php
}
?>