<?php
/**
 * CRMN_Member_Search_Activate class file.
 *
 * Actions to perform right away on plugin activation.
 *
 * @package CRMN_Member_Search
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_Activate
 */
class CRMN_Member_Search_Activate {

	/**
	 * Actions to run on plugin activation.
	 *
	 * We need to flush the rewrite rules on activation, but the cpts and taxonomies don't exist at this point.
	 * Manually call the function that registers the cpts and taxonomies before flushing the rewrite rules.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_activation_hook
	 */
	public static function activation_hook() {

		/**
		 * Install custom table used for indexed geolocation.
		 */
		CRMN_Member_Search_DB_Tables::install_table();

		/**
		 * Set our DB version in case we need it in the future for upgrade routines.
		 */
		CRMN_Member_Search_DB_Tables::set_db_version();

		/**
		 * Register our custom table with WPDB.
		 */
		CRMN_Member_Search_DB_Tables::register_table();

		/**
		 * Flush rewrite rules.
		 */
		flush_rewrite_rules();
	}
}
