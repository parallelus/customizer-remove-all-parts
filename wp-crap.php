<?php
/*
Plugin Name: Customizer Remove All Parts (WP CRAP)
Plugin URI: https://github.com/parallelus/WP-CRAP
Description: Completely removes the WordPress Customizer from loading in your install.
Version: 1.0.1
Author: Andy Wilkerson, Jesse Petersen
Author URI: http://parallelus.github.io/WP-CRAP/
Text Domain: wp-crap
Domain Path: /languages

Copyright 2015 Andy Wilkerson, Jesse Petersen.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

// Exit if accessed directly
if ( __FILE__ == $_SERVER['SCRIPT_FILENAME'] ) { exit; }


if (!class_exists('Customizer_Remove_All')) :
class Customizer_Remove_All {

	/**
	 * @var Customizer_Remove_All
	 */
	private static $instance;


	/**
	 * Main Instance
	 *
	 * Allows only one instance of Customizer_Remove_All in memory, and needing to define 
	 * lots of globals.
	 *
	 * @static
	 * @staticvar array $instance
	 * @return Big mama, Customizer_Remove_All
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Customizer_Remove_All ) ) {
			
			// Start your engines!
			self::$instance = new Customizer_Remove_All;

			// Load the class structures to trigger initially
			self::$instance->setup_constants();
			self::$instance->includes();

			// Tell 
			register_activation_hook( __FILE__, 'crap_plugin_activation' );
			add_action( 'plugins_loaded', array( self::$instance, 'load_languages' ) );
			add_action( 'init', array( self::$instance, 'init' ), 10 ); // was priority 5
			add_action( 'admin_init', array( self::$instance, 'admin_init' ), 10 ); // was priority 5
		}
		return self::$instance;
	}

	/**
	 * Run all plugin stuff on init.
	 * 
	 * @return void
	 */
	public function init() {
		// Get the plugin settings.
		$this->plugin_settings = $this->get_plugin_settings();

		// Fire the plugin init action so other plugins can register items.
		do_action( 'crap_init', $this );
	}

	/**
	 * Run all of our plugin stuff on admin init.
	 *
	 * @return void
	 */
	public function admin_init() {

		// Fire init action.
		do_action( 'crap_admin_init', $this );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @return void
	 */
	private function setup_constants() {
		global $wpdb;

		// Plugin version
		if ( ! defined( 'CRAP_PLUGIN_VERSION' ) )
			define( 'CRAP_PLUGIN_VERSION', '0.1' );

		// Plugin Folder Path
		if ( ! defined( 'CRAP_PLUGIN_DIR' ) )
			define( 'CRAP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL
		if ( ! defined( 'CRAP_PLUGIN_URL' ) )
			define( 'CRAP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File
		if ( ! defined( 'CRAP_PLUGIN_FILE' ) )
			define( 'CRAP_PLUGIN_FILE', __FILE__ );
	}

	/**
	 * Include files
	 *
	 * @access private
	 * @return void
	 */
	private function includes() {
		// Include resources
		require_once( CRAP_PLUGIN_DIR . 'includes/filters.php' );


		if ( is_admin () ) {
			// Include admin only resources.
			require_once( CRAP_PLUGIN_DIR . 'admin/actions.php' );
		}

	}

	/**
	 * Load our language files
	 *
	 * @access public
	 * @return void
	 */
	public function load_languages() {
		/** Set our unique textdomain string */
		$textdomain = 'wp-crap';

		/** The 'plugin_locale' filter is also used by default in load_plugin_textdomain() */
		$locale = apply_filters( 'plugin_locale', get_locale(), $textdomain );

		/** Set filter for WordPress languages directory */
		$wp_languages_dir = apply_filters(
			'crap_wp_languages_dir',
			WP_LANG_DIR . '/wp-crap/' . $textdomain . '-' . $locale . '.mo'
		);

		/** Translations: First, look in WordPress' "languages" folder */
		load_textdomain( $textdomain, $wp_languages_dir );

		/** Translations: Next, look in plugin's "languages" folder (default) */
		$plugin_dir = basename( dirname( __FILE__ ) );
		$languages_dir = apply_filters( 'crap_languages_dir', $plugin_dir . '/languages' );
		load_plugin_textdomain( $textdomain, FALSE, $languages_dir );
	}

	/**
	 * Get our plugin settings.
	 *
	 * @access public
	 * @return array $settings
	 */
	public function get_plugin_settings() {

		// Get the settings
		$settings = apply_filters( "crap_settings", get_option( "crap_settings" ) );

		// Apply additional filers...
		// $settings['some_value'] = apply_filters( 'crap_settings/some_value', $settings['some_value'] );

		return $settings;
	}


} // End Class
endif;

/**
* The main function responsible for returning the one true Customizer_Remove_All
* Instance to functions everywhere.
*
* Use this function like you would a global variable, except without needing
* to declare the global.
*
* @return object The one true Customizer_Remove_All Instance
*/
function Customizer_Remove_All() {
	return Customizer_Remove_All::instance();
}

// GO!
Customizer_Remove_All();