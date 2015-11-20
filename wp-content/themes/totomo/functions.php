<?php
/**
 * totomo functions and definitions
 *
 * @package totomo
 */

if ( ! function_exists( 'totomo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function totomo_setup() {

	/* Make theme available for translation.*/
	load_theme_textdomain( 'totomo', get_template_directory() . '/languages' );

	/* Add default posts and comments RSS feed links to head. */
	add_theme_support( 'automatic-feed-links' );

	/* Let WordPress manage the document title */
	add_theme_support( 'title-tag' );

	/* Enable support for Post Thumbnails on posts and pages.*/
	add_theme_support( 'post-thumbnails' );

	/* Register Nav Menu */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'totomo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/* Post formats. */
	add_theme_support(
		'post-formats',
		array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'video' )
	);

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'totomo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style
	 */
	add_editor_style( 'css/editor-style.css' );

	/* Set the content width based on the theme's design and stylesheet. */
	if ( ! isset( $content_width ) ) {
		$content_width = 940;
	}

	// Add new image size
	add_image_size( 'totomo-thumb-blog-list', 910, 500, true );
}
endif; // totomo_setup
add_action( 'after_setup_theme', 'totomo_setup' );

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

/**
 * Load fronend file.
 */

require get_template_directory() . '/inc/media.php';
require get_template_directory() . '/inc/bootstrap-menu.php';
