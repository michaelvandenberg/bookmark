<?php
/**
 * Bookmark Theme Customizer.
 *
 * @package Bookmark
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bookmark_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Link color. */
	$wp_customize->add_setting('bookmark_link_color', array(
		'default'			=> '#CC0000',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'bookmark_link_color', array(
		'label'				=> esc_html__('Link Color', 'bookmark'),
		'section'			=> 'colors',
		'priority'			=> 11,
		'settings'			=> 'bookmark_link_color',
	)));

	/* Primary header overlay color. */
	$wp_customize->add_setting('bookmark_header_overlay_color_primary', array(
		'default'			=> '#CC0000',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'bookmark_header_overlay_color_primary', array(
		'label'				=> esc_html__('Primary Overlay Color', 'bookmark'),
		'section'			=> 'colors',
		'priority'			=> 80,
		'settings'			=> 'bookmark_header_overlay_color_primary',
	)));

	/* Secondary header overlay color. */
	$wp_customize->add_setting('bookmark_header_overlay_color_secondary', array(
		'default'			=> '#212223',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'bookmark_header_overlay_color_secondary', array(
		'label'				=> esc_html__('Secondary Overlay Color', 'bookmark'),
		'section'			=> 'colors',
		'priority'			=> 80,
		'settings'			=> 'bookmark_header_overlay_color_secondary',
	)));

	/* Theme options panel */
	$wp_customize->add_panel( 'bookmark_theme_options', array(
		'priority'			=> 200,
		'title'				=> esc_html__( 'Theme Options', 'bookmark' ),
		'description'		=> esc_html__( 'This theme supports a number of options which you can set using this panel.', 'bookmark' ),
	) );

	/* Theme options content section */
	$wp_customize->add_section( 'bookmark_content_options', array(
		'title'				=> esc_html__( 'Content Options', 'bookmark' ),
		'priority'			=> 10,
		'panel'				=> 'bookmark_theme_options',
		'description'		=> esc_html__( 'To customize the appearance of the content adjust any of the settings below.', 'bookmark' ),
	) );

	/* Intro paragraph. */
	$wp_customize->add_setting( 'bookmark_paragraph_intro', array(
		'default'           => 'posts-only',
		'sanitize_callback' => 'bookmark_sanitize_paragraph_intro',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'bookmark_paragraph_intro', array(
		'label'             => esc_html__( 'Paragraph intro style: ', 'bookmark' ),
		'section'           => 'bookmark_content_options',
		'priority'          => 10,
		'type'              => 'radio',
		'choices'           => array(
			'enabled'		=> esc_html__( 'Enabled', 'bookmark' ),
			'disabled'		=> esc_html__( 'Disabled', 'bookmark' ),
			'posts-only'		=> esc_html__( 'Posts Only', 'bookmark' ),
		),
	) );
}
add_action( 'customize_register', 'bookmark_customize_register' );

/**
 * Sanitize bookmark paragraph.
 *
 * @param string $input.
 * @return string (enabled|disabled|post-only).
 */
function bookmark_sanitize_paragraph_intro( $input ) {
	if ( ! in_array( $input, array( 'enabled', 'disabled', 'posts-only' ) ) ) {
		$input = 'posts-only';
	}
	return $input;
}

/**
 * Add inline styles for the custom colors.
 *
 * @see wp_add_inline_style()
 */
function bookmark_custom_colors() {
	$css 					= '';
	$link_color 			= get_theme_mod( 'bookmark_link_color', '#CC0000' );
	$primary_overlay		= get_theme_mod( 'bookmark_header_overlay_color_primary', '#CC0000' );
	$secondary_overlay		= get_theme_mod( 'bookmark_header_overlay_color_secondary', '#212223' );

	// Convert hex colors to rgba colors.
	$rgba_primary			= bookmark_hex2rgba( $primary_overlay, 0.75 );
	$rgba_secondary			= bookmark_hex2rgba( $secondary_overlay, 0.75 );
	$rgba_link_waves_1		= bookmark_hex2rgba( $link_color, 0.4 );
	$rgba_link_waves_2		= bookmark_hex2rgba( $link_color, 0.6 );
	$rgba_link_waves_3		= bookmark_hex2rgba( $link_color, 0.8 );
	$rgba_link_waves_4		= bookmark_hex2rgba( $link_color, 0.9 );
	$rgba_link_waves_5		= bookmark_hex2rgba( $link_color, 1.0 );

	if ( ( ! empty( $rgba_primary ) && '#CC0000' !== $primary_overlay ) || ! empty( $rgba_secondary ) && '#CC0000' !== $secondary_overlay ) {
		$css .= '
			.overlay-header { background-image: -webkit-linear-gradient(top left, ' . $rgba_primary . ', ' . $rgba_secondary . '); }
			.overlay-header { background-image: linear-gradient(to bottom right, ' . $rgba_primary . ', ' . $rgba_secondary . '); }
		';
	}

	if ( ! empty( $link_color ) && '#CC0000' !== $link_color ) {
		$css .= '
			a:hover, a:focus, a:active, .cat-links a, .cat-links a:visited, .widget.widget_search .search-submit:hover .genericon-search, .widget.widget_search .search-submit:focus .genericon-search { color: ' . $link_color . '; }
			.entry-content a { border-bottom-color: ' . $link_color . '; }
			#primary-menu a:hover, #primary-menu a:focus, #primary-menu a:active, .widget-area a:hover, .widget-area a:focus, .widget-area a:active { box-shadow: inset 0 -0.125em ' . $link_color  . '; }
			blockquote { border-left-color: ' . $link_color . ' ;}
			.waves-effect .waves-ripple { background: -webkit-radial-gradient(' . $rgba_link_waves_1 . ' 0,' . $rgba_link_waves_2 . ' 15%,' . $rgba_link_waves_3 . ' 30%,' . $rgba_link_waves_4 . ' 50%,' . $rgba_link_waves_5 . ' 75%); background: -o-radial-gradient(' . $rgba_link_waves_1 . ' 0,' . $rgba_link_waves_2 . ' 15%,' . $rgba_link_waves_3 . ' 30%,' . $rgba_link_waves_4 . ' 50%,' . $rgba_link_waves_5 . ' 75%); background: -moz-radial-gradient(' . $rgba_link_waves_1 . ' 0,' . $rgba_link_waves_2 . ' 15%,' . $rgba_link_waves_3 . ' 30%,' . $rgba_link_waves_4 . ' 50%,' . $rgba_link_waves_5 . ' 75%); background: radial-gradient(' . $rgba_link_waves_1 . ' 0,' . $rgba_link_waves_2 . ' 15%,' . $rgba_link_waves_3 . ' 30%,' . $rgba_link_waves_4 . ' 50%,' . $rgba_link_waves_5 . ' 75%);}
		';
	}

	wp_add_inline_style( 'bookmark-style', $css );
}
add_action( 'wp_enqueue_scripts', 'bookmark_custom_colors' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bookmark_customize_preview_js() {
	wp_enqueue_script( 'bookmark_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bookmark_customize_preview_js' );
