<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.reandimo.site/
 * @since      1.0.0
 *
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Mail_Reminder
 * @subpackage Woo_Mail_Reminder/admin
 * @author     Renan Diaz <reandimo23@gmail.com>
 */
class Woo_Mail_Reminder_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Mail_Reminder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Mail_Reminder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-mail-reminder-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'select2-css', plugin_dir_url( __FILE__ ) . 'css/select2.css', array(), '', 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Mail_Reminder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Mail_Reminder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//Select2
		wp_enqueue_script( $this->plugin_name . 'select2-js', plugin_dir_url( __FILE__ ) . 'js/select2.js', array( 'jquery' ), '', true );
		//blockUI
		wp_enqueue_script(  $this->plugin_name . '_blockui-js', plugin_dir_url( __FILE__ ) . 'js/jquery.blockUI.js', array( 'jquery' ), $this->version, true );
		//Functions
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-mail-reminder-admin.js', array( 'jquery' ), $this->version, true );

		
	}

/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Woo Mail Reminder Settings', 'woo-mail-reminder' ),
			__( 'Woo Mail Reminder', 'woo-mail-reminder' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'wmr_display_options_page' )
		);
	
	}

/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function wmr_display_options_page() {
		include_once 'partials/woo-mail-reminder-admin-display.php';
	}

/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'wmr';

	public function register_setting() {

	// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'woo-mail-reminder' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		); 

		add_settings_field(
				$this->option_name . '_days',
				__( 'Days after last order', 'woo-mail-reminder' ),
				array( $this, $this->option_name . '_days_cb' ),
				$this->plugin_name,
				$this->option_name . '_general',
				array( 'label_for' => $this->option_name . '_days' )
			);

		// add_settings_field(
		// 		$this->option_name . '_roles',
		// 		__( 'Roles a enviar correo', 'woo-mail-reminder' ),
		// 		array( $this, $this->option_name . '_roles_cb' ),
		// 		$this->plugin_name,
		// 		$this->option_name . '_general',
		// 		array( 'label_for' => $this->option_name . '_roles' )
		// 	);

		add_settings_field(
				$this->option_name . '_subject',
				__( 'Subject', 'woo-mail-reminder' ),
				array( $this, $this->option_name . '_subject_cb' ),
				$this->plugin_name,
				$this->option_name . '_general',
				array( 'label_for' => $this->option_name . '_subject' )
			);

		add_settings_field(
				$this->option_name . '_heading',
				__( 'Heading', 'woo-mail-reminder' ),
				array( $this, $this->option_name . '_heading_cb' ),
				$this->plugin_name,
				$this->option_name . '_general',
				array( 'label_for' => $this->option_name . '_heading' )
			);

		add_settings_field(
				$this->option_name . '_message',
				__( 'Message', 'woo-mail-reminder' ),
				array( $this, $this->option_name . '_message_cb' ),
				$this->plugin_name,
				$this->option_name . '_general',
				array( 'label_for' => $this->option_name . '_message' )
			);


	// Add a Test Mail section
		add_settings_section(
			$this->option_name . '_test',
			__( 'Test Mail', 'woo-mail-reminder' ),
			array( $this, $this->option_name . '_test_cb' ),
			$this->plugin_name . '_test_section'
		); 

		add_settings_field(
				$this->option_name . '_testmail',
				__( 'Email Address', 'woo-mail-reminder' ),
				array( $this, $this->option_name . '_testmail_cb' ),
				$this->plugin_name . '_test_section',
				$this->option_name . '_test',
				array( 'label_for' => $this->option_name . '_testmail' )
			);

		// register_setting( $this->plugin_name, $this->option_name . '_roles', array( $this, $this->option_name . '_sanitize_roles' ) ); 
		register_setting( $this->plugin_name, $this->option_name . '_days', 'intval' ); 
		register_setting( $this->plugin_name, $this->option_name . '_subject' ); 
		register_setting( $this->plugin_name, $this->option_name . '_heading' ); 
		register_setting( $this->plugin_name, $this->option_name . '_message' ); 

	}

/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function wmr_general_cb() {
		echo '<p>' . __( 'Change the settings, according your needs.', 'woo-mail-reminder' ) . '</p>'; 
	} 

/**
	 * Render the text for the Test section
	 *
	 * @since  1.0.0
	 */
	public function wmr_test_cb() {
		echo '<p>' . __( 'If you want to test your template, this is the section.', 'woo-mail-reminder' ) . '</p>'; 
	} 

/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function wmr_days_cb() {
		echo '<input type="text" name="' . $this->option_name . '_days' . '" id="' . $this->option_name . '_days' . '" value="'. get_option( $this->option_name . '_days' ) .'"> '. __( 'days', 'woo-mail-reminder' );
	} 

/**
	 * Render the roles option
	 *
	 * @since  1.0.0
	 */
	public function wmr_roles_cb() {

		global $wp_roles;

	    if ( !isset( $wp_roles ) ) $wp_roles = new WP_Roles();

	    $available_roles_names = $wp_roles->get_names();//we get all roles names 
		$options = explode('|', get_option( $this->option_name . '_roles' )) ;
		$selected = array();

		foreach ($options as $option) {
			$selected[] = $option;
		} 

?>
	<select iddsf="<?php print_r($selected) ?>" name="<?= $this->option_name . '_roles' ?>[]" id="<?= $this->option_name . '_roles' ?>" multiple>
<?php
		foreach ($available_roles_names as $role) { 
?>
			<option value="<?= $role ?>" <?php if ( in_array($role, $selected) ){ echo 'selected'; } ?> ><?= $role ?></option>
<?php
			} 
?>
	</select> 
<?php
	} 


/**
	 * Render the roles option
	 *
	 * @since  1.0.0
	 */

	public function wmr_message_cb() {

		$content = get_option($this->option_name . '_message');
        wp_editor( $content, $this->option_name . '_message', $settings = array('textarea_rows'=> '10') );

	}

/**
	 * Render the Heading option
	 *
	 * @since  1.0.0
	 */

	public function wmr_heading_cb() {
		echo '<input type="text" name="' . $this->option_name . '_heading' . '" id="' . $this->option_name . '_heading' . '" value="'. get_option( $this->option_name . '_heading' ) .'"> ';
	}

/**
	 * Render the Subject option
	 *
	 * @since  1.0.0
	 */

	public function wmr_subject_cb() {
		echo '<input type="text" name="' . $this->option_name . '_subject' . '" id="' . $this->option_name . '_subject' . '" value="'. get_option( $this->option_name . '_subject' ) .'"> ';
	}

/**
	 * Render the Heading option
	 *
	 * @since  1.0.0
	 */

	public function wmr_testmail_cb() {
		echo '<input type="email" name="' . $this->option_name . '_testmail' . '" id="' . $this->option_name . '_testmail' . '" value="'. get_option( $this->option_name . '_testmail' ) .'"> ';

		$other_attributes = array( 'id' => $this->option_name . '_testmail_submit' );

		submit_button( __('Test!', 'woo-mail-reminder' ), 'secondary', '', true, $other_attributes );

	}

/**
	 * Send Test Mail via AJAX
	 *
	 * @since  1.0.0
	 */

	public function wmr_test_mail() {

		$test_mail = $_POST['mail'];

		if ( !empty($test_mail) ) {
			// load the mailer class
			$mailer = WC()->mailer();
			//format the email
			$recipient = $test_mail;
			$subject = get_option( $this->option_name . '_subject' );
			$content = $this->get_custom_email_html();
			$headers = "Content-Type: text/html\r\n";
			//send the email through wordpress

			if ( $mailer->send( $recipient, $subject, $content, $headers ) ) {
				echo 1; //All Good bro!
			}else{
				echo 0; //We have a problem
			}
		}

		wp_die();

	}

/**
	 * Sanitize the options in select
	 *
	 * @param  string $roles $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */

	public function wmr_sanitize_roles( $options ) {

		$insert = '';

		if (!empty($options)) {
			foreach ($options as $option) {
				$insert .= $option.'|';
			}

			return substr($insert, 0, -1);
		}else{
			return $insert;
		}

	}

/**
	 * Get the heading, message and footer to send.
	 *
	 * @since  1.0.0 
 	 * 
 	 *
	 */

	public function get_custom_email_html() {

        $email_heading = get_option( $this->option_name . '_heading' );
        ob_start(); 
		include_once( WMR_DIR . '/templates/email-header.php' );
		echo get_option($this->option_name . '_message');
		include_once( WMR_DIR . '/templates/email-footer.php');
		$output = ob_get_clean(); 

		return $output;

	}

/**
	 * Create Cron Job
	 *
	 * @since  1.0.0 
 	 * 
 	 *
	 */
 
	public function wmr_job() {

		$args = array(
			'role'           => 'customer',
		);
		$wp_user_query = new WP_User_Query($args);
		$customers = $wp_user_query->get_results();
		$list[] = ''; 
		$days_after = get_option( $this->option_name . '_days' );

		if (!empty($customers)) { 

			foreach ($customers as $author) {
				//Get last customer order
				$order = wc_get_customer_last_order( $author->ID );

				if (!empty($order)) {
					//Format dates
					$date_completed = date_create( $order->get_date_completed()->date('Y-m-d') ); 
					$today= date_create( date('Y-m-d') );
					//Get diff
					$diff=date_diff($date_completed,$today);

					if ($diff >= $days_after ) {
						$author_info = get_userdata($author->ID);  
						$list[] = $author_info->user_email;
					}
					// echo $diff->format("%a days");
				}

			} 

			// load the mailer class
			$mailer = WC()->mailer();
			//format the email
			$recipient = $list;
			$subject = get_option( $this->option_name . '_subject' );
			$content = $this->get_custom_email_html();
			$headers = "Content-Type: text/html\r\n";
			//send the email through wordpress
			$mailer->send( $recipient, $subject, $content, $headers );

		}

	}  


/**
 * Add plugin action links.
 *
 * Add a link to the settings page on the plugins.php page.
 *
 * @since 1.0.0
 *
 * @param  array  $links List of existing plugin action links.
 * @return array         List of modified plugin action links.
 */
function wmr_action_links( $links ) {
	$links = array_merge( array(
		'<a href="' . esc_url( admin_url( '/options-general.php?page=' . $this->plugin_name ) ) . '">' . __( 'Settings', 'woo-mail-reminder' ) . '</a>'
	), $links );
	return $links;
}

}

