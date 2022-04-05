<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/shahadul878
 * @since      1.0.0
 *
 * @package    Codereyes_Faq
 * @subpackage Codereyes_Faq/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Codereyes_Faq
 * @subpackage Codereyes_Faq/includes
 * @author     H M SHAHADUL ISLAM <shahadul.islam1@gmail.com>
 */
class Codereyes_Faq_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'codereyes-faq',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
