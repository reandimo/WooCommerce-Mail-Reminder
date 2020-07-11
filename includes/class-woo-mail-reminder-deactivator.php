<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.reandimo.dev/
 * @since      1.0.0
 *
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/includes
 * @author     Renan Diaz <reandimo23@gmail.com>
 */
class Woo_Mail_Reminder_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {	

		//find out when the last event was scheduled
		$timestamp = wp_next_scheduled('woomr_cron');

		//unschedule previous event if any
		wp_unschedule_event($timestamp,'woomr_cron');
	}

}
