<?php

use Mirele\Compound\Response;
use Mirele\Router;

Router::post('/ajax_endpoint_v1/(:all)', function ($path) {

    $run = AJAX::run($path, [
        'verify_nonce' => wp_verify_nonce($_REQUEST['nonce'], MIRELE_NONCE)
    ]);

    if ($run instanceof Response) {
        http_response_code($run->getCode());
        wp_send_json($run->getBody());
    } elseif (is_bool($run)) {
        if ($run === true) {
            wp_send_json_success([]);
        } elseif ($run === false) {
            wp_send_json_error([]);
        } else {
            wp_send_json([]);
        }
    } elseif (is_object($run) or is_array($run)) {
        wp_send_json($run);
    } else {
        print $run;
    }

    exit;

});