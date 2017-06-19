<?php
/**
 * Geocoding methods.
 *
 * @package    Member_Search
 * @subpackage Member_Search/includes
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The geocoding functionality of the plugin.
 *
 * @package    Member_Search
 * @subpackage Member_Search/includes
 */
class Member_Search_Geocoder {

	/**
	 * @var int
	 */
	private $user_id;

	/**
	 * @var string
	 */
	private $load_address;

	/**
	 * @var  string
	 */
	private $api_key;

	/**
	 * @var  array
	 */
	private $address;

	/**
	 * @var  string
	 */
	private $address_string;

	/**
	 * @var  string
	 */
	private $urlencoded_address_string;

	/**
	 * @var  string
	 */
	private $transient_name;

	/**
	 * @var  string
	 */
	private $hash;

	/**
	 * @var string
	 */
	private $geocode_transient;

	/**
	 * @var int
	 */
	private $transient_expiration = MONTH_IN_SECONDS;

	/**
	 * @var  array
	 */
	private $geodata;

	/**
	 * @var WP_Error|array
	 */
	private $response;

	/**
	 * @var array
	 */
	private $address_keys;

	/**
	 * @var string
	 */
	private $formatted_address;

	/**
	 * @var string
	 */
	public $api_endpoint = 'https://maps.googleapis.com/maps/api/geocode/json';

	/**
	 * Member_Search_Geocoder constructor.
	 *
	 * @param int    $user_id
	 * @param string $load_address
	 */
	public function __construct( $user_id = 0, $load_address = 'billing' ) {

		$this->user_id = $user_id;

		if ( empty( $this->user_id ) ) {
			return;
		}

		$this->load_address = $load_address;

		if ( empty( $this->load_address ) ) {
			$this->load_address = 'billing';
		}

		$this->geocode_run();
	}

	/**
	 * Run geocoding for a user.
	 */
	public function geocode_run() {

		$this->api_key = get_option( 'google_api_key' );

		if ( empty( $this->api_key ) ) {
			return;
		}

		$this->address = $this->get_address();

		if ( empty( $this->address ) ) {
			return;
		}

		$this->geodata = $this->geocode_address();

		if ( empty( $this->geodata ) ) {
			return;
		}

		$this->update_user_meta();

		$this->update_user_geotable();
	}

	/**
	 * Update the user meta with the geodata.
	 */
	public function update_user_meta() {
		foreach ( $this->geodata as $geo_key => $geo_value ) {
			update_user_meta( $this->user_id, $geo_key, $geo_value );
		}
	}

	/**
	 * Determine if we need to insert a row of geodata, or update a row of geodata, in the custom table.
	 */
	public function update_user_geotable() {
		if ( ! $this->geocoded_user_exists() ) {
			$this->insert_geocoded_user_record();
		} else {
			$this->update_geocoded_user_record();
		}
	}

	/**
	 * Insert the geocode data into the custom search table.
	 *
	 * The inserted data looks something like this in the database:
	 * +--------+---------------+--------------+---------------+-----------------+------------+---------------------+
	 * | geo_id | geo_object_id | geo_latitude | geo_longitude | geo_object_type | geo_public | geo_address         |
	 * +--------+---------------+--------------+---------------+-----------------+------------+---------------------+
	 * |      1 |             2 |    44.830853 |    -93.299872 | WP_User         |          1 | 9555 James Ave S... |
	 * +--------+---------------+--------------+---------------+-----------------+------------+---------------------+
	 */
	public function insert_geocoded_user_record() {

		global $wpdb;

		$wpdb->insert(
			$wpdb->geodata,
			array(
				'geo_object_id'   => $this->user_id,
				'geo_latitude'    => $this->geodata['geo_latitude'],
				'geo_longitude'   => $this->geodata['geo_longitude'],
				'geo_object_type' => 'WP_User',
				'geo_public'      => $this->geodata['geo_public'],
				'geo_address'     => $this->geodata['geo_address'],
			),
			array(
				'%d',
				'%F',
				'%F',
				'%s',
				'%d',
				'%s',
			)
		);
	}


	/**
	 * Update the existing geocode data in the custom search table.
	 *
	 * The inserted data looks something like this in the database:
	 * +--------+---------------+--------------+---------------+-----------------+------------+---------------------+
	 * | geo_id | geo_object_id | geo_latitude | geo_longitude | geo_object_type | geo_public | geo_address         |
	 * +--------+---------------+--------------+---------------+-----------------+------------+---------------------+
	 * |      1 |             2 |    44.830853 |    -93.299872 | WP_User         |          1 | 9555 James Ave S... |
	 * +--------+---------------+--------------+---------------+-----------------+------------+---------------------+
	 */
	public function update_geocoded_user_record() {

		global $wpdb;

		$wpdb->update(
			$wpdb->geodata,
			array(
				'geo_latitude'    => $this->geodata['geo_latitude'],
				'geo_longitude'   => $this->geodata['geo_longitude'],
				'geo_public'      => $this->geodata['geo_public'],
				'geo_address'     => $this->geodata['geo_address'],
			),
			array(
				'geo_object_id'   => $this->user_id,
				'geo_object_type' => 'WP_User',
			),
			array(
				'%F',
				'%F',
				'%d',
				'%s',
			),
			array(
				'%d',
				'%s',
			)
		);
	}

	/**
	 * Conditional check to determine if user already has geocode data in the custom table.
	 *
	 * @return bool
	 */
	public function geocoded_user_exists() {

		global $wpdb;

		$exists = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT geo_id
				FROM {$wpdb->geodata}
				WHERE geo_object_id = %d
				AND geo_object_type = %s
				",
				$this->user_id,
				'WP_User'
			)
		);

		if ( null === $exists ) {
			return false;
		}

		return true;
	}

	/**
	 * Geocode an address.
	 *
	 * This relies on Google's geocoding API, therefore we need to be aware of rate limits, and cache results.
	 *
	 * @link https://developers.google.com/maps/documentation/geocoding/usage-limits Usage Limits doc
	 * @link https://developers.google.com/maps/documentation/geocoding/intro#geocoding Intro to geocoding doc
	 * @link https://developers.google.com/maps/faq#geocoder_queryformat Geocoder Query Format doc
	 */
	public function geocode_address() {

		/**
		 * Remove line breaks / carriage returns from address string.
		 *
		 * @var string $address
		 */
		$this->address_string = trim( preg_replace( '/\s+/', ' ', implode( ' ', $this->address ) ) );

		/**
		 * Create a 32 character hash of the address string.
		 */
		$this->hash = md5( $this->address_string );

		/**
		 * The name for our transient.
		 *
		 * This would be something like owc_620c5a16697a3bf8940b62f734188b38 in code, and
		 * _transient_owc_620c5a16697a3bf8940b62f734188b38 in the options table.
		 * Notes from the Codex: this should be 45 characters or less in length.
		 * If using a site transient, it should be 40 characters or less in length.
		 *
		 * @var string $transient_name
		 */
		$this->transient_name = 'owc_' . $this->hash;

		/**
		 * If the transient exists, will return the option value, if not, will return false.
		 *
		 * @var string|false $geocode_transient
		 */
		$this->geocode_transient = get_transient( $this->transient_name );

		if ( false !== $this->geocode_transient ) {
			return $this->get_geodata_from_json_response( $this->geocode_transient );
		}

		/**
		 * URL Encoded version of address string.
		 *
		 * Should look something like 4940+W.+35th+Street+St.+Louis+Park,+MN+55416
		 *
		 * @var string $encoded_address_string
		 */
		$this->urlencoded_address_string = rawurlencode( $this->address_string );

		/**
		 * Add the query arguments to the API endpoint.
		 *
		 * @var string $api_endpoint
		 */
		$endpoint = add_query_arg(
			array(
				'address' => $this->urlencoded_address_string,
				'key'     => $this->api_key,
			),
			$this->api_endpoint
		);

		/**
		 * Array of return data from API, else WP_Error object on failure.
		 *
		 * @var WP_Error|array $response
		 */
		$this->response = wp_remote_get( $endpoint );

		/** API Lookup failed for some reason */
		if ( is_wp_error( $this->response ) ) {
			return array();
		}

		/**
		 * Time until transient expiration, in seconds from now, or 0 for never expires.
		 *
		 * Setting to 0 for production.
		 * Theoreticaly lat/lng coords don't change for addresses.
		 *
		 * @var int $expiration
		 */
		$this->transient_expiration = MONTH_IN_SECONDS;

		$geodata = $this->get_geodata_from_json_response( $this->response );

		if ( ! empty( $geodata ) && is_array( $geodata ) ) {
			/** Transient cache results of Geocoding API lookup */
			set_transient( $this->transient_name, $this->response, $this->transient_expiration );
		}

		return $geodata;
	}

	/**
	 * Get the geodata out of a Google Maps response.
	 *
	 * This response should be in the format that you would receive if you performed a wp_remote_get to the
	 * Google Maps endpoint. Refer to Google documentation regarding the response format, and status codes.
	 * Note that this is used for both the wp_remote_get response, and transient store of same response.
	 *
	 * @link https://developers.google.com/maps/documentation/geocoding/intro#GeocodingResponses
	 * @link https://developers.google.com/maps/documentation/geocoding/intro#StatusCodes
	 *
	 * @return array
	 */
	public function get_geodata_from_json_response( $response ) {

		$return_data = array();

		/**
		 * JSON decoded stdClass object.
		 *
		 * @var stdClass $decoded_body
		 */
		$decoded_body = json_decode( $response['body'] );

		if ( ! $decoded_body instanceof stdClass ) {
			return $return_data;
		}

		if ( 'OK' !== $decoded_body->status ) {
			return $return_data;
		}

		if ( ! is_array( $decoded_body->results ) ) {
			return $return_data;
		}

		/**
		 * A stdClass object containing geocoding results.
		 *
		 * @var stdClass $results
		 */
		$results = $decoded_body->results[0];

		if ( ! $results instanceof stdClass ) {
			return $return_data;
		}

		/**
		 * The formatted address returned by Google.
		 *
		 * @var string $formatted_address
		 */
		$this->formatted_address = $results->formatted_address;

		/**
		 * A stdClass object of the geometry, including lat and lng.
		 *
		 * @var stdClass $geometry
		 */
		$geometry = $results->geometry;

		if ( ! $geometry instanceof stdClass ) {
			return $return_data;
		}

		/**
		 * A stdClass object of the location, including lat and lng.
		 *
		 * @var stdClass $location
		 */
		$location = $geometry->location;

		if ( ! $location instanceof stdClass ) {
			return $return_data;
		}

		return array(
			'geo_address'   => $this->formatted_address,
			'geo_latitude'  => $location->lat,
			'geo_longitude' => $location->lng,
			'geo_public'    => 1,
		);
	}

	/**
	 * Get the address for geocoding by user ID.
	 *
	 * This assumes that we are using Woo billing address.
	 *
	 * @return array
	 */
	public function get_address() {

		$meta_values = array();

		if ( empty( $this->user_id ) ) {
			return $meta_values;
		}

		$this->address_keys = array(
			'address_1',
			'address_2',
			'city',
			'state',
			'postcode',
			'country',
		);

		foreach ( $this->address_keys as $meta_key ) {
			$meta_values[ $meta_key ] = get_user_meta( $this->user_id, $this->load_address . '_' . $meta_key, true );
		}

		return $meta_values;
	}
}
