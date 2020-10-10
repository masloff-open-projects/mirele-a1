<?php

use Mirele\Compound\Lexer;
use Mirele\Compound\Tag;
use Mirele\Router;
use Mirele\Compound\Patterns;

# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-updateTemplateProps', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $pattern = new Patterns\updateTemplateProps();
        $pattern->page = (MIRELE_POST)['page'];
        $pattern->template = (MIRELE_POST)['template'];
        $pattern->props = (MIRELE_POST)['props'];

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