<?php

use \Mirele\Router;

# Endpoint to create Compound page
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/compoundCreatePage', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {

        $author_id = 1;
        $slug = 'event-photo-uploader';
        $title = 'Event Photo Uploader';

        # Request validation
        $uploader_page = array(
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_author'           => $author_id,
            'post_name'             => $slug,
            'post_title'            => $title,
            'post_status'           => 'publish',
            'post_type'             => 'page'
        );

        $post_id = wp_insert_post( $uploader_page );

        if ( !$post_id ) {

            wp_die( 'Error creating template page' );

        } else {

            update_post_meta( $post_id, '_wp_page_template', COMPOUND_CANVAS );

        }

    }

});