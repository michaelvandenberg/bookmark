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
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bookmark_customize_preview_js() {
	wp_enqueue_script( 'bookmark_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bookmark_customize_preview_js' );
