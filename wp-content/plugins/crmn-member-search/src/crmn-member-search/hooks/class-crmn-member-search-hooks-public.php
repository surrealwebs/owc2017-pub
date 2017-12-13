<?php
/**
 * Public-facing hooks functionality of the plugin.
 *
 * Here we define public facing "hooked" methods.
 * Methods defined here are "hooked" to WP actions/filters in \CRMN_Member_Search::add_public_hooks().
 *
 * @see     \CRMN_Member_Search::add_public_hooks()
 *
 * @package CRMN_Member_Search
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_Hooks_Public
 *
 * The public-facing functionality of the plugin.
 */
class CRMN_Member_Search_Hooks_Public {

	/**
	 * Setup the plugin text domain for gettext i18n/l10n.
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'crmn-member-search', false, CRMN_PLUGIN_REL_DIR . 'languages/' );
	}

	/**
	 * Register custom tables with WPDB.
	 *
	 * @action init, switch_blog
	 */
	public function register_tables() {
		CRMN_Member_Search_DB_Tables::register_table();
	}

	/**
	 * Register custom modules with Beaver Builder.
	 *
	 * Run each module's static register_module method here.
	 * What's implied, but not specifically stated, is that BB handles the instantiation of the object.
	 *
	 * @see \FLBuilderModel::register_module()
	 */
	public function register_modules() {
		CRMN_Member_Search_Module::register_module();
	}

	/**
	 * Update a user's address geodata.
	 *
	 * @action woocommerce_customer_save_address
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
	public function woocommerce_customer_save_address( $user_id = 0, $load_address = 'billing' ) {

		error_log( 'user_id: ' . $user_id . PHP_EOL );

		new CRMN_Member_Search_WP_User_Geocoder( $user_id, $load_address );
		return $user_id;
	}

	/**
	 * Fires after the form has been processed and save_pod_item has run.
	 *
	 * @param int       $id     Item ID.
	 * @param array     $params save_pod_item parameters.
	 * @param null|Pods $obj    Pod object (if set).
	 *
	 * @return int|null User ID if we have one, null otherwise.
	 */
	public function pods_user_save_meta( $id, $params, $obj = null ) {

		// If we are not on a user data form we don't want additional processing.
		if ( empty( $params['pod'] ) || 'user' != $params['pod'] ) {
			return null;
		}

		$user_id = ( ! empty( $params['id'] ) ? $params['id'] : null );

		if ( empty( $user_id ) ) {
			return null;
		}

		new CRMN_Member_Search_WP_User_Geocoder( $user_id );

		return $user_id;
	}
}
