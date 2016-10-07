	<div class="header-inner flex center" <?php bookmark_header_image(); ?>>
		<div class="overlay-header">	
			<div class="site-branding">
				<?php bookmark_the_custom_logo(); ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div>
	</div>