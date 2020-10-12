<?php

use Mirele\Compound\Patterns;
use Mirele\Router;

# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-sortOrder', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        # Implementation of an event pattern created as
        # an abstract object in the "Mirele\Compound\Patterns" namespace
        $pattern = new Patterns\sortOrder();
        $pattern->page = (MIRELE_POST)['page'];
        $pattern->prototype = (MIRELE_POST)['order'];
        $execute = $pattern();

        # Return the results of the pattern
        if ($execute) {
            wp_send_json_success([]);
            return true;
        } else {
            wp_send_json_error([]);
            return false;
        }

    }

});