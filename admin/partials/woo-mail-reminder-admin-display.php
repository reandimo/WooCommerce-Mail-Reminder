<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.reandimo.site/
 * @since      1.0.0
 *
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/admin/partials
 */ 

?>
 
	<div class="wrap">
	    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	    <form action="options.php" method="post">
	        <?php
	            settings_fields( $this->plugin_name );
	            do_settings_sections( $this->plugin_name );
	            submit_button();
	        ?>
	    </form>

	        <?php
	            settings_fields( $this->plugin_name . '_test_section' );
	            do_settings_sections( $this->plugin_name . '_test_section' ); 
	        ?>

	</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
