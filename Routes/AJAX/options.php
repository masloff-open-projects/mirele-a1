<?php

use Mirele\Framework\Buffer;
use Mirele\Framework\Customizer;
use Mirele\Router;

# Endpoint to receive registered options
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/options', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {

        # Setting up the environment
        $namespace = isset((MIRELE_POST)['namespace']) ? ((MIRELE_POST)['namespace'] === 'all' ? Customizer::namespaces() : explode('|', (MIRELE_POST)['namespace'])) : '*';
        $buffer = new Buffer();

        # Foreach options store
        foreach ($namespace as $name) {
            foreach (Customizer::all($name) as $Option) {
                $buffer->setNamespace($name);
                $buffer->append($Option->build());
            }
        }

        # Response
        wp_send_json($buffer->getBuffer((MIRELE_POST)['namespace'] === 'all' ? 'all' : (MIRELE_POST)['namespace']));

    }

});