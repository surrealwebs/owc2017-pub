<?php
/**
 * Geocoding methods for the WP_User objects.
 *
 * @package    CRMN_Member_Search
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_WP_User_Geocoder
 *
 * This is intended for use as an interface between WP_User obejcts and the Google Maps API geocoding with transient caching.
 */
class CRMN_Member_Search_WP_User_Geocoder extends CRMN_Member_Search_Geocoder {

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @var string
	 */
	protected $load_address;

	/**
	 * @var  array
	 */
	protected $geodata;

	/**
	 * @var array
	 */
	protected $address_keys;

	/**
	 * CRMN_Member_Search_WP_User_Geocoder constructor.
	 *
	 * @param int    $user_id
	 * @param string $load_address
	 */
	public function __construct( $user_id = 0, $load_address = 'billing' ) {

		parent::__construct();

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
