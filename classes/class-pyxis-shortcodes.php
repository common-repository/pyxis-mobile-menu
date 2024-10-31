<?php
/**
 *
 * @package    Pyxis Mobile Menu
 * @subpackage Classes
 * @author     Press Cargo <david@presscargo.io>
 * @copyright  Copyright (c) 2020, Press Cargo 
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace PyxisMobileMenu;

/**
 * Shortcodes class.
 *
 * @since  1.0.0
 * @access public
 */
final class Shortcodes {
	/**
	 * The role name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $name = '';

	/**
	 * Return the role string in attempts to use the object as a string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_shortcodes' ), 20 );
	}

	/**
	 * Register shortcodes
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_shortcodes() {
		add_shortcode( 'pyxis-toggle', array( $this, 'toggle_shortcode' ) );
	}

	/**
	 * Display the menu toggle
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function toggle_shortcode( $atts = array() ) {
		return '<button class="pyxis-mobile-toggle"><span>Menu</span><div class="pyxis-mobile-toggle-bars"></div></button>';
	}
}

/**
 * Gets the instance of the `Shortcodes` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function shortcodes() {
	return Shortcodes::get_instance();
}

shortcodes();