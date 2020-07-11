<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.reandimo.dev/
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-mail-reminder-admin.css?' . rand(0, 10), array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-fa-reminder', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/fonts/font-awesome.min.css?' . rand(0, 10), array(), $this->version, 'all' ); 
		// wp_enqueue_style( $this->plugin_name . '-bootstrap-css', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/bootstrap/css/bootstrap.min.css?' . rand(0, 10), array(), $this->version, 'all' ); 
		wp_enqueue_style( 'select2-css', plugin_dir_url( __FILE__ ) . 'css/select2.css?' . rand(0, 10), array(), '', 'all' );

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
		wp_enqueue_script( $this->plugin_name . 'select2-js', plugin_dir_url( __FILE__ ) . 'js/select2.js?' . rand(0,10), array( 'jquery' ), false, true );
		//blockUI
		wp_enqueue_script(  $this->plugin_name . '_blockui-js', plugin_dir_url( __FILE__ ) . 'js/jquery.blockUI.js?' . rand(0,10), array( 'jquery' ), false, true );
		//Functions
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-mail-reminder-admin.js?' . rand(0,10), array( 'jquery' ), $this->version, true );
		//ReminderEditJS
		wp_enqueue_script( $this->plugin_name . '-reminder-edit', plugin_dir_url( __FILE__ ) . 'js/reminder-edit.js?' . rand(0,10), array( 'jquery' ), $this->version, true );
		
	}

/**
	 * Register Custom Post Type
	 *
	 * @since  1.0.0
*/

function woomr_reminder_post_type() {

	$labels = array(
		'name'                  => _x( 'Reminders', 'Post Type General Name', 'woo-mail-reminder' ),
		'singular_name'         => _x( 'Reminder', 'Post Type Singular Name', 'woo-mail-reminder' ),
		'menu_name'             => __( 'Reminders', 'woo-mail-reminder' ),
		'name_admin_bar'        => __( 'Reminder', 'woo-mail-reminder' ),
		'archives'              => __( 'Reminder Archives', 'woo-mail-reminder' ),
		'attributes'            => __( 'Reminder Attributes', 'woo-mail-reminder' ),
		'parent_item_colon'     => __( 'Parent Reminder:', 'woo-mail-reminder' ),
		'all_items'             => __( 'All Reminders', 'woo-mail-reminder' ),
		'add_new_item'          => __( 'Add New Reminder', 'woo-mail-reminder' ),
		'add_new'               => __( 'Add New', 'woo-mail-reminder' ),
		'new_item'              => __( 'New Reminder', 'woo-mail-reminder' ),
		'edit_item'             => __( 'Edit Reminder', 'woo-mail-reminder' ),
		'update_item'           => __( 'Update Reminder', 'woo-mail-reminder' ),
		'view_item'             => __( 'View Reminder', 'woo-mail-reminder' ),
		'view_items'            => __( 'View Reminders', 'woo-mail-reminder' ),
		'search_items'          => __( 'Search Reminder', 'woo-mail-reminder' ),
		'not_found'             => __( 'Not found', 'woo-mail-reminder' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'woo-mail-reminder' ),
		'featured_image'        => __( 'Featured Image', 'woo-mail-reminder' ),
		'set_featured_image'    => __( 'Set featured image', 'woo-mail-reminder' ),
		'remove_featured_image' => __( 'Remove featured image', 'woo-mail-reminder' ),
		'use_featured_image'    => __( 'Use as featured image', 'woo-mail-reminder' ),
		'insert_into_item'      => __( 'Insert into reminder', 'woo-mail-reminder' ),
		'uploaded_to_this_item' => __( 'Uploaded to this reminder', 'woo-mail-reminder' ),
		'items_list'            => __( 'Reminders list', 'woo-mail-reminder' ),
		'items_list_navigation' => __( 'Reminders list navigation', 'woo-mail-reminder' ),
		'filter_items_list'     => __( 'Filter items list', 'woo-mail-reminder' ),
	);
	$args = array(
		'label'                 => __( 'Reminder', 'woo-mail-reminder' ),
		'description'           => __( 'Reminders to Clients', 'woo-mail-reminder' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor'),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-email',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'woomr_reminder', $args );

}  

/**
	 * Metabox
	 *
	 * @since   1.0.0
	 * @var  	string 		$prefix 	Option name of the prefix for metaboxes
*/

function woomr_reminder_meta( $meta_boxes ) {
	$prefix = 'woomr-';

	$meta_boxes[] = array(
		'id' => 'reminder_options',
		'title' => esc_html__( 'Reminder Options', 'woo-mail-reminder' ),
		'post_types' => array('woomr_reminder' ),
		'context' => 'after_editor',
		'priority' => 'default',
		'autosave' => 'true',
		'fields' => array(
			array(
				'id' => $prefix . 'days_after',
				'type' => 'number',
				'name' => esc_html__( 'Days after', 'woo-mail-reminder' ) . ' <i class="fa fa-info info-icon" data-placement="right" data-title="'. __('Days After', 'woo-mail-reminder') .'" data-image="'. plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/placeholder.png' .'" data-desc="'. __('The interval of time between the customer\'s last order and the current date, for sending the reminders in days. Example: if you set 10 days, when the server checks the reminders only will be sent to customers with 10 days after.', 'woo-mail-reminder') .'"></i> ',
				'desc' => esc_html__( 'Number of days after customer\'s last order', 'woo-mail-reminder' ),
				'std' => '7',
				'placeholder' => esc_html__( 'Days After', 'woo-mail-reminder' ),
				'min' => '1',
				'step' => '1',
			),
			array(
				'id' => $prefix . 'subject',
				'type' => 'text',
				'name' => esc_html__( 'Subject', 'woo-mail-reminder' ) . ' <i class="fa fa-info info-icon" data-placement="right" data-title="'. __('Subject', 'woo-mail-reminder') .'" data-image="'. plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/subject.png' .'" data-desc="'. __('The Subject of the Email.', 'woo-mail-reminder') .'"></i> ',
				'desc' => esc_html__( 'Email subject', 'woo-mail-reminder' ),
				'placeholder' => esc_html__( 'Subject', 'woo-mail-reminder' ),
			),
			array(
				'id' => $prefix . 'heading',
				'type' => 'text',
				'name' => esc_html__( 'Heading', 'woo-mail-reminder' ) . ' <i class="fa fa-info info-icon" data-title="'. __('Heading', 'woo-mail-reminder') .'" data-image="'. plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/default-heading.png' .'" data-desc="'. __('Set a Heading for the email template.', 'woo-mail-reminder') .'"></i> ',
				'desc' => esc_html__( 'Email\'s Heading', 'woo-mail-reminder' ),
				'placeholder' => esc_html__( 'Heading', 'woo-mail-reminder' ),
			),
			array(
				'id' => $prefix . 'divider_4',
				'type' => 'divider',
				'name' => esc_html__( 'Divider', 'woo-mail-reminder' ),
			),
			array(
				'id' => $prefix . 'preview',
				'type' => 'button',
				'name' => esc_html__( 'Preview', 'woo-mail-reminder' ),
				'desc' => esc_html__( 'If you want to preview your template, this is the button.', 'woo-mail-reminder' ),
				'class' => 'preview-template',
			),  
			array(
				'id' => $prefix . 'nonce',
				'type' => 'hidden',
				'attributes' => array(
					'value' => wp_create_nonce('woomr-preview'),
				), 
			), 

		),
	);

	return $meta_boxes;
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
			array( $this, 'woomr_display_options_page' )
		);
	
	}

/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function woomr_display_options_page() {
		include_once 'partials/woo-mail-reminder-admin-display.php';
	}

/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'woomr';

	public function register_setting() {

	// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'woo-mail-reminder' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		); 

		// add_settings_field(
		// 		$this->option_name . '_days',
		// 		__( 'Days after last order', 'woo-mail-reminder' ) . ' <i class="fa fa-info info-icon" data-title="'. __('Help', 'woo-mail-reminder') .'" data-image="'. plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/placeholder.png' .'" data-desc="'. __('Set a Default Heading for the email templates in case you didn\'t assign one to a reminder.', 'woo-mail-reminder') .'"></i> ',
		// 		array( $this, $this->option_name . '_days_cb' ),
		// 		$this->plugin_name,
		// 		$this->option_name . '_general',
		// 		array( 'label_for' => $this->option_name . '_days' )
		// 	);

		add_settings_field(
				$this->option_name . '_intervals',
				__( 'Check for Reminders every', 'woo-mail-reminder' ) . ' <i class="fa fa-info info-icon" data-title="'. __('The Interval', 'woo-mail-reminder') .'" data-image="'. plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/placeholder.png' .'" data-desc="'. __('The interval of time for sending the reminders (cron job), in days. Example: if you set 5 days, the server will check the reminders every 5 days.', 'woo-mail-reminder') .'"></i> ',
				array( $this, $this->option_name . '_intervals_cb' ),
				$this->plugin_name,
				$this->option_name . '_general',
				array( 'label_for' => $this->option_name . '_intervals' )
			);

		// add_settings_field(
		// 		$this->option_name . '_roles',
		// 		__( 'Roles a enviar correo', 'woo-mail-reminder' ),
		// 		array( $this, $this->option_name . '_roles_cb' ),
		// 		$this->plugin_name,
		// 		$this->option_name . '_general',
		// 		array( 'label_for' => $this->option_name . '_roles' )
		// 	);

		// add_settings_field(
		// 		$this->option_name . '_subject',
		// 		__( 'Subject', 'woo-mail-reminder' ),
		// 		array( $this, $this->option_name . '_subject_cb' ),
		// 		$this->plugin_name,
		// 		$this->option_name . '_general',
		// 		array( 'label_for' => $this->option_name . '_subject' )
		// 	);

		add_settings_field(
				$this->option_name . '_default_heading',
				__( 'Default Heading', 'woo-mail-reminder' ) . ' <i class="fa fa-info info-icon" data-title="'. __('Default Heading', 'woo-mail-reminder') .'" data-image="'. plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/default-heading.png' .'" data-desc="'. __('Set a Default Heading for the email templates in case you didn\'t assign one to a reminder.', 'woo-mail-reminder') .'"></i> ',
				array( $this, $this->option_name . '_heading_cb' ),
				$this->plugin_name,
				$this->option_name . '_general',
				array( 'label_for' => $this->option_name . '_default_heading' )
			);

		// add_settings_field(
		// 		$this->option_name . '_message',
		// 		__( 'Message', 'woo-mail-reminder' ),
		// 		array( $this, $this->option_name . '_message_cb' ),
		// 		$this->plugin_name,
		// 		$this->option_name . '_general',
		// 		array( 'label_for' => $this->option_name . '_message' )
		// 	);


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
		register_setting( $this->plugin_name, $this->option_name . '_intervals', 'intval' ); 
		// register_setting( $this->plugin_name, $this->option_name . '_subject' ); 
		register_setting( $this->plugin_name, $this->option_name . '_default_heading' ); 
		// register_setting( $this->plugin_name, $this->option_name . '_message' ); 

	}

/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function woomr_general_cb() {
		echo '<p>' . __( 'Change the settings, according your needs.', 'woo-mail-reminder' ) . '</p>'; 
	} 

/**
	 * Render the text for the Test section
	 *
	 * @since  1.0.0
	 */
	public function woomr_test_cb() {
		echo '<p>' . __( 'If you want to test your template, this is the section.', 'woo-mail-reminder' ) . '</p>'; 
	} 

/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function woomr_days_cb() {
		echo '<input type="number" name="' . $this->option_name . '_days' . '" id="' . $this->option_name . '_days' . '" value="'. get_option( $this->option_name . '_days' ) .'"> '. __( 'days', 'woo-mail-reminder' ); 
	} 

/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function woomr_intervals_cb() {
		echo '<input type="number" name="' . $this->option_name . '_intervals' . '" id="' . $this->option_name . '_intervals' . '" value="'. get_option( $this->option_name . '_intervals' ) .'"> '. __( 'days', 'woo-mail-reminder' );
	} 

/**
	 * Render the roles option
	 *
	 * @since  1.0.0
	 */
	public function woomr_roles_cb() {

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

	public function woomr_message_cb() {

		$content = get_option($this->option_name . '_message');
        wp_editor( $content, $this->option_name . '_message', $settings = array('textarea_rows'=> '10') );

	}

/**
	 * Render the Heading option
	 *
	 * @since  1.0.0
	 */

	public function woomr_heading_cb() {
		echo '<input type="text" name="' . $this->option_name . '_default_heading' . '" id="' . $this->option_name . '_default_heading' . '" value="'. get_option( $this->option_name . '_default_heading' ) .'"> ';
	}

/**
	 * Render the Subject option
	 *
	 * @since  1.0.0
	 */

	public function woomr_subject_cb() {
		echo '<input type="text" name="' . $this->option_name . '_subject' . '" id="' . $this->option_name . '_subject' . '" value="'. get_option( $this->option_name . '_subject' ) .'"> ';
	}

/**
	 * Render the Heading option
	 *
	 * @since  1.0.0
	 */

	public function woomr_testmail_cb() {
		echo '<input type="email" name="' . $this->option_name . '_testmail' . '" id="' . $this->option_name . '_testmail' . '" value="'. get_option( $this->option_name . '_testmail' ) .'"> ';

		$other_attributes = array( 'id' => $this->option_name . '_testmail_submit' );

		submit_button( __('Test!', 'woo-mail-reminder' ), 'secondary', '', true, $other_attributes );

	}

/**
	 * Send Test Mail via AJAX
	 *
	 * @since  1.0.0
	 */

	public function woomr_test_mail() {

		$test_mail = $_POST['mail'];

		if ( !empty($test_mail) ) {
			
			//format the email
			$recipient = $test_mail;
			$subject = esc_html__('This is a test email', 'woo-mail-reminder');
			$heading = esc_html__('This is a test email', 'woo-mail-reminder');
			$message = esc_html__('If you\'re reading this, means it\'s all good man!' , 'woo-mail-reminder');
			$content = $this->get_custom_email_html( $heading, '');
			$headers = "Content-Type: text/html\r\n";
			//send the email through wordpress

			if ( wp_mail( $recipient, $subject, $content, $headers ) ) {
				echo json_encode( ['code' => 1, 'message' => __('Test mail sent!', 'woo-mail-reminder')] ); //All Good bro!
			}else{
				echo json_encode( ['code' => 0, 'message' => __('Something went wrong, try again!', 'woo-mail-reminder')] ); //We have a problem
			}
		}else{
			echo json_encode( ['code' => 0, 'message' => __('No hay correo para enviar.', 'woo-mail-reminder')] ); //We have a problem
		}

		wp_die();

	}


/**
	 * Set status to a reminder
	 *
	 * @since  1.0.0
	 * @param  int   $_POST['reminder_id']  Reminder ID
	 * @param  json
	 */

	public function woomr_deactivate_reminder() {

		$reminder_id = $_POST['reminder_id'];

		if ( !empty($reminder_id) ) { 

			$currentStatus = get_post_meta( $reminder_id, 'status', true);

			if ( $currentStatus == 1 ) {
				$update = update_post_meta( $reminder_id, 'status', 1 ); 
			}else{
				$update = update_post_meta( $reminder_id, 'status', 1 );
			}

			//Check
			if( $update == true ){
				echo json_encode( [ 'code' => 1, 'message' => __('Reminder is now active!', 'woo-mail-reminder') ] ); //All Good bro!
			}else{
				echo json_encode( [ 'code' => 0, 'message' => __('Reminder deactivated!', 'woo-mail-reminder') ] ); //We have a problem
			}

		}

		wp_die();

	}

/**
	 * Sanitize the options in select
	 *
	 * @since  1.0.0
	 * @param  string  $roles  $_POST value
	 * @return string          Sanitized value
	 */

	public function woomr_sanitize_roles( $options ) {

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
	 * Interval to send mail.
	 *
	 * @since  1.0.0 
 	 * @param  array  $schedules  List of existing schedules
 	 * @param  84600, day in seconds
  	 * @return array  $schedules  List of modified schedules
 	 *
	 */

	public function woomr_days_after($schedules) {

        $days = get_option( $this->option_name . '_intervals' ); 
        
        if ( !empty($days) ) {
	        $days = $days*86400;
        }else{
        	$days = 86400;
        }

	        $schedules[$this->option_name.'_days_after'] = array(
	        								'interval' => $days,
	        								'display'  => __("Days After Customer's Last Order", 'woo-mail-reminder')
	        								);

        return $schedules;

	}

/**
	 * Get the heading, message and footer to send.
	 *
	 * @since  1.0.0 
	 * @param  string  $heading  Email's heading.
	 * @param  string  $message    Email's message.
	 * @return html              List of modified plugin action links.
 	 *
	 */

	public function get_custom_email_html( $heading = null, $message = null ) {

		if ( $message !== null && !empty($message) ) {

			// load the mailer class
			$mailer = WC()->mailer(); 
			// create a new email
			$email = new WC_Email();

			$email_heading = ( !empty( $heading ) ) ? $heading : get_option( $this->option_name . '_default_heading' ) ; 
	        $message = do_shortcode( $message );

			// wrap the content with the email template and then add styles
			$output = apply_filters( 'woocommerce_mail_content', $email->style_inline( $mailer->wrap_message( $email_heading, $message ) ) );

			return $output;
		}else{
			return false;
		}

	}

	/**
	 *
	 * Preview email template.
	 * @since  1.0.0  
	 * @return html         Email preview.
	 *
	 */
	public function woomr_preview_emails() {

		if ( isset( $_GET['preview_woomr_mail'] ) ) {
			if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'woomr-preview' ) ) {
				die( 'Security check' );
			}

			// load the mailer class
			$mailer = WC()->mailer(); 

			// get the preview email content
			$message = do_shortcode( stripslashes( $_REQUEST['content'] ) ); 

			$email_heading = stripslashes ( $_REQUEST['heading'] );

			// create a new email
			$email = new WC_Email();

			// wrap the content with the email template and then add styles
			$output = apply_filters( 'woocommerce_mail_content', $email->style_inline( $mailer->wrap_message( $email_heading, $message ) ) );

			// print the preview email
			echo $output;
			exit;
		}

	}

/**
	 * Create Cron Job
	 *
	 * @since  1.0.0 
 	 * 
 	 *
	 */
 
	public function woomr_job() {

		// WP_Query arguments
		$reminders_args = array(
			'post_type'              => array( 'woomr_reminder' ), 
		);

		// Get Reminders
		$reminders_query = new WP_Query( $reminders_args );
		$reminders_list = array();
 
		if ( $reminders_query->have_posts() ) {
			while ( $reminders_query->have_posts() ) {
				$reminders_query->the_post();
				$reminders_list[] = get_the_ID();  
			}
		} 

		// Restore original Post Data
		wp_reset_postdata();

		//Users Query
		$args = array(
			'role'           => 'customer',
		);
		$wp_user_query = new WP_User_Query($args);
		$customers = $wp_user_query->get_results();
		$list = array(); //Recipients list

		if ( !empty($customers) && !empty($reminders_list) ) { 

			foreach ($reminders_list as $reminder_id) {

				$status = get_post_meta( $reminder_id, 'status', true);

				//Check if reminder is active
				if ( $status == 1 ) {

					foreach ($customers as $author) {
						//Get last customer order
						$customer_id = $author->ID;
						$order = wc_get_customer_last_order( $customer_id );

						//Check if last order exist
						if (!empty($order)) {
							//Check if Polylang is Active
							if ( function_exists( 'pll_get_post' ) ) {
								//Check if translation exist for reminders
								if( pll_is_translated_post_type( 'woomr_reminder' ) ){
									$locale = get_user_locale( $customer_id );
									$locale = $locale[0].$locale[1]; //Format to 2 letters
									$translation_id = pll_get_post($reminder_id, $locale); //Get translation id
									//If translation exist use it
									$data = ( $translation_id !== false ) ? get_post( $translation_id ) : get_post( $reminder_id ) ;
								}else{
									$data = get_post( $reminder_id );
								} 
							}else{
								$data = get_post( $reminder_id );
							} 

							$days_after = rwmb_meta( 'woomr-days_after', null, $reminder_id );
							$subject = rwmb_meta( 'woomr-subject', null, $reminder_id );
							$heading = rwmb_meta( 'woomr-heading', null, $reminder_id );
							$message = $data->post_content;
							$content = $this->get_custom_email_html( $heading, $message );

							//Format dates
							$date_completed = date_create( $order->get_date_completed()->date('Y-m-d') ); 
							$today= date_create( date('Y-m-d') );
							//Get diff
							$diff=date_diff( $date_completed, $today );

							if ($diff >= $days_after ) {
								$author_info = get_userdata( $customer_id );  
								$list[] = $author_info->user_email;
							} 

						} //endif Empty Order

					} //endforeach Customers 
 
					//format the email
					$recipient = $list;
					//Headers
					$headers = "Content-Type: text/html\r\n";
					//send the email through wordpress 
					wp_mail( $recipient, $subject, $content, $headers );

					//Update Last Date
					update_post_meta( $reminder_id, 'last_sent', date('Y-m-d') );

				}//End status check

			} //endforeach Reminder

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

	public function woomr_action_links( $links ) {
		$links = array_merge( array(
			'<a href="' . esc_url( admin_url( '/options-general.php?page=' . $this->plugin_name ) ) . '">' . __( 'Settings', 'woo-mail-reminder' ) . '</a>'
		), $links );
		return $links;
	}

	/**
	 * Add custom columns.
	 *
	 * Add a link to the settings page on the plugins.php page.
	 *
	 * @since 1.0.0
	 *
	 * @param  array  $columns List of existing columns.
	 * @return array           List of modified columns.
	 */
	public function woomr_add_columns( $columns ){

		$columns['days_after'] = __('Days after', 'woo-mail-reminder');
		$columns['heading'] = __('Heading', 'woo-mail-reminder');
		$columns['subject'] = __('Subject', 'woo-mail-reminder');
		$columns['last_sent'] = __('Last Sent', 'woo-mail-reminder');
		$columns['status'] = __('Status', 'woo-mail-reminder');

		return $columns;
	}

	/**
	 * Add custom column content.
	 *
	 * Add a link to the settings page on the plugins.php page.
	 *
	 * @since 1.1.0
	 *
	 * @param  array  $links List of existing plugin action links.
	 * @return array         List of modified plugin action links.
	 */
	public function woomr_add_columns_content( $column, $post_id ){

		switch ( $column ) {
			case 'days_after':
				//Show interval
				echo rwmb_meta( 'woomr-days_after', null, $post_id );
			break;

			case 'heading': 
				echo rwmb_meta( 'woomr-heading', null, $post_id );
			break;

			case 'subject':
				echo rwmb_meta( 'woomr-subject', null, $post_id );
			break;

			case 'last_sent':
				$meta = get_post_meta( $post_id, 'last_sent', true);
				$date = ( !empty( $meta ) ) ? $meta : __( 'Never Sent', 'woo-mail-reminder') ;
				echo $date;
			break;

			case 'status':
				$meta = get_post_meta( $post_id, 'status', true);
				$date = ( $meta == 1 ) ? '<span class="dashicons dashicons-yes"></span> ' . __( 'Active', 'woo-mail-reminder') : '<span class="dashicons dashicons-no-alt"></span>' . __( 'Inactive', 'woo-mail-reminder') ;
				echo $date;
			break;

		}

	}


	/**
	 * Add custom quick actions. 
	 *
	 * @since 1.1.0
	 * @param  array   $links List of existing actions.
	 * @param  object  $post  Current post.
	 * @return array          List of modified plugin action links.
	 * 
	 */

	public function woomr_reminder_quick_actions( $actions, $post ){
 
 		if ( 'woomr_reminder' == $post->post_type ) {

		    $nonce = wp_create_nonce( 'reminder-status-action' );  

		    $meta = get_post_meta( $post->ID, 'status', true);

		    if ( $meta == 1 ) { 
		    	$link = admin_url( "edit.php?post_type=woomr_reminder&update_id={$post->ID}&_wpnonce=$nonce&set_status=0" );
		    	$actions['set-status'] = "<a href='$link'>". __('Set Inactive', 'woo-mail-reminder') ."</a>";
		    }else{
		    	$link = admin_url( "edit.php?post_type=woomr_reminder&update_id={$post->ID}&_wpnonce=$nonce&set_status=1" );
		    	$actions['set-status'] = "<a href='$link'>". __('Set Active', 'woo-mail-reminder') ."</a>";
		    }
		    
  		}

	    return $actions;
	}


	/**
	 * Remove some quick actions.
	 *  
	 * @since 1.1.0
	 * @param  array   $links List of existing actions.
	 * @param  object  $post  Current post.
	 * @return array          List of modified plugin action links.
	 * 
	 */

	public function woomr_remove_quick_actions( $actions, $post )
	{
	    if ( 'woomr_reminder' == $post->post_type ) {
	        unset($actions['view']);
	        unset($actions['inline hide-if-no-js']); 
	    }
	    return $actions;
	}

	/**
	 * Activate or deactivate a reminder.
	 *  
	 * @since 1.1.0
	 * 
	 */

	public function woomr_set_status_reminder() 
	{
	    $nonce = isset( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : null;
	    if ( wp_verify_nonce( $nonce, 'reminder-status-action' ) && isset( $_REQUEST['update_id'] ) && isset( $_REQUEST['set_status'] ) )
	    {   
	        update_post_meta( $_REQUEST['update_id'], 'status', $_REQUEST['set_status'] );
	    }
	}


}

