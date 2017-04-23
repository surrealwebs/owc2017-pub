<?php

$show_thumbs = FLTheme::get_setting('fl-posts-show-thumbs');
$meta = get_post_meta($post->ID);
//dump($meta);
?>
<article <?php post_class( 'fl-post' ); ?> id="fl-post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">

	<?php if(has_post_thumbnail() && !empty($show_thumbs)) : ?>
		<?php if($show_thumbs == 'above-title') : ?>
		<div class="fl-post-thumb">
			<?php the_post_thumbnail('large', array('itemprop' => 'image')); ?>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<header class="fl-post-header">
		<h1 class="fl-post-title" itemprop="headline">
			<?php the_title(); ?>
			<?php edit_post_link( _x( 'Edit', 'Edit post link text.', 'fl-automator' ) ); ?>
		</h1>
		<?php
        // Insert Event Data
        if ( isset($meta['position'][0]) && !empty($meta['position'][0]) ) {
            echo "<strong>" . esc_html($meta['position'][0]) . "</strong>";
        }
        if ( isset($meta['street_address'][0]) && !empty($meta['street_address'][0]) ) {
            echo "<br />" . esc_html($meta['street_address'][0]);
        }
		if ( isset($meta['address_2'][0]) && !empty($meta['address_2'][0]) ) {
            echo "<br />" . esc_html($meta['address_2'][0]);
        }

		if (isset($meta['city'][0]) || isset($meta['state'][0]) || isset($meta['city'][0])) {
			echo "<br />";
		}

		if ( isset($meta['city'][0]) && !empty($meta['city'][0]) ) {
            echo esc_html($meta['city'][0]) . ', ';
        }
		if ( isset($meta['state'][0]) && !empty($meta['state'][0]) ) {
			echo esc_html($meta['state'][0]) . ' ';
		}
		if ( isset($meta['zip'][0]) && !empty($meta['zip'][0]) ) {
            echo esc_html($meta['zip'][0]);
        }
		if ( isset($meta['phone'][0]) && !empty($meta['phone'][0]) ) {
            echo "<br />" . esc_html($meta['phone'][0]);
        }
		if ( isset($meta['email'][0]) && !empty($meta['email'][0]) ) {
            echo "<br />" . esc_html($meta['email'][0]);
        }
        ?>
	</header><!-- .fl-post-header -->

	<?php if(has_post_thumbnail() && !empty($show_thumbs)) : ?>
		<?php if($show_thumbs == 'above') : ?>
		<div class="fl-post-thumb">
			<?php the_post_thumbnail('large'); ?>
		</div>
		<?php endif; ?>

		<?php if($show_thumbs == 'beside') : ?>
		<div class="row">
			<div class="col-md-3 col-sm-3">
				<div class="fl-post-thumb">
					<?php the_post_thumbnail('thumbnail'); ?>
				</div>
			</div>
			<div class="col-md-9 col-sm-9">
		<?php endif; ?>
	<?php endif; ?>

	<div class="fl-post-content clearfix" itemprop="text">
		<?php

		the_content();

		wp_link_pages( array(
			'before'         => '<div class="fl-post-page-nav">' . _x( 'Pages:', 'Text before page links on paginated post.', 'fl-automator' ),
			'after'          => '</div>',
			'next_or_number' => 'number'
		) );

		?>
	</div><!-- .fl-post-content -->

	<?php if(has_post_thumbnail() && $show_thumbs == 'beside') : ?>
		</div>
	</div>
	<?php endif; ?>

	<?php //FLTheme::post_bottom_meta(); ?>
	<?php FLTheme::post_navigation(); ?>
	<?php comments_template(); ?>

</article>
<!-- .fl-post -->
