<?php
$settings->background_color = UABB_Helper::uabb_colorpicker( $settings, 'background_color', true );
$settings->overlay_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );

$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );
$settings->link_color = UABB_Helper::uabb_colorpicker( $settings, 'link_color' );

?>

 /* Min height */
<?php
if( $settings->min_height_switch == 'custom' && $settings->min_height != '' ) {
	$vertical_align = 'center';
	$prefix_vertical_align = 'center';
	if (  $settings->vertical_align != 'middle' ) {
		$vertical_align = ( $settings->vertical_align == 'top' ) ? 'flex-start' : 'flex-end' ;
		$prefix_vertical_align = ( $settings->vertical_align == 'top' ) ? 'start' : 'end' ;
	}
?>
.fl-node-<?php echo $id; ?> .uabb-ultb3-box {

	min-height: <?php echo $settings->min_height; ?>px;
	-ms-grid-row-align: <?php echo $prefix_vertical_align; ?>;
	-webkit-box-align: <?php echo $prefix_vertical_align; ?>;
       -ms-flex-align: <?php echo $prefix_vertical_align; ?>;
    	  align-items: <?php echo $vertical_align; ?>;
}

.internet-explorer .fl-node-<?php echo $id; ?> .uabb-ultb3-box {
	height: <?php echo $settings->min_height; ?>px;
}

/*.fl-node-<?php echo $id; ?> .uabb-ultb3-info {
	position: absolute;
	<?php if ( $settings->vertical_align == 'top' ) { ?>
	top: 0;
	<?php } elseif ( $settings->vertical_align == 'middle' ) { ?>
	top: 50%;
    -webkit-transform: translateY(-50%);
       -moz-transform: translateY(-50%);
    	-ms-transform: translateY(-50%);
    	 -o-transform: translateY(-50%);
    		transform: translateY(-50%)
	<?php } elseif ( $settings->vertical_align == 'bottom' ) { ?>
	bottom: 0;
	<?php } ?>
}*/
<?php
}
if( $settings->background_color != '' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-ultb3-box {
	background: <?php echo $settings->background_color; ?>;
}
<?php
}
?>

/* Title Typography and Color */
.fl-node-<?php echo $id; ?> .uabb-ultb3-box .uabb-ultb3-title {
   	<?php if( $settings->font_family['family'] != "Default" ){ ?>
   		<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
   	<?php } ?>
   	<?php if( $settings->font_size['desktop'] != '' ){ ?>
   		font-size: <?php echo $settings->font_size['desktop']; ?>px;
   		<?php /*line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;*/ ?>
   	<?php } ?>
   	<?php if( $settings->line_height['desktop'] != '' ){ ?>
   		line-height: <?php echo $settings->line_height['desktop']; ?>px;
   	<?php } ?>
   	<?php if( $settings->color != '' ){ ?>
   		color: <?php echo $settings->color; ?>;
   	<?php } ?>

   	<?php if( $settings->title_margin_top != '' ){ ?>
   		margin-top: <?php echo $settings->title_margin_top; ?>px;
   	<?php } ?>

   	<?php if( $settings->title_margin_bottom != '' ){ ?>
   		margin-bottom: <?php echo $settings->title_margin_bottom; ?>px;
   	<?php } ?>
}

/* Description Typography and Color */
.fl-node-<?php echo $id; ?> .uabb-text-editor {
    <?php if( $settings->desc_font_family['family'] != "Default" ){ ?>
   		<?php UABB_Helper::uabb_font_css( $settings->desc_font_family ); ?>
   	<?php } ?>
   	<?php if( $settings->desc_font_size['desktop'] != '' ){ ?>
   		font-size: <?php echo $settings->desc_font_size['desktop']; ?>px;
   		/*line-height: <?php echo $settings->desc_font_size['desktop'] + 2; ?>px;*/
   	<?php } ?>
   	<?php if( $settings->desc_line_height['desktop'] != '' ){ ?>
   		line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
   	<?php } ?>
   	<?php if( $settings->desc_color != '' ){ ?>
   		color: <?php echo $settings->desc_color; ?>;
   	<?php } ?>

   	<?php if( $settings->desc_margin_top != '' ){ ?>
   		margin-top: <?php echo $settings->desc_margin_top; ?>px;
   	<?php } ?>

   	<?php if( $settings->desc_margin_bottom != '' ){ ?>
   		margin-bottom: <?php echo $settings->desc_margin_bottom; ?>px;
   	<?php } ?>
}


<?php
if($settings->cta_type == 'button') {
	/* Button Render Css */
	FLBuilder::render_module_css('uabb-button', $id, array(

    	/* General Section */
        'text'              => $settings->btn_text,
        
        /* Link Section */
        'link'              => $settings->btn_link,
        'link_target'       => $settings->btn_link_target,
        
        /* Style Section */
        'style'             => $settings->btn_style,
        'border_size'       => $settings->btn_border_size,
        'transparent_button_options' => $settings->btn_transparent_button_options,
        'threed_button_options'      => $settings->btn_threed_button_options,
        'flat_button_options'        => $settings->btn_flat_button_options,

        /* Colors */
        'bg_color'          => $settings->btn_bg_color,
        'bg_color_opc'          => $settings->btn_bg_color_opc,
        'bg_hover_color'    => $settings->btn_bg_hover_color,
        'bg_hover_color_opc'    => $settings->btn_bg_hover_color_opc,
        'text_color'        => $settings->btn_text_color,
        'text_hover_color'  => $settings->btn_text_hover_color,
        'hover_attribute'	=> $settings->hover_attribute,

        /* Icon */
        'icon'              => $settings->btn_icon,
        'icon_position'     => $settings->btn_icon_position,
        
        /* Structure */
        'width'              => $settings->btn_width,
        'custom_width'       => $settings->btn_custom_width,
        'custom_height'      => $settings->btn_custom_height,
        'padding_top_bottom' => $settings->btn_padding_top_bottom,
        'padding_left_right' => $settings->btn_padding_left_right,
        'border_radius'      => $settings->btn_border_radius,
        'align'              => $settings->banner_alignemnt,
        'mob_align'          => '',

        /* Typography */
        'font_size'         => $settings->tbtn_font_size,
        'line_height'       => $settings->tbtn_line_height,
        'font_family'       => $settings->tbtn_font_family,
	));
}
?>


.fl-node-<?php echo $id; ?> .uabb-ultb3-box-overlay {
    <?php if ( $settings->overlay_color != '' ) { ?>
    	background-color: <?php echo $settings->overlay_color; ?>;
    <?php } ?> 
}

/* Typography Options for Link Text */
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-infobanner-cta-link {
	<?php if( $settings->link_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->link_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->link_font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->link_font_size['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->link_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->link_line_height['desktop']; ?>px;
	<?php endif; ?>
}

/* Link Color */
<?php if( !empty($settings->link_color) ) : ?> 
.fl-builder-content .fl-node-<?php echo $id; ?> a,
.fl-builder-content .fl-node-<?php echo $id; ?> a *,
.fl-builder-content .fl-node-<?php echo $id; ?> a:visited {
	color: <?php echo uabb_theme_text_color( $settings->link_color ); ?>;
}
<?php endif; ?>


<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( $settings->desc_font_size['medium'] != "" || $settings->desc_line_height['medium'] != "" || $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" )
	{
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-ultb3-box .uabb-ultb3-title {
			   	<?php if( $settings->font_size['medium'] != '' ){ ?>
			   		font-size: <?php echo $settings->font_size['medium']; ?>px;
			   		/*line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;*/
			   	<?php } ?>
			   	<?php if( $settings->line_height['medium'] != '' ){ ?>
			   		line-height: <?php echo $settings->line_height['medium']; ?>px;
			   	<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-text-editor {
			   	<?php if( $settings->desc_font_size['medium'] != '' ){ ?>
			   		font-size: <?php echo $settings->desc_font_size['medium']; ?>px;
			   		<?php /*line-height: <?php echo $settings->desc_font_size['medium'] + 2; ?>px;*/ ?>
			   	<?php } ?>
			   	<?php if( $settings->desc_line_height['medium'] != '' ){ ?>
			   		line-height: <?php echo $settings->desc_line_height['medium']; ?>px;
			   	<?php } ?>
			}

			fl-builder-content .fl-node-<?php echo $id; ?>	.uabb-infobanner-cta-link {

				<?php if( $settings->link_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->link_font_size['medium']; ?>px;
				<?php endif; ?>

				<?php if( $settings->link_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->link_line_height['medium']; ?>px;
				<?php endif; ?>
			}
	    }
	<?php
	}
	if( $settings->desc_font_size['small'] != "" || $settings->desc_line_height['small'] != "" || $settings->font_size['small'] != "" || $settings->line_height['small'] != "" || $settings->responsive_min_height_switch == 'custom')
	{
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-ultb3-box .uabb-ultb3-title {
			   	<?php if( $settings->font_size['small'] != '' ){ ?>
			   		font-size: <?php echo $settings->font_size['small']; ?>px;
			   		<?php /*line-height: <?php echo $settings->font_size['small'] + 2; ?>px;*/ ?>
			   	<?php } ?>
			   	<?php if( $settings->line_height['small'] != '' ){ ?>
			   		line-height: <?php echo $settings->line_height['small']; ?>px;
			   	<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-text-editor {
			   	<?php if( $settings->desc_font_size['small'] != '' ){ ?>
			   		font-size: <?php echo $settings->desc_font_size['small']; ?>px;
			   		<?php /*line-height: <?php echo $settings->desc_font_size['small'] + 2; ?>px;*/ ?>
			   	<?php } ?>
			   	<?php if( $settings->desc_line_height['small'] != '' ){ ?>
			   		line-height: <?php echo $settings->desc_line_height['small']; ?>px;
			   	<?php } ?>
			}

			.fl-builder-content .fl-node-<?php echo $id; ?>	.uabb-infobanner-cta-link {

				<?php if( $settings->link_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->link_font_size['small']; ?>px;
				<?php endif; ?>

				<?php if( $settings->link_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->link_line_height['small']; ?>px;
				<?php endif; ?>
			}

			<?php if( $settings->responsive_min_height_switch == 'custom' ) { 

				$vertical_align = 'center';
				$prefix_vertical_align = 'center';
				if (  $settings->responsive_vertical_align != 'middle' ) {
					$vertical_align = ( $settings->responsive_vertical_align == 'top' ) ? 'flex-start' : 'flex-end' ;
					$prefix_vertical_align = ( $settings->responsive_vertical_align == 'top' ) ? 'start' : 'end' ;
				}
			?>
			.fl-node-<?php echo $id; ?> .uabb-ultb3-box {
				min-height: <?php echo $settings->responsive_min_height; ?>px;
				-ms-grid-row-align: <?php echo $prefix_vertical_align; ?>;
				-webkit-box-align: <?php echo $prefix_vertical_align; ?>;
       			   -ms-flex-align: <?php echo $prefix_vertical_align; ?>;
    	  			  align-items: <?php echo $vertical_align; ?>;
			}

			.internet-explorer .fl-node-<?php echo $id; ?> .uabb-ultb3-box {
				height: <?php echo $settings->responsive_min_height; ?>px;
			}

			<?php } ?>

	    }
	<?php
	}

	/* Responsive Nature */
	if( $settings->responsive_nature == 'custom' ) :

		if( $settings->res_medium_width != '' ) : ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-ultb3-img {
				width: <?php echo $settings->res_medium_width; ?>px !important;
			}		
		}
		<?php endif;

		if( $settings->res_small_width != '' ) : ?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-ultb3-img {
				width: <?php echo $settings->res_small_width; ?>px !important;
			}		
		}
		<?php endif;
	endif;
}
?>