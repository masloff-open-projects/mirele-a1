<?php

/**
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 1.6.4
 * @subpackage Mirele
 */

defined('ABSPATH') || exit;

global $post;

\Mirele\TWIG::Render('woocommerce/product', [
    'ww2as'       => get_option('mrl_wp_sidebar_width_2_active', 2),
    'ww1as'       => get_option('mrl_wp_sidebar_width_1_active', 4),
    'ars'         => is_active_sidebar('right-side-product', 'false') == 'true' ? true : false,
    'als'         => is_active_sidebar('left-side-product', 'false') == 'true' ? true : false,
    'hsmp'        => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
    'rsbn'        => 'right-side-product',
    'lsbn'        => 'left-side-product',
    'product'     => wc_get_product(((object) $post)->ID),
    'post'        => (object) $post
]);