<?php

use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Lexer;
use Mirele\Compound\Store;
use Mirele\Compound\Tag;
use Mirele\Router;
use Mirele\Compound\Patterns;


# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-updatePage', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $pattern = (new Patterns\updatePage([
            'page'  => (MIRELE_POST)['page'],
            'props' => (MIRELE_POST)['props']
        ]));

        $buffer = $pattern();

        wp_send_json_success([$buffer]);

    }

});