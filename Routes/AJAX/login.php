<?php

use Mirele\Router;

# Endpoint for user authorization in the system
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/login', function () {

    if (is_user_logged_in()) {
        wp_send_json_error([
            'error' => 'The user is already logged in '
        ]);
    } else {

        $props = array(
            'user_login' => (MIRELE_POST)['login'],
            'user_password' => (MIRELE_POST)['password'],
            'remember' => (MIRELE_POST)['remember'] == 'true' ? true : false
        );

        $user = wp_signon($props);

        if (is_wp_error($user)) {
            wp_send_json_error(array(
                'status' => 'error',
                'message' => $user->get_error_message()
            ));
        } else {
            wp_send_json_success(array(
                'status' => 'success'
            ));
        }

    }

});