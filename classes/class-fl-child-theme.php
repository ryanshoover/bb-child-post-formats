<?php

/**
 * Helper class for child theme functions.
 *
 * @class FLChildTheme
 */
final class FLChildTheme {

    /**
	 * Enqueues scripts and styles.
	 *
     * @return void
     */
    static public function enqueue_scripts()
    {
	    wp_enqueue_style( 'fl-child-theme', FL_CHILD_THEME_URL . '/style.css' );

        if ( 'gallery' == get_post_format() || is_archive() || is_search() || is_home() ) {
            wp_enqueue_script( 'jquery-mosaicflow' );
        }
    }

    /**
     * Register post type support
     *
     * @return void
     */
    static public function post_formats_setup()
    {
	    add_theme_support( 'post-formats', [ 'gallery', 'quote', 'video' ] );
	}

    static public function customizer_init()
    {
        require_once FL_CHILD_THEME_DIR . '/includes/customizer-panel-content-alt.php';
    }

}
