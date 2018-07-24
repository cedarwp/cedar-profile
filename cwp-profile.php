<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://studiocedar.com
 * @since             1.0.0
 * @package           CWP_Profile
 *
 * @wordpress-plugin
 * Plugin Name:       CedarWP Profile
 * Plugin URI:        https://studiocedar.com/
 * Description:
 * Version:           1.0.0
 * Author:            Studio Cedar
 * Author URI:        https://studiocedar.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cwp-profile
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class_cwp-profile_activator.php
 */
function activate_cwp_profile() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class_cwp-profile_activator.php';
	CWP_Profile_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class_cwp-profile_deactivator.php
 */
function deactivate_cwp_profile() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class_cwp-profile_deactivator.php';
	CWP_Profile_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cwp_profile' );
register_deactivation_hook( __FILE__, 'deactivate_cwp_profile' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class_cwp-profile.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cwp_profile() {

	$plugin = new CWP_Profile();
	$plugin->run();

}
run_cwp_profile();
