<?php

use \Mirele\Router;
use \Mirele\Framework\Customizer;

# Endpoint to receive registered options
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/namespaces', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {

        # Response
        wp_send_json(Customizer::namespaces());

    }

});