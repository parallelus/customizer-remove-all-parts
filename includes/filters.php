<?php
/**
 * @package     WP CRAP
 * @subpackage  Public Includes
 * @copyright   Copyright (c) 2015, Andy Wilkerson, Jesse Petersen
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Remove customize capability
 *
 * This needs to be in public so the admin bar link for 'customize' is hidden.
 */
function filter_to_remove_customize_capability( $caps = array(), $cap = '', $user_id = 0, $args = array() ) {
	if ($cap == 'customize')
		return false;

	return $caps;
}
add_filter( 'map_meta_cap', 'filter_to_remove_customize_capability', 10, 4 );