<?php

namespace widget;

use widget\SSW_Widget;
use widget\SSW_Form;
use widget\SSW_Update;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    SSW
 * @subpackage SSW/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */

class SSW_Widget_Main extends \WP_Widget {

	use SSW_Widget, SSW_Form, SSW_Update;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {
		parent::__construct( 
			strtolower( __CLASS__ ), 
			'Simple Social Widget',
			array( 
				'description'=>'Easily show your social badges.', 
			) );

		add_action( "widgets_init", [ $this, "init_social_simple_widget" ] );
	
	}

	

	public function init_social_simple_widget() {
		register_widget( __CLASS__ );
	}

	

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in SSW_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The SSW_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/ssw.build.css', array(), SSW_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in SSW_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The SSW_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/ssw.build.js', array(  ), SSW_VERSION, false );

	}

}
