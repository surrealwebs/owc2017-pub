<?php

function uabb_column_render_css(  ) {

    add_filter( 'fl_builder_render_css', 'uabb_column_gradient_css', 10, 3 );
}

function uabb_column_gradient_css( $css, $nodes, $global_settings ) {

    foreach ( $nodes['columns'] as $column ) {

        $column->settings->uabb_col_linear_gradient_primary_loc = ( isset($column->settings->uabb_col_linear_gradient_primary_loc) && $column->settings->uabb_col_linear_gradient_primary_loc != '' ) ? $column->settings->uabb_col_linear_gradient_primary_loc : 0;
        $column->settings->uabb_col_linear_gradient_secondary_loc = ( isset($column->settings->uabb_col_linear_gradient_secondary_loc) && $column->settings->uabb_col_linear_gradient_secondary_loc != '' ) ? $column->settings->uabb_col_linear_gradient_secondary_loc : 100;
        $column->settings->uabb_col_radial_gradient_primary_loc = ( isset($column->settings->uabb_col_radial_gradient_primary_loc) && $column->settings->uabb_col_radial_gradient_primary_loc != '' ) ? $column->settings->uabb_col_radial_gradient_primary_loc : 0;
        $column->settings->uabb_col_radial_gradient_secondary_loc = ( isset($column->settings->uabb_col_radial_gradient_secondary_loc) && $column->settings->uabb_col_radial_gradient_secondary_loc != '' ) ? $column->settings->uabb_col_radial_gradient_secondary_loc : 100;
        ob_start();

        if( isset( $column->settings->uabb_col_radial_direction ) ) {
            $column->settings->uabb_col_radial_direction = str_replace("_"," ",$column->settings->uabb_col_radial_direction);
        }

        switch ( $column->settings->uabb_col_uabb_direction ) {
            case 'top':
                $column->settings->uabb_col_linear_direction = '0';
                break;
            case 'bottom':
                $column->settings->uabb_col_linear_direction = '180';
                break;
            case 'left':
                $column->settings->uabb_col_linear_direction = '90';
                break;
            case 'right':
                $column->settings->uabb_col_linear_direction = '270';
                break;
            case 'top_right_diagonal':
                $column->settings->uabb_col_linear_direction = '45';
                break;
            case 'top_left_diagonal':
                $column->settings->uabb_col_linear_direction = '315';
                break;
            case 'bottom_right_diagonal':
                $column->settings->uabb_col_linear_direction = '135';
                break;
            case 'bottom_left_diagonal':
                $column->settings->uabb_col_linear_direction = '255';
                break;
        }

        if( $column->settings->uabb_col_linear_advance_options == 'no' ) {
            $column->settings->uabb_col_linear_gradient_primary_loc   = '0';
            $column->settings->uabb_col_linear_gradient_secondary_loc = '100';
        }
        if( $column->settings->uabb_col_radial_advance_options == 'no' ) {
            $column->settings->uabb_col_radial_gradient_primary_loc   = '0';
            $column->settings->uabb_col_radial_gradient_secondary_loc = '100';
        }

        if( $column->settings->uabb_col_linear_direction == '' ) {
            $column->settings->uabb_col_linear_direction   = '0';
        }
         
        if ( isset( $column->settings->bg_type ) && 'uabb_gradient' == $column->settings->bg_type ) {
            ?>

            <?php if ( $column->settings->uabb_col_gradient_type == 'linear' ) { ?>
                .fl-node-<?php echo $column->node; ?> {
                    background-color: #<?php echo $column->settings->uabb_col_gradient_primary_color; ?>;
                    background-image: -webkit-linear-gradient(<?php echo $column->settings->uabb_col_linear_direction . 'deg'; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_secondary_loc . '%' ; ?>);
                    background-image: -moz-linear-gradient(<?php echo $column->settings->uabb_col_linear_direction . 'deg'; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_secondary_loc . '%' ; ?>);
                    background-image: -o-linear-gradient(<?php echo $column->settings->uabb_col_linear_direction . 'deg'; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_secondary_loc . '%' ; ?>);
                    background-image: -ms-linear-gradient(<?php echo $column->settings->uabb_col_linear_direction . 'deg'; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_secondary_loc . '%' ; ?>);
                    background-image: linear-gradient(<?php echo $column->settings->uabb_col_linear_direction . 'deg'; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_linear_gradient_secondary_loc . '%' ; ?>);
                }
            <?php } ?>
            <?php if ( $column->settings->uabb_col_gradient_type == 'radial' ) { ?>
                .fl-node-<?php echo $column->node; ?> {
                    background-color: #<?php echo $column->settings->uabb_col_gradient_primary_color; ?>;
                    background-image: -webkit-radial-gradient(<?php echo 'at ' . $column->settings->uabb_col_radial_direction ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_secondary_loc . '%' ; ?>);
                    background-image: -moz-radial-gradient(<?php echo 'at ' . $column->settings->uabb_col_radial_direction ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_secondary_loc . '%' ; ?>);
                    background-image: -o-radial-gradient(<?php echo 'at ' . $column->settings->uabb_col_radial_direction ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_secondary_loc . '%' ; ?>);
                    background-image: -ms-radial-gradient(<?php echo 'at ' . $column->settings->uabb_col_radial_direction ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_secondary_loc . '%' ; ?>);
                    background-image: radial-gradient(<?php echo 'at ' . $column->settings->uabb_col_radial_direction ?>, <?php echo '#'.$column->settings->uabb_col_gradient_primary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_primary_loc . '%' ; ?>, <?php echo '#'.$column->settings->uabb_col_gradient_secondary_color; ?> <?php echo $column->settings->uabb_col_radial_gradient_secondary_loc . '%' ; ?>);
                }
            <?php } ?>
        <?php } ?>
    <?php
        $css .= ob_get_clean();
    }

    return $css;
}