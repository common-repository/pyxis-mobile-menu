<?php

/**
 *
 * @package    Pyxis Mobile Menu
 * @subpackage Classes
 * @author     The Beaver Builder Team
 * @copyright  Copyright: (c) 2014 Beaver Builder
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace PyxisMobileMenu;

class Filesystem {

	protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			/**
			 * Make Filesystem Instance filterable.
			 * @see pyxis_filesystem_instance
			 */
			$filtered        = apply_filters( 'pyxis_filesystem_instance', null );
			self::$_instance = $filtered instanceof Filesystem ? $filtered : new self();
		}
		return self::$_instance;
	}

	/**
	 * file_get_contents using wp_filesystem.
	 * @since 2.0.6
	 */
	function file_get_contents( $path ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->get_contents( $path );
	}

	/**
	 * is_writable using wp_filesystem.
	 * @since 2.1.2
	 */
	function is_writable( $path ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->is_writable( $path );
	}

	/**
	 * file_put_contents using wp_filesystem.
	 * @since 2.0.6
	 */
	function file_put_contents( $path, $contents ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->put_contents( $path, $contents, FS_CHMOD_FILE );
	}

	/**
	 * mkdir using wp_filesystem.
	 * @since 2.0.6
	 */
	function mkdir( $path ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->mkdir( $path );
	}

	/**
	 * is_dir using wp_filesystem.
	 * @since 2.0.6
	 */
	function is_dir( $path ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->is_dir( $path );
	}

	/**
	 * dirlist using wp_filesystem.
	 * @since 2.0.6
	 */
	function dirlist( $path ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->dirlist( $path );
	}

	/**
	 * move using wp_filesystem.
	 * @since 2.0.6
	 */
	function move( $old, $new ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->move( $old, $new );
	}

	/**
	 * rmdir using wp_filesystem.
	 * @since 2.0.6
	 */
	function rmdir( $path, $recursive = false ) {

		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->rmdir( $path, $recursive );
	}

	/**
	 * unlink using wp_filesystem.
	 * @since 2.0.6
	 */
	function unlink( $path ) {
		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->delete( $path );
	}

	/**
	 * unlink using wp_filesystem.
	 * @since 2.0.6
	 */
	function file_exists( $path ) {
		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->exists( $path );
	}

	/**
	 * filesize using wp_filesystem.
	 * @since 2.0.6
	 */
	function filesize( $path ) {
		$wp_filesystem = $this->get_filesystem();
		return $wp_filesystem->size( $path );
	}

	/**
	 * Return an instance of WP_Filesystem.
	 * @since 2.0.6
	 */
	function get_filesystem() {

		global $wp_filesystem;

		if ( ! $wp_filesystem || 'direct' != $wp_filesystem->method ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';

			/**
			 * Context for filesystem, default false.
			 * @see request_filesystem_credentials_context
			 */
			$context = apply_filters( 'request_filesystem_credentials_context', false );

			add_filter( 'filesystem_method', array( $this, 'filesystem_method' ) );
			add_filter( 'request_filesystem_credentials', array( $this, 'request_filesystem_credentials' ) );

			$creds = request_filesystem_credentials( site_url(), '', true, $context, null );

			WP_Filesystem( $creds, $context );

			remove_filter( 'filesystem_method', array( $this, 'filesystem_method' ) );
			remove_filter( 'request_filesystem_credentials', array( $this, 'FLBuilderUtils::request_filesystem_credentials' ) );
		}

		// Set the permission constants if not already set.
		if ( ! defined( 'PC_CHMOD_DIR' ) ) {
			define( 'PC_CHMOD_DIR', 0755 );
		}
		if ( ! defined( 'PC_CHMOD_FILE' ) ) {
			define( 'PC_CHMOD_FILE', 0644 );
		}

		return $wp_filesystem;
	}

	/**
	 * Sets method to direct.
	 * @since 2.0.6
	 */
	function filesystem_method() {
		return 'direct';
	}

	/**
	 * Sets credentials to true.
	 * @since 2.0.6
	 */
	function request_filesystem_credentials() {
		return true;
	}

}

/**
 * Setup singleton.
 * @since 2.0.6
 */
function filesystem() {
	return Filesystem::instance();
}
