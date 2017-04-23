<?php

// Deny direct access
defined('ABSPATH') or die("YOU SHALL NOT PASS");

/**
 *
 */
class CRMN_Board_Member_CPT {

    /**
     * Add the init function to the init action
     * @method __construct
     */
    public function __construct() {
        add_action( "init", array($this, 'init') );
    }

    /**
     * Initialize the registration of the custom post type
     * @method init
     * @return VOID
     */
    public function init() {
        register_post_type( 'board-member',
            array(
                'labels' => array(
                    'name' => __( 'Board Member' ),
                    'singular_name' => __( 'Board Member' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'board-member'),
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'post-formats'),
            )
        );
    }
}
