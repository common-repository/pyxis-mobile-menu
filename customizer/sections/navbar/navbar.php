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
 * Section: Navbar
 * ================================ 
 */
$wp_customize->add_section(
	'pyxis_panel_section_navbar',
	array(
		'title' => __( 'Navbar', 'pyxis-mobile-menu' ),
		'panel' => 'pyxis_panel',
	)
);

/*
 * Setting: Navbar Breakpoint
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[navbar_breakpoint]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'navbar_breakpoint' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[navbar_breakpoint]',
	array(
		'type' => 'number',
		'label'    => __( 'Navbar Breakpoint', 'pyxis-mobile-menu' ),
		'description' => __( 'Breakpoint in pixels. The mobile menu will show for window sizes smaller than this value. Use 9999 to always display.', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_navbar'
	)
);

/*
 * Setting: Navbar Positioning
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[navbar_positioning]',
	array(
		'type' => 'option',
		'default'           => pyxis_get_option( 'navbar_positioning' ),
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[navbar_positioning]',
	array(
		'type' => 'select',
		'section' => 'pyxis_panel_section_navbar',
		'label' => __( 'Navbar Positioning', 'pyxis-mobile-menu' ),
		'choices' => array(
			'absolute' => __( 'Scrolls away from view', 'pyxis-mobile-menu' ),
			'fixed' => __( 'Sticky, always on top', 'pyxis-mobile-menu' ),
		),
	)
);

/*
 * Setting: Navbar Background Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[navbar_bg_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'navbar_bg_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[navbar_bg_color]',
		array(
			'label'    => __( 'Navbar Background Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_navbar',
			'settings' => 'pyxis_options[navbar_bg_color]',
			'priority' => 10,
		)
	)
);

/*
 * Setting: Navbar Title Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[navbar_title_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'navbar_title_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[navbar_title_color]',
		array(
			'label'    => __( 'Navbar Title Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_navbar',
			'settings' => 'pyxis_options[navbar_title_color]',
			'priority' => 10,
		)
	)
);

/*
 * Setting: Navbar Title Font Size
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[navbar_title_font_size]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'navbar_title_font_size' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[navbar_title_font_size]',
	array(
		'type' => 'number',
		'label'    => __( 'Navbar Title Font Size', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_navbar'
	)
);

/*
 * Setting: Toggle Location
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[toggle_location]',
	array(
		'type' => 'option',
		'default'           => pyxis_get_option( 'toggle_location' ),
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[toggle_location]',
	array(
		'type' => 'select',
		'section' => 'pyxis_panel_section_navbar',
		'label' => __( 'Toggle Location', 'pyxis-mobile-menu' ),
		'choices' => array(
			'left' => __( 'Left', 'pyxis-mobile-menu' ),
			'right' => __( 'Right', 'pyxis-mobile-menu' ),
		),
	)
);

/*
 * Setting: Toggle Type
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[toggle_type]',
	array(
		'type' => 'option',
		'default'           => pyxis_get_option( 'toggle_type' ),
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[toggle_type]',
	array(
		'type' => 'select',
		'section' => 'pyxis_panel_section_navbar',
		'label' => __( 'Toggle Type', 'pyxis-mobile-menu' ),
		'choices' => array(
			'hamburger' => __( 'Hamburger Icon', 'pyxis-mobile-menu' ),
			'button' => __( 'Menu Button', 'pyxis-mobile-menu' ),
		),
	)
);

/*
 * Setting: Hamburger Width
 * ================================ 
 */
// https://make.xwp.co/2016/07/24/dependently-contextual-customizer-controls/
// https://wordpress.stackexchange.com/questions/249706/customizer-active-callback-live-toggle-controls?rq=1
$wp_customize->add_setting(
	'pyxis_options[hamburger_width]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'hamburger_width' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'active_callback' => function( $control ) {
			return $control->manager->get_setting( 'toggle_type' ) == 'hamburger' ? true : false;
		},
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[hamburger_width]',
	array(
		'type' => 'number',
		'label'    => __( 'Hamburger Width', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_navbar'
	)
);

/*
 * Setting: Hamburger Bar Height
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[hamburger_bar_height]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'hamburger_bar_height' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'active_callback' => function( $control ) {
			return $control->manager->get_setting( 'toggle_type' ) == 'hamburger' ? true : false;
		},
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[hamburger_bar_height]',
	array(
		'type' => 'number',
		'label'    => __( 'Hamburger Bar Height', 'pyxis-mobile-menu' ),
		'description' => __( 'Height (in pixels) of each individual bar of the hamburger', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_navbar'
	)
);

/*
 * Setting: Hamburger Bar Interval
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[hamburger_bar_interval]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'hamburger_bar_interval' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'active_callback' => function( $control ) {
			return $control->manager->get_setting( 'toggle_type' ) == 'hamburger' ? true : false;
		},
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[hamburger_bar_interval]',
	array(
		'type' => 'number',
		'label'    => __( 'Hamburger Bar Interval', 'pyxis-mobile-menu' ),
		'description' => __( 'Distance (in pixels) between each bar of the hamburger', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_navbar'
	)
);

/*
 * Setting: Hamburger Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[hamburger_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'hamburger_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'active_callback' => function( $control ) {
			return $control->manager->get_setting( 'toggle_type' ) == 'hamburger' ? true : false;
		},
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[hamburger_color]',
		array(
			'label'    => __( 'Hamburger Icon Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_navbar',
			'settings' => 'pyxis_options[hamburger_color]',
			'priority' => 10,
		)
	)
);


/*
 * Setting: Menu Button Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[menu_button_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'menu_button_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'active_callback' => function( $control ) {
			return $control->manager->get_setting( 'toggle_type' ) == 'button' ? true : false;
		},
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[menu_button_color]',
		array(
			'label'    => __( 'Menu Button Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_navbar',
			'settings' => 'pyxis_options[menu_button_color]',
			'priority' => 10,
		)
	)
);

/*
 * Setting: Menu Button Background Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[menu_button_bg_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'menu_button_bg_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'active_callback' => function( $control ) {
			return $control->manager->get_setting( 'toggle_type' ) == 'button' ? true : false;
		},
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[menu_button_bg_color]',
		array(
			'label'    => __( 'Menu Button Background Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_navbar',
			'settings' => 'pyxis_options[menu_button_bg_color]',
			'priority' => 10,
		)
	)
);