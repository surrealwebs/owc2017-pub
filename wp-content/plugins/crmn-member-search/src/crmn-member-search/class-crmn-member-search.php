<?php
/**
 * CRMN_Member_Search class file.
 *
 * The primary plugin class.
 * \CRMN_Member_Search::load, kicks off hooked functions/methods.
 *
 * @package CRMN_Member_Search
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class CRMN_Member_Search
 *
 * The "main" plugin class, instantiated in the plugin bootstrap.
 */
class CRMN_Member_Search {

	/**
	 * Track if the plugin is "loaded".
	 *
	 * @var bool
	 */
	protected $loaded = false;

	/**
	 * The hook loader that's responsible for maintaining and registering all hooks that power the plugin.
	 *
	 * @var \CRMN_Member_Search $hook_loader Maintains and registers all hooks for the plugin.
	 */
	protected $hook_loader;

	/**
	 * CRMN_Member_Search constructor.
	 */
	public function __construct() {
		$this->loaded = false;
	}

	/**
	 * Check if the plugin is loaded.
	 *
	 * @return bool
	 */
	public function is_loaded() {
		return $this->loaded;
	}

	/**
	 * Loads the plugin into WordPress.
	 */
	public function load() {

		/**
		 * We've already loaded.
		 */
		if ( $this->is_loaded() ) {
			return;
		}

		/**
		 * @var \CRMN_Member_Search_Hook_Loader hook_loader
		 */
		$this->hook_loader = new CRMN_Member_Search_Hook_Loader();

		/**
		 * Register non-privileged hooks with our loader.
		 */
		$this->add_public_hooks();

		/**
		 * Register privileged/WP-Admin hooks with our loader.
		 */
		$this->add_admin_hooks();

		/**
		 * Run our loader, which registers the hooks that it knows about with WordPress.
		 */
		$this->hook_loader->run();

		/**
		 * Now we're loaded.
		 */
		$this->loaded = true;
	}

	/**
	 * Add unprivileged hooks for public consumption.
	 *
	 * Unprivileged methods/public-facing functionality should be defined in CRMN_Hooks_Public,
	 * and hooked into CRMN_Hook_Loader here.
	 */
	protected function add_public_hooks() {

		/**
		 * @var \CRMN_Member_Search_Hooks_Public $public_hooks
		 */
		$public_hooks = new CRMN_Member_Search_Hooks_Public();

		/**
		 * Load the plugin's text domain.
		 *
		 * @action init
		 *
		 * @see \CRMN_Member_Search_Hooks_Public::load_plugin_textdomain()
		 */
		$this->hook_loader->add_action( 'init', $public_hooks, 'load_plugin_textdomain', 0 );

		/**
		 * On init, register custom tables with WPDB.
		 *
		 * @action init
		 *
		 * @see    \CRMN_Member_Search_Hooks_Public::register_tables()
		 */
		$this->hook_loader->add_action( 'init', $public_hooks, 'register_tables', 1 );

		/**
		 * Load this plugin's custom Beaver Builder modules.
		 *
		 * @action init
		 *
		 * @see    \CRMN_Member_Search_Hooks_Public::register_modules()
		 */
		$this->hook_loader->add_action( 'init', $public_hooks, 'register_modules' );

		/**
		 * On switch_blog, register custom tables with WPDB.
		 *
		 * @action switch_blog
		 *
		 * @see    \CRMN_Member_Search_Hooks_Public::register_tables()
		 */
		$this->hook_loader->add_action( 'switch_blog', $public_hooks, 'register_tables' );

		/**
		 * Update the user's geocoded address when they save on their Woo profile.
		 *
		 * @action woocommerce_customer_save_address
		 *
		 * @see    \CRMN_Member_Search_Hooks_Public::woocommerce_customer_save_address()
		 */
		$this->hook_loader->add_action( 'woocommerce_customer_save_address', $public_hooks, 'woocommerce_customer_save_address', 10, 2 );

		/**
		 * Update the user's meta data in the search table after pods table is saved.
		 *
		 * @action pods_api_processed_form
		 *
		 * @see    \CRMN_Member_Search_Hooks_Public::pods_user_save_meta()
		 */
		$this->hook_loader->add_action( 'pods_api_processed_form', $public_hooks, 'pods_user_save_meta', 10, 3 );
	}

	/**
	 * Add privileged hooks for admin consumption.
	 *
	 * Privileged methods/WP-Admin facing functionality should be defined in CRMN_Hooks_Admin,
	 * and hooked into CRMN_Member_Search_Hook_Loader here.
	 */
	protected function add_admin_hooks() {

		/**
		 * @var \CRMN_Member_Search_Hooks_Admin $admin_hooks
		 */
		$admin_hooks = new CRMN_Member_Search_Hooks_Admin();

		/**
		 * On 'init' action, priority 0, load the plugin's text domain.
		 *
		 * @see \CRMN_Member_Search_Hooks_Admin::load_plugin_textdomain()
		 */
		$this->hook_loader->add_action( 'init', $admin_hooks, 'load_plugin_textdomain', 0 );

		/**
		 * On 'admin_init' action, load the plugin's Google Maps API key input.
		 *
		 * @see \CRMN_Member_Search_Hooks_Admin::admin_init()
		 */
		$this->hook_loader->add_action( 'admin_init', $admin_hooks, 'admin_init' );

		/**
		 * Update the user's geocoded address when they update their own profile in WP-Admin.
		 *
		 * @action personal_options_update
		 *
		 * @see    \CRMN_Member_Search_Hooks_Admin::personal_options_update()
		 */
		$this->hook_loader->add_action( 'personal_options_update', $admin_hooks, 'personal_options_update' );

		/**
		 * Update the user's geocoded address when their profile is updated by an admin in WP-Admin.
		 *
		 * @action edit_user_profile_update
		 *
		 * @see    \CRMN_Member_Search_Hooks_Admin::edit_user_profile_update()
		 */
		$this->hook_loader->add_action( 'edit_user_profile_update', $admin_hooks, 'edit_user_profile_update' );
	}
}
