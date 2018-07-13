<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://studiocedar.com
 * @since      1.0.0
 *
 * @package    Cedar_WP_Profile
 * @subpackage Cedar_WP_Profile/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cedar_WP_Profile
 * @subpackage Cedar_WP_Profile/includes
 * @author     Stephan Smith <stephan@stuciocedar.com>
 */
class Cedar_WP_Profile_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cedar_wp_profile',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
