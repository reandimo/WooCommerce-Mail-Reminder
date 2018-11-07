<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.reandimo.site/
 * @since      1.0.0
 *
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/includes
 * @author     Renan Diaz <reandimo23@gmail.com>
 */
class Woo_Mail_Reminder_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	    if( !class_exists( 'WooCommerce' ) ) {
	        deactivate_plugins( plugin_basename( __FILE__ ) );
	        wp_die( __( 'Please install and Activate WooCommerce.', 'woo-mail-reminder' ), 'Plugin dependency check', array( 'back_link' => true ) );
	    }else{
	    	if(!wp_next_scheduled('woomr_cron')) {
				wp_schedule_event(time(), 'woomr_days_after','woomr_cron');
			}
	    }
	}

}
