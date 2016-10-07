<?php
/**
 * Template Name: Full Width Page
 *
 * @package Bookmark
 */

get_header(); ?>

	<div id="primary" class="content-area full-width-page">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'components/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();