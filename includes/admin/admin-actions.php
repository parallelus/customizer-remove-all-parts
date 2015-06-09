<?php
/**
 * Front-End Actions
 *
 * @package
 * @subpackage  Includes
 * @copyright   Copyright (c) 2015, Andy Wilkerson, Jesse Petersen
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

remove_action( 'plugins_loaded', '_wp_customize_include', 10);
remove_action( 'admin_enqueue_scripts', '_wp_customize_loader_settings', 10);

// Manually overriding specifc Customizer behaviors 
function override_load_customizer_action() {
	// If accessed directly
	wp_die( __( 'The Customizer is currently disabled.', 'wp-crap' ) );
}
add_action( 'load-customize.php', 'override_load_customizer_action' );


	// Remove 'Customize' from Admin menu
	function remove_submenus() {
		global $submenu;
		// Appearance Menu
		unset($submenu['themes.php'][6]); // Customize
	}
	add_action('admin_menu', 'remove_submenus');

	// Remove 'Customize' from the Toolbar -front-end
	function remove_admin_bar_links() {
	    global $wp_admin_bar;
	    $wp_admin_bar->remove_menu('customize');
	}
	add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

	// Add Custom CSS to Back-end head
	function remove_customize_admin_links() {
		echo '<style type="text/css">#customize-current-theme-link { display:none; } </style>';
	}
	add_action('admin_head', 'remove_customize_admin_links');