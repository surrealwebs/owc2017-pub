<?php
/**
 * CRMN_Member_Search_DB_Tables class file.
 *
 * @package CRMN_Member_Search
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class CRMN_Member_Search_DB_Tables
 *
 * The class for dealing with custom database tables, instantiated in the plugin bootstrap.
 */
class CRMN_Member_Search_DB_Tables {

	/**
	 * The "version" of our database table.
	 *
	 * @var string
	 */
	protected static $db_version = '1.0.0';

	/**
	 * The "suffix" of our database table name.
	 *
	 * @var string
	 */
	protected static $table_suffix = 'geodata';

	/**
	 * Add an option to the database describing this version of the database.
	 * This can be useful if we need to have upgrade routines later.
	 */
	public static function set_db_version() {
		add_option( 'geodata_db_version', self::get_db_version() );
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
		return self::$db_version;
	}

	/**
	 * Get the custom table suffix.
	 *
	 * @return string
	 */
	public static function get_table_suffix() {
		return self::$table_suffix;
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

		return $wpdb->prefix . self::get_table_suffix();
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
		$table_name = self::get_table_name();

		/**
		 * The SQL query to run that creates the custom geodata table.
		 *
		 * NOTE: dbDelta is VERY FINICKY when creating or updating tables, make sure you read the docs thoroughly.
		 *
		 * The table fields are defined as follows...
		 * +--------------------------------+---------------------+------+-----+---------+----------------+
		 * | Field                          | Type                | Null | Key | Default | Extra          |
		 * +--------------------------------+---------------------+------+-----+---------+----------------+
		 * | geo_id                         | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
		 * | geo_object_id                  | bigint(20) unsigned | NO   | MUL | 0       |                |
		 * | geo_latitude                   | decimal(9,6)        | YES  | MUL | NULL    |                |
		 * | geo_longitude                  | decimal(9,6)        | YES  | MUL | NULL    |                |
		 * | geo_object_type                | varchar(20)         | NO   | MUL | WP_Post |                |
		 * | geo_public                     | tinyint(1)          | YES  |     | NULL    |                |
		 * | geo_address                    | text                | NO   |     | NULL    |                |
		 * | is_member_of_acr_international | tinyint(1)          | NO   |     | 0       |                |
		 * | is_rule_114_qualified_neutral  | tinyint(1)          | NO   |     | 0       |                |
		 * | ever_had_license_revoked       | tinyint(1)          | NO   |     | 0       |                |
		 * | services_provided              | text                | NO   |     | NULL    |                |
		 * | general_adr_matters            | text                | NO   |     | NULL    |                |
		 * | detailed_adr_matters           | text                | NO   |     | NULL    |                |
		 * | additional_languages_spoken    | text                | NO   |     | NULL    |                |
		 * | first_name                     | text                | NO   |     | NULL    |                |
		 * | last_name                      | text                | NO   |     | NULL    |                |
		 * | company                        | text                | NO   |     | NULL    |                |
		 * | opt_out_public_search          | tinyint(1)          | NO   |     | 0       |                |
		 * +--------------------------------+---------------------+------+-----+---------+----------------+
		 *
		 * The inserted data would look something like this in the database:
		 * +--------+---------------+--------------+---------------+-----------------+------------+-------------------+--------------------------------+-------------------------------+--------------------------+-------------------+---------------------+----------------------+-----------------------------+------------+-----------+---------+-----------------------+
		 * | geo_id | geo_object_id | geo_latitude | geo_longitude | geo_object_type | geo_public | geo_address       | is_member_of_acr_international | is_rule_114_qualified_neutral | ever_had_license_revoked | services_provided | general_adr_matters | detailed_adr_matters | additional_languages_spoken | first_name | last_name | company | opt_out_public_search |
		 * +--------+---------------+--------------+---------------+-----------------+------------+-------------------+--------------------------------+-------------------------------+--------------------------+-------------------+---------------------+----------------------+-----------------------------+------------+-----------+---------+-----------------------+
		 * |      1 |             2 |    44.830853 |    -93.299872 | WP_User         |          1 | 9555 James Ave... |                              1 |                             1 |                        1 |         Mediation | Business to Bus...  | ADR Training, Cir... | Chinese, Russian            | Richard    | Richards  | Nerdery |                     0 |
		 * +--------+---------------+--------------+---------------+-----------------+------------+-------------------+--------------------------------+-------------------------------+--------------------------+-------------------+---------------------+----------------------+-----------------------------+------------+-----------+---------+-----------------------+
		 *
		 * Where,
		 * geo_id is simply an auto-incrementing primary key,
		 * geo_object_id is either a post_id, a comment_id, a term_id, or a user_id,
		 * geo_latitude and geo_longitude are self-explanatory,
		 * geo_object_type would be either WP_Post, WP_Comment, WP_Term, or WP_User,
		 * geo_public indicates if the data is public or not,
		 * and geo_address is the "formatted_address" returned by the Google Maps API response.
		 *
		 * @link https://codex.wordpress.org/Creating_Tables_with_Plugins#Creating_or_Updating_the_Table
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
			is_member_of_acr_international tinyint(1) DEFAULT 0,
			is_rule_114_qualified_neutral tinyint(1) DEFAULT 0,
			ever_had_license_revoked tinyint(1) DEFAULT 0,
			services_provided varchar(255),
			general_adr_matters varchar(255),
			detailed_adr_matters varchar(255),
			additional_languages_spoken varchar(255),
			first_name varchar(255) not null,
			last_name varchar(255) not null,
			company varchar(255),
			opt_out_public_search tinyint(1) default 0
			PRIMARY KEY  (geo_id),
			KEY geo_object_id (geo_object_id),
			KEY geo_object_type (geo_object_type),
			KEY geo_latitude (geo_latitude),
			KEY geo_longitude (geo_longitude),
			INDEX idx_is_member_of_acr_international (is_member_of_acr_international),
			INDEX idx_is_rule_114_qualified_neutral (is_rule_114_qualified_neutral),
			INDEX idx_ever_had_license_revoked (ever_had_license_revoked),
			INDEX idx_services_provided (services_provided),
			INDEX idx_general_adr_matters (general_adr_matters),
			INDEX idx_detailed_adr_matters (detailed_adr_matters),
			INDEX idx_additional_languages_spoken (additional_languages_spoken),
			INDEX idx_first_name (first_name),
			INDEX idx_last_name (last_name),
			INDEX idx_company (company),
			INDEX idx_opt_out (opt_out_public_search)
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
	 * @global wpdb $wpdb WordPress database abstraction object.
	 */
	public static function register_table() {

		global $wpdb;

		$wpdb->geodata = self::get_table_name();
	}
}
