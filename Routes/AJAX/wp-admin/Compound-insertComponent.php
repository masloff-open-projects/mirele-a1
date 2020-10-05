<?php

use Mirele\Compound\Lexer;
use Mirele\Router;
use Mirele\Compound\Patterns;

Router::post('/ajax_endpoint_v1/Compound-insertComponent', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        # Create a work environment
        $component = (MIRELE_POST)['component'];
        $page      = (MIRELE_POST)['page'];
        $nonce     = (MIRELE_POST)['nonce'];
        $field     = (MIRELE_POST)['field'];
        $template  = (MIRELE_POST)['template'];

        $pattern = new Patterns\insertComponent();
        $pattern->setPage($page);
        $pattern->setComponent($component);
        $pattern->setField($field);
        $pattern->setTemplate($template);

        $pattern->execute();

        wp_send_json_error([]);
        return;

    }

});
