<?php
$settings->button_border_color = UABB_Helper::uabb_colorpicker( $settings, 'button_border_color' );

$settings->_btn_one_back_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_back_color', true );
$settings->_btn_one_back_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_back_hover_color', true );

$settings->_btn_two_back_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_back_color', true );
$settings->_btn_two_back_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_back_hover_color', true );

$settings->divider_color = UABB_Helper::uabb_colorpicker( $settings, 'divider_color' );

$settings->divider_background_color = UABB_Helper::uabb_colorpicker( $settings, 'divider_background_color', true );


$settings->divider_border_color = UABB_Helper::uabb_colorpicker( $settings, 'divider_border_color' );

$settings->_btn_one_text_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_text_color' );
$settings->_btn_one_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_text_hover_color' );


$settings->_btn_two_text_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_text_color' );
$settings->_btn_two_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_text_hover_color' );

$settings->button_border_width = ( $settings->button_border_width != '' ) ? $settings->button_border_width : '2';
$settings->img_icon_width_btn_one = ( $settings->img_icon_width_btn_one != '' ) ? $settings->img_icon_width_btn_one : '30';
$settings->img_icon_width_btn_two = ( $settings->img_icon_width_btn_two != '' ) ? $settings->img_icon_width_btn_two : '30';
$settings->dual_button_width = ( $settings->dual_button_width != '' ) ? $settings->dual_button_width : '100';
$settings->dual_button_height = ( $settings->dual_button_height != '' ) ? $settings->dual_button_height : '45';
$settings->dual_button_radius = ( $settings->dual_button_radius != '' ) ? $settings->dual_button_radius : '0';
$settings->spacing_between_buttons = ( $settings->spacing_between_buttons != '' ) ? $settings->spacing_between_buttons : '10';
?>
/* Global Style */

/* Divider Styles */
.fl-node-<?php echo $id;?> .uabb-middle-text {
	color: <?php echo uabb_theme_base_color( $settings->divider_color ); ?>;
	background: <?php echo uabb_theme_base_color( $settings->divider_background_color ); ?>;
	<?php if( $settings->divider_border != ""  ){ ?>
		border-color: <?php echo uabb_theme_base_color( $settings->divider_border_color ); ?>;
		border-width: <?php echo ( $settings->divider_border_width != '' ) ? $settings->divider_border_width : '1'; ?>px;
		<?php if ( $settings->divider_border != "" ) { ?>
		border-style: <?php echo $settings->divider_border; ?>;
		<?php  } ?>
	<?php } ?>
	border-radius: <?php echo ( $settings->divider_border_radius != '' ) ? $settings->divider_border_radius : '50'; ?>px;

	<?php if( $settings->divider_options == 'text' && $settings->_divider_font_family['family'] != "Default" ) { ?>
		<?php UABB_Helper::uabb_font_css( $settings->_divider_font_family ); ?>
	<?php } ?>

	/* Calculated Divider Setting */
    <?php     $tb_padding     = '';
        $lr_padding     = '';
        $sm_pad_value     = '';
        $mul_logic = '';
        $div_fn_size     = '';
        $fn_calc     = '';
    if( ( $settings->divider_options != 'none' && $settings->dual_button_width_type == "custom" ) || ( $settings->_divider_font_size['desktop'] != '' ) ) :
        if( ( $settings->dual_button_pad_top_bot != '' ||  $settings->dual_button_pad_lef_rig != '' ) ||  ( $settings->_divider_font_size['desktop'] != '' && $settings->divider_options == 'text' ) ) :
			$tb_padding = (int) $settings->dual_button_pad_top_bot * 2;
			$lr_padding = (int) $settings->dual_button_pad_lef_rig * 2;
			$sm_pad_value = (min ($tb_padding,$lr_padding) );
			if( $settings->dual_button_pad_lef_rig == '' ) {
				$sm_pad_value = $tb_padding;
			}

			if( $settings->dual_button_pad_top_bot == '' ) {
				$sm_pad_value = $lr_padding;
			}
			
			$mul_logic = $sm_pad_value * 1.25;
			$fn_calc = $mul_logic;
			if( $settings->divider_options == 'text' ) {
				$div_fn_size = $settings->_divider_font_size['desktop'] * 2;
				$fn_calc = (max ($div_fn_size,$mul_logic) );
			}
		?>

			width: <?php echo $fn_calc; ?>px;
			height: <?php echo $fn_calc; ?>px;
			line-height: <?php echo $fn_calc; ?>px;

		<?php endif; ?>


    <?php endif; ?>

    <?php if( $settings->divider_options == 'text' && $settings->_divider_font_size['desktop'] != '' ) { ?>
	font-size: <?php echo $settings->_divider_font_size['desktop']; ?>px;
	<?php } ?>

	overflow:hidden;
}

/* Button general settings */
<?php if ( $settings->dual_button_align == "left" ) { ?>
	.fl-node-<?php echo $id;?> .uabb-dual-button {
		justify-content: flex-start;
	}
<?php } if ( $settings->dual_button_align == "right" ) { ?>
	.fl-node-<?php echo $id;?> .uabb-dual-button {
		justify-content: flex-end;
	}
<?php } if ( $settings->dual_button_align == "center" ) { ?>
	.fl-node-<?php echo $id;?> .uabb-dual-button {
		justify-content: center;
	}
<?php } ?>

/* Button Full Width */
<?php if( $settings->dual_button_width_type == "full" ){ ?>
.fl-node-<?php echo $id;?> .uabb-dual-button-wrapper {
	width: 100%;
}
<?php } ?>

/* Button Custom Width and Else Padding */
<?php if( $settings->dual_button_width_type == "custom" ){ ?>
	<?php if ( $settings->dual_button_type == 'horizontal' ) { ?>
	.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-dual-button-wrapper {
		width: <?php echo intval( $settings->dual_button_width ) * 2;?>px;
	}
	<?php } elseif ( $settings->dual_button_type == 'vertical' ) { ?>
	.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-dual-button-wrapper {
		width: <?php echo $settings->dual_button_width;?>px;
	}
	<?php } ?>

	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
		<?php if( $settings->dual_button_pad_top_bot != "" || $settings->dual_button_pad_lef_rig != "" ) {
			if( $settings->dual_button_pad_top_bot != "" ) { ?>
			padding-top: <?php echo $settings->dual_button_pad_top_bot;?>px;
			padding-bottom: <?php echo $settings->dual_button_pad_top_bot;?>px;
			<?php } ?>
			<?php if( $settings->dual_button_pad_lef_rig != "" ) { ?>
			padding-left: <?php echo $settings->dual_button_pad_lef_rig;?>px;
			padding-right: <?php echo $settings->dual_button_pad_lef_rig;?>px;
			<?php } ?>
		<?php } ?>

		min-height: <?php echo $settings->dual_button_height;?>px;
		<?php /*line-height: echo $settings->dual_button_height; px;*/ ?>
	}
<?php }else{
?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
		padding: <?php echo uabb_theme_button_padding( '' ); ?>;
	}
<?php
} ?>

/* General Radius */


/* General Border Only for Transparent */
<?php if ( $settings->dual_button_style == 'transparent' ) { ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
		border-width: <?php echo $settings->button_border_width; ?>px;
		border-style: <?php echo $settings->dual_button_border_style; ?>;
		border-color: <?php echo uabb_theme_base_color( $settings->button_border_color ); ?>;
	}

	<?php if ( $settings->dual_button_type == 'horizontal' ) {
			if( $settings->join_buttons != 'no' ) {
		?>
		.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
			border-left: 0;
		}
		<?php
			}
		?>
		.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-middle-text {
			right: <?php echo intval($settings->button_border_width)/2; ?>px;
		}
	<?php } ?>

	<?php if ( $settings->dual_button_type == 'vertical' ) { ?>
		.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
			border-top: 0;
		}
	<?php } ?>
<?php } ?>

/* Default Styles Button Text and Backgrund Styles */
/* Button 1 */
.fl-node-<?php echo $id;?> .uabb-btn-one {
	background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_color ); ?>;
	display: block;
}

.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-one {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_color ); ?>;
}
.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-two {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_color ); ?>;
}

.fl-node-<?php echo $id;?> .uabb-btn-one:hover {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
}

.fl-node-<?php echo $id;?> .uabb-btn-two:hover{
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
}

.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-middle-text {
	color: <?php echo uabb_theme_base_color( $settings->divider_color ); ?>;
}

.fl-node-<?php echo $id;?> .uabb-btn-one .uabb-btn-one-text,
.fl-node-<?php echo $id;?> .uabb-btn-one .uabb-imgicon-wrap .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_color ); ?>;
}

/* Button 2 */
.fl-node-<?php echo $id;?> .uabb-btn-two {
	background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_color ); ?>;
	display: block;
}

.fl-node-<?php echo $id;?> .uabb-btn-two .uabb-btn-two-text,
.fl-node-<?php echo $id;?> .uabb-btn-two .uabb-imgicon-wrap .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_color ); ?>;
}



/************* Global Hover Styles *****************/
<?php if( $settings->dual_button_style == "flat"  /*&& $settings->flat_button_options == "none"*/ ) { ?>

	/* Button Text and Backgrund Hover Styles */
	.fl-node-<?php echo $id;?> .uabb-btn-one:hover {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-one:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id;?> .uabb-btn-one:hover .uabb-imgicon-wrap .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}

	/* Button Two Hover Style */
	.fl-node-<?php echo $id;?> .uabb-btn-two:hover {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two:hover .uabb-btn-two-text,
	.fl-node-<?php echo $id;?> .uabb-btn-two:hover .uabb-imgicon-wrap .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}

<?php } ?>

/************** Global Hover Style Ends **************/

/************************************ End of Global Style ************************************/

/* Horizontal Style */
<?php if ( $settings->dual_button_type == 'horizontal' ) { ?>

	.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-one {
		border-top-left-radius: <?php echo $settings->dual_button_radius;?>px;
		border-bottom-left-radius: <?php echo $settings->dual_button_radius;?>px;
	}
	.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-two {
		border-top-right-radius: <?php echo $settings->dual_button_radius;?>px;
		border-bottom-right-radius: <?php echo $settings->dual_button_radius;?>px;
	}

	<?php if( $settings->dual_button_width_type == "full" || $settings->dual_button_width_type == "custom"){ ?>
		.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-btn-horizontal {
		    width: 50%;
		}
	<?php } ?>

<?php } ?>

/************************************ End of Horizontal Style ************************************/

/* Vertical Style */
<?php if ( $settings->dual_button_type == 'vertical' ) { ?>
	
	.fl-node-<?php echo $id;?> .uabb-vertical .uabb-btn.uabb-btn-one {
		border-top-left-radius: <?php echo $settings->dual_button_radius;?>px;
		border-top-right-radius: <?php echo $settings->dual_button_radius;?>px;
	}
	.fl-node-<?php echo $id;?> .uabb-vertical .uabb-btn.uabb-btn-two {
		border-bottom-left-radius: <?php echo $settings->dual_button_radius;?>px;
		border-bottom-right-radius: <?php echo $settings->dual_button_radius;?>px;
	}

	<?php if( $settings->dual_button_width_type == "full" ){ ?>
		.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-btn-vertical {
		    width: 100%;
		}
	<?php } ?>
<?php } ?>

/************************************ End of Vertical Style ************************************/

/* Transparent Styles - Button Text and Backgrund Styles */
<?php if( $settings->dual_button_style == "transparent" ) { ?>

	.fl-node-<?php echo $id;?> .uabb-btn-one.<?php echo "uabb-". $settings->transparent_button_options;?>,
	.fl-node-<?php echo $id;?> .uabb-btn-two.<?php echo "uabb-". $settings->transparent_button_options;?> {
		background: none;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-one.<?php echo "uabb-". $settings->transparent_button_options;?> .uabb-btn-one-text {
		color: <?php echo uabb_theme_base_color( $settings->_btn_one_text_color ); ?>;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.<?php echo "uabb-". $settings->transparent_button_options;?> .uabb-btn-two-text {
		color: <?php echo uabb_theme_base_color( $settings->_btn_two_text_color ); ?>;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-one.<?php echo "uabb-". $settings->transparent_button_options;?>:hover .uabb-btn-one-text {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	/* Code To change icon color on hover */
	<?php if( isset( $settings->icon_btn_one ) && $settings->icon_btn_one != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn-one.<?php echo "uabb-". $settings->transparent_button_options;?>:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
		position: relative;
		z-index: 1;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	.fl-node-<?php echo $id;?> .uabb-btn-two.<?php echo "uabb-". $settings->transparent_button_options;?>:hover .uabb-btn-two-text {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	/* Code To change icon color on hover Button Two*/
	<?php if( isset( $settings->icon_btn_two ) && $settings->icon_btn_two != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn-two.<?php echo "uabb-". $settings->transparent_button_options;?>:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
		position: relative;
		z-index: 1;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */

	<?php if ( $settings->transparent_button_options == 'transparent-fade' ) { ?>
		/* Fade Background */
		/* Button Text and Backgrund Hover Styles */

		.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fade:hover {
			background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
		}
		/* Code To change icon color on hover */
		<?php if( isset( $settings->icon_btn_one ) && $settings->icon_btn_one != "" ){ ?>
		.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fade:hover .uabb-icon i {
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
		}
		<?php } ?>
		/* Code To change icon color on hover Ends */

		.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fade:hover {
			background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
		}

		/* Code To change icon color on hover Button Two*/
		<?php if( isset( $settings->icon_btn_two ) && $settings->icon_btn_two != "" ){ ?>
		.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fade:hover .uabb-icon i {
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
		}
		<?php } ?>
		/* Code To change icon color on hover Button Two Ends */
	<?php } ?>


	<?php if ( $settings->transparent_button_options == 'transparent-fill-top' ) { ?>
	/* Fill Background From Top */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fill-top:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 100%;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fill-top:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 100%;
	}
	<?php } ?>

	<?php if ( $settings->transparent_button_options == 'transparent-fill-bottom' ) { ?>
	/* Fill Background From Bottom */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fill-bottom:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 100%;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fill-bottom:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 100%;
	}
	<?php } ?>

	<?php if ( $settings->transparent_button_options == 'transparent-fill-left' ) { ?>
	/* Fill Background From Left */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fill-left:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		width: 100%;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fill-left:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		width: 100%;
	}
	<?php } ?>

	<?php if ( $settings->transparent_button_options == 'transparent-fill-right' ) { ?>
	/* Fill Background From Right */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fill-right:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		width: 100%;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fill-right:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		width: 100%;
	}
	<?php } ?>

	<?php if ( $settings->transparent_button_options == 'transparent-fill-center' ) { ?>
	/* Fill Background From Center */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fill-center:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		width: 100%;
		height: 100%;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fill-center:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		width: 100%;
		height: 100%;
	}
	<?php } ?>

	<?php if ( $settings->transparent_button_options == 'transparent-fill-diagonal' ) { ?>
	/* Fill Background From Diagonal */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fill-diagonal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 260%;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fill-diagonal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 260%;
	}
	<?php } ?>

	<?php if ( $settings->transparent_button_options == 'transparent-fill-horizontal' ) { ?>
	/* Fill Background From Horizontal */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id;?> .uabb-btn-one.uabb-transparent-fill-horizontal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 100%;
    	width: 100%;
	}

	.fl-node-<?php echo $id;?> .uabb-btn-two.uabb-transparent-fill-horizontal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 100%;
    	width: 100%;
	}
	<?php } ?>
<?php } ?>


/* Gradient Styles - Button Text and Backgrund Styles */
<?php if( $settings->dual_button_style == "gradient" ) { ?>
<?php
/* Calculate colors for gradient button one simple */
$_btn_one_grad_back_color = uabb_theme_base_color( $settings->_btn_one_back_color );
$_btn_one_bg_grad_start = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $_btn_one_grad_back_color ), 30, 'lighten' );

/* Calculate colors for gradient button one hover */
if ( $settings->_btn_one_back_hover_color != "" ) {
	$_btn_one_bg_hover_grad_start = "#" .  FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->_btn_one_back_hover_color ), 30, 'lighten' );
}

/* Calculate colors for gradient button two simple */

$_btn_two_grad_back_color = uabb_theme_base_color( $settings->_btn_two_back_color );
$_btn_two_bg_grad_start = "#" .  FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $_btn_two_grad_back_color ), 30, 'lighten' );

/* Calculate colors for gradient button two hover */
if ( $settings->_btn_two_back_hover_color != "" ) {
	$_btn_two_bg_hover_grad_start = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->_btn_two_back_hover_color ), 30, 'lighten' );
}

?>

.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-gradient {
	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%, <?php echo $_btn_one_grad_back_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_one_bg_grad_start; ?>), color-stop(100%,<?php echo $_btn_one_grad_back_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_one_bg_grad_start; ?>', endColorstr='<?php echo $_btn_one_grad_back_color; ?>',GradientType=0 );
}
.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-gradient {
	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%, <?php echo $_btn_two_grad_back_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_two_bg_grad_start; ?>), color-stop(100%,<?php echo $_btn_two_grad_back_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_two_bg_grad_start; ?>', endColorstr='<?php echo $_btn_two_grad_back_color; ?>',GradientType=0 );
}

<?php if ( $settings->_btn_one_back_hover_color != "" ) { ?>
.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-gradient:hover {

	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%, <?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_one_bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->_btn_one_back_hover_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_one_bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->_btn_one_back_hover_color; ?>',GradientType=0 );
}
<?php } ?>

<?php if ( $settings->_btn_two_back_hover_color != "" ) { ?>
.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-gradient:hover {

	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%, <?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_two_bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->_btn_two_back_hover_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_two_bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->_btn_two_back_hover_color; ?>',GradientType=0 );
}
<?php } ?>

.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-gradient:hover .uabb-btn-one-text {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
}

/* Code To change icon color on hover */
<?php if( isset( $settings->icon_btn_one ) && $settings->icon_btn_one != "" ){ ?>
.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-gradient:hover .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
}
<?php } ?>
/* Code To change icon color on hover Ends */

.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-gradient:hover .uabb-btn-two-text {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
}

/* Code To change icon color on hover Button Two*/
<?php if( isset( $settings->icon_btn_two ) && $settings->icon_btn_two != "" ){ ?>
.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-gradient:hover .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
}
<?php } ?>
/* Code To change icon color on hover Button Two Ends */

<?php } ?>



/* Flat Styles - Button Text and Backgrund Styles */
<?php if( $settings->dual_button_style == "flat" ) { ?>

<?php if ( $settings->flat_button_options == "animate_to_right" ) { ?>
	/* Animate Icon To Right */
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_to_right:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_to_right:hover .uabb-imgicon-wrap {
		left: 0;
	}
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_to_right:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_to_right:hover .uabb-btn-two-text {
		-webkit-transform: translateX(200%);
	       -moz-transform: translateX(200%);
	        -ms-transform: translateX(200%);
	         -o-transform: translateX(200%);
	            transform: translateX(200%);
	}

	/* Code To change icon color on hover */
	<?php if( isset( $settings->icon_btn_one ) && $settings->icon_btn_one != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_to_right:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
	<?php if( isset( $settings->icon_btn_two ) && $settings->icon_btn_two != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_to_right:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

<?php if ( $settings->flat_button_options == "animate_to_left" ) { ?>
	/* Animate Icon To Left */
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_to_left:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_to_left:hover .uabb-imgicon-wrap {
		right: 0;
	}
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_to_left:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_to_left:hover .uabb-btn-two-text {
		-webkit-transform: translateX(-200%);
	       -moz-transform: translateX(-200%);
	        -ms-transform: translateX(-200%);
	         -o-transform: translateX(-200%);
	            transform: translateX(-200%);
	}

	/* Code To change icon color on hover */
	<?php if( isset( $settings->icon_btn_one ) && $settings->icon_btn_one != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_to_left:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
	<?php if( isset( $settings->icon_btn_two ) && $settings->icon_btn_two != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_to_left:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

<?php if ( $settings->flat_button_options == "animate_from_top" ) { ?>

	/* Animate Icon From Top */
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_from_top:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_from_top:hover .uabb-imgicon-wrap {
		top: 0;
	}
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_from_top:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_from_top:hover .uabb-btn-two-text {
		-webkit-transform: translateY(500px);
	       -moz-transform: translateY(500px);
	        -ms-transform: translateY(500px);
	         -o-transform: translateY(500px);
	            transform: translateY(500px);
	}

	/* Code To change icon color on hover */
	<?php if( isset( $settings->icon_btn_one ) && $settings->icon_btn_one != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_from_top:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
	<?php if( isset( $settings->icon_btn_two ) && $settings->icon_btn_two != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_from_top:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

<?php if ( $settings->flat_button_options == "animate_from_bottom" ) { ?>
	/* Animate Icon From Bottom */
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_from_bottom:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_from_bottom:hover .uabb-imgicon-wrap {
		bottom: 0;
	}
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_from_bottom:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_from_bottom:hover .uabb-btn-two-text {
		-webkit-transform: translateY(-500px);
	       -moz-transform: translateY(-500px);
	        -ms-transform: translateY(-500px);
	         -o-transform: translateY(-500px);
	            transform: translateY(-500px);
	}

	/* Code To change icon color on hover */
	<?php if( isset( $settings->icon_btn_one ) && $settings->icon_btn_one != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one.uabb-animate_from_bottom:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
	<?php if( isset( $settings->icon_btn_two ) && $settings->icon_btn_two != "" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two.uabb-animate_from_bottom:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

<?php } ?>

/* Image Icon Styling */
<?php
if ( ( $settings->image_type_btn_one != "" || $settings->image_type_btn_two != "" ) && ( ( isset( $settings->photo_btn_one_src ) && $settings->photo_btn_one_src !="" ) || ( isset( $settings->icon_btn_one ) && $settings->icon_btn_one !="" ) || ( isset( $settings->photo_btn_two_src ) && $settings->photo_btn_two_src !="" ) || ( isset( $settings->icon_btn_two ) && $settings->icon_btn_two !="" ) ) ) {

if ( isset( $settings->photo_btn_one_src ) ) { $photo_btn_one_src = $settings->photo_btn_one_src; }
else { $photo_btn_one_src = ""; }

if ( isset( $settings->photo_btn_two_src ) ) { $photo_btn_two_src = $settings->photo_btn_two_src; }
else { $photo_btn_two_src = ""; }

$btn_one_fl_id = $id . " .uabb-btn-one-img-icon";
$btn_two_fl_id = $id . " .uabb-btn-two-img-icon";

$btn_one_icon_color = uabb_theme_button_text_color( $settings->_btn_one_text_color );
$btn_two_icon_color = uabb_theme_button_text_color( $settings->_btn_two_text_color );
$btn_one_icon_hover_color = uabb_theme_button_text_color( $settings->_btn_one_text_hover_color );
$btn_two_icon_hover_color = uabb_theme_button_text_color( $settings->_btn_two_text_hover_color );


/*$btn_one_img_icon = array(
	'image_type'	=> $settings->image_type_btn_one,
	'icon'			=> $settings->icon_btn_one,
	'icon_size'		=> $settings->img_icon_width_btn_one,
	'photo_source'	=> "library",
	'photo'			=> $settings->photo_btn_one,
	'photo_url'		=> "",
	'img_size'		=> $settings->img_icon_width_btn_one,
	'photo_src'		=> isset( $settings->photo_btn_one_src ) ? $settings->photo_btn_one_src : '',
	'icon_color'	=> '',//$btn_one_icon_color,
	'icon_hover_color'	=> '',//$btn_one_icon_hover_color,
);
$module->render_image_icon_css( $btn_one_fl_id, $btn_one_img_icon );

$btn_two_img_icon = array(
	'image_type'	=> $settings->image_type_btn_two,
	'icon'			=> $settings->icon_btn_two,
	'icon_size'		=> $settings->img_icon_width_btn_two,
	'photo_source'	=> "library",
	'photo'			=> $settings->photo_btn_two,
	'photo_url'		=> "",
	'img_size'		=> $settings->img_icon_width_btn_two,
	'photo_src'		=> isset( $settings->photo_btn_two_src ) ? $settings->photo_btn_two_src : '',
	'icon_color'	=> '',//$btn_two_icon_color,
	'icon_hover_color'	=> '',//$btn_two_icon_hover_color,
);
$module->render_image_icon_css( $btn_two_fl_id, $btn_two_img_icon );*/
?>
<?php if ( $settings->image_type_btn_one == 'icon') { ?>
.fl-node-<?php echo $id;?> .uabb-btn-one-img-icon .uabb-icon i,
.fl-node-<?php echo $id;?> .uabb-btn-one-img-icon .uabb-icon i:before {
    font-size: <?php echo $settings->img_icon_width_btn_one; ?>px;
    height: auto;
    width: auto;
    line-height: <?php echo $settings->img_icon_width_btn_one; ?>px;
    height: <?php echo $settings->img_icon_width_btn_one; ?>px;
    width: <?php echo $settings->img_icon_width_btn_one; ?>px;
    text-align: center;
}
<?php } elseif ( $settings->image_type_btn_one == 'photo') { ?>
.fl-node-<?php echo $id;?> .uabb-btn-one-img-icon .uabb-img-src {
	width: <?php echo $settings->img_icon_width_btn_one; ?>px;
}
<?php } ?>

<?php if ( $settings->image_type_btn_two == 'icon') { ?>
.fl-node-<?php echo $id;?> .uabb-btn-two-img-icon .uabb-icon i,
.fl-node-<?php echo $id;?> .uabb-btn-two-img-icon .uabb-icon i:before {
    font-size: <?php echo $settings->img_icon_width_btn_two; ?>px;
    height: auto;
    width: auto;
    line-height: <?php echo $settings->img_icon_width_btn_two; ?>px;
    height: <?php echo $settings->img_icon_width_btn_two; ?>px;
    width: <?php echo $settings->img_icon_width_btn_two; ?>px;
    text-align: center;
}

<?php } elseif ( $settings->image_type_btn_two == 'photo') { ?>
.fl-node-<?php echo $id;?> .uabb-btn-two-img-icon .uabb-img-src {
	width: <?php echo $settings->img_icon_width_btn_two; ?>px;
}
<?php } ?>

<?php if ( ( $settings->dual_button_style == 'flat' && $settings->flat_button_options == 'none' ) ||
	( $settings->dual_button_style == 'gradient' ) || ( $settings->dual_button_style == 'transparent' ) ) { ?>

.fl-node-<?php echo $id;?> .before.uabb-btn-one-img-icon,
.fl-node-<?php echo $id;?> .before.uabb-btn-two-img-icon {
	margin-right: 10px;
}

.fl-node-<?php echo $id;?> .after.uabb-btn-one-img-icon,
.fl-node-<?php echo $id;?> .after.uabb-btn-two-img-icon {
	margin-left: 10px;
}
<?php } ?>

.fl-node-<?php echo $id;?> .uabb-btn-one-img-icon .uabb-imgicon-wrap .uabb-icon i,
.fl-node-<?php echo $id;?> .uabb-btn-two-img-icon .uabb-imgicon-wrap .uabb-icon i {
	background: none;
}


<?php } ?>

<?php
if( $settings->dual_button_type == 'horizontal' && $settings->join_buttons == 'no' ) {
?>

.fl-node-<?php echo $id;?> .uabb-dual-button-one {
	margin-right: <?php echo $settings->spacing_between_buttons; ?>px;
}

.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-one,
.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-two {
	border-radius: <?php echo $settings->dual_button_radius;?>px;
}

.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-one {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_color ); ?>;
}
.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-two {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_color ); ?>;
}

.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn-one:hover {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
}

.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn-two:hover {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
}


<?php
}
?>

/* Horizontal Responsive */
<?php if ( $settings->dual_button_type == 'horizontal' ) { ?>

<?php if ( $settings->responive_dual_button == 'yes' ) { ?>
/*Responsive Horizontal Style */
@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {

	<?php if( $settings->dual_button_width_type == "full" || $settings->dual_button_width_type == "custom"){ ?>
		.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-btn-horizontal {
		    width: 100%;
		}
	<?php } ?>

	.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-horizontal {
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
	}

	.fl-node-<?php echo $id;?> .uabb-dual-button .uabb-middle-text {
		top: 100%;
		left: 50%;
		right: auto;
		webkit-transform: translate(-50%,-50%);
    	  -moz-transform: translate(-50%,-50%);
            -o-transform: translate(-50%,-50%);
           -ms-transform: translate(-50%,-50%);
               transform: translate(-50%,-50%);
	}

	.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-one {
		border-top-left-radius: <?php echo $settings->dual_button_radius;?>px;
		border-top-right-radius: <?php echo $settings->dual_button_radius;?>px;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
	}
	.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-two {
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		border-bottom-left-radius: <?php echo $settings->dual_button_radius;?>px;
		border-bottom-right-radius: <?php echo $settings->dual_button_radius;?>px;
	}

	<?php if ( $settings->dual_button_style == 'transparent' ) { ?>
		.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one,
		.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
			
			border-width: <?php echo $settings->button_border_width; ?>px;
			border-style: <?php echo $settings->dual_button_border_style; ?>;
			border-color: <?php echo uabb_theme_base_color( $settings->button_border_color ); ?>;
			
		}
		<?php
		if( $settings->dual_button_type == 'horizontal' && $settings->join_buttons != 'no' ) {
		?>
		.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
			border-top: 0;
		}
		<?php
		}
	} ?>

	<?php
	if( $settings->dual_button_type == 'horizontal' && $settings->join_buttons == 'no' ) {
	?>
	.fl-node-<?php echo $id;?> .uabb-dual-button-one {
		margin-right: 0;
		margin-bottom: <?php echo $settings->spacing_between_buttons; ?>px;
	}

	.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id;?> .uabb-horizontal .uabb-btn.uabb-btn-two {
		border-radius: <?php echo $settings->dual_button_radius;?>px;
	}

	<?php
	}
	?>

}
<?php } ?>
<?php } ?>



<?php
/* Typography style starts here  */

if ( $settings->_btn_one_font_family['family'] != "Default" || $settings->_btn_one_font_size['desktop'] != '' || $settings->_btn_one_line_height['desktop'] != '' ) { ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one {
		<?php if( $settings->_btn_one_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->_btn_one_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->_btn_one_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->_btn_one_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->_btn_one_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->_btn_one_line_height['desktop']; ?>px;
		<?php endif; ?>
	}
<?php } ?>

<?php
if ( $settings->_btn_two_font_family['family'] != "Default" || $settings->_btn_two_font_size['desktop'] != '' || $settings->_btn_two_line_height['desktop'] != '' ) { ?>
	.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
		<?php if( $settings->_btn_two_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->_btn_two_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->_btn_two_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->_btn_two_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->_btn_two_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->_btn_two_line_height['desktop']; ?>px;
		<?php endif; ?>
	}
<?php }

/* Typography style Ends here  */
?>

/* Typography responsive layout starts here */

<?php if($global_settings->responsive_enabled) { // Global Setting If started
	if( $settings->_btn_one_font_size['medium'] !="" || $settings->_btn_one_line_height['medium'] != "" || $settings->_btn_two_font_size['medium'] !="" || $settings->_btn_two_line_height['medium'] != "" || $settings->_divider_font_size['medium'] != "" ) {
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			<?php if( $settings->_btn_one_font_size['medium'] !="" || $settings->_btn_one_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one {
					<?php if( $settings->_btn_one_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->_btn_one_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->_btn_one_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->_btn_one_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->_btn_two_font_size['medium'] !="" || $settings->_btn_two_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
					<?php if( $settings->_btn_two_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->_btn_two_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->_btn_two_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->_btn_two_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->_divider_font_size['medium'] != "" ) { ?>
			.fl-node-<?php echo $id;?> .uabb-middle-text {
				<?php if( $settings->divider_options == 'text' && $settings->_divider_font_size['medium'] != '' ) { ?>
					font-size: <?php echo $settings->_divider_font_size['medium']; ?>px;
					width: <?php echo $settings->_divider_font_size['medium'] * 1.75 ; ?>px;
					height: <?php echo $settings->_divider_font_size['medium'] * 1.75 ; ?>px;
					line-height: <?php echo $settings->_divider_font_size['medium'] * 1.75 ; ?>px;
				<?php } ?>
			}
			<?php } ?>
	    }
	<?php
	}

	if( $settings->_btn_one_font_size['small'] !="" || $settings->_btn_one_line_height['small'] != "" || $settings->_btn_two_font_size['small'] !="" || $settings->_btn_two_line_height['small'] != "" ||  $settings->_divider_font_size['small'] != "") {
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			<?php if( $settings->_btn_one_font_size['small'] !="" || $settings->_btn_one_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-one {
					<?php if( $settings->_btn_one_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->_btn_one_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->_btn_one_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->_btn_one_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->_btn_two_font_size['small'] !="" || $settings->_btn_two_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-btn.uabb-btn-two {
					<?php if( $settings->_btn_two_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->_btn_two_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->_btn_two_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->_btn_two_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->_divider_font_size['small'] != "" ) { ?>
			.fl-node-<?php echo $id;?> .uabb-middle-text {
				<?php if( $settings->divider_options == 'text' && $settings->_divider_font_size['small'] != '' ) { ?>
					font-size: <?php echo $settings->_divider_font_size['small']; ?>px;
					width: <?php echo $settings->_divider_font_size['small'] * 1.75 ; ?>px;
					height: <?php echo $settings->_divider_font_size['small'] * 1.75 ; ?>px;
					line-height: <?php echo $settings->_divider_font_size['small'] * 1.75 ; ?>px;
				<?php } ?>
			}
			<?php } ?>
	    }
	<?php
	}
}
?>
/* Typography responsive layout Ends here */
