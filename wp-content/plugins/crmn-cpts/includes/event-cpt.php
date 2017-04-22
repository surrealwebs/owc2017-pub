<?php

// Deny direct access
defined('ABSPATH') or die("YOU SHALL NOT PASS");

/**
 *
 */
class CRMN_EVENT_CPT {

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
        register_post_type( 'event',
            array(
                'labels' => array(
                    'name' => __( 'Events' ),
                    'singular_name' => __( 'Events' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'event'),
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'post-formats'),
            )
        );
    }
}
