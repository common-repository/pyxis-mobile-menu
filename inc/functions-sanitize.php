<?php

if ( ! function_exists( 'pyxis_sanitize_integer' ) ) {
	/**
	 * Sanitize integers.
	 *
	 * @since 1.0.0
	 */
	function pyxis_sanitize_integer( $input ) {
		return absint( $input );
	}
}

if ( ! function_exists( 'pyxis_sanitize_checkbox' ) ) {
	/**
	 * Sanitize checkbox values.
	 *
	 * @since 1.0.0
	 */
	function pyxis_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
}

if ( ! function_exists( 'pyxis_sanitize_hex_color' ) ) {
	/**
	 * Sanitize colors.
	 * Allow blank value.
	 *
	 * @since 1.0.0
	 */
	 function pyxis_sanitize_hex_color( $color ) {
		 if ( '' === $color ) {
			 return '';
		 }

		 // 3 or 6 hex digits, or the empty string.
		 if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			 return $color;
		 }

		 return '';
	 }
}

if ( ! function_exists( 'pyxis_sanitize_choices' ) ) {
	/**
	 * Sanitize choices.
	 *
	 * @since 1.0.0
	 */
	function pyxis_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug
		$input = sanitize_key( $input );

		// Get list of choices from the control
		// associated with the setting
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it;
		// otherwise, return the default
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}