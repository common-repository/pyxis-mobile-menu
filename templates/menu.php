<div class="pyxis-mobile-overlay"></div>
<div id="pyxis-mobile-menu-container" class="pyxis-mobile-menu-container">
	<div class="pyxis-mobile-menu-wrap">
		<button class="pyxis-mobile-close">
			<div class="pyxis-mobile-toggle-bars"></div>
		</button>

		<?php if ( has_nav_menu( 'pyxis' ) ) : ?>

			<?php
			$args = array(
				'theme_location' => 'pyxis',
				'container'      => false,
				'item_spacing'   => 'discard',
			);

			wp_nav_menu( $args ) ?>
		
		<?php else : ?>

			<?php if ( current_user_can( 'administrator' ) ) : ?>
				<div class="pyxis-mobile-no-menu">
					<h4><?php _e( 'No Menu Assigned', 'pyxis-mobile-menu' ); ?></h4>
					<p><a href="<?php echo admin_url( 'nav-menus.php?action=locations' ); ?>"><?php _e( 'Please assign a menu to the <strong>Pyxis Mobile Menu</strong> theme location.', 'pyxis-mobile-menu' ); ?></a></p>
			<?php endif; ?>

		<?php endif ?>
	</div>
</div>