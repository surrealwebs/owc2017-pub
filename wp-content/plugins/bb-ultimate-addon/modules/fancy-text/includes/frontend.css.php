<?php
$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->fancy_color = UABB_Helper::uabb_colorpicker( $settings, 'fancy_color' );

?>

.fl-node-<?php echo $id; ?> .uabb-fancy-text-wrap {
	text-align: <?php echo $settings->alignment; ?>;
	<?php if ( $settings->effect_type == 'type' ) { ?>
	min-height: <?php echo $settings->min_height; ?>px;
	<?php } ?>
}

<?php if( !empty( $settings->prefix ) ) {?>
.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix {
	margin-right:<?php echo $settings->space_prefix; ?>px;
}
<?php } ?>

<?php if( !empty( $settings->suffix ) ) {?>
.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix {
	margin-left:<?php echo $settings->space_suffix; ?>px;
}
<?php } ?>

/* Prefix - Suffix Typography */
.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix,
.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix {
   	<?php if( $settings->font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
	<?php endif; ?>

	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->color != '' ) : ?>
	color: <?php echo $settings->color; ?>;
	<?php endif; ?>
}

/* Fancy Text Typography */
.fl-node-<?php echo $id; ?> .uabb-fancy-text-main {
	<?php if( $settings->fancy_font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->fancy_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->fancy_font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->fancy_font_size['desktop']; ?>px;
	line-height: <?php echo $settings->fancy_font_size['desktop'] + 2; ?>px;
	<?php endif; ?>

	<?php if( $settings->fancy_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->fancy_line_height['desktop']; ?>px;
	<?php endif; ?>

	<?php if( $settings->fancy_color != '' ) : ?>
	color: <?php echo $settings->fancy_color; ?>;
	<?php endif; ?>
}

<?php 
if( $settings->effect_type == 'type' && $settings->show_cursor == 'yes' && $settings->cursor_blink == 'yes' ) { ?>
	.uabb-fancy-text-wrap .typed-cursor{
	    opacity: 1;
	    -webkit-animation: blink-cursor 0.7s infinite;
	       -moz-animation: blink-cursor 0.7s infinite;
	            animation: blink-cursor 0.7s infinite;
	}
	@keyframes blink-cursor{
	    0% { opacity:1; }
	    50% { opacity:0; }
	    100% { opacity:1; }
	}
	@-webkit-keyframes blink-cursor{
	    0% { opacity:1; }
	    50% { opacity:0; }
	    100% { opacity:1; }
	}
	@-moz-keyframes blink-cursor{
	    0% { opacity:1; }
	    50% { opacity:0; }
	    100% { opacity:1; }
	}
<?php } ?>



<?php
/* Need it later for background 
.fl-node-<?php echo $id; ?> .uabb-fancy-text-main
{
	<?php 
	if( !empty( $settings->fancy_text_color) ){
		echo 'color: '.$settings->fancy_text_color.';';
	}

	if( $settings->fancy_text_background == 'bg_color' ){
			if( !empty( $settings->ft_bg_color) ){
				echo 'background-color: '.$settings->ft_bg_color.';';
			}
	}
	if( !empty( $settings->ft_lr_padding) ){
		echo 'padding: 0'.$settings->ft_lr_padding.'px;';
	}
	
	?>
}*/
?>


/* Typography responsive layout starts here */ 


<?php if($global_settings->responsive_enabled) { // Global Setting If started ?>

	@media ( min-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
		.fl-node-<?php echo $id; ?> span.uabb-slide_text {
		    white-space: nowrap;
		}

	}

	<?php
	if( $settings->fancy_font_size['medium'] != "" || $settings->fancy_line_height['medium'] != "" || $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" )
	{
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix,
			.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix{
				<?php if( $settings->font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['medium']; ?>px;
				line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-fancy-text-main {
				<?php if( $settings->fancy_font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->fancy_font_size['medium']; ?>px;
				line-height: <?php echo $settings->fancy_font_size['medium'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->fancy_line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->fancy_line_height['medium']; ?>px;
				<?php endif; ?>
			}
	    }
	<?php
	}
	if( $settings->fancy_font_size['small'] != "" || $settings->fancy_line_height['small'] != "" || $settings->font_size['small'] != "" || $settings->line_height['small'] != "" )
	{
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix,
			.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix{
				<?php if( $settings->font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['small']; ?>px;
				line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>
			}
			.fl-node-<?php echo $id; ?> .uabb-fancy-text-main {
				<?php if( $settings->fancy_font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->fancy_font_size['small']; ?>px;
				line-height: <?php echo $settings->fancy_font_size['small'] + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->fancy_line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->fancy_line_height['small']; ?>px;
				<?php endif; ?>
				width: auto !important;
			}
	    }
	<?php
	}
}
?>

/* Typography responsive layout Ends here */


