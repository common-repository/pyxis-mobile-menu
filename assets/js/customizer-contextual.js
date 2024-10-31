(function($) {
	wp.customize( 'pyxis_options[toggle_type]', function( setting ) {
		var isButton, isHamburger, controlsForButton, controlsForHamburger;

		isHamburger = function() {
			return 'hamburger' === setting.get();
		};

		controlsForHamburger = function( control ) {
			var setActiveState = function() {
				control.active.set( isHamburger() );
			};
			control.active.validate = isHamburger;
			setActiveState();
			setting.bind( setActiveState );
		};

		isButton = function() {
			return 'button' === setting.get();
		};

		controlsForButton = function( control ) {
			var setActiveState = function() {
				control.active.set( isButton() );
			};
			control.active.validate = isButton;
			setActiveState();
			setting.bind( setActiveState );
		};

		wp.customize.control( 'pyxis_options[hamburger_width]', controlsForHamburger );
		wp.customize.control( 'pyxis_options[hamburger_bar_height]', controlsForHamburger );
		wp.customize.control( 'pyxis_options[hamburger_bar_interval]', controlsForHamburger );
		wp.customize.control( 'pyxis_options[hamburger_color]', controlsForHamburger );

		wp.customize.control( 'pyxis_options[menu_button_color]', controlsForButton );
		wp.customize.control( 'pyxis_options[menu_button_bg_color]', controlsForButton );
	} );
	
})(jQuery);