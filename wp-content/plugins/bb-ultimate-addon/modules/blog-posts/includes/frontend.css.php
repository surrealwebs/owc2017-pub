<?php
$settings->title_color = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
$settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );
$settings->content_background_color = UABB_Helper::uabb_colorpicker( $settings, 'content_background_color', true );

$settings->arrow_color = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color' );
$settings->arrow_background_color = UABB_Helper::uabb_colorpicker( $settings, 'arrow_background_color', true);
$settings->arrow_color_border = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color_border' );

$settings->date_color = UABB_Helper::uabb_colorpicker( $settings, 'date_color' );
$settings->date_background_color = UABB_Helper::uabb_colorpicker( $settings, 'date_background_color', true );
$settings->meta_color = UABB_Helper::uabb_colorpicker( $settings, 'meta_color' );
$settings->meta_text_color = UABB_Helper::uabb_colorpicker( $settings, 'meta_text_color' );
$settings->meta_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'meta_hover_color' );

$settings->link_color = UABB_Helper::uabb_colorpicker( $settings, 'link_color' );
$settings->link_more_arrow_color = UABB_Helper::uabb_colorpicker( $settings, 'link_more_arrow_color' );

$settings->masonary_text_color = UABB_Helper::uabb_colorpicker( $settings, 'masonary_text_color' );
$settings->masonary_background_color = UABB_Helper::uabb_colorpicker( $settings, 'masonary_background_color', true );
$settings->masonary_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'masonary_text_hover_color' );
$settings->masonary_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'masonary_background_hover_color', true );
$settings->masonary_background_active_color = UABB_Helper::uabb_colorpicker( $settings, 'masonary_background_active_color', true );
$settings->masonary_active_color = UABB_Helper::uabb_colorpicker( $settings, 'masonary_active_color' );

$settings->pagination_background_color = UABB_Helper::uabb_colorpicker( $settings, 'pagination_background_color', true );
$settings->pagination_color = UABB_Helper::uabb_colorpicker( $settings, 'pagination_color' );
$settings->pagination_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'pagination_hover_color' );
$settings->pagination_active_color = UABB_Helper::uabb_colorpicker( $settings, 'pagination_active_color' );
$settings->pagination_hover_background_color = UABB_Helper::uabb_colorpicker( $settings, 'pagination_hover_background_color', true );
$settings->pagination_active_background_color = UABB_Helper::uabb_colorpicker( $settings, 'pagination_active_background_color', true );
$settings->pagination_active_color_border = UABB_Helper::uabb_colorpicker( $settings, 'pagination_active_color_border' );
$settings->pagination_color_border = UABB_Helper::uabb_colorpicker( $settings, 'pagination_color_border' );

$settings->masonary_border_size = ( $settings->masonary_border_size != '' ) ? $settings->masonary_border_size : '2';
$settings->pagination_border_size = ( $settings->pagination_border_size != '' ) ? $settings->pagination_border_size : '2';
$settings->masonary_color_border = UABB_Helper::uabb_colorpicker( $settings, 'masonary_color_border' );
$settings->masonary_active_color_border = UABB_Helper::uabb_colorpicker( $settings, 'masonary_active_color_border' );

$settings->overlay_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );

$settings->title_margin_top = ( isset( $settings->title_margin_top ) ) ? $settings->title_margin_top : '';
$settings->title_margin_bottom = ( isset( $settings->title_margin_bottom ) ) ? $settings->title_margin_bottom : '';

$settings->element_space = ( isset( $settings->element_space ) && $settings->element_space != '' ) ? $settings->element_space : '15';


$settings->show_meta = ( isset( $settings->show_meta ) ) ? $settings->show_meta : 'yes';

if( $settings->is_carousel == 'grid' ) {
	if( $settings->equal_height_box == 'yes' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-ms-flex-wrap: wrap;
	    flex-wrap: wrap;
}

.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
}
<?php
	}
}

if( $settings->blog_image_position == 'top' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-thumbnail img {
	display: inline-block;
}
.fl-node-<?php echo $id; ?> .uabb-post-wrapper .uabb-post-thumbnail {
	text-align: <?php echo $settings->overall_alignment; ?>;
}
<?php
}

//if( $settings->is_carousel != 'masonary' && $settings->is_carousel != 'feed' ) {
	if( $settings->equal_height_box == 'yes' && $settings->blog_image_position == 'background' ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-thumbnail-position-background {
		height: 100%;
	}
	<?php
	}

	if( $settings->blog_image_position == 'background' ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-post-thumbnail:before {
		content: '';
	    <?php echo ( $settings->overlay_color != '' ) ? 'background: ' . $settings->overlay_color . ';' : ''; ?>
	    position: absolute;
	    left: 0;
	    top: 0;
	    width: 100%;
	    height: 100%;
	    z-index: 1;
	}
	<?php
	}
//}

if( $settings->cta_type == 'button' ) {

	FLBuilder::render_module_css('uabb-button', $id , array(
		/* General Section */
        'text'              => $settings->btn_text,
        
        /* Link Section */
        /*'link'              => $settings->btn_link,
        'link_target'       => $settings->btn_link_target,*/
        
        /* Style Section */
        'style'             => $settings->btn_style,
        'border_size'       => $settings->btn_border_size,
        'transparent_button_options' => $settings->btn_transparent_button_options,
        'threed_button_options'      => $settings->btn_threed_button_options,
        'flat_button_options'        => $settings->btn_flat_button_options,

        /* Colors */
        'bg_color'          => $settings->btn_bg_color,
        'bg_color_opc'          => $settings->btn_bg_color_opc,
        'bg_hover_color'    => $settings->btn_bg_hover_color,
        'bg_hover_color_opc'    => $settings->btn_bg_hover_color_opc,
        'text_color'        => $settings->btn_text_color,
        'text_hover_color'  => $settings->btn_text_hover_color,
        'hover_attribute'	=> $settings->hover_attribute,

        /* Icon */
        'icon'              => $settings->btn_icon,
        'icon_position'     => $settings->btn_icon_position,
        
        /* Structure */
        'width'              => $settings->btn_width,
        'custom_width'       => $settings->btn_custom_width,
        'custom_height'      => $settings->btn_custom_height,
        'padding_top_bottom' => $settings->btn_padding_top_bottom,
        'padding_left_right' => $settings->btn_padding_left_right,
        'border_radius'      => $settings->btn_border_radius,
        'align'              => $settings->overall_alignment,
        'mob_align'          => '',

        /* Typography */
        'font_size'         => $settings->btn_font_size,
        'line_height'       => $settings->btn_line_height,
        'font_family'       => $settings->btn_font_family,
	));

}

if( $settings->blog_image_position == 'left' || $settings->blog_image_position == 'right' ) {
	if( $settings->featured_image_size == 'custom' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-post-content {
	width: calc( 100% - <?php echo $settings->featured_image_size_width; ?>px );
}
.fl-node-<?php echo $id; ?> .uabb-post-thumbnail {
	width: <?php echo $settings->featured_image_size_width; ?>px;
}
<?php
	}
}

if( $settings->blog_image_position != 'top' && $settings->blog_image_position != 'background' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-blog-post-inner-wrap {
	<?php echo $settings->overall_padding; ?>
}
<?php
} else {
	if( $settings->blog_image_position == 'top' ) {
		if( substr( $settings->layout_sort_order, 0, 3 ) == 'img' || substr( $settings->layout_sort_order, -3 ) == 'img' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-blog-post-inner-wrap {
	<?php echo $settings->overall_padding; ?>
}
<?php
		}
	}
}

if( $settings->is_carousel == 'feed' ) {
	if( $settings->featured_image_size != 'custom' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-thumbnail img {
    width: 100%;
}
<?php
	} else {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-thumbnail img {
    <?php echo ( $settings->overall_alignment == 'left' ) ? 'margin: 0;margin-right: auto;' : ( ( $settings->overall_alignment == 'right' ) ? 'margin: 0;margin-left: auto;' : '' ); ?>
}
<?php
	}
}

if( $settings->is_carousel == 'grid' || $settings->is_carousel == 'masonary' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts-grid,
.fl-node-<?php echo $id; ?> .uabb-blog-posts-masonary {
	<?php $grid_margin = ( $settings->element_space != '' ) ? ( $settings->element_space / 2 ) : 7.5; ?>
	margin: 0 -<?php echo $grid_margin; ?>px;
}
<?php
}

if( $settings->is_carousel == 'masonary' ) {
?>
.fl-node-<?php echo $id; ?> ul.uabb-masonary-filters > li {
    <?php
    if( $settings->masonary_button_style == 'square' ) {
    	echo ( $settings->masonary_background_color != '' ) ? 'background: ' . $settings->masonary_background_color . ';' : 'background: #EFEFEF;';
    } else {
    	echo ( uabb_theme_base_color( $settings->masonary_color_border ) != '' ) ? 'border: ' . $settings->masonary_border_size . 'px ' . $settings->masonary_border_style . ' ' . uabb_theme_base_color( $settings->masonary_color_border ) . ';' : '';
    }
    

    echo ( uabb_theme_text_color( $settings->masonary_text_color ) != '' ) ? 'color: ' . uabb_theme_text_color( $settings->masonary_text_color ) . ';' : '';
    echo ( $settings->masonary_overall_alignment == 'left' ) ? 'margin-right: 10px;' : ( ( $settings->masonary_overall_alignment == 'right' ) ? 'margin-left: 10px;' : 'margin-right: 5px; margin-left: 5px;' );
    
    echo $settings->masonary_padding;
    ?>
    border-radius: <?php echo ( $settings->masonary_border_radius != '' ) ? $settings->masonary_border_radius : '2'; ?>px;
}

.fl-node-<?php echo $id; ?> ul.uabb-masonary-filters > li:hover {
    <?php
    if( $settings->masonary_button_style == 'square' ) {
    	echo ( $settings->masonary_background_hover_color != '' ) ? 'background: ' . $settings->masonary_background_hover_color . ';' : '';

	    echo ( $settings->masonary_text_hover_color != '' ) ? 'color: ' . $settings->masonary_text_hover_color . ';' : '';    
    
    }
    ?>
}

.fl-node-<?php echo $id; ?> ul.uabb-masonary-filters > li.uabb-masonary-current {
    <?php
    echo ( uabb_theme_text_color( $settings->masonary_active_color ) != '' ) ? 'color: ' . uabb_theme_text_color( $settings->masonary_active_color ) . ';' : '';
    if( $settings->masonary_button_style == 'square' ) {
    	echo ( uabb_theme_base_color( $settings->masonary_background_active_color ) != '' ) ? 'background: ' . uabb_theme_base_color( $settings->masonary_background_active_color ) . ';' : '';
	    
    } else {
    	echo ( uabb_theme_base_color( $settings->masonary_active_color_border ) != '' ) ? 'border: ' . $settings->masonary_border_size . 'px ' . $settings->masonary_border_style . ' ' . uabb_theme_base_color( $settings->masonary_active_color_border ) . '; !important' : '';
    } 
    ?>
}

.fl-node-<?php echo $id; ?> ul.uabb-masonary-filters {
	text-align: <?php echo $settings->masonary_overall_alignment; ?>;
	margin-bottom: <?php echo ( $settings->masonary_bottom_spacing != '' ) ? $settings->masonary_bottom_spacing : '40'; ?>px;
}
<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
	<?php
	if( $settings->is_carousel == 'feed' ) {
		echo ( $settings->element_space != '' ) ? 'margin-bottom: ' . ( $settings->element_space ) . 'px;' : 'margin-bottom: 15px;';
	} else {
		if( $settings->post_per_grid_desktop == 1 ) {
			echo 'padding: 0;';
		} else {
			echo ( $settings->element_space != '' ) ? 'padding-left: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-left: 7.5px;';
			echo ( $settings->element_space != '' ) ? 'padding-right: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-right: 7.5px;';
		}
	}

	if( $settings->is_carousel == 'grid' || $settings->is_carousel == 'masonary' ) {
	?>
	margin-bottom: <?php echo ( $settings->below_element_space != '' ) ? $settings->below_element_space : '30'; ?>px;
	<?php
	}
	?>
}

.fl-node-<?php echo $id; ?> .uabb-post-wrapper .uabb-blog-post-content {
	<?php echo $settings->content_padding; ?>
}

.fl-node-<?php echo $id; ?> .uabb-posted-on {
	<?php
	$color = uabb_theme_base_color( $settings->date_background_color );
	$date_background_color = ( $color != '' ) ? $color : '#EFEFEF';
	echo 'color: ' . $settings->date_color . ';' ;
	echo ( $settings->date_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->date_font_size['desktop'] . 'px;' : '';
	
	if( $settings->date_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->date_font_family );
	}
	?>
	background: <?php echo $date_background_color; ?>;
	left: 0;
	
}

<?php
if( $settings->meta_color != '' || $settings->meta_hover_color != '' ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta a,
	.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta a:hover,
	.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta a:focus,
	.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta a:active {
		color: <?php echo $settings->meta_color; ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta a:hover {
		color: <?php echo $settings->meta_hover_color; ?>;
	}
<?php
}

if( $settings->show_meta == 'yes' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta {
	<?php
	echo ( $settings->meta_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->meta_line_height['desktop'] . 'px;' : '';
	echo ( $settings->meta_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->meta_font_size['desktop'] . 'px;' : '';

	echo ( $settings->meta_text_color != '' ) ? 'color: ' . $settings->meta_text_color . ';' : '';
	
	if( $settings->meta_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->meta_font_family );
	}
	?>
}
<?php
}

?>
.fl-node-<?php echo $id; ?> .uabb-blog-posts-shadow {
	<?php if( $settings->show_box_shadow == 'yes' ) { ?>
	box-shadow: 0 4px 1px rgba(197, 197, 197, 0.2);
	<?php } ?>
	<?php echo ( $settings->content_background_color != '' ) ? 'background: ' . $settings->content_background_color : ''; ?>;
	transition: all 0.3s linear;
	width: 100%;
}

<?php

if( $settings->is_carousel == 'grid' ) {
?>
@media all and ( min-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
    .fl-node-<?php echo $id; ?> .uabb-post-wrapper:nth-child(<?php echo $settings->post_per_grid; ?>n+1){
        clear: left;
    }
    .fl-node-<?php echo $id; ?> .uabb-post-wrapper:nth-child(<?php echo $settings->post_per_grid; ?>n+0) {
        clear: right;
    }
    .fl-node-<?php echo $id; ?> .uabb-post-wrapper:nth-child(<?php echo $settings->post_per_grid; ?>n+1) .uabb-posted-on {
        left: 0;
    }
}

<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text span,
.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text:visited * {
	color: <?php echo ( uabb_theme_base_color( $settings->link_more_arrow_color ) == '' ) ? '#f7f7f7' : uabb_theme_base_color( $settings->link_more_arrow_color ); ?>;
}

<?php
if( $settings->is_carousel == 'carousel' ) {
?>
.fl-node-<?php echo $id; ?> .slick-prev i,
.fl-node-<?php echo $id; ?> .slick-next i,
.fl-node-<?php echo $id; ?> .slick-prev i:hover,
.fl-node-<?php echo $id; ?> .slick-next i:hover,
.fl-node-<?php echo $id; ?> .slick-prev i:focus,
.fl-node-<?php echo $id; ?> .slick-next i:focus {
	outline: none;
	<?php
	$color = uabb_theme_base_color( $settings->arrow_color );
	$arrow_color = ( $color != '' ) ? $color : '#fff';
	?>
	color: <?php echo $arrow_color; ?>;
	<?php
	switch ( $settings->arrow_style ) {
		case 'square':
	?>
	background: <?php echo ( $settings->arrow_background_color != '' ) ? $settings->arrow_background_color : '#efefef'; ?>;
	<?php
			break;
		
		case 'circle':
	?>
	border-radius: 50%;
	background: <?php echo ( $settings->arrow_background_color != '' ) ? $settings->arrow_background_color : '#efefef'; ?>;
	<?php
			break;

		case 'square-border':
	?>
	border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border ?>;
	<?php
			break;

		case 'circle-border':
	?>
	border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border ?>;
	border-radius: 50%;
	<?php
			break;
	}
	?>
}

	<?php
	if( $settings->arrow_position != 'outside' ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev,
	.fl-node-<?php echo $id; ?> [dir='rtl'] .uabb-blog-posts .slick-next
	{
	    left: -15px;
	}
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next,
	.fl-node-<?php echo $id; ?> [dir='rtl'] .uabb-blog-posts .slick-prev
	{
	    right: -15px;
	}
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev i,
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next i,
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev i:hover,
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev i:focus,
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next i:focus,
	.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next i:hover {
	    width: 30px;
	    height: 30px;
	    line-height: 30px;
	}
<?php
	}
	?>

.fl-node-<?php echo $id; ?> .fl-node-content .slick-list {
	<?php
	if( $settings->post_per_grid_desktop == 1 ) {
	?>
	margin: 0;
	<?php
	} else {
	?>
	margin: 0 -<?php echo ( $settings->element_space != '' ) ? ( $settings->element_space / 2 ) : '7.5'; ?>px;
	<?php
	}
	?>
}

<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-blog-post-content {
	text-align: <?php echo $settings->overall_alignment; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text,
.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a,
.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a:visited,
.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a:hover {
	<?php
	echo 'color: ' . uabb_theme_text_color( $settings->link_color ) . ';' ;
	echo ( $settings->link_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->link_line_height['desktop'] . 'px;' : '';
	echo ( $settings->link_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->link_font_size['desktop'] . 'px;' : '';
	
	if( $settings->link_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->link_font_family );
	}
	?>
}

.fl-node-<?php echo $id; ?> .uabb-text-editor {
	<?php
	echo 'color: ' . uabb_theme_text_color( $settings->desc_color ) . ';' ;
	echo ( $settings->desc_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->desc_line_height['desktop'] . 'px;' : '';
	echo ( $settings->desc_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->desc_font_size['desktop'] . 'px;' : '';
	
	if( $settings->desc_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->desc_font_family );
	}
	
	?>
}

.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading,
.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a,
.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:hover,
.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:focus,
.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:visited {
	<?php
	echo ( $settings->title_color != '' ) ? 'color: ' . $settings->title_color . ';' : '';
	echo ( $settings->title_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->title_line_height['desktop'] . 'px;' : '';
	echo ( $settings->title_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->title_font_size['desktop'] . 'px;' : '';

	if( $settings->title_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->title_font_family );
	}
	echo ( $settings->title_margin_top != '' ) ? 'margin-top: ' . $settings->title_margin_top . 'px;' : '';
	echo ( $settings->title_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->title_margin_bottom . 'px;' : '';
	?>
}

<?php
$show_pagination = ( isset( $settings->show_pagination ) ) ? $settings->show_pagination : 'no';
$pagination = ( isset( $settings->pagination ) ) ? $settings->pagination : 'numbers';

if( $settings->is_carousel != 'carousel' && $show_pagination == 'yes' && $pagination == 'numbers' ) {
?>

	.fl-node-<?php echo $id; ?> .uabb-blogs-pagination ul  {
		text-align: <?php echo $settings->pagination_alignment; ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-blogs-pagination li:hover a.page-numbers {
		<?php
		if( $settings->pagination_style == 'square' ) {
			echo ( $settings->pagination_hover_background_color != '' ) ? 'background: ' . $settings->pagination_hover_background_color . ';' : '';
			echo ( $settings->pagination_hover_color != '' ) ? 'color: ' . $settings->pagination_hover_color . ';' : '';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-blogs-pagination li a.page-numbers,
	.fl-node-<?php echo $id; ?> .uabb-blogs-pagination li span.page-numbers {
		outline: none;
		color: <?php echo uabb_theme_text_color( $settings->pagination_color ); ?>;
		<?php
		switch ( $settings->pagination_style ) {
			case 'square':
		?>
		background: <?php echo ( $settings->pagination_background_color != '' ) ? $settings->pagination_background_color : '#efefef'; ?>;
		<?php
				break;

			case 'square-border':
		?>
		border: <?php echo $settings->pagination_border_size; ?>px <?php echo $settings->pagination_border_style; ?> <?php echo $settings->pagination_color_border ?>;
		<?php
				break;
		}
		?>
	}
	<?php
	//if( $settings->pagination_active_background_color != '' || $settings->pagination_active_color != '' ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-blogs-pagination li span.page-numbers.current {
		color: <?php echo uabb_theme_text_color( $settings->pagination_active_color ); ?>;
		<?php
		switch ( $settings->pagination_style ) {
			case 'square':
		?>
		background: <?php echo uabb_theme_base_color( $settings->pagination_active_background_color ); ?>;
		<?php
				break;

			case 'square-border':
				$border_color = uabb_theme_base_color ( $settings->pagination_active_color_border );
		?>
		color: <?php echo uabb_theme_base_color( $settings->pagination_active_color ); ?>;
		border: <?php echo $settings->pagination_border_size; ?>px <?php echo $settings->pagination_border_style; ?> <?php echo $border_color ?>;
		<?php
				break;
		}
		?>
	}

	<?php
	//}
	?>

<?php
}
?>

<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    	<?php
     	if( $settings->is_carousel == 'masonary' || $settings->is_carousel == 'grid' ) {
     	?>
	    	.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-8,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-7,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-6,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-5,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-4,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-3,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-2,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-1 { 
				width: <?php echo ( 100 / $settings->post_per_grid_medium ); ?>%;
			}

    	<?php
    	}
    	if( $settings->link_line_height['medium'] != '' || $settings->link_font_size['medium'] != '' ) {
    	?>

    	.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text,
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a,
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a:visited,
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a:hover {
			<?php
			echo ( $settings->link_line_height['medium'] != '' ) ? 'line-height: ' . $settings->link_line_height['medium'] . 'px;' : '';
			echo ( $settings->link_font_size['medium'] != '' ) ? 'font-size: ' . $settings->link_font_size['medium'] . 'px;' : '';
			?>
		}
		<?php
		}

		if( $settings->show_meta == 'yes' ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta {
			<?php
			echo ( $settings->meta_line_height['medium'] != '' ) ? 'line-height: ' . $settings->meta_line_height['medium'] . 'px;' : '';
			echo ( $settings->meta_font_size['medium'] != '' ) ? 'font-size: ' . $settings->meta_font_size['medium'] . 'px;' : '';
			
			?>
		}
		<?php
		}

		if( $settings->show_date_box == 'yes' ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-posted-on {
			<?php
			echo ( $settings->date_font_size['medium'] != '' ) ? 'font-size: ' . $settings->date_font_size['medium'] . 'px;' : '';
			?>
		}
		<?php
		}


		if( $settings->desc_line_height['medium'] != '' || $settings->desc_font_size['medium'] != '' ) {
		?>

		.fl-node-<?php echo $id; ?> .uabb-text-editor {
			<?php
			echo ( $settings->desc_line_height['medium'] != '' ) ? 'line-height: ' . $settings->desc_line_height['medium'] . 'px;' : '';
			echo ( $settings->desc_font_size['medium'] != '' ) ? 'font-size: ' . $settings->desc_font_size['medium'] . 'px;' : '';
			?>
		}

		<?php
		}

		if( $settings->title_line_height['medium'] != '' || $settings->title_font_size['medium'] != '' ) {
		?>

		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:hover,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:focus,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:visited {
			<?php
			echo ( $settings->title_line_height['medium'] != '' ) ? 'line-height: ' . $settings->title_line_height['medium'] . 'px;' : '';
			echo ( $settings->title_font_size['medium'] != '' ) ? 'font-size: ' . $settings->title_font_size['medium'] . 'px;' : '';
			?>
		}

		<?php
		}

		if( $settings->is_carousel == 'carousel' ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev,
		.fl-node-<?php echo $id; ?> [dir='rtl'] .uabb-blog-posts .slick-next
		{
		    left: -15px;
		}
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next,
		.fl-node-<?php echo $id; ?> [dir='rtl'] .uabb-blog-posts .slick-prev
		{
		    right: -15px;
		}
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev i,
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next i,
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev i:hover,
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-prev i:focus,
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next i:focus,
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .slick-next i:hover {
		    width: 25px;
		    height: 25px;
		    line-height: 25px;
		}
		<?php
		}

		if( $settings->post_per_grid_medium == 1 ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
			padding: 0;
		}
		.fl-node-<?php echo $id; ?> .fl-node-content .slick-list {
			margin: 0;
		}
		<?php
		} else {
		?>
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
			<?php
			echo ( $settings->element_space != '' ) ? 'padding-left: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-left: 7.5px;';
			echo ( $settings->element_space != '' ) ? 'padding-right: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-right: 7.5px;';
			?>
		}
		.fl-node-<?php echo $id; ?> .fl-node-content .slick-list {
			margin: 0 -<?php echo ( $settings->element_space != '' ) ? ( $settings->element_space / 2 ) : '7.5'; ?>px;
		}
		<?php
		}
		?>

    }
 
     @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

     	<?php
     	if( $settings->is_carousel == 'grid' || $settings->is_carousel == 'masonary' ) {
     		if( $settings->post_per_grid_small == 1 ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-blog-posts-grid,
		.fl-node-<?php echo $id; ?> .uabb-blog-posts-masonary {
			margin: 0;
		}
		.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
			padding-right: 0;
			padding-left: 0;
		}
		<?php
			} else {
			?>
			.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
				<?php
				echo ( $settings->element_space != '' ) ? 'padding-left: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-left: 7.5px;';
				echo ( $settings->element_space != '' ) ? 'padding-right: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-right: 7.5px;';
				?>
			}
			.fl-node-<?php echo $id; ?> .fl-node-content .slick-list {
				margin: 0 -<?php echo ( $settings->element_space != '' ) ? ( $settings->element_space / 2 ) : '7.5'; ?>px;
			}
			<?php
			}
		}

     	if( $settings->is_carousel == 'masonary' || $settings->is_carousel == 'grid' ) {
     	?>
     		.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-8,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-7,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-6,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-5,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-4,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-3,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-2,
			.fl-node-<?php echo $id; ?> .uabb-blog-posts-col-1 { 
				width: <?php echo ( 100 / $settings->post_per_grid_small ); ?>%;
			}
     	<?php
     	}
     	
    	if( $settings->link_line_height['small'] != '' || $settings->link_font_size['small'] != '' ) {
    	?>
     	.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text,
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a,
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a:visited,
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-read-more-text a:hover {
			<?php
			echo ( $settings->link_line_height['small'] != '' ) ? 'line-height: ' . $settings->link_line_height['small'] . 'px;' : '';
			echo ( $settings->link_font_size['small'] != '' ) ? 'font-size: ' . $settings->link_font_size['small'] . 'px;' : '';
			?>
		}
		<?php
		}

		if( $settings->desc_line_height['small'] != '' || $settings->desc_font_size['small'] != '' ) {
		?>

		.fl-node-<?php echo $id; ?> .uabb-text-editor {
			<?php
			echo ( $settings->desc_line_height['small'] != '' ) ? 'line-height: ' . $settings->desc_line_height['small'] . 'px;' : '';
			echo ( $settings->desc_font_size['small'] != '' ) ? 'font-size: ' . $settings->desc_font_size['small'] . 'px;' : '';
			?>
		}

		<?php
		}

		if( $settings->show_meta == 'yes' ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-blog-post-content .uabb-post-meta {
			<?php
			echo ( $settings->meta_line_height['small'] != '' ) ? 'line-height: ' . $settings->meta_line_height['small'] . 'px;' : '';
			echo ( $settings->meta_font_size['small'] != '' ) ? 'font-size: ' . $settings->meta_font_size['small'] . 'px;' : '';
			
			?>
		}
		<?php
		}

		if( $settings->show_date_box == 'yes' ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-posted-on {
			<?php
			echo ( $settings->date_font_size['small'] != '' ) ? 'font-size: ' . $settings->date_font_size['small'] . 'px;' : '';
			?>
		}
		<?php
		}

		if( $settings->title_line_height['small'] != '' || $settings->title_font_size['small'] != '' ) {
		?>

		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:hover,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:focus,
		.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-post-heading a:visited {
			<?php
			echo ( $settings->title_line_height['small'] != '' ) ? 'line-height: ' . $settings->title_line_height['small'] . 'px;' : '';
			echo ( $settings->title_font_size['small'] != '' ) ? 'font-size: ' . $settings->title_font_size['small'] . 'px;' : '';
			?>
		}
		<?php
		}

		if( $settings->is_carousel == 'carousel' ) {
			if( $settings->post_per_grid_small == 1 ) {
			?>
			/*.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
				padding: 0;
			}*/
			.fl-node-<?php echo $id; ?> .fl-node-content .slick-list {
				margin: 0;
			}
			<?php
			} else {
			?>
			.fl-node-<?php echo $id; ?> .fl-node-content .slick-list {
				margin: 0 -<?php echo ( $settings->element_space != '' ) ? ( $settings->element_space / 2 ) : '7.5'; ?>px;
			}
			.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
				<?php
				echo ( $settings->element_space != '' ) ? 'padding-left: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-left: 7.5px;';
				echo ( $settings->element_space != '' ) ? 'padding-right: ' . ( $settings->element_space / 2 ) . 'px;' : 'padding-right: 7.5px;';
				?>
			}
			<?php
			}
		}
		?>
    }

    @media ( max-width: <?php echo ( $global_settings->responsive_breakpoint - 1 ); ?>px ) {
    	<?php
    	if( $settings->is_carousel == 'carousel' ) {
			if( $settings->post_per_grid_small == 1 ) {
			?>
			.fl-node-<?php echo $id; ?> .uabb-blog-posts .uabb-post-wrapper {
				padding: 0;
			}
		<?php
			}
		}
    	?>
    }
<?php
}
?>