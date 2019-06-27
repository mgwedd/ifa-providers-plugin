<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://iotforall.com
 * @since      1.0.0
 *
 * @package    IFA_Providers
 * @subpackage IFA_Providers/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    IFA_Providers
 * @subpackage IFA_Providers/admin
 * @author     Your Name <email@example.com>
 */
class IFA_Providers_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $ifa_providers   The ID of this plugin.
	 */
	private $ifa_providers;

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
	 * @param      string    $ifa_providers       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $ifa_providers, $version ) {

		$this->ifa_providers = $ifa_providers;
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
		 * defined in IFA_Providers_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IFA_Providers_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->ifa_providers, plugin_dir_url( __FILE__ ) . 'css/ifa-providers-admin.css', array(), $this->version, 'all' );

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
		 * defined in IFA_Providers_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IFA_Providers_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->ifa_providers, plugin_dir_url( __FILE__ ) . 'js/ifa_providers-admin.js', array( 'jquery' ), $this->version, false );

	}

}
