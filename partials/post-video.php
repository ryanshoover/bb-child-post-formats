<?php
/**
 * Partial content for video posts
 */

$video = get_post_meta( get_the_ID(), 'fl-child-video', true );

printf( '<div class="fl-post-format fl-post-format-video">%s</div>', wp_oembed_get( $video ) );
