<?php 
	$settings->form_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );

    $settings->input_background_color = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
    $settings->input_border_color = UABB_Helper::uabb_colorpicker( $settings, 'input_border_color' );
    $settings->input_border_active_color = UABB_Helper::uabb_colorpicker( $settings, 'input_border_active_color' );
    
    $settings->btn_text_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color' );
    $settings->btn_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color' );
    $settings->btn_background_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_color', true );
    $settings->btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_hover_color', true );

    /* Typography Colors */

    $settings->form_title_color = UABB_Helper::uabb_colorpicker( $settings, 'form_title_color' );
    $settings->form_desc_color = UABB_Helper::uabb_colorpicker( $settings, 'form_desc_color' );
    
    $settings->label_color = UABB_Helper::uabb_colorpicker( $settings, 'label_color' );
    /* Input Color */
    $settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
    
    $settings->input_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'input_msg_color' );
    $settings->validation_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_msg_color' );
    $settings->validation_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_bg_color', true );
    
    $settings->validation_border_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_border_color' );
    $settings->input_padding = ( isset($settings->input_padding) && $settings->input_padding != '' ) ? $settings->input_padding : 10;
    $settings->radio_check_size = ( isset($settings->radio_check_size) && $settings->radio_check_size != '' ) ? $settings->radio_check_size : 20;
    $settings->radio_check_border_width = ( isset($settings->radio_check_border_width) && $settings->radio_check_border_width != '' ) ? $settings->radio_check_border_width : 1;
    $settings->radio_btn_border_radius = ( isset($settings->radio_btn_border_radius) && $settings->radio_btn_border_radius != '' ) ? $settings->radio_btn_border_radius : 50;
    $settings->input_border_radius = ( isset($settings->input_border_radius) && $settings->input_border_radius != '' ) ? $settings->input_border_radius : 0;
    $settings->checkbox_border_radius = ( isset($settings->checkbox_border_radius) && $settings->checkbox_border_radius != '' ) ? $settings->checkbox_border_radius : 0;
    $settings->input_msg_font_size = ( isset($settings->input_msg_font_size) && $settings->input_msg_font_size != '' ) ? $settings->input_msg_font_size : 12;
    $settings->validation_msg_font_size = ( isset($settings->validation_msg_font_size) && $settings->validation_msg_font_size != '' ) ? $settings->validation_msg_font_size : 15;
?>
.fl-node-<?php echo $id; ?> {
	width: 100%;
}


/* Form Style */
.fl-node-<?php echo $id; ?> .uabb-cf7-style {
	<?php if ( $settings->form_bg_type == 'color' ) { ?>
		background-color: <?php echo $settings->form_bg_color; ?>;
	<?php }elseif ( $settings->form_bg_type == 'image' && isset( FLBuilderPhoto::get_attachment_data($settings->form_bg_img)->url ) ) { ?>
		background-image: url(<?php echo FLBuilderPhoto::get_attachment_data($settings->form_bg_img)->url; ?>);
		background-position: <?php echo $settings->form_bg_img_pos; ?>;
		background-size: <?php echo $settings->form_bg_img_size; ?>;
		background-repeat: <?php echo $settings->form_bg_img_repeat; ?>;
	<?php }elseif( $settings->form_bg_type == 'gradient' ) { ?>
		<?php UABB_Helper::uabb_gradient_css( $settings->form_bg_gradient ); ?>
	<?php } ?>
	<?php if ( $settings->form_spacing != ''  ) { ?>
		<?php echo $settings->form_spacing; ?>;
	<?php } ?>
	<?php if ( $settings->form_radius != ''  ) { ?>
		border-radius:<?php echo $settings->form_radius; ?>px;
	<?php } ?>

}

/* Input Fields CSS */
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style form textarea {
	<?php if ( $settings->input_padding != '' ) { ?>
		<?php echo $settings->input_padding; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea {
	<?php if ( $settings->textarea_height != '' ) { ?>
	height: <?php echo $settings->textarea_height; ?>px;
	<?php } ?>
}


.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style select {
	<?php
    if( $settings->input_field_height != '' ) { ?>
    	height: <?php echo $settings->input_field_height; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus {
    -webkit-appearance: menulist !important;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:focus {
  	<?php if( $settings->input_border_radius != '' ) { ?>
    	border-radius: <?php echo $settings->input_border_radius; ?>px;
    <?php } ?>
    outline: none;
    text-align: <?php echo $settings->input_text_align; ?>;
    color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
    <?php
    $bgcolor = '';
    if ( $settings->input_background_type == 'color' ) {
    	$bgcolor = ( $settings->input_background_color != '' ) ? $settings->input_background_color : '';
    } else {
    	$bgcolor = 'transparent';
    }
    ?>
    background: <?php echo $bgcolor; ?>;
    border-style: solid;
    border-color: <?php echo uabb_theme_text_color( $settings->input_border_color ); ?>;
    <?php
    $str = '';
    if( isset( $settings->uabb_input_border_width ) ) {
		if( is_array( $settings->uabb_input_border_width ) ) {
			if( $settings->uabb_input_border_width['simplify'] == 'collapse' ) {
				if( $settings->uabb_input_border_width['all'] == '' || $settings->uabb_input_border_width['all'] == '0' ) {
					$settings->uabb_input_border_width['all'] = '0';
				}
				$str = $settings->uabb_input_border_width['all'] . 'px';
			} else {

		    	if( $settings->uabb_input_border_width['top'] == '' || $settings->uabb_input_border_width['top'] == '0' ) {
		    		$settings->uabb_input_border_width['top'] = '0';
		    	}
		    	if( $settings->uabb_input_border_width['bottom'] == '' || $settings->uabb_input_border_width['bottom'] == '0' ) {
		    		$settings->uabb_input_border_width['bottom'] = '0';
		    	}
		    	if( $settings->uabb_input_border_width['right'] == '' || $settings->uabb_input_border_width['right'] == '0' ) {
		    		$settings->uabb_input_border_width['right'] = '0';
		    	}
		    	if( $settings->uabb_input_border_width['left'] == '' || $settings->uabb_input_border_width['left'] == '0' ) {
		    		$settings->uabb_input_border_width['left'] = '0';
		    	}

				$str = ( $settings->uabb_input_border_width['top'] != '' ) ? $settings->uabb_input_border_width['top'] . 'px ' : '0 ';
				$str .= ( $settings->uabb_input_border_width['right'] != '' ) ? $settings->uabb_input_border_width['right'] . 'px ' : '0 ';
				$str .= ( $settings->uabb_input_border_width['bottom'] != '' ) ? $settings->uabb_input_border_width['bottom'] . 'px ' : '0 ';
				$str .= ( $settings->uabb_input_border_width['left'] != '' ) ? $settings->uabb_input_border_width['left'] . 'px ' : '0;';
			}
		}
    }
    ?>
    border-width: <?php echo $str; ?>
}

<?php if( $settings->input_border_active_color != '' ) { ?>
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:active,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:active,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:active,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:active,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:active,
.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style select:active,
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:active,
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:focus {
    border-color: <?php echo $settings->input_border_active_color; ?>;
}
<?php } ?>

/* Placeholder Colors */

.fl-node-<?php echo $id; ?> .uabb-cf7-style ::-webkit-input-placeholder {
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style :-moz-placeholder { 		/* Firefox 18- */
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style ::-moz-placeholder {  	/* Firefox 19+ */
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style :-ms-input-placeholder {  
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

<?php
if( $settings->radio_check_custom_option == 'true') { 
    $font_size = $settings->radio_check_size / 1.3;
    ?>
    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'], 
    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] {
        display: none;
    }

    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span:before,
    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span:before {
        content: '';
        background: #<?php echo $settings->radio_check_bgcolor ?>;
        border: <?php echo $settings->radio_check_border_width ?>px solid #<?php echo $settings->radio_check_border_color ?>;
        display: inline-block;
        vertical-align: middle;
        width: <?php echo $settings->radio_check_size ?>px;
        height: <?php echo $settings->radio_check_size ?>px;
        padding: 2px;
        margin-right: 10px;
        text-align: center;
    }

    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox']:checked + span:before {
        content: "\2714";
        font-weight: bold;
        font-size: calc(<?php echo $font_size ?>px - <?php echo $settings->radio_check_border_width ?>px );
        padding-top: 0;
        color: #<?php echo $settings->radio_check_selected_color ?>;
        line-height: 1.3;
    }

    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span:before {
        border-radius: <?php echo $settings->checkbox_border_radius ?>px;
    }

    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio']:checked + span:before {
        background: #<?php echo $settings->radio_check_selected_color ?>;
        box-shadow: inset 0px 0px 0px 4px #<?php echo $settings->radio_check_bgcolor ?>;
    }

    .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span:before {
        border-radius: <?php echo $settings->radio_btn_border_radius ?>px;
    }

<?php 
} ?>

.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span, 
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span {
	<?php if( $settings->radio_check_custom_option == 'true' ) { 
		if( $settings->radio_checkbox_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->radio_checkbox_font_family ); 
		endif;
		if( $settings->radio_checkbox_font_size["desktop"] != '' ) : ?>
			font-size: <?php echo $settings->radio_checkbox_font_size['desktop']; ?>px;
		<?php endif;
		if( $settings->radio_checkbox_color!= '' ) : ?>
			color: #<?php echo $settings->radio_checkbox_color ?>;
		<?php endif;
	} ?>
}

<?php
/* Button CSS */
$settings->btn_background_color = uabb_theme_button_bg_color( $settings->btn_background_color );
$settings->btn_background_hover_color = uabb_theme_button_bg_hover_color( $settings->btn_background_hover_color );
$settings->btn_text_color 		= uabb_theme_button_text_color( $settings->btn_text_color );
$settings->btn_text_hover_color = uabb_theme_button_text_hover_color( $settings->btn_text_hover_color );
$settings->btn_border_width = ( isset( $settings->btn_border_width ) && $settings->btn_border_width != '' ) ? $settings->btn_border_width : '2';

$border_size = $border_color = $border_hover_color = $bg_hover_grad_start = $bg_grad_start = '';
// Border Size & Border Color
if ( $settings->btn_style == 'transparent' ) {
	$border_size = $settings->btn_border_width;
	$border_color = $settings->btn_background_color;
	$border_hover_color =  $settings->btn_background_hover_color ;
}

// Background Gradient
if ( $settings->btn_style == 'gradient' ) {
	if ( ! empty( $settings->btn_background_color ) ) {
		$bg_grad_start = '#'.FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_color ), 30, 'lighten' );
	}
	if ( ! empty( $settings->btn_background_hover_color ) ) {
		$bg_hover_grad_start = '#'.FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_hover_color ), 30, 'lighten' );
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
	<?php if( $settings->btn_align == 'center' ) { ?>
			margin-left: auto;
			margin-right: auto;
	<?php }elseif ( $settings->btn_align == 'right' ) { ?>
			margin-left: auto;
			margin-right: 0;
	<?php } ?>

	<?php if ( $settings->btn_border_radius != '' ) { ?>
		border-radius: <?php echo $settings->btn_border_radius; ?>px;
	<?php } ?>
	
	<?php if ( $settings->btn_style == 'flat' ) { ?>
		background: <?php echo uabb_theme_base_color( $settings->btn_background_color ); ?>;
	<?php }elseif ( $settings->btn_style == 'transparent' ) { ?>
		background-color: rgba(0, 0, 0, 0);
		border-style: solid;
		border-color: <?php echo $border_color; ?>;
		border-width: <?php echo $settings->btn_border_width; ?>px;
	<?php }elseif ( $settings->btn_style == 'gradient' ) { ?>
		background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $settings->btn_background_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $settings->btn_background_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $settings->btn_background_color; ?>',GradientType=0 ); /* IE6-9 */
	<?php }elseif ( $settings->btn_style == '3d' ) { ?>
		position: relative;
		-webkit-transition: none;
		   -moz-transition: none;
				transition: none;
		background: <?php echo uabb_theme_base_color( $settings->btn_background_color ); ?>;
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_color ), 30, 'darken' ); ?>
		box-shadow: 0 6px <?php echo $shadow_color; ?>;
	<?php } ?>

	color: <?php echo uabb_theme_text_color( $settings->btn_text_color ); ?>;
	
	<?php if ( $settings->btn_width == 'full' ) { ?>
		width:100%;
		padding: <?php echo uabb_theme_button_padding( '' ); ?>;
	<?php }elseif( $settings->btn_width == 'custom' ) { 
		
		$padding_top_bottom = ( $settings->btn_padding_top_bottom !== '' ) ? $settings->btn_padding_top_bottom : uabb_theme_button_vertical_padding('');
	?>

		padding-top: <?php echo $padding_top_bottom; ?>px;
		padding-bottom: <?php echo $padding_top_bottom; ?>px;
		<?php if ( $settings->btn_custom_width != ''  ) { ?>
			width: <?php echo $settings->btn_custom_width; ?>px;
		<?php } ?>
		
		<?php if ( $settings->btn_custom_height != ''  ) { ?>
			min-height: <?php echo $settings->btn_custom_height; ?>px;
		<?php } ?>

	<?php } else { ?>
		padding: <?php echo uabb_theme_button_padding( '' ); ?>;
	<?php	} ?>

}


.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit]:hover {
	<?php if ( $settings->btn_style == 'flat' ) { ?>
		<?php if( $settings->btn_text_hover_color != '' ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>

		<?php if( $settings->btn_background_hover_color != '' ) { ?>
		background: <?php echo $settings->btn_background_hover_color; ?>;
		<?php } ?>
	<?php }elseif ( $settings->btn_style == 'transparent' ) { ?>
		<?php if( $settings->btn_text_hover_color != '' ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php }
		if( $settings->hover_attribute == 'border' ) {
		?>
		border-color:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		<?php
		} else {
		?>
		background:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		<?php
		} ?>
		border-style: solid;
		background-clip: padding-box;
		border-color:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		border-width: <?php echo $settings->btn_border_width; ?>px;
	<?php }elseif ( $settings->btn_style == 'gradient' ) { ?>
		<?php if( $settings->btn_text_hover_color != '' ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>

		background: -moz-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%, <?php echo $settings->btn_background_hover_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->btn_background_hover_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->btn_background_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	<?php }elseif ( $settings->btn_style == '3d' ) {
		$shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_hover_color ), 30, 'darken' ); ?>
		top: 2px;
		box-shadow: 0 4px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
		<?php if( $settings->btn_text_hover_color != '' ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>
		<?php if( $settings->btn_background_hover_color != '' ) { ?>
		background: <?php echo $settings->btn_background_hover_color; ?>;
		<?php }
	} ?>
}


.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit]:active {
	<?php if ( $settings->btn_style == '3d' ) { ?>
		top: 6px;
		box-shadow: 0 0px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=file],
.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea {
	<?php echo ( $settings->input_top_margin != '' ) ? 'margin-top: '.$settings->input_top_margin.'px;' : '' ; ?>
	<?php echo ( $settings->input_bottom_margin != '' ) ? 'margin-bottom: '.$settings->input_bottom_margin.'px;' : 'margin-bottom: 10px;'; ?>
}

/* Typography CSS */
.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-title {
	<?php if( $settings->form_title_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->form_title_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->form_title_font_size["desktop"] != '' ) : ?>
	font-size: <?php echo $settings->form_title_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->form_title_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->form_title_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->form_title_color != '' ) : ?>
	color: <?php echo $settings->form_title_color; ?>;
	<?php endif; ?>

	text-align: <?php echo $settings->form_text_align; ?>;
	
	margin: 0 0 <?php echo ( $settings->form_title_bottom_margin != '' ) ? $settings->form_title_bottom_margin : '0'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-desc {
	<?php if( $settings->form_desc_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->form_desc_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->form_desc_font_size["desktop"] != '' ) : ?>
	font-size: <?php echo $settings->form_desc_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->form_desc_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->form_desc_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->form_desc_color != '' ) : ?>
	color: <?php echo $settings->form_desc_color; ?>;
	<?php endif; ?>

	text-align: <?php echo $settings->form_text_align; ?>;

	margin: 0 0 <?php echo ( $settings->form_desc_bottom_margin != '' ) ? $settings->form_desc_bottom_margin : '20'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea {
	
	<?php if( $settings->font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->font_size["desktop"] != '' ) : ?>
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
	<?php $uabb_theme_btn_family = apply_filters( 'uabb/theme/button_font_family', '' ); ?>
	
	<?php if ( uabb_theme_button_letter_spacing('') != '' ) { ?>
	letter-spacing: <?php echo uabb_theme_button_letter_spacing(''); ?>;
	<?php } ?>

	<?php if ( $settings->btn_text_transform != '' ) { ?>
		text-transform: <?php echo $settings->btn_text_transform; ?>;
	<?php } ?>

	<?php if ( uabb_theme_button_text_transform('') != '' ) { ?>
	text-transform: <?php echo uabb_theme_button_text_transform(''); ?>;
	<?php } ?>

	<?php if( $settings->btn_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->btn_font_family ); ?>
	<?php else : ?>
		<?php if( isset( $uabb_theme_btn_family['family'] ) ) { ?>
		font-family: <?php echo $uabb_theme_btn_family['family']; ?>;
		<?php } ?> 
		
		<?php if ( isset( $uabb_theme_btn_family['weight'] ) ) { ?>
		font-weight: <?php echo $uabb_theme_btn_family['weight']; ?>;
		<?php } ?>
	<?php endif; ?>

	<?php if( $settings->btn_font_size["desktop"] != '' ) : ?>
	font-size: <?php echo $settings->btn_font_size['desktop']; ?>px;
	<?php else : ?>
		<?php if ( uabb_theme_button_font_size('') != '' ) { ?>
		font-size: <?php echo uabb_theme_button_font_size(''); ?>;
		<?php } ?>

	<?php endif; ?>

	<?php if( $settings->btn_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
	<?php else : ?>
		<?php if ( uabb_theme_button_line_height('') != '' ) { ?>
		line-height: <?php echo uabb_theme_button_line_height(''); ?>;
		<?php } ?>
	<?php endif; ?>
}

.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7 form.wpcf7-form:not(input) {
	<?php if( $settings->label_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->label_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->label_font_size["desktop"] != '' ) : ?>
	font-size: <?php echo $settings->label_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->label_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->label_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->label_color != '' ) : ?>
	color: <?php echo $settings->label_color; ?>;
	<?php endif; ?>

	text-align: <?php echo $settings->input_text_align; ?>;
}

/* Typography responsive css */
<?php if($global_settings->responsive_enabled) { // Global Setting If started ?>
		<?php
		if( $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" || $settings->btn_font_size['medium'] != "" || $settings->btn_line_height['medium'] != "" || $settings->label_font_size['medium'] != "" || $settings->label_line_height['medium'] != "" || $settings->form_title_font_size['medium'] != "" || $settings->form_title_line_height['medium'] != "" || $settings->radio_checkbox_font_size['medium'] != "" || $settings->form_desc_font_size['medium'] != "" || $settings->form_desc_line_height['medium'] != "") {
		?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-title {
				
				<?php if( $settings->form_title_font_size["medium"] != '' ) : ?>
				font-size: <?php echo $settings->form_title_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->form_title_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->form_title_line_height['medium']; ?>px;
				<?php endif; ?>
			}

			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span, 
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span {
				<?php if( $settings->radio_check_custom_option == 'true' ) { 
					if( $settings->radio_checkbox_font_size["medium"] != '' ) : ?>
						font-size: <?php echo $settings->radio_checkbox_font_size['medium']; ?>px;
					<?php endif;
				} ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-desc {
				
				<?php if( $settings->form_desc_font_size["medium"] != '' ) : ?>
				font-size: <?php echo $settings->form_desc_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->form_desc_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->form_desc_line_height['medium']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {
				
				<?php if( $settings->font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
				
				<?php if( $settings->btn_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->btn_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style form:not(input) {
				
				<?php if( $settings->label_font_size["medium"] != '' ) : ?>
				font-size: <?php echo $settings->label_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->label_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->label_line_height['medium']; ?>px;
				<?php endif; ?>
			}
	    }
	<?php } ?>
	<?php
	if( $settings->font_size['small'] != "" || $settings->line_height['small'] != "" || $settings->btn_font_size['small'] != "" || $settings->btn_line_height['small'] != "" || $settings->label_font_size['small'] != "" || $settings->label_line_height['small'] != "" || $settings->form_title_font_size['small'] != "" || $settings->form_title_line_height['small'] != "" || $settings->radio_checkbox_font_size["small"] != '' || $settings->form_desc_font_size['small'] != "" || $settings->form_desc_line_height['small'] != "")
	{
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-title {
				
				<?php if( $settings->form_title_font_size["small"] != '' ) : ?>
				font-size: <?php echo $settings->form_title_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->form_title_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->form_title_line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span, 
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span {
				<?php if( $settings->radio_check_custom_option == 'true' ) { 
					if( $settings->radio_checkbox_font_size["small"] != '' ) : ?>
						font-size: <?php echo $settings->radio_checkbox_font_size['small']; ?>px;
					<?php endif;
				} ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-desc {
				
				<?php if( $settings->form_desc_font_size["small"] != '' ) : ?>
				font-size: <?php echo $settings->form_desc_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->form_desc_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->form_desc_line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {
				<?php if( $settings->font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
				<?php if( $settings->btn_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->btn_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->btn_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->btn_line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style form:not(input) {
				
				<?php if( $settings->label_font_size["small"] != '' ) : ?>
				font-size: <?php echo $settings->label_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->label_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->label_line_height['small']; ?>px;
				<?php endif; ?>
			}
	    }
	<?php
	}
}
?>

/* Error Styling */

.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-not-valid-tip {
	color: <?php echo $settings->input_msg_color; ?>;
	font-size: <?php echo $settings->input_msg_font_size; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-response-output {
	color: <?php echo $settings->validation_msg_color; ?>;
	font-size: <?php echo $settings->validation_msg_font_size; ?>px;
	
	background: <?php echo $settings->validation_bg_color; ?>;
	<?php if ( $settings->validation_border_type != ''  ) { ?>
	<?php $settings->validation_border_width = $settings->validation_border_width != '' ? $settings->validation_border_width : '1'; ?>
		border: <?php echo $settings->validation_border_type.' '.$settings->validation_border_width.'px '.$settings->validation_border_color.';'; ?>
	<?php }else{ ?>
		border: none;
	<?php } ?>
	
	border-radius: <?php echo $settings->validation_border_radius; ?>px;

	<?php if ( $settings->validation_spacing  != '' ) {
		echo $settings->validation_spacing;
	} ?>
}