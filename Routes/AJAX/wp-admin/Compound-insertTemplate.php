<?php

use Mirele\Compound\Lexer;
use Mirele\Router;
use Mirele\Compound\Patterns;

Router::post('/ajax_endpoint_v1/Compound-insertTemplate', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        # Create a work environment
        $page      = (MIRELE_POST)['page'];
        $nonce     = (MIRELE_POST)['nonce'];
        $template  = (MIRELE_POST)['template'];

        $pattern = new Patterns\insertTemplate();
        $pattern->setTemplate($template);
        $pattern->setPage($page);
        $pattern->execute();

        $pattern->execute();

        wp_send_json_error([]);
        return;

    }

});
