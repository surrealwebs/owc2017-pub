<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    Member_Search
 * @subpackage Member_Search/public
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Member_Search
 * @subpackage Member_Search/public
 */
class Member_Search_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 *
	 * @param string $plugin_name     The name of the plugin.
	 * @param string $version         The version of this plugin.
	 * @param string $plugin_file     The full path and filename of the Member_Search class file with symlinks resolved.
	 * @param string $plugin_path     The full path with trailing slash of the Member_Search class file .
	 * @param string $plugin_basename The relative path to the plugin, relative to the plugins directory.
	 * @param string $plugin_url      The URL path of the directory that contains the plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_file, $plugin_path, $plugin_basename, $plugin_url ) {

		$this->plugin_name = $plugin_name;

		$this->version = $version;
	}

	/**
	 * Update a user's address geodata.
	 *
	 * @action personal_options_update, edit_user_profile_update
	 *
	 * @link https://codex.wordpress.org/Geodata
	 *
	 * @param int    $user_id
	 * @param string $load_address
	 *
	 * @return mixed
	 */
	public function udpate_user_address_geodata( $user_id = 0, $load_address = 'billing' ) {
		new Member_Search_Geocoder( $user_id, $load_address );
		return $user_id;
	}
}
