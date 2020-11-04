<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

# Verify and correct the virtual environment
if (!isset($checkout)) {
    global $checkout;
}

# TODO: This..
// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'Woocommerce' ) ) );
    return;
}

\Mirele\TWIG::Render('Compound/Engine/Application/Module/Woocommerce/checkout.html.twig', [
    'checkout' => $checkout,
    'nonce' => wp_create_nonce('woocommerce-process_checkout')
]);
