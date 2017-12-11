<?php
/**
 * Geocoding methods.
 *
 * @package    CRMN_Member_Search
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_Geocoder
 *
 * This is intended for use as a standalone interface to Google Maps API geocoding with transient caching.
 */
class CRMN_Member_Search_Geocoder {

	/**
	 * @var  string
	 */
	public $api_key;

	/**
	 * @var  array
	 */
	public $address;

	/**
	 * @var  string
	 */
	public $address_string;

	/**
	 * @var  string
	 */
	public $urlencoded_address_string;

	/**
	 * @var  string
	 */
	public $transient_name;

	/**
	 * @var  string
	 */
	public $hash;

	/**
	 * @var string
	 */
	public $geocode_transient;

	/**
	 * Time until transient expiration, in seconds from now, or 0 for never expires.
	 *
	 * Setting to WEEK_IN_SECONDS for production.
	 * Theoreticaly lat/lng coords don't change for addresses, or at least not frequently.
	 *
	 * @var int
	 */
	public $transient_expiration = WEEK_IN_SECONDS;

	/**
	 * @var WP_Error|array
	 */
	public $response;

	/**
	 * @var string
	 */
	public $formatted_address;

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
	public function __construct() {
		$this->api_key = get_option( 'google_api_key', '' );
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
	public function geocode_address( $address = '' ) {

		/**
		 * Remove line breaks / carriage returns / multiple consecutive spaces, from address string.
		 *
		 * @var string $address
		 */
		if ( is_string( $address ) ) {
			$this->address_string = trim( preg_replace( '/\s+/', ' ', $address ) );
		} elseif ( is_array( $address ) ) {
			$this->address_string = trim( preg_replace( '/\s+/', ' ', implode( ' ', $address ) ) );
		}

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
}
