<?php
/**
 * CRMN_Member_Search_Google_Maps_API_Key class file.
 *
 * @package    CRMN_Member_Search
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CRMN_Member_Search_Google_Maps_API_Key
 */
class CRMN_Member_Search_Google_Maps_API_Key {

	/**
	 * Add settings fields for the API Key / Client ID to the General Settings screen.
	 *
	 * @uses   register_setting, add_settings_field, gmapapi_key_field
	 *
	 * @action admin_init
	 */
	public function admin_init() {

		register_setting( 'general', 'google_api_key', 'esc_attr' );

		add_settings_field(
			'google_api_key',
			__( 'Google Maps API Key', 'crmn-member-search' ),
			array( $this, 'google_api_key_field' ),
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
			__( 'Google Maps API Client', 'crmn-member-search' ),
			array( $this, 'google_client_key_field' ),
			'general',
			'default',
			array(
				'label_for' => 'google_api_client',
				'class'     => 'nrdgmapapi-client',
			)
		);
	}

	/**
	 * Print the API Key field for the general settings form.
	 */
	public function google_api_key_field() {

		$value = get_option( 'google_api_key', '' );

		$url = 'https://developers.google.com/maps/documentation/javascript/get-api-key';

		$description = sprintf(
			/* translators: placeholder is the URL to Google Maps API Key documentation. */
			__(
				'Specify a Google Maps API Authentication Key. Not needed if using a Client ID. Defaults to empty string. Refer to <a href="%s" target="_blank">Google&rsquo;s Map API documentation</a> to learn more.',
				'crmn-member-search'
			),
			esc_url( $url )
		);

		?>

		<input type="text"
			   aria-describedby="google-api-key-description"
			   id="google_api_key"
			   name="google_api_key"
			   value="<?php echo esc_attr( $value ); ?>"
			   class="regular-text"/>

		<p class="description" id="google-api-key-description">
			<?php
			echo wp_kses(
				$description,
				array(
					'a' => array(
						'href'   => array(),
						'target' => array(),
					),
				)
			);
			?>
		</p>

		<?php
	}

	/**
	 * Print the Client ID field for the general settings form.
	 */
	public function google_client_key_field() {

		$value = get_option( 'google_api_client', '' );

		$url = 'https://developers.google.com/maps/documentation/javascript/get-api-key';

		$description = sprintf(
			/* translators: placeholder is the URL to Google Maps API Key documentation. */
			__(
				'Specify a Google Maps API Client ID. Not needed if using an authentication key. Defaults to empty string. Refer to <a href="%s" target="_blank">Google&rsquo;s Map API documentation</a> to learn more.',
				'crmn-member-search'
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
			<?php
			echo wp_kses(
				$description,
				array(
					'a' => array(
						'href'   => array(),
						'target' => array(),
					),
				)
			);
			?>
		</p>

		<?php
	}
}
