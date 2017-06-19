<?php
/**
 * Fired during plugin activation
 *
 * @package    Member_Search
 * @subpackage Member_Search/includes
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Member_Search
 * @subpackage Member_Search/includes
 */
class Member_Search_Activator {

	/**
	 * Activation hook.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		/**
		 * Install custom table used for indexed geolocation.
		 */
		Member_Search_Activator::install_table();

		/**
		 * Set our DB version in case we need it in the future for upgrade routines.
		 */
		Member_Search_Activator::set_db_version();

		/**
		 * Register our custom table with WPDB.
		 */
		Member_Search_Activator::register_table();
	}

	public static function set_db_version() {
		add_option( 'geodata_db_version', Member_Search_Activator::get_db_version() );
	}

	/**
	 * Get the custom database version.
	 *
	 * Should be a PHP version_compare compatible string.
	 * Although not currently implemented, this can be used for future db upgrade routines.
	 *
	 * @return string
	 */
	public static function get_db_version() {
		return '1.0.0';
	}

	/**
	 * Return the name of the custom table.
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 *
	 * @return string
	 */
	public static function get_table_name() {

		global $wpdb;

		return $wpdb->prefix . 'geodata';
	}

	/**
	 * Install our custom database table.
	 *
	 * WordPress does define a "Geodata API" (using the API term loosely). However, it really only defines meta names
	 * to use for post, term, comment, and user meta tables. Since geolocation can be resource intensive when searching
	 * large amounts of unindexed data, we shall employ a custom table. There are some plugins out there that do use
	 * the "Geodata API" as it is defined, so we should still use the meta names defined in the WP "Geodata API," and
	 * the data should exist in both places, in the meta tables and in our custom table, and both should be updated
	 * appropriately. Think of this table as just a geolocation search index.
	 *
	 * @link https://codex.wordpress.org/Geodata
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 */
	public static function install_table() {

		global $wpdb;

		/**
		 * Get the charset and collation from WPDB.
		 *
		 * Will be a string like 'DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci',
		 * or 'DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci', for example.
		 *
		 * @var string $charset_collate
		 */
		$charset_collate = $wpdb->get_charset_collate();

		/**
		 * The name for our custom table.
		 *
		 * A string like "tableprefix_geodata".
		 *
		 * @var string $table_name
		 */
		$table_name = Member_Search_Activator::get_table_name();

		/**
		 * The SQL query to run that creates the custom geodata table.
		 *
		 * The table fields are defined as follows...
		 * +-----------------+---------------------+------+-----+---------+----------------+
		 * | Field           | Type                | Null | Key | Default | Extra          |
		 * +-----------------+---------------------+------+-----+---------+----------------+
		 * | geo_id          | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
		 * | geo_object_id   | bigint(20) unsigned | NO   | MUL | 0       |                |
		 * | geo_latitude    | decimal(9,6)        | YES  | MUL | NULL    |                |
		 * | geo_longitude   | decimal(9,6)        | YES  | MUL | NULL    |                |
		 * | geo_object_type | varchar(20)         | NO   | MUL | WP_Post |                |
		 * | geo_public      | tinyint(1)          | YES  |     | NULL    |                |
		 * | geo_address     | text                | NO   |     | NULL    |                |
		 * +-----------------+---------------------+------+-----+---------+----------------+
		 *
		 * The inserted data would look something like this in the database:
		 * +--------+---------------+--------------+---------------+-----------------+------------+-------------------+
		 * | geo_id | geo_object_id | geo_latitude | geo_longitude | geo_object_type | geo_public | geo_address       |
		 * +--------+---------------+--------------+---------------+-----------------+------------+-------------------+
		 * |      1 |             2 |    44.830853 |    -93.299872 | WP_User         |          1 | 9555 James Ave... |
		 * +--------+---------------+--------------+---------------+-----------------+------------+-------------------+
		 *
		 * Where,
		 * geo_id is simply an auto-incrementing primary key,
		 * geo_object_id is either a post_id, a comment_id, a term_id, or a user_id,
		 * geo_latitude and geo_longitude are self-explanatory,
		 * geo_object_type would be either WP_Post, WP_Comment, WP_Term, or WP_User,
		 * geo_public indicates if the data is public or not,
		 * and geo_address is the "formatted_address" returned by the Google Maps API response.
		 *
		 * @var string $sql
		 */
		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
	        geo_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	        geo_object_id bigint(20) unsigned NOT NULL DEFAULT '0',
	        geo_latitude DECIMAL(9,6) NULL,
	        geo_longitude DECIMAL(9,6) NULL,
	        geo_object_type varchar(20) NOT NULL DEFAULT 'WP_Post',
	        geo_public tinyint(1) DEFAULT NULL,
	        geo_address text NOT NULL,
			PRIMARY KEY (geo_id),
			KEY geo_object_id (geo_object_id),
			KEY geo_object_type (geo_object_type),
			KEY geo_latitude (geo_latitude),
			KEY geo_longitude (geo_longitude)
		) {$charset_collate};";

		/**
		 * dbDelta is only available by manually requiring the upgrade include.
		 */
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta( $sql );
	}

	/**
	 * Registers the table with $wpdb.
	 *
	 * @access public
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 */
	public static function register_table() {

		global $wpdb;

		$wpdb->geodata = Member_Search_Activator::get_table_name();
	}
}
