<?php 
$btn_style_class = "";

if ( $settings->dual_button_style == "transparent" ) {
	$btn_style_class = " uabb-".$settings->transparent_button_options;
}elseif ( $settings->dual_button_style == "gradient" ) {
	$btn_style_class = " uabb-gradient";
}elseif ( $settings->dual_button_style == "flat" ) {
	$btn_style_class = " uabb-".$settings->flat_button_options;
}
?>
<div class="uabb-module-content uabb-dual-button <?php echo "uabb-align-".$settings->dual_button_align;?>">
	<div class="uabb-dual-button-wrapper <?php echo "uabb-" . $settings->dual_button_type; ?> <?php echo "uabb-" . $settings->dual_button_type.'-'.$settings->dual_button_width_type; ?>">
		<div class="uabb-dual-button-one <?php echo "uabb-btn-" . $settings->dual_button_type; ?> <?php echo $settings->button_one_class; ?>">
			<a class="uabb-btn uabb-btn-one<?php echo $btn_style_class;?>" href="<?php echo $settings->button_one_link;?>" target="<?php echo $settings->button_one_link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->button_one_link_target, 0, 1 ); ?>>
				<?php if ( $settings->icon_position_btn_one == "before" && $settings->image_type_btn_one != 'none' ) { ?>
				<div class="uabb-btn-img-icon before uabb-btn-one-img-icon">
					<?php 
					$btn_one_img_icon = array( 
						'image_type'	=> $settings->image_type_btn_one, 
						'icon'			=> $settings->icon_btn_one, 
						'icon_size'		=> "", 
						'photo_source'	=> "library", 
						'photo'			=> $settings->photo_btn_one, 
						'photo_url'		=> "", 
						'img_size'		=> "", 
						'photo_src'		=> isset( $settings->photo_btn_one_src ) ? $settings->photo_btn_one_src : ''
						);
					$module->render_own_imgicon($btn_one_img_icon);
					?>
				</div>
				<?php } ?>
				<span class="uabb-btn-one-text"><?php echo $settings->button_one_title;?></span>
				<?php if ( $settings->icon_position_btn_one == "after" && $settings->image_type_btn_one != 'none' ) { ?>
				<div class="uabb-btn-img-icon after uabb-btn-one-img-icon">
					<?php 
					$btn_one_img_icon = array( 
						'image_type'	=> $settings->image_type_btn_one, 
						'icon'			=> $settings->icon_btn_one, 
						'icon_size'		=> "", 
						'photo_source'	=> "library", 
						'photo'			=> $settings->photo_btn_one, 
						'photo_url'		=> "", 
						'img_size'		=> "", 
						'photo_src'		=> isset( $settings->photo_btn_one_src ) ? $settings->photo_btn_one_src : ''
						);
					$module->render_own_imgicon($btn_one_img_icon);
					?>
				</div>
				<?php } ?>
			</a>
			<?php
			if( !( $settings->dual_button_type == 'horizontal' && $settings->join_buttons == 'no' ) ) {
				if ( $settings->divider_options != 'none' ) {
			?>
				<span class="uabb-middle-text">
					<?php
					if ( $settings->divider_options == "text" ) {
						echo $settings->divider_text;
					}
					if ( $settings->divider_options == "icon" || $settings->divider_options == "photo"  ) {
						$divider_img_icon = array( 
							'image_type'	=> $settings->divider_options, 
							'icon'			=> $settings->divider_icon, 
							'icon_size'		=> "", 
							'photo_source'	=> "library", 
							'photo'			=> $settings->divider_photo, 
							'photo_url'		=> "", 
							'img_size'		=> "", 
							'photo_src'		=> isset( $settings->divider_photo_src ) ? $settings->divider_photo_src : ''
							);
						$module->render_image_icon($divider_img_icon);					
					}
					?>
				</span>
			<?php
				}
			}
			?>
		</div>
		<div class="uabb-dual-button-two <?php echo "uabb-btn-" . $settings->dual_button_type; ?> <?php echo $settings->button_two_class; ?>">
			<a class="uabb-btn uabb-btn-two<?php echo $btn_style_class;?>" href="<?php echo $settings->button_two_link;?>" target="<?php echo $settings->button_two_link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->button_two_link_target, 0, 1 ); ?>>
				<?php if ( $settings->icon_position_btn_two == "before" && $settings->image_type_btn_two != "none" ) { ?>
				<div class="uabb-btn-img-icon before uabb-btn-two-img-icon">
					<?php 
					$btn_two_img_icon = array( 
						'image_type'	=> $settings->image_type_btn_two, 
						'icon'			=> $settings->icon_btn_two, 
						'icon_size'		=> "", 
						'photo_source'	=> "library", 
						'photo'			=> $settings->photo_btn_two, 
						'photo_url'		=> "",
						'img_size'		=> "",
						'photo_src'		=> isset( $settings->photo_btn_two_src ) ? $settings->photo_btn_two_src : ''
						);
					$module->render_own_imgicon($btn_two_img_icon);
					?>
				</div>
				<?php } ?>
				<span class="uabb-btn-two-text"><?php echo $settings->button_two_title;?></span>
				<?php if ( $settings->icon_position_btn_two == "after" && $settings->image_type_btn_two != "none" ) { ?>
				<div class="uabb-btn-img-icon after uabb-btn-two-img-icon">
					<?php 
					$btn_two_img_icon = array( 
						'image_type'	=> $settings->image_type_btn_two, 
						'icon'			=> $settings->icon_btn_two, 
						'icon_size'		=> "", 
						'photo_source'	=> "library", 
						'photo'			=> $settings->photo_btn_two, 
						'photo_url'		=> "", 
						'img_size'		=> "", 
						'photo_src'		=> isset( $settings->photo_btn_two_src ) ? $settings->photo_btn_two_src : ''
						);
					$module->render_own_imgicon($btn_two_img_icon);
					?>
				</div>
				<?php } ?>
			</a>
		</div>
	</div>
</div>