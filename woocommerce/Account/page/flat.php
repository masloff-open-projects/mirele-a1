<?php

function woocommerce_account_mirele_flat_page_render () {


    /**
     * Let's learn page routing,
     * since the shortcode can be called on different pages,
     * the code should start focusing on where it is executed
     * in order to give the desired template to the user.
     *
     * @version 1.0.0
     */

    global $post;
    global $user_id;
    global $user_info;
    global $customer;
    global $url;

    $myaccount_page_id     = wc_get_page_id ( 'myaccount' );
    $shop_page_id          = wc_get_page_id ( 'shop' );
    $cart_page_id          = wc_get_page_id ( 'cart' );
    $checkout_page_id      = wc_get_page_id ( 'checkout' );
    $terms_page_id         = wc_get_page_id ( 'terms' );
    $user_id               = get_current_user_id ();
    $user_info             = wp_get_current_user();
    $customer              = new WC_Customer($user_id);
    $url                   = MIRELE_URL . "?" . http_build_query(array('page' => isset($_GET['page']) ? $_GET['page'] : 'default', 'page_id' => isset($_GET['page_id']) ? $_GET['page_id'] : 'default'));


    /**
     * All pages of this topic will be in an abstract class,
     * so we will not throw the user to different pages by redirect,
     * but will be able to do multirouting*,
     * which will allow us to output content on a page
     * with id 78 that should only be output on page 75
     *
     * @version 1.0.0
     */

    abstract class WooMirelePage {


        /**
         * Full account page.
         * On it, the user can find everything
         * you need to navigate through the account.
         *
         * @version 1.0.0
         */

        static public function account () {

            global $post;
            global $user_id;
            global $customer;
            global $user_info;
            global $url;

            do_action("woocommerce_account_before");
            do_action("woocommerce_account_start");

            ?>

            <?php if (get_option('woo_account_delayed_launch_on', 'true') == 'true' ): ?>
            <div class="woo-content-center" data-delayed="#woo-account">
                <img src="<?php echo MIRELE_SOURCE_DIR . '/img/loaders/standart.svg'; ?>" alt="loading" width="26px">
                <small class="woo-loading-text">LOADING</small>
            </div>
            <?php endif; ?>

            <div id="woo-account" <?php if (get_option('woo_account_delayed_launch_on', 'true') == 'true' ) { echo "style=\"display: none\""; } ?>>

                <?php do_action('woocommerce_before_account_navigation'); ?>
                <?php do_action('woocommerce_after_account_navigation'); ?>
                <?php do_action('woocommerce_before_my_account'); ?>
                <?php woocommerce_output_all_notices(5); ?>


                <!--Quick view account cell-->
                <div class="container-fluid woo-account-header woo-account-margin">
                    <div class="row">

                        <div class="col-sm-5">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-3 woo-box-avatar">
                                        <img data-src="<?php echo !empty(get_avatar_url ($user_id)) ? get_avatar_url ($user_id) : wc_placeholder_img_src(); ?>" alt="" class="woo-avatar" data-loading="lazy">
                                    </div>
                                    <div class="col-sm-9 el_150972638">
                                        <div class="container-fluid woo-box-center">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="el_3453456654"><?php echo !empty($user_info->first_name) ? $user_info->first_name . ' ' . $user_info->last_name : $user_info->nickname; ?></h3>
                                                    <p><?php echo $user_info->user_email ?></p>
                                                    <small><?php echo ucfirst(join(", ", $user_info->roles)) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-5">

                            <div class="container-fluid woo-box-center">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <?php if ($customer->get_billing_city()): ?>

                                            <h5 class="el_3453456654">Builing address
                                                <a href="<?php echo $url . "&edit-address=billing"; ?>" class="el_3453456653">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </h5>
                                            <small> <?php $addr = (array) $customer->get_billing(); echo $addr['state'] . ', ' . $addr['city'] . ', ' . $addr['address_2'] . ' ' . $addr['address_1'] ?> </small>

                                        <?php endif; ?>


                                        <?php if (get_option('woocommerce_ship_to_destination') != 'billing'): ?>

                                            <?php if ($customer->get_shipping_city()): ?>

                                                <h5>Shipping address
                                                    <a href="<?php echo $url . "&edit-address=shipping"; ?>" class="el_3453456653">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </h5>
                                                <small> <?php $addr = (array) $customer->get_shipping(); echo $addr['state'] . ', ' . $addr['city'] . ', ' . $addr['address_2'] . ' ' . $addr['address_1'] ?> </small>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-2 text-right el_3453456651">

                            <a href="<?php echo wc_customer_edit_account_url(); ?>" class="el_3453456652">
                                <i class="fas fa-pen"></i>
                            </a>

                            <a href="javascript:;" class="el_3453456652" data-action="woo_logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>

                        </div>

                    </div>
                </div>

                <!--Quick card cell-->
                <?php if (get_option('woo_alternative_account_show_counts', 'true') == 'true'): ?>

                    <div class="container-fluid woo-account-margin">

                        <h4>Statistics on your orders</h4>

                        <div class="row">

                            <div class="col-sm-3 col-xs-3">
                                <h3> <?php

                                    $count = 0;
                                    foreach (woo()->account->orders as $order) {
                                        if ($order->post_status=='wc-completed') {
                                            $count++;
                                        }
                                    }

                                    echo $count ?> </h3>
                                <p>Orders completed</p>
                            </div>
                            <div class="col-sm-3 col-xs-3">
                                <?php

                                $count = 0;
                                foreach (woo()->account->orders as $order) {
                                    if ($order->post_status=='wc-pending') {
                                        $count++;
                                    }
                                }

                                ?>

                                <h3 <?php if ($count > 0) { echo 'style="color: #F5B947;filter: drop-shadow(0px 0px 6px #F5B947);"'; } ?> > <?php echo $count; ?> </h3>
                                <p>Orders waiting for payment</p>
                            </div>

                            <div class="col-sm-3 col-xs-3">
                                <?php

                                $count = 0;
                                foreach (woo()->account->orders as $order) {
                                    if ($order->post_status=='wc-on-hold') {
                                        $count++;
                                    }
                                }

                                ?>

                                <h3> <?php echo $count; ?> </h3>
                                <p>Orders on hold</p>
                            </div>
                            <div class="col-sm-3 col-xs-3">
                                <?php

                                $count = 0;
                                foreach (woo()->account->orders as $order) {
                                    if ($order->post_status=='wc-cancelled') {
                                        $count++;
                                    }
                                }

                                ?>

                                <h3> <?php echo $count; ?> </h3>
                                <p>Orders cancelled</p>
                            </div>

                        </div>
                    </div>

                <?php endif; ?>

                <div <?php if (get_option('woo_account_delayed_launch_on', 'true') == 'true' ) { echo "class=\"account-sort\""; } ?> >

                    <!--Orders-->
                    <div id="woo_orders_table" class="container-fluid woo-account-margin woo-table-order">

                        <h4 class="woo-card-title">Your recent orders.</h4>

                        <?php

                        if (wc_get_customer_order_count($user_id) > 0) {

                            ?> <div class="woo-table-container"> <?php

                                do_action("woocommerce_account_mirele_table_orders");

                                ?> </div> <?php

                        } else {
                            do_action("woocommerce_account_mirele_oreders_none");
                        }

                        ?>

                    </div>

                    <!--Downloads-->
                    <div id="woo_downloads_table" class="container-fluid woo-account-margin woo-table-order">

                        <h4 class="woo-card-title">Your digital products</h4>

                        <?php

                        if (count(WC()->customer->get_downloadable_products()) > 0) {

                            ?> <div class="woo-table-container"> <?php

                                do_action("woocommerce_account_mirele_table_downloads");

                                ?> </div> <?php

                        } else {
                            do_action("woocommerce_account_mirele_downloads_none");
                        }

                        ?>

                    </div>

                    <?php if (get_option('woo_alternative_account_plugins_on', 'false') == 'true' ): foreach ( wc_get_account_menu_items() as $endpoint => $label ) : if (!in_array($endpoint, array('dashboard', 'orders', 'downloads', 'edit-address', 'edit-account', 'customer-logout'))): ?>


                        <?php if ( has_action( 'woocommerce_account_' . $endpoint . '_endpoint' ) ): ?>

                            <div id="woo_<?php echo (mb_strtolower(str_replace([' '], "_", $endpoint))) ?>" class="container-fluid woo-account-margin woo-table-order">

                                <h4><?php echo $label; ?></h4>

                                <?php do_action( 'woocommerce_account_' . $endpoint . '_endpoint', "" ); ?>

                            </div>


                        <?php endif; ?>

                    <?php endif; endforeach; endif; ?>

                </div>

            </div>

            <?php

            do_action("woocommerce_account_end");
            do_action("woocommerce_account_after");

        }


        /**
         * Login page in your account.
         * Made in Mirelle and Flat style.
         * Partially supports shortcodes for using plugins,
         * but since the standard authorization was changed by Ajax authorization,
         * some plugins will not work.
         *
         * PS. I created no-Ajax support
         *
         * @version 1.0.0
         */

        static public function login () {

            global $post;
            global $url;

            ?>

            <div class="woo-content-center">

                <div class="container">
                    <div class="row">

                        <div class="col-sm-6">
                            <img data-src="<?php echo MIRELE_SOURCE_DIR . '/img/forms/login.jpg'; ?>" class="woo-login-image" data-loading="lazy">
                        </div>

                        <div class="col-sm-4">
                            
                            <h1>Login to <?php echo bloginfo('name') ?></h1>
                            <p>Welcome to our website! We are very happy that you have an account on our portal</p>

                            <?php do_action( 'woocommerce_before_customer_login_form' ); ?>

                            <form <?php if ( get_option( 'woo_account_login_ajax_on', 'false' ) == 'true' ) { echo "data-action=\"woo_login\""; } else { echo "method=\"POST\""; } ?>>

                                <?php do_action( 'woocommerce_login_form_start' ); ?>
                                <?php do_action( 'woocommerce_login_form' ); ?>

                                <div>
                                    <input type="text" required="required"  placeholder="Your login" class="woo-login-input" name="username">
                                </div>

                                <div>
                                    <input type="password" required="required" placeholder="Your password" class="woo-login-input" name="password">
                                </div>

                                <div class="woo-login-input">

                                    <p>
                                        <input type="checkbox" value="true" name="remember">
                                        Remember me
                                    </p>

                                </div>

                                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                
                                <div class="el_3438629521" id="woo_login_form_warning" style="display: none;"></div>

                                <div class="woo-login-submit">
                                    <input type="submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">

                                    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' )): ?>
                                        <a href="<?php echo get_permalink($post->ID); ?>?register" class="woo-sub-form-urls">Register</a>
                                    <?php endif; ?>

                                </div>

                                <?php do_action( 'woocommerce_login_form_end' ); ?>

                            </form>

                            <?php do_action( 'woocommerce_after_customer_login_form' ); ?>

                        </div>
                    </div>
                </div>

            </div>

            <?php

        }


        /**
         * Registration form on the site.
         * It supports the AJAX version of sending data,
         * but it does not allow integration of standard plugins,
         * since the form is extremely limited by sending requests
         * to new methods defined by a third-party Mirelle Manager
         *
         * @version 1.0.0
         */

        static public function register () {

            global $post;
            global $url;

            ?>

            <div class="woo-content-center">

                <div class="container">
                    <div class="row">

                        <div class="col-sm-6">
                            <img src="<?php echo MIRELE_SOURCE_DIR . '/img/forms/register.jpg'; ?>" class="woo-login-image">
                        </div>

                        <div class="col-sm-4">

                            <h1>Welcome to <?php echo bloginfo('name') ?></h1>
                            <p>By creating an account on our site, you can manage your orders, participate in promotions, buy products in two clicks, and much more</p>


                            <?php do_action( 'woocommerce_before_customer_login_form' ); ?>

                            <form <?php if ( get_option( 'woo_account_register_ajax_on', 'false' ) == 'true' ) { echo "data-action=\"woo_register\""; } else { echo do_action( 'woocommerce_register_form_tag' ) . "method=\"POST\""; } ?>>

                                <?php do_action( 'woocommerce_register_form_start' ); ?>

                                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                                    <div>
                                        <input type="text" required="required" placeholder="<?php esc_html_e( 'Username', 'woocommerce' ); ?>" class="woo-login-input" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>">
                                    </div>

                                <?php endif; ?>

                                    <div>
                                        <input type="email" required="required" placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" class="woo-login-input" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>">
                                    </div>

                                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                                    <div>
                                        <input type="password" required="required" placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" class="woo-login-input" name="password" id="password" autocomplete="current-password">
                                    </div>

                                <?php else : ?>

                                    <p> <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ2OS4zMzMgNDY5LjMzMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDY5LjMzMyA0NjkuMzMzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PGc+PHBhdGggZD0iTTI0OC41MzMsMTkyYy0xNy42LTQ5LjcwNy02NC44NTMtODUuMzMzLTEyMC41MzMtODUuMzMzYy03MC43MiwwLTEyOCw1Ny4yOC0xMjgsMTI4czU3LjI4LDEyOCwxMjgsMTI4YzU1LjY4LDAsMTAyLjkzMy0zNS42MjcsMTIwLjUzMy04NS4zMzNoOTIuOHY4NS4zMzNoODUuMzMzdi04NS4zMzNoNDIuNjY3VjE5MkgyNDguNTMzeiBNMTI4LDI3Ny4zMzNjLTIzLjU3MywwLTQyLjY2Ny0xOS4wOTMtNDIuNjY3LTQyLjY2N1MxMDQuNDI3LDE5MiwxMjgsMTkyYzIzLjU3MywwLDQyLjY2NywxOS4wOTMsNDIuNjY3LDQyLjY2N1MxNTEuNTczLDI3Ny4zMzMsMTI4LDI3Ny4zMzN6Ii8+PC9nPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48L3N2Zz4=" alt="" style="width: 14px; margin-right: 6px; margin-left: 7px;"> <?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

                                <?php endif; ?>

                                <p class="woocommerce-FormRow form-row">
                                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                                </p>

                                <div class="el_3438629521" id="woo_register_form_warning" style="display: none;"></div>

                                <?php do_action( 'woocommerce_register_form' ); ?>

                                <?php do_action( 'woocommerce_register_form_end' ); ?>

                                <div class="woo-login-submit">
                                    <input type="submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                                    <a href="<?php echo get_permalink($post->ID); ?>" class="woo-sub-form-urls">Login</a>
                                </div>

                            </form>

                            <?php do_action( 'woocommerce_after_customer_login_form' ); ?>

                        </div>
                    </div>
                </div>

            </div>

            <?php

        }


        /**
         * Access restriction page.
         * Some pages should not be accessed by the user,
         * but if they were somehow able to access it,
         * you need to block access to the content that
         * should be issued. This universal plug is used
         * for this purpose
         *
         * @version 1.0.0
         */

        static public function no_access () {

            global $url;

            ?>

                <div class="woo-content-center">
                    <div class="text-center">
                        <img width="64px" data-src="<?php echo PATH_EMOJI_DEAD; ?>" class="el_698985002" data-loading="lazy">
                        <h3>Access denied!</h3>
                        <p>You are not allowed to access this page! If you think this is an error, contact the site administrator</p>
                    </div>
                </div>

            <?php

        }


        /**
         * Password recovery page.
         * The page has new redefined AJAX methods (there is no support for standard queries),
         * which are quite secure, since they use a one-step password recovery procedure:
         * FORM -> AJAX REQUEST (lost_password) - > RESPONSE.
         * The second function is not used in the chain. If successful,
         * the user will be sent a message with a link to restore their password to their email address.
         * If it fails, it will receive a message with the error text.
         * The function also checks the validity of data passed by the user
         *
         * @version 1.0.0
         */

        static public function lost_password () {

            global $url;

            ?>

            <div class="woo-content-center">

                <div class="container">
                    <div class="row">

                        <div class="col-sm-6">
                            <img src="<?php echo MIRELE_SOURCE_DIR . '/img/forms/forgot.jpg'; ?>" class="woo-login-image">
                        </div>

                        <div class="col-sm-4">

                            <h1>Step by step we will restore your password</h1>
                            <p>If you forgot your password, we can quickly restore it. <br>
                                Enter your username and email address from your account in the form below. <br>
                                We will send you a link to restore your password. <br>
                                If the email doesn't arrive, check the spam folder in your email</p>

                            <?php do_action( 'woocommerce_before_customer_login_form' ); ?>

                            <form  <?php if ( get_option( 'woo_account_login_ajax_on', 'false' ) == 'true' ) { echo "data-action=\"woo_restore\""; } else { echo "method=\"POST\""; } ?> <?php do_action( 'woocommerce_register_form_tag' ); ?> >
                                <div>
                                    <input type="text" placeholder="Your login" class="woo-login-input" name="login">
                                </div>

                                <div>
                                    <input type="email" placeholder="Your email" class="woo-login-input" name="email">
                                </div>

                                <div class="el_3438629521" id="woo_restore_form_warning" style="display: none;"></div>

                                <div class="woo-login-submit">
                                    <input type="submit" value="Continue">
                                </div>

                            </form>

                            <?php do_action( 'woocommerce_after_customer_login_form' ); ?>

                        </div>
                    </div>
                </div>

            </div>

            <?php

        }


        /**
         * Order viewing page.
         * Checks if the user has an order in their account,
         * then it will give them a page with the" Stages " of the order.
         * A good form for presenting order data.
         * If the user is not allowed to view the order,
         * they will be given a page with an access error
         *
         * @version 1.0.0
         */

        static public function order ($id) {

            global $user_id;
            global $url;
            $order = wc_get_order($id);

            if ($order) {
                if ($order->get_user_id() == $user_id) {

                    ?>

                    <div class="container-fluid">

                        <?php if (get_option('woo_hide_page_title', 'false') == 'true'): ?>

                            <h1>Order №<?php echo $order->get_id(); ?>
                                <?php if(current_user_can( 'edit_post', $id)): ?>

                                    <a href="<?php echo $order->get_edit_order_url(); ?>">
                                        <i class="fas fa-pencil-alt" style="font-size: 0.6em; color: #aaa; padding: 2px 2px; margin: 0px 0px 3px 3px;"></i>
                                    </a>

                                <?php endif; ?>
                            </h1>

                        <?php endif; ?>

                        <div class="row">
                            <div class="col-sm-9">

                                <h4>Information about your order</h4>

                                <?php if (!empty($order->get_date_completed())): ?>

                                    <div class="steps_success">
                                        <h5>Success! <small><?php echo date("m.d.y H:i", strtotime($order->get_date_completed())); ?></small></h5>
                                        <p>Your order was successfully completed</p>
                                    </div>

                                <?php endif; ?>

                                <?php if ($order->get_status() == 'processing'): ?>

                                    <div class="steps">
                                        <h5>The order in the process <small><?php echo date("m.d.y H:i", strtotime($order->get_date_modified())); ?></small></h5>
                                        <p>Expect news from the supplier, soon your order will change its status to a more specific one</p>
                                    </div>

                                <?php elseif ($order->get_status() == 'pending'): ?>

                                    <div class="steps">
                                        <h5>Waiting for payment <small><?php echo date("m.d.y H:i", strtotime($order->get_date_modified())); ?></small></h5>
                                        <p>The store expects payment from you. You can pay for an order from your personal account.</p>
                                    </div>

                                <?php elseif ($order->get_status() == 'on-hold'): ?>

                                    <div class="steps">
                                        <h5>On hold <small><?php echo date("m.d.y H:i", strtotime($order->get_date_modified())); ?></small></h5>
                                        <p>Your order is under approval.</p>
                                    </div>

                                <?php elseif ($order->get_status() == 'cancelled'): ?>

                                    <div class="steps_error">
                                        <h5>The order was canceled <small><?php echo date("m.d.y H:i", strtotime($order->get_date_modified())); ?></small></h5>
                                        <p>Your order was canceled. If you think that this happened by mistake, contact the site administrator</p>
                                    </div>

                                <?php elseif ($order->get_status() == 'refunded'): ?>

                                    <div class="steps_success">
                                        <h5>Refunded <small><?php echo date("m.d.y H:i", strtotime($order->get_date_modified())); ?></small></h5>
                                        <p>Your order has been successfully refunded!</p>
                                    </div>

                                <?php elseif ($order->get_status() == 'failed'): ?>

                                    <div class="steps_error">
                                        <h5>Order failed <small><?php echo date("m.d.y H:i", strtotime($order->get_date_modified())); ?></small></h5>
                                        <p>Your order failed. If you think that this happened by mistake, contact the site administrator</p>
                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($order->get_date_paid())): ?>

                                    <div class="steps">
                                        <h5>The order is paid <small><?php echo date("m.d.y H:i", strtotime($order->get_date_paid())); ?></small></h5>
                                        <p>You have successfully paid for the order. <?php echo $order->get_transaction_id() ? 'Transaction ID: ' . $order->get_transaction_id() : '' ?> </p>
                                    </div>

                                <?php else: ?>

                                    <div class="steps_error">
                                        <h5>Not paid</h5>
                                        <p>You didn't pay for the order</p>
                                    </div>

                                <?php endif; ?>

                                <?php if ($order->get_address()): ?>

                                    <div class="steps">
                                        <h5>The delivery address is defined</h5>
                                        <p>The order will be delivered to the address and you will be notified of the following information: <br> <?php echo join("<br>", $order->get_address()); ?></p>
                                    </div>

                                <?php endif; ?>

                                <div class="steps">
                                    <h5>Determined type of payment</h5>
                                    <p>You have defined the payment type for the order as "<?php echo $order->get_payment_method_title(); ?>"</p>
                                </div>


                                <?php if (!empty($order->get_customer_note())): ?>

                                    <div class="steps">
                                        <h5>Created note</h5>
                                        <p><?php echo $order->get_customer_note(); ?></p>
                                    </div>

                                <?php endif; ?>

                                <div class="steps">
                                    <h5>The order is created <small><?php echo date("m.d.y H:i", strtotime($order->get_date_created())); ?></small></h5>
                                    <p>You have successfully created your order for the amount of <?php echo get_woocommerce_currency_symbol() . $order->get_total(); ?>!</p>
                                </div>

                                <?php if (count( $order->get_items() ) > 0): ?>

                                    <h4>Order items</h4>

                                    <?php foreach ( $order->get_items() as $item_id => $item ): $product = wc_get_product ( $item->get_product_id() ); if ($product): ?>

                                        <?php

                                        if ($product->get_image_id()) {
                                            $thumbl = wp_get_attachment_image_src($product->get_image_id(), 'thumbnail');
                                        }

                                        $image = $product->get_image_id() ? ($thumbl != false ? $thumbl[0] : wc_placeholder_img_src()) : wc_placeholder_img_src();


                                        ?>

                                        <a href="<?php echo get_permalink ($item->get_product_id()) ?>">
                                            <img data-src="<?php echo $image; ?>" alt="" class="woo-product-picture-small"  data-loading="lazy">
                                        </a>

                                    <?php endif; endforeach; ?>

                                <?php endif; ?>

                            </div>

                            <div class="col-sm-3">

                                <h4>Notes</h4>

                                <ul class="woo-notes">

                                    <?php foreach (wc_get_order_notes(['order_id' => $id]) as $note): ?>

                                        <li class="woo-<?php echo $note->customer_note ? 'user' : 'shop' ?>-note">
                                            <p>
                                                <?php echo $note->content; ?>
                                            </p>
                                        </li>

                                    <?php endforeach; ?>

                                </ul>

                            </div>
                        </div>

                    </div>

                    <?php

                } else {

                    ?>

                    <div class="woo-content-center">
                        <div class="text-center">
                            <h3>This is not your order</h3>
                            <p>You can't view someone else's orders, because they are private and we can't disclose it</p>
                        </div>
                    </div>

                    <?php

                }
            } else {

                ?>

                <div class="woo-content-center">
                    <div class="text-center">
                        <h3>This order does not exist</h3>
                        <p>You cannot view order information since it does not exist</p>
                    </div>
                </div>

                <?php

            }


        }

        static public function edit_account () {

            global $customer;
            global $user_info;
            global $post;
            global $url;

            $user = $user_info;

            ?>

            <div class="woo-content-center">

                <? do_action( 'woocommerce_before_edit_account_form' ); ?>

                <div class="container-fluid">

                    <?php woocommerce_output_all_notices(5); ?>

                    <div class="row">

                        <div class="col-sm-6">

                            <h1>Edit your account</h1>
                            <p>Your account is your face of our portal! Please do not use bad words in your username or account name. </p>

                            <?php if (empty($user->first_name) && empty($user->last_name)): ?>
                                <p>We noticed that you didn't set your <b>first name</b> and <b>last name</b>.  Please do it now. This way you won't need to fill in your personal data for the first orders</p>

                            <?php elseif (empty($user->first_name)): ?>
                                <p>We noticed that you didn't set your <b>first name</b>. Please do it now. This way you won't need to fill in your personal data for the first orders</p>

                            <?php elseif (empty($user->last_name)): ?>
                                <p>We noticed that you didn't set your <b>last name</b>. Please do it now. This way you won't need to fill in your personal data for the first orders</p>

                            <?php endif; ?>

                            <form class="woocommerce-EditAccountForm edit-account" data-action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

                                <?php do_action( 'woocommerce_edit_account_form_start' ); ?>
                                <?php do_action( 'woocommerce_edit_account_form' ); ?>

                                <div class="container-fluid">

                                    <div class="row">

                                        <div class="col-sm-6 woo-account-edit-row">
                                            <div>
                                                <input type="text" required="required" placeholder="<?php esc_html_e( 'First name', 'woocommerce' ); ?>" class="woo-account-edit-input" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6 woo-account-edit-row">
                                            <div>
                                                <input type="text" required="required" placeholder="<?php esc_html_e( 'Last name', 'woocommerce' ); ?>" class="woo-account-edit-input" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" >
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 woo-account-edit-row">
                                            <div>
                                                <input type="text" required="required" placeholder="<?php esc_html_e( 'Display name', 'woocommerce' ); ?>" class="woo-account-edit-input" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 woo-account-edit-row">
                                            <div>
                                                <input type="email" required="required" placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" class="woo-account-edit-input"  name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" >
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="col-sm-12 woo-account-edit-row">
                                            <div>
                                                <input type="password" placeholder="<?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?>" class="woo-account-edit-input" name="password_current" id="password_current" autocomplete="off" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-6 woo-account-edit-row">
                                            <div>
                                                <input type="password" placeholder="<?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?>" class="woo-account-edit-input" name="password_1" id="password_1" autocomplete="off" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6 woo-account-edit-row">
                                            <div>
                                                <input type="password" placeholder="<?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>" class="woo-account-edit-input" name="password_2" id="password_2" autocomplete="off" >
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-12 woo-account-edit-row">
                                            <div>

                                                <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
                                                <button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
                                                <input type="hidden" name="action" value="save_account_details" />

                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
                            </form>

                            <hr width="70%">

                            <h4>You may have been looking for</h4>
                            <p>
                                <a href="<?php echo $url . "&&edit-address=billing"?>>" Set billing address</a>
                                <?php if (empty($customer->get_billing_city())): ?>
                                    <small>You don't have this option set</small>
                                <?php endif; ?>

                            </p>

                            <?php if (get_option('woocommerce_ship_to_destination') != 'billing' || get_option('woocommerce_ship_to_destination') != 'billing_only'): ?>

                                <p>
                                    <a href="<?php echo $url . "&edit-address=shipping"?>">Set shipping address</a>
                                    <?php if (empty($customer->get_shipping_city())): ?>
                                        <small>You don't have this option set</small>
                                    <?php endif; ?>
                                </p>

                            <?php endif; ?>

                        </div>

                        <div class="col-sm-6">

                            <img src="<?php echo MIRELE_SOURCE_DIR . '/img/forms/edit-account.jpg'; ?>"  class="woo-login-image">

                        </div>

                    </div>
                </div>

                <?php do_action( 'woocommerce_after_edit_account_form' ); ?>

            </div>

            <?php

        }

        static public function edit_address ($type='billing') {

            global $customer;
            global $user_info;
            global $url;

            $load_address = sanitize_key( $type );

            $address = WC()->countries->get_address_fields( get_user_meta( get_current_user_id(), $load_address . '_country', true ), $load_address . '_' );

            foreach ( $address as $key => $field ) {

                $value = get_user_meta( get_current_user_id(), $key, true );

                if ( ! $value ) {
                    switch ( $key ) {
                        case 'billing_email' :
                        case 'shipping_email' :
                            $value = $user_info->user_email;
                            break;
                        case 'billing_country' :
                        case 'shipping_country' :
                            $value = WC()->countries->get_base_country();
                            break;
                        case 'billing_state' :
                        case 'shipping_state' :
                            $value = WC()->countries->get_base_state();
                            break;
                    }
                }


                if (($key == 'shipping_first_name' || $key == 'billing_first_name') && empty($value)) {$value = $user_info->first_name;};
                if (($key == 'shipping_last_name' || $key == 'billing_last_name') && empty($value)) {$value = $user_info->last_name;};

                $address[ $key ]['value'] = apply_filters( 'woocommerce_my_account_edit_address_field_value', $value, $key, $load_address );

            }


            ?>

            <div class="woo-content-center">
                <div class="container-fluid">

                    <?php woocommerce_output_all_notices(5); ?>

                    <div class="row">

                        <div class="col-sm-6">

                            <h1>Edit address information <small><?php echo ucwords($type) ?></small></h1>
                            <p>Filling in your address in the form is never a long process. To do this, our portal asks you to do it just once and all subsequent orders will be made to the saved address (you can change it).</p>

                            <?php do_action( 'woocommerce_before_edit_account_address_form' ); ?>

                            <form method="post">

                                <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

                                <?php foreach ( $address as $key => $field ): ?>

                                    <div class="row">
                                        <div class="col-sm-12 woo-account-edit-row">
                                            <div>
                                                <?php if ($key == 'billing_country' || $key == 'shipping_country'): ?>

                                                    <?php unset($field['label']); ?>
                                                    <?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>

                                                <?php else: ?>

                                                    <input id="<?php echo $key; ?>" name="<?php echo $key; ?>" type="text" <?php if ($field['required']) { echo "required=\"required\""; } ?> placeholder="<?php esc_html_e( $field['label'], 'woocommerce' ); ?>" class="woo-account-edit-input" autocomplete="<?php echo $field['autocomplete'] ?>" value="<?php echo $field['value'] ?>"  data-toggle="tooltip" data-placement="left" title="<?php esc_html_e( $field['label'], 'woocommerce' ); ?>">

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                                <div class="row">
                                    <div class="col-sm-12 woo-account-edit-row">
                                        <div>
                                            <button type="submit" class="button" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
                                            <?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
                                            <input type="hidden" name="action" value="edit_address" />
                                        </div>
                                    </div>
                                </div>

                                <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

                            </form>

                            <?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>

                        </div>

                        <div class="col-sm-6">
                            <img src="<?php echo MIRELE_SOURCE_DIR . '/img/forms/edit-address.jpg'; ?>"  class="woo-login-image">
                        </div>

                    </div>

                </div>
            </div>

            <?php

        }

    }


    /**
     * The primary routing.
     * First, it checks whether the user has opened a subpage,
     * and then, if the primary routing was ignored,
     * the user will be sent the content of the corresponding page
     *
     * @version 1.0.0
     */

    global $post;

    if (is_wc_endpoint_url( 'view-order' )) {

        global $wp;

        WooMirelePage::order($wp->query_vars['view-order']);

    } elseif (is_wc_endpoint_url( 'lost-password' )) {

        WooMirelePage::lost_password();

    } elseif (isset($_GET['register'])) {

        if (('yes' === get_option('woocommerce_enable_myaccount_registration'))) {

            if (is_user_logged_in()) {
                WooMirelePage::account();
            } else {
                WooMirelePage::register();
            }

        } else {
            WooMirelePage::no_access();
        }

    } elseif (is_wc_endpoint_url( 'edit-account' )) {

        if (is_user_logged_in()) {
            WooMirelePage::edit_account();
        } else {
            WooMirelePage::login();
        }

    } elseif (is_wc_endpoint_url( 'edit-address' )) {

        if (is_user_logged_in()) {
            WooMirelePage::edit_address($_GET['edit-address']);
        } else {
            WooMirelePage::login();
        }

    } else {

        switch ($post->ID) {


            /**
             * The user got to their page,
             * we check the authorization in
             * the system and give the page to render
             *
             * @version: 1.0.0
             */

            case $myaccount_page_id:

                if (is_user_logged_in ()) {
                    WooMirelePage::account ();
                } else {
                    WooMirelePage::login ();
                }

                break;


        }

    }

}