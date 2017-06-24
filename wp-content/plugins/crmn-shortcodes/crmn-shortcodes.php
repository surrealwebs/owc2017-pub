<?php
/**
 * Plugin Name: CRMN Shortcodes
 * Plugin URI:
 * Description: Creates custom Shortcodes for Conflict Resolution MN
 * Author: BaconPress
 * Version: 0.0.1
 * Author URI:
 */

/**
 * Block direct accesss to plugin directories
 */
defined('ABSPATH') or die("YOU SHALL NOT PASS");

require_once('includes/event-shortcodes.php');

/**
 * Create the Event shortcodes
 */
new CRMN_Event_Shortcodes();

register_activation_hook( __FILE__, 'crmn_shortcode_activation' );
function crmn_shortcode_activation() {
  flush_rewrite_rules();
}
