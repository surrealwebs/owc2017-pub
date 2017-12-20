<?php
/**
 * CRMN_Member_Search_Module Class file.
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_Module
 */
class CRMN_Member_Search_Module extends FLBuilderModule {

	/**
	 * Store the user's search query.
	 *
	 * @var array $directory_search_user_query
	 */
	public $directory_search_user_query = array();

	/**
	 * Store the user's search radius center.
	 *
	 * @var array $search_center
	 */
	public $search_center = array();

	/**
	 * Extra search query params.
	 *
	 * @var array $extra_query
	 */
	public $extra_query = array();

	/**
	 * The allowed form fields and their sanitize mapping for $_POST input.
	 *
	 * These should match the form input fields,
	 * if the field should map to one of the SQL table columns,
	 * then make sure that this, the SQL table column, and the field input all match,
	 * and what we are allowing to search on in the wp_geodata table,
	 * plus a couple of extra bits specific to the search form like the nonce and referer and submit.
	 * If you add/edit/remove fields from the wp_geodata table that are to be searchable,
	 * update this AND $allowed_extra_query_fields.
	 *
	 * @see \CRMN_Member_Search_DB_Tables::install_table()
	 *
	 * $_POST could contain something like the following...
	 * Array (
	 *     'first-name'              => 'Richard'
	 *     'last-name'               => 'Aber'
	 *     'company'                 => 'Nerdery'
	 *     'services_provided'       => 'mediation'
	 *     'areas-of-expertise'      => 'training'
	 *     'additional-languages'    => 'chinese'
	 *     'search-center'           => '55431'
	 *     'search-radius'           => '5'
	 *     'crm-member-search'       => 'e88cef0fa3'
	 *     '_wp_http_referer'        => '/'
	 *     'submit-directory-search' => 'Directory Search'
	 * )
	 *
	 * @var array $input_definition
	 */
	public static $input_definition = array(
		'is_member_of_acr_international' => FILTER_SANITIZE_NUMBER_INT,
		'is_rule_114_qualified_neutral'  => FILTER_SANITIZE_NUMBER_INT,
		'ever_had_license_revoked'       => FILTER_SANITIZE_NUMBER_INT,
		'services_provided'              => FILTER_SANITIZE_STRING,
		'general_adr_matters'            => FILTER_SANITIZE_STRING,
		'detailed_adr_matters'           => FILTER_SANITIZE_STRING,
		'additional_languages_spoken'    => FILTER_SANITIZE_STRING,
		'first_name'                     => FILTER_SANITIZE_STRING,
		'last_name'                      => FILTER_SANITIZE_STRING,
		'company'                        => FILTER_SANITIZE_STRING,
		'search-center'                  => FILTER_SANITIZE_STRING,
		'search-radius'                  => FILTER_SANITIZE_NUMBER_INT,
		'crm-member-search'              => FILTER_SANITIZE_STRING,
		'_wp_http_referer'               => FILTER_SANITIZE_STRING,
		'submit-directory-search'        => FILTER_SANITIZE_STRING,
	);

	/**
	 * The allowed extra query fields and their sprintf mapping for SQL query.
	 *
	 * These should match what we are allowing to search on in the wp_geodata table.
	 * If you add/edit/remove fields from the wp_geodata table that are to be searchable,
	 * update this AND $input_definition.
	 *
	 * The following placeholders can be used in the query string: %d (integer) %f (float) %s (string).
	 *
	 * @link https://developer.wordpress.org/reference/classes/wpdb/prepare/
	 *
	 * @see \CRMN_Member_Search_DB_Tables::install_table()
	 *
	 * @var array $allowed_extra_query_fields
	 */
	public static $allowed_extra_query_fields = array(
		'is_member_of_acr_international' => '%d',
		'is_rule_114_qualified_neutral'  => '%d',
		'ever_had_license_revoked'       => '%d',
		'services_provided'              => '%s',
		'general_adr_matters'            => '%s',
		'detailed_adr_matters'           => '%s',
		'additional_languages_spoken'    => '%s',
		'first_name'                     => '%s',
		'last_name'                      => '%s',
		'company'                        => '%s',
	);

	/**
	 * CRMN_Member_Search_Module constructor.
	 */
	public function __construct() {

		parent::__construct(
			array(
				'name'          => __( 'CRMN Member Search', 'nrd-cbm' ),
				'description'   => __( 'A module for outputting the CRMN Member Search Form and Directory Listing.', 'nrd-cbm' ),
				'category'      => __( 'Advanced Modules', 'nrd-cbm' ),
				'dir'           => CRMN_PLUGIN_MODULES_DIR . 'crmn-member-search-module/',
				'url'           => CRMN_PLUGIN_MODULES_URL . 'crmn-member-search-module/',
				'editor_export' => true,
				'enabled'       => true,
			)
		);
	}

	/**
	 * Register the module and its form settings with Beaver Builder.
	 *
	 * What's implied, but not specifically stated, is that BB handles the instantiation of the object.
	 *
	 * @see \FLBuilderModel::register_module()
	 *
	 * @action init
	 */
	public static function register_module() {

		FLBuilder::register_module(
			'CRMN_Member_Search_Module',
			array(
				'general' => array(
					'title'    => __( 'General', 'fl-builder' ),
					'sections' => array(
						'general' => array(
							'title'  => '',
							'fields' => array(),
						),
					),
				),
			)
		);
	}

	/**
	 * Conditional check to see if member search has been submitted.
	 *
	 * @return bool
	 */
	public static function is_member_search() {

		$submit = filter_input( INPUT_POST, 'submit-directory-search', FILTER_SANITIZE_SPECIAL_CHARS );

		if ( ! empty( $submit ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get the directory search query.
	 *
	 * @return array
	 */
	public function get_directory_search_user_query() {

		if ( ! self::is_member_search() ) {
			return array();
		}

		$crm_member_search = filter_input( INPUT_POST, 'crm-member-search', FILTER_SANITIZE_SPECIAL_CHARS );

		if ( ! wp_verify_nonce( $crm_member_search, 'crm-directory-search' ) ) {
			return array();
		}

		/**
		 * Sanitized version of $_POST.
		 *
		 * An array containing the values of the requested variables on success,
		 * or FALSE on failure.
		 * An array value will be FALSE if the filter fails,
		 * or NULL if the variable is not set.
		 * Or if the flag FILTER_NULL_ON_FAILURE is used,
		 * it returns FALSE if the variable is not set and NULL if the filter fails.
		 *
		 * @var array $post_input
		 */
		$post_input = filter_input_array( INPUT_POST, self::$input_definition, true );

		if ( empty( $post_input ) || ! is_array( $post_input ) ) {
			return array();
		}

		if ( empty( $post_input['search-center'] ) ) {
			$post_input['search-center'] = 'Minnesota';
		}

		if ( empty( $post_input['search-radius'] ) ) {
			$post_input['search-radius'] = 200;
		}

		return $post_input;
	}

	/**
	 * Get the radius of the Earth for use in distance calculations.
	 *
	 * @param string $unit Optional. Defaults to 'mi' for miles. Valid values are 'mi' or 'km'.
	 *
	 * @return int|float The "mean" radius of the Earth on success, else 0 on failure.
	 */
	public static function get_earth_radius( $unit = 'mi' ) {

		/**
		 * Array of units of measurement and their corresponding mean radius of the Earth measurements.
		 *
		 * @note: The Earth is not perfectly spherical, but this is considered the 'mean radius'.
		 *
		 * @var array $units
		 */
		$units = array(
			'mi' => 3958.761,
			'km' => 6371.009,
		);

		if ( ! array_key_exists( $unit, $units ) ) {
			return 0;
		}

		return $units[ $unit ];
	}

	/**
	 * Get the search boundary coordinates for a lat/lng distance (pseudo-radius) search.
	 *
	 * @link http://www.bobz.co/display-posts-google-map-radius-latitude-longitude-acf/
	 * @Link http://stackoverflow.com/questions/12424710/php-finding-latitude-and-longitude-boundaries-based-on-a-central-lat-lng-and-di
	 *
	 * @param float  $lat      The center latitude coordinate.
	 * @param float  $lng      The center longitude coordinate.
	 * @param int    $distance Distance from center coordinates. Optional, defaults to "5".
	 * @param string $unit     Distance unit of measurement. Accetped values, 'km', 'mi. Optional. Defaults to 'mi'.
	 *
	 * @return array
	 */
	public static function get_lat_lng_boundaries( $lat, $lng, $distance = 5, $unit = 'mi' ) {

		/**
		 * Radius of the Earth.
		 *
		 * @var int|float $radius
		 */
		$radius = self::get_earth_radius( $unit );

		if ( empty( $radius ) ) {
			return array();
		}

		/**
		 * Maximum latitude boundary.
		 *
		 * @var float $max_lat
		 */
		$max_lat = (float) $lat + rad2deg( $distance / $radius );

		/**
		 * Minimum latitude boundary.
		 *
		 * @var float $min_lat
		 */
		$min_lat = (float) $lat - rad2deg( $distance / $radius );

		/**
		 * Maximum longitude boundary (longitude gets smaller when latitude increases).
		 *
		 * @var float $max_lng
		 */
		$max_lng = (float) $lng + rad2deg( $distance / $radius ) / cos( deg2rad( (float) $lat ) );

		/**
		 * Minimum longitude boundary (longitude gets smaller when latitude increases).
		 *
		 * @var float $min_lng
		 */
		$min_lng = (float) $lng - rad2deg( $distance / $radius ) / cos( deg2rad( (float) $lat ) );

		/**
		 * The coordinates for the boundaries of the distance search.
		 */
		return array(
			'max_latitude'  => $max_lat,
			'min_latitude'  => $min_lat,
			'max_longitude' => $max_lng,
			'min_longitude' => $min_lng,
		);
	}

	/**
	 * Search by distance for posts that have lat/lng data in the geodata table.
	 *
	 * Uses the "haversine formula" to calculate the distance between two lat/lng points on a sphere.
	 * Since the Earth is not a perfect sphere, there is a small margin of error,
	 * but this formula is still used widely for general navigation.
	 *
	 * @param float  $search_lat The latitudinal coordinate for center of radius search.
	 * @param float  $search_lng The longitudinal coordinate for center of radius search.
	 * @param int    $distance The numeric distance of the radius to search within. Optional, defaults to 5.
	 * @param string $unit The distance unit, "mi" or "km". Optional, defaults to "mi".
	 * @param array  $extra_query The additional query data to search.
	 *
	 * @return stdClass[]|array An array of stdClass database row objects on success.
	 */
	public static function get_geodata_radius_search( $search_lat, $search_lng, $distance = 5, $unit = 'mi', $extra_query = array() ) {

		/**
		 * Radius of the Earth.
		 *
		 * @var int|float $radius
		 */
		$radius = self::get_earth_radius( $unit );

		if ( empty( $radius ) ) {
			return array();
		}

		/**
		 * The global wpdb WordPress Database abstraction object.
		 *
		 * @global wpdb $wpdb
		 */
		global $wpdb;

		$where_clause = self::get_where_clause( $extra_query );

		// @codingStandardsIgnoreStart

		/**
		 * Technically this breaks WPCS due to the use of *seemingly unescaped* {$where_clause}.
		 * HOWEVER, we do actually follow best practice by escaping where we construct that clause.
		 * Be absolutely certain that you're not opening this up to attack if you modify it.
		 *
		 * We use IFNULL so that a distance of 0 is legit.
		 */
		$results = $wpdb->get_results(
			$wpdb->prepare(
				"
				SELECT *,
				IFNULL(
					%f * acos(
						cos( radians( %f ) )
						* cos( radians( `geo_latitude` ) )
						* cos( radians( `geo_longitude` ) - radians( %f ) )
						+ sin( radians( %f ) )
						* sin( radians( `geo_latitude` ) )
					), 0
				)
				AS distance
				FROM $wpdb->geodata
				{$where_clause}
				HAVING distance <= %d
				ORDER BY distance ASC;
				",
				$radius,
				$search_lat,
				$search_lng,
				$search_lat,
				$distance
			)
		);

		// @codingStandardsIgnoreEnd

		return $results;
	}

	/**
	 * Construct the WHERE clause for our MySQL query.
	 *
	 * @param array $extra_query
	 *
	 * @return string
	 */
	public static function get_where_clause( $extra_query = array() ) {

		/**
		 * The global wpdb WordPress Database abstraction object.
		 *
		 * @global wpdb $wpdb
		 */
		global $wpdb;

		/**
		 * @var string $where_clause
		 */
		$where_clause = '';

		if ( empty( $extra_query ) ) {
			return $where_clause;
		}

		$allowed = self::$allowed_extra_query_fields;

		foreach ( $extra_query as $key => $value ) {

			if ( ! empty( $value ) && array_key_exists( $key, $allowed ) ) {

				/**
				 * The following placeholders can be used in the query string: %d (integer) %f (float) %s (string).
				 *
				 * @link https://developer.wordpress.org/reference/classes/wpdb/prepare/
				 */
				switch ( $allowed[ $key ] ) {
					case '%d':
						// @codingStandardsIgnoreStart
						$where_clause .= $wpdb->prepare( " AND {$key} = %d", $value );
						// @codingStandardsIgnoreEnd
						break;
					case '%f':
						// @codingStandardsIgnoreStart
						$where_clause .= $wpdb->prepare( " AND {$key} = %f", $value );
						// @codingStandardsIgnoreEnd
						break;
					case '%s':
						// Double % is needed because we wpdb::prepare later on
						// and it attempts to replace %'s this will have unexpected
						// results/behavior
						// @codingStandardsIgnoreStart
						$like = '%%' . $wpdb->esc_like( $value ) . '%%';
						$where_clause .= $wpdb->prepare( " AND {$key} LIKE %s", $like );
						// @codingStandardsIgnoreEnd
						break;
				}
			}
		}

		return 'WHERE opt_out_public_search = 0 ' . $where_clause;
	}

	/**
	 * Set the extra search query vars.
	 */
	public function set_extra_query() {

		/**
		 * There is not search.
		 */
		if ( empty( $this->directory_search_user_query ) ) {
			return;
		}

		/**
		 * Only set those that are allowed.
		 */
		foreach ( $this->directory_search_user_query as $query_field => $query_value ) {
			if ( ! empty( $query_value ) && array_key_exists( $query_field, self::$allowed_extra_query_fields ) ) {
				$extra[ $query_field ] = $query_value;
			}
		}

		if ( ! empty( $extra ) ) {
			$this->extra_query = $extra;
		}
	}

	/**
	 * Get the extra search query vars.
	 */
	public function get_extra_query() {
		return $this->extra_query;
	}
}
