<?php

use Mirele\Compound\Patterns;
use Mirele\Router;

Router::post('/ajax_endpoint_v1/Compound-insertComponent', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $pattern = new Patterns\insertComponent();
        $pattern->page = (MIRELE_POST)['page'];
        $pattern->component = (MIRELE_POST)['component'];
        $pattern->field = (MIRELE_POST)['field'];
        $pattern->template = (MIRELE_POST)['template'];

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
