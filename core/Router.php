<?php

use \Mirele\Router;
use Mirele\Framework\Buffer;

# AJAX
Router::post('/ajax_endpoint_v1/options', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {

        # Setting up the environment
        $namespace = isset((MIRELE_POST)['namespace']) ? ((MIRELE_POST)['namespace'] === 'all' ? \Mirele\Framework\Customizer::namespaces() : explode('|', (MIRELE_POST)['namespace'])) : '*';
        $buffer = new Buffer();

        # Foreach options store
        foreach ($namespace as $name) {
            foreach (\Mirele\Framework\Customizer::all($name) as $Option) {
                $buffer->setNamespace($name);
                $buffer->append($Option->build());
            }
        }

        # Response
        wp_send_json($buffer->getBuffer((MIRELE_POST)['namespace'] === 'all' ? 'all' : (MIRELE_POST)['namespace']));

    }

});

Router::post('/ajax_endpoint_v1/saveOption', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {

        # Request validation
        if (isset((MIRELE_POST)['name']) and (MIRELE_POST)['namespace'] and (MIRELE_POST)['value']) {
            wp_send_json([
                'data' => update_option((MIRELE_POST)['name'], (MIRELE_POST)['value'])
            ]);

        } else {
            wp_send_json([
                'error' => 'Request is not valid'
            ]);
        }

    }

});

# Rest
Router::post('/rest_endpoint_v1', function () {

});

Router::get('/rest_endpoint_v1/options/get', function () {
    var_dump(\Mirele\Framework\Customizer::all('*'));
});


add_action ('init', function ($next) {

});