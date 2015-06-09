<?php
/**
 * @package     WP CRAP
 * @subpackage  Admin Includes
 * @copyright   Copyright (c) 2015, Andy Wilkerson, Jesse Petersen
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Drop some customizer actions
remove_action( 'plugins_loaded', '_wp_customize_include', 10);
remove_action( 'admin_enqueue_scripts', '_wp_customize_loader_settings', 10);

// Manually overriding specifc Customizer behaviors 
function override_load_customizer_action() {
	// If accessed directly
	wp_die( __( 'The Customizer is currently disabled.', 'wp-crap' ) );
}
add_action( 'load-customize.php', 'override_load_customizer_action' );



/**
 * Some custom functions to forcefuly remove references to the customizer
 */

/*
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
*/


/**
 * Some tests I did to try different filters
 */


/*

	// TESTING...
	function remove_customize_wp_role() {
		global $wp_roles; 

	    foreach (array_keys($wp_roles->roles) as $role) {
	        $wp_roles->remove_cap($role, 'customize');
	        print_r('<p>'.$role.'</p>');
	    }

		echo 'Current user can... '. current_user_can( 'customize' );
	}
	add_action( 'wp_loaded', 'remove_customize_wp_role' );

	// More testing
	function filter_to_remove_customize_user_has_cap( $allcaps = array(), $caps = array(), $args = array(), $user = array() ) {
		echo '<p><stropng>$allcaps </strong></p> <pre>'; print_r($allcaps ); echo '</pre>';
		echo '<p><stropng>$caps</strong></p> <pre>'; print_r($caps); echo '</pre>';
		echo '<p><stropng>$args</strong></p> <pre>'; print_r($args); echo '</pre>';
		echo '<p><stropng>$user</strong></p> <pre>'; print_r($user); echo '</pre>';
	}
	// $this->allcaps, $caps, $args, $this
	add_filter( 'user_has_cap', 'filter_to_remove_customize_user_has_cap', 4 );

	// Another Test filtering 'customize' capability
	function filter_to_remove_customize_capability_roll( $capabilities = array(), $cap = '', $name = '' ) {
		echo '<p><stropng>$capabilities</strong></p> <pre>'; print_r($capabilities); echo '</pre>';
		echo '<p><stropng>$cap</strong></p> <pre>'; print_r($cap); echo '</pre>';
		echo '<p><stropng>$name</strong></p> <pre>'; print_r($name); echo '</pre>';

		return array();
	}

	add_filter( 'role_has_cap', 'filter_to_remove_customize_capability_roll', 11, 3);

*/

