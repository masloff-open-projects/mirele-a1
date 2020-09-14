<?php

use \Mirele\Router;
use \Mirele\Framework\Buffer;
use \Mirele\Framework\Inter;
use \Mirele\Framework\Stringer;


# AJAX

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
            'user_login'    => (MIRELE_POST)['login'],
            'user_password' => (MIRELE_POST)['password'],
            'remember'      => (MIRELE_POST)['remember'] == 'true' ? true : false
        );

        $user = wp_signon($props);

        if ( is_wp_error( $user ) ) {
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
            'user_email'    => (MIRELE_POST)['email'],
            'user_login'    => (MIRELE_POST)['login'],
            'user_password' => (MIRELE_POST)['password'],
            'remember'      => false
        );

        $user = wc_create_new_customer($props['user_email'], $props['user_login'], $props['user_password']);

        if ( is_wp_error( $user ) ) {
            wp_send_json_error(array(
                'status' => 'error',
                'message' => $user->get_error_message()
            ));
        } else {

            $user = wp_signon($props);

            if ( is_wp_error( $user ) ) {
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

# Endpoint for account recovery forgot password
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/recoveryPassword', function () {

    if (is_user_logged_in()) {
        wp_send_json_error([
            'error' => 'The user is already logged in '
        ]);
    } else {

        $props = array(
            'user_email'    => (MIRELE_POST)['email'],
            'user_login'    => (MIRELE_POST)['login'],
            'user_key'      => (MIRELE_POST)['key'],
            'user_password' => (MIRELE_POST)['password']
        );

        // User has sent a password
        if (isset($props['user_password']) and $props['user_password'] != '' and $props['user_password'] != false and $props['user_password'] != 'false') {

            $validation = (object) check_password_reset_key($props['user_key'], $props['user_login']);

            if (isset($validation->ID) and isset($validation->user_login) and isset($validation->user_pass)) {

                if (reset_password($validation, $props['user_password']) == null) {

                    $user = wp_signon($props);

                    if ( is_wp_error( $user ) ) {

                        # Error on password update
                        wp_send_json_error(array(
                            'status' => 'error',
                            'message' => 'Error at login to the account after password change.'
                        ));

                    } else {

                        # Valid password reset request verification key
                        wp_send_json_success(array(
                            'status' => 'password_change',
                            'message' => ''
                        ));

                    }


                } else {

                    # Error on password update
                    wp_send_json_error(array(
                        'status' => 'error',
                        'message' => 'Error on password update '
                    ));

                }

            } else {

                # Invalid password reset request verification key
                wp_send_json_error(array(
                    'status' => 'error',
                    'message' => 'Invalid password reset request verification key'
                ));

            }

        }

        // User got the password recovery key, we can perform the password reset procedure.
        else if (isset($props['user_key']) and $props['user_key'] != '' and $props['user_key'] != false and $props['user_key'] != 'false') {

            $validation = (object) check_password_reset_key($props['user_key'], $props['user_login']);

            if (isset($validation->ID) and isset($validation->user_login) and isset($validation->user_pass)) {

                # Valid password reset request verification key
                wp_send_json_success(array(
                    'status' => 'code_correct',
                    'message' => check_password_reset_key($props['user_key'], $props['user_login'])
                ));

            } else {

                # Invalid password reset request verification key
                wp_send_json_error(array(
                    'status' => 'error',
                    'message' => 'Invalid password reset request verification key'
                ));

            }

        }

        // User did not send anything, except public account data
        else {

            # Create an email and send it to the user's mail
            $user = get_user_by_email($props['user_email']);
            $adt_rp_key = get_password_reset_key( $user );

            # User not found
            if (!isset($user->user_login)) {

                wp_send_json_error(array(
                    'status' => 'error',
                    'message' => 'User not found'
                ));

            }

            # Wrong user login
            elseif (isset($user->user_login) and $user->user_login != $props['user_login']) {

                wp_send_json_error(array(
                    'status' => 'error',
                    'message' => 'Wrong user login'
                ));

            }

            # All data is correct
            else {


                $rp_link = "<a href='" . wp_login_url()."?action=rp&key=$adt_rp_key&login=" . rawurlencode($user->user_login) . "'>". wp_login_url()."?action=rp&key=$adt_rp_key&login=" . rawurlencode($user->user_login) ."</a>";

                $message = "Hello dear user! <br>";
                $message .= "An account has been created on " . get_bloginfo( 'name' ) . " for email address " . $_POST['email'] . "<br>";
                $message .= "Click here to set the password for your account: <br>";
                $message .= $rp_link.'<br>';

                $headers = array();
                add_filter( 'wp_mail_content_type', function( $content_type ) {return 'text/html';});
                $headers[] = "From: " . apply_filters('wp_mail_from', get_option('admin_email'), 1, 30) . "\r\n";
                $mail_callback        = apply_filters( 'woocommerce_mail_callback', 'wp_mail', '');
                $status = $mail_callback($_POST['email'], __('Password recovery'), $message, $headers, '');

                if ($adt_rp_key) {

                    wp_send_json_success(array(
                        'status' => 'code_send',
                        'message' => (new Stringer("{URL}?key={KEY}"))::format([
                            '{URL}' => wp_lostpassword_url(),
                            '{KEY}' => base64_encode(json_encode((object) [
                                'key' => $adt_rp_key,
                                'login' => $props['user_login'],
                                'email' => $props['user_email']
                            ]))
                        ])
                    ));

                } else {

                    wp_send_json_error(array(
                        'status' => 'error',
                        'message' => 'User not found'
                    ));

                }

                if ($status) {

                    wp_send_json_success(array(
                        'status' => 'success'
                    ));

                } else {



                }
            }

        }

    }

});

# Endpoint to receive registered options
# Endpoint Version: 1.0.0
# Distributors: AJAX
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

# Endpoint for specific product information
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/product', function () {

    $id = (MIRELE_POST)['id'];

    wp_send_json(wc_get_product($id));

});

# Endpoint to save or update options
# Endpoint Version: 1.0.0
# Distributors: AJAX
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

# Endpoint to add goods to user cart
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/WCAddToCart', function () {

    # Parse params
    $ID  = (int) (new Inter((MIRELE_POST)['product_id']))::ABS();
    $QTY = (int) (new Inter((MIRELE_POST)['product_quantity']))::ABS();
    $VariationID = (int) (new Inter((MIRELE_POST)['product_variation_id']))::ABS();
    $VariationAttr = (MIRELE_POST)['product_variation'];

    # Checking if it is possible to add the goods to the cart.
    if (apply_filters('woocommerce_add_to_cart_validation', true, $ID, $QTY)) {

        # Create cart
        $CartItem = WC()->cart->add_to_cart($ID, $QTY, $VariationID, $VariationAttr);

        if ($CartItem) {

            do_action('woocommerce_ajax_added_to_cart', $ID);

            if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                wc_add_to_cart_message(array($ID => $QTY), true);
            }

            wp_send_json([
                'id' => $CartItem
            ]);
        } else {
            wp_send_json([
                'error' => 'This product was not added to the cart.'
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