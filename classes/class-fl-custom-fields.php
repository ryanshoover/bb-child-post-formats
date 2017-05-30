<?php

/**
 * Helper class for child theme functions.
 *
 * @class FLChildTheme
 */
final class FLCustomFields {

    /**
	 * Enqueues scripts and styles.
	 *
     * @return void
     */
    static public function register_metaboxes()
    {
	    $self = new FLCustomFields;

        $self->post_format_metaboxes();
    }

    public function post_format_metaboxes() {
        $prefix = 'fl-child-';

        /**
        * Initiate the metabox
        */
        $cmb = new_cmb2_box( array(
            'id'            => 'post-format',
            'title'         => __( 'Post Format Settings', 'fl-automator' ),
            'object_types'  => [ 'post' ], // Post type
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true,
            ) );

        // Video field URL
        $cmb->add_field( array(
            'name'       => __( 'Video URL', 'fl-automator' ),
            'desc'       => __( 'URL to the featured video', 'fl-automator' ),
            'id'         => $prefix . 'video',
            'type'       => 'text',
            ) );

        // Gallery images
        $cmb->add_field( array(
            'name'       => __( 'Gallery Images', 'fl-automator' ),
            'desc'       => __( 'Add all the images that should be in the gallery', 'fl-automator' ),
            'id'         => $prefix . 'gallery',
            'type'       => 'file_list',
            ) );

        // Video field URL
        $cmb->add_field( array(
            'name'       => __( 'Quote', 'fl-automator' ),
            'desc'       => __( 'Text of the quote to feature', 'fl-automator' ),
            'id'         => $prefix . 'quote',
            'type'       => 'text',
            ) );
    }
}
