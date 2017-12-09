<?php 
	$count 			= 0; 
	$name_class 	= '';
	$email_class 	= '';
	$subject_class	= '';
	$phone_class 	= '';
	$msg_class		= '';

	if( $settings->name_toggle == 'show' && $settings->name_width == '50' ) {
		$count = ++$count;
		$name_class = ' uabb-name-inline uabb-inline-group';
		if ( $count % 2 == 0 ) {
			$name_class .= ' uabb-io-padding-left';
		}else{
			$name_class .= ' uabb-io-padding-right';
		}

	} 

	if( $settings->email_toggle == 'show' && $settings->email_width == '50' ) {
		$count = ++$count;
		$email_class = ' uabb-email-inline uabb-inline-group';
		if ( $count % 2 == 0 ) {
			$email_class .= ' uabb-io-padding-left';
		}else{
			$email_class .= ' uabb-io-padding-right';
		}

	} 

	if( $settings->subject_toggle == 'show' && $settings->subject_width == '50' ) {
		$count = ++$count;
		$subject_class = ' uabb-subject-inline uabb-inline-group';
		if ( $count % 2 == 0 ) {
			$subject_class .= ' uabb-io-padding-left';
		}else{
			$subject_class .= ' uabb-io-padding-right';
		}

	}

	if( $settings->phone_toggle == 'show' && $settings->phone_width == '50' ) {
		$count = ++$count;
		$phone_class = ' uabb-phone-inline uabb-inline-group';
		if ( $count % 2 == 0 ) {
			$phone_class .= ' uabb-io-padding-left';
		}else{
			$phone_class .= ' uabb-io-padding-right';
		}

	}

	if( $settings->msg_toggle == 'show' && $settings->msg_width == '50' ) {
		$count = ++$count;
		$msg_class = ' uabb-message-inline uabb-inline-group';
		if ( $count % 2 == 0 ) {
			$msg_class .= ' uabb-io-padding-left';
		}else{
			$msg_class .= ' uabb-io-padding-right';
		}

	}
?>

<form class="uabb-module-content uabb-contact-form <?php echo 'uabb-form-'.$settings->form_style; ?>" <?php if ( isset( $module->template_id ) ) echo 'data-template-id="' . $module->template_id . '" data-template-node-id="' . $module->template_node_id . '"'; ?>>
  	<div class="uabb-input-group-wrap">
	<?php if ($settings->name_toggle == 'show') : ?>
	<div class="uabb-input-group uabb-name <?php echo $name_class; ?>">
		<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
		<label for="uabb-name"><?php echo $settings->name_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="text" name="uabb-name" value="" <?php if($settings->enable_placeholder == 'yes' ) { ?> placeholder="<?php echo $settings->name_placeholder; ?>" <?php } ?>/>
			<div class="uabb-form-error-message uabb-form-error-message-required"></div>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if ($settings->email_toggle == 'show') : ?>
	<div class="uabb-input-group uabb-email <?php echo $email_class; ?>">
		<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
		<label for="uabb-email"><?php echo $settings->email_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="email" name="uabb-email" value="" <?php if($settings->enable_placeholder == 'yes' ) { ?>placeholder="<?php echo $settings->email_placeholder; ?>"<?php } ?>/>
			<div class="uabb-form-error-message uabb-form-error-message-required"><span><?php _e('Invalid Email', 'uabb'); ?></span></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($settings->subject_toggle == 'show') : ?>
	<div class="uabb-input-group uabb-subject <?php echo $subject_class; ?>">
		<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
		<label for="uabb-subject"><?php echo $settings->subject_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="text" name="uabb-subject" value="" <?php if($settings->enable_placeholder == 'yes' ) { ?>placeholder="<?php echo $settings->subject_placeholder; ?>"<?php } ?>/>
			<div class="uabb-form-error-message uabb-form-error-message-required"></div>
		</div>
	</div>
	<?php endif; ?>


	<?php if ($settings->phone_toggle == 'show') : ?>
	<div class="uabb-input-group uabb-phone <?php echo $phone_class; ?>">
		<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
		<label for="uabb-phone"><?php echo $settings->phone_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="tel" name="uabb-phone" value="" <?php if($settings->enable_placeholder == 'yes' ) { ?>placeholder="<?php echo $settings->phone_placeholder; ?>"<?php } ?> />
			<div class="uabb-form-error-message uabb-form-error-message-required"><span><?php _e('Invalid Number', 'uabb'); ?></span></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($settings->msg_toggle == 'show') : ?>
	<div class="uabb-input-group uabb-message <?php echo $msg_class; ?>">
		<?php if ( $settings->form_style == 'style1' && $settings->enable_label == 'yes' ) { ?>
		<label for="uabb-message"><?php echo $settings->msg_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter-textarea">
			<textarea name="uabb-message" <?php if($settings->enable_placeholder == 'yes' ) { ?>placeholder="<?php echo $settings->msg_placeholder; ?>"<?php } ?>></textarea>
			<div class="uabb-form-error-message uabb-form-error-message-required"></div>
		</div>
	</div>
	<?php endif; ?>

	<?php
	if ( 'show' == $settings->uabb_recaptcha_toggle && (isset( $settings->uabb_recaptcha_site_key ) && ! empty( $settings->uabb_recaptcha_site_key )) ) : ?>
	<div class="uabb-input-group uabb-recaptcha">
		<span class="uabb-contact-error"><?php _e( 'Please check the captcha to verify you are not a robot.', 'uabb' );?></span>
		<div id="<?php echo $id; ?>-uabb-grecaptcha" class="uabb-grecaptcha" data-sitekey="<?php echo $settings->uabb_recaptcha_site_key; ?>" data-theme="<?php echo $settings->uabb_recaptcha_theme; ?>"></div>
	   </div>
	<?php endif; ?>

	</div>

	<div class="uabb-submit-btn">
		<button type="submit" class="uabb-contact-form-submit">
		<?php if( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) { echo ( $settings->btn_icon != '' && $settings->btn_icon_position == 'before' ) ? '<i class="' . $settings->btn_icon . '"></i>' : ''; } ?><span><?php echo $settings->btn_text; ?></span><?php if( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) { echo ( $settings->btn_icon != '' && $settings->btn_icon_position == 'after' ) ? '<i class="' . $settings->btn_icon . '"></i>' : ''; } ?></button>
	</div>
	<?php if ($settings->success_action == 'redirect') : ?>
		<input type="text" value="<?php echo $settings->success_url; ?>" style="display: none;" class="uabb-success-url">  
	<?php elseif($settings->success_action == 'none') : ?>  
		<span class="uabb-success-none" style="display:none;"><?php echo $settings->email_sccess; ?></span>
	<?php endif; ?> 
	<span class="uabb-send-error" style="display:none;"><?php echo $settings->email_error; ?></span>
    
</form>
<?php if($settings->success_action == 'show_message') : ?>  
  <span class="uabb-success-msg uabb-text-editor" style="display:none;"><?php echo $settings->success_message; ?></span>
<?php endif; ?>  

