<?php 
    $settings->input_text_color = UABB_Helper::uabb_colorpicker( $settings, 'input_text_color' );
    $settings->input_background_color = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
    $settings->input_border_color = UABB_Helper::uabb_colorpicker( $settings, 'input_border_color' );
    $settings->input_border_active_color = UABB_Helper::uabb_colorpicker( $settings, 'input_border_active_color' );
    
    $settings->btn_text_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color' );
    $settings->btn_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color' );
    $settings->btn_background_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_color', true );
    $settings->btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_hover_color', true );

    $settings->label_color = UABB_Helper::uabb_colorpicker( $settings, 'label_color' );

    $settings->input_border_width = ( $settings->input_border_width != '' ) ? $settings->input_border_width : '1';
    $settings->form_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );
    $settings->invalid_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'invalid_msg_color' );
    $settings->success_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'success_msg_color' );
    $settings->error_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'error_msg_color' );
    $settings->invalid_border_color = UABB_Helper::uabb_colorpicker( $settings, 'invalid_border_color' );
    
?>
.fl-node-<?php echo $id; ?> {
	width: 100%;
}

/* Form Style */
.fl-node-<?php echo $id; ?> .uabb-contact-form {
	<?php if ( $settings->form_bg_type == 'color' ) { ?>
		background-color: <?php echo $settings->form_bg_color; ?>;
	<?php }elseif ( $settings->form_bg_type == 'image' ) { ?>
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
		border-radius:<?php echo ($settings->form_radius != '') ? $settings->form_radius : '0'; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-form-error-message-required {
	background: <?php echo $settings->invalid_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-form-error-message span {
	color: <?php echo $settings->invalid_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-success, 
.fl-node-<?php echo $id; ?> .uabb-success-none, 
.fl-node-<?php echo $id; ?> .uabb-success-msg {
	color: <?php echo $settings->success_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-send-error {
	color: <?php echo $settings->error_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error textarea, 
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error input[type=text], 
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error input[type=tel], 
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error input[type=email] {
	border-color: <?php echo $settings->invalid_border_color; ?>;
}

/* Input Fields CSS */
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap input,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap textarea {
	<?php if ( $settings->input_vertical_padding != '' ) { ?>
	padding-top: <?php echo $settings->input_vertical_padding; ?>px;
	padding-bottom: <?php echo $settings->input_vertical_padding; ?>px;
	<?php } ?>
	<?php if ( $settings->input_horizontal_padding != '' ) { ?>
	padding-left: <?php echo $settings->input_horizontal_padding; ?>px;
	padding-right: <?php echo $settings->input_horizontal_padding; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-form-error-message::before {
	<?php if ( $settings->input_horizontal_padding != '' ) { ?>
	right: <?php echo $settings->input_horizontal_padding; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input:focus,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap textarea {
    border-radius: 0;
    text-align: <?php echo $settings->input_text_align; ?>;
    border-color: <?php echo uabb_theme_text_color( $settings->input_border_color ); ?>;
    color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
    <?php if( $settings->input_background_color != '' ) { ?>
    background: <?php echo $settings->input_background_color; ?>;
    <?php } ?>
    border-width: <?php echo $settings->input_border_width; ?>px;
}

<?php if( $settings->input_border_active_color != '' ) { ?>
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input:active,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input:focus,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap textarea:active,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap textarea:focus {
    border-color: <?php echo $settings->input_border_active_color; ?>;
}
<?php } ?>

/* Placeholder Colors */

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input::-webkit-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea::-webkit-input-placeholder {
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input:-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea:-moz-placeholder { 		/* Firefox 18- */
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input::-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea::-moz-placeholder {  	/* Firefox 19+ */
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input:-ms-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea:-ms-input-placeholder {  
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}


.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input::-webkit-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea::-webkit-input-placeholder {
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input:-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea:-moz-placeholder { 		/* Firefox 18- */
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
	opacity: 1;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input::-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea::-moz-placeholder {  	/* Firefox 19+ */
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
	opacity: 1;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input:-ms-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea:-ms-input-placeholder {  
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-form-outter {
	<?php echo ( $settings->input_top_margin != '' ) ? 'margin-top: '.$settings->input_top_margin.'px;' : '' ; ?>
	<?php echo ( $settings->input_bottom_margin != '' ) ? 'margin-bottom: '.$settings->input_bottom_margin.'px;' : 'margin-bottom: 10px;'; ?>
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-form-outter-textarea {
	<?php echo ( $settings->textarea_top_margin != '' ) ? 'margin-top: '.$settings->textarea_top_margin.'px;' : '' ; ?>
	<?php echo ( $settings->textarea_bottom_margin != '' ) ? 'margin-bottom: '.$settings->textarea_bottom_margin.'px;' : 'margin-bottom: 10px;'; ?>
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-submit-btn {
	<?php echo ( $settings->btn_top_margin != '' ) ? 'margin-top: '.$settings->btn_top_margin.'px;' : 'margin-top: 0;'; ?>
}

/* Lable */

.fl-node-<?php echo $id; ?> .uabb-contact-form label {
	<?php echo ( $settings->label_top_margin != '' ) ? 'margin-top: '.$settings->label_top_margin.'px;' : '' ; ?>
	<?php echo ( $settings->label_bottom_margin != '' ) ? 'margin-bottom: '.$settings->label_bottom_margin.'px;' : ''; ?>
}

.fl-node-<?php echo $id; ?> .uabb-input-group.uabb-recaptcha > .uabb-grecaptcha {
	<?php echo ( $settings->input_top_margin != '' ) ? 'margin-top: '.$settings->input_top_margin.'px;' : '' ; ?>
	<?php echo ( $settings->input_bottom_margin != '' ) ? 'margin-bottom: '.$settings->input_bottom_margin.'px;' : 'margin-bottom: 10px;'; ?>
}

/* Button CSS */
<?php
$settings->btn_background_color = uabb_theme_button_bg_color( $settings->btn_background_color );
$settings->btn_background_hover_color = uabb_theme_button_bg_hover_color( $settings->btn_background_hover_color );
$settings->btn_text_color 		= uabb_theme_button_text_color( $settings->btn_text_color );
$settings->btn_text_hover_color = uabb_theme_button_text_hover_color( $settings->btn_text_hover_color );

$settings->btn_border_width = ( isset( $settings->btn_border_width ) && $settings->btn_border_width != '' ) ? $settings->btn_border_width : '2';



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

if( $settings->msg_height != '' ) {
?>

.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {
	min-height: <?php echo $settings->msg_height; ?>px;
}

<?php
}
if( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) {
?>
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit i {
<?php
	echo ( $settings->btn_icon != '' && $settings->btn_icon_position == 'before' ) ? 'margin-right: 8px;' : '';
	echo ( $settings->btn_icon != '' && $settings->btn_icon_position == 'after' ) ? 'margin-left: 8px;' : '';
?>
}
<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit i,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit span {
	display: inline-block;
	vertical-align: middle;
}

<?php
if ( $settings->btn_align != 'full' ) { ?>
.fl-node-<?php echo $id; ?> .uabb-submit-btn {
	text-align: <?php echo $settings->btn_align; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit {
	border-radius: <?php echo  ( $settings->btn_radius != '' ) ? $settings->btn_radius : '4'; ?>px;
	
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
	
	<?php if ( $settings->btn_align == 'full' ) { ?>
		width:100%;
	<?php } ?>
	padding: <?php echo uabb_theme_button_padding( '' ); ?>;
	<?php
	echo ( $settings->btn_vertical_padding != '' ) ? 'padding-top: ' . $settings->btn_vertical_padding . 'px;padding-bottom: ' . $settings->btn_vertical_padding . 'px;' : '';
	echo ( $settings->btn_horizontal_padding != '' ) ? 'padding-left: ' . $settings->btn_horizontal_padding . 'px;padding-right: ' . $settings->btn_horizontal_padding . 'px;' : '';
	?>
}


.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit:hover {
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
		<?php } ?>

		border-style: solid;
		border-color: <?php echo $border_hover_color; ?>;

		<?php
		if( $settings->hover_attribute != 'border' ) {
		?>
			background:<?php echo $border_hover_color; ?>;
		<?php
		}
		?>
		
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
	<?php }elseif ( $settings->btn_style == '3d' ) { ?>
		top: 2px;
		box-shadow: 0 4px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	<?php } ?>


	
}


.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit:active {
	<?php if ( $settings->btn_style == '3d' ) { ?>
		top: 6px;
		box-shadow: 0 0px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	<?php } ?>
}


/* Typography CSS */
.fl-node-<?php echo $id; ?> .uabb-contact-form input,
.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {
	
	<?php if( $settings->font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->font_size["desktop"] != '' ) : ?>
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
	<?php endif; ?>

	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-contact-form-submit {
	<?php $uabb_theme_btn_family = apply_filters( 'uabb_theme_button_font_family', '' ); ?>
	
	<?php if ( uabb_theme_button_letter_spacing('') != '' ) { ?>
	letter-spacing: <?php echo uabb_theme_button_letter_spacing(''); ?>;
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
	line-height: <?php echo $settings->btn_font_size['desktop'] + 2; ?>px;
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

<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
.fl-node-<?php echo $id; ?> .uabb-contact-form label {
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
}
<?php } ?>

/* Typography responsive css */
<?php if($global_settings->responsive_enabled) { // Global Setting If started ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			<?php
			if( $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" || $settings->btn_font_size['medium'] != "" || $settings->btn_line_height['medium'] != "" || $settings->label_font_size['medium'] != "" || $settings->label_line_height['medium'] != "") {
			?>
			.fl-node-<?php echo $id; ?> .uabb-contact-form input,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {
				
				<?php if( $settings->font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['medium']; ?>px;
				line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form-submit {
				
				<?php if( $settings->btn_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
				line-height: <?php echo $settings->btn_font_size['medium'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->btn_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
				<?php endif; ?>
			}

			<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-contact-form label {
				
				<?php if( $settings->label_font_size["medium"] != '' ) : ?>
				font-size: <?php echo $settings->label_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->label_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->label_line_height['medium']; ?>px;
				<?php endif; ?>
			}
			<?php } ?>
			<?php } ?>
	    }
	<?php
	if( $settings->font_size['small'] != "" || $settings->line_height['small'] != "" || $settings->btn_font_size['small'] != "" || $settings->btn_line_height['small'] != "" || $settings->label_font_size['small'] != "" || $settings->label_line_height['small'] != "")
	{
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-contact-form input,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {
				<?php if( $settings->font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['small']; ?>px;
				line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form-submit {
				<?php if( $settings->btn_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->btn_font_size['small']; ?>px;
				line-height: <?php echo $settings->btn_font_size['small'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->btn_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->btn_line_height['small']; ?>px;
				<?php endif; ?>
			}

			<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-contact-form label {
				
				<?php if( $settings->label_font_size["small"] != '' ) : ?>
				font-size: <?php echo $settings->label_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->label_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->label_line_height['small']; ?>px;
				<?php endif; ?>
			}
			<?php } ?>
	    }
	<?php
	}
}
?>