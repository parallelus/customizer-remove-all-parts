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