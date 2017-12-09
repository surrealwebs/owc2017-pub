jQuery(document).ready(function( $ ) {
	var args = {
	    	id: '<?php echo $id; ?>',
	    	infinite: <?php echo ( $settings->infinite_loop == 'yes' ) ? 'true' : 'false'; ?>,
	    	arrows: <?php echo ( $settings->enable_arrow == 'yes' ) ? 'true' : 'false'; ?>,
	    	
	    	desktop: <?php echo $settings->grid_column; ?>,
	    	medium: <?php echo $settings->medium_grid_column; ?>,
	    	small: <?php echo $settings->responsive_grid_column; ?>,
			
			slidesToScroll: <?php echo ( $settings->slides_to_scroll != '' ) ? $settings->slides_to_scroll : 1; ?>,
			autoplay: <?php echo ( $settings->autoplay == 'yes' ) ? 'true' : 'false'; ?>,
	  		autoplaySpeed: <?php echo ( $settings->animation_speed != '' ) ? $settings->animation_speed : '1000'; ?>,
	  		small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
	  		medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
	    };
		

	UABBImageCarousel_<?php echo $id; ?> = new UABBImageCarousel( args );

	$(window).load(function() {
		//UABBImageCarousel_<?php echo $id; ?> = new UABBImageCarousel( args );
	 	UABBImageCarousel_<?php echo $id; ?>._adaptiveImageHeight();
	});

	var UABBImageCarouselResize_<?php echo $id; ?>;
	$( window ).resize(function() {
		
		clearTimeout( UABBImageCarouselResize_<?php echo $id; ?> );
		UABBImageCarouselResize_<?php echo $id; ?> = setTimeout( UABBImageCarousel_<?php echo $id; ?>._adaptiveImageHeight, 500);
	});

	<?php if($settings->click_action == 'lightbox') : ?>
	$('.fl-node-<?php echo $id; ?> .uabb-image-carousel').magnificPopup({
		delegate: '.uabb-image-carousel-content a',
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
	<?php endif; ?>
});