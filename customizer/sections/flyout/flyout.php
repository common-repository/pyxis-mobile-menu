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
 * Section: Flyout
 * ================================ 
 */
$wp_customize->add_section(
	'pyxis_panel_section_flyout',
	array(
		'title' => __( 'Flyout Panel', 'pyxis-mobile-menu' ),
		'panel' => 'pyxis_panel',
	)
);

/*
 * Setting: Flyout Style
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[flyout_style]',
	array(
		'type' => 'option',
		'default'           => pyxis_get_option( 'flyout_style' ),
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[flyout_style]',
	array(
		'type' => 'select',
		'section' => 'pyxis_panel_section_flyout',
		'label' => __( 'Flyout Style', 'pyxis-mobile-menu' ),
		'choices' => array(
			'default' => __( 'Default', 'pyxis-mobile-menu' ),
			'full' => __( 'Full Width', 'pyxis-mobile-menu' ),
		),
	)
);

/*
 * Setting: Flyout Background Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[flyout_bg_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'flyout_bg_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[flyout_bg_color]',
		array(
			'label'    => __( 'Flyout Panel Background Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_flyout',
			'settings' => 'pyxis_options[flyout_bg_color]',
			'priority' => 10,
		)
	)
);

/*
 * Setting: Flyout Close Color
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[flyout_close_color]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'flyout_close_color' ),
		'sanitize_callback' => 'pyxis_sanitize_hex_color',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'pyxis_options[flyout_close_color]',
		array(
			'label'    => __( 'Flyout Close Color', 'pyxis-mobile-menu' ),
			'section'  => 'pyxis_panel_section_flyout',
			'settings' => 'pyxis_options[flyout_close_color]',
			'priority' => 10,
		)
	)
);

/*
 * Setting: Flyout Close Size
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[flyout_close_size]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'flyout_close_size' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[flyout_close_size]',
	array(
		'type' => 'number',
		'label'    => __( 'Flyout Close Size', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_flyout'
	)
);

/*
 * Setting: Flyout Close Bar Thickness
 * ================================ 
 */
$wp_customize->add_setting(
	'pyxis_options[flyout_close_bar_thickness]',
	array(
		'type' => 'option',
		'default' => pyxis_get_option( 'flyout_close_bar_thickness' ),
		'sanitize_callback' => 'pyxis_sanitize_integer',
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'pyxis_options[flyout_close_bar_thickness]',
	array(
		'type' => 'number',
		'label'    => __( 'Flyout Close Bar Thickness', 'pyxis-mobile-menu' ),
		'section'  => 'pyxis_panel_section_flyout'
	)
);