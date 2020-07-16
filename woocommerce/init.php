<?php

/**
 * Class Registration Woocommerce Functions
 * 
 *      If you wish to prioritize the loading of the WooCommerce subsystem for the 'Mirele Shop'
 *      change the settings of this particular file, but be careful when disabling scripts from the download,
 *      since this may disrupt WooCommerce and pages may not display correctly.
 * 
 *      ! DON`T DISABLE OR DELETE THIS SCRIPT ! 
 * 
 * @package: Mirele
 * @version: 1.0.0
 * @author: iRTEX 
 */

function woo_init () {

    global $post;

    define ('WOO', true);

    include_once 'Account/downloads-table.php';
    include_once 'Account/orders-table.php';
    include_once 'Account/no-downloads.php';
    include_once 'Account/no-orders.php';
    include_once 'Account/page/flat.php';
    include_once 'Cart/manager-table-cart.php';
    include_once 'Cart/order-table.php';
    include_once 'Checkout/coupon.php';
    include_once 'FastCart/cart.php';
    include_once 'Product/comments.php';
    include_once 'Product/description.php';
    include_once 'Product/form-order.php';
    include_once 'Product/modern-picture.php';
    include_once 'Product/picture.php';
    include_once 'Product/product-disable.php';
    include_once 'Product/script-render.php';

    add_action('woocommerce_single_product_mirele_image', 'woocommerce_single_product_mirele_image_render');
    add_action('woocommerce_single_product_mirele_comments', 'woocommerce_single_product_mirele_comments_render');
    add_action('woocommerce_single_product_mirele_description', 'woocommerce_single_product_mirele_description_render');
    add_action('woocommerce_single_product_mirele_disabled_product', 'woocommerce_single_product_mirele_disabled_product_render');
    add_action('woocommerce_cart_mirele_fastcart', 'woocommerce_cart_mirele_fastcart_render');
    add_action('woocommerce_cart_mirele_table_order', 'woocommerce_cart_mirele_table_order_render');
    add_action('woocommerce_account_mirele_table_orders', 'woocommerce_account_mirele_table_orders_render');
    add_action('woocommerce_account_mirele_oreders_none', 'woocommerce_account_mirele_oreders_none_render');
    add_action('woocommerce_account_mirele_downloads_none', 'woocommerce_account_mirele_downloads_none_render');
    add_action('woocommerce_account_mirele_table_downloads', 'woocommerce_account_mirele_table_downloads_render');
    add_action('woocommerce_account_mirele_flat_page', 'woocommerce_account_mirele_flat_page_render');

    function woo () {
        return (object) [ 
            'account'=> (object) [
                'orders' => (object) get_posts(array(
                    'numberposts' => -1,
                    'meta_key'    => '_customer_user',
                    'meta_value'  => get_current_user_id(),
                    'post_type'   => wc_get_order_types(),
                    'post_status' => array_keys( wc_get_order_statuses() ))),
                'user' => (object) wp_get_current_user()
            ],
            'product' => (object) wc_get_product()
                
        ];
    }
}