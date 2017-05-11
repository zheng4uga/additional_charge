<?php
/**
 * @package AddtionalCharge
 */
/*
Plugin Name: Additional Charge
Plugin URI: http://www.fyminds.com
Description: A Woocommerce plugin that will output a radio container that will allow customer to add addtional charge to their cart. This is ideal to be use for delivery tip.
Version: 1.0
Author: Yong Qui Zheng
Author URI: http://www.fyminds.com
License: GPLv2 or later
Text Domain: addtional_charge
*/

/*
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

Copyright 2005-2015 Automattic, Inc.
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'ADDITIONAL_CHARGE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ADDITIONAL_CHARGE_DELETE_LIMIT', 100000 );

register_activation_hook( __FILE__, array( 'AdditionalCharge', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'AdditionalCharge', 'plugin_deactivation' ) );

require_once( ADDITIONAL_CHARGE__PLUGIN_DIR . 'class.additionalcharge.php' );

add_action( 'init', array( 'AdditionalCharge', 'init' ) );

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( ADDITIONAL_CHARGE__PLUGIN_DIR . 'class.additionalcharge-admin.php' );
	add_action( 'init', array( 'AdditionalCharge_Admin', 'init' ) );
}
