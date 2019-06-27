<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       IFA Providers
 * Plugin URI:        http://iotforall.com/
 * Description:       Enable the "Providers" custom post type on IoT For All
 * Version:           1.0.0
 * Author:            IoT For All
 * Author URI:        http://github.com/mgwedd
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ifa-providers
 * Domain Path:       /languages
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
define( 'IFA_PROVIDERS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_ifa_providers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ifa-providers-activator.php';
	IFA_Providers_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_ifa_providers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ifa-providers-deactivator.php';
	IFA_Providers_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ifa_providers' );
register_deactivation_hook( __FILE__, 'deactivate_ifa_providers' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ifa-providers.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ifa_providers() {

	$plugin = new IFA_Providers();
	$plugin->run();

}
run_ifa_providers();
