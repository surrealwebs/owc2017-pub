<?php
/**
 * Fired during plugin deactivation
 *
 * @package    Member_Search
 * @subpackage Member_Search/includes
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @package    Member_Search
 * @subpackage Member_Search/includes
 */
class Member_Search_Deactivator {

	/**
	 * Deactivation hook.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
	}
}
