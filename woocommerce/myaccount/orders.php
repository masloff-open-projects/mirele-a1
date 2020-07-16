<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); 

if ( $has_orders ) {

	do_action('woocommerce_account_mirele_table_orders');
	do_action('woocommerce_before_account_orders_pagination');

} else {

	do_action('woocommerce_account_mirele_oreders_none');
	do_action( 'woocommerce_after_account_orders', $has_orders );

}
