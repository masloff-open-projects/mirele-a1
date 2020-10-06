<?php

use Mirele\Compound\Patterns;
use Mirele\Router;

# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-removeTemplate', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        # Implementation of an event pattern created as
        # an abstract object in the "Mirele\Compound\Patterns" namespace
        $pattern = new Patterns\removeTemplate();
        $pattern->setTemplate((MIRELE_POST)['template']);
        $pattern->setId((MIRELE_POST)['id']);
        $execute = $pattern->execute();

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