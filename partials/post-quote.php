<?php
/**
 * Partial content for video posts
 */

$quote = get_post_meta( get_the_ID(), 'fl-child-quote', true );

printf( '<p class="fl-post-format fl-post-format-quote">%s</p>', $quote );
