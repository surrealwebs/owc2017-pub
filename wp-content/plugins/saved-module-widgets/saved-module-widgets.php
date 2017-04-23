<?php
/**
 * Saved Module Widgets plugin file.
 *
 * @author           The Nerdery
 * @link             http://nerdery.com
 * @version          1.0.0
 * @since            1.0.0
 * @category         Plugins
 * @package          Saved_Module_Widgets
 *
 * @wordpress-plugin
 * Plugin Name:      Saved Module Widgets
 * Plugin URI:       http://nerdery.com
 * Description:      Use saved page builder modules as sidebar widgets.
 * Version:          1.0.0
 * Author:           The Nerdery
 * Author URI:       https://nerdery.com
 * Text Domain:      saved-module-widgets
 * Domain Path:      /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Saved_Module_Widget widget.
 *
 * @uses   register_widget, Saved_Module_Widget
 *
 * @action widgets_init
 */
function smw_widgets_init() {

	/**
	 * If there is no Beaver Builder return early.
	 */
	if ( ! class_exists( 'FLBuilderModel' ) ) {
		return;
	}

	/**
	 * Load Saved_Module_Widget widget class file.
	 */
	require dirname( __FILE__ ) . '/widgets/class-saved-module-widgets.php';

	register_widget( 'Saved_Module_Widget' );
}

add_action( 'widgets_init', 'smw_widgets_init' );
