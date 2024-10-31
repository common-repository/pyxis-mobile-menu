<?php
/**
 *
 * @package    Pyxis Mobile Menu
 * @subpackage Classes
 * @author     Press Cargo <david@presscargo.io>
 * @copyright  Copyright (c) 2020, Press Cargo
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * ================================
 * Section: Menu
 * ================================ 
 */
$wp_customize->add_section(
	'pyxis_panel_section_menu',
	array(
		'title' => __( 'Menu', 'pyxis-mobile-menu' ),
		'panel' => 'pyxis_panel',
	)
);

/*
 * Setting: Menu Link Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[menu_link_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'menu_link_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[menu_link_color]',
		array(
			'label'    => __( 'Menu Link Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_menu',
			'settings' => 'pyxis_options[menu_link_color]',
			'priority' => 10,
		)
	)
);

/*
 * Setting: Menu Link Font Size
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[menu_link_font_size]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'menu_link_font_size' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[menu_link_font_size]',
	array(
		'type' => 'number',
		'label'    => __( 'Menu Link Font Size', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_menu'
	)
);

/*
 * Setting: Submenu Arrow Width
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[submenu_arrow_width]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'submenu_arrow_width' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[submenu_arrow_width]',
	array(
		'type' => 'number',
		'label'    => __( 'Submenu Arrow Width', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_menu'
	)
);

/*
 * Setting: Submenu Arrow Thickness
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[submenu_arrow_thickness]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'submenu_arrow_thickness' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[submenu_arrow_thickness]',
	array(
		'type' => 'number',
		'label'    => __( 'Submenu Arrow Thickness', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_menu'
	)
);