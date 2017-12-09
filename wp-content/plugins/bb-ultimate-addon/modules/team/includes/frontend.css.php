<?php 
    $settings->img_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_color', true );
    $settings->text_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'text_bg_color', true );
    
    // $settings->icobg_color = UABB_Helper::uabb_colorpicker( $settings, 'icobg_color', true );
    // $settings->icobg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icobg_hover_color', true );
    // $settings->icoborder_color = UABB_Helper::uabb_colorpicker( $settings, 'icoborder_color', true );
    // $settings->icoborder_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icoborder_hover_color', true );
    // $settings->icocolor = UABB_Helper::uabb_colorpicker( $settings, 'icocolor' );
    // $settings->icohover_color = UABB_Helper::uabb_colorpicker( $settings, 'icohover_color' );
    
    $settings->separator_color = UABB_Helper::uabb_colorpicker( $settings, 'separator_color' );
    $settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
    $settings->desg_color = UABB_Helper::uabb_colorpicker( $settings, 'desg_color' );
    $settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );

    $settings->module_border_radius = ( trim( $settings->module_border_radius ) !== '' ) ? $settings->module_border_radius : '0';
    $settings->separator_height = ( trim( $settings->separator_height ) !== '' ) ? $settings->separator_height : '1';
    $settings->separator_width = ( trim( $settings->separator_width ) !== '' ) ? $settings->separator_width : '100';
?>
/* Alignment */

.fl-node-<?php echo $id; ?> .uabb-team-content,
.fl-node-<?php echo $id; ?> .uabb-team-social {
	text-align: <?php echo $settings->text_alignment; ?>;
}

/* Image Section Spacing */
.fl-node-<?php echo $id; ?> .uabb-team-image {
	<?php echo $settings->img_spacing; ?>px;
	<?php if ( !empty( $settings->img_bg_color ) ) { ?>
		background: <?php echo $settings->img_bg_color; ?>;
	<?php } ?>
}

/* Module Border Radius */
<?php if ( $settings->module_border_radius != '' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-team-wrap {
		border-radius: <?php echo $settings->module_border_radius; ?>px;
	}
	.fl-node-<?php echo $id; ?> .uabb-image .uabb-photo-img {
		border-top-left-radius: <?php echo $settings->module_border_radius; ?>px;
		border-top-right-radius: <?php echo $settings->module_border_radius; ?>px;
	}
<?php } ?>

/* Text BG Color and Spacing */
.fl-node-<?php echo $id; ?> .uabb-team-content {
	<?php echo $settings->text_spacing; ?>px;
	<?php if ( !empty( $settings->text_bg_color ) ) { ?>
		background: <?php echo $settings->text_bg_color; ?>;
	<?php } ?>
}

<?php

/* Render Separator */

if( $settings->enable_separator == 'block' ) {
	FLBuilder::render_module_css('uabb-separator', $id, array(
		'color'			=> $settings->separator_color,
		'height'		=> $settings->separator_height,
		'width'			=> $settings->separator_width,
		'alignment'		=> $settings->separator_alignment,
		'style'			=> $settings->separator_style
	));
?>

.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-separator {
	margin-top: <?php echo ( $settings->separator_margin_top != '' ) ? $settings->separator_margin_top : '10'; ?>px;
	margin-bottom: <?php echo ( $settings->separator_margin_bottom != '' ) ? $settings->separator_margin_bottom : '10'; ?>px;
}
<?php }

/* Render Team Image */
/* CSS "$settings" Array */
$imageicon_array = array(
  	
  	/* General Section */
    'image_type' 	=> 'photo',
 
    /* Icon Basics */
    'icon' 			=> '',
    'icon_size' 	=> '',
    'icon_align' 	=> '',
 
    /* Image Basics */
    'photo_source' 	=> $settings->photo_source,
    'photo' 		=> $settings->photo,
    'photo_url' 	=> $settings->photo_url,
    'img_size' 		=> $settings->img_size,
    'img_align' 	=> 'center',
    'photo_src' 	=> ( isset( $settings->photo_src ) ) ? $settings->photo_src : '' ,
 	
 	/* Icon Style */
    'icon_style' 			=> '',
    'icon_bg_size' 			=> '',
    'icon_border_style' 	=> '',
    'icon_border_width' 	=> '',
    'icon_bg_border_radius' => '',
 	
 	/* Image Style */
    'image_style' 			=> $settings->image_style,
    'img_bg_size' 			=> '', //$settings->img_bg_size,
    'img_border_style' 		=> '', //$settings->img_border_style,
    'img_border_width' 		=> '', //$settings->img_border_width,
    'img_bg_border_radius' 	=> '', //$settings->img_bg_border_radius,
		
		/* Preset Color variable new */
  	'icon_color_preset' 	=> 'preset1',

  	/* Icon Colors */ 
  	'icon_color' 			=> '',
  	'icon_hover_color' 		=> '',
  	'icon_bg_color' 		=> '',
  	'icon_bg_hover_color' 	=> '',
  	'icon_border_color' 	=> '',
  	'icon_border_hover_color' => '',
  	'icon_three_d' 			=> '',

  	/* Image Colors */
  	'img_bg_color' 			=> $settings->img_bg_color == '' ? '#ffffff' : $settings->img_bg_color,
  	'img_bg_hover_color' 	=> '',//$settings->img_bg_hover_color,
  	'img_border_color' 		=> '',//$settings->img_border_color,
  	'img_border_hover_color'=> '',//$settings->img_border_hover_color,
);
 
/* CSS Render Function */ 
FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
if( $settings->img_size != '' && $settings->photo != '' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-image-content {
	width: <?php echo $settings->img_size; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap .uabb-image .uabb-photo-img {
	width: <?php echo $settings->img_size; ?>px;
}
<?php
}
?>
<?php
if( $settings->photo_style == 'simple' ) {
	if( $settings->img_grayscale_simple != 'yes' ) {
?>
		.fl-node-<?php echo $id; ?> .uabb-team-wrap:hover img {
			-webkit-filter: grayscale(100%);
			-webkit-filter: grayscale(1);
			filter: grayscale(100%);
		}
<?php
	}
} else if( $settings->photo_style == 'grayscale' ) {
	if( $settings->img_grayscale_grayscale != 'yes' ) {
?>
		.fl-node-<?php echo $id; ?> .uabb-team-wrap:hover img {
			-webkit-filter: grayscale(0);
			filter: none;
		}
<?php
	}
}
?>
<?php /*if( $settings->img_grayscale == 'gray_color' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-team-wrap:hover img {
    	-webkit-filter: grayscale(0);
		        filter: none;
	  
	}
<?php }elseif ( $settings->img_grayscale == 'color_gray'  ) { ?>
 .fl-node-<?php echo $id; ?> .uabb-team-wrap:hover img {
	  -webkit-filter: grayscale(100%);
	  -webkit-filter: grayscale(1);
	          filter: grayscale(100%);
	  		  
	  		  filter: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feColorMatrix type="matrix" color-interpolation-filters="sRGB" values="0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0 0 0 1 0" /></filter></svg>#filter');
	  		  filter: gray;
	}
<?php }*/ ?>

/* Spacing */
.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {
	margin-top: <?php echo ( $settings->name_margin_top != '' ) ? $settings->name_margin_top : 0; ?>px;
	margin-bottom: <?php echo ( $settings->name_margin_bottom != '' ) ? $settings->name_margin_bottom : 0; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {
	margin-top: <?php echo ( $settings->desg_margin_top != '' ) ? $settings->desg_margin_top : 0; ?>px;
	margin-bottom: <?php echo ( $settings->desg_margin_bottom != '' ) ? $settings->desg_margin_bottom : 0; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-team-desc-text {
	margin-top: <?php echo ( $settings->desc_margin_top != '' ) ? $settings->desc_margin_top : 0; ?>px;
	margin-bottom: <?php echo ( $settings->desc_margin_bottom != '' ) ? $settings->desc_margin_bottom : 15; ?>px;
}

/* Render Social Icons */

<?php 
if ( $settings->enable_social_icons == 'yes' ) {
	$icon_count = 1;
	foreach ( $settings->icons as $i => $icon ) : 	
		$icon->icobg_color = UABB_Helper::uabb_colorpicker( $icon, 'icobg_color', true );
    	$icon->icobg_hover_color = UABB_Helper::uabb_colorpicker( $icon, 'icobg_hover_color', true );
    	$icon->icoborder_color = UABB_Helper::uabb_colorpicker( $icon, 'icoborder_color' );
    	$icon->icoborder_hover_color = UABB_Helper::uabb_colorpicker( $icon, 'icoborder_hover_color' );
    	$icon->icocolor = UABB_Helper::uabb_colorpicker( $icon, 'icocolor' );
    	$icon->icohover_color = UABB_Helper::uabb_colorpicker( $icon, 'icohover_color' );

		$imageicon_array = array(

				  /* General Section */
				  'image_type' 	=> 'icon',

				  /* Icon Basics */
				  'icon' 		=> $icon->icon,
				  'icon_size' 	=> $settings->icon_size,
				  'icon_align' 	=> 'center',

				  /* Image Basics */
				  'photo_source' 	=> '',
				  'photo' 			=> '',
				  'photo_url' 		=> '',
				  'img_size' 		=> '',
				  'img_align' 		=> '',
				  'photo_src' 		=> '' ,

				  /* Icon Style */
				  'icon_style' 				=> $settings->icon_style,
				  'icon_bg_size' 			=> ( trim($settings->icon_bg_size) !== '' ) ? $settings->icon_bg_size : '30',
				  'icon_border_style' 		=> $settings->icon_border_style,
				  'icon_border_width' 		=> $settings->icon_border_width,
				  'icon_bg_border_radius' 	=> ( trim($settings->icon_bg_border_radius) !== '' ) ? $settings->icon_bg_border_radius : '20',

				  /* Image Style */
				  'image_style' 			=> '',
				  'img_bg_size' 			=> '',
				  'img_border_style' 		=> '',
				  'img_border_width' 		=> '',
				  'img_bg_border_radius' 	=> '',

				  /* Preset Color variable new */
				  'icon_color_preset' => $settings->icon_color_preset, 
				  
				  /* Icon Colors */
				  'icon_color' 				=> ( !empty($icon->icocolor) ) ? $icon->icocolor : $settings->icon_color,
				  'icon_hover_color' 		=> ( !empty($icon->icohover_color) ) ? $icon->icohover_color : $settings->icon_hover_color,
				  'icon_bg_color' 			=> ( !empty($icon->icobg_color) ) ? $icon->icobg_color : $settings->icon_bg_color,
				  'icon_bg_color_opc' 			=> ( !empty($icon->icobg_color_opc) ) ? $icon->icobg_color_opc : $settings->icon_bg_color_opc,
				  'icon_bg_hover_color' 	=> ( !empty($icon->icobg_hover_color) ) ? $icon->icobg_hover_color : $settings->icon_bg_hover_color,
				  'icon_bg_hover_color_opc' 	=> ( !empty($icon->icobg_hover_color_opc) ) ? $icon->icobg_hover_color_opc : $settings->icon_bg_hover_color_opc,
				  'icon_border_color' 		=> ( !empty($icon->icoborder_color) ) ? $icon->icoborder_color : $settings->icon_border_color,
				  'icon_border_hover_color' => ( !empty($icon->icoborder_hover_color) ) ? $icon->icoborder_hover_color : $settings->icon_border_hover_color,
				  'icon_three_d' 			=> $settings->icon_three_d,

				  /* Image Colors */
				  'img_bg_color' 			=> '',
				  'img_bg_hover_color' 		=> '',
				  'img_border_color' 		=> '',
				  'img_border_hover_color' 	=> '',
				);
		FLBuilder::render_module_css('image-icon', $id.' .uabb-team-icon-'.$icon_count, $imageicon_array);
		$icon_count = $icon_count + 1;
	endforeach;?>

	<?php if ( $settings->text_alignment == 'left' ) { ?>
		<?php $social_margin = ( trim( $settings->spacing ) !== '' ) ? $settings->spacing : '10'; ?>
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link {
			margin: 0 <?php echo $social_margin; ?>px <?php echo $social_margin; ?>px 0;
		}
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link:last-child {
			margin-right: 0px;
		}
	<?php }elseif ( $settings->text_alignment == 'right' ) { ?>
		<?php $social_margin = ( trim( $settings->spacing ) !== '' ) ? $settings->spacing : '10'; ?>
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link {
			margin: 0 0 <?php echo $social_margin; ?>px <?php echo $social_margin; ?>px;  
		}
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link:first-child {
			margin-left: 0px;
		}
	<?php }else{ ?>
		<?php $social_margin = ( trim( $settings->spacing ) !== '' ) ? $settings->spacing : '10'; 
		  	  $social_margin_lr = ( intval($social_margin) !== 0 ) ? intval($social_margin)/2 : $social_margin;
			?>
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link {
			margin: 0 <?php echo $social_margin_lr; ?>px <?php echo $social_margin; ?>px <?php echo $social_margin_lr; ?>px;  
		}
	<?php } ?>

	
<?php } ?>

/* Typography */
/* Name Text Typography */
.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {
   	<?php if( $settings->font_family['family'] != "Default") : ?>
	font-family: <?php  echo $settings->font_family['family']; ?>;
		   	<?php if( $settings->font_family['weight'] != "regular") : ?>
			font-weight: <?php  echo $settings->font_family['weight']; ?>;
			<?php endif; ?>
	<?php endif; ?>

	<?php if( $settings->font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->color != '' ) : ?>
	color: <?php echo $settings->color; ?>;
	<?php endif; ?>
}

/* Designation Text Typography */
.fl-node-<?php echo $id; ?> .uabb-team-desgn-text{
   	<?php if( $settings->desg_font_family['family'] != "Default") : ?>
	font-family: <?php  echo $settings->desg_font_family['family']; ?>;
		   	<?php if( $settings->desg_font_family['weight'] != "regular") : ?>
			font-weight: <?php  echo $settings->desg_font_family['weight']; ?>;
			<?php endif; ?>
	<?php endif; ?>

	<?php if( $settings->desg_font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->desg_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->desg_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->desg_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->desg_color != '' ) : ?>
	color: <?php echo $settings->desg_color; ?>;
	<?php endif; ?>
}

/* Description Text Typography */
.fl-node-<?php echo $id; ?> .uabb-team-desc-text {
   	<?php if( $settings->desc_font_family['family'] != "Default") : ?>
	font-family: <?php  echo $settings->desc_font_family['family']; ?>;
		   	<?php if( $settings->desc_font_family['weight'] != "regular") : ?>
			font-weight: <?php  echo $settings->desc_font_family['weight']; ?>;
			<?php endif; ?>
	<?php endif; ?>

	<?php if( $settings->desc_font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->desc_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->desc_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->desc_color != '' ) : ?>
	color: <?php echo $settings->desc_color; ?>;
	<?php endif; ?>
}



<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" || 
		$settings->desg_font_size['medium'] != "" || $settings->desg_line_height['medium'] != "" || 
		$settings->desc_font_size['medium'] != "" || $settings->desc_line_height['medium'] != "" )
	{
		/* Medium Breakpoint media query */	
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			/* Name Text Typography */
			.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {
				<?php if( $settings->font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['medium']; ?>px;
				line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php endif; ?>
			}

			/* Desg Text */
			.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {
				<?php if( $settings->desg_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->desg_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->desg_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->desg_line_height['medium']; ?>px;
				<?php endif; ?>
			}

			/* Desc Text */
			.fl-node-<?php echo $id; ?> .uabb-team-desc-text {
				<?php if( $settings->desg_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->desg_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->desg_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->desg_line_height['medium']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php
	}
	if( $settings->font_size['small'] != "" || $settings->line_height['small'] != "" || 
		$settings->desg_font_size['small'] != "" || $settings->desg_line_height['small'] != "" || 
		$settings->desc_font_size['small'] != "" || $settings->desc_line_height['small'] != "" )
	{
		/* Small Breakpoint media query */	
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			/* Name Text Typography */
			.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {
				<?php if( $settings->font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['small']; ?>px;
				line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
				<?php endif; ?>

				<?php if( $settings->line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>
			}

			/* Desg Text */
			.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {
				<?php if( $settings->desg_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->desg_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->desg_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->desg_line_height['small']; ?>px;
				<?php endif; ?>
			}

			/* Desc Text */
			.fl-node-<?php echo $id; ?> .uabb-team-desc-text {
				<?php if( $settings->desg_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->desg_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->desg_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->desg_line_height['small']; ?>px;
				<?php endif; ?>
			}
		}		
	<?php
	}
}
