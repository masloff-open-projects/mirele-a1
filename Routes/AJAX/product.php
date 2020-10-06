<?php

use Mirele\Router;

# Endpoint for specific product information
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/product', function () {

    $id = (MIRELE_POST)['id'];

    wp_send_json(wc_get_product($id));

});
