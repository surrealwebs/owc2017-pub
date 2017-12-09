<?php 
$settings->content_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'content_bg_color' );
$settings->overlay_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );

$settings->close_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'close_icon_color' );

$settings->icon_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
$settings->icon_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color' );

$settings->text_color = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );
$settings->text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'text_hover_color' );

$settings->title_color = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
$settings->title_bg_color   = UABB_Helper::uabb_colorpicker( $settings, 'title_bg_color', true );

$settings->ct_content_color = UABB_Helper::uabb_colorpicker( $settings, 'ct_content_color' );
 
?>

.fl-node-<?php echo $id; ?> {
    width:100%;
}

.fl-node-<?php echo $id; ?> .uabb-modal-action-wrap {
    text-align: <?php echo $settings->all_align; ?>;
}



<?php if( $settings->modal_on == 'button') { 
    $btn_settings = array(

          /* General Section */
            'text'              => $settings->btn_text,
            
            /* Link Section */
            'link'              => '',//$settings->btn_link,
            'link_target'       => '',//$settings->btn_link_target,
            
            /* Style Section */
            'style'             => $settings->btn_style,
            'border_size'       => $settings->btn_border_size,
            'transparent_button_options' => $settings->btn_transparent_button_options,
            'threed_button_options'      => $settings->btn_threed_button_options,
            'flat_button_options'        => $settings->btn_flat_button_options,
            'hover_attribute'            => $settings->hover_attribute,

            /* Colors */
            'bg_color'          => $settings->btn_bg_color,
            'bg_hover_color'    => $settings->btn_bg_hover_color,
            'bg_color_opc'          => $settings->btn_bg_color_opc,
            'bg_hover_color_opc'    => $settings->btn_bg_hover_color_opc,
            'text_color'        => $settings->btn_text_color,
            'text_hover_color'  => $settings->btn_text_hover_color,

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
            'align'              => $settings->btn_align,
            'mob_align'          => $settings->btn_mob_align,

            /* Typography */
            //'font_size'         => $settings->btn_font_size,
            //'line_height'       => $settings->btn_line_height,
            //'font_family'       => $settings->btn_font_family,
    );

    /* CSS Render Function */ 
    FLBuilder::render_module_css( 'uabb-button', $id, $btn_settings);
?>
    .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
    .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
    
        <?php if( $settings->btn_font_family['family'] != "Default") : ?>
            <?php UABB_Helper::uabb_font_css( $settings->btn_font_family ); ?>
        <?php endif; ?>
        <?php if( $settings->btn_font_size['desktop'] != '' ) : ?>
        font-size: <?php echo $settings->btn_font_size['desktop']; ?>px;
        line-height: <?php echo $settings->btn_font_size['desktop'] + 2; ?>px;
        <?php endif; ?>
            
        <?php if( $settings->btn_line_height['desktop'] != '' ) : ?>
        line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
        <?php endif; ?>
    }

<?php }elseif( $settings->modal_on == 'text') { ?>

.fl-node-<?php echo $id; ?> .uabb-modal-action {
    color: <?php echo $settings->text_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-modal-action:hover {
    color: <?php echo $settings->text_hover_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-modal-action {
    <?php if( $settings->font_family['family'] != "Default") : ?>
        <?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
    <?php endif; ?>
    <?php if( $settings->font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->font_size['desktop']; ?>px;
    line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
    <?php endif; ?>
        
    <?php if( $settings->line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->line_height['desktop']; ?>px;
    <?php endif; ?>
}

<?php }elseif( $settings->modal_on == 'icon') { ?>

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-modal-action-wrap .uabb-modal-action .uabb-modal-icon {
    font-size: <?php echo $settings->icon_size; ?>px;
    color: <?php echo $settings->icon_color; ?>;
}

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-modal-action-wrap .uabb-modal-action:hover .uabb-modal-icon {
    color: <?php echo $settings->icon_hover_color; ?>;
}

<?php }elseif( $settings->modal_on == 'photo') { ?>

.fl-node-<?php echo $id; ?> .uabb-modal-photo {
    width:<?php echo $settings->img_size; ?>px
}

<?php } ?>

/* Global Css */


<?php if ( $settings->close_source == 'icon' ) { ?>
    .uamodal-<?php echo $id; ?> .uabb-modal-close {
        font-size: <?php echo $settings->close_icon_size; ?>px;
    }
    .uamodal-<?php echo $id; ?> .uabb-close-icon {
        width: <?php echo $settings->close_icon_size; ?>px;
        height: <?php echo $settings->close_icon_size; ?>px;
        line-height: <?php echo $settings->close_icon_size; ?>px;
        font-size: <?php echo $settings->close_icon_size; ?>px;
        color: <?php echo $settings->close_icon_color; ?>;
    }
<?php }else{ ?>
    .uamodal-<?php echo $id; ?> .uabb-modal-close,
    .uamodal-<?php echo $id; ?> .uabb-close-image {
        width: <?php echo ( $settings->close_icon_size != '' ) ? $settings->close_icon_size : '25'; ?>px;
        height: <?php echo ( $settings->close_icon_size != '' ) ? $settings->close_icon_size : '25'; ?>px;
    }
<?php } ?>

<?php if ( $settings->icon_position == 'popup-edge-top-right' ) { ?>
    .uamodal-<?php echo $id; ?> .uabb-modal-close {
        top: -<?php echo ( $settings->close_icon_size != '' ) ? intval( $settings->close_icon_size )/2 : '12.5'; ?>px;
        right: -<?php echo ( $settings->close_icon_size != '' ) ? intval( $settings->close_icon_size )/2 : '12.5'; ?>px;
        left: auto;
    }
<?php } elseif ( $settings->icon_position == 'popup-edge-top-left' ) { ?>
    .uamodal-<?php echo $id; ?> .uabb-modal-close {
        top: -<?php echo ( $settings->close_icon_size != '' ) ? intval( $settings->close_icon_size )/2 : '12.5'; ?>px;
        left: -<?php echo ( $settings->close_icon_size != '' ) ? intval( $settings->close_icon_size )/2 : '12.5'; ?>px;
        right: auto;
    }
<?php }  ?>


.uamodal-<?php echo $id; ?> .uabb-content {
    background: <?php echo ( $settings->content_bg_color != '' ) ? $settings->content_bg_color : ''; ?>;
}

.uamodal-<?php echo $id; ?> .uabb-overlay {
    background: <?php echo ( $settings->overlay_color != '' ) ? $settings->overlay_color : ''; ?>;
}

.uamodal-<?php echo $id; ?> .uabb-modal-title-wrap {
    text-align: <?php echo $settings->title_alignment; ?>;

    <?php if ( !empty( $settings->title_spacing ) ) { ?>
    <?php echo $settings->title_spacing; ?>
    <?php } ?>

    <?php if( $settings->title_bg_color != '' ) { ?>
    background: <?php echo $settings->title_bg_color; ?>;
    <?php } ?>
}

<?php if ( !empty( $settings->modal_spacing ) ) { ?>
.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
     <?php echo $settings->modal_spacing; ?>
}
<?php } ?>


<?php /*if ( $settings->modal_size == 'full' ) { ?>

.fl-node-<?php echo $id; ?> .uabb-modal {//.uabb-content {//
    <?php echo ( $settings->modal_spacing != '' ) ? 'padding: '.$settings->modal_spacing.'px;' : ''; ?>;
}

<?php } elseif ( $settings->modal_size == 'custom' ) { */?>
    <?php if ( $settings->modal_width != '' && is_numeric($settings->modal_width) ) { ?>
        .uamodal-<?php echo $id; ?> .uabb-modal,
        .uamodal-<?php echo $id; ?> .uabb-content  {
                width: <?php echo $settings->modal_width; ?>px;
                max-width: 100%;
        }
        
        <?php $size = $module->get_width_height(); ?>
        <?php if ( $settings->content_type == 'youtube' || $settings->content_type == 'vimeo' ) { ?>
        .uamodal-<?php echo $id; ?> .uabb-modal-content-data {
            width: <?php echo $size['width']; ?>px;
            height: <?php echo $size['height']; ?>px;
            max-width: 100%;
            /*max-height: 100%;*/
        }
        @media ( max-height: <?php echo $size['height'] .'px'; ?> ) { 
            .uamodal-<?php echo $id; ?> .uabb-modal-content-data {
                height: auto;
            }
        }
        <?php }elseif ( $settings->content_type == 'iframe' ) { ?>
            .uamodal-<?php echo $id; ?> .uabb-modal-content-data {
                height: <?php echo $settings->iframe_height; ?>px;
            }
        <?php } ?>
    <?php } elseif ( $settings->modal_width == '' ) { ?>
        .uamodal-<?php echo $id; ?> .uabb-modal,
        .uamodal-<?php echo $id; ?> .uabb-content  {
            width: 100%;
            max-width: 100%;
            <?php if ( $settings->content_type == 'youtube' || $settings->content_type == 'vimeo' ) { ?>
                height:100%;
                max-height: 100%;
            <?php } ?>
        }

        <?php if ( $settings->content_type == 'youtube' || $settings->content_type == 'vimeo' ) { ?>
        .uamodal-<?php echo $id; ?> .uabb-modal-content-data {
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
        }
        <?php }elseif ( $settings->content_type == 'iframe' ) { ?>
            .uamodal-<?php echo $id; ?> .uabb-modal-content-data {
                height: <?php echo $settings->iframe_height; ?>px;
            }
        <?php } ?>
    <?php } ?>
    /*.uamodal-<?php echo $id; ?> .uabb-modal,
    .uamodal-<?php echo $id; ?> .uabb-content  {
        <?php if ( $size != false ) { ?>
            width: <?php echo $size['width']; ?>px;
            max-width: 100%;
            <?php if ( $settings->content_type == 'youtube' || $settings->content_type == 'vimeo' ) { ?>
                height: <?php echo $size['height']; ?>px;
                max-height: 100%;
            <?php } ?>
        <?php } elseif ( $settings->modal_width == '' ) { ?>
            width: 100%;
            max-width: 100%;
            <?php if ( $settings->content_type == 'youtube' || $settings->content_type == 'vimeo' ) { ?>
                height: 100%;
                max-height: 100%;
            <?php } ?>
        <?php } ?>
    }*/
<?php /* } // End Custom Css */?>

/* Responsive Center CSS */
<?php if ( $settings->modal_width != '' ) { ?>
 @media ( max-width: <?php echo ( intval($settings->modal_width) + 50 ) . 'px'; ?> ) { 
    /*.uamodal-<?php echo $id; ?> .uabb-modal,*/
    .uamodal-<?php echo $id; ?> .uabb-content {
        width : 80%;
    }
}
<?php } ?>

/* Title Typography */
<?php if (  $settings->enable_title ) { ?> 
.uamodal-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-modal-title {
    <?php if ( $settings->title_color != ''  ) { ?>
    color: <?php echo $settings->title_color; ?>;
    <?php } ?>
    
    <?php if( $settings->title_font_family['family'] != "Default") : ?>
        <?php UABB_Helper::uabb_font_css( $settings->title_font_family ); ?>
    <?php endif; ?>
    <?php if( $settings->title_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->title_font_size['desktop']; ?>px;
    line-height: <?php echo $settings->title_font_size['desktop'] + 2; ?>px;
    <?php endif; ?>
        
    <?php if( $settings->title_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->title_line_height['desktop']; ?>px;
    <?php endif; ?>
}
<?php } ?>
/* End Title Typography */

/* Modal Content Typography */
<?php if (  $settings->content_type == 'content' ) { ?> 
.uamodal-<?php echo $id; ?> .uabb-modal-text {
    <?php if( $settings->ct_content_font_family['family'] != "Default") : ?>
        <?php UABB_Helper::uabb_font_css( $settings->ct_content_font_family ); ?>
    <?php endif; ?>
    <?php if( $settings->ct_content_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->ct_content_font_size['desktop']; ?>px;
    line-height: <?php echo $settings->ct_content_font_size['desktop'] + 2; ?>px;
    <?php endif; ?>
        
    <?php if( $settings->ct_content_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->ct_content_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->ct_content_color != '' ) : ?>
    color: <?php echo $settings->ct_content_color; ?>;
    <?php endif; ?>
}
<?php } ?>
/* End Modal Content Typography */


<?php if($global_settings->responsive_enabled) { // Global Setting If started 
    if( $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" || $settings->btn_font_size['medium'] != "" || $settings->btn_line_height['medium'] != "" || $settings->ct_content_font_size['medium'] != "" || $settings->ct_content_line_height['medium'] != "" || $settings->title_font_size['medium'] != "" || $settings->title_line_height['medium'] != "" )
    {
        /* Medium Breakpoint media query */ 
    ?>
        @media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
            <?php if ( $settings->modal_on == 'button' ) { ?>
            .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
            .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
                <?php if( $settings->btn_font_size['medium'] != '' ) : ?>
                font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
                line-height: <?php echo $settings->btn_font_size['medium'] + 2; ?>px;
                <?php endif; ?>
                
                <?php if ( $settings->btn_line_height['medium'] != '' ) : ?>
                line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
                <?php endif; ?>
                
            }
            <?php } ?>

            <?php if ( $settings->modal_on == 'text' ) { ?>
            .fl-node-<?php echo $id; ?> .uabb-modal-action {
                <?php if( $settings->font_size['medium'] != '' ) : ?>
                font-size: <?php echo $settings->font_size['medium']; ?>px;
                line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
                <?php endif; ?>
                
                <?php if ( $settings->line_height['medium'] != '' ) : ?>
                line-height: <?php echo $settings->line_height['medium']; ?>px;
                <?php endif; ?>
                
            }
            <?php } ?>

            <?php if (  $settings->content_type == 'content' ) { ?> 
            .uamodal-<?php echo $id; ?> .uabb-modal-text {
                <?php if( $settings->ct_content_font_size['medium'] != '' ) : ?>
                font-size: <?php echo $settings->ct_content_font_size['medium']; ?>px;
                line-height: <?php echo $settings->ct_content_font_size['medium'] + 2; ?>px;
                <?php endif; ?>
                    
                <?php if( $settings->ct_content_line_height['medium'] != '' ) : ?>
                line-height: <?php echo $settings->ct_content_line_height['medium']; ?>px;
                <?php endif; ?>
            }
            <?php } ?>

            <?php if (  $settings->enable_title ) { ?> 
            .uamodal-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-modal-title {
                <?php if( $settings->title_font_size['medium'] != '' ) : ?>
                font-size: <?php echo $settings->title_font_size['medium']; ?>px;
                line-height: <?php echo $settings->title_font_size['medium'] + 2; ?>px;
                <?php endif; ?>
                    
                <?php if( $settings->title_line_height['medium'] != '' ) : ?>
                line-height: <?php echo $settings->title_line_height['medium']; ?>px;
                <?php endif; ?>
            }
            <?php } ?>
        }       
    <?php
    }
    if( $settings->font_size['small'] != "" || $settings->line_height['small'] != "" || $settings->btn_font_size['small'] != "" || $settings->btn_line_height['small'] != "" || $settings->ct_content_font_size['small'] != "" || $settings->ct_content_line_height['small'] != "" || $settings->title_font_size['small'] != "" || $settings->title_line_height['small'] != "")
    {
        /* Small Breakpoint media query */  
    ?>
        @media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
            <?php if ( $settings->modal_on == 'button' ) { ?>
            .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
            .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
                <?php if( $settings->btn_font_size['small'] != '' ) : ?>
                font-size: <?php echo $settings->btn_font_size['small']; ?>px;
                line-height: <?php echo $settings->btn_font_size['small'] + 2; ?>px;
                <?php endif; ?>

                <?php if( $settings->btn_line_height['small'] != '' ) : ?>
                line-height: <?php echo $settings->btn_line_height['small']; ?>px;
                <?php endif; ?>
            }
            <?php } ?>

            <?php if ( $settings->modal_on == 'text' ) { ?>
            .fl-node-<?php echo $id; ?> .uabb-modal-action {
                <?php if( $settings->font_size['small'] != '' ) : ?>
                font-size: <?php echo $settings->font_size['small']; ?>px;
                line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
                <?php endif; ?>

                <?php if( $settings->line_height['small'] != '' ) : ?>
                line-height: <?php echo $settings->line_height['small']; ?>px;
                <?php endif; ?>
            }
            <?php } ?>

            <?php if (  $settings->content_type == 'content' ) { ?> 
            .uamodal-<?php echo $id; ?> .uabb-modal-text {
                <?php if( $settings->ct_content_font_size['small'] != '' ) : ?>
                font-size: <?php echo $settings->ct_content_font_size['small']; ?>px;
                line-height: <?php echo $settings->ct_content_font_size['small'] + 2; ?>px;
                <?php endif; ?>
                    
                <?php if( $settings->ct_content_line_height['small'] != '' ) : ?>
                line-height: <?php echo $settings->ct_content_line_height['small']; ?>px;
                <?php endif; ?>
            }
            <?php } ?>

            <?php if (  $settings->enable_title ) { ?> 
            .uamodal-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-modal-title {
                <?php if( $settings->title_font_size['small'] != '' ) : ?>
                font-size: <?php echo $settings->title_font_size['small']; ?>px;
                line-height: <?php echo $settings->title_font_size['small'] + 2; ?>px;
                <?php endif; ?>
                    
                <?php if( $settings->title_line_height['small'] != '' ) : ?>
                line-height: <?php echo $settings->title_line_height['small']; ?>px;
                <?php endif; ?>
            }
            <?php } ?>
        }       
    <?php
    }
}
