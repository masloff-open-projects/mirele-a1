<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

\Mirele\TWIG::Render('woocommerce/products', [
    'ww2as'       => get_option('mrl_wp_sidebar_width_2_active', 2),
    'ww1as'       => get_option('mrl_wp_sidebar_width_1_active', 4),
    'ars'         => is_active_sidebar('right-side-list-products', 'false') == 'true' ? true : false,
    'als'         => is_active_sidebar('left-side-list-products', 'false') == 'true' ? true : false,
    'hsmp'        => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
    'rsbn'        => 'right-side-list-products',
    'lsbn'        => 'left-side-list-products',
    'show_header' => apply_filters('woocommerce_show_page_title', true)
]);