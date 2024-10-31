(function($) {

	/* Navbar */
	wp.customize( 'pyxis_options[navbar_breakpoint]', function( value ) {
		value.bind( function( newval ) {
			var style = $('style#pyxis-mobile-menu-custom-embedded-css');

			var css = '';

			css += '@media only screen and (min-width: ' + newval + 'px) { #pyxis-mobile-header { display: none; } }';

			css += '@media only screen and (max-width: ' + newval + 'px) { body { padding-top: 48px !important; } .nav, .navbar, .main-navigation, .genesis-nav-menu, #main-header, #et-top-navigation, .site-header, .site-branding, .ast-mobile-menu-buttons, .ast-mobile-header-inline, .storefront-handheld-footer-bar, .hide { display: none !important; } }';

			if ( style.length ) {
				style.html(css);
			}

			else {
				$('head').append('<style id="pyxis-mobile-menu-custom-embedded-css">' + css + '</style>');
			}
		} );
	} );

	wp.customize('pyxis_options[navbar_positioning]', function(value) {
		value.bind( function(newval) {
			$('body').removeClass('pyxis-navbar-positioning-absolute pyxis-navbar-positioning-fixed').addClass('pyxis-navbar-positioning-' + newval);
		});
	});

	wp.customize( 'pyxis_options[navbar_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#pyxis-mobile-header').css('backgroundColor', newval);
		} );
	} );

	wp.customize( 'pyxis_options[navbar_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('#pyxis-mobile-header').css('color', newval);
		} );
	} );

	wp.customize( 'pyxis_options[navbar_title_font_size]', function( value ) {
		value.bind( function( newval ) {
			$('#pyxis-mobile-header .pyxis-mobile-main').css('fontSize', newval + 'px');
		} );
	} );

	wp.customize('pyxis_options[toggle_location]', function(value) {
		value.bind( function(newval) {
			$('body').removeClass('pyxis-toggle-location-left pyxis-toggle-location-right').addClass('pyxis-toggle-location-' + newval);
		});
	});

	wp.customize('pyxis_options[toggle_type]', function(value) {
		value.bind( function(newval) {
			$('body').removeClass('pyxis-toggle-type-hamburger pyxis-toggle-type-button').addClass('pyxis-toggle-type-' + newval);
		});
	});

	/* Hamburger */
	wp.customize( 'pyxis_options[hamburger_width]', function( value ) {
		value.bind( function( newval ) {
			$('.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars').css('width', newval + 'px');
		} );
	} );

	wp.customize( 'pyxis_options[hamburger_color]', function( value ) {
		value.bind( function( newval ) {
			$('.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars').css('backgroundColor', newval);

			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '.pyxis-toggle-type-hamburger #pyxis-mobile-header .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::before, .pyxis-toggle-type-hamburger #pyxis-mobile-header .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::after { background-color: ' + newval + '; }';
		} );
	} );

	wp.customize( 'pyxis_options[hamburger_bar_height]', function( value ) {
		value.bind( function( newval ) {
			$('.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars').css('height', newval);

			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::before { height: ' + newval + 'px; }'; 
			style.innerHTML += '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::after { height: ' + newval + 'px; }';
		} );
	} );

	wp.customize( 'pyxis_options[hamburger_bar_interval]', function( value ) {
		value.bind( function( newval ) {
			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::before { transform: translateY(-' + newval + 'px); }'; 
			style.innerHTML += '.pyxis-toggle-type-hamburger .pyxis-mobile-toggle .pyxis-mobile-toggle-bars::after { transform: translateY(' + newval + 'px); }';
		} );
	} );

	/* Menu Button */
	wp.customize( 'pyxis_options[menu_button_color]', function( value ) {
		value.bind( function( newval ) {
			$('.pyxis-toggle-type-button .pyxis-mobile-toggle').css('color', newval);
		} );
	} );

	wp.customize( 'pyxis_options[menu_button_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.pyxis-toggle-type-button .pyxis-mobile-toggle').css('backgroundColor', newval);
		} );
	} );

	/* Flyout Panel */
	wp.customize( 'pyxis_options[flyout_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#pyxis-mobile-menu-container').css('backgroundColor', newval);
		} );
	} );

	wp.customize( 'pyxis_options[flyout_close_color]', function( value ) {
		value.bind( function( newval ) {
			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '#pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::after, #pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::before { background-color: ' + newval + '; }';
		} );
	} );

	wp.customize( 'pyxis_options[flyout_close_size]', function( value ) {
		value.bind( function( newval ) {
			$('#pyxis-mobile-menu-container .pyxis-mobile-close').css('width', newval);
		} );
	} );

	wp.customize( 'pyxis_options[flyout_close_bar_thickness]', function( value ) {
		value.bind( function( newval ) {
			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '#pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::after, #pyxis-mobile-menu-container .pyxis-mobile-close .pyxis-mobile-toggle-bars::before { height: ' + newval + 'px; }';
		} );
	} );

	/* Menu */
	wp.customize( 'pyxis_options[menu_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#pyxis-mobile-menu-container ul.menu li a').css('color', newval);

			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '#pyxis-mobile-menu-container .pyxis-submenu-toggle::after { color: ' + newval + '; }';
		} );
	} );

	wp.customize( 'pyxis_options[menu_link_font_size]', function( value ) {
		value.bind( function( newval ) {
			$('#pyxis-mobile-menu-container ul.menu li a').css('fontSize', newval + 'px');
		} );
	} );

	wp.customize( 'pyxis_options[submenu_arrow_width]', function( value ) {
		value.bind( function( newval ) {
			var hypotenuse = newval;
			var triangle_side = Math.sqrt( Math.pow( hypotenuse, 2 ) / 2 );
			var triangle_height = Math.sqrt( Math.pow( triangle_side, 2 ) - Math.pow( hypotenuse / 2, 2 ) );

			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '#pyxis-mobile-menu-container .pyxis-submenu-toggle::after { width: ' + triangle_side + 'px; height: ' + triangle_side + 'px; transform: translate(-50%, -' + triangle_height * 1.1 + 'px) rotate(45deg); }';
		} );
	} );

	wp.customize( 'pyxis_options[submenu_arrow_thickness]', function( value ) {
		value.bind( function( newval ) {
			var style = document.head.appendChild(document.createElement('style'));

			style.innerHTML = '#pyxis-mobile-menu-container .pyxis-submenu-toggle::after { border-width: 0 ' + newval + 'px ' + newval + 'px 0; }';
		} );
	} );
	
})(jQuery);