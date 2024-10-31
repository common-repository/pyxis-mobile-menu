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
 * Admin class.
 *
 * @since  1.0.0
 * @access public
 */
final class Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	public $options_page = 'pyxis_mobile';

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
		add_filter( 'plugin_action_links_pyxis-mobile-menu/pyxis-mobile-menu.php', array( $this, 'add_settings_links' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_ajax_pyxis_reset_options', array( $this, 'reset_options' ) );
		add_action( 'cmb2_admin_init', array( $this, 'register_main_options_metabox' ) );
		add_action( 'cmb2_render_menu_code', array( $this, 'cmb2_render_callback_for_menu_code' ), 10, 5 );
		add_action( 'cmb2_render_intro', array( $this, 'cmb2_render_callback_for_intro' ), 10, 5 );
		add_action( 'cmb2_render_reset', array( $this, 'cmb2_render_callback_for_reset' ), 10, 5 );
	}

	/**
	 * Add links to the actions links list in the plugin list table.
	 *
	 * @param array $links Links array for the current plugin.
	 */
	public static function add_settings_links( $links ) {
		array_unshift(
			$links,
			sprintf( '<a href="%1$s">%2$s</a>',
				esc_url( admin_url( 'options-general.php?page=pyxis_plugin_options' ) ),
				esc_html__( 'Settings', 'pyxis-mobile-menu' )
			),
			sprintf( '<a href="%1$s">%2$s</a>',
				esc_url( admin_url( '/customize.php?autofocus[panel]=pyxis_panel' ) ),
				esc_html__( 'Customize', 'pyxis-mobile-menu' )
			)
		);
		return $links;
	}

	/**
	 * Enqueue a script in the WordPress admin.
	 *
	 * @param int $hook Hook suffix for the current admin page.
	 */
	public static function enqueue( $hook ) {
		if ( 'settings_page_pyxis_plugin_options' != $hook ) {
			return;
		}
		wp_enqueue_script( 'pyxis-admin', PC_PYXIS_URI . 'assets/js/admin.js', array( 'jquery' ), '1.0.0' );
		wp_localize_script( 'pyxis-admin', 'pyxis', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'pyxis_nonce' )
		) );

	    wp_enqueue_style( 'pyxis-admin', PC_PYXIS_URI . 'assets/css/admin.css', array(), '1.0.0' );
	}

	/**
	 * Hook in and register a metabox to handle a theme options page and adds a menu item.
	 */
	public static function register_main_options_metabox() {

		$args = array(
			'id'           => 'pyxis_plugin_options_page',
			'title'        => __( 'Pyxis Mobile Menu', 'pyxis-mobile-menu' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'pyxis_plugin_options',
			'parent_slug'  => 'options-general.php',
			'capability'   => 'manage_options'
		);

		/**
		 * Registers main options page menu item and form.
		 */
		$main_options = new_cmb2_box( $args );

		$main_options->add_field( array(
			'name' => __( 'Intro', 'pyxis-mobile-menu' ),
			'id'   => 'intro',
			'type' => 'intro',
		) );

		$main_options->add_field( array(
			'name' => __( 'Manual Mode', 'pyxis-mobile-menu' ),
			'desc' => __( 'Enable manual mode to place the toggle via shortcode. The top navbar will not be shown.', 'pyxis-mobile-menu' ),
			'id'   => 'manual_mode',
			'type' => 'checkbox',
		) );

		$main_options->add_field( array(
			'name' => __( 'Custom Toggle Code', 'pyxis-mobile-menu' ),
			'id'   => 'custom_shortcode',
			'type' => 'menu_code'
		) );

		$main_options->add_field( array(
			'name' => __( 'Add Search', 'pyxis-mobile-menu' ),
			'desc' => __( 'Choose whether search is included in the menu.', 'pyxis-mobile-menu' ),
			'id'   => 'search_enabled',
			'type' => 'select',
			'show_option_none' => false,
			'default' => 'none',
			'options' => array(
				'none' => __( 'No Search', 'pyxis-mobile-menu' ),
				'top' => __( 'Top of Menu', 'pyxis-mobile-menu' ),
				'bottom' => __( 'Bottom of Menu', 'pyxis-mobile-menu' ),
			),
		) );

		$main_options->add_field( array(
			'name' => __( 'Compatibility Mode', 'pyxis-mobile-menu' ),
			'desc' => __( 'Enable compatibility mode to disable all plugin CSS rules that target the themes header. Then use the "Hide Theme Menu" option below to add your selector', 'pyxis-mobile-menu' ),
			'id'   => 'compat_mode',
			'type' => 'checkbox',
		) );

		$main_options->add_field( array(
			'name' => __( 'Hide Theme Menu', 'pyxis-mobile-menu' ),
			'desc' => __( 'Enter the selector of the theme\'s header/menu, e.g. <code>#primary-menu</code>', 'pyxis-mobile-menu' ),
			'id'   => 'theme_menu_selector',
			'type' => 'text',
		) );

		$main_options->add_field( array(
			'name' => __( 'Danger Zone', 'pyxis-mobile-menu' ),
			'id'   => 'danger_zone',
			'type' => 'reset'
		) );
	}

	public static function reset_options() {
		if ( check_admin_referer( 'pyxis_nonce', 'nonce' ) && current_user_can( 'administrator' ) ) {
			delete_option( 'pyxis_options' );
			delete_option( 'pyxis_plugin_options' );
		}

		wp_die();
	}

	public static function cmb2_render_callback_for_intro( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
		echo 'Style options can be found in the <a href="' . admin_url( '/customize.php?autofocus[panel]=pyxis_panel' ) . '">Customizer</a>';
	}

	public static function cmb2_render_callback_for_menu_code( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
		echo 'When manual mode is enabled, you can use the shortcode <code>[pyxis-toggle]</code> to place the toggle wherever you want.';
	}

	public static function cmb2_render_callback_for_reset( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
		echo '<div class="button button-warning">' . __( 'Reset Settings', 'pyxis-mobile-menu' ) . '</div><br /><span class="cmb2-metabox-description">Resets all Pyxis customizer and plugins settings. Your theme settings will not be affected</span>';
	}
}

/**
 * Gets the instance of the `Admin` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function admin() {
	return Admin::get_instance();
}

admin();