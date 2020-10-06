<?php

use Mirele\Router;

# Endpoint for account registration
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/signup', function () {

    if (is_user_logged_in()) {
        wp_send_json_error([
            'error' => 'The user is already logged in '
        ]);
    } else {

        $props = array(
            'user_email' => (MIRELE_POST)['email'],
            'user_login' => (MIRELE_POST)['login'],
            'user_password' => (MIRELE_POST)['password'],
            'remember' => false
        );

        $user = wc_create_new_customer($props['user_email'], $props['user_login'], $props['user_password']);

        if (is_wp_error($user)) {
            wp_send_json_error(array(
                'status' => 'error',
                'message' => $user->get_error_message()
            ));
        } else {

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

    }

});