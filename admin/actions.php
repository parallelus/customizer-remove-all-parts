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

// Manually overriding specific Customizer behaviors
function override_load_customizer_action() {
	// If accessed directly
	wp_die( __( 'The Customizer is currently disabled.', 'wp-crap' ) );
}
add_action( 'load-customize.php', 'override_load_customizer_action' );

