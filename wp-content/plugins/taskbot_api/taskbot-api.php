<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeforest.net/user/amentotech
 * @since             1.0.0
 * @package           Taskbot_Api
 *
 * @Taskbot REST API
 * Plugin Name:       Taskbot REST API
 * Plugin URI:        https://codecanyon.net/item/taskbot-a-freelancer-marketplace-wordpress-plugin/35344021
 * Description:       This plugin include REST API for Taskbot Mobile APPS
 * Version:           1.3
 * Author:            Amento Tech Pvt ltd
 * Author URI:        https://themeforest.net/user/amentotech
 * Text Domain:       taskbot-api
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
define( 'TASKBOT_API_VERSION', '1.3' );
define( 'TASKBOT_API_KEY', '1' );
define( 'TASKBOT_API_DIRECTORY', plugin_dir_path( __FILE__ ));
define( 'TASKBOT_API_URL', plugin_dir_url(__FILE__));


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-taskbot-api-activator.php
 */
function activate_taskbot_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-taskbot-api-activator.php';
	Taskbot_Api_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-taskbot-api-deactivator.php
 */
function deactivate_taskbot_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-taskbot-api-deactivator.php';
	Taskbot_Api_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_taskbot_api' );
register_deactivation_hook( __FILE__, 'deactivate_taskbot_api' );
require plugin_dir_path( __FILE__ ) . '/admin/api-settings/init.php';

$scan = glob(TASKBOT_API_DIRECTORY."/public/api/*");
foreach ( $scan as $path ) {
	include $path;
}

require plugin_dir_path( __FILE__ ) . 'public/mobile-checkout/init.php';
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-taskbot-api.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_taskbot_api() {

	$plugin = new Taskbot_Api();
	$plugin->run();

}
run_taskbot_api();
