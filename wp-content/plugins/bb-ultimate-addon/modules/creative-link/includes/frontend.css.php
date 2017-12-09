<?php
	$settings->link_color = UABB_Helper::uabb_colorpicker( $settings, 'link_color' );
	$settings->link_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'link_hover_color' );

	$settings->background_color = UABB_Helper::uabb_colorpicker( $settings, 'background_color' );
	$settings->background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'background_hover_color' );

	$settings->border_color = UABB_Helper::uabb_colorpicker( $settings, 'border_color' );
	$settings->border_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'border_hover_color' );

	$settings->spacing = ( $settings->spacing != '' ) ? $settings->spacing : '10';
	$settings->bottom_spacing = ( $settings->bottom_spacing != '' ) ? $settings->bottom_spacing : '15';
	$settings->border_size = ( $settings->border_size != '' ) ? $settings->border_size : '1';
?>
<?php
/*if( $settings->column != 'auto' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-cl-ul {
	width: 100%;
}
.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-ul li {
	width: <?php echo ( 100 / $settings->custom_grid ); ?>%;
	float: left;
}
.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-ul li a {
 	display: block;
    margin: <?php echo $settings->spacing; ?>px;
}
.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-ul li a span {
 	display: block;
}
<?php
}*/
?>

<?php
if( $settings->link_color != '' || $settings->link_typography_line_height['desktop'] != '' || $settings->link_typography_font_size['desktop'] != '' || $settings->link_typography_font_family['family'] != 'Default' ) {
?>

.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-creative-link a {
	<?php
	switch ( $settings->link_style ) {
		case 'style2':
			$color = uabb_theme_base_color( $settings->background_color );
			$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
			echo 'background: ' . $bg_color . ';';
			break;
	}

	echo ( $settings->link_color != '' ) ? 'color: ' . $settings->link_color . ';' : '';
	?>
}

.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-heading a {
	<?php
	echo ( $settings->link_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->link_typography_line_height['desktop'] . 'px;' : '';
	echo ( $settings->link_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->link_typography_font_size['desktop'] . 'px;' : '';
	
	if( $settings->link_typography_font_family['family'] != 'Default' ) {
		UABB_Helper::uabb_font_css( $settings->link_typography_font_family );
	}
	?>
}

<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-creative-link a span {
	color: inherit;
	line-height: inherit;
	font-size: inherit;
	font-family: inherit;
	font-weight: inherit;
}
<?php 
if( $settings->link_style != 'style15' && $settings->link_style != 'style19' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-creative-link a:hover,
.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-creative-link a span:hover {
	color: <?php echo ( $settings->link_hover_color ); ?>;
}
<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-ul li {
    display: inline-block;
    <?php if( $settings->alignment == 'left' ) : ?>
		margin-right: <?php echo ( $settings->spacing ); ?>px;
    <?php elseif( $settings->alignment == 'right' ) : ?>
		margin-left: <?php echo ( $settings->spacing ); ?>px;
    <?php else : ?>
		margin-left: <?php echo ( $settings->spacing / 2 ); ?>px;
		margin-right: <?php echo ( $settings->spacing / 2 ); ?>px;
	<?php endif; ?>
    
    margin-bottom: <?php echo ( $settings->bottom_spacing ); ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-ul {
	text-align: <?php echo $settings->alignment; ?>;
}

/* Style 2 */

.fl-node-<?php echo $id; ?> .uabb-cl-style2 p a,
.fl-node-<?php echo $id; ?> .uabb-cl-style2 div a,
.fl-node-<?php echo $id; ?> .uabb-cl-style2 span a {
	color: <?php echo uabb_theme_text_color( $settings->link_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style2 a span {
	padding: 5px 15px;
	<?php
	$color = uabb_theme_base_color( $settings->background_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	<?php echo 'background: ' . $bg_color . ';'; ?>
}
.fl-node-<?php echo $id; ?> .uabb-cl-style2 a span:before {
	<?php
	$color = uabb_theme_base_color( $settings->background_hover_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	<?php echo 'background: ' . $bg_color . ';'; ?>
	padding: inherit;
}

/* Style 3 */
.fl-node-<?php echo $id; ?> .uabb-cl-style3 a::after {
	<?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
	height:<?php echo $settings->border_size; ?>px;
}

/* Style 4 */
.fl-node-<?php echo $id; ?> .uabb-cl-style4 a::after {
	<?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
	height:<?php echo $settings->border_size; ?>px;
}

/* Style 7 */

.fl-node-<?php echo $id; ?> .uabb-cl-style7 a::before,
.fl-node-<?php echo $id; ?> .uabb-cl-style7 a::after {
    height: <?php echo $settings->border_size; ?>px;
    <?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}


/* Style 8 */

.fl-node-<?php echo $id; ?> .uabb-cl-style8 a::before,
.fl-node-<?php echo $id; ?> .uabb-cl-style8 a::after {
    border: <?php echo $settings->border_size; ?>px <?php echo $settings->border_style; ?> <?php echo uabb_theme_text_color( $settings->border_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style8 a::after {
	border-color: <?php echo uabb_theme_text_color( $settings->border_hover_color ); ?>;
}

/* Style 9 */
.fl-node-<?php echo $id; ?> .uabb-cl-style9 a span {
	<?php echo ( $settings->link_color != '' ) ? 'color:' . $settings->link_color : ''; ?>;
	<?php
	$color = uabb_theme_base_color( $settings->background_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style9 p a,
.fl-node-<?php echo $id; ?> .uabb-cl-style9 div a,
.fl-node-<?php echo $id; ?> .uabb-cl-style9 span a {
	color: <?php echo uabb_theme_text_color( $settings->link_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style9 a::before {
	<?php echo ( $settings->link_hover_color != '' ) ? 'color:' . $settings->link_hover_color : ''; ?>;
	<?php
	$color = uabb_theme_base_color( $settings->background_hover_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}

/* Style 10 */

.fl-node-<?php echo $id; ?> .uabb-cl-style10 a {
    border-top-width:<?php echo $settings->border_size; ?>px;
	border-top-style:<?php echo $settings->border_style; ?>;
	border-top-color:<?php echo uabb_theme_text_color( $settings->border_color ); ?>;
    <?php echo ( $settings->link_color != '' ) ? 'color:' . $settings->link_color : ''; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style10 a::before {
    border-bottom-width:<?php echo $settings->border_size; ?>px;
	border-bottom-style:<?php echo $settings->border_style; ?>;
	border-bottom-color:<?php echo uabb_theme_text_color( $settings->border_color ); ?>;
    <?php echo ( $settings->link_color != '' ) ? 'color:' . $settings->link_color : ''; ?>;
}

/* Style 6 */
.fl-node-<?php echo $id; ?> .uabb-cl-style6 a:before {
	position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: <?php echo $settings->border_size; ?>px;
    <?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
    content: '';
    -webkit-transition: top 0.3s;
    -moz-transition: top 0.3s;
    transition: top 0.3s;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style6 a:after {
	position: absolute;
    top: 0;
    left: 0;
    content: '';
    width: <?php echo $settings->border_size; ?>px;
    height: <?php echo $settings->border_size; ?>px;
    <?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
    -webkit-transition: height 0.3s;
    -moz-transition: height 0.3s;
    transition: height 0.3s;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style6 a:hover::before {
    top: 100%;
    opacity: 1;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style6 a:hover::after {
    height: 100%;
}


/* Style 11 */

.fl-node-<?php echo $id; ?> .uabb-cl-style11 a::before,
.fl-node-<?php echo $id; ?> .uabb-cl-style11 a::after {
	border-color:<?php echo uabb_theme_text_color( $settings->border_color ); ?>;
}

/* Style 12 */

.fl-node-<?php echo $id; ?> .uabb-cl-style12 a:hover::before,
.fl-node-<?php echo $id; ?> .uabb-cl-style12 a:focus::before {
    <?php
    $color = ( uabb_theme_text_color( $settings->link_hover_color ) != '' ) ? uabb_theme_text_color( $settings->link_hover_color ) : '#f7f7f7';
    ?>
    color: <?php echo ( $color ); ?>;
    text-shadow: 10px 0 <?php echo uabb_theme_text_color( $color ); ?>, -10px 0 <?php echo uabb_theme_text_color( $color ); ?>;
}

/* Style 13 */

.fl-node-<?php echo $id; ?> .uabb-cl-style13 a::before, 
.fl-node-<?php echo $id; ?> .uabb-cl-style13 a::after {
    height: <?php echo $settings->border_size; ?>px;
    <?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}

/* Style 14 */

.fl-node-<?php echo $id; ?> .uabb-cl-style14 a::before {
    <?php echo ( $settings->link_color != '' ) ? 'color:' . $settings->link_color : ''; ?>;
    content: attr(data-hover);
    position: absolute;
    -webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
    -moz-transition: -moz-transform 0.3s, opacity 0.3s;
    transition: transform 0.3s, opacity 0.3s;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style14 .uabb-cl-heading,
.fl-node-<?php echo $id; ?> .uabb-cl-style14 .uabb-cl-heading a,
.fl-node-<?php echo $id; ?> .uabb-cl-style14 .uabb-cl-heading a:visited,
.fl-node-<?php echo $id; ?> .uabb-cl-style14 .uabb-cl-heading a *,
.fl-node-<?php echo $id; ?> .uabb-cl-style14 .uabb-cl-heading a:visited *​ {
	<?php echo ( $settings->link_hover_color != '' ) ? 'color:' . $settings->link_hover_color : ''; ?>;
}

/* Style 15 */

.fl-node-<?php echo $id; ?> .uabb-cl-style15 a::before {
	<?php echo ( $settings->link_hover_color != '' ) ? 'color:' . $settings->link_hover_color : ''; ?>;
}

/* Style 16 */

.fl-node-<?php echo $id; ?> .uabb-cl-style16 a::after {
	<?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
	height:<?php echo $settings->border_size; ?>px;
}

/* Style 17 */

.fl-node-<?php echo $id; ?> .uabb-cl-style17 a {
	<?php echo ( $settings->link_color != '' ) ? 'color:' . $settings->link_color : ''; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style17 a::after,
.fl-node-<?php echo $id; ?> .uabb-cl-style17 a::before {
	height: <?php echo $settings->border_size; ?>px;
    <?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}

/* Style 18 */
<?php if( $settings->mobile_structure != 'stacked' ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cl-style18 {
		width: <?php echo ( $settings->box_width != '' ) ? $settings->box_width : '200'; ?>px;
		max-width: 100%;
	}
<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-cl-style18 a {
	margin: 0;
	width: <?php echo ( $settings->box_width != '' ) ? $settings->box_width : '200'; ?>px;
	max-width: 100%;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style18 p a,
.fl-node-<?php echo $id; ?> .uabb-cl-style18 div a,
.fl-node-<?php echo $id; ?> .uabb-cl-style18 span a {
	color: <?php echo uabb_theme_text_color( $settings->link_color ); ?>;
}


.fl-node-<?php echo $id; ?> .uabb-cl-style18 a span {
	-webkit-transform-origin: 50% 50% -<?php echo ( $settings->box_width != '' ) ? ( $settings->box_width / 2 ) : '100'; ?>px;
    -moz-transform-origin: 50% 50% -<?php echo ( $settings->box_width != '' ) ? ( $settings->box_width / 2 ) : '100'; ?>px;
    transform-origin: 50% 50% -<?php echo ( $settings->box_width != '' ) ? ( $settings->box_width / 2 ) : '100'; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style18 a span {
	<?php
	$color = uabb_theme_base_color( $settings->background_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style18 a:hover span::before,
.fl-node-<?php echo $id; ?> .uabb-cl-style18 a:focus span::before {
	<?php
	$color = uabb_theme_base_color( $settings->background_hover_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style18 a span::before,
.fl-node-<?php echo $id; ?> .uabb-cl-style18 a:hover span,
.fl-node-<?php echo $id; ?> .uabb-cl-style18 a:focus span {
	<?php
	$color = uabb_theme_base_color( $settings->background_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	$dark_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $bg_color ) ), 50, 'darken' ); ?>
    background: <?php echo $dark_color; ?>;
}

/* Style 19 */

<?php
$color = uabb_theme_base_color( $settings->background_color );
$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
$dark_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $bg_color ) ), 50, 'darken' ); ?>

.fl-node-<?php echo $id; ?> .uabb-cl-style19 a span {
	<?php
	$color = uabb_theme_base_color( $settings->background_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
	box-shadow: inset 0 3px <?php echo $dark_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style19 p a,
.fl-node-<?php echo $id; ?> .uabb-cl-style19 div a,
.fl-node-<?php echo $id; ?> .uabb-cl-style19 span a {
	color: <?php echo uabb_theme_text_color( $settings->link_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style19 a span::before {
	<?php
	$color = uabb_theme_base_color( $settings->background_hover_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
	<?php echo ( $settings->link_hover_color != '' ) ? 'color:' . $settings->link_hover_color : ''; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style19 a:hover span,
.fl-node-<?php echo $id; ?> .uabb-cl-style19 a:focus span {
	background: <?php echo $dark_color; ?>;
}

/* Style 20 */

.fl-node-<?php echo $id; ?> .uabb-cl-style20 a:hover,
.fl-node-<?php echo $id; ?> .uabb-cl-style20 a:focus {
    <?php echo ( $settings->link_hover_color != '' ) ? 'color:' . $settings->link_hover_color : ''; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style20 a {
	<?php echo ( $settings->link_color != '' ) ? 'color:' . $settings->link_color : ''; ?>;
	-webkit-transition: color 0.3s;
    -moz-transition: color 0.3s;
    transition: color 0.3s;
}

.fl-node-<?php echo $id; ?> .uabb-cl-style20 a::before,
.fl-node-<?php echo $id; ?> .uabb-cl-style20 a::after {
	height: <?php echo $settings->border_size; ?>px;
	<?php
	$color = uabb_theme_base_color( $settings->border_color );
	$bg_color = ( $color != '' ) ? $color : '#f7f7f7';
	?>
	background: <?php echo $bg_color; ?>;
}

/* Style Simple */
.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-creative-link.uabb-cl-simple a {
	<?php echo ( $settings->link_color != '' ) ? 'color:' . $settings->link_color : ''; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-creative-link.uabb-cl-simple a:hover {
	<?php echo ( $settings->link_hover_color != '' ) ? 'color:' . $settings->link_hover_color : ''; ?>;
}

<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
    	.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-heading a {
			<?php
			echo ( $settings->link_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->link_typography_line_height['medium'] . 'px;' : '';
			echo ( $settings->link_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->link_typography_font_size['medium'] . 'px;' : '';
			?>
		}
    }
 
     @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
     	.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-heading a {
			<?php
			echo ( $settings->link_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->link_typography_line_height['small'] . 'px;' : '';
			echo ( $settings->link_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->link_typography_font_size['small'] . 'px;' : '';
			?>
		}

		<?php if( $settings->mobile_structure == 'stacked' ) { ?>
    	.fl-node-<?php echo $id; ?> .uabb-cl-wrap .uabb-cl-ul li {
    		margin-left: 0;
    		margin-right: 0;
    		display: block;
    	}	
		<?php } ?>
    }
<?php
}
?>