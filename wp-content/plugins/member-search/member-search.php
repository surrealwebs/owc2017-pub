<?php
/**
 * Member Search plugin bootstrap file.
 *
 * @todo Need to write queries for member searches.
 * @todo Need to write transient cache for member search queries.
 * @todo Need to write template tags for outputting member search form.
 * @todo Need to write template partials for outputting member search details.
 * @todo Consider using Underscore.js powered templates if we want to use JS for output and "infinite scroll".
 *
 * @package           Member_Search
 *
 * @wordpress-plugin
 * Plugin Name:       Member Search
 * Plugin URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * Description:       Adds member geocoding and geodata search capability.
 * Version:           1.0.0
 * Author:            BaconPress
 * Author URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       membersearch
 * Domain Path:       /languages
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The full directory path to the main plugin file.
 *
 * @const string OWCBPMS_PLUGIN_NAME
 */
define( 'OWCBPMS_PLUGIN_NAME', 'member-search' );

/**
 * The full directory path to the main plugin file.
 *
 * @const string OWCBPMS_PLUGIN_VERSION
 */
define( 'OWCBPMS_PLUGIN_VERSION', '1.0.0' );

/**
 * The full directory path to the main plugin file.
 *
 * @const string OWCBPMS_PLUGIN_BASENAME
 */
define( 'OWCBPMS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The full directory path to the main plugin file.
 *
 * @const string OWCBPMS_PLUGIN_FILE
 */
define( 'OWCBPMS_PLUGIN_FILE', __FILE__ );

/**
 * The full directory path to the main plugin file.
 *
 * @const string OWCBPMS_PLUGIN_DIR
 */
define( 'OWCBPMS_PLUGIN_DIR', dirname( __FILE__ ) . '/' );

/**
 * The full URL to the main plugin file.
 *
 * @const string OWCBPMS_PLUGIN_URL
 */
define( 'OWCBPMS_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function owcbpms_activate() {
	require_once OWCBPMS_PLUGIN_DIR . 'includes/class-member-search-activator.php';
	Member_Search_Activator::activate();
}

register_activation_hook( __FILE__, 'owcbpms_activate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require OWCBPMS_PLUGIN_DIR . 'includes/class-member-search.php';

/**
 * Begins execution of the plugin.
 */
function owcbpms_run_member_search() {

	$plugin = new Member_Search();
	$plugin->run();

}

owcbpms_run_member_search();
