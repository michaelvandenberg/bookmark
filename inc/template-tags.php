<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bookmark
 */

if ( ! function_exists( 'bookmark_categories' ) ) :
/**
 * Echoes HTML with the categories.
 */
function bookmark_categories() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'bookmark' ) );
		if ( $categories_list && bookmark_categorized_blog() ) {
			echo '<div class="entry-categories">';
			echo '<span class="cat-links">' . $categories_list . '</span>';
			echo '</div>';
		}
	}
}
endif;

if ( ! function_exists( 'bookmark_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function bookmark_meta() {
	// Get the author avatar.
	$author_header_avatar_size = apply_filters( 'bookmark_author_header_avatar_size', 50 );

	$avatar = get_avatar( get_the_author_meta( 'user_email' ), $author_header_avatar_size );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="small-avatar"> ' . $avatar . '</span><span class="byline"> ' . $byline . '</span><span class="sep"> | </span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'bookmark_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bookmark_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && is_single() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'bookmark' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'bookmark' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		comments_popup_link( esc_html__( 'No Comments', 'bookmark' ), esc_html__( '1 Comment', 'bookmark' ), esc_html__( '% Comments', 'bookmark' ), 'comments-link' );
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'bookmark' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bookmark_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bookmark_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bookmark_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bookmark_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bookmark_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in bookmark_categorized_blog.
 */
function bookmark_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bookmark_categories' );
}
add_action( 'edit_category', 'bookmark_category_transient_flusher' );
add_action( 'save_post',     'bookmark_category_transient_flusher' );

if ( ! function_exists( 'bookmark_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 */
function bookmark_post_thumbnail() {
	if ( post_password_required() || ! has_post_thumbnail() ) {
		return;
	} ?>

	<?php if ( is_page_template( 'page-templates/template-full-width.php' ) ) :

		$featured = 'bookmark-featured-large';

	else :

		$featured = 'bookmark-featured-image';

	endif; // End is_page_template() ?>

	<?php if ( is_singular() ) : ?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail( $featured, array( 'alt' => get_the_title() ) ); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<div class="post-thumbnail">
			<a class="post-thumbnail-link" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
				<?php the_post_thumbnail( $featured, array( 'alt' => get_the_title() ) ); ?>
			</a>
		</div><!-- .post-thumbnail -->

	<?php endif; // End is_singular()
}
endif; // bookmark_post_thumbnail