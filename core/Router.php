<?php

use \Mirele\Router;
use \Mirele\Framework\Buffer;
use \Mirele\Framework\Inter;
use \Mirele\Framework\Stringer;


# AJAX

# Endpoint to receive registered options
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/options', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {

        # Setting up the environment
        $namespace = isset((MIRELE_POST)['namespace']) ? ((MIRELE_POST)['namespace'] === 'all' ? \Mirele\Framework\Customizer::namespaces() : explode('|', (MIRELE_POST)['namespace'])) : '*';
        $buffer = new Buffer();

        # Foreach options store
        foreach ($namespace as $name) {
            foreach (\Mirele\Framework\Customizer::all($name) as $Option) {
                $buffer->setNamespace($name);
                $buffer->append($Option->build());
            }
        }

        # Response
        wp_send_json($buffer->getBuffer((MIRELE_POST)['namespace'] === 'all' ? 'all' : (MIRELE_POST)['namespace']));

    }

});

# Endpoint for specific product information
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/product', function () {

    $id = (MIRELE_POST)['id'];

    wp_send_json(wc_get_product($id));

});

# Endpoint to save or update options
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/saveOption', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {

        # Request validation
        if (isset((MIRELE_POST)['name']) and (MIRELE_POST)['namespace'] and (MIRELE_POST)['value']) {
            wp_send_json([
                'data' => update_option((MIRELE_POST)['name'], (MIRELE_POST)['value'])
            ]);

        } else {
            wp_send_json([
                'error' => 'Request is not valid'
            ]);
        }

    }

});

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

# Endpoint to add goods to user cart
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/WCAddToCart', function () {

    # Parse params
    $ID  = (int) (new Inter((MIRELE_POST)['product_id']))::ABS();
    $QTY = (int) (new Inter((MIRELE_POST)['product_quantity']))::ABS();
    $VariationID = (int) (new Inter((MIRELE_POST)['product_variation_id']))::ABS();
    $VariationAttr = (MIRELE_POST)['product_variation'];

    # Checking if it is possible to add the goods to the cart.
    if (apply_filters('woocommerce_add_to_cart_validation', true, $ID, $QTY)) {

        # Create cart
        $CartItem = WC()->cart->add_to_cart($ID, $QTY, $VariationID, $VariationAttr);

        if ($CartItem) {

            do_action('woocommerce_ajax_added_to_cart', $ID);

            if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                wc_add_to_cart_message(array($ID => $QTY), true);
            }

            wp_send_json_success([
                'id' => $CartItem
            ]);

        } else {
            wp_send_json_error([
                'error' => 'This product was not added to the cart.'
            ]);
        }

    }

});



# Rest
Router::post('/rest_endpoint_v1', function () {

});

Router::get('/rest_endpoint_v1/options/get', function () {
    var_dump(\Mirele\Framework\Customizer::all('*'));
});