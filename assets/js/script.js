var PyxisMobileMenu;

(function($) {

	$(function() {
		new PyxisMobileMenu();
	});

	PyxisMobileMenu = function(settings) {
		this.flyout = document.querySelector('#pyxis-mobile-menu-container');
		this._init();
	};

	PyxisMobileMenu.prototype = {

		_init: function() {
			this._enableInteraction();
		},

		_enableInteraction: function() {
			_self = this;

			$('.pyxis-mobile-toggle').on('click', function(e) {
				e.preventDefault();
				_self._openFlyoutMenu();
			});

			$('.pyxis-mobile-close').on('click', function(e) {
				e.preventDefault();
				_self._closeFlyoutMenu();
			});

			$('.pyxis-submenu-toggle').on('click', function(e) {
				e.preventDefault();
				$(this).parent().next().slideToggle();
				$(this).toggleClass('open');
			});
		},

		_openFlyoutMenu: function() {
			$('body').addClass('pyxis-mobile-active');
			$('html').css('overflow-y', 'hidden');
			bodyScrollLock.disableBodyScroll(this.flyout);
		},

		_closeFlyoutMenu: function() {
			$('body').removeClass('pyxis-mobile-active');
			$('html').css('overflow-y', 'auto');
			bodyScrollLock.enableBodyScroll(this.flyout);
			bodyScrollLock.clearAllBodyScrollLocks();
		}
	};

})(jQuery);
