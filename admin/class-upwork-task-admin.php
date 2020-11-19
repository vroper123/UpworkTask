<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://lumenwp.com
 * @since      1.0.0
 *
 * @package    Upwork_Task
 * @subpackage Upwork_Task/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Upwork_Task
 * @subpackage Upwork_Task/admin
 * @author     Vincent Roper <Vincent_Roper@gmail.com>
 */
class Upwork_Task_Admin {

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
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'upwork_task';
	
	
	
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
		 * defined in Upwork_Task_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Upwork_Task_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/upwork-task-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Geo Store Manager Settings', 'upwork-task' ),
			__( 'Geo Manager', 'upwork-task' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);

	}

	public function addPluginAdminMenu() {
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page(  'Geo Manger Setting', 'Geo Manager', 'manage_options', $this->plugin_name, array( $this, 'display_options_page' ), 'dashicons-chart-area', 26 );
		
		 
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/upwork-task-admin-display.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {

		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'upwork-task' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		 

		
		add_settings_field(
			$this->option_name . '_name',
			__( 'Name', 'upwork-task' ),
			array( $this, $this->option_name . '_name_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_name' )
		);

		add_settings_field(
			$this->option_name . '_address',
			__( 'Address', 'upwork-task' ),
			array( $this, $this->option_name . '_address_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_address' )
		);


		add_settings_field(
			$this->option_name . '_address',
			__( 'Address', 'upwork-task' ),
			array( $this, $this->option_name . '_address_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_address' )
		);


		//register_setting( $this->plugin_name, $this->option_name . '_position', array( $this, $this->option_name . '_sanitize_position' ) );
		register_setting( $this->plugin_name, $this->option_name . '_name', 'intval' );
		register_setting( $this->plugin_name, $this->option_name . '_address', 'intval' );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function upwork_task_general_cb() {
		echo '<p>' . __( 'Welcome.', 'upwork-task' ) . '</p>';
		echo '<p>' . __( 'Plugin Usage: please use [geo] shortcode on any post or page', 'upwork-task' ) . '</p>';
		echo '<p>' . __( 'Please change the settings accordingly.', 'upwork-task' ) . '</p>';
	}

	 

	/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function upwork_task_address_cb() {
		$address = get_option( $this->option_name . '_address' );
		echo '<input type="text" name="' . $this->option_name . '_address' . '" id="' . $this->option_name . '_address' . '" value="' . $address . '"> ';
	}

	/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function upwork_task_name_cb() {
		$name = get_option( $this->option_name . '_name' );
		echo '<input type="text" name="' . $this->option_name . '_name' . '" id="' . $this->option_name . '_name' . '" value="' . $name . '"> ';
	}

	/**
	 * Sanitize the text position value before being saved to database
	 *
	 * @param  string $position $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function upwork_task_sanitize_position( $position ) {
		if ( in_array( $position, array( 'before', 'after' ), true ) ) {
	        return $position;
	    }
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
		 * defined in Upwork_Task_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Upwork_Task_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/upwork-task-admin.js', array( 'jquery' ), $this->version, false );

	}

}
