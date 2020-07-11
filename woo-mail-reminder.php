<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.reandimo.dev/
 * @since             1.0.0
 * @package           Woo_Mail_Reminder
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Mail Reminder
 * Plugin URI:        https://www.reandimo.dev/woo-mail-reminder
 * Description:       Send a message to your customers to remind them you have the best offers.
 * Version:           1.1.0
 * Author:            Renan Diaz
 * Author URI:        https://www.reandimo.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-mail-reminder
 * Domain Path:       /languages
 * WC requires at least: 2.6
 * WC tested up to: 3.5.1

 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOOMR_VERSION', '1.1.2' );
define( 'WOOMR_FILE', __FILE__ ); // this file
define( 'WOOMR_BASENAME', plugin_basename( WOOMR_FILE ) ); // plugin name as known by WP
define( 'WOOMR_DIR', dirname( WOOMR_FILE ) ); // our directory

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-mail-reminder-activator.php
 */
function activate_woo_mail_reminder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-mail-reminder-activator.php';
	Woo_Mail_Reminder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-mail-reminder-deactivator.php
 */
function deactivate_woo_mail_reminder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-mail-reminder-deactivator.php';
	Woo_Mail_Reminder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_mail_reminder' );
register_deactivation_hook( __FILE__, 'deactivate_woo_mail_reminder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-mail-reminder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_mail_reminder() {

	$plugin = new Woo_Mail_Reminder();
	$plugin->run();

}
run_woo_mail_reminder();
