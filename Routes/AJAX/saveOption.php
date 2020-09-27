<?php

use \Mirele\Router;

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
