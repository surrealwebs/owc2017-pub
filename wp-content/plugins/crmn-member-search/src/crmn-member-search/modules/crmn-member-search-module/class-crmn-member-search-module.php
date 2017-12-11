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
	public static function get_directory_search_user_query() {

		if ( ! self::is_member_search() ) {
			return array();
		}

		$crm_member_search       = filter_input( INPUT_POST, 'crm-member-search', FILTER_SANITIZE_SPECIAL_CHARS );

		if ( ! wp_verify_nonce( $crm_member_search, 'crm-directory-search' ) ) {
			return array();
		}

		/**
		 * Definition for the array mapping to be used by filter_input_array.
		 *
		 * $_POST could contain something like the following...
		 * Array (
		 *     'first-name'              => 'Richard'
		 *     'last-name'               => 'Aber'
		 *     'company'                 => 'Nerdery'
		 *     'services-provided'       => 'mediation'
		 *     'areas-of-expertise'      => 'training'
		 *     'additional-languages'    => 'chinese'
		 *     'search-center'           => '55431'
		 *     'search-radius'           => '5'
		 *     'crm-member-search'       => 'e88cef0fa3'
		 *     '_wp_http_referer'        => '/'
		 *     'submit-directory-search' => 'Directory Search'
		 * )
		 *
		 * @var array $definition
		 */
		$definition = array(
			'first-name'              => FILTER_SANITIZE_STRING,
			'last-name'               => FILTER_SANITIZE_STRING,
			'company'                 => FILTER_SANITIZE_STRING,
			'services-provided'       => FILTER_SANITIZE_STRING,
			'areas-of-expertise'      => FILTER_SANITIZE_STRING,
			'additional-languages'    => FILTER_SANITIZE_STRING,
			'search-center'           => FILTER_SANITIZE_STRING,
			'search-radius'           => FILTER_SANITIZE_NUMBER_INT,
			'crm-member-search'       => FILTER_SANITIZE_STRING,
			'_wp_http_referer'        => FILTER_SANITIZE_STRING,
			'submit-directory-search' => FILTER_SANITIZE_STRING,
		);

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
		$post_input = filter_input_array( INPUT_POST, $definition, true );

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
	 *
	 * @return stdClass[]|array An array of stdClass database row objects on success.
	 */
	public static function get_geodata_radius_search( $search_lat, $search_lng, $distance = 5, $unit = 'mi' ) {

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

		/**
		 * IFNULL so that a distance of 0 is legit.
		 */
		return $wpdb->get_results(
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
				HAVING distance <= %d
				ORDER BY distance;
				",
				$radius,
				$search_lat,
				$search_lng,
				$search_lat,
				$distance
			)
		);
	}
}
