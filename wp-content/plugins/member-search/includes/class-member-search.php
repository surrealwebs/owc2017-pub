<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    Member_Search
 * @subpackage Member_Search/includes
 */

/** Exit early if directly accessed via URL. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 */
class Member_Search {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @access   protected
	 * @var      Member_Search_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->set_locale();
		$this->register_tables();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Register custom tables with $wpdb.
	 *
	 * @access private
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 */
	private function register_tables() {

		global $wpdb;

		$wpdb->geodata = $wpdb->prefix . 'geodata';
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Member_Search_Loader. Orchestrates the hooks of the plugin.
	 * - Member_Search_I18n. Defines internationalization functionality.
	 * - Member_Search_Admin. Defines all hooks for the admin area.
	 * - Member_Search_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the core plugin.
		 */
		require_once OWCBPMS_PLUGIN_DIR . 'includes/class-member-search-loader.php';

		/**
		 * The class responsible for defining internationalization functionality of the plugin.
		 */
		require_once OWCBPMS_PLUGIN_DIR . 'includes/class-member-search-i18n.php';

		/**
		 * The class responsible for geocoding.
		 */
		require_once OWCBPMS_PLUGIN_DIR . 'includes/class-member-search-geocoder.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing side of the site.
		 */
		require_once OWCBPMS_PLUGIN_DIR . 'public/class-member-search-public.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once OWCBPMS_PLUGIN_DIR . 'admin/class-member-search-admin.php';

		$this->loader = new Member_Search_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Member_Search_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 */
	private function set_locale() {

		$plugin_i18n = new Member_Search_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Member_Search_Admin(
			$this->get_plugin_name(),
			$this->get_version(),
			$this->get_plugin_file(),
			$this->get_plugin_path(),
			$this->get_plugin_basename(),
			$this->get_plugin_url()
		);

		$this->loader->add_action( 'personal_options_update', $plugin_admin, 'udpate_user_address_geodata' );
		$this->loader->add_action( 'edit_user_profile_update', $plugin_admin, 'udpate_user_address_geodata' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Member_Search_Public(
			$this->get_plugin_name(),
			$this->get_version(),
			$this->get_plugin_file(),
			$this->get_plugin_path(),
			$this->get_plugin_basename(),
			$this->get_plugin_url()
		);

		$this->loader->add_action( 'woocommerce_customer_save_address', $plugin_public, 'udpate_user_address_geodata' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return OWCBPMS_PLUGIN_NAME;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Member_Search_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the full path and filename of this file with symlinks resolved.
	 *
	 * @since     1.0.0
	 * @return    string    The full path and filename of this file with symlinks resolved.
	 */
	public function get_plugin_file() {
		return OWCBPMS_PLUGIN_FILE;
	}

	/**
	 * Retrieve the full path with trailing slash for the plugin __FILE__.
	 *
	 * @since     1.0.0
	 * @return    string    The full path with trailing slash for the plugin __FILE__ passed in.
	 */
	public function get_plugin_path() {
		return OWCBPMS_PLUGIN_DIR;
	}

	/**
	 * Retrieve the relative path to the plugin, relative to the plugins directory.
	 *
	 * @since     1.0.0
	 * @return    string    The relative path to the plugin, relative to the plugins directory.
	 */
	public function get_plugin_basename() {
		return OWCBPMS_PLUGIN_BASENAME;
	}

	/**
	 * Retrieve the URL of this plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The URL path of the directory that contains the plugin.
	 */
	public function get_plugin_url() {
		return OWCBPMS_PLUGIN_URL;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return OWCBPMS_PLUGIN_VERSION;
	}
}
