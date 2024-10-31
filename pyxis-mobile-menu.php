<?php
/**
 * Plugin Name: Pyxis Mobile Menu
 * Plugin URI:  https://presscargo.io/plugins/pyxis-mobile-menu
 * Description: A responsive mobile menu for your WordPress site.
 * Version:     1.1.3
 * Author:      Press Cargo
 * Author URI:  https://presscargo.io
 * Text Domain: pyxis-mobile-menu
 *
 * @package   PyxisMobileMenu
 * @version   1.1.1
 */

namespace PyxisMobileMenu;

/**
 * Setting up the class.
 *
 * @since  1.0.0
 * @access public
 */
final class Plugin {

	/**
	 * Minimum required PHP version.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	private $php_version = '5.6.0';

	/**
	 * Plugin directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir = '';

	/**
	 * Plugin directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $uri = '';

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
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
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
	private function __construct() {}

	/**
	 * Sets up globals.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup() {
		// Main plugin directory path and URI.
		$this->dir = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->uri = trailingslashit( plugin_dir_url( __FILE__ ) );
		$upload_dir = wp_upload_dir();

		define( 'PC_PYXIS_VERSION', '1.0.0' );
		define( 'PC_PYXIS_DIR', $this->dir );
		define( 'PC_PYXIS_URI', $this->uri );
		define( 'PC_PYXIS_CACHE_DIR', $upload_dir['path'] . '/pyxis-mobile-menu/' );
		define( 'PC_PYXIS_CACHE_URI', $upload_dir['url'] . '/pyxis-mobile-menu/' );
	}

	/**
	 * Loads files needed by the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {

		// Check if we meet the minimum PHP version.
		if ( version_compare( PHP_VERSION, $this->php_version, '<' ) ) {

			// Add admin notice.
			add_action( 'admin_notices', array( $this, 'php_admin_notice' ) );

			// Bail.
			return;
		}

		if ( file_exists( $this->dir . 'vendor/CMB2/init.php' ) ) {
			require_once $this->dir . 'vendor/CMB2/init.php';
		}

		require_once( $this->dir . 'inc/functions.php' );
		require_once( $this->dir . 'inc/functions-sanitize.php' );
		require_once( $this->dir . 'classes/class-pyxis-shortcodes.php' );
		require_once( $this->dir . 'classes/class-pyxis-customizer.php' );
		require_once( $this->dir . 'classes/class-pyxis-options.php' );
		require_once( $this->dir . 'classes/class-pyxis-css.php' );
		require_once( $this->dir . 'classes/class-pyxis-filesystem.php' );
		
		if ( is_admin() ) {
			require_once( $this->dir . 'classes/class-pyxis-admin.php' );
		}
	}

	/**
	 * Sets up main plugin actions and filters.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		// Init hooks
		add_action( 'init', array( $this, 'init' ), 1 );

		// Internationalize the text strings used.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 99 );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );

		// Register activation hook.
		register_activation_hook( __FILE__, array( $this, 'activation' ) );

		// Register deactivation hook
		register_activation_hook( __FILE__, array( $this, 'deactivation' ) );
	}

	/**
	 * Init hooks
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function init() {
		register_nav_menu( 'pyxis', __( 'Pyxis Mobile Menu', 'pyxis-mobile-menu' ) );
	}

	/**
	 * Enqueues scripts styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_style( 'pyxis-mobile-menu', PC_PYXIS_URI . 'assets/css/style.min.css', array(), PC_PYXIS_VERSION );

		wp_enqueue_style( 'pyxis-mobile-menu-custom', PC_PYXIS_CACHE_URI . 'style.css', array(), PC_PYXIS_VERSION );

		wp_enqueue_script( 'body-scroll-lock', PC_PYXIS_URI . 'assets/js/bodyScrollLock.min.js', array( 'jquery' ), '3.0.3', true );

		wp_enqueue_script( 'pyxis-mobile-menu', PC_PYXIS_URI . 'assets/js/script.js', array( 'jquery' ), PC_PYXIS_VERSION, true );
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function i18n() {

		load_plugin_textdomain( 'pyxis-mobile-menu', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . 'lang' );
	}

	/**
	 * Method that runs only when the plugin is activated.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function activation() {

		// Check PHP version requirements.
		if ( version_compare( PHP_VERSION, $this->php_version, '<' ) ) {

			// Make sure the plugin is deactivated.
			deactivate_plugins( plugin_basename( __FILE__ ) );

			// Add an error message and die.
			wp_die( $this->get_min_php_message() );
		}

		if ( ! filesystem()->file_exists( PC_PYXIS_CACHE_DIR . 'style.css' ) ) {

			// Create the directory.
			filesystem()->mkdir( PC_PYXIS_CACHE_DIR );

			// Add an index file for security.
			filesystem()->file_put_contents( PC_PYXIS_CACHE_DIR . 'index.html', '' );
			filesystem()->file_put_contents( PC_PYXIS_CACHE_DIR . 'style.css', '' );
		}
	}

	/**
	 * Method that runs only when the plugin is deactivated.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function deactivation() {

	}

	/**
	 * Deactivates this plugin, hook this function on admin_init.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function deactivate() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}

	/**
	 * Check if the plugin meets requirements and
	 * disable it if they are not present.
	 *
	 * @since 1.0.0
	 * @return boolean result of meets_requirements
	 */
	public function check_requirements() {
		if ( ! $this->meets_requirements() ) {

			// Add a dashboard notice.
			add_action( 'admin_notices', array( $this, 'get_requirements_not_met_notice' ) );

			// Deactivate our plugin.
			add_action( 'admin_init', array( $this, 'deactivate' ) );

			return false;
		}

		return true;
	}

	/**
	 * Check that all plugin requirements are met
	 *
	 * @since  1.0.0
	 * @return boolean True if requirements are met.
	 */
	public static function meets_requirements() {
		// Do checks for required classes / functions
		// function_exists('') & class_exists('').

		// We have met all requirements.
		return true;
	}

	public function get_requirements_not_met_notice() {
		echo '<div id="message" class="error"><p>';

		// Returns a message noting the minimum version of PHP required.		
		if ( version_compare( PHP_VERSION, $this->php_version, '<' ) ) {
			echo sprintf(
				__( 'Pyxis Mobile Menu requires PHP version %1$s. You are running version %2$s. Please upgrade and try again.', 'pyxis-mobile-menu' ),
				$this->php_version,
				PHP_VERSION
			);
		}

		echo '</p></div>';
	}

	/**
	 * Returns a message noting the minimum version of PHP required.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function get_min_php_message() {

		return sprintf(
			__( 'Pyxis Mobile Menu requires PHP version %1$s. You are running version %2$s. Please upgrade and try again.', 'pyxis-mobile-menu' ),
			$this->php_version,
			PHP_VERSION
		);
	}

	/**
	 * Outputs the admin notice that the user needs to upgrade their PHP version. It also
	 * auto-deactivates the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function php_admin_notice() {

		// Output notice.
		printf(
			'<div class="notice notice-error is-dismissible"><p><strong>%s</strong></p></div>',
			esc_html( $this->get_min_php_message() )
		);

		// Make sure the plugin is deactivated.
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
}

/**
 * Gets the instance of the `Plugin` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function plugin() {
	return plugin::get_instance();
}

plugin();