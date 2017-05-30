<?php

/**
 * Helper class for child theme functions.
 *
 * @class FLChildTheme
 */
final class FLThemeMods {

    static public function setup_theme_mods() {

        $pf_content_location = get_theme_mod( 'fl-post-format-location' );

        switch ( $pf_content_location ) {
            case 'post-above' :
                $pf_content_action = 'fl_before_post';
            break;

            case 'post-below' :
                $pf_content_action = 'fl_after_post';
            break;

            case 'content-below' :
                $pf_content_action = 'fl_after_post_content';
            break;

            default :
                $pf_content_action = 'fl_before_post_content';
        }

        add_action( $pf_content_action, 'FLThemeMods::post_format_content' );
    }

    /**
	 * Add our post format content to single posts
	 *
     * @return void
     */
    static public function post_format_content()
    {
        if ( ! is_singular() ) {
            return;
        }

	    get_template_part( 'partials/post', get_post_format() );
    }
}
