<?php

$settings->title_background_color = UABB_Helper::uabb_colorpicker( $settings, 'title_background_color', true );
$settings->img_background_color = UABB_Helper::uabb_colorpicker( $settings, 'img_background_color', true );

$settings->title_typography_color = UABB_Helper::uabb_colorpicker( $settings, 'title_typography_color' );
$settings->desc_typography_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_typography_color' );
$settings->img_overlay_color = UABB_Helper::uabb_colorpicker( $settings, 'img_overlay_color', true );

?>

<?php
if( $settings->img_overlay_color != '' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-module-content.uabb-ib2-outter:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: <?php echo $settings->img_overlay_color; ?>;
}
<?php
}
?>

.fl-node-<?php echo $id; ?> .fl-node-content .uabb-new-ib {
    <?php echo ( $settings->banner_height != '' ) ? 'height: ' . $settings->banner_height . 'px;' : ''; ?>
}

.fl-node-<?php echo $id; ?> .fl-node-content {
    overflow: hidden;
}

.fl-node-<?php echo $id; ?> .fl-node-content .uabb-new-ib:before {
    <?php echo ( $settings->img_background_color != '' ) ? 'background-color: ' . $settings->img_background_color . ';' : ''; ?>
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    content: '';
    opacity: 0;
    transition: opacity 0.35s, transform 0.35s;
    z-index: 1;
}

.fl-node-<?php echo $id; ?> .uabb-new-ib.uabb-ib2-hover:before {
    opacity: 1;
    transition: opacity 0.35s, transform 0.35s;
}

.fl-node-<?php echo $id; ?> .uabb-new-ib-content {
    color: <?php echo uabb_theme_text_color( $settings->desc_typography_color ); ?>;
    <?php
    if( $settings->desc_typography_font_family['family'] != 'Default' ){
        UABB_Helper::uabb_font_css( $settings->desc_typography_font_family );
    }
    
    echo ( $settings->desc_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->desc_typography_line_height['desktop'] . 'px;' : '';
    echo ( $settings->desc_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->desc_typography_font_size['desktop'] . 'px;' : '';
    ?>
}

.fl-node-<?php echo $id; ?> <?php echo $settings->title_typography_tag_selection; ?>.uabb-new-ib-title {
    <?php echo ( $settings->title_typography_color != '' ) ? 'color: ' . $settings->title_typography_color . ';' : ''; ?>
    <?php
    if( $settings->title_typography_font_family['family'] != 'Default' ){
        UABB_Helper::uabb_font_css( $settings->title_typography_font_family );
    }

    echo ( $settings->title_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->title_typography_line_height['desktop'] . 'px;' : '';
    echo ( $settings->title_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->title_typography_font_size['desktop'] . 'px;' : '';
    ?>
}

/*.fl-node-<?php //echo $id; ?> .uabb-new-ib.uabb-ib2-hover .uabb-new-ib-img {
    opacity: <?php //echo ( $settings->hover_opacity / 100 ); ?>;
}

.fl-node-<?php //echo $id; ?> .uabb-new-ib .uabb-new-ib-img {
    opacity: <?php //echo ( $settings->opacity / 100 ); ?>;
}*/

<?php
if( $settings->banner_style == 'style5' ) {
?>
    .fl-node-<?php echo $id; ?> .uabb-ib-effect-style5 .uabb-new-ib-desc {
        background: <?php echo uabb_theme_base_color( $settings->title_background_color ); ?>;
    }
    <?php
}

if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
 
        .fl-node-<?php echo $id; ?> .uabb-new-ib-content {
            <?php
            echo ( $settings->desc_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->desc_typography_line_height['medium'] . 'px;' : '';
            echo ( $settings->desc_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->desc_typography_font_size['medium'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> <?php echo $settings->title_typography_tag_selection; ?>.uabb-new-ib-title {
            <?php
            echo ( $settings->title_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->title_typography_line_height['medium'] . 'px;' : '';
            echo ( $settings->title_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->title_typography_font_size['medium'] . 'px;' : '';
            ?>
        }
    }
 
     @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
        .fl-node-<?php echo $id; ?> .uabb-new-ib-content {
            <?php
            echo ( $settings->desc_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->desc_typography_line_height['small'] . 'px;' : '';
            echo ( $settings->desc_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->desc_typography_font_size['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> <?php echo $settings->title_typography_tag_selection; ?>.uabb-new-ib-title {
            <?php
            echo ( $settings->title_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->title_typography_line_height['small'] . 'px;' : '';
            echo ( $settings->title_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->title_typography_font_size['small'] . 'px;' : '';
            ?>
        }
    }
<?php
}
?>