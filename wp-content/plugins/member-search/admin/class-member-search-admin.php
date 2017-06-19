<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Member_Search
 * @subpackage Member_Search/admin
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The admin-specific functionality of the plugin.
 */
class Member_Search_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 *
	 * @param string $plugin_name     The name of this plugin.
	 * @param string $version         The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;

		$this->version = $version;
	}

	/**
	 * Update a user's address geodata.
	 *
	 * @action personal_options_update, edit_user_profile_update
	 *
	 * @link https://codex.wordpress.org/Geodata
	 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/personal_options_update
	 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/edit_user_profile_update
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
