<?php
$uabb_args = $module->get_uabb_args();
$args = $module->render_args();
$uabb_args = apply_filters( 'uabb_blog_posts_query_args', $args, $settings );

$module->set_uabb_args( $uabb_args );

$show_pagination = ( isset( $settings->show_pagination ) ) ? $settings->show_pagination : 'no';

$pagination = ( isset( $settings->pagination ) ) ? $settings->pagination : 'numbers';

if( isset( $settings->offset ) ) {
	$settings->offset = ( ! is_int( ( int )$settings->offset ) ) ? 0 : ( ( $settings->offset != '' ) ? $settings->offset : 0 );
}
else {
	$settings->offset = 0;
}
$settings->order_by = $args['orderby'];
$settings->posts_per_page = $args['posts_per_page'];

if( isset( $settings->data_source ) && $settings->data_source == 'main_query' && true == FL_BUILDER_LITE ) {
	global $wp_query;
	$the_query = clone $wp_query;
	$the_query->rewind_posts();
	$the_query->reset_postdata();
}
else {

	$the_query = FLBuilderLoop::query( $settings );
	$module->set_uabb_args( array() );

	/*
	 * Refine blog post WP Query
	 */

	if( $settings->is_carousel != 'carousel' && $show_pagination == 'yes' && $pagination == 'numbers' ) {

		$settings->total_posts_switch = ( isset( $settings->total_posts_switch ) ? $settings->total_posts_switch : 'all' );

		$settings->total_posts = ( isset( $settings->total_posts ) ? ( ( $settings->total_posts != '' ) ? $settings->total_posts : '10' ) : '10' );

		$total_posts = ( $settings->total_posts_switch == 'all' ) ? '-1' : $settings->total_posts;

		if ( $total_posts > 0 ) {
			$the_query->posts = array_slice( $the_query->posts, 0, $total_posts );
		} else if( $total_posts == 0 ) {
			$the_query->posts = array();
		}

		if( $args['posts_per_page'] == 0 ) {
			$the_query->posts = array();
		}
	}
}


/*
 * Define columns as per Grids
 */

$col = ( $settings->is_carousel != 'carousel' ) ? ( ( $settings->is_carousel == 'feed' ) ? 1 : $settings->post_per_grid ) : $settings->post_per_grid_desktop;

$col = ( $settings->is_carousel == 'carousel' ) ? $settings->post_per_grid_desktop : ( ( $settings->is_carousel == 'feed' ) ? 1 : $settings->post_per_grid );


/*
 * Render Mansonry Filter Buttons
 */

if( $settings->is_carousel == 'masonary' ) {
	$module->render_masonary_filters();
}

?>
<div class="uabb-module-content uabb-blog-posts <?php echo ( $settings->is_carousel == 'carousel' ) ? 'uabb-blog-posts-carousel' : ( ( $settings->is_carousel == 'grid' ) ? 'uabb-blog-posts-grid' : '' ); ?> uabb-post-grid-<?php echo $col; ?> <?php echo ( $settings->is_carousel == 'masonary' ) ? ' uabb-blog-posts-masonary ' : ''; ?>">
	<?php
	$class = '';

	for ( $i=0; $i < count( $the_query->posts ); $i++ ) {
		setup_postdata( $the_query->posts[$i] );
		$the_query->the_post();

		if( $settings->is_carousel == 'masonary' ) {
			$post_type = ( isset( $settings->post_type ) ) ? $settings->post_type : 'post';
	        $object_taxonomies = get_object_taxonomies( $post_type );
	        if( !empty( $object_taxonomies ) ) {
	            $cat = 'masonary_filter_' . $post_type;
	            if( isset( $settings->$cat ) ) {
	            	if( $settings->$cat != -1 ) {
		            	$category_detail = wp_get_post_terms( $the_query->posts[$i]->ID, $settings->$cat );
			            $class = '';
			            if( count( $category_detail ) > 0 ) {
			                foreach( $category_detail as $cat_details ) {
			                    $class .= ' uabb-masonary-cat-' . $cat_details->slug . ' ';
			                }
			            }
		            }
	            }
	        } 
		}

		$top_featured_image_content = $module->render_featured_image( 'top', $the_query->posts[$i], $i );

		$left_featured_image_content = $module->render_featured_image( 'left', $the_query->posts[$i], $i );
		$background_featured_image_content = $module->render_featured_image( 'background', $the_query->posts[$i], $i );
		$right_featured_image_content = $module->render_featured_image( 'right', $the_query->posts[$i], $i );

		$left_hide_class = ( $left_featured_image_content == '' && $right_featured_image_content == '' ) ? 'uabb-empty-img' : '';

		do_action( 'uabb_blog_posts_before_post', $the_query->posts[$i]->ID, $settings );
		?>
	<div class="uabb-blog-posts-col-<?php echo $col; ?> uabb-post-wrapper <?php echo ( $settings->is_carousel == 'masonary' ) ? ' uabb-blog-posts-masonary-item-' . $module->node . ' ' : ''; ?> <?php echo ( $settings->is_carousel == 'masonary' ) ? $class : ''; ?>">
		<div class="uabb-blog-posts-shadow clearfix">

			<div class="uabb-blog-post-inner-wrap <?php echo 'uabb-thumbnail-position-' . $settings->blog_image_position; ?> <?php echo ( $settings->layout_sort_order != 'img,title,meta,content,cta' ) ? 'uabb-blog-reordered' : ''; ?> <?php echo $left_hide_class; ?>">
			<?php
				if( isset($settings->post_layout) && $settings->post_layout == 'custom' && defined( 'FL_THEME_BUILDER_DIR' ) ) {
					include BB_ULTIMATE_ADDON_DIR . 'includes/' . $module->slug . '-frontend.php';
				}
				else {
					echo ( substr( $settings->layout_sort_order, 0, 3 ) == 'img' ) ? $top_featured_image_content : '';
					echo $left_featured_image_content;
					echo $background_featured_image_content;
					$module->render_blog_content( $the_query->posts[$i], $i );
					echo $right_featured_image_content;
					echo ( substr( $settings->layout_sort_order, -3 ) == 'img' ) ? $top_featured_image_content : '';
				}
			?>
			</div>
		</div>
	</div>
	<?php
		do_action( 'uabb_blog_posts_after_post', $the_query->posts[$i]->ID, $settings );
	}

?>
</div>
<?php

/*
 * Render Pagination
 */

if( $settings->is_carousel != 'carousel' && $show_pagination == 'yes' ) {
	$post_type = ( isset( $settings->post_type ) ) ? $settings->post_type : 'post';
	$cat = 'masonary_filter_' . $post_type;
    $do_pagination = ( isset( $settings->$cat ) ) ? ( ( $settings->$cat == -1 ) ? true : false ) : true;

	if( $settings->is_carousel == 'masonary' ) {
		if( $do_pagination == true ) {
		?>
		<div class="uabb-blogs-pagination" <?php if ( 'scroll' == $pagination ) { echo ' style="display:none;"';} ?>>
			<?php $module->render_pagination($the_query); ?>
		</div>
		<?php
		}
	} else {
		?>
		<div class="uabb-blogs-pagination" <?php if ( 'scroll' == $pagination ) { echo ' style="display:none;"';} ?>>
			<?php $module->render_pagination($the_query); ?>
		</div>
		<?php
	}
}

// Render the empty message.
if ( empty( $the_query->posts ) ) :
?>
<div class="fl-post-grid-empty">
	<p><?php echo $settings->no_results_message; ?></p>
	<?php if ( $settings->show_search ) : ?>
	<?php get_search_form(); ?>
	<?php endif; ?>
</div>
<?php
endif;

wp_reset_postdata();

?>
