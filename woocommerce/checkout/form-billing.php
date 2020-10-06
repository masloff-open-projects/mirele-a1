<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;

use Mirele\Compound\Store;

Store::call('default_form_billing', [
    'checkout' => $checkout,
    'form'     => $checkout->get_checkout_fields('billing'),
    'account'  => $checkout->get_checkout_fields('account'),
    'wc_ship_to_billing_address_only' =>  wc_ship_to_billing_address_only() && WC()->cart->needs_shipping(),
    'authorized' => is_user_logged_in(),
    'registration_enabled' => $checkout->is_registration_enabled(),
    'registration_required' => $checkout->is_registration_required()
]);

