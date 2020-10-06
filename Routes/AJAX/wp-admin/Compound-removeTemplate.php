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
        $pattern->template = (MIRELE_POST)['template'];
        $pattern->page = (MIRELE_POST)['page'];

        $biffer = $pattern();

        if ($biffer) {
            return wp_send_json_success([
                'result' => $biffer
            ]);
        } else {
            return wp_send_json_error([
                'result' => $biffer
            ]);
        }

    }

});