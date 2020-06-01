<?php

use includes\SSW;
use includes\SSW_Activator;
use includes\SSW_Deactivator;

/*
* Plugin Name: Social Simple Widget
* Description: Show social icons
* Author: mrinal013
* Author URI: https://mrinalbd.com
* Version: 3.0.0
* License: GPLv3
* Text Domain: social-simple-widget


Social Simple Widget is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Social Simple Widget is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Social Simple Widget. If not, see http://www.gnu.org/licenses/gpl-3.0.html.
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define constants
 */
define( 'SSW_VERSION', '3.0.0' );
define( 'TEXTDOMAIN', 'social-simple-widget' );

/**
 * The main class that is used to define necessary operation of run this plugin.
 */

class Social_Simple_Widget {

	public function __construct() {
		$this->ssw_operation();	
	}

	public function ssw_operation() {
		register_activation_hook( __FILE__, [ $this, 'activate_ssw' ] );
		register_deactivation_hook( __FILE__, [ $this, 'deactivate_ssw' ] );
		$this->ssw_autoload();
		( new SSW() )->run();
	}

	/**
	 * Autoload all files depend on demand
	 */
	public function ssw_autoload() {
		spl_autoload_register( function( $class ) {
			$file_name = plugin_dir_path( __FILE__ ) . str_replace( '\\', DIRECTORY_SEPARATOR, substr_replace( str_replace( '_', '-', strtolower( $class ) ), 'class-', strpos( $class, '\\', 0 ) + 1, 0 ) ) . '.php';

			if( file_exists( $file_name ) ) {
				require $file_name;
			}
		} );

		spl_autoload_register( function( $trait ) {
			$file_name = plugin_dir_path( __FILE__ ) . str_replace( '\\', DIRECTORY_SEPARATOR, substr_replace( str_replace( '_', '-', strtolower( $trait ) ), 'trait-', strpos( $trait, '\\', 0 ) + 1, 0 ) ) . '.php';

			if( file_exists( $file_name ) ) {
				require $file_name;
			}
		} );
	}

	/**
	 * The method runs during plugin activation.
	 * This action is documented in includes/class-ssw-activator.php
	 */
	function activate_ssw() {
		SSW_Activator::activate();
	}

	/**
	 * The method runs during plugin deactivation.
	 * This action is documented in includes/class-ssw-deactivator.php
	 */
	function deactivate_ssw() {
		SSW_Deactivator::deactivate();
	}
		
}

new Social_Simple_Widget();