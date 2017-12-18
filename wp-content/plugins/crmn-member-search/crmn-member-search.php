<?php
/**
 * CRMN Member Search plugin bootstrap file.
 *
 * @todo Need to write transient cache for member search queries.
 *
 * @package           CRMN_Member_Search
 *
 * @wordpress-plugin
 * Plugin Name:       CRMN Member Search
 * Plugin URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * Description:       Adds member geocoding and geodata search capability.
 * Version:           1.0.1
 * Author:            BaconPress
 * Author URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       crmn-member-search
 * Domain Path:       /languages
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The full directory path to the main plugin file.
 *
 * @const string CRMN_PLUGIN_NAME
 */
define( 'CRMN_PLUGIN_NAME', 'crmn-member-search' );

/**
 * The full directory path to the main plugin file.
 *
 * @const string CRMN_PLUGIN_VERSION
 */
define( 'CRMN_PLUGIN_VERSION', '1.0.1' );

/**
 * The full directory path to the main plugin file.
 *
 * @const string CRMN_PLUGIN_BASENAME
 */
define( 'CRMN_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The full directory path to the main plugin file.
 *
 * @const string CRMN_PLUGIN_FILE
 */
define( 'CRMN_PLUGIN_FILE', __FILE__ );

/**
 * The full directory path to the main plugin file.
 *
 * @const string CRMN_PLUGIN_DIR
 */
define( 'CRMN_PLUGIN_DIR', dirname( __FILE__ ) . '/' );

/**
 * The relative path to this plugin directory, from WP_PLUGIN_DIR.
 *
 * @var string CRMN_PLUGIN_REL_DIR
 */
define( 'CRMN_PLUGIN_REL_DIR', basename( CRMN_PLUGIN_DIR ) . '/' );

/**
 * The full URL to the main plugin file.
 *
 * @const string CRMN_PLUGIN_URL
 */
define( 'CRMN_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

/**
 * The full path to this plugin's modules directory with symlinks resolved.
 *
 * @var string CRMN_PLUGIN_MODULES_DIR
 */
define( 'CRMN_PLUGIN_MODULES_DIR', CRMN_PLUGIN_DIR . 'src/crmn-member-search/modules/' );

/**
 * The URL to this plugin's modules directory.
 *
 * @var string CRMN_PLUGIN_MODULES_URL
 */
define( 'CRMN_PLUGIN_MODULES_URL', CRMN_PLUGIN_URL . 'src/crmn-member-search/modules/' );

/**
 * Autoload classes for the plugin.
 *
 * This uses xrstf/composer-php52 autoloader for WordPress Standard PHP 5.2 compatibility.
 * If you are adding/removing classes or restructuring the src dir,
 * you will need to run composer to regenerate the autoload classmap.
 */
require_once CRMN_PLUGIN_DIR . 'vendor/autoload_52.php';

/**
 * Register the activation hook, which performs any actions that are necessary when plugin is activated.
 */
register_activation_hook( CRMN_PLUGIN_FILE, array( 'CRMN_Member_Search_Activate', 'activation_hook' ) );

/**
 * Register the deactivation hook, which performs any actions that are necessary when plugin is deactivated.
 */
register_deactivation_hook( CRMN_PLUGIN_FILE, array( 'CRMN_Member_Search_Deactivate', 'deactivation_hook' ) );

/**
 * Begins execution of the plugin.
 */
function crmn_run_member_search() {

	$plugin = new CRMN_Member_Search();
	$plugin->load();

}

crmn_run_member_search();
