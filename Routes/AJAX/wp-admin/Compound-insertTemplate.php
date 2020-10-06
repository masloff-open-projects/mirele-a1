<?php

use Mirele\Compound\Patterns;
use Mirele\Router;

Router::post('/ajax_endpoint_v1/Compound-insertTemplate', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        # Create a work environment
        $pattern = new Patterns\insertTemplate();
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
