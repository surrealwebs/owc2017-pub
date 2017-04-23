<?php
/**
 * Plugin Name: CRMN CPTs
 * Plugin URI:
 * Description: Creates custom post tyoes for Conflict Resolution MN
 * Author:
 * Version: 0.0.1
 * Author URI:
 */



/**
 * Block direct accesss to plugin directories
 */
defined('ABSPATH') or die("YOU SHALL NOT PASS");

require_once('includes/event-cpt.php');
require_once('includes/board-members-cpt.php');

/**
 * Create the Event custom post type
 */
new CRMN_EVENT_CPT();
new CRMN_Board_Member_CPT();


register_activation_hook( __FILE__, 'crmn_cpt_activation' );
function crmn_cpt_activation() {
	flush_rewrite_rules();
}
