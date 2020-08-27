<?php

use \Mirele\Router;

add_action ('init', function () {

    # AJAX
    Router::post('/ajax_endpoint_v1', function () {

        wp_send_json(MIRELE_POST);

    });

    # Rest
    Router::post('/rest_endpoint_v1', function () {

    });
});