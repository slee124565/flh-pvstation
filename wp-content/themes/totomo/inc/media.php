<?php
/**
 * Enqueue scripts and styles.
 *
 * @return void
 * @since  1.0
 */
function totomo_enqueue_scripts() {

	// Register scripts
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.2', true );
	wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), '1.1', true );

	// CSS libraries
	wp_enqueue_style( 'google-fonts', esc_url( '//fonts.googleapis.com/css?family=Varela+Round' ) );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );

	// Theme style
	wp_enqueue_style( 'totomo', get_stylesheet_uri() );

	// Theme scripts
	wp_enqueue_script( 'totomo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'totomo', get_template_directory_uri() . '/js/totomo.js', array( 'jquery', 'bootstrap', 'fitvids', 'wp-mediaelement' ), true );

	// Script for comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'totomo_enqueue_scripts' );
