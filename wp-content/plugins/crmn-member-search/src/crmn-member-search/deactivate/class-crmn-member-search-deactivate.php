<?php
/**
 * CRMN_Member_Search_Deactivate class file.
 *
 * Actions to perform right away on plugin deactivation.
 *
 * @package CRMN_Member_Search
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_Deactivate
 */
class CRMN_Member_Search_Deactivate {

	/**
	 * Actions to run on plugin deactivation.
	 *
	 * Flush rewrite rules, and any other tasks we may need to run on deactivation.
	 *
	 * Note that this is not the same thing as an uninstall, which would be a separate matter
	 * (and currently unnecessary).
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_deactivation_hook
	 */
	public static function deactivation_hook() {

		/**
		 * Flush rewrite rules.
		 */
		flush_rewrite_rules();
	}
}
