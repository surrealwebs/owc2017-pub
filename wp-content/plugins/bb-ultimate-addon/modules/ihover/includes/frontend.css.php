<?php
$settings->title_margin_top = trim($settings->title_margin_top) != '' ? $settings->title_margin_top : '5';
$settings->title_margin_bottom = trim($settings->title_margin_bottom) != '' ? $settings->title_margin_bottom : '5';
$settings->separator_margin_top = trim($settings->separator_margin_top) != '' ? $settings->separator_margin_top : '7';
$settings->separator_margin_bottom = trim($settings->separator_margin_bottom) != '' ? $settings->separator_margin_bottom : '7';
$settings->desc_margin_top = trim($settings->desc_margin_top) != '' ? $settings->desc_margin_top : '5';
$settings->desc_margin_bottom = trim($settings->desc_margin_bottom) != '' ? $settings->desc_margin_bottom : '5';

?>

<?php $height_width = ( $settings->height_width_options == 'custom' ) ? $settings->height_width : '250'; ?>

<?php
if( count( $settings->ihover_item ) > 0 ) {
    for( $i = 0; $i < count( $settings->ihover_item ); $i++ ) {
        if( is_object( $settings->ihover_item[$i] ) ) {

            $settings->ihover_item[$i]->title_color = UABB_Helper::uabb_colorpicker( $settings->ihover_item[$i], 'title_color' );
            $settings->ihover_item[$i]->description_color = UABB_Helper::uabb_colorpicker( $settings->ihover_item[$i], 'description_color' );
            $settings->ihover_item[$i]->separator_color = UABB_Helper::uabb_colorpicker( $settings->ihover_item[$i], 'separator_color' );
            $settings->ihover_item[$i]->separator_color = ( $settings->ihover_item[$i]->separator_color != '' ) ? $settings->ihover_item[$i]->separator_color : '#fafafa';

            $settings->ihover_item[$i]->border_color = UABB_Helper::uabb_colorpicker( $settings->ihover_item[$i], 'border_color', true );
            $settings->ihover_item[$i]->border_color = ( $settings->ihover_item[$i]->border_color != '' ) ? $settings->ihover_item[$i]->border_color : '#EFEFEF';

            $settings->ihover_item[$i]->background_color = UABB_Helper::uabb_colorpicker( $settings->ihover_item[$i], 'background_color', true );

            if( $settings->ihover_item[$i]->border_style != 'none' ) {
            ?>
            .fl-node-<?php echo $id; ?> .uabb-ih-item-<?php echo $i; ?> .uabb-ih-wrapper {
                border-style: <?php echo $settings->ihover_item[$i]->border_style; ?>;
                border-width: <?php echo $settings->ihover_item[$i]->border_size; ?>px;
                border-color: <?php echo $settings->ihover_item[$i]->border_color; ?>;
            }
            <?php
            }
            ?>
            .fl-node-<?php echo $id; ?> .uabb-ih-item-<?php echo $i; ?> .uabb-ih-info-back {
                background-color: <?php echo uabb_theme_base_color( $settings->ihover_item[$i]->background_color ); ?>;
            }
            <?php
            if( $settings->ihover_item[$i]->title_color!= '' ) {
            ?>
                .fl-node-<?php echo $id; ?> .uabb-ih-item-<?php echo $i; ?> .uabb-ih-heading,
                .fl-node-<?php echo $id; ?> .uabb-ih-item-<?php echo $i; ?> a.uabb-ih-link .uabb-ih-heading {
                    <?php
                    echo ( $settings->ihover_item[$i]->title_color != '' ) ? 'color:' . $settings->ihover_item[$i]->title_color . ';' : '';
                    ?>
                }
            <?php
            }

            ?>
            .fl-node-<?php echo $id; ?> .uabb-ih-item-<?php echo $i; ?> .uabb-ih-description,
            .fl-node-<?php echo $id; ?> .uabb-ih-item-<?php echo $i; ?> a .uabb-ih-description {
                color: <?php echo uabb_theme_text_color( $settings->ihover_item[$i]->description_color ); ?>;
            }

            .fl-node-<?php echo $id; ?> .uabb-ih-content {
                <?php echo $settings->content_padding; ?>
            }
            <?php
            if( $settings->ihover_item[$i]->separator_style != 'none' ) {
            ?>
                .fl-node-<?php echo $id; ?> .uabb-ih-item-<?php echo $i; ?> .uabb-ih-line {
                    border-top-style: <?php echo $settings->ihover_item[$i]->separator_style; ?>;
                    border-top-color: <?php echo $settings->ihover_item[$i]->separator_color; ?>;
                    width: <?php echo $settings->ihover_item[$i]->separator_width; ?>%;
                    height: <?php echo $settings->ihover_item[$i]->separator_size; ?>px;
                    border-top-width: <?php echo $settings->ihover_item[$i]->separator_size; ?>px;
                }

            <?php
            }
        }
    }
}
?>

.fl-node-<?php echo $id; ?> .uabb-ih-container ul.uabb-ih-list li.uabb-ih-list-item {
    margin: <?php echo ( $settings->spacing / 2 ); ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-align-<?php echo $settings->align; ?> {
    text-align: <?php echo $settings->align; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-ih-image-block,
.fl-node-<?php echo $id; ?> .uabb-ih-item,
.fl-node-<?php echo $id; ?> .uabb-ih-list-item {
    height: <?php echo $height_width; ?>px;
    width: <?php echo $height_width; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-ih-heading,
.fl-node-<?php echo $id; ?> a.uabb-ih-link .uabb-ih-heading {
    <?php
    if( $settings->title_typography_font_family['family'] != 'Default' ) {
        UABB_Helper::uabb_font_css( $settings->title_typography_font_family );
    }
    
    echo ( $settings->title_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->title_typography_font_size['desktop'] . 'px;' : '';
    echo ( $settings->title_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->title_typography_line_height['desktop'] . 'px;' : '';
    echo 'margin-top: ' . $settings->title_margin_top . 'px;';
    echo 'margin-bottom: ' . $settings->title_margin_bottom . 'px;';       
    ?>
}

<?php if( $settings->desc_typography_font_family['family'] != 'Default' || $settings->desc_typography_font_size['desktop'] != '' || $settings->desc_typography_line_height['desktop'] != '' ) { ?>
    .fl-node-<?php echo $id; ?> .uabb-ih-description,
    .fl-node-<?php echo $id; ?> a .uabb-ih-description {
        <?php
        if( $settings->desc_typography_font_family['family'] != 'Default' ) {
            UABB_Helper::uabb_font_css( $settings->desc_typography_font_family );
        }
        echo ( $settings->desc_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->desc_typography_font_size['desktop'] . 'px;' : '';
        echo ( $settings->desc_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->desc_typography_line_height['desktop'] . 'px;' : '';
        ?>
    }
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-ih-description-block {
    margin-top: <?php echo $settings->desc_margin_top; ?>px;
    margin-bottom: <?php echo $settings->desc_margin_bottom; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-ih-divider-block {
    margin-top: <?php echo $settings->separator_margin_top; ?>px;
    margin-bottom: <?php echo $settings->separator_margin_bottom; ?>px;
}

<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
        <?php
        if( $settings->responsive_size == 'yes' ) {
        ?>
        .fl-node-<?php echo $id; ?> .uabb-ih-image-block,
        .fl-node-<?php echo $id; ?> .uabb-ih-item,
        .fl-node-<?php echo $id; ?> .uabb-ih-list-item {
            height: <?php echo $settings->height_width_responsive; ?>px;
            width: <?php echo $settings->height_width_responsive; ?>px;
        }
        <?php
        }
        ?>

        .fl-node-<?php echo $id; ?> .uabb-ih-description,
        .fl-node-<?php echo $id; ?> a .uabb-ih-description {
            <?php
            echo ( $settings->desc_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->desc_typography_line_height['medium'] . 'px;' : '';
            echo ( $settings->desc_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->desc_typography_font_size['medium'] . 'px;' : '';
            ?>
        }


        .fl-node-<?php echo $id; ?> .uabb-ih-heading,
        .fl-node-<?php echo $id; ?> a.uabb-ih-link .uabb-ih-heading {
            <?php
            echo ( $settings->title_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->title_typography_line_height['medium'] . 'px;' : '';
            echo ( $settings->title_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->title_typography_font_size['medium'] . 'px;' : '';
            ?>
        }
    }
 
     @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

        .fl-node-<?php echo $id; ?> .uabb-ih-description,
        .fl-node-<?php echo $id; ?> a .uabb-ih-description {
            <?php
            echo ( $settings->desc_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->desc_typography_line_height['small'] . 'px;' : '';
            echo ( $settings->desc_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->desc_typography_font_size['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-ih-heading,
        .fl-node-<?php echo $id; ?> a.uabb-ih-link .uabb-ih-heading {
            <?php
            echo ( $settings->title_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->title_typography_line_height['small'] . 'px;' : '';
            echo ( $settings->title_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->title_typography_font_size['small'] . 'px;' : '';
            ?>
        }

        <?php
        if( $settings->responsive_size == 'yes' ) {
        ?>
        .fl-node-<?php echo $id; ?> .uabb-ih-image-block,
        .fl-node-<?php echo $id; ?> .uabb-ih-item,
        .fl-node-<?php echo $id; ?> .uabb-ih-list-item {
            <?php
            echo ( $settings->height_width_responsive != '' ) ? 'height: ' . $settings->height_width_responsive . 'px;' : '';
            echo ( $settings->height_width_responsive != '' ) ? 'width: ' . $settings->height_width_responsive . 'px;' : '';
            ?>
            max-width: 100%;
        }
        <?php
        }
        ?>
    }
<?php
}
?>