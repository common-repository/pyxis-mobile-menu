jQuery(document).ready(function($) {
	$('.option-pyxis_plugin_options .button-warning').on('click', function(e) {
		var r = confirm( 'Are you sure? Clicking "OK" will reset all Pyxis customizer and plugin settings. This cannot be undone.' );
		if ( r == false ) {
			e.preventDefault();
			return false;
		}

		else {
			var data = {
				'action': 'pyxis_reset_options',
				'nonce': pyxis.nonce
			};

			$.post(pyxis.ajax_url, data, function(response) {
				location.href = location.href;
			});
		}
	})
});