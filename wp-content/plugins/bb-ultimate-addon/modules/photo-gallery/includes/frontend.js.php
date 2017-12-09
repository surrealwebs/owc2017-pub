jQuery(document).ready(function( $ ) {
	<?php if($settings->click_action == 'lightbox') : ?>
	<?php if($settings->layout == 'masonary'){ 
			$selector = '.uabb-masonary-content'; ?>
		<?php }else{ 
			$selector = '.uabb-photo-gallery'; ?>
		<?php } ?>
		var gallery_selector = $( '.fl-node-<?php echo $id; ?> <?php echo $selector; ?>' );
		if( gallery_selector.length && typeof $.fn.magnificPopup !== 'undefined') {
			gallery_selector.magnificPopup({
				delegate: '.uabb-photo-gallery-content a',
				closeBtnInside: false,
				type: 'image',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
				},
				'image': {
					titleSrc: function(item) {
						<?php if($settings->show_captions == 'below') : ?>
							return item.el.data('caption');
						<?php elseif($settings->show_captions == 'hover') : ?>
							return item.el.data('caption');
						<?php endif; ?>
					}
				}
			});
		}
	<?php endif; ?>
	
	<?php if($settings->layout == 'masonary') : ?>
	var $grid = $('.fl-node-<?php echo $id; ?> .uabb-masonary-content').imagesLoaded( function() {
		$grid.masonry({
		  columnWidth: '.uabb-grid-sizer',
		  itemSelector: '.uabb-masonary-item'
		});
	});
	
	/* Tab Click Trigger */
	UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
		if( $(selector).find('.uabb-masonary-content') ){
			setTimeout(function() {
				var el_masonary = $(selector).find('.uabb-masonary-content');
				
				el_masonary.masonry( 'reload' );

			}, 100);
		}
	});

	<?php endif; ?>

});