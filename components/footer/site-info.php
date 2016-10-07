<?php $custom_copyright = get_theme_mod( 'bookmark_custom_copyright' ); ?>

<div class="site-info">
		<?php if ( $custom_copyright ) { ?>
			<div class="copyright custom"><?php echo esc_html( $custom_copyright ); ?></div>
		<?php } else { ?>
			<div class="copyright"><span class="symbol">&copy; </span><?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a><span class="sep"> – </span><span class="description"><?php bloginfo( 'description' ); ?>.</span></div>
		<?php } ?>
		<span class="generator"><?php echo esc_html__( 'Powered by ', 'bookmark' ) ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'bookmark' ) ); ?>" rel="generator">WordPress</a></span>
		<span class="sep"> | </span>
		<span class="designer"><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'bookmark' ), '<a href="http://michaelvandenberg.com/portfolio/bookmark/" rel="theme">Bookmark</a>', 'Michael Van Den Berg' ); ?></span>
</div><!-- .site-info -->