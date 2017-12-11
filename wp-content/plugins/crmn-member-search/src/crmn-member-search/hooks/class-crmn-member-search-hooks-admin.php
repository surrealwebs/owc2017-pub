<?php
/**
 * Admin-specific hooks functionality of the plugin.
 *
 * Here we define admin facing "hooked" methods.
 * Methods defined here are "hooked" to WP actions/filters in \CRMN_Member_Search::add_admin_hooks().
 *
 * @see     \CRMN_Member_Search::add_admin_hooks()
 *
 * @package CRMN_Member_Search
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_Hooks_Admin
 *
 * The admin-specific functionality of the plugin.
 */
class CRMN_Member_Search_Hooks_Admin {

	/**
	 * Setup the plugin text domain for gettext i18n/l10n.
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'crmn-member-search', false, CRMN_PLUGIN_REL_DIR . 'languages/' );
	}

	/**
	 * Register custom tables with WPDB.
	 */
	public function register_tables() {
		global $wpdb;
		$wpdb->geodata = CRMN_Member_Search_DB_Tables::get_table_name();
	}

	/**
	 * Add Google Maps Key input to General Settings screen.
	 */
	public function admin_init() {
		$maps_api_key_fields = new CRMN_Member_Search_Google_Maps_API_Key();
		$maps_api_key_fields->admin_init();
	}

	/**
	 * Update a user's address geodata when they edit their own profile.
	 *
	 * @action personal_options_update
	 *
	 * @link   https://codex.wordpress.org/Plugin_API/Action_Reference/personal_options_update
	 *
	 * @param int $user_id
	 *
	 * @return int
	 */
	public function personal_options_update( $user_id = 0 ) {

		new CRMN_Member_Search_WP_User_Geocoder( $user_id, 'billing' );

		return $user_id;
	}

	/**
	 * Update a user's address geodata when their profile is edited by an Admin.
	 *
	 * @action edit_user_profile_update
	 *
	 * @link   https://codex.wordpress.org/Plugin_API/Action_Reference/edit_user_profile_update
	 *
	 * @param int $user_id
	 *
	 * @return int
	 */
	public function edit_user_profile_update( $user_id = 0 ) {

		new CRMN_Member_Search_WP_User_Geocoder( $user_id, 'billing' );

		return $user_id;
	}
}
