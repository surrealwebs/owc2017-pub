<?php 
	$settings->size = ( $settings->size != '' ) ? $settings->size : '40';
	$settings->spacing = ( $settings->spacing != '' ) ? $settings->spacing : '10';
?>

<?php if ( $settings->icon_struc_align == 'horizontal' ) { ?>


.fl-node-<?php echo $id; ?> .uabb-social-share-horizontal .uabb-social-share-link-wrap {
	margin-bottom: <?php echo $settings->spacing; ?>px;
	<?php
	if( $settings->align == 'left' ) {
	?>
	margin-right: <?php echo $settings->spacing; ?>px;
	<?php
	} else if( $settings->align == 'right' ) {
	?>
	margin-left: <?php echo $settings->spacing; ?>px;
	<?php
	} else {
	?>
	margin-left: <?php echo intval($settings->spacing)/2; ?>px;
	margin-right: <?php echo intval($settings->spacing)/2; ?>px;
	<?php
	}
	?>
}

<?php } ?>

<?php if ( $settings->icon_struc_align == 'vertical' ) { ?>
	

.fl-node-<?php echo $id; ?> .uabb-social-share-vertical .uabb-social-share-link-wrap {
	margin-bottom: <?php echo $settings->spacing; ?>px;
}

<?php } ?>

<?php 
$icon_count = 1;
$settings->bg_border_radius = ( $settings->bg_border_radius !== '' ) ? $settings->bg_border_radius : '0';
foreach ( $settings->social_icons as $i => $icon ) : 

	$icon->bg_color = uabb_theme_base_color( UABB_Helper::uabb_colorpicker( $icon, 'bg_color', true ) );
	$icon->bg_hover_color = uabb_theme_base_color( UABB_Helper::uabb_colorpicker( $icon, 'bg_hover_color', true ) );	

	$imageicon_array = array(

	  /* General Section */
	  'image_type' => $icon->image_type,

	  /* Icon Basics */
	  'icon' => $icon->icon,
	  'icon_size' => $settings->size,
	  'icon_align' => $settings->align,

	  /* Image Basics */
	  'photo_source' => 'library',
	  'photo' => $icon->photo,
	  'photo_url' => '',
	  'img_size' => ( $settings->icoimage_style == 'custom' || $settings->icoimage_style == 'simple') ? $settings->size : ( $settings->size * 2 ),
	  'img_align' => $settings->align,
	  'photo_src' => ( isset( $icon->photo_src ) ) ? $icon->photo_src : '' ,


	  /* Icon Style */
	  'icon_style' => $settings->icoimage_style,
	  'icon_bg_size' => ( (int)$settings->bg_size * 2 ),
	  'icon_border_style' => $settings->border_style,
	  'icon_border_width' => $settings->border_width,
	  'icon_bg_border_radius' => $settings->bg_border_radius,

	  /* Image Style */
	  'image_style' => $settings->icoimage_style,
	  'img_bg_size' => $settings->bg_size,
	  'img_border_style' => $settings->border_style,
	  'img_border_width' => $settings->border_width,
	  'img_bg_border_radius' => $settings->bg_border_radius,

	  /* Preset Color variable new */
	  'icon_color_preset' => 'preset1', 
	  
	  /* Icon Colors */
	  'icon_color' => $icon->icocolor,
	  'icon_hover_color' => $icon->icohover_color,
	  'icon_bg_color' => $icon->bg_color,
	  'icon_bg_color_opc' => $icon->bg_color_opc,
	  'icon_bg_hover_color' => $icon->bg_hover_color,
	  'icon_bg_hover_color_opc' => $icon->bg_hover_color_opc,
	  'icon_border_color' => $icon->border_color,
	  'icon_border_hover_color' => $icon->border_hover_color,
	  'icon_three_d' => $settings->three_d,

	  /* Image Colors */
	  'img_bg_color' => $icon->bg_color,
	  'img_bg_color_opc' => $icon->bg_color_opc,
	  'img_bg_hover_color' => $icon->bg_hover_color,
	  'img_bg_hover_color_opc' => $icon->bg_hover_color_opc,
	  'img_border_color' => $icon->border_color,
	  'img_border_hover_color' => $icon->border_hover_color,
	  
	);
	FLBuilder::render_module_css('image-icon', $id.' .uabb-social-share-'.$icon_count, $imageicon_array);

	

	//if( /*$icon->image_type == 'photo'*/1 ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-social-share-<?php echo $icon_count; ?> .uabb-imgicon-wrap .uabb-image-content {
		<?php
		echo (  $settings->icoimage_style != 'simple'  ) ? 'background: ' . uabb_theme_base_color( $icon->bg_color ) . ';' : '';
		echo ( $settings->icoimage_style == 'circle' ) ? 'border-radius: 100%;' : '';

		/* Gradient Color */
        if( $settings->three_d && $settings->icoimage_style != 'simple' ) {

            $bg_color      = $icon->bg_color;
            $bg_grad_start = '#'.FLBuilderColor::adjust_brightness($bg_color, 40, 'lighten');
		?>

		background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $icon->bg_color; ?> 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $icon->bg_color; ?>)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $icon->bg_color; ?> 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $icon->bg_color; ?> 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $icon->bg_color; ?> 100%); /* IE10+ */
        background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $icon->bg_color; ?> 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $icon->bg_color; ?>',GradientType=0 ); /* IE6-9 */

        <?php
    	}
        ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-social-share-<?php echo $icon_count; ?> .uabb-imgicon-wrap .uabb-image-content:hover {
	<?php
		echo (  $settings->icoimage_style != 'simple'  ) ? 'background: ' . uabb_theme_base_color( $icon->bg_hover_color ) . ';' : '';
		if( $settings->three_d && !empty( $icon->bg_hover_color ) && $settings->icoimage_style != 'simple' ) {
	            $bg_hover_color = ( !empty($icon->bg_hover_color) ) ? uabb_parse_color_to_hex( $icon->bg_hover_color ) : '' ;
	            
	            $bg_hover_grad_start = '#'.FLBuilderColor::adjust_brightness($bg_hover_color, 40, 'lighten');
	    ?>
	    background: -moz-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%, <?php echo $icon->bg_hover_color; ?> 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_hover_grad_start; ?>), color-stop(100%,<?php echo $icon->bg_hover_color; ?>)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $icon->bg_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $icon->bg_hover_color; ?> 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $icon->bg_hover_color; ?> 100%); /* IE10+ */
        background: linear-gradient(to bottom,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $icon->bg_hover_color; ?> 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_hover_grad_start; ?>', endColorstr='<?php echo $icon->bg_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	    <?php
	    }
	?>
	}
	<?php
	//}
	if( isset( $settings->responsive_align ) ) {
		if( $settings->responsive_align != '' && $settings->responsive_align != 'default' ) {
	?>
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
		.fl-node-<?php echo $id; ?> .uabb-social-share-<?php echo $icon_count; ?> .uabb-imgicon-wrap {
			text-align: <?php echo $settings->responsive_align; ?>;
		}
	}
	<?php
		}
	}
	$icon_count = $icon_count + 1;
endforeach; ?>

.fl-node-<?php echo $id; ?> .uabb-social-share-wrap {
	text-align: <?php echo $settings->align; ?>;
}

<?php
if( isset( $settings->responsive_align ) ) {
	if( $settings->responsive_align != '' && $settings->responsive_align != 'default' ) {
?>
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
	.fl-node-<?php echo $id; ?> .uabb-social-share-wrap {
		text-align: <?php echo $settings->responsive_align; ?>;
	}

	<?php
	if( $settings->responsive_align != 'center' ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-social-share-<?php echo $settings->align; ?> .uabb-social-share-link-wrap {
		<?php
		if( $settings->responsive_align == 'left' ) {
		?>
		margin-right: <?php echo $settings->spacing; ?>px;
		margin-left: 0;
		<?php
		} else if( $settings->responsive_align == 'right' ) {
		?>
		margin-left: <?php echo $settings->spacing; ?>px;
		margin-right: 0;
		<?php
		} else {
		?>
		margin-left: <?php echo intval($settings->spacing)/2; ?>px;
		margin-right: <?php echo intval($settings->spacing)/2; ?>px;
		<?php
		}
		?>
	}
	<?php
	}
	?>
}
<?php
	}
}
?>