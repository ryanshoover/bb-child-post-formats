<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

if ( ! isset( $content_width ) ) {
	$content_width = get_theme_mod( 'fl-content-width', 1020 );
}

// Classes
require_once 'classes/class-fl-child-theme.php';
require_once 'classes/class-fl-custom-fields.php';
require_once 'classes/class-fl-theme-mods.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );

// Post Types Support
add_action( 'after_setup_theme', 'FLChildTheme::post_formats_setup' );

add_action( 'after_setup_theme', 'FLChildTheme::customizer_init' );

// Create our custom fields
add_action( 'cmb2_admin_init', 'FLCustomFields::register_metaboxes' );

add_action( 'wp', 'FLThemeMods::setup_theme_mods' );
