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
 * Customizer Loader
 *
 * @since 1.0.0
 */
final class Customizer {
	
	/**
	 * Holds the instance of this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    object
	 */
	private static $instance;

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
		add_action( 'customize_preview_init', array( $this, 'preview_init' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_save_after', array( $this, 'customize_save' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_contextual' ) );
	}

	/**
	 * Register our customizer options.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_panel(
			'pyxis_panel',
			array(
				'title' => __( 'Pyxis Mobile Menu', 'pyxis-mobile-menu' ),
				'priority' => 30,
			)
		);
		require PC_PYXIS_DIR . 'customizer/controls/divider.php';
		require PC_PYXIS_DIR . 'customizer/sections/navbar/navbar.php';
		require PC_PYXIS_DIR . 'customizer/sections/flyout/flyout.php';
		require PC_PYXIS_DIR . 'customizer/sections/menu/menu.php';
	}

	/**
	 * Customizer preview init.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function preview_init() {
		PluginOptions::refresh();

		wp_enqueue_script( 'pyxis-customizer-preview', PC_PYXIS_URI . 'assets/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), null, '1.0.0' );
	}

	/**
	 * Customizer preview init.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function customizer_contextual() {
		PluginOptions::refresh();

		wp_enqueue_script( 'pyxis-customizer-contextual', PC_PYXIS_URI . 'assets/js/customizer-contextual.js', array( 'jquery', 'customize-controls' ), null, '1.0.0' );
	}

	/**
	 * Refresh the options on save.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function customize_save() {
		// Update variables.
		PluginOptions::refresh();
	}
}

$pyxis_customizer = Customizer::get_instance();