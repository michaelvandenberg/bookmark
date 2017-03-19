<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bookmark
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bookmark_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Add a class of no-sidebar when there is no sidebar present
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class for the intro paragraph.
	$intro = get_theme_mod( 'bookmark_paragraph_intro', 'posts-only' );

	if ( $intro == 'posts-only' ) {
		$classes[] = 'intro-posts-only';
	}
	elseif ( $intro == 'disabled' ) {
		$classes[] = 'intro-disabled';
	}
	else {
		$classes[] = 'intro-enabled';
	}

	return $classes;
}
add_filter( 'body_class', 'bookmark_body_classes' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @see wp_add_inline_style()
 */
function bookmark_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'bookmark-navigation' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevThumb[0] ) . '); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'bookmark-navigation' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextThumb[0] ) . '); }
		';
	}

	wp_add_inline_style( 'bookmark-style', $css );
}
add_action( 'wp_enqueue_scripts', 'bookmark_post_nav_background' );

/**
 * Convert hex color to rgba. Used for color conversion in customizer.php.
 *
 * @param string $color.
 * @return string.
 */
function bookmark_hex2rgba( $color, $alpha ) {
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		
		$hex = str_replace("#", "", $color);

		if (strlen( $hex ) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$color = "rgba({$r}, {$g}, {$b}, {$alpha})";

		return $color;
	}

	else {
		return '';
	}
}
