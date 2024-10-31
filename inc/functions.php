<?php
use function \PyxisMobileMenu\PluginOptions\get_options as pyxis_get_plugin_options;

add_action( 'wp_footer', 'pyxis_mobile_menu_template' );
add_filter( 'body_class', 'pyxis_mobile_menu_body_class' );
add_filter( 'walker_nav_menu_start_el', 'pyxis_mobile_menu_start_el', 10, 4 );
add_filter( 'wp_nav_menu_items', 'pyxis_add_search', 99, 2 );

/**
 * Loads the menu and header templates.
 *
 * @since  1.0.0
 * @return void
 */
function pyxis_mobile_menu_template() {
	if ( ! pyxis_get_plugin_option( 'pyxis_plugin_options', 'manual_mode' ) ) {
		include PC_PYXIS_DIR . '/templates/header.php';
	}
	include PC_PYXIS_DIR . '/templates/menu.php';
}

/**
 * Filters the body class.
 *
 * @since  1.0.0
 * @return void
 */
function pyxis_mobile_menu_body_class( $classes ) {
	$options = pyxis_get_option( 'all' );

	$class = array();

	$class[] = $options['navbar_positioning'] == 'absolute' ? 'pyxis-navbar-positioning-absolute' : 'pyxis-navbar-positioning-fixed';

	$class[] = $options['toggle_type'] == 'button' ? 'pyxis-toggle-type-button' : 'pyxis-toggle-type-hamburger';

	$class[] = $options['toggle_location'] == 'right' ? 'pyxis-toggle-location-right' : 'pyxis-toggle-location-left';

	$class[] = $options['flyout_style'] == 'default' ? 'pyxis-flyout-style-default' : 'pyxis-flyout-style-full';

	return array_merge( $classes, $class );
}

/**
 * Filters the menu item output.
 *
 * @since  1.0.0
 * @return void
 */
function pyxis_mobile_menu_start_el( $item_output, $item, $depth, $args ) {

	if ( in_array( 'menu-item-has-children', $item->classes ) ) {
		$item_output = '<div class="menu-link-has-children">' . $item_output;
		$item_output .= '<span class="pyxis-submenu-toggle"></span></div>';
	} 

	return $item_output;
}

/**
 * Wrapper function around cmb2_get_option
 * @since  1.0.0
 * @param  string $group   Options for option group
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function pyxis_get_plugin_option( $group = 'pyxis_plugin_options', $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( $group, $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( $group, $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	}

	elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[$key] ) {
		$val = $opts[$key];
	}

	return $val;
}

function pyxis_get_option( $option, $default = '' ) {
	$plugin_options = PyxisMobileMenu\PluginOptions::get_options();

	if ( 'all' == $option ) return $plugin_options;

	$value = ( isset( $plugin_options[$option] ) && '' !== $plugin_options[$option] ) ? $plugin_options[$option] : $default;

	return $value;
}

function pyxis_add_search( $items, $args ) {
	$search_enabled = pyxis_get_plugin_option( 'pyxis_plugin_options', 'search_enabled' );

	if ( empty( $search_enabled ) || 'none' == $search_enabled ) return $items;

	if ( $args->theme_location != 'pyxis' ) return $items;

	$search_form = apply_filters( 'pyxis_search_form', get_search_form( array( 'echo' => false ) ) );

	if ( 'top' == $search_enabled ) {
		$items = $search_form . $items;	
	}

	else if ( 'bottom' == $search_enabled ) {
		$items .= $search_form;
	}

	return $items;
}