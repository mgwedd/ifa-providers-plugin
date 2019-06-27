<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://iotforall.com
 * @since      1.0.0
 *
 * @package    IFA_Providers
 * @subpackage IFA_Providers/includes
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
 * @package    IFA_Providers
 * @subpackage IFA_Providers/includes
 * @author     Michael Wedd <michael.wedd@leverege.com>
 */
class IFA_Providers {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      IFA_Providers_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $ifa_provider    The string used to uniquely identify this plugin.
	 */
	protected $ifa_provider;

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
		if ( defined( 'IFA_PROVIDERS_VERSION' ) ) {
			$this->version = IFA_PROVIDERS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->ifa_providers = 'ifa-providers';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		function register_provider_post_type() {

			$provider_labels = array(
				'name' => 'Provider',
				'add_new_item' => 'Add Provider',
				'edit_item' => 'Edit Provider',
				'update_item' => 'Update Provider',
				'view_item' => 'View This Provider', 
				'view_items' => 'View Providers',
				'search_items' => 'Search Providers',
				'not_found' => 'Provider Not Found',
				'not_found_in_trash' => 'Provider Not Found in Trash',
				'all_items' => 'All Providers',
				'singular_name' => 'Provider'
			);

			register_post_type('provider', array(
				'supports' => array('title', 'author', 'editor', 'thumbnail', 'revisions'),
				'rewrite' => array(
					'slug' => 'provider'
				),
				'public' => true, 
				'show_in_menu' => true,
				'show_in_rest' => true,
				'taxonomies'  => array( 'category', 'tag' ),
				'labels' => $provider_labels, 
				'menu_icon' => 'dashicons-groups'
			));

		add_action('init', 'register_provider_post_type');
		add_action('init', 'add_category_tags_to_providers');
		
		function add_category_tags_to_cpt() {
			register_taxonomy_for_object_type('category', 'provider');
			register_taxonomy_for_object_type('post_tag', 'provider');
		}

		// ===== SERVE PROVIDER TEMPLATE ====== //
		add_filter('single-provider', 'serve_ifa_provider_template');

		/* Filter the Provider template with this funciton. Serve the template file when the post type matches*/
		
		function serve_ifa_provider_template($single) {
			// DEBUG: The template file isn't being served when you visit a provider type page. 
			// So, either it's not filtering right or it is but it can't serve the single-provider file. 
			// figure that out.
			global $post;
			$pluginPath = plugin_dir_path( __FILE__ );
			/* Checks for single template by post type */
			if ( $post->post_type == 'provider' ) {
				if ( file_exists( $pluginPath . '/single-provider.php' ) ) {
					return $pluginFilepath . '/single-provider.php';
				} 
			}
			return $single;
		}
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - IFA_Providers_Loader. Orchestrates the hooks of the plugin.
	 * - IFA_Providers_i18n. Defines internationalization functionality.
	 * - IFA_Providers_Admin. Defines all hooks for the admin area.
	 * - IFA_Providers_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ifa-providers-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ifa-providers-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ifa-providers-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ifa-providers-public.php';

		$this->loader = new IFA_Providers_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the IFA_Providers_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new IFA_Providers_i18n();

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

		$plugin_admin = new IFA_Providers_Admin( $this->get_ifa_providers(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new IFA_Providers_Public( $this->get_ifa_providers(), $this->get_version() );

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
	public function get_ifa_providers() {
		return $this->ifa_providers;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    IFA_Providers_Loader    Orchestrates the hooks of the plugin.
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
