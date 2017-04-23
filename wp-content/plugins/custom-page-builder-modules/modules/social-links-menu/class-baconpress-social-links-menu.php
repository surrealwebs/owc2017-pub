<?php
/**
 * BaconPress_Social_Links_Menu class file.
 *
 * This module is for outputting a social links menu.
 *
 * Follow WordPress coding standards and conventions as closely as possible, and Beaver Builder module conventions.
 *
 * @link https://www.wpbeaverbuilder.com/custom-module-documentation/
 * @link https://make.wordpress.org/core/handbook/best-practices/coding-standards/
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class BaconPress_Social_Links_Menu
 */
class BaconPress_Social_Links_Menu extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => esc_html__( 'Social Links Menu', 'owcbpcpb' ),
				'description'     => esc_html__( 'Renders a social links menu.', 'owcbpcpb' ),
				'category'        => esc_html__( 'Advanced Modules', 'owcbpcpb' ),
				'partial_refresh' => true,
			)
		);
	}

	/**
	 * Get social links from Beaver Builder theme mods.
	 *
	 * @return array
	 */
	public static function get_social_links() {

		$social_links = array();

		$settings = FLTheme::get_settings();

		if ( empty( $settings ) ) {
			return $social_links;
		}

		$prefix = 'fl-social-';

		foreach ( $settings as $key => $value ) {

			if ( empty( $value ) || ! is_string( $value ) || 0 !== strpos( $key, $prefix ) ) {
				continue;
			}

			$key = substr( $key, strlen( $prefix ) );

			$social_links[ $key ] = $value;
		}

		return $social_links;
	}

	/**
	 * Get the markup for the social links frontend.
	 *
	 * @return string
	 */
	public static function get_social_links_markup( $settings ) {

		$markup = '';

		$icons_color = 'mono';

		$circle = true;

		$social_links = BaconPress_Social_Links_Menu::get_social_links();

		if ( $social_links['icons-color'] ) {
			$icons_color = $social_links['icons-color'];
			unset( $social_links['icons-color'] );
		}

		if ( $settings->round_icons ) {
			$circle = 'false' === $settings->round_icons ? false : true;
		}

		if ( empty( $social_links ) ) {
			return $markup;
		}

		foreach ( $social_links as $key => $value ) {

			$link_target = ' target="_blank"';

			if ( 'email' === $key ) {
				$value       = 'mailto:' . $value;
				$link_target = '';
			}

			$class = 'fl-icon fl-icon-color-' . $icons_color . ' fl-icon-' . $key . ' fl-icon-' . $key;
			$class .= $circle ? '-circle' : '-regular';
			$markup .= '<a href="' . $value . '"' . $link_target . ' class="' . $class . '"></a>';
		}

		$markup = '<div class="fl-social-icons">' . $markup;

		$markup .= '</div>';

		return $markup;
	}

	/**
	 * Print the markup for the social links frontend.
	 */
	public static function the_social_links_markup( $settings ) {
		echo BaconPress_Social_Links_Menu::get_social_links_markup( $settings ); // WPCS: XSS ok.
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'BaconPress_Social_Links_Menu',
	array(
		'general' => array( // Tab
			'title'    => __( 'General', 'owcbpcpb' ), // Tab title
			'sections' => array( // Tab Sections
				'general' => array( // Section
					'title'  => '', // Section Title
					'fields' => array( // Section Fields
						'round_icons' => array(
							'type'    => 'select',
							'label'   => __( 'Use Round (Circle) Icons?', 'fl-builder' ),
							'default' => 'true',
							'options' => array(
								'true'  => __( 'Yes', 'fl-builder' ),
								'false' => __( 'No', 'fl-builder' ),
							),
						),
					),
				),
			),
		),
	)
);
