(function($) {

	$(function() {
	
		new UABBSubscribeFormModule({
			id: '<?php echo $id ?>',
			btn_width: '<?php echo $settings->btn_width; ?>',
			btn_padding: '<?php echo uabb_theme_button_vertical_padding(''); ?>',
			layout: '<?php echo $settings->layout; ?>',
		});
	});
	
})(jQuery);