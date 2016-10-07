	<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' )  ) : ?>
		<div class="menu-toggle-container">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'bookmark' ); ?></span>
				<span class="toggle-lines" aria-hidden="true"></span>
			</button>
		</div>
	<?php endif; ?>