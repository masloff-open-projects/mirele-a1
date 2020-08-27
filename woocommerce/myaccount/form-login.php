<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php add_action('woocommerce_customer_login_form', function () { ?>

    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) { ?>
        <div class="form-register-and-login">
            <form method="post" id="account-form-login">

                <div class="form-content">
                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input style="width: 100%" type="text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </p>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input style="width: 100%" type="password" name="password" id="password" autocomplete="current-password" />
                    </p>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <p class="form-row">
                        <label>
                            <input class="woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                        </label>
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

                    </p>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>
                </div>

                <div class="navigate-content">
                    <div style="float: left;">
                        <p>
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                        </p>

                        <p>
                            <a href="javascript:;" id="register-form-load">I want register</a>
                        </p>
                    </div>

                    <div style="float: right;">
                        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
                    </div>

                </div>

            </form>

            <form method="post" <?php do_action( 'woocommerce_register_form_tag' ); ?> id="account-form-register" style="display: none;">

                <div class="form-content">

                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                        </p>

                    <?php endif; ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </p>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                            <input style="width: 100%" type="password" name="password" id="password" autocomplete="current-password" />
                        </p>

                    <?php else : ?>

                        <p> <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ2OS4zMzMgNDY5LjMzMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDY5LjMzMyA0NjkuMzMzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PGc+PHBhdGggZD0iTTI0OC41MzMsMTkyYy0xNy42LTQ5LjcwNy02NC44NTMtODUuMzMzLTEyMC41MzMtODUuMzMzYy03MC43MiwwLTEyOCw1Ny4yOC0xMjgsMTI4czU3LjI4LDEyOCwxMjgsMTI4YzU1LjY4LDAsMTAyLjkzMy0zNS42MjcsMTIwLjUzMy04NS4zMzNoOTIuOHY4NS4zMzNoODUuMzMzdi04NS4zMzNoNDIuNjY3VjE5MkgyNDguNTMzeiBNMTI4LDI3Ny4zMzNjLTIzLjU3MywwLTQyLjY2Ny0xOS4wOTMtNDIuNjY3LTQyLjY2N1MxMDQuNDI3LDE5MiwxMjgsMTkyYzIzLjU3MywwLDQyLjY2NywxOS4wOTMsNDIuNjY3LDQyLjY2N1MxNTEuNTczLDI3Ny4zMzMsMTI4LDI3Ny4zMzN6Ii8+PC9nPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48L3N2Zz4=" alt="" style="width: 14px; margin-right: 6px; margin-left: 7px;"> <?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

                    <?php endif; ?>

                    <p class="woocommerce-FormRow form-row">
                        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>

                    </p>

                    <?php do_action( 'woocommerce_register_form' ); ?>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>

                </div>

                <div class="navigate-content">
                    <div style="float: left;">
                        <p>
                            <a href="javascript:;" id="login-form-load">I want login</a>
                        </p>
                    </div>

                    <div style="float: right;">
                        <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                    </div>
                </div>

            </form>
        </div>
    <?php } ?>

<?php }); ?>

<?php do_action('woocommerce_customer_login_form'); ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
