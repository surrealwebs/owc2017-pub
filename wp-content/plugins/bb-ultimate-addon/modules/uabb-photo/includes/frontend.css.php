<?php 
    $settings->style_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'style_bg_color', true );
?>
.fl-node-<?php echo $id; ?> {
    width: 100%;
}

.fl-node-<?php echo $id; ?> .uabb-photo-content {
    
    <?php  if ( $settings->style != "simple" ) {
       // if( $settings->bg_size != '' && $settings->bg_size != '0' ) { ?>
    background-color: <?php echo uabb_theme_base_color( $settings->style_bg_color ); ?>;
    <?php //} ?>

    <?php if(!empty($settings->bg_border_radius) && $settings->style == "custom") : ?>
    border-radius: <?php echo $settings->bg_border_radius; ?>px;
    <?php endif; ?>

    <?php if($settings->style == "circle") : ?>
    border-radius: 50%;
    <?php endif; ?>

    <?php if(!empty($settings->bg_size)) : ?>
    padding: <?php echo $settings->bg_size; ?>px;
    <?php endif; ?>

    <?php } ?>
}

<?php /*if(!empty($settings->bg_border_radius) && $settings->style == "custom") : ?>
.fl-node-<?php echo $id; ?> .uabb-photo-caption {
    border-bottom-left-radius: <?php echo $settings->bg_border_radius; ?>px;
    border-bottom-right-radius: <?php echo $settings->bg_border_radius; ?>px;
}
<?php endif;*/ ?>

.fl-node-<?php echo $id; ?> .uabb-photo-content img {

    <?php if( $settings->photo_size != '' ) : ?>
    width: <?php echo $settings->photo_size; ?>px;
    <?php endif; ?>
    <?php if( $settings->style == 'custom' ) : ?>
    border-radius: <?php echo intval($settings->bg_border_radius) - intval($settings->bg_size); ?>px;
    <?php endif; ?>
    <?php if( $settings->style == 'circle' ) : ?>
    border-radius: calc( 50% );
    <?php endif; ?>
}
.fl-node-<?php echo $id; ?> .uabb-photo-caption { 
    <?php if( $settings->show_caption == 'hover' && ( $settings->style == 'circle' || $settings->style == 'custom' )  ) : ?>
    top: 50%;
    bottom: auto;
    transform: translateY(-50%);    
    <?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img {
    -moz-transition: all .3s ease;
    -webkit-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

<?php if( $settings->hover_effect == 'style1' ) : ?>
    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img {
        opacity: <?php echo ($settings->opacity != '') ? $settings->opacity / 100 : 100; ?>;
    }
    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        opacity: <?php echo ($settings->hover_opacity != '') ? $settings->hover_opacity / 100 : 100; ?>; 
    }
<?php elseif( $settings->hover_effect == 'style2' ) : ?>
    /*.fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter ….3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\/></filter></svg>#grayscale");
        filter: gray;
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        -o-filter: grayscale(100%);
    }
    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img {
        -webkit-filter: grayscale(0);
        -moz-filter: grayscale(0);
        -ms-filter: grayscale(0);
        filter: grayscale(0);
    }*/
<?php elseif( $settings->hover_effect == 'style3' ) : ?>

    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        -webkit-filter: blur(5px);
        filter: blur(5px);
    }

<?php elseif( $settings->hover_effect == 'style4' ) : ?>

    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        -webkit-filter: sepia(1);
        filter: sepia(1);
    }

<?php elseif( $settings->hover_effect == 'style5' ) : ?>

    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        -webkit-filter: saturate(8);
        filter: saturate(8);
    }

<?php elseif( $settings->hover_effect == 'style6' ) : ?>

    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        -webkit-filter: hue-rotate(90deg);
        filter: hue-rotate(90deg);
    }

<?php elseif( $settings->hover_effect == 'style7' ) : ?>

    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        -webkit-filter: invert(.8);
        filter: invert(.8);
    }

<?php elseif( $settings->hover_effect == 'style8' ) : ?>

    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        -webkit-filter: brightness(3);
        filter: brightness(3);
    }

<?php elseif( $settings->hover_effect == 'style9' ) : ?>

    .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
        -webkit-filter: contrast(4);
        filter: contrast(4);
    }

<?php endif; ?>
<?php
if( $settings->hover_effect == 'simple' ) {
    if( $settings->img_grayscale_simple != 'yes' ) {
?>
        .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
            -webkit-filter: grayscale(100%);
            -webkit-filter: grayscale(1);
            filter: grayscale(100%);
            filter: gray;
        }
<?php
    }
} else if( $settings->hover_effect == 'style2' ) {
    if( $settings->img_grayscale_grayscale != 'yes' ) {
?>
        .fl-node-<?php echo $id; ?> .uabb-photo-content .uabb-photo-img:hover {
            -webkit-filter: grayscale(1%);
            filter: grayscale(1%);
        }
<?php
    }
}
?>

<?php 
// Responsive button Alignment
if( $global_settings->responsive_enabled ) : ?> 
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
    .fl-node-<?php echo $id; ?> .uabb-photo-mob-align-<?php echo $settings->responsive_align; ?> {
        text-align: <?php echo $settings->responsive_align; ?>;
    }
}
<?php endif; ?>