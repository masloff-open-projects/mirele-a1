<?php

use Mirele\Framework\Inter;
use Mirele\Router;

# Endpoint to add goods to user cart
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/WCAddToCart', function () {

    # Parse params
    $ID = (int)(new Inter((MIRELE_POST)['product_id']))::ABS();
    $QTY = (int)(new Inter((MIRELE_POST)['product_quantity']))::ABS();
    $VariationID = (int)(new Inter((MIRELE_POST)['product_variation_id']))::ABS();
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
