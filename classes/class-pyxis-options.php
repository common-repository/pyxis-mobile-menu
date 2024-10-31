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
 * Plugin Options.
 *
 * @since  1.0.0
 * @access public
 */
final class PluginOptions {
	/**
	 * Holds the instance of this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    object
	 */
	private static $instance;

	/**
	 * A static option variable.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var mixed $db_options
	 */
	private static $db_options;

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {
		// Refresh options variables after customizer save.
		add_action( 'after_setup_theme', array( $this, 'refresh' ) );
	}

	/**
	 * Get the theme defaults.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return array
	 */
	public static function get_defaults() {
		return apply_filters(
			'pyxis_defaults',
			array(
				'navbar_breakpoint' => 768,
				'navbar_positioning' => 'absolute',
				'navbar_bg_color' => '#000000',
				'navbar_title_color' => '#ffffff',
				'navbar_title_font_size' => 16,
				'toggle_location' => 'left',
				'toggle_type' => 'hamburger',
				'hamburger_width' => 24,
				'hamburger_bar_height' => 2,
				'hamburger_bar_interval'=> 8,
				'hamburger_color' => '#ffffff',
				'menu_button_color' => '#ffffff',
				'menu_button_bg_color' => '#0000ff',
				'flyout_style' => 'default',
				'flyout_bg_color' => '#000000',
				'flyout_close_color' => '#ffffff',
				'flyout_close_size' => 12,
				'flyout_close_bar_thickness' => 2,
				'menu_link_color' => '#ffffff',
				'menu_link_font_size' => 16,
				'submenu_arrow_width' => 6,
				'submenu_arrow_thickness' => 2
			)
		);
	}

	/**
	 * Get the theme options.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function get_options() {
		return self::$db_options;
	}

	/**
	 * Update the theme options.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function refresh() {
		self::$db_options = wp_parse_args(
			get_option( 'pyxis_options' ),
			self::get_defaults()
		);
	}
}

$pyxis_options = PluginOptions::get_instance();