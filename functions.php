<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bookmark
 */

if ( ! function_exists( 'bookmark_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bookmark_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'bookmark' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bookmark', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'bookmark-navigation', 800, 160, true );
	add_image_size( 'bookmark-featured-image', 800, 9999 );
	add_image_size( 'bookmark-featured-large', 1280, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Main Menu', 'bookmark' ),
		'social'	=> esc_html__( 'Social Menu', 'bookmark' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bookmark_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'bookmark_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bookmark_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bookmark_content_width', 800 );
}
add_action( 'after_setup_theme', 'bookmark_content_width', 0 );

/**
 * Adjust content_width value for full width page template. parse_query   the_post
 */
function bookmark_full_width_page_content_width() {
	if ( is_page_template( 'page-templates/template-full-width.php' ) ) {	
		$GLOBALS['content_width'] = apply_filters( 'bookmark_full_width_page_content_width', 1280 );
	}
}
add_action( 'template_redirect', 'bookmark_full_width_page_content_width' );

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function bookmark_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bookmark_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bookmark' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bookmark_widgets_init' );

if ( ! function_exists( 'bookmark_fonts_url' ) ) :
/**
 * Register Google fonts for Myth.
 *
 * @return string Google fonts URL for the theme.
 */
function bookmark_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Merriweather, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'bookmark' ) ) {
		$fonts[] = 'Merriweather:400,700,400italic,700italic';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Source Sans Pro, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'bookmark' ) ) {
		$fonts[] = 'Source Sans Pro:300,400,300italic,400italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function bookmark_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'bookmark-fonts', bookmark_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/fonts/genericons/genericons.css', array(), '3.4.1' );

	// Load the theme main stylesheet.
	wp_enqueue_style( 'bookmark-style', get_stylesheet_uri() );

	// Load the waves script file.
	wp_enqueue_script( 'waves', get_template_directory_uri() . '/assets/js/waves.min.js', array( 'jquery' ), '0.7.5', true );

	// Load the theme custom script file.
	wp_enqueue_script( 'bookmark-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '20120206', true );

	// Load the jQuery effects file.
	wp_enqueue_script("jquery-effects-core");

	// Load the skip-link-focus script file.
	wp_enqueue_script( 'bookmark-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	// Load the javascript file for comments if applicable.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bookmark_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
