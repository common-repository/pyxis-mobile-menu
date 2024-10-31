<?php

class Pyxis_Divider extends WP_Customize_Control {

/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'pc-divider';

	/**
	 * Render the divider.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	public function render_content() { ?>
		<hr />
	<?php }
}