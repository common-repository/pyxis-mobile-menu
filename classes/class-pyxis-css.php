<?php
/**
 *
 * @package    Pyxis Mobile Menu
 * @subpackage Classes
 * @author     Press Cargo <david@presscargo.io>
 * @copyright  Copyright (c) 2020, Press Cargo
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace PyxisMobileMenu;

/**
 * CSS class.
 *
 * @since  1.0.0
 * @access public
 */
final class CSS {
	/**
	 * Initialize the class.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

	}

	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Sets up class actions and filters.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		add_action( 'customize_save_after', array( $this, 'render' ) );
		add_action( 'wp_head', array( $this, 'render_embedded' ) );
		add_action( 'embed_head', array( $this, 'render_embedded' ), 25 );
	}

	/**
	 * Outputs the CSS in our uploads directory.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function render() {
		$options = pyxis_get_option( 'all' );

		$css = '';

		// Navbar
		$css .= '#pyxis-mobile-header {';
			if ( isset( $options['navbar_bg_color'] ) ) {
				$css .= 'background-color: ' . $options['navbar_bg_color'] . ';';
			}

			if ( isset( $options['navbar_title_color'] ) ) {
				$css .= 'color: ' . $options['navbar_title_color'] . ';';
			}
		$css .= '}';

		$css .= '#pyxis-mobile-header .pyxis-mobile-main {';
			if ( isset( $options['navbar_title_font_size'] ) ) {
				$css .= 'font-size: ' . $options['navbar_title_font_size'] . 'px;';
			}
		$css .= '}';

		// Hamburger
		$css .= '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars {';
			if ( isset( $options['hamburger_color'] ) ) {
				$css .= 'background-color: ' . $options['hamburger_color'] . ';';
			}

			if ( isset( $options['hamburger_bar_width'] ) ) {
				$css .= 'width: ' . $options['hamburger_bar_width'] . 'px;';
			}
		$css .= '}';

		$css .= '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::before {';
			if ( isset( $options['hamburger_bar_interval'] ) ) {
				$css .= 'transform: translateY(-' . $options['hamburger_bar_interval'] . 'px);';
			}
		$css .= '}';

		$css .= '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::after {';
			if ( isset( $options['hamburger_bar_interval'] ) ) {
				$css .= 'transform: translateY(' . $options['hamburger_bar_interval'] . 'px);';
			}
		$css .= '}';

		$css .= '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::before, .pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::after {';
			if ( isset( $options['hamburger_color'] ) ) {
				$css .= 'background-color: ' . $options['hamburger_color'] . ';';
			}
		$css .= '}';

		// Menu Button
		$css .= '.pyxis-toggle-type-button .pyxis-mobile-toggle {';
			if ( isset( $options['menu_button_color'] ) ) {
				$css .= 'color: ' . $options['menu_button_color'] . ';';
			}

			if ( isset( $options['menu_button_bg_color'] ) ) {
				$css .= 'background-color: ' . $options['menu_button_bg_color'] . ';';
			}
		$css .= '}';

		// Flyout
		if ( isset( $options['flyout_bg_color'] ) ) {
			$css .= '#pyxis-mobile-menu-container { background-color: ' . $options['flyout_bg_color'] . '; }';
		}

		if ( isset( $options['flyout_close_color'] ) ) {
			$css .= '#pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::after, #pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::before { background-color: ' . $options['flyout_close_color'] . '; }';
		}
		
		if ( isset( $options['flyout_close_size'] ) ) {
			$css .= '#pyxis-mobile-menu-container .pyxis-mobile-close { width: ' . $options['flyout_close_size'] . 'px; }';
		}

		if ( isset( $options['flyout_close_bar_thickness'] ) ) {
			$css .= '#pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::after, #pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::before { height: ' . $options['flyout_close_bar_thickness'] . 'px; }';
		}

		$css .= '#pyxis-mobile-menu-container ul.menu li a {';
			if ( isset( $options['menu_link_color'] ) ) {
				$css .= 'color: ' . $options['menu_link_color'] . ';';
			}

			if ( isset( $options['menu_link_font_size'] ) ) {
				$css .= 'font-size: ' . $options['menu_link_font_size'] . 'px;';
			}
		$css .= '}';

		// Submenu Indicator
		$css .= '#pyxis-mobile-menu-container .pyxis-submenu-toggle::after {';
			if ( isset( $options['menu_link_color'] ) ) {
				$css .= 'border-color: ' . $options['menu_link_color'] . ';';
			}

			if ( isset( $options['submenu_arrow_width'] ) ) {
				$hypotenuse = $options['submenu_arrow_width'];
				$triangle_side = sqrt( pow( $hypotenuse, 2 ) / 2 );
				$triangle_height = sqrt( pow( $triangle_side, 2 ) - pow( $hypotenuse / 2, 2 ) );

				$css .= 'width: ' . $triangle_side . 'px;';
				$css .= 'height: ' . $triangle_side . 'px;';
				$css .= 'transform: translate(-50%, -' . $triangle_height * 1.1 . 'px) rotate(45deg);'; 
			}

			if ( isset( $options['submenu_arrow_thickness'] ) ) {
				$css .= 'border-width: 0 ' . $options['submenu_arrow_thickness'] . 'px ' . $options['submenu_arrow_thickness'] . 'px 0;';
			}
		$css .= '}';
		


		if ( ! filesystem()->file_exists( PC_PYXIS_CACHE_DIR ) ) {

			// Create the directory.
			filesystem()->mkdir( PC_PYXIS_CACHE_DIR );

			// Add an index file for security.
			filesystem()->file_put_contents( PC_PYXIS_CACHE_DIR . 'index.html', '' );
		}

		filesystem()->file_put_contents( PC_PYXIS_CACHE_DIR . 'style.css', $css );
	}

	/**
	 * Outputs the CSS as an embedded stylesheet.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function render_embedded() {

		$breakpoint = pyxis_get_option( 'navbar_breakpoint', 768 );
		$menu_selector = pyxis_get_plugin_option( 'pyxis_plugin_options', 'theme_menu_selector' );
		$compat_mode = pyxis_get_plugin_option( 'pyxis_plugin_options', 'compat_mode' );

		$css = '';

		if ( $breakpoint <= 9999 && ! $compat_mode ) {
			$css .= '@media only screen and (min-width: ' . $breakpoint . 'px) {';

				$css .= '#pyxis-mobile-header { display: none; }';

			$css .= '}';

			$css .= '@media only screen and (max-width: ' . ( $breakpoint - 1 ) . 'px) {';

				$css .= 'body { padding-top: 48px !important }';

				if ( $menu_selector ) {
					$css .= $menu_selector . '{ display: none !important; }';
				}

				if ( ! $compat_mode ) {
					$css .= '.nav, .navbar, .main-navigation, .genesis-nav-menu, #main-header, #et-top-navigation, #site-header, .site-header, .site-branding, .ast-mobile-menu-buttons, .ast-mobile-header-inline, .storefront-handheld-footer-bar, .hide { display: none !important; }';
				}

			$css .= '}';
		}

		// Put the final style output together.
		$style = "\n" . '<style type="text/css" id="pyxis-mobile-menu-custom-embedded-css">' . trim( $css ) . '</style>' . "\n";

		// Output the custom style.
		echo $style;
	}

}

/**
 * Gets the instance of the `CSS` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function css() {
	return CSS::get_instance();
}

css();