<?php
/* Colorpicker */
$settings->connector_border_color = UABB_Helper::uabb_colorpicker( $settings, 'connector_border_color' );
$settings->outer_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'outer_bg_color', true );
$settings->thumb_border_color = UABB_Helper::uabb_colorpicker( $settings, 'thumb_border_color' );
$settings->thumb_active_border_color = UABB_Helper::uabb_colorpicker( $settings, 'thumb_active_border_color' );
$settings->info_icon_img_border_color = UABB_Helper::uabb_colorpicker( $settings, 'info_icon_img_border_color' );
$settings->info_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'info_bg_color', true );
$settings->thumb_active_border_color = UABB_Helper::uabb_colorpicker( $settings, 'thumb_active_border_color' );
$settings->info_separator_color = UABB_Helper::uabb_colorpicker( $settings, 'info_separator_color' );

$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );

/* Set default color */
$settings->connector_border_color = uabb_theme_base_color( $settings->connector_border_color );
$settings->info_separator_color = uabb_theme_base_color( $settings->info_separator_color );

$settings->thumb_border_color = ( $settings->thumb_border_color != '' ) ? $settings->thumb_border_color : '#EFEFEF';
$settings->thumb_active_border_color = ( $settings->thumb_active_border_color != '' ) ? $settings->thumb_active_border_color : '#EFEFEF';
$settings->icon_img_size = ( trim($settings->icon_img_size) != "" ) ? $settings->icon_img_size : '60';
$settings->thumbnail_size = ( trim($settings->thumbnail_size) != "" ) ? $settings->thumbnail_size : '80';
$settings->thumb_custom_radius = trim($settings->thumb_custom_radius) != '' ? $settings->thumb_custom_radius : '0';
$settings->info_icon_img_border_width = trim($settings->info_icon_img_border_width) != '' ? $settings->info_icon_img_border_width : '1';
$responsive_breakpoint = trim($settings->breakpoint) != '' ? $settings->breakpoint : $global_settings->medium_breakpoint;

$circle_item_count = 0;
$total_circle = count($settings->add_circle_item);

$angle_init = trim($settings->first_thumb_pos) > 0 ? $settings->first_thumb_pos : 0;
$angle_gap   = 360 / $total_circle;

foreach( $settings->add_circle_item as $item ) {
    
    if( !is_object( $item ) ) { continue; }

    $circle_item_count++;

    $imageicon_array = array(

        /* General Section */
        'image_type' => $item->image_type,
     
        /* Icon Basics */
        'icon' => $item->icon,
        'icon_align' => 'center',
        'icon_style' => $settings->thumb_style,
        'icon_bg_border_radius' => $settings->thumb_custom_radius,
        'icon_size' =>  $settings->thumbnail_size / 2,
     
        /* Image Basics */
        'photo_source' => $item->photo_source,
        'photo' => $item->photo,
        'photo_url' => $item->photo_url,
        'img_align' => 'center',
        'img_size'  => $settings->thumbnail_size,
        'image_style' => $settings->thumb_style,
        'img_bg_border_radius' => $settings->thumb_custom_radius,
        'img_bg_color' => '',
        'img_border_style' => 'none',
        'photo_src' => ( isset( $item->photo_src ) ) ? $item->photo_src : '' ,

        /* Icon Colors */ 
        'icon_color' => $item->icon_color,
        'icon_hover_color' => $item->icon_hover_color,
        'icon_bg_color' => $item->icon_bg_color,
        'icon_bg_color_opc' => '',
        'icon_bg_hover_color' => $item->icon_bg_hover_color,
        'icon_bg_hover_color_opc' => '',
        'icon_three_d' => $item->icon_gradient,
        'icon_border_style' => 'none',
    ); 
   
    /* CSS Render Function */ 
    FLBuilder::render_module_css( 'image-icon', $id . " .uabb-circle-". $circle_item_count, $imageicon_array );

    
    /* Render Info Icon CSS Info Area Icon/Image */
    if( $settings->info_area_icon != 'no' ) {
        $settings->icon_img_border_radius = ( $settings->icon_img_border_radius != '' ) ? $settings->icon_img_border_radius : '0';
        $info_imageicon_array = array(

            /* General Section */
            'image_type' => $item->image_type,

            /* Icon Basics */
            'icon' => $item->icon,
            'icon_align' => 'center',
            'icon_style' => $settings->info_area_icon,
            'icon_size' => $settings->icon_img_size,

            /* Image Basics */
            'photo_source' => $item->photo_source,
            'photo' => $item->photo,
            'photo_url' => $item->photo_url,
            'img_align' => 'center',
            'img_size'  => $settings->icon_img_size,
            'image_style' => $settings->info_area_icon,
            'img_bg_color' => $settings->icon_img_bg_color,
            'img_bg_size' => $settings->icon_img_bg_padding,
            'img_border_style' => $settings->info_icon_img_border_style,
            'img_border_width' => $settings->info_icon_img_border_width,
            'img_border_color' => $settings->info_icon_img_border_color,
            'img_bg_border_radius' => $settings->icon_img_border_radius,
            'photo_src' => ( isset( $item->photo_src ) ) ? $item->photo_src : '' ,

            /* Icon Colors */ 
            'icon_color' => $settings->icon_img_color,
            'icon_hover_color' => $settings->icon_img_color, // Hover color same as normal
            'icon_bg_color' => $settings->icon_img_bg_color,
            'icon_bg_color_opc' => ( isset( $settings->icon_img_bg_color_opc ) ) ? $settings->icon_img_bg_color_opc : '',
            'icon_bg_hover_color' => $settings->icon_img_bg_color,  // Hover bg color same as normal
            'icon_bg_hover_color_opc' => ( isset( $settings->icon_img_bg_color_opc ) ) ? $settings->icon_img_bg_color_opc : '',  // Hover bg color same as normal
            'icon_bg_size' => $settings->icon_img_bg_padding,
            'icon_bg_border_radius' => $settings->icon_img_border_radius,
            'icon_border_style' => $settings->info_icon_img_border_style,
            'icon_border_width' => $settings->info_icon_img_border_width,
            'icon_border_color' => $settings->info_icon_img_border_color,
        ); 
        
        /* CSS Render Function */ 
        FLBuilder::render_module_css( 'image-icon', $id . " .uabb-info-circle-in-". $circle_item_count, $info_imageicon_array );
    }

    if( $item->cta == 'desc' || $item->cta == 'both' ) :
        /* Render Button Style */
        if( $item->desc_cta_type == 'button' ) {
            $btn_settings = array(

                /* General Section */
                'text'              => $item->cta_text,

                /* Link Section */
                'link'              => $item->cta_link,
                'link_target'       => $item->cta_link_target,

                /* Style Section */
                'style'             => $item->btn_style,
                'border_size'       => $item->btn_border_size,
                'transparent_button_options' => $item->btn_transparent_button_options,
                'threed_button_options'      => $item->btn_threed_button_options,
                'flat_button_options'        => $item->btn_flat_button_options,

                /* Colors */
                'bg_color'          => $item->btn_bg_color,
                'bg_hover_color'    => $item->btn_bg_hover_color,
                'bg_color_opc'          => $item->btn_bg_color_opc,
                'bg_hover_color_opc'    => $item->btn_bg_hover_color_opc,
                'text_color'        => $item->btn_text_color,
                'text_hover_color'  => $item->btn_text_hover_color,
                'hover_attribute'   => $item->hover_attribute,

                /* Icon */
                'icon'              => $item->btn_icon,
                'icon_position'     => $item->btn_icon_position,

                /* Structure */
                'width'              => $item->btn_width,
                'custom_width'       => $item->btn_custom_width,
                'custom_height'      => $item->btn_custom_height,
                'padding_top_bottom' => $item->btn_padding_top_bottom,
                'padding_left_right' => $item->btn_padding_left_right,
                'border_radius'      => $item->btn_border_radius,
                'align'              => 'center',
                'mob_align'          => 'center',

                /* Typography */
                'font_size'         => $item->btn_font_size,
                'line_height'       => $item->btn_line_height,
                'font_family'       => $item->btn_font_family,
            );

            FLBuilder::render_module_css( 'uabb-button', $id . " .uabb-info-circle-in-". $circle_item_count, $btn_settings );
        } else { ?>
            .fl-node-<?php echo $id; ?> .uabb-info-circle-in-<?php echo $circle_item_count ?> .uabb-info-circle-cta-text .uabb-infoc-link {
                <?php if( $item->btn_font_family->family != "Default") : ?>
                font-family: <?php  echo $item->btn_font_family->family; ?>;
                        <?php if( $item->btn_font_family->weight != "regular") : ?>
                        font-weight: <?php  echo $item->btn_font_family->weight; ?>;
                        <?php endif; ?>
                <?php endif; ?>

                <?php if( $item->btn_color != "") : ?>
                color: <?php echo $item->btn_color; ?>;
                <?php endif; ?>

                <?php if( $item->btn_font_size->desktop != '' ) : ?>
                font-size: <?php echo $item->btn_font_size->desktop; ?>px;
                <?php endif; ?>

                <?php if( $item->btn_line_height->desktop != '' ) : ?>
                line-height: <?php echo $item->btn_line_height->desktop; ?>px;
                <?php endif; ?>
            }
            /* Responsive CSS for CTA Text */
            <?php if($global_settings->responsive_enabled) { ?> 
    
                @media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
                    .fl-node-<?php echo $id; ?> .uabb-info-circle-in-<?php echo $circle_item_count ?> .uabb-info-circle-cta-text .uabb-infoc-link {
                        <?php if( $item->btn_font_size->medium != '' ) : ?>
                        font-size: <?php echo $item->btn_font_size->medium; ?>px;
                        line-height: <?php echo $item->btn_font_size->medium + 2; ?>px;
                        <?php endif; ?>

                        <?php if( $item->btn_line_height->medium != '' ) : ?>
                        line-height: <?php echo $item->btn_line_height->medium; ?>px;
                        <?php endif; ?>
                    }
                }
            
                @media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
                    .fl-node-<?php echo $id; ?> .uabb-info-circle-in-<?php echo $circle_item_count ?> .uabb-info-circle-cta-text .uabb-infoc-link {
                        <?php if( $item->btn_font_size->small != '' ) : ?>
                        font-size: <?php echo $item->btn_font_size->small; ?>px;
                        line-height: <?php echo $item->btn_font_size->small + 2; ?>px;
                        <?php endif; ?>

                        <?php if( $item->btn_line_height->small != '' ) : ?>
                        line-height: <?php echo $item->btn_line_height->small; ?>px;
                        <?php endif; ?>
                    }
                }       
                <?php
            }
        }

    endif;
    
    $item->inner_circle_bg_color = UABB_Helper::uabb_colorpicker( $item, 'inner_circle_bg_color', true );
    $item->icon_hover_color = UABB_Helper::uabb_colorpicker( $item, 'icon_hover_color' );
    $item->icon_bg_hover_color = UABB_Helper::uabb_colorpicker( $item, 'icon_bg_hover_color' );
    $item->separator_color = UABB_Helper::uabb_colorpicker( $item, 'separator_color' );

    /* Calculate & Set Info Circle Coordinates */
    $angle = ( $angle_init - 90 ) * M_PI / 180;

    $x = 50 + ( 40 * cos( $angle ) );
    $y = 50 + ( 40 * sin( $angle ) );

?>

    .fl-node-<?php echo $id; ?> .active .uabb-circle-<?php echo $circle_item_count ?> .uabb-icon i, 
    .fl-node-<?php echo $id; ?> .active .uabb-circle-<?php echo $circle_item_count ?> .uabb-icon i:before {
        <?php if ( $item->icon_gradient ) { ?>
        <?php
        
        $bg_hover_color      = ( !empty($item->icon_bg_hover_color) ) ? uabb_parse_color_to_hex( $item->icon_bg_hover_color ) : uabb_parse_color_to_hex( $item->icon_bg_hover_color ) ;
        $bg_grad_start = '#'.FLBuilderColor::adjust_brightness($bg_hover_color, 40, 'lighten');
        ?>

        /* Gradient Style */
        background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $item->icon_bg_hover_color; ?> 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $item->icon_bg_hover_color; ?>)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $item->icon_bg_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $item->icon_bg_hover_color; ?> 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $item->icon_bg_hover_color; ?> 100%); /* IE10+ */
        background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $item->icon_bg_hover_color; ?> 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $item->icon_bg_hover_color; ?>',GradientType=0 ); /* IE6-9 */
        <?php }else{  ?>
        background: <?php echo $item->icon_bg_hover_color; ?>;
        <?php } ?>
        color: <?php echo $item->icon_hover_color; ?>;
    }

    .fl-node-<?php echo $id; ?> .uabb-circle-<?php echo $circle_item_count ?> {
        left: <?php echo $x ?>%;
        top: <?php echo $y ?>%;
    }
    <?php /* Information Circle Background Color */ ?>
    <?php if ( $settings->info_separator_style != 'none' ) : ?>
    .fl-node-<?php echo $id; ?> .uabb-info-circle-in-<?php echo $circle_item_count; ?> .uabb-ic-separator {
        border-color: <?php echo $item->separator_color; ?>;
    }
    <?php endif; ?>

    <?php /* Information Circle Background Color for Responsive from Outer Background Options for fallback */
    if( $settings->responsive_nature == 'true' ) : ?>
    <?php $responsive_bg_set = false; ?>
    @media ( max-width: <?php echo $responsive_breakpoint .'px'; ?> ) {
        .fl-node-<?php echo $id; ?> .uabb-ic-<?php echo $circle_item_count; ?> {
        
            <?php if( $settings->content_width == 'custom' ) : // If Inner global Color not exists 
                if ( $settings->outer_bg_type == 'color' ) : ?>
                    background-color: <?php echo $settings->outer_bg_color; ?>;
                <?php elseif ( $settings->outer_bg_type == 'image' ) : ?>
                    background-image: url(<?php echo FLBuilderPhoto::get_attachment_data($settings->outer_bg_img)->url; ?>);
                    background-position: <?php echo $settings->outer_bg_img_pos; ?>;
                    background-size: <?php echo $settings->outer_bg_img_size; ?>;
                    background-repeat: <?php echo $settings->outer_bg_img_repeat; ?>;
                <?php endif; ?>
            <?php endif; ?>

        }
    }
    <?php endif; ?>

    <?php /* Information Circle Background Color */
        if ( $item->inner_circle_bg_type == 'color' && $item->inner_circle_bg_color != '' ) : ?>
        .fl-node-<?php echo $id; ?> .uabb-info-circle-in-<?php echo $circle_item_count; ?> {
            background-color: <?php echo $item->inner_circle_bg_color; ?>;
        }

        <?php /* Information Circle Background Color for Responsive */
            if( $settings->responsive_nature == 'true' ) : ?>
            @media ( max-width: <?php echo $responsive_breakpoint .'px'; ?> ) { 
                .fl-node-<?php echo $id; ?> .uabb-ic-<?php echo $circle_item_count; ?> {
                    background: <?php echo $item->inner_circle_bg_color; ?>;
                }
            }
        <?php endif; ?>
    
    <?php /* Information Circle Background Image */ 
        elseif ( $item->inner_circle_bg_type == 'image' && FLBuilderPhoto::get_attachment_data($item->inner_circle_bg_img)->url != '' ) : ?>
        .fl-node-<?php echo $id; ?> .uabb-info-circle-in-<?php echo $circle_item_count; ?> {
            background-image: url(<?php echo FLBuilderPhoto::get_attachment_data($item->inner_circle_bg_img)->url; ?>);
            background-position: <?php echo $item->inner_circle_bg_img_pos; ?>;
            background-size: <?php echo $item->inner_circle_bg_img_size; ?>;
            background-repeat: <?php echo $item->inner_circle_bg_img_repeat; ?>;
        }

        <?php /* Information Circle Background Image for Responsive */
            if( $settings->responsive_nature == 'true' ) : ?>
            @media ( max-width: <?php echo $responsive_breakpoint .'px'; ?> ) { 
                .fl-node-<?php echo $id; ?> .uabb-ic-<?php echo $circle_item_count; ?> {
                    background: url(<?php echo FLBuilderPhoto::get_attachment_data($item->inner_circle_bg_img)->url; ?>);
                    background-position: <?php echo $item->inner_circle_bg_img_pos; ?>;
                    background-size: <?php echo $item->inner_circle_bg_img_size; ?>;
                    background-repeat: <?php echo $item->inner_circle_bg_img_repeat; ?>;
                }
            }
        <?php endif; ?>
    <?php /* Information Circle Background Global Color */ 
        elseif( $settings->info_bg_color != '' ) : ?> 
        .fl-node-<?php echo $id; ?> .uabb-info-circle-in-<?php echo $circle_item_count; ?> {
            background-color: <?php echo $settings->info_bg_color; ?>;
        }
        <?php /* Information Circle Background Image for Responsive */
            if( $settings->responsive_nature == 'true' ) : ?>
            @media ( max-width: <?php echo $responsive_breakpoint .'px'; ?> ) { 
                .fl-node-<?php echo $id; ?> .uabb-ic-<?php echo $circle_item_count; ?> {
                    background: <?php echo $settings->info_bg_color; ?>;
                }
            }
        <?php endif; ?>

    <?php endif; ?>
    

<?php 
    $angle_init += $angle_gap;
} /* End Foreach */
?>

.fl-node-<?php echo $id; ?> .uabb-info-circle-wrap .uabb-info-circle-content {
    <?php echo $settings->info_area_spacing; ?>;
}

<?php /* Thumbnail Custom Style */
if( $settings->thumb_style == 'custom' ) : ?>
.fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i, 
.fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i:before {
    line-height: <?php echo $settings->thumbnail_size; ?>px;
    width: <?php echo $settings->thumbnail_size; ?>px;
    height: <?php echo $settings->thumbnail_size; ?>px;
}
<?php endif; ?>

<?php /* Thumbnail Icon/Image Border Style */
if ( $settings->thumb_border_style != 'none' ) : ?>
<?php $thumb_border_width = ($settings->thumb_border_width != '') ? $settings->thumb_border_width : '1'; ?>
    .fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-icon-wrap i,
    .fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-image .uabb-photo-img {
        box-sizing: content-box;
        border: <?php echo $thumb_border_width . 'px ' . $settings->thumb_border_style . ' ' . $settings->thumb_border_color; ?>;
    }

    .fl-node-<?php echo $id; ?> .active .uabb-info-circle-small .uabb-icon-wrap i,
    .fl-node-<?php echo $id; ?> .active .uabb-info-circle-small .uabb-image .uabb-photo-img {
        border-color: <?php echo $settings->thumb_active_border_color; ?>;
    }

    <?php if ( $settings->thumb_border_style == 'solid' ) : ?>
    .fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-image .uabb-photo-img {
        background-color: <?php echo $settings->thumb_border_color; ?>;    
    }
    .fl-node-<?php echo $id; ?> .active .uabb-info-circle-small .uabb-image .uabb-photo-img {
        background-color: <?php echo $settings->thumb_active_border_color; ?>;
    }
    <?php endif; ?>
    
<?php endif; ?>

<?php /* Connector Border Style */ 
if ( $settings->connector_border_style != 'none' ) : 
    $conn_border_width = ($settings->connector_border_width != '') ? $settings->connector_border_width : '1'; ?>
    
    .fl-node-<?php echo $id; ?> .uabb-info-circle-wrap:before {
        border: <?php echo $conn_border_width . 'px ' . $settings->connector_border_style . ' ' . $settings->connector_border_color; ?>;
    }
<?php endif; ?>

<?php /* Outer Circle Background Color */
    if ( $settings->content_width == 'custom' && $settings->outer_bg_type == 'color' ) : ?>
    .fl-node-<?php echo $id; ?> .uabb-info-circle-out {
        background-color: <?php echo $settings->outer_bg_color; ?>;
    }
<?php /* Outer Circle Background Image */ 
    elseif ( $settings->outer_bg_type == 'image' ) : ?>
    .fl-node-<?php echo $id; ?> .uabb-info-circle-out {
        background-image: url(<?php echo FLBuilderPhoto::get_attachment_data($settings->outer_bg_img)->url; ?>);
        background-position: <?php echo $settings->outer_bg_img_pos; ?>;
        background-size: <?php echo $settings->outer_bg_img_size; ?>;
        background-repeat: <?php echo $settings->outer_bg_img_repeat; ?>;
    }
<?php endif; ?>

<?php /* Information Circle Size */ ?>
.fl-node-<?php echo $id; ?> .uabb-info-circle-in {
    <?php 
        $inner_width = 80;
        if ( $settings->content_width == 'custom' ) {
            $inner_width = ( trim($settings->inner_area_size) != '' ) ? $settings->inner_area_size : '80'; 
            $inner_width = ( $inner_width < 100 ) ? $inner_width : 100;
            $inner_width = ( $inner_width >= 0 ) ? $inner_width : 80;
            $inner_width -= 20;
        }
    ?>
    width: <?php echo $inner_width; ?>%;
    height: <?php echo $inner_width; ?>%;
}
<?php /* Information Separator */ ?>
<?php if( $settings->info_separator_style != 'none' ) :
    $info_separator_height = ( trim( $settings->info_separator_height ) != '' ) ? $settings->info_separator_height : '3'; ?>
    .fl-node-<?php echo $id; ?> .uabb-ic-separator {
        width: <?php echo ( trim( $settings->info_separator_width ) != '' ) ? $settings->info_separator_width : '12'; ?>%;
        display: inline-block;
        border: 0;
        border-bottom: <?php echo $info_separator_height . 'px ' . $settings->info_separator_style . ' ' . $settings->info_separator_color; ?>;
    }
<?php endif; ?>

<?php /* Information Circle Responsive Enabled */ ?>
<?php if( $settings->responsive_nature == 'true' ) : ?>
    @media ( max-width: <?php echo $responsive_breakpoint .'px'; ?> ) {
        
        .fl-node-<?php echo $id; ?> .uabb-info-circle .uabb-imgicon-wrap .uabb-image {
            display: inline-block;
        }
        
        .fl-node-<?php echo $id; ?> .uabb-info-circle-wrap {
            height: auto !important;
        }
        
        .fl-node-<?php echo $id; ?> .uabb-info-circle-in { 
            background: none;
            display: block !important;
            opacity: 1 !important;
        }

        .fl-node-<?php echo $id; ?> .uabb-info-circle-in .uabb-info-circle-content {
            padding: 0;
        }

        <?php $responsive_width = trim($settings->thumbnail_size_mobile) != '' ? $settings->thumbnail_size_mobile : '60'; ?>
        .fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i, 
        .fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i:before,
        .fl-node-<?php echo $id; ?> .uabb-info-circle-small .uabb-image .uabb-photo-img {
            font-size: <?php echo $responsive_width / 2; ?>px;
            line-height: <?php echo $responsive_width; ?>px;
            height: <?php echo $responsive_width; ?>px;
            width: <?php echo $responsive_width; ?>px;
        }
        
        .fl-node-<?php echo $id; ?> .uabb-info-circle-icon-content { 
            padding: 20px;
        }

        .fl-node-<?php echo $id; ?> .uabb-info-circle-icon-content:not(:last-child) {
            margin-bottom: 20px
        }

        .fl-node-<?php echo $id; ?> .uabb-info-circle-content .uabb-imgicon-wrap,
        .fl-node-<?php echo $id; ?> .uabb-info-circle-out,
        .fl-node-<?php echo $id; ?> .uabb-info-circle-wrap:before {
            display: none;
        }
        
        .fl-node-<?php echo $id; ?> .uabb-info-circle-in,
        .fl-node-<?php echo $id; ?> .uabb-info-circle-small,
        .fl-node-<?php echo $id; ?> .uabb-info-circle-in .uabb-info-circle-content {
            position: static;
            -webkit-transform: none;
            -ms-transform: none;
                transform: none;
            width: 100%;
            border-radius: 0;
            opacity: 1;
            -webkit-transition: none;
            transition: none;
        }
        .fl-node-<?php echo $id; ?> .uabb-info-circle-small {
            margin-bottom: 15px;
        }
    }
<?php endif; ?>

<?php /* Typography for Info Circle Title */ ?>
.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-info-circle-title {
    <?php if( $settings->font_family['family'] != "Default") : ?>
    font-family: <?php  echo $settings->font_family['family']; ?>;
            <?php if( $settings->font_family['weight'] != "regular") : ?>
            font-weight: <?php  echo $settings->font_family['weight']; ?>;
            <?php endif; ?>
    <?php endif; ?>

    <?php if( $settings->font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->color != '' ) : ?>
    color: <?php echo $settings->color; ?>;
    <?php endif; ?>

    margin-top: <?php echo ( $settings->title_margin_top != '' ) ? $settings->title_margin_top : 0; ?>px;
    margin-bottom: <?php echo ( $settings->title_margin_bottom != '' ) ? $settings->title_margin_bottom : 20; ?>px;
}

<?php /* Typography for Info Circle Description */ ?>
.fl-node-<?php echo $id; ?> .uabb-info-circle-desc {
    <?php if( $settings->desc_font_family['family'] != "Default") : ?>
    font-family: <?php  echo $settings->desc_font_family['family']; ?>;
            <?php if( $settings->desc_font_family['weight'] != "regular") : ?>
            font-weight: <?php  echo $settings->desc_font_family['weight']; ?>;
            <?php endif; ?>
    <?php endif; ?>

    <?php if( $settings->desc_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->desc_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->desc_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->desc_color != '' ) : ?>
    color: <?php echo $settings->desc_color; ?>;
    <?php endif; ?>

    margin-top: <?php echo ( $settings->desc_margin_top != '' ) ? $settings->desc_margin_top : 20; ?>px;
    margin-bottom: <?php echo ( $settings->desc_margin_bottom != '' ) ? $settings->desc_margin_bottom : 0; ?>px;
}

<?php /* Global Setting If started */ ?>
<?php if($global_settings->responsive_enabled) { ?> 
    
        <?php /* Medium Breakpoint media query */  ?>
        @media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
            /* Info Circle Title */
            .fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-info-circle-title {
                <?php if( $settings->font_size['medium'] != '' ) : ?>
                font-size: <?php echo $settings->font_size['medium']; ?>px;
                line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
                <?php endif; ?>

                <?php if( $settings->line_height['medium'] != '' ) : ?>
                line-height: <?php echo $settings->line_height['medium']; ?>px;
                <?php endif; ?>
            }

            /* Info Circle Description */
            .fl-node-<?php echo $id; ?> .uabb-info-circle-desc {
                <?php if( $settings->desc_font_size['medium'] != '' ) : ?>
                font-size: <?php echo $settings->desc_font_size['medium']; ?>px;
                <?php endif; ?>

                <?php if( $settings->desc_line_height['medium'] != '' ) : ?>
                line-height: <?php echo $settings->desc_line_height['medium']; ?>px;
                <?php endif; ?>
            }
        }
    
        <?php /* Small Breakpoint media query */ ?>
        @media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
            /* Info Circle Title */
            .fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-info-circle-title {
                <?php if( $settings->font_size['small'] != '' ) : ?>
                font-size: <?php echo $settings->font_size['small']; ?>px;
                line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
                <?php endif; ?>

                <?php if( $settings->line_height['small'] != '' ) : ?>
                line-height: <?php echo $settings->line_height['small']; ?>px;
                <?php endif; ?>
            }

            /* Info Circle Description */
            .fl-node-<?php echo $id; ?> .uabb-info-circle-desc {
                <?php if( $settings->desc_font_size['small'] != '' ) : ?>
                font-size: <?php echo $settings->desc_font_size['small']; ?>px;
                <?php endif; ?>

                <?php if( $settings->desc_line_height['small'] != '' ) : ?>
                line-height: <?php echo $settings->desc_line_height['small']; ?>px;
                <?php endif; ?>
            }
        }       
    <?php
}