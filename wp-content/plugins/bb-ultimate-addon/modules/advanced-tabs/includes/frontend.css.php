<?php
    $settings->title_color = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
    $settings->title_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'title_hover_color' );
    $settings->title_active_color = UABB_Helper::uabb_colorpicker( $settings, 'title_active_color' );

    $settings->title_background_color = UABB_Helper::uabb_colorpicker( $settings, 'title_background_color', true );
    $settings->title_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'title_background_hover_color', true );
    $settings->title_active_background_color = UABB_Helper::uabb_colorpicker( $settings, 'title_active_background_color', true );
    
    $settings->underline_border_color = UABB_Helper::uabb_colorpicker( $settings, 'underline_border_color' );
    //$settings->underline_separation_color = UABB_Helper::uabb_colorpicker( $settings, 'underline_separation_color' );
    
    $settings->icon_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_color');
    $settings->icon_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color' );
    $settings->icon_active_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_active_color' );

    $settings->content_color = UABB_Helper::uabb_colorpicker( $settings, 'content_color' );
    $settings->content_background_color = UABB_Helper::uabb_colorpicker( $settings, 'content_background_color', true );

    $settings->content_border_color = UABB_Helper::uabb_colorpicker( $settings, 'content_border_color' );
    
    /* Fallback depricated underline Style */
    if( $settings->style == 'underline' ) {
        $settings->style = 'topline';
        $settings->line_position = 'bottom';
    }

    $settings->tab_spacing_size = ( $settings->tab_spacing_size != '' ) ? $settings->tab_spacing_size : '10';
    $settings->content_border_radius = ( $settings->content_border_radius != '' ) ? $settings->content_border_radius : '0';
?>

 <?php
if( $settings->style != 'iconfall' && $settings->style != 'linebox' ) {
    if( $settings->tab_style == 'inline' ) {
?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul {
        <?php echo ( $settings->tab_style_alignment != 'left' ) ? ( ( $settings->tab_style_alignment != 'center' ) ? 'justify-content: flex-end;' : 'justify-content: center;' ) : 'justify-content: flex-start;'; ?>
        
    }
<?php
    } else {
?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li {
        text-align: center;
        -webkit-flex: 1;
        -moz-flex: 1;
        -ms-flex: 1;
        flex: 1;
        -ms-flex-preferred-size: auto;
        flex-basis: auto;
    }
<?php
    }
?>

<?php if( $settings->style == 'simple' ): ?>
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-tab-acc-title {
    background: #f7f7f7;
}
<?php endif; ?>

<?php
} else {
?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li {
        text-align: center;
        -webkit-flex: 1;
        -moz-flex: 1;
        -ms-flex: 1;
        flex: 1;
        -ms-flex-preferred-size: auto;
        flex-basis: auto;
    }
<?php
}
?>


<?php
$equal_width = false;

if ( $settings->tab_style_width == 'equal' ) {
    
    if ( $settings->style == 'simple' || $settings->style == 'bar' || $settings->style == 'topline' || $settings->style == 'linebox' ) {
        if ( $settings->style != 'linebox' && $settings->tab_style == 'full' ) {
            $equal_width = true;
        }else if ( $settings->style == 'linebox' ) {
            $equal_width = true;
        }
    }elseif(  $settings->style == 'iconfall' ){
        $equal_width = true;
    }
}

if( $equal_width == true ) { ?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li {
        flex-basis: 1px;    
    }

    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li .uabb-tab-link {
        white-space: normal;
        height: 100%;
    }

    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li .uabb-tag-selected {        
        height: 100%;
    }

    <?php if ( $settings->show_icon == 'yes' && ( $settings->icon_position == 'left' || $settings->icon_position == 'right' ) ) { ?>
        .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li .uabb-tab-title {
            display: initial; 
        }
    <?php } ?>


<?php
}
?>

<?php if( $settings->icon_position == 'right' ) { ?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tab-acc-title .uabb-tabs-icon {
        margin-left: 0.4em ;
        display: inline-block;
    }

    <?php
} else if( $settings->icon_position == 'top' ) {
    ?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tab-acc-title .uabb-tabs-icon {
        margin-right: 0.4em;
        display: inline-block;
    }

    <?php
} else if( $settings->icon_position == 'left' ) {
    ?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tab-acc-title .uabb-tabs-icon {
        margin-right: 0.4em;
        display: inline-block;
    }
<?php } ?>
<?php
if( $settings->style != 'iconfall' ) {
    if( $settings->icon_position == 'right' ) {
    ?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a {
        direction: rtl;
    }
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a .uabb-tab-title{
        direction: ltr;
    }
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li .uabb-tabs-icon {
        margin-left: 0.4em ;
        display: inline-block;
    }

    <?php
    } else if( $settings->icon_position == 'top' ) {
    ?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li .uabb-tabs-icon {
        display: block;
        margin-bottom: 0.4em;
    }

    <?php
    } else if( $settings->icon_position == 'left' ) {
    ?>
    .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li .uabb-tabs-icon {
        margin-right: 0.4em;
        display: inline-block;
    }
    <?php
    }
}
?>

.fl-node-<?php echo $id; ?> .uabb-tab-title,
.fl-node-<?php echo $id; ?> .uabb-acc-icon {
    color: <?php echo uabb_theme_text_color( $settings->title_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a,
.fl-node-<?php echo $id; ?> .uabb-tab-acc-title .uabb-title-tag {
    color: <?php echo uabb_theme_text_color( $settings->title_color ); ?>;
    <?php 
    if( $settings->title_font_family['family'] != 'Default' ) { 
        UABB_Helper::uabb_font_css( $settings->title_font_family );
    }
    echo ( $settings->title_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->title_font_size['desktop'] . 'px;' : '';
    //echo ( $settings->title_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->title_line_height['desktop'] . 'px;' : 'line-height: ' . ( $settings->title_font_size['desktop'] + 2 ) . 'px;';
    echo ( $settings->title_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->title_line_height['desktop'] . 'px;' : '';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-tab-acc-title .uabb-acc-icon {
    <?php echo ( $settings->title_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->title_line_height['desktop'] . 'px;' : ''; ?>
}

.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a .uabb-tabs-icon i,
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tab-acc-title .uabb-tabs-icon i {
    color: <?php echo uabb_theme_text_color( $settings->icon_color ); ?>;
    <?php echo ( $settings->icon_size != '' ) ? 'font-size: ' . $settings->icon_size . 'px;' : ''; ?>
}
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-tab-acc-title {
    <?php echo ( $settings->tab_padding != '' ) ? $settings->tab_padding : ''; ?>
}
<?php
if( $settings->style != 'iconfall' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a {
    <?php echo ( $settings->tab_padding != '' ) ? $settings->tab_padding : ''; ?>
}
<?php
}

if( $settings->title_background_color != '' && $settings->style != 'iconfall' && $settings->style != 'simple' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li,
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tab-acc-title {
    background-color: <?php echo $settings->title_background_color; ?>;
}
<?php
}

if( $settings->title_hover_color != '' ) {
    if( $settings->style != 'linebox' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a:hover,
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a:hover .uabb-tab-title,
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tab-acc-title:hover .uabb-tab-title {
    color: <?php echo $settings->title_hover_color; ?>;
    transition: all 150ms linear;
}
<?php
    }
}

if( $settings->title_background_hover_color != '' ) {
?>

.fl-node-<?php echo $id; ?> .uabb-tabs-style-bar nav ul li a:hover,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-bar .uabb-tab-acc-title:hover {
    <?php
    echo ( $settings->title_background_hover_color != '' ) ? 'background-color:' . $settings->title_background_hover_color . ';' : '';
    ?>
}
.fl-node-<?php echo $id; ?> .uabb-tabs-style-simple nav ul li a,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-iconfall nav ul li a,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-iconfall .uabb-tab-acc-title,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-simple .uabb-tab-acc-title {
    background: none!important;
}
<?php
}
if( $settings->icon_hover_color != '' ) {
    if( $settings->style != 'iconfall' && $settings->style != 'linebox' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a:hover .uabb-tabs-icon i,
.fl-node-<?php echo $id; ?> .uabb-tab-acc-title:hover .uabb-tabs-icon i {
    <?php echo ( $settings->icon_hover_color != '' ) ? 'color:' . $settings->icon_hover_color . ';' : ''; ?>
}
<?php
   } 
}

if( $settings->title_active_color != '' ) {
?>

.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> .uabb-tab-current a .uabb-tab-title,
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> .uabb-tab-current a:hover .uabb-tab-title {
    color: <?php echo $settings->title_active_color; ?>;
}

<?php
}

if( $settings->icon_active_color != '' ) {
    if( $settings->style != 'iconfall' ) {
?>

.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li.uabb-tab-current a .uabb-tabs-icon i,
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li.uabb-tab-current a .uabb-tabs-icon i:hover,
.fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li.uabb-tab-current a:hover .uabb-tabs-icon i:hover,
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title .uabb-tabs-icon i,
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title .uabb-tabs-icon i:hover,
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title:hover .uabb-tabs-icon i:hover {
    color : <?php echo $settings->icon_active_color; ?>;
}

<?php
    }
}
?>

.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-content,
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-tab-acc-content {
    <?php
    echo ( $settings->content_padding != '' ) ? $settings->content_padding : '';
    $content_border_size = ( $settings->content_border_size != '' ) ? $settings->content_border_size : 1;
    echo ( $settings->content_border_style != 'none' ) ? 'border: ' . $content_border_size . 'px ' . $settings->content_border_style . ' ' . $settings->content_border_color . ';' : '';
    if( $settings->content_border_style == 'none' && $settings->content_border_radius != '' ) {
        echo 'border-radius: ' . $settings->content_border_radius . 'px;';
    }
    
    echo 'text-align: ' . $settings->content_alignment . ';';
    ?>
}

<?php
if( $settings->style == 'bar' ) {
    if( $settings->tab_spacing == 'yes' && $settings->tab_spacing_size != '' ) {
?>
.fl-node-<?php echo $id; ?> .fl-module-content .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul li {
    margin: 0 <?php echo $settings->tab_spacing_size / 2; ?>px;
}
.fl-node-<?php echo $id; ?> .fl-module-content .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> ul {
    margin: 0 -<?php echo $settings->tab_spacing_size / 2; ?>px;
}
<?php
    }
}
?>

.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-text-editor {
    color: <?php echo uabb_theme_text_color( $settings->content_color ); ?>;
    <?php
    if( $settings->content_font_family['family'] != 'Default' ) {
        UABB_Helper::uabb_font_css( $settings->content_font_family );        
    }
    echo ( $settings->content_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->content_font_size['desktop'] . 'px;' : '';
    echo ( $settings->content_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->content_line_height['desktop'] . 'px;' : '';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> {
    background-color: <?php echo $settings->content_background_color; ?>;
    <?php echo ( $settings->content_border_radius != '' && $settings->content_border_style == 'none' ) ? 'border-radius: ' . $settings->content_border_radius . 'px;' : ''; ?>
}

/* Style Dependent CSS Start */
/* _____________________________________________________________________ */

/* Top Line Style */
/* _____________________________________________________________________ */

.fl-node-<?php echo $id; ?> .uabb-tabs-style-topline .uabb-tabs-nav<?php echo $id; ?> li.uabb-tab-current a {
    background: none;
}

.fl-node-<?php echo $id; ?> .uabb-tabs-style-topline .uabb-tabs-nav<?php echo $id; ?> li.uabb-tab-current a,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-topline .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title {
    <?php
    $border_size = ( $settings->underline_border_size != '' ) ? $settings->underline_border_size : 6;
    $border_size = ( $settings->line_position == 'bottom' ) ? ( $border_size * -1 ) : $border_size;
    ?>
    <?php
    $color_default = ( uabb_theme_base_color( $settings->underline_border_color ) != '' ) ? uabb_theme_base_color( $settings->underline_border_color ) : '#a7a7a7';
    ?>
    box-shadow: inset 0 <?php echo $border_size; ?>px 0 <?php echo $color_default; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-tabs-style-topline .uabb-tabs-nav<?php echo $id; ?> li.uabb-tab-current {
    border-top-color: <?php echo uabb_theme_base_color( $color_default ); ?>;
}
<?php
if( $settings->title_hover_color != '' ) {
    if( $settings->style != 'linebox' ) {
?>
.fl-node-<?php echo $id; ?> .uabb-tabs-style-topline .uabb-tabs-nav<?php echo $id; ?> a:hover,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-topline .uabb-tabs-nav<?php echo $id; ?> a:hover * {
    color: <?php echo $settings->title_hover_color; ?>;
}
<?php
    }
}
?>

/* _____________________________________________________________________ */

/* Top Style Bar */
/* _____________________________________________________________________ */

.fl-node-<?php echo $id; ?> .uabb-tabs-style-bar ul li.uabb-tab-current a,
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title .uabb-tab-title,
.fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title .uabb-acc-icon {
    color: <?php echo $settings->title_active_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-tabs-style-bar > nav > ul li.uabb-tab-current a,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-bar .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title {
    <?php
    $color_default = ( uabb_theme_base_color( $settings->title_active_background_color ) != '' ) ? uabb_theme_base_color( $settings->title_active_background_color ) : '#a7a7a7';
    ?>
    background-color: <?php echo uabb_theme_base_color( $color_default ); ?>;
}

/* _____________________________________________________________________ */

/* Icon Fall */
/* _____________________________________________________________________ */

.fl-node-<?php echo $id; ?> .uabb-tabs-style-iconfall .uabb-tabs-nav<?php echo $id; ?> li::before {
    <?php
    $color_default = ( uabb_theme_base_color( $settings->underline_border_color ) != '' ) ? uabb_theme_base_color( $settings->underline_border_color ) : '#a7a7a7';
    ?>
    background: <?php echo $color_default; ?>;
    height: <?php echo ( $settings->underline_border_size != '' ) ? $settings->underline_border_size : 6 ; ?>px;
}


/* _____________________________________________________________________ */

/* Line Box */
/* _____________________________________________________________________ */

.fl-node-<?php echo $id; ?> .uabb-tabs-style-linebox .uabb-tabs-nav<?php echo $id; ?> a::after,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-linebox .uabb-tabs-nav<?php echo $id; ?> a:hover::after,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-linebox .uabb-tabs-nav<?php echo $id; ?> a:focus::after,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-linebox .uabb-tabs-nav<?php echo $id; ?> li.uabb-tab-current a::after,
.fl-node-<?php echo $id; ?> .uabb-tabs-style-linebox .uabb-content-wrap<?php echo $id; ?> .uabb-content-current > .uabb-tab-acc-title {
    <?php
    $color_default = ( uabb_theme_base_color( $settings->title_active_background_color ) != '' ) ? uabb_theme_base_color( $settings->title_active_background_color ) : '#a7a7a7';
    ?>
    background: <?php echo $color_default; ?>;
}


/* _____________________________________________________________________ */

/* Style Dependent CSS End */
/* _____________________________________________________________________ */

<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

        .fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-text-editor {
            <?php
            echo ( $settings->content_font_size['medium'] != '' ) ? 'font-size: ' . $settings->content_font_size['medium'] . 'px;' : '';
            echo ( $settings->content_line_height['medium'] != '' ) ? 'line-height: ' . $settings->content_line_height['medium'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a,
        .fl-node-<?php echo $id; ?> .uabb-tab-acc-title .uabb-title-tag {
            <?php
            echo ( $settings->title_font_size['medium'] != '' ) ? 'font-size: ' . $settings->title_font_size['medium'] . 'px;' : '';
            //echo ( $settings->title_line_height['medium'] != '' ) ? 'line-height: ' . $settings->title_line_height['medium'] . 'px;' : 'line-height: ' . ( $settings->title_font_size['medium'] + 2 ) . 'px;';
            echo ( $settings->title_line_height['medium'] != '' ) ? 'line-height: ' . $settings->title_line_height['medium'] . 'px;' : '';
            ?>
        }
        .fl-node-<?php echo $id; ?> .uabb-tab-acc-title .uabb-acc-icon {
            <?php echo ( $settings->title_line_height['medium'] != '' ) ? 'line-height: ' . $settings->title_line_height['medium'] . 'px;' : ''; ?>
        }
        
    }
 
    @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

        .fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-text-editor {
            <?php
            echo ( $settings->content_font_size['small'] != '' ) ? 'font-size: ' . $settings->content_font_size['small'] . 'px;' : '';
            echo ( $settings->content_line_height['small'] != '' ) ? 'line-height: ' . $settings->content_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-tabs .uabb-tabs-nav<?php echo $id; ?> li a,
        .fl-node-<?php echo $id; ?> .uabb-tab-acc-title .uabb-title-tag {
            <?php
            echo ( $settings->title_font_size['small'] != '' ) ? 'font-size: ' . $settings->title_font_size['small'] . 'px;' : '';
            //echo ( $settings->title_line_height['small'] != '' ) ? 'line-height: ' . $settings->title_line_height['small'] . 'px;' : 'line-height: ' . ( $settings->title_font_size['small'] + 2 ) . 'px;';
            echo ( $settings->title_line_height['small'] != '' ) ? 'line-height: ' . $settings->title_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-tab-acc-title .uabb-acc-icon {
            <?php echo ( $settings->title_line_height['small'] != '' ) ? 'line-height: ' . $settings->title_line_height['small'] . 'px;' : ''; ?>
        }


    }
<?php
}
?>
<?php if( $settings->responsive == 'accordion' ) : ?>
    <?php $responsive_breakpoint = ( $settings->responsive_breakpoint != '' ) ? $settings->responsive_breakpoint : $global_settings->responsive_breakpoint ?>
    @media ( max-width: <?php echo $responsive_breakpoint; ?>px ) {
        .fl-node-<?php echo $id; ?> .uabb-tabs-nav<?php echo $id; ?> {
            display: none;
        }
        .fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section,
        .fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-tab-acc-title {
            display: block;
        }
        .fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> {
            background: none;
        }
        .fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-tab-acc-content {
            background-color: <?php echo $settings->content_background_color; ?>;
        }
    }

    @media ( min-width: <?php echo $responsive_breakpoint + 1; ?>px ) {
        .fl-node-<?php echo $id; ?> .uabb-content-wrap<?php echo $id; ?> > .section > .uabb-tab-acc-content {
            display: block !important;
        }
    }
<?php endif; ?>