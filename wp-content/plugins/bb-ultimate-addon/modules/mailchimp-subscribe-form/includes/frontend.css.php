<?php

$settings->background_color = UABB_Helper::uabb_colorpicker( $settings, 'background_color', true );
$settings->input_text_color = UABB_Helper::uabb_colorpicker( $settings, 'input_text_color' );
$settings->input_background_color = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
$settings->border_color = UABB_Helper::uabb_colorpicker( $settings, 'border_color' );
$settings->border_active_color = UABB_Helper::uabb_colorpicker( $settings, 'border_active_color' );
$settings->heading_color = UABB_Helper::uabb_colorpicker( $settings, 'heading_color');
$settings->subheading_color = UABB_Helper::uabb_colorpicker( $settings, 'subheading_color');
$settings->text_color = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );

$settings->spacing = ( $settings->spacing != '' ) ? $settings->spacing : '10';


FLBuilder::render_module_css('uabb-button', $id, array(

        'text' => $settings->btn_text,
        'icon' => $settings->btn_icon,
        'icon_position' => $settings->btn_icon_position,
        'style'             => $settings->btn_style,
        'border_size'       => $settings->btn_border_size,
        'transparent_button_options' => $settings->btn_transparent_button_options,
        'threed_button_options'      => $settings->btn_threed_button_options,
        'flat_button_options'        => $settings->btn_flat_button_options,
        'bg_color'          => $settings->btn_bg_color,
        'bg_color_opc'          => $settings->btn_bg_color_opc,
        'bg_hover_color'    => $settings->btn_bg_hover_color,
        'bg_hover_color_opc'    => $settings->btn_bg_hover_color_opc,
        'text_color'        => $settings->btn_text_color,
        'text_hover_color'  => $settings->btn_text_hover_color,
        'hover_attribute'   => $settings->hover_attribute,
        'width'              => $settings->btn_width,
        'custom_width'       => $settings->btn_custom_width,
        'custom_height'      => $settings->btn_custom_height,
        'padding_top_bottom' => $settings->btn_padding_top_bottom,
        'padding_left_right' => $settings->btn_padding_left_right,
        'border_radius'      => $settings->btn_border_radius,
        'align'             => '',
        'mob_align'          => '',
        'font_family' => $settings->btn_font_family,
        'font_size' => $settings->btn_font_size,
        'line_height' => $settings->btn_line_height,
));
?>

.fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-field {
    margin: 0;
    padding-right: <?php echo $settings->spacing / 2; ?>px;
    padding-left: <?php echo $settings->spacing / 2; ?>px;
    <?php
    $width_division = ( 'yes' == $settings->show_fname && 'yes' == $settings->show_lname ) ? 4 : ( ( 'yes' == $settings->show_fname || 'yes' == $settings->show_lname ) ? 3 : 2 );
    echo 'width: ' . ( 100 / $width_division ) . '%;';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-subscribe-form-stacked .uabb-form-error-message {
    right : <?php echo ( $settings->horizontal_padding > 15 ) ? $settings->horizontal_padding : '15'; ?>px
}

.fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-error-message {
    right : <?php echo (( $settings->horizontal_padding > 15 ) ? $settings->horizontal_padding : '15') + $settings->spacing / 2; ?>px
}

/* .fl-node-<?php //echo $id; ?> .uabb-subscribe-form-inline .uabb-form-error-message {
    right: <?php //echo $settings->spacing + 5 : '15'; ?>px;
}*/

.fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-button {
    padding-right: <?php echo $settings->spacing / 2; ?>px;
    padding-left: <?php echo $settings->spacing / 2; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap {
    margin: 0 -<?php echo $settings->spacing / 2; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-subscribe-form-stacked .uabb-form-field {
    margin-bottom: <?php echo $settings->spacing; ?>px;
}

<?php
if( $settings->btn_margin_top != '' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-subscribe-form-stacked .uabb-form-button {
    margin-top: <?php echo $settings->btn_margin_top; ?>px;
}
<?php 
}
?>

<?php if( $settings->btn_width == 'full' ) : ?>
.fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-button {
    <?php
    $width_division = ( 'yes' == $settings->show_fname && 'yes' == $settings->show_lname ) ? 4 : ( ( 'yes' == $settings->show_fname || 'yes' == $settings->show_lname ) ? 3 : 2 );
    echo 'width: ' . ( 100 / $width_division ) . '%;';
    ?>
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> <?php echo $settings->heading_tag_selection; ?>.uabb-sf-heading {
    <?php if( $settings->heading_font_family['family'] != "Default") : ?>
            <?php UABB_Helper::uabb_font_css( $settings->heading_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->heading_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->heading_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->heading_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->heading_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->heading_color != '' ) : ?>
    color: <?php echo $settings->heading_color; ?>;
    <?php endif; ?>

    margin-bottom: <?php echo ( $settings->heading_margin_bottom != '' ) ? $settings->heading_margin_bottom : '0' ?>px;
}

.fl-node-<?php echo $id; ?> <?php echo $settings->subheading_tag_selection; ?>.uabb-sf-subheading {
    <?php if( $settings->subheading_font_family['family'] != "Default") : ?>
            <?php UABB_Helper::uabb_font_css( $settings->subheading_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->subheading_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->subheading_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->subheading_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->subheading_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->subheading_color != '' ) : ?>
    color: <?php echo $settings->subheading_color; ?>;
    <?php endif; ?>

    margin-bottom: <?php echo ( $settings->subheading_margin_bottom != '' ) ? $settings->subheading_margin_bottom : '20' ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-form-field input[type="text"],
.fl-node-<?php echo $id; ?> .uabb-form-field input[type="text"] ~ label {
    <?php if( $settings->input_font_family['family'] != "Default") : ?>
            <?php UABB_Helper::uabb_font_css( $settings->input_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->input_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->input_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->input_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->input_line_height['desktop']; ?>px;
    <?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field input:focus + label,
.fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field.open > label {
    <?php if( $settings->input_font_size['desktop'] != '' ) : ?>
    -webkit-transform: translateY(-<?php echo  $settings->input_font_size['desktop'] + 10; ?>px);
    -ms-transform: translateY(-<?php echo  $settings->input_font_size['desktop'] + 10; ?>px);
    transform: translateY(-<?php echo  $settings->input_font_size['desktop'] + 10; ?>px);
    <?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-sf-bottom-text {
    <?php if( $settings->text_font_family['family'] != "Default") : ?>
            <?php UABB_Helper::uabb_font_css( $settings->text_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->text_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->text_font_size['desktop']; ?>px;
    line-height: <?php echo $settings->text_font_size['desktop'] + 2; ?>px;
    <?php endif; ?>

    <?php if( $settings->text_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->text_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->text_color != '' ) : ?>
    color: <?php echo $settings->text_color; ?>;
    <?php endif; ?>

    margin-top: <?php echo ( $settings->text_margin_top != '' ) ? $settings->text_margin_top : '20' ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-subscribe-form {
    <?php echo $settings->padding; ?>
    <?php echo ( $settings->background_color != '' ) ? 'background: ' . $settings->background_color . ';' : ''; ?>
    text-align: <?php echo $settings->overall_alignment; ?>;
}

<?php if( $settings->form_style == 'style1' ) { ?>

.fl-node-<?php echo $id; ?> .uabb-sf-style-style1 .uabb-form-field input,
.fl-node-<?php echo $id; ?> .uabb-sf-style-style1 .uabb-form-field input:focus,
.fl-node-<?php echo $id; ?> .uabb-sf-style-style1 .uabb-form-field textarea {
    <?php
    echo ( $settings->input_text_color != '' ) ? 'color: ' . $settings->input_text_color . ';' : '';
    echo ( $settings->input_background_color != '' ) ? 'background: ' . $settings->input_background_color . ';' : '';
    echo ( $settings->border_color != '' ) ? 'border-color: ' . $settings->border_color . ';' : '';
    echo ( $settings->border_width != '' ) ? 'border-width: ' . $settings->border_width . 'px;' : 'border-width: 1px;';
    ?>
    border-radius: 0;
    padding: <?php echo ( $settings->vertical_padding != '' ) ? $settings->vertical_padding : '12'; ?>px <?php echo ( $settings->horizontal_padding != '' ) ? $settings->horizontal_padding : '15'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-sf-style-style1 .uabb-form-field input::-webkit-input-placeholder {
    <?php
    echo ( $settings->input_text_color != '' ) ? 'color: ' . $settings->input_text_color . ';' : '';
    ?>
}

<?php } ?>

<?php if( $settings->form_style == 'style2' ) { ?>

.fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field label {
    <?php
    echo ( $settings->input_text_color != '' ) ? 'color: ' . $settings->input_text_color . ';' : '';
    ?>
    bottom: <?php echo ( $settings->vertical_padding != '' ) ? $settings->vertical_padding : '12'; ?>px;
    
    <?php if( $settings->layout == 'inline' ) { ?>
    left: <?php echo (( $settings->horizontal_padding != '' ) ? $settings->horizontal_padding : '15') + $settings->spacing / 2; ?>px;
    <?php } else { ?>
    left: <?php echo (( $settings->horizontal_padding != '' ) ? $settings->horizontal_padding : '15'); ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field input,
.fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field input:focus,
.fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field textarea {
    <?php
    echo ( $settings->input_text_color != '' ) ? 'color: ' . $settings->input_text_color . ';' : '';
    echo ( $settings->border_color != '' ) ? 'border-color: ' . $settings->border_color . ';' : '';
    echo ( $settings->border_width != '' ) ? 'border-width: ' . $settings->border_width . 'px;' : 'border-width: 1px;';
    ?>
    padding: <?php echo ( $settings->vertical_padding != '' ) ? $settings->vertical_padding : '12'; ?>px <?php echo ( $settings->horizontal_padding != '' ) ? $settings->horizontal_padding : '15'; ?>px;
}

<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-subscribe-form .uabb-form-field input:focus,
.fl-node-<?php echo $id; ?> .uabb-subscribe-form .uabb-form-field input:active {
    <?php
    echo ( $settings->border_active_color != '' ) ? 'border-color: ' . $settings->border_active_color . ';' : '';
    ?>
}

<?php if( $settings->overall_alignment == 'left' ) : ?>
.fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
}
<?php elseif( $settings->overall_alignment == 'right' ) : ?>
.fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
}
<?php endif; ?>
<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

        .fl-node-<?php echo $id; ?> <?php echo $settings->heading_tag_selection; ?>.uabb-sf-heading {
            <?php if( $settings->heading_font_size['medium'] != '' ) : ?>
            font-size: <?php echo $settings->heading_font_size['medium']; ?>px;
            <?php endif; ?>

            <?php if( $settings->heading_line_height['medium'] != '' ) : ?>
            line-height: <?php echo $settings->heading_line_height['medium']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> <?php echo $settings->subheading_tag_selection; ?>.uabb-sf-subheading {
            <?php if( $settings->subheading_font_size['medium'] != '' ) : ?>
            font-size: <?php echo $settings->subheading_font_size['medium']; ?>px;
            <?php endif; ?>

            <?php if( $settings->subheading_line_height['medium'] != '' ) : ?>
            line-height: <?php echo $settings->subheading_line_height['medium']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-sf-bottom-text {
            <?php if( $settings->text_font_size['medium'] != '' ) : ?>
            font-size: <?php echo $settings->text_font_size['medium']; ?>px;
            <?php endif; ?>

            <?php if( $settings->text_line_height['medium'] != '' ) : ?>
            line-height: <?php echo $settings->text_line_height['medium']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-form-field input[type="text"],
        .fl-node-<?php echo $id; ?> .uabb-form-field input[type="text"] ~ label {
            <?php if( $settings->input_font_size['medium'] != '' ) : ?>
            font-size: <?php echo $settings->input_font_size['medium']; ?>px;
            <?php endif; ?>

            <?php if( $settings->input_line_height['medium'] != '' ) : ?>
            line-height: <?php echo $settings->input_line_height['medium']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field input:focus + label,
        .fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field.open > label {
            <?php if( $settings->input_font_size['medium'] != '' ) : ?>
            -webkit-transform: translateY(-<?php echo  $settings->input_font_size['medium'] + 10; ?>px);
            -ms-transform: translateY(-<?php echo  $settings->input_font_size['medium'] + 10; ?>px);
            transform: translateY(-<?php echo  $settings->input_font_size['medium'] + 10; ?>px);
            <?php endif; ?>
        }

        <?php if( $settings->layout == 'inline' && $settings->responsive == 'small_medium' ) : ?>
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-field {
            float: none;
            padding-left: 0;
            padding-right: 0;
            width: 100%;
            margin-bottom: <?php echo ( $settings->res_spacing != '' ) ? $settings->res_spacing : '10'; ?>px;
        }
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap {
            margin: 0;
        }
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-error-message {
            right : <?php echo ( $settings->horizontal_padding > 15 ) ? $settings->horizontal_padding : '15'; ?>px
        }
        .fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field label {
           left: <?php echo (( $settings->horizontal_padding != '' ) ? $settings->horizontal_padding : '15'); ?>px;
        }
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-button {
            float: none;
            width: auto;
            padding: 0;
            <?php if( $settings->btn_width == 'full' ) : ?>
                display: block;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
            display: block;
        }

        <?php if( $settings->resp_overall_alignment != 'default' ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-subscribe-form {
                text-align: <?php echo $settings->resp_overall_alignment; ?>;
            }

            <?php if( $settings->resp_overall_alignment == 'left' ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
                -webkit-box-pack: start;
                -ms-flex-pack: start;
                justify-content: flex-start;
            }
            <?php elseif( $settings->resp_overall_alignment == 'right' ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
                -webkit-box-pack: end;
                -ms-flex-pack: end;
                justify-content: flex-end;
            }
            <?php endif; ?>
        <?php endif; ?>
        
        <?php endif; ?>
    }
 
    @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

        .fl-node-<?php echo $id; ?> <?php echo $settings->heading_tag_selection; ?>.uabb-sf-heading {
            <?php if( $settings->heading_font_size['small'] != '' ) : ?>
            font-size: <?php echo $settings->heading_font_size['small']; ?>px;
            <?php endif; ?>

            <?php if( $settings->heading_line_height['small'] != '' ) : ?>
            line-height: <?php echo $settings->heading_line_height['small']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> <?php echo $settings->subheading_tag_selection; ?>.uabb-sf-subheading {
            <?php if( $settings->subheading_font_size['small'] != '' ) : ?>
            font-size: <?php echo $settings->subheading_font_size['small']; ?>px;
            line-height: <?php echo $settings->subheading_font_size['small'] + 2; ?>px;
            <?php endif; ?>

            <?php if( $settings->subheading_line_height['small'] != '' ) : ?>
            line-height: <?php echo $settings->subheading_line_height['small']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-sf-bottom-text {
            <?php if( $settings->text_font_size['small'] != '' ) : ?>
            font-size: <?php echo $settings->text_font_size['small']; ?>px;
            <?php endif; ?>

            <?php if( $settings->text_line_height['small'] != '' ) : ?>
            line-height: <?php echo $settings->text_line_height['small']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-form-field input[type="text"],
        .fl-node-<?php echo $id; ?> .uabb-form-field input[type="text"] ~ label {
            <?php if( $settings->input_font_size['small'] != '' ) : ?>
            font-size: <?php echo $settings->input_font_size['small']; ?>px;
            <?php endif; ?>

            <?php if( $settings->input_line_height['small'] != '' ) : ?>
            line-height: <?php echo $settings->input_line_height['small']; ?>px;
            <?php endif; ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field input:focus + label,
        .fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field.open > label {
            <?php if( $settings->input_font_size['medium'] != '' ) : ?>
            -webkit-transform: translateY(-<?php echo  $settings->input_font_size['small'] + 10; ?>px);
            -ms-transform: translateY(-<?php echo  $settings->input_font_size['small'] + 10; ?>px);
            transform: translateY(-<?php echo  $settings->input_font_size['small'] + 10; ?>px);
            <?php endif; ?>
        }

        <?php if( $settings->layout == 'inline' && $settings->responsive == 'small' ) : ?>

        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-field {
            float: none;
            padding-left: 0;
            padding-right: 0;
            width: 100%;
            margin-bottom: <?php echo ( $settings->res_spacing != '' ) ? $settings->res_spacing : '10'; ?>px;
        }
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap {
            margin: 0;
        }
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-error-message {
            right : <?php echo ( $settings->horizontal_padding > 15 ) ? $settings->horizontal_padding : '15'; ?>px
        }
        .fl-node-<?php echo $id; ?> .uabb-sf-style-style2 .uabb-form-field label {
           left: <?php echo (( $settings->horizontal_padding != '' ) ? $settings->horizontal_padding : '15'); ?>px;
        }
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-button {
            float: none;
            width: auto;
            padding: 0;
            <?php if( $settings->btn_width == 'full' ) : ?>
                display: block;
            <?php endif; ?>
        }
        .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
            display: block;
        }
        <?php endif; ?>

        <?php if( $settings->resp_overall_alignment != 'default' && ($settings->layout == 'stacked' || $settings->layout != 'small_medium') ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-subscribe-form {
                text-align: <?php echo $settings->resp_overall_alignment; ?>;
            }
            <?php if( $settings->resp_overall_alignment == 'left' ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
                -webkit-box-pack: start;
                -ms-flex-pack: start;
                justify-content: flex-start;
            }
            <?php elseif( $settings->resp_overall_alignment == 'right' ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-subscribe-form-inline .uabb-form-wrap { 
                -webkit-box-pack: end;
                -ms-flex-pack: end;
                justify-content: flex-end;
            }
            <?php endif; ?>
        <?php endif; ?>
    }
<?php
}
?>