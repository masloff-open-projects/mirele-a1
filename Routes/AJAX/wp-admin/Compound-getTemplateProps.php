<?php

use Mirele\Compound\Patterns;
use Mirele\Router;


# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-getTemplateProps', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $pattern = new Patterns\propsTemplate();
        $pattern->template = (MIRELE_POST)['template'];
        $pattern->page = (MIRELE_POST)['page'];

        wp_send_json_success(['props' => $pattern()]);
        return;

    }

});