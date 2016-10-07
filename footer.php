<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bookmark
 */

?>

	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_template_part( 'components/footer/site', 'info' ); ?>
	</footer>

	<?php if ( has_nav_menu( 'social' ) ) { ?>
		<div id="social-right" class="social-navigation">
				<?php get_template_part( 'components/header/navigation', 'social' ); ?>
		</div><!-- .social-right -->
	<?php } ?>

	<a href="#content" class="back-to-top">Top</a>
</div>
<?php wp_footer(); ?>

</body>
</html>
