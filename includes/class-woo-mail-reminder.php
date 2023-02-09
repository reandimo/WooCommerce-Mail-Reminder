<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.reandimo.dev/
 * @since      1.0.0
 *
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/includes
 * @author     Renan Diaz <reandimo23@gmail.com>
 */
class Woo_Mail_Reminder {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woo_Mail_Reminder_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WOOMR_VERSION' ) ) {
			$this->version = WOOMR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'woo-mail-reminder';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woo_Mail_Reminder_Loader. Orchestrates the hooks of the plugin.
	 * - Woo_Mail_Reminder_i18n. Defines internationalization functionality.
	 * - Woo_Mail_Reminder_Admin. Defines all hooks for the admin area.
	 * - Woo_Mail_Reminder_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-mail-reminder-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-mail-reminder-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woo-mail-reminder-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woo-mail-reminder-public.php';

		/**
		 * Metabox.io
		 */ 
		if ( ! class_exists( 'RW_Meta_Box' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box/meta-box.php';
		}
		
		$this->loader = new Woo_Mail_Reminder_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woo_Mail_Reminder_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woo_Mail_Reminder_i18n();

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

		$plugin_admin = new Woo_Mail_Reminder_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );
		$this->loader->add_action( 'init', $plugin_admin, 'woomr_reminder_post_type' );
		if (isset($_GET['preview_woomr_mail'])) {
			$this->loader->add_action( 'init', $plugin_admin, 'woomr_preview_emails' ); //Preview Emails
		}
		$this->loader->add_action ('cron_schedules', $plugin_admin,'woomr_days_after');  
		$this->loader->add_action ('woomr_cron', $plugin_admin,'woomr_job');  
		//Reminder Column
		$this->loader->add_filter( 'manage_woomr_reminder_posts_columns', $plugin_admin, 'woomr_add_columns' );
		$this->loader->add_action( 'manage_woomr_reminder_posts_custom_column', $plugin_admin, 'woomr_add_columns_content', 10, 2 );
		//Quick Actions
		$this->loader->add_filter( 'post_row_actions', $plugin_admin, 'woomr_reminder_quick_actions', 10, 2 ); 
		$this->loader->add_filter( 'post_row_actions', $plugin_admin, 'woomr_remove_quick_actions', 10, 2 );
		$this->loader->add_action( 'load-edit.php', $plugin_admin, 'woomr_set_status_reminder' );
		//Check Requirements
		// $this->loader->add_action( 'tgmpa_register', $plugin_admin, 'woomr_register_required_plugins' );
		//Metabox
		$this->loader->add_filter( 'rwmb_meta_boxes', $plugin_admin, 'woomr_reminder_meta' );
		// Action Links
		$this->loader->add_action ('plugin_action_links_' . plugin_basename( WOOMR_FILE ), $plugin_admin,'woomr_action_links'); 
		//Ajax
		$this->loader->add_action( 'wp_ajax_woomr_toggle_reminder', $plugin_admin, 'woomr_toggle_reminder' );
		$this->loader->add_action( 'wp_ajax_woomr_test_mail', $plugin_admin, 'woomr_test_mail' ); 

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Woo_Mail_Reminder_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

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
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woo_Mail_Reminder_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
