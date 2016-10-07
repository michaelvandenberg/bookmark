	<div id="hidden-header" class="hidden" style="display:none;">
		<div class="container">
			<nav id="main-navigation" class="site-navigation" role="navigation">
				<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'components/header/navigation-primary' ); } ?>

				<?php if ( has_nav_menu( 'social' ) ) { get_template_part( 'components/header/navigation-social' ); } ?>
			</nav><!-- #primary-navigation -->
			
			<div id="primary-search" class="search-container">
				<?php get_search_form(); ?>
			</div><!-- #primary-search -->
		</div><!-- .container -->
	</div><!-- #hidden-header -->