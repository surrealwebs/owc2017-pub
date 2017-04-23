<?php
/**
 * The Custom Page Builder Modules plugin file.
 *
 * @package           Custom_Page_Builder_Modules
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Page Builder Modules
 * Plugin URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * Description:       Custom page builder modules.
 * Version:           1.0.0
 * Author:            BaconPress
 * Author URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       owcbpcpb
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * The full directory path to the main plugin file.
 *
 * @const string OWCBPCPB_PLUGIN_DIR
 */
define( 'OWCBPCPB_PLUGIN_DIR', dirname( __FILE__ ) );

/**
 * The full URL to the main plugin file.
 *
 * @const string OWCBPCPB_PLUGIN_URL
 */
define( 'OWCBPCPB_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

/**
 * Load custom modules.
 */
function owcbpcpb_load_modules() {

	// Exit early if Beaver Builder isn't available.
	if ( ! class_exists( 'FLBuilder' ) ) {
		return;
	}

	// Require once any modules that should be available, that only depend on Beaver Builder here.

	// Exit early if Beaver Builder Theme isn't available.
	if ( ! class_exists( 'FLTheme' ) ) {
		return;
	}

	require_once OWCBPCPB_PLUGIN_DIR . '/modules/social-links-menu/class-baconpress-social-links-menu.php';
}

add_action( 'init', 'owcbpcpb_load_modules' );
