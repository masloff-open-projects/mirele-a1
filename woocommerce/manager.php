<?php

/**
 * Script to manage all the functions of WooCommerce
 * in the Mirele template. He is responsible for the download priorities,
 * for download areas, for security, for initialization of theme plugins for
 * the shops
 * 
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function woocommerce_manager () {

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

        function woocommerce_settings () {

            register_setting( 'mirele_woo_edit', 'woo_column', '');
            register_setting( 'mirele_woo_edit', 'woo_product_card_theme', '');
            register_setting( 'mirele_woo_edit', 'woo_enoji_without_comments', '');
            register_setting( 'mirele_woo_edit', 'woo_show_related_products_in_single_product_page', '');
            register_setting( 'mirele_woo_edit', 'woo_show_coupon_section_on_checkout_page', '');
            register_setting( 'mirele_woo_edit', 'woo_comment_show_block_login_as', '');
            register_setting( 'mirele_woo_edit', 'woo_price_results_in_table', '');
            register_setting( 'mirele_woo_edit', 'woo_cart_show_totals_block', '');
            register_setting( 'mirele_woo_edit', 'woo_move_the_next_button_to_the_panel_below_the_table', '');
            register_setting( 'mirele_woo_edit', 'woo_fastcart_enabled', '');
            register_setting( 'mirele_woo_edit', 'woo_quickcart_enabled', '');
            register_setting( 'mirele_woo_edit', 'woo_fastcart_hide_title', '');
            register_setting( 'mirele_woo_edit', 'woo_fastcart_title', '');
            register_setting( 'mirele_woo_edit', 'woo_products_list_ajax_load', '');
            register_setting( 'mirele_woo_edit', 'woo_product_modern_picture', '');
            register_setting( 'mirele_woo_edit', 'woo_product_lazy_loader', '');
            register_setting( 'mirele_woo_edit', 'woo_product_modern_picture_offer', '');
            register_setting( 'mirele_woo_edit', 'woo_web_enabled_new_account', '');
            register_setting( 'mirele_woo_edit', 'woo_change_ranger_cart_1', '');
            register_setting( 'mirele_woo_edit', 'woo_change_ranger_cart_2', '');
            register_setting( 'mirele_woo_edit', 'woo_change_ranger_cart_3', '');
            register_setting( 'mirele_woo_edit', 'woo_change_ranger_block_UI', '');
            register_setting( 'mirele_woo_edit', 'woo_alternative_account', '');
            register_setting( 'mirele_woo_edit', 'woo_alternative_account_show_counts', '');
            register_setting( 'mirele_woo_edit', 'woo_hide_page_title', '');
            register_setting( 'mirele_woo_edit', 'woo_account_register_ajax_on', '');
            register_setting( 'mirele_woo_edit', 'woo_account_login_ajax_on', '');
            register_setting( 'mirele_woo_edit', 'woo_account_delayed_launch_on', '');
            register_setting( 'mirele_woo_edit', 'woo_account_can_sort_on', '');
            register_setting( 'mirele_woo_edit', 'woo_alternative_account_plugins_on', '');
            register_setting( 'mirele_woo_edit', 'woo_markup_rows', '');

        }

        function woocommerce_hooks () {

            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
            remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
            remove_action( 'woocommerce_single_product_summary', 'generate_product_data', 60);
            remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
            remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );
            remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
            remove_action( 'wp_footer', array( WC()->structured_data, 'output_structured_data' ), 10 ); // This removes structured data from all frontend pages

            if (get_option('woo_show_coupon_section_on_checkout_page', 'false') == 'true') {
                add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_mirele_coupon_render', 15 );
            }
        
            if (get_option('woo_product_modern_picture', 'false') == 'true') {
                remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
                add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_loop_product_mirele_modern_picture_render', 10 );
            }


            /**
             * If HubSpot integration is enabled, then
             * it needs to be done by hooks
             * 
             * @author: Mirele
             * @package: Mirele
             * @version: 1.0.0
             */

            if (MIRELE_INTEGRATION_HUBSPOT && get_option('mrli_hs_wc_deals', true)) {

                /**
                 * The order was created successfully.
                 * This hook is also called when users create new orders
                 */

                add_action( 'woocommerce_order_status_on-hold', function ( $order_id ) {

                    $order = wc_get_order( $order_id );

                    $owner = MIHubSpot::owners(get_option('mrltkn_hs', false))[0]->ownerId;

                    $deals = MIHubSpot::recent_deals(get_option('mrltkn_hs', false))->results;

                    $products = "";

                    if (get_option('mrli_hs_wc_deals_create_products', false)) {

                        foreach ($order->get_items() as $product) {

                            $product_ = wc_get_product($product->get_product_id());

                            MIHubSpot::create_product(get_option('mrltkn_hs', false), $product['name'], $product_->get_description(), $product['total'], $product_->get_sku());
                        }

                    } else {

                        foreach ($order->get_items() as $product) {
                            $products .= $product['name'] . " (" . $product['qty'] . ")" . "\n";
                        }

                    }

                    foreach ($deals as $deal) {

                        if ($deal->properties->dealname->value == 'Order #' . $order->get_id()) {

                            MIHubSpot::update_deal_status(get_option('mrltkn_hs', false), $deal->dealId, "qualifiedtobuy");

                            return true;

                        }

                    }

                    MIHubSpot::create_deal(get_option('mrltkn_hs', false), $owner, 'Order #' . $order->get_id(), $order->get_total(), $products, "existingbusiness", "qualifiedtobuy");

                });


                /**
                 * The order was completed successfully
                 */

                add_action( 'woocommerce_order_status_completed', function ( $order_id ) {

                    $order = wc_get_order( $order_id );

                    $owner = MIHubSpot::owners(get_option('mrltkn_hs', false))[0]->ownerId;

                    $deals = MIHubSpot::recent_deals(get_option('mrltkn_hs', false))->results;

                    $products = "";

                    foreach ($order->get_items() as $product) {
                        $products .= $product['name'] . " (" . $product['qty'] . ")" . "\n";
                    }

                    foreach ($deals as $deal) {

                        if ($deal->properties->dealname->value == 'Order #' . $order->get_id()) {

                            MIHubSpot::update_deal_status(get_option('mrltkn_hs', false), $deal->dealId, "closedwon");

                            return true;

                        }

                    }


                    MIHubSpot::create_deal(get_option('mrltkn_hs', false), $owner, 'Order #' . $order->get_id(), $order->get_total(), $products, "existingbusiness", "closedwon");

                });

                /**
                 * The order failed.
                 */

                add_action( 'woocommerce_order_status_failed', function ( $order_id ) {

                    $order = wc_get_order( $order_id );

                    $owner = MIHubSpot::owners(get_option('mrltkn_hs', false))[0]->ownerId;

                    $deals = MIHubSpot::recent_deals(get_option('mrltkn_hs', false))->results;

                    $products = "";

                    foreach ($order->get_items() as $product) {
                        $products .= $product['name'] . " (" . $product['qty'] . ")" . "\n";
                    }


                    foreach ($deals as $deal) {

                        if ($deal->properties->dealname->value == 'Order #' . $order->get_id()) {

                            MIHubSpot::update_deal_status(get_option('mrltkn_hs', false), $deal->dealId, "closedlost");

                            return true;

                        }

                    }

                    MIHubSpot::create_deal(get_option('mrltkn_hs', false), $owner, 'Order #' . $order->get_id(), $order->get_total(), $products, "existingbusiness", "closedlost");

                });

                add_action( 'woocommerce_order_status_cancelled', function ( $order_id ) {

                    $order = wc_get_order( $order_id );

                    $owner = MIHubSpot::owners(get_option('mrltkn_hs', false))[0]->ownerId;

                    $deals = MIHubSpot::recent_deals(get_option('mrltkn_hs', false))->results;

                    $products = "";

                    foreach ($order->get_items() as $product) {
                        $products .= $product['name'] . " (" . $product['qty'] . ")" . "\n";
                    }


                    foreach ($deals as $deal) {

                        if ($deal->properties->dealname->value == 'Order #' . $order->get_id()) {

                            MIHubSpot::update_deal_status(get_option('mrltkn_hs', false), $deal->dealId, "closedlost");

                            return true;

                        }

                    }

                    MIHubSpot::create_deal(get_option('mrltkn_hs', false), $owner, 'Order #' . $order->get_id(), $order->get_total(), $products, "existingbusiness", "closedlost");

                });


            }

            if (MIRELE_INTEGRATION_HUBSPOT && get_option('mrli_hs_wc_register_in_crm', false)) {

                add_action('user_register', function ($user_id) {

                    $user = get_user_by('id', $user_id);

                    MIHubSpot::create_contact(get_option('mrltkn_hs', false), $user->user_email, $user->first_name ? $user->first_name : $user->display_name, $user->last_name, '');

                }, 10, 1);

            }

        }


        /**
         * All events that must be completed taking into account
         * Activation of the e-commerce plugin is written in this block.
         * As the main event recorder internal system
         * WooCommerce stands for init.php.
         * 
         * @version: 1.0.0
         */
    
        include_once 'init.php';
    
        // Initializing AJAX Bridge to Connect with WooCommerce
        function woocommerce_ajax() {
    
            /**
             * Some products need to work from outside,
             * using AJAX, Karlin <JQuery, etc. to
             * Deliver product information to Frontend, need a method,
             * described below
             * 
             * @version: 1.0.0
             */
    
            function woo_ajax_current_product () {
                
                ob_start();
                
                global $product;

                if ($_POST['id']) {
                    
                    $product = wc_get_product($_POST['id']);

                    if ($product->is_type( 'variable' ) === true) {
	
                        $variants = []; 
                        foreach ($product->get_available_variations() as $i => $variant) {
                            $variants[$variant['variation_id']] = $variant;
                        }
                        
                    }

                    wp_send_json(array(
                        'product' => $product->get_data(),
                        'id' => $product->get_id(),
                        'variations' => $product->is_type('variable') ? $product->get_available_variations() : false,
                        'variations_format' => $variants ? $variants : false
                    ));

                } else {

                    wp_send_json(array(
                        'product' => $product
                    ));

                }
            
                die();
            }


            /**
             * Squeaks to remove the product from the basket.
             * Originally created to manage FastCart
             * 
             * @version: 1.0.0
             */
    
            function woo_ajax_product_remove () {
                
                ob_start();
            
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
                {
                    if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
                    {
                        WC()->cart->remove_cart_item($cart_item_key);
                    }
                }
            
                WC()->cart->calculate_totals();
                WC()->cart->maybe_set_cart_cookies();
            
                woocommerce_mini_cart();
            
                $mini_cart = ob_get_clean();
            
                $data = array(
                    'status' => 'removed',
                    'total' => get_woocommerce_currency_symbol() . ' ' . WC()->cart->total
                );
            
                wp_send_json( $data );
            
                die();
            }
    
    
            /**
             * Function for receiving goods for FastCart.
             * 
             * Due to the fact that the FastCart plugin is absolutely integrated
             * to the Mirele WooCommerce subsystem, all functions for the plugin
             * it is prescribed exactly inside the core of the subsystem, and not in the zone
             * plugins. Perhaps FastCart will be cut out of the kernel
             * and moved to plugins in version 1.2, but this is not accurate information.
             *
             * @version: 1.0.0
             */
            
            function woo_ajax_fastcart_get () {
    
                ob_start();
            
                $cart = [];
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    
                    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            
                    $cart['cart'][] = array (
                        'id' => $product_id,
                        'cart_item_key' => $cart_item_key,
                        'image' => $_product->get_image_id() ? wp_get_attachment_url($_product->get_image_id()) : wc_placeholder_img_src(),
                        'name' => $_product->name
                    );
                    
                }

                $cart['total'] = get_woocommerce_currency_symbol() . ' ' . WC()->cart->total;
            
                wp_send_json( $cart );
            
                die();
            
            }

            function woo_ajax_quickcart_get () {

                ob_start();

                $cart = [];
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

                    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    $cart['cart'][] = array (
                        'id' => $product_id,
                        'cart_item_key' => $cart_item_key,
                        'image' => $_product->get_image_id() ? wp_get_attachment_url($_product->get_image_id()) : wc_placeholder_img_src(),
                        'name' => $_product->name,
                        'qty' => $cart_item['quantity']
                    );


                }

                $cart['total'] = get_woocommerce_currency_symbol() . ' ' . WC()->cart->total;

                wp_send_json( $cart );

                die();

            }


            /**
             * Function for logout for you account
             *
             * @version: 1.0.0
             */

            function woo_ajax_logout () {
                wp_clear_auth_cookie();
                wp_logout();
                ob_clean();
                wp_die();
            }


            /**
             * Function for login for you account
             *
             * @version: 1.0.0
             */

            function woo_ajax_login () {

                $creds = array(
                    'user_login'    => $_POST['login'],
                    'user_password' => $_POST['password'],
                    'remember'      => $_POST['remember'] == 'true' ? true : false
                );

                $user = wp_signon( $creds, false );

                if ( is_wp_error( $user ) ) {
                    wp_send_json(array(
                        'status' => 'error',
                        'message' => $user->get_error_message()
                    ));
                } else {
                    wp_send_json(array(
                        'status' => 'success'
                    ));
                }

            }


            /**
             * Function for password recovery.
             * Since it is not safe to use multiple requests at different stages of password recovery,
             * the function will restore the password in one approach,
             * by checking the incoming data and sending a password recovery script if successful
             *
             * @version: 1.0.0
             */

            function woo_ajax_restore () {

                $user = get_user_by_email($_POST['email']);
                $adt_rp_key = get_password_reset_key( $user );

                if ( $user->user_login && $user->user_login == $_POST['login']) {

                    $rp_link = "<a href='" . wp_login_url()."?action=rp&key=$adt_rp_key&login=" . rawurlencode($user->user_login) . "'>". wp_login_url()."?action=rp&key=$adt_rp_key&login=" . rawurlencode($user->user_login) ."</a>";

                    $message = "Hello dear user! <br>";
                    $message .= "An account has been created on " . get_bloginfo( 'name' ) . " for email address " . $_POST['email'] . "<br>";
                    $message .= "Click here to set the password for your account: <br>";
                    $message .= $rp_link.'<br>';

                    $headers = array();
                    add_filter( 'wp_mail_content_type', function( $content_type ) {return 'text/html';});
                    $headers[] = "From: " . apply_filters('wp_mail_from', get_option('admin_email'), 1, 30) . "\r\n";
                    $mail_callback        = apply_filters( 'woocommerce_mail_callback', 'wp_mail', '');

                    wp_send_json(array(
                        'status' => 'success',
                        'email_status' => $mail_callback($_POST['email'], __('Password recovery'), $message, $headers, '')
                    ));

                } else {

                    wp_send_json(array(
                        'status' => 'error',
                        'message' => 'There is no user with this email address'
                    ));

                }

            }


            function woo_ajax_register () {

                wp_send_json([
                        'woo' => wc_create_new_customer($_POST['email'], $_POST['username'], $_POST['password']),
                        'account_url' => get_permalink( wc_get_page_id( 'myaccount' ) )
                ]);

            }


            /**
             * AJAX Bridge Feature Zone
             * 
             * @version: 1.0.0
             */
    
            if ( get_option('woo_fastcart_enabled', 'false') == 'true' ) {
    
                add_action( 'wp_ajax_fastcart', 'woo_ajax_fastcart_get' );
                add_action( 'wp_ajax_nopriv_fastcart', 'woo_ajax_fastcart_get' );
            
                add_action( 'wp_ajax_product_remove', 'woo_ajax_product_remove' );
                add_action( 'wp_ajax_nopriv_product_remove', 'woo_ajax_product_remove' ); 
    
            }

            if ( get_option('woo_quickcart_enabled', 'true') == 'true' ) {

                add_action( 'wp_ajax_woo_quickcart_get', 'woo_ajax_quickcart_get' );
                add_action( 'wp_ajax_nopriv_woo_quickcart_get', 'woo_ajax_quickcart_get' );

                add_action( 'wp_ajax_product_remove', 'woo_ajax_product_remove' );
                add_action( 'wp_ajax_nopriv_product_remove', 'woo_ajax_product_remove' );

            }

            add_action( 'wp_ajax_current_product', 'woo_ajax_current_product' );
            add_action( 'wp_ajax_woo_logout', 'woo_ajax_logout' );
            add_action( 'wp_ajax_nopriv_woo_register', 'woo_ajax_register' );
            add_action( 'wp_ajax_nopriv_woo_login', 'woo_ajax_login' );
            add_action( 'wp_ajax_nopriv_woo_restore', 'woo_ajax_restore' );
            add_action( 'wp_ajax_nopriv_current_product', 'woo_ajax_current_product' );

        }
    
        // Absolute redefinition
        add_action('wp', function () {


            /**
             * If the administrator has selected an alternative
             * version of the user's page, then you need to
             * implement absolute redirection of all the shortcodes
             * to the Mirele functions
             */

            if (get_option('woo_alternative_account', 'false') == 'true') {

                remove_shortcode ("woocommerce_my_account");
                add_shortcode ("woocommerce_my_account", function () {
                    do_action('woocommerce_account_mirele_flat_page');
                });

            }

        });
        
        // Settings register
        woocommerce_settings();
        
        // Hooks redirects
        woocommerce_hooks();
    
        // Launch Subsystem WooAJAXBridge
        woocommerce_ajax();
        
        // Subsystem Initialization
        woo_init();

        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
    
        add_action('mirele_header', function(){
            
            if (function_exists('is_woocommerce') and is_woocommerce()) {
                
                if (get_option('woo_fastcart_enabled', 'false') == 'true') {
                    add_action('mirele_footer_before', function () {
                        do_action('woocommerce_cart_mirele_fastcart');
                    });
                }
            
            }            
    
        });
    
    } else {
    
    
        /**
         * If WooCommerce is not installed or
         * not activated, a notification will be displayed in the admin panel
         * that you need to install or activate WooCommerce.
         *
         * Also, all events that must be completed if WooCommerce is disabled
         * must be specified in this block.
         *
         * @version: 1.0.0
         */
    
        add_action('admin_notices', function () {
            ?>
            <div class="notice notice-warning">
                <p>This theme supports WooCommerce. Without him, she would not reveal her entire patent! Please install WooCommerce</p>
            </div>
            <?php
        });
    
    }    

}