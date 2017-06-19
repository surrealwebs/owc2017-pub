<?php
/**
 * Google Maps API Key / Client ID plugin file.
 *
 * Adds inputs to the Settings → General Settings screen for specifying Google Maps API Key / Client ID.
 * As of this writing, ACF Pro V 5.5.3 still offers no UI/settings screen for inputting Google API Key or Client ID,
 * and still requires a coded solution to enable the use of API Key or Client ID.
 *
 * @package           Google_Maps_Key
 *
 * @wordpress-plugin
 * Plugin Name:       Google Maps API Key
 * Plugin URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * Description:       Adds inputs to the Settings → General Settings screen for specifying Google Maps API Key / Client ID for use with ACF Pro 5.
 * Version:           1.0.0
 * Author:            BaconPress
 * Author URI:        http://tc2017.overnightwebsitechallenge.com/teams/233
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gmapapikey
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Make the API Key / Client ID available to ACF.
 *
 * As of this writing, ACF Pro V 5.5.3 still has no UI/settings screen for inputting Google API Key or Client ID, and
 * still requires a coded solution to enable the use of API Key or Client ID.
 *
 * @filter acf/fields/google_map/api
 *
 * @param array $api
 *
 * @return array
 */
function gmapapi_acf_google_map_api( $api ) {

	/**
	 * The API Key or Client ID for ACF has been set elsewhere, so just return early.
	 */
	if ( ! empty( $api['key'] ) || ! empty( $api['client'] ) ) {
		return $api;
	}

	/**
	 * @var string|false $google_api_key
	 */
	$google_api_key = get_option( 'google_api_key' );

	/**
	 * @var string|false $google_api_client
	 */
	$google_api_client = get_option( 'google_api_client' );

	if ( ! empty( $google_api_key ) ) {
		$api['key'] = $google_api_key;
	}

	if ( ! empty( $google_api_client ) ) {
		$api['client'] = $google_api_client;
	}

	return $api;
}

add_filter( 'acf/fields/google_map/api', 'gmapapi_acf_google_map_api' );

/**
 * Add settings fields for the API Key / Client ID to the General Settings screen.
 *
 * @uses   register_setting, add_settings_field, gmapapi_key_field
 *
 * @action admin_init
 */
function gmapapi_init() {

	register_setting( 'general', 'google_api_key', 'esc_attr' );

	add_settings_field(
		'google_api_key',
		__( 'Google Maps API Key', 'gmapapikey' ),
		'gmapapi_key_field',
		'general',
		'default',
		array(
			'label_for' => 'google_api_key',
			'class'     => 'nrdgmapapi-key',
		)
	);

	register_setting( 'general', 'google_api_client', 'esc_attr' );

	add_settings_field(
		'google_api_client',
		__( 'Google Maps API Client', 'gmapapikey' ),
		'gmapapi_client_field',
		'general',
		'default',
		array(
			'label_for' => 'google_api_client',
			'class'     => 'nrdgmapapi-client',
		)
	);
}

add_action( 'admin_init', 'gmapapi_init' );

/**
 * Print the API Key field for the general settings form.
 */
function gmapapi_key_field() {

	$value = get_option( 'google_api_key', '' );

	$url = 'https://developers.google.com/maps/documentation/javascript/get-api-key';

	$description = sprintf(
		wp_kses(
			__(
				'Specify a Google Maps API Authentication Key. Not needed if using a Client ID. Defaults to empty string. Refer to <a href="%s" target="_blank">Google&rsquo;s Map API documentation</a> to learn more.',
				'gmapapikey'
			),
			array( 'a' => array( 'href' => array(), 'target' => array() ) )
		),
		esc_url( $url )
	);

	?>

	<input type="text"
		   aria-describedby="google-api-key-description"
		   id="google_api_key"
		   name="google_api_key"
		   value="<?php echo esc_attr( $value ); ?>"
		   class="regular-text" />

	<p class="description" id="google-api-key-description">
		<?php echo $description; // WPCS: XSS ok. ?>
	</p>

	<?php
}

/**
 * Print the Client ID field for the general settings form.
 */
function gmapapi_client_field() {

	$value = get_option( 'google_api_client', '' );

	$url = 'https://developers.google.com/maps/documentation/javascript/get-api-key';

	$description = sprintf(
		wp_kses(
			__(
				'Specify a Google Maps API Client ID. Not needed if using an authentication key. Defaults to empty string. Refer to <a href="%s" target="_blank">Google&rsquo;s Map API documentation</a> to learn more.',
				'gmapapikey'
			),
			array( 'a' => array( 'href' => array(), 'target' => array() ) )
		),
		esc_url( $url )
	);

	?>

	<input type="text"
		   aria-describedby="google-api-client-description"
		   id="google_api_client"
		   name="google_api_client"
		   class="regular-text"
		   value="<?php echo esc_attr( $value ); ?>"/>

	<p class="description" id="google-api-client-description">
		<?php echo $description; // WPCS: XSS ok. ?>
	</p>

	<?php
}
