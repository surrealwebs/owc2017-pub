<?php

if( isset( $settings->creative_submenu_shadow_color_opc ) && $settings->creative_submenu_shadow_color_opc == '' ) {
	$settings->creative_submenu_shadow_color_opc = '100';
}
if( isset( $settings->creative_submenu_separator_size ) && $settings->creative_submenu_separator_size == '' ) {
	$settings->creative_submenu_separator_size = '1';
}
if( isset( $settings->creative_menu_close_icon_size ) && $settings->creative_menu_close_icon_size == '' ) {
	$settings->creative_menu_close_icon_size = '30';
}

?>

/* Menu alignment */

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
	text-align: <?php echo $settings->creative_menu_alignment; ?>;
}
<?php if( $settings->creative_menu_alignment == 'left' ) { ?>

	.uabb-creative-menu-expanded ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li .uabb-has-submenu-container a {
	    text-indent: 20px;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li .uabb-has-submenu-container a  {
	    text-indent: 30px;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li .uabb-has-submenu-container a  {
	    text-indent: 40px;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li li .uabb-has-submenu-container a  {
	    text-indent: 50px;
	}

<?php } else if( $settings->creative_menu_alignment == 'right' ) { ?>

	.uabb-creative-menu-expanded ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li .uabb-has-submenu-container a {
	    text-indent: 20px;
	    direction: rtl;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li .uabb-has-submenu-container a {
	    text-indent: 30px;
	    direction: rtl;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li .uabb-has-submenu-container a {
	    text-indent: 40px;
	    direction: rtl;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li li .uabb-has-submenu-container a {
	    text-indent: 50px;
	    direction: rtl;
	}

<?php }?>

<?php if( $settings->creative_menu_alignment == 'left' ) {
	
	if( $settings->creative_menu_layout == 'horizontal' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
	<?php } ?>

	<?php if( $settings->creative_menu_layout == 'vertical' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;

		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
	<?php } ?>

	<?php if( $settings->creative_menu_layout == 'accordion' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
	<?php } ?>

<?php } ?>

<?php if( $settings->creative_menu_alignment == 'center' ) {
	
	if( $settings->creative_menu_layout == 'horizontal' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
	<?php } ?>

	<?php if( $settings->creative_menu_layout == 'vertical' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
	<?php } ?>

	<?php if( $settings->creative_menu_layout == 'accordion' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
	<?php } ?>

<?php } ?>

<?php if( $settings->creative_menu_alignment == 'right' ) {
	
	if( $settings->creative_menu_layout == 'horizontal' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
	<?php } ?>

	<?php if( $settings->creative_menu_layout == 'vertical' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-right: 10px;
		    float: left;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical .uabb-menu-toggle {
		    padding-right: 10px;
		    float: left;
		}
	<?php } ?>

	<?php if( $settings->creative_menu_layout == 'accordion' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
		    padding-right: 10px;
		    float: left;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion .uabb-menu-toggle {
		    padding-right: 10px;
		    float: left;
		}
	<?php } ?>

<?php } ?>

/**
 * Overall menu styling
 */

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {
	<?php if ( $settings->creative_menu_link_margin != ''  ) { ?>
		<?php echo $settings->creative_menu_link_margin; ?>;
	<?php } ?>
}

<?php if( $settings->creative_menu_responsive_toggle == 'arrows' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .sub-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .sub-menu .uabb-menu-toggle:before {
		content: '\f107';
		font-family: 'fontAwesome';
		z-index: 1;
		font-size: inherit;
		line-height: 0;
		<?php if( $settings->creative_menu_responsive_link_color ) { ?>color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}
<?php } else if ( $settings->creative_menu_responsive_toggle == 'plus' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .sub-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .sub-menu .uabb-menu-toggle:before {
		content: '\f067';
		font-family: 'fontAwesome';
		font-size: 0.7em;
		z-index: 1;
		<?php if( $settings->creative_menu_responsive_link_color ) { ?>color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}
<?php } ?>

<?php
/* Toggle - Arrows */
if( ( ( $settings->creative_menu_layout == 'horizontal' || $settings->creative_menu_layout == 'vertical' ) &&  $settings->creative_submenu_hover_toggle == 'arrows' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-toggle:before {
		content: '\f107';
		font-family: 'fontAwesome';
		z-index: 1;
		font-size: inherit;
		line-height: 0;
	}
<?php

/* Toggle - Plus */
} else if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-toggle:before {
		content: '\f067';
		font-family: 'fontAwesome';
		font-size: 0.7em;
		z-index: 1;
	}
<?php }

/* Responsive */
if( $global_settings->responsive_enabled ) { ?>

	<?php if( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) ) { ?>
		.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .sub-menu {
			display: none;
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu li:first-child {
		border-top: none;
	}

	<?php if( isset( $settings->creative_menu_mobile_toggle ) && in_array($settings->creative_menu_mobile_toggle, array('hamburger', 'hamburger-label')) ) { ?>
		<?php if ( 'always' != $module->media_breakpoint() ) : ?>
			@media only screen and ( max-width: <?php echo $module->media_breakpoint() ?>px ) {
		<?php endif; ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
				margin-top: 20px;
			}
			<?php if ( $settings->creative_menu_mobile_toggle != 'expanded' ) : ?>
	           .fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
	                <!-- display: none; -->
	           }
	        <?php endif;?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn {
				display: block;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
				text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {
				margin-left: 0 !important;
				margin-right: 0 !important;
			}
			<?php if( $settings->creative_menu_responsive_alignment == 'left' ) { ?>
	
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				    padding-left: 10px;
				    float: right;
				}
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
				    padding-left: 10px;
				    float: right;
				}

			<?php } ?>

			<?php if( $settings->creative_menu_responsive_alignment == 'center' ) { ?>
				
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
					    padding-left: 10px;
					    float: right;
					}
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
					    padding-left: 10px;
					    float: right;
					}

			<?php } ?>

			<?php if( $settings->creative_menu_responsive_alignment == 'right' ) { ?>
				
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
						padding-right: 10px;
					    float: left;
					}
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
					    padding-right: 10px;
					    float: left;
					}

			<?php } ?>
			
		<?php if ( 'always' != $module->media_breakpoint() ) : ?>
		}
		<?php endif; ?>
	<?php } ?>

	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		@media only screen and ( min-width: <?php echo ( $module->media_breakpoint() ) + 1 ?>px ) {

		<?php // Horizontal Menu ?>
		<?php if( $settings->creative_menu_layout == 'horizontal' ) { ?>
			.fl-node-<?php echo $id; ?> .menu > li {
				display: inline-block;
			}

			.fl-node-<?php echo $id; ?> .menu li {
				border-left: none;
				border-top: none;
			}
			.fl-node-<?php echo $id; ?> .menu li li {
				border-top: none;
				border-left: none;
			}

			.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .sub-menu {
				position: absolute;
				top: 100%;
				left: 0;
				z-index: 16;
				visibility: hidden;
				opacity: 0;
				text-align:left;
				transition: all 300ms ease-in;
			}

			.fl-node-<?php echo $id; ?> .uabb-has-submenu .uabb-has-submenu .sub-menu {
				top:  0;
				left: 100%;
			}

		<?php // if menu is vertical ?>
		<?php } elseif( $settings->creative_menu_layout == 'vertical' ) { ?>

			.fl-node-<?php echo $id; ?> .menu .uabb-wp-has-submenu .sub-menu {
				position: absolute;
				top: 0;
				left: 100%;
				z-index: 10;
				visibility: hidden;
				opacity: 0;
			}

		<?php } ?>

		<?php // Horizontal Or Vertical Menu ?>
		<?php if( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:focus > .sub-menu {
				display: block;
			}

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:focus > .sub-menu {
				visibility: visible;
				opacity: 1;
			}

			.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu.uabb-menu-submenu-right .sub-menu {
				top: 100%;
				left: inherit;
				right: 0;
			}

			.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .uabb-has-submenu.uabb-menu-submenu-right .sub-menu {
				top: 0;
				left: inherit;
				right: 100%;
			}

			<?php if( $settings->creative_submenu_hover_toggle == 'none' ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu-container a span.menu-item-text {
					color: #<?php echo $settings->creative_menu_link_color ?>;
				}
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-toggle {
					display: none;
				}
			<?php } ?>

			<?php } ?>

			<?php if( $settings->creative_menu_mobile_toggle != 'expanded' ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle {
					display: none;
				}
			<?php } ?>

				}

		<?php
	}
		/* Not Responsive */
	 } else { ?>

	<?php // Horizontal Menu ?>
	<?php if( $settings->creative_menu_layout == 'horizontal' ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {
			float: left;
		}

		.fl-node-<?php echo $id; ?> .menu li {
			border-left: 1px solid transparent;
		}

		.fl-node-<?php echo $id; ?> .menu li:first-child {
			border: none;
		}

		.fl-node-<?php echo $id; ?> .menu li li {
			border-top: 1px solid transparent;
			border-left: none;
		}

	<?php } ?>

	<?php if( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) ) { ?>

		.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .sub-menu {
			position: absolute;
			top: 100%;
			left: 0;
			z-index: 16;
			visibility: hidden;
			opacity: 0;
		}

		.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .uabb-has-submenu .sub-menu {
			top: 0;
			left: 100%;
		}

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu.focus > .sub-menu {
			display: block;
		}

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu.focus > .sub-menu {
			visibility: visible;
			opacity: 1;
			transition: all 300ms ease-out;
		}

		<?php if( $settings->creative_submenu_hover_toggle == 'none' ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu-container a span.menu-item-text {
				color: <?php echo $settings->creative_menu_link_color ?>;
			}
			.uabb-creative-menu .uabb-menu-toggle {
				display: none;
			}
		<?php } ?>

	<?php } ?>

	<?php if( $settings->creative_menu_mobile_toggle != 'expanded' ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle {
			display: none;
		}
	<?php } ?>

<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
	<?php if( $settings->creative_menu_link_font_family['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->creative_menu_link_font_family ); ?>
   <?php } ?>
	<?php if( $settings->creative_menu_link_font_size == 'custom' && $settings->creative_menu_link_font_size_custom ) { ?>font-size: <?php echo $settings->creative_menu_link_font_size_custom; ?>px;<?php } ?>
  	<?php if( $settings->creative_menu_link_line_height == 'custom' && $settings->creative_menu_link_line_height_custom ) { ?>line-height: <?php echo $settings->creative_menu_link_line_height_custom; ?>;<?php } ?>
	text-transform: <?php echo $settings->creative_menu_link_text_transform; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container > a {
	<?php if ( $settings->creative_menu_link_spacing != ''  ) { ?>
		<?php echo $settings->creative_menu_link_spacing; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
	<?php if( $settings->creative_menu_border_style != 'none' ) { ?>
		<?php if ( $settings->creative_menu_border_style != ''  ) { ?>
			border-style:<?php echo $settings->creative_menu_border_style; ?>;
		<?php } 
		    $str = '0px;';
		 	if( isset( $settings->uabb_creative_menu_border_width ) ) {
				if( is_array( $settings->uabb_creative_menu_border_width ) ) {
					if( $settings->uabb_creative_menu_border_width['simplify'] == 'collapse' ) {
						$str = ( $settings->uabb_creative_menu_border_width['all'] != '' ) ? $settings->uabb_creative_menu_border_width['all'] . 'px;' : '0;';
					} else {
						$str = ( $settings->uabb_creative_menu_border_width['top'] != '' ) ? $settings->uabb_creative_menu_border_width['top'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_menu_border_width['right'] != '' ) ? $settings->uabb_creative_menu_border_width['right'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_menu_border_width['bottom'] != '' ) ? $settings->uabb_creative_menu_border_width['bottom'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_menu_border_width['left'] != '' ) ? $settings->uabb_creative_menu_border_width['left'] . 'px ' : '0;';
					}
				}
			} ?>
		border-width: <?php echo $str; ?>

		<?php if ( $settings->creative_menu_border_color != ''  ) { ?>
			border-color:#<?php echo $settings->creative_menu_border_color; ?>;
		<?php } ?>

	<?php } else  { ?>
		<?php if ( $settings->creative_menu_border_style != ''  ) { ?>
			border-style:<?php echo $settings->creative_menu_border_style; ?>;
		<?php } ?>
	<?php } ?>
	
	<?php if ( $settings->creative_menu_background_color != '' ) { ?>
		transition: background-color 300ms ease;
		background-color:<?php echo ( false === strpos( $settings->creative_menu_background_color, 'rgb' ) ) ? '#' . $settings->creative_menu_background_color : $settings->creative_menu_background_color; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-creative-menu .menu > li > a span.menu-item-text,
.fl-node-<?php echo $id; ?> .fl-module-content .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a span.menu-item-text {
	<?php if ( $settings->creative_menu_link_color != ''  ) { ?>
		color:#<?php echo $settings->creative_menu_link_color; ?>;
	<?php } ?>
}

<?php if( !empty( $settings->creative_menu_link_color ) ) { ?>

		<?php if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_color; ?>;
		}
		<?php } elseif( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_color; ?>;
		}
		<?php } ?>
<?php } ?>

<?php if( !empty( $settings->creative_menu_link_hover_color ) ) { ?>

		<?php if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none li:hover .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color; ?>;
		}
		<?php } elseif( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color; ?>;
		}
		<?php } ?>
<?php }


/* Links - hover or active */
if( !empty( $settings->creative_menu_background_hover_color ) || $settings->creative_menu_link_hover_color || $settings->creative_menu_border_hover_color ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:focus,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:hover > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:focus > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > .uabb-has-submenu-container > a {
		<?php  if( $settings->creative_menu_background_hover_color != '' ) { ?>
			background-color: <?php echo ( false === strpos( $settings->creative_menu_background_hover_color, 'rgb' ) ) ? '#' . $settings->creative_menu_background_hover_color : $settings->creative_menu_background_hover_color; ?>;
		<?php }
		if ( $settings->creative_menu_border_hover_color != ''  ) { ?>
			border-color:#<?php echo $settings->creative_menu_border_hover_color; ?>;
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a {
		<?php  if( $settings->creative_submenu_background_hover_color != '' ) { ?>
			background-color: <?php echo ( false === strpos( $settings->creative_submenu_background_hover_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_background_hover_color : $settings->creative_submenu_background_hover_color; ?>;
		<?php } ?>
	}
	
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.focus > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i {
		<?php 
		if ( $settings->creative_menu_link_hover_color != '' ) {
			echo 'color: #'. $settings->creative_menu_link_hover_color .';';
		} ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i {
		<?php 
		if ( $settings->creative_submenu_link_hover_color != '' ) {
			echo 'color: #'. $settings->creative_submenu_link_hover_color .';';
		} ?>
	}
<?php } ?>

<?php if( !empty( $settings->creative_menu_link_hover_color ) ) { ?>
	<?php if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-has-submenu-container:hover > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-has-submenu-container.focus > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows li.current-menu-item >.uabb-has-submenu-container > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .uabb-has-submenu-container:hover > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .uabb-has-submenu-container.focus > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none li.current-menu-item >.uabb-has-submenu-container > .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color ?>;
		}
		<?php } elseif( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-has-submenu-container:hover > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-has-submenu-container.focus > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus li.current-menu-item > .uabb-has-submenu-container > .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color ?>;
		}
	<?php } ?>

<?php } ?>

/* Sub-menu */

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {
	<?php if( $settings->creative_submenu_link_font_family['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->creative_submenu_link_font_family ); ?>
   <?php } ?>
   <?php if( $settings->creative_submenu_link_font_size == 'custom' && $settings->creative_submenu_link_font_size_custom ) { ?>font-size: <?php echo $settings->creative_submenu_link_font_size_custom; ?>px;<?php } ?>
  	<?php if( $settings->creative_submenu_link_line_height == 'custom' && $settings->creative_submenu_link_line_height_custom ) { ?>line-height: <?php echo $settings->creative_submenu_link_line_height_custom; ?>;<?php } ?>
	<?php if ( $settings->creative_submenu_link_padding != ''  ) { ?>
		<?php echo $settings->creative_submenu_link_padding; ?>;
	<?php } ?>
	<?php if ( $settings->creative_submenu_link_text_transform != ''  ) { ?>
		<?php echo 'text-transform:' . $settings->creative_submenu_link_text_transform; ?>;
	<?php } ?>
	background-color: <?php echo ( false === strpos( $settings->creative_submenu_background_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_background_color : $settings->creative_submenu_background_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu:not(.off-canvas):not(.full-screen):not(.menu-item) .uabb-creative-menu .sub-menu {
	min-width: <?php echo ( isset( $settings->submenu_width ) ? $settings->submenu_width: '' ); ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a span.menu-item-text,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a span.menu-item-text {
	color: <?php echo '#' . $settings->creative_submenu_link_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li {
	<?php if( isset( $settings->creative_submenu_separator_settings_option ) && $settings->creative_submenu_separator_settings_option == 'yes' ) { ?>
		border-bottom-style: <?php echo $settings->creative_submenu_separator_style; ?>;
		<?php if(  $settings->creative_submenu_separator_size != '' ) { ?>
		border-bottom-width: <?php echo $settings->creative_submenu_separator_size; ?>px;
		<?php } ?>
		<?php if(  $settings->creative_submenu_separator_color != '' ) { ?>
		border-bottom-color: <?php echo ( false === strpos( $settings->creative_submenu_separator_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_separator_color : $settings->creative_submenu_separator_color; ?>;
		<?php } ?>
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li:last-child {
	border-bottom: none;
}
.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.uabb-creative-menu.uabb-has-submenu li:first-child,
.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.uabb-creative-menu.uabb-has-submenu li li:first-child {
	border-top: none;
}
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.uabb-active > .sub-menu > li:first-child,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-expanded .sub-menu > li > .sub-menu > li:first-child {
	<?php if( isset( $settings->creative_submenu_separator_settings_option ) && $settings->creative_submenu_separator_settings_option == 'yes' ) { ?>
		border-top-style: <?php echo $settings->creative_submenu_separator_style; ?>;
		<?php if(  $settings->creative_submenu_separator_size != '' ) { ?>
		border-top-width: <?php echo $settings->creative_submenu_separator_size; ?>px;
		<?php } ?>
		<?php if(  $settings->creative_submenu_separator_color != '' ) { ?>
		border-top-color: <?php echo ( false === strpos( $settings->creative_submenu_separator_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_separator_color : $settings->creative_submenu_separator_color; ?>;
		<?php } ?>
	<?php } ?>
}




.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu {
	<?php if ( 'yes' == $settings->creative_submenu_drop_shadow ) { ?>
		-webkit-box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#'.$settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
		-moz-box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#'.$settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
		-o-box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#'.$settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
		box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#'.$settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-vertical .sub-menu,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-horizontal .sub-menu {
	<?php if ( isset( $settings->creative_submenu_border_settings_option ) && $settings->creative_submenu_border_settings_option == 'yes' ) { ?>
	    border-style: <?php echo $settings->creative_submenu_border_style; ?>;
	    <?php if ( $settings->creative_submenu_border_width != '' ) {
		    $str = '1px;';
		 	if( isset( $settings->uabb_creative_submenu_border_width ) ) {
				if( is_array( $settings->uabb_creative_submenu_border_width ) ) {
					if( $settings->uabb_creative_submenu_border_width['simplify'] == 'collapse' ) {
						$str = ( $settings->uabb_creative_submenu_border_width['all'] != '' ) ? $settings->uabb_creative_submenu_border_width['all'] . 'px;' : '0;';
					} else {
						$str = ( $settings->uabb_creative_submenu_border_width['top'] != '' ) ? $settings->uabb_creative_submenu_border_width['top'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_submenu_border_width['right'] != '' ) ? $settings->uabb_creative_submenu_border_width['right'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_submenu_border_width['bottom'] != '' ) ? $settings->uabb_creative_submenu_border_width['bottom'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_submenu_border_width['left'] != '' ) ? $settings->uabb_creative_submenu_border_width['left'] . 'px ' : '0;';
					}
				}
			} ?>
			border-width: <?php echo $str; ?>
		<?php } ?>
	    border-color: <?php echo ( false === strpos( $settings->creative_submenu_border_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_border_color : $settings->creative_submenu_border_color; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-expanded.menu > .uabb-has-submenu > .sub-menu,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-accordion.menu > .uabb-has-submenu > .sub-menu {
	<?php if ( isset( $settings->creative_submenu_border_settings_option ) && $settings->creative_submenu_border_settings_option == 'yes' ) { ?>
	    border-style: <?php echo $settings->creative_submenu_border_style; ?>;
	    <?php if ( $settings->creative_submenu_border_width != '' ) {
		    $str = '1px;';
		 	if( isset( $settings->uabb_creative_submenu_border_width ) ) {
				if( is_array( $settings->uabb_creative_submenu_border_width ) ) {
					if( $settings->uabb_creative_submenu_border_width['simplify'] == 'collapse' ) {
						$str = ( $settings->uabb_creative_submenu_border_width['all'] != '' ) ? $settings->uabb_creative_submenu_border_width['all'] . 'px;' : '0;';
					} else {
						$str = ( $settings->uabb_creative_submenu_border_width['top'] != '' ) ? $settings->uabb_creative_submenu_border_width['top'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_submenu_border_width['right'] != '' ) ? $settings->uabb_creative_submenu_border_width['right'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_submenu_border_width['bottom'] != '' ) ? $settings->uabb_creative_submenu_border_width['bottom'] . 'px ' : '0 ';
						$str .= ( $settings->uabb_creative_submenu_border_width['left'] != '' ) ? $settings->uabb_creative_submenu_border_width['left'] . 'px ' : '0;';
					}
				}
			} ?>
			border-width: <?php echo $str; ?>
		<?php } ?>
	    border-color: <?php echo ( false === strpos( $settings->creative_submenu_border_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_border_color : $settings->creative_submenu_border_color; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li:last-child > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li:last-child > .uabb-has-submenu-container > a {
	border: 0;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a:hover span.menu-item-text,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a:focus span.menu-item-text,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a:hover span.menu-item-text,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a:focus span.menu-item-text {
	color: <?php echo '#' . $settings->creative_submenu_link_hover_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a:hover,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a:focus,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a:hover,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a:focus {
	background-color: <?php echo ( false === strpos( $settings->creative_submenu_background_hover_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_background_hover_color : $settings->creative_submenu_background_hover_color; ?>;
}

<?php if( !empty( $settings->creative_submenu_link_color ) ) { ?>

		<?php if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .sub-menu li .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .sub-menu li .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_color; ?>;
		}
		<?php } elseif( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .sub-menu li .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_color; ?>;
		}
		<?php } ?>
<?php } ?>

<?php if( !empty( $settings->creative_submenu_link_hover_color ) ) { ?>

		<?php if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .sub-menu li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .sub-menu li:hover .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_hover_color; ?>;
		}
		<?php } elseif( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .sub-menu li:hover .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_hover_color; ?>;
		}
		<?php } ?>
<?php } ?>

/* Toggle button */
<?php if( isset( $settings->creative_menu_mobile_toggle ) && $settings->creative_menu_mobile_toggle != 'expanded' ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle {
		<?php
		if( isset( $settings->creative_menu_link_text_transform ) ) {
			echo 'text-transform: '. $settings->creative_menu_link_text_transform  .';';
		}
		if( !empty( $settings->creative_menu_mobile_toggle_color ) ) {
			echo 'color: #'. $settings->creative_menu_mobile_toggle_color .';';
		}

		if( $settings->creative_menu_link_font_family['family'] != 'Default' ) { ?>
		   <?php FLBuilderFonts::font_css( $settings->creative_menu_link_font_family ); ?>
	   <?php } ?>
		<?php if( $settings->creative_menu_link_font_size == 'custom' && $settings->creative_menu_link_font_size_custom ) { ?>
			font-size: <?php echo $settings->creative_menu_link_font_size_custom; ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle-container {
		text-align: center;
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle rect {
		<?php
			if( !empty( $settings->creative_menu_link_color ) ) {
				echo 'fill: #'. $settings->creative_menu_link_color .';';
			}
		?>
	}
<?php } ?>

<?php if( isset( $settings->mobile_button_label ) && $settings->mobile_button_label == 'no' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle.hamburger .uabb-menu-mobile-toggle-label {
		display: none;
	}
<?php } ?>

<?php if ( 'always' != $module->media_breakpoint() ) : ?>
		@media only screen and ( max-width: <?php echo $module->media_breakpoint() ?>px ) {
	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay .menu {
		margin-top: 40px;
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}

	<?php if( $settings->creative_menu_responsive_alignment == 'left' ) { ?>
	
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'center' ) { ?>
		
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			    padding-left: 10px;
			    float: right;
			}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'right' ) { ?>
		
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			    padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			    padding-left: 10px;
				float: right;
			}

	<?php } ?>
	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		}
	<?php } ?>

@media only screen and (max-width: <?php echo $global_settings->medium_breakpoint; ?>px) {
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
		<?php if( $settings->creative_menu_link_font_size == 'custom' && $settings->creative_menu_link_font_size_custom_medium ) { ?>font-size: <?php echo $settings->creative_menu_link_font_size_custom_medium; ?>px;<?php } ?>
		<?php if( $settings->creative_menu_link_line_height == 'custom' && $settings->creative_menu_link_line_height_custom_medium ) { ?>line-height: <?php echo $settings->creative_menu_link_line_height_custom_medium; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}

	<?php if( $settings->creative_menu_responsive_alignment == 'left' ) { ?>
	
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'center' ) { ?>
		
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			    padding-left: 10px;
			    float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			    padding-left: 10px;
			    float: right;
			}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'right' ) { ?>
		
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			    padding-left: 10px;
				float: right;
			}

	<?php } ?>
}

@media only screen and (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
		<?php if( $settings->creative_menu_link_font_size == 'custom' && $settings->creative_menu_link_font_size_custom_responsive ) { ?>font-size: <?php echo $settings->creative_menu_link_font_size_custom_responsive; ?>px;<?php } ?>
		<?php if( $settings->creative_menu_link_line_height == 'custom' && $settings->creative_menu_link_line_height_custom_responsive ) { ?>line-height: <?php echo $settings->creative_menu_link_line_height_custom_responsive; ?>;<?php } ?>
		}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}

	<?php if( $settings->creative_menu_responsive_alignment == 'left' ) { ?>
	
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'center' ) { ?>
		
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			    float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			    float: right;
			}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'right' ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			    padding-left: 10px;
				float: right;
			}

	<?php } ?>
}

@media only screen and (max-width: <?php echo $global_settings->medium_breakpoint; ?>px) {
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {
		<?php if( $settings->creative_submenu_link_font_size == 'custom' && $settings->creative_submenu_link_font_size_custom_medium ) { ?>font-size: <?php echo $settings->creative_submenu_link_font_size_custom_medium; ?>px;<?php } ?>
		<?php if( $settings->creative_submenu_link_line_height == 'custom' && $settings->creative_submenu_link_line_height_custom_medium ) { ?>line-height: <?php echo $settings->creative_submenu_link_line_height_custom_medium; ?>;<?php } ?>
	}
}

@media only screen and (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {
		<?php if( $settings->creative_submenu_link_font_size == 'custom' && $settings->creative_submenu_link_font_size_custom_responsive ) { ?>font-size: <?php echo $settings->creative_submenu_link_font_size_custom_responsive; ?>px;<?php } ?>
		<?php if( $settings->creative_submenu_link_line_height == 'custom' && $settings->creative_submenu_link_line_height_custom_responsive ) { ?>line-height: <?php echo $settings->creative_submenu_link_line_height_custom_responsive; ?>;<?php } ?>
	}
}

/***************************** Overlay *********************************/

<?php if( $settings->creative_mobile_menu_type == 'full-screen' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay {
		background-color: <?php echo ( false === strpos( $settings->creative_menu_responsive_overlay_bg_color, 'rgb' ) ) ? '#' . $settings->creative_menu_responsive_overlay_bg_color : $settings->creative_menu_responsive_overlay_bg_color; ?>;
	}

	/* Links */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > .uabb-has-submenu-container > a {
		<?php if ( $settings->creative_menu_link_spacing != ''  ) { ?>
			<?php echo $settings->creative_menu_link_spacing; ?>;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu {
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}


	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li {
		clear: both;
		display: block;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu {
		width: 100%;
	}


	<?php if( $settings->creative_menu_responsive_alignment == 'left' ) { ?>
		
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .uabb-menu-toggle {
		    padding-left: 10px;
		    float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .sub-menu {
		    float: right;
		}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'center' ) { ?>
		
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			    padding-left: 10px;
			    float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .uabb-menu-toggle {
			    padding-left: 10px;
			    float: right;
			}

	<?php } ?>

	<?php if( $settings->creative_menu_responsive_alignment == 'right' ) { ?>
		
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-right: 10px;
			    float: left;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu > li > a,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu > li > .uabb-has-submenu-container a {
			    text-align: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .uabb-menu-toggle {
			    padding-right: 10px;
			    float: left;
			}

	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a span.menu-item-text {
		<?php if( $settings->creative_menu_responsive_link_color ) { ?>color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:focus,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > .uabb-has-submenu-container > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > .uabb-has-submenu-container > a:focus {
		background-color: transparent;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu li {
		<?php if( $settings->creative_menu_responsive_link_border_color ) { ?>
			border-bottom-width: 1px;
			border-bottom-style: solid;
			border-bottom-color: #<?php echo $settings->creative_menu_responsive_link_border_color; ?>;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu li:last-child {
		border-bottom: none;
	}
	
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:hover > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:focus > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:hover > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:focus > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text > i {
		<?php if( $settings->creative_menu_responsive_link_hover_color ) { ?>color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text i {
		<?php if( $settings->creative_menu_responsive_link_hover_color ) { ?>color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn {
		<?php if( $settings->creative_menu_close_icon_size ) { ?>
			width: <?php echo  $settings->creative_menu_close_icon_size ; ?>px;
			height: <?php echo  $settings->creative_menu_close_icon_size ; ?>px;
		<?php } ?>
	}

	<?php if( '' != $settings->creative_menu_animation_speed ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-fade,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-fade,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-corner,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-corner,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-slide-down,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-slide-down,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-scale,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-scale,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-door,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-door,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-door > ul,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-door .uabb-menu-close-btn {
			transition-duration: <?php echo ( $settings->creative_menu_animation_speed / 1000 ) . 's'; ?>;
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-close-btn:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-close-btn:after {
		<?php if( $settings->creative_menu_close_icon_size ) { ?>
			height: <?php echo  $settings->creative_menu_close_icon_size ; ?>px;
		<?php } ?>
		<?php if( $settings->creative_menu_close_icon_color != '' ) { ?>
			background-color: #<?php echo $settings->creative_menu_close_icon_color; ?>;
		<?php } ?>
	}

	<?php if( !empty( $settings->creative_menu_responsive_link_color ) ) { ?>
			<?php if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-none .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-none .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } elseif( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } ?>
	<?php } ?>

	<?php if( !empty( $settings->creative_menu_responsive_link_hover_color ) ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
	<?php } ?>

	<?php if ( $module->media_breakpoint() ) { ?>
			@media only screen and ( max-width: <?php echo $module->media_breakpoint() ?>px ) {
		<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default {
				display: none;
			}
		<?php if ( $module->media_breakpoint() ) { ?>
			}
	<?php } ?>

	@media only screen and ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay ul.menu {
			width: 80%;
		}
	}
<?php } ?>


/***************************** Off Canvas **********************************/
<?php if( $settings->creative_mobile_menu_type == 'off-canvas' ) { ?>
	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		@media only screen and ( max-width: <?php echo $module->media_breakpoint() ?>px ) {
	<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default {
				display: none;
			}
	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		}
	<?php } ?>

	/* Container */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu {
		background-color: <?php echo ( false === strpos( $settings->creative_menu_responsive_overlay_bg_color, 'rgb' ) ) ? '#' . $settings->creative_menu_responsive_overlay_bg_color : $settings->creative_menu_responsive_overlay_bg_color; ?>;
		<?php if( $settings->creative_menu_responsive_overlay_padding ) {
			echo $settings->creative_menu_responsive_overlay_padding;
		} ?>
	}

	<?php if(  $settings->creative_menu_off_canvas_shadow == 'yes' ) {
		if( $settings->creative_menu_off_canvas_shadow_color != '' ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu {
				-webkit-box-shadow:  0 0 15px 1px <?php echo ( false === strpos( $settings->creative_menu_off_canvas_shadow_color, 'rgb' ) ) ? '#' . $settings->creative_menu_off_canvas_shadow_color : $settings->creative_menu_off_canvas_shadow_color; ?>;
				-moz-box-shadow:  0 0 15px 1px <?php echo ( false === strpos( $settings->creative_menu_off_canvas_shadow_color, 'rgb' ) ) ? '#' . $settings->creative_menu_off_canvas_shadow_color : $settings->creative_menu_off_canvas_shadow_color; ?>;
				box-shadow:  0 0 15px 1px <?php echo ( false === strpos( $settings->creative_menu_off_canvas_shadow_color, 'rgb' ) ) ? '#' . $settings->creative_menu_off_canvas_shadow_color : $settings->creative_menu_off_canvas_shadow_color; ?>;
			}
		<?php }
	 } ?>

	/* Close Button */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn::selection {
		font-size:  <?php echo  $settings->creative_menu_close_icon_size ; ?>px;
		background: none;
		<?php if( $settings->creative_menu_close_icon_color ) { ?>color: #<?php echo $settings->creative_menu_close_icon_color; ?>;<?php } ?>
	}

	/* Menu */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu {
		margin-top: 60px;
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}

	/* Links */

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > .uabb-has-submenu-container > a {
		<?php if ( $settings->creative_menu_link_spacing != ''  ) { ?>
			<?php echo $settings->creative_menu_link_spacing; ?>;
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li {
		display: block;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu {
		width: 100%;
	}

	<?php if( $settings->creative_menu_alignment != 'right' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-has-submenu-container > a > span,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-has-submenu-container > a > span {
		padding-right: 0;
	}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:focus,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > .uabb-has-submenu-container > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > .uabb-has-submenu-container > a:focus {
		background-color: transparent;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a span.menu-tem-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li a span.menu-item-text i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a span.menu-tem-text i {
		<?php if( $settings->creative_menu_responsive_link_color ) { ?>color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu li {
		border-bottom-width: 1px;
		border-bottom-style: solid;
		border-bottom-color: <?php echo ($settings->creative_menu_responsive_link_border_color) ? '#' . $settings->creative_menu_responsive_link_border_color : ''; ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu li:last-child {
		border-bottom: none;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:hover > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:focus > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:hover > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:focus > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:focus span.menu-item-text > i {
		<?php if( $settings->creative_menu_responsive_link_hover_color ) { ?>color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text i {
		<?php 
		if ( $settings->creative_menu_responsive_link_hover_color != '' ) {
			echo 'color: #'. $settings->creative_menu_responsive_link_hover_color .';';
		} ?>
	}

	<?php if( '' != $settings->creative_menu_animation_speed ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-left,
		.fl-node-<?php echo $id; ?> .menu-open.uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-left,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-right,
		.fl-node-<?php echo $id; ?> .menu-open.uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-right {
			transition-duration: <?php echo ( $settings->creative_menu_animation_speed / 1000 ) . 's'; ?>;
		}
	<?php } ?>

	<?php if( !empty( $settings->creative_menu_responsive_link_color ) ) { ?>
			<?php if( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows' ) ) ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'arrows' ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-none .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-none .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } elseif( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->creative_submenu_hover_toggle == 'plus' ) || ( $settings->creative_menu_layout == 'accordion' && $settings->creative_submenu_click_toggle == 'plus' ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } ?>
	<?php } ?>

	<?php if( !empty( $settings->creative_menu_responsive_link_color ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-clear {
	    background: <?php echo ( false === strpos( $settings->creative_menu_responsive_overlay_color, 'rgb' ) ) ? '#' . $settings->creative_menu_responsive_overlay_color : $settings->creative_menu_responsive_overlay_color; ?>;
	}
<?php } ?>
