<div <?php echo ( $settings->id != '' ) ? 'id="'.$settings->id.'-overlay"' : ''; ?> class="uabb-modal-parent-wrapper uabb-module-content uamodal-<?php echo $id; ?> <?php echo ( $settings->class != '' ) ? $settings->class.'-overlay' : ''; ?>">
	<div class="uabb-modal uabb-drag-fix uabb-center-modal uabb-modal-<?php echo $settings->content_type;?> uabb-modal-custom<?php //echo $settings->modal_size;?> <?php echo $settings->modal_effect; ?>" id="modal-<?php echo $id; ?>" data-content="<?php echo $settings->content_type;?>">
		<div class="uabb-content <?php //echo ( $settings->content_type == 'content' ) ? 'uabb-text-editor' : ''; ?>">
			<?php if ( ( ( $settings->close_source == 'icon' && $settings->close_icon != '' ) || ( $settings->close_source == 'image' && $settings->close_photo != '' ) ) && ( $settings->icon_position == 'popup-top-left' || $settings->icon_position == 'popup-top-right' || $settings->icon_position == 'popup-edge-top-right' || $settings->icon_position == 'popup-edge-top-left') ) { ?>
			<span class="uabb-modal-close uabb-close-custom<?php //echo $settings->modal_size;?>-<?php echo $settings->icon_position;?>" ><?php 
				$close_photo_src =  ( isset( $settings->close_photo_src ) ) ? $settings->close_photo_src : '';
				if ( $settings->close_source == 'icon' ) {
					echo '<i class="uabb-close-icon '.$settings->close_icon.'"></i>';
				}else{
					echo '<img class="uabb-close-image" src="'. $close_photo_src .'"/>';
				}
			?></span>
			<?php } ?>

			<?php if ( $settings->enable_title && $settings->modal_width != '' ) { ?>
			<div class="uabb-modal-title-wrap">
			<<?php echo $settings->title_tag_selection; ?> class="uabb-modal-title"><?php echo ( $settings->title != '' ) ? $settings->title : 'This is modal title'; ?></<?php echo $settings->title_tag_selection; ?>>
			</div> 	
			<?php } ?>
			<?php //echo $module->get_video_embed(); ?>
			<div class="uabb-modal-text uabb-modal-content-data <?php echo ( $settings->content_type == 'content' ) ? 'uabb-text-editor' : ''; ?> fl-clearfix">
			<?php echo $module->get_modal_content( $settings ); ?>
			</div>
			
			<!--<button class="uabb-close">Close me!</button>-->

		</div>
	</div>

	<?php if ( ( ( $settings->close_source == 'icon' && $settings->close_icon != '' ) || ( $settings->close_source == 'image' && $settings->close_photo != '' ) ) && ( $settings->icon_position == 'top-left' || $settings->icon_position == 'top-right' ) ) { ?>
	<span class="uabb-modal-close uabb-close-custom<?php //echo $settings->modal_size;?>-<?php echo $settings->icon_position;?>" ><?php 
				$close_photo_src =  ( isset( $settings->close_photo_src ) ) ? $settings->close_photo_src : '';
				if ( $settings->close_source == 'icon' ) {
					echo '<i class="uabb-close-icon '.$settings->close_icon.'"></i>';
				}else{
					echo '<img class="uabb-close-image" src="'. $close_photo_src .'"/>';
				}
			?></span>
	<?php } ?>
	<div class="uabb-overlay"></div>
</div>

<div class="uabb-modal-action-wrap">
<?php if( $settings->modal_on == 'button') { ?>
	<?php $module->render_button( $id ); ?>
<?php }elseif( $settings->modal_on == 'text') { ?>
	<div class="uabb-modal-action uabb-trigger" data-modal="<?php echo $id; ?>"><?php echo $settings->modal_text; ?></div>
<?php }elseif( $settings->modal_on == 'icon') { ?>
<div class="uabb-modal-action uabb-trigger uabb-modal-icon-wrap" data-modal="<?php echo $id; ?>"><i class="uabb-modal-icon <?php echo $settings->icon; ?>"></i></div>
<?php }elseif( $settings->modal_on == 'photo') { ?>
	<?php 
		$img_src = '';
		if( isset( $settings->photo_src ) && !empty( $settings->photo_src ) ) {
			$img_src = $settings->photo_src;
	?>
	<div class="uabb-modal-action uabb-trigger uabb-modal-photo-wrap" data-modal="<?php echo $id; ?>"><img class="uabb-modal-photo" src="<?php echo $img_src; ?>"></div>
	<?php } ?>
<?php }if ( ( $settings->modal_on == 'custom' || $settings->modal_on == 'automatic' ) && FLBuilderModel::is_builder_active() ) { ?>
	<div class="uabb-builder-msg" style="text-align: center;">
		<h5><?php _e( 'Modal Popup - ID ', 'uabb' ); ?><?php echo $module->node; ?></h5>
		<?php _e( 'Click here to edit the "Modal Popup" settings. This text will not be visible on frontend.', 'uabb' ); ?>
	</div>
<?php } ?>
</div>