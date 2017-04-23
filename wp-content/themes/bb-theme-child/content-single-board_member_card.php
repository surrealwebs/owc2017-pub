<?php

$show_thumbs = FLTheme::get_setting('fl-posts-show-thumbs');
$meta = get_post_meta($post->ID);
//dump($meta);
?>
<div class="fl-post-grid-post board_member type-board_member" id="fl-post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">

	<?php if(has_post_thumbnail() && !empty($show_thumbs)) : ?>
		<?php if($show_thumbs == 'above-title') : ?>
		<div class="fl-post-thumb">
			<?php the_post_thumbnail('large', array('itemprop' => 'image')); ?>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<div class="fl-post-grid-text">
		<h2 class="fl-post-grid-title" style="visibility: visible;" itemprop="headline">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php edit_post_link( _x( 'Edit', 'Edit post link text.', 'fl-automator' ) ); ?>
		</h2>
		<div class="fl-post-grid-content" style="visibility: visible;">
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

			if (!empty($meta['city'][0]) || !empty($meta['state'][0]) || !empty($meta['city'][0])) {
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
	            echo '<br /><a href="mailto:' . esc_html($meta['email'][0]) . '">' . esc_html($meta['email'][0]) . '</a>';
	        }
	        ?>
		</div>

	</div><!-- .fl-post-header -->

</div>
<!-- .fl-post -->
