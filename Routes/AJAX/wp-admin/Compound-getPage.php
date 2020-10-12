<?php

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Layout;
use Mirele\Compound\Lexer;
use Mirele\Compound\Tag;
use Mirele\Compound\Template;
use Mirele\Router;
use Mirele\Compound\Patterns;

# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-getPage', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $pattern = (new Patterns\propsPage([
            'page'  => (MIRELE_POST)['page']
        ]));

        $buffer = $pattern();

        if (is_array($buffer)) {
            wp_send_json_success($buffer);
        } else {
            wp_send_json_error([]);
        }

    }

});