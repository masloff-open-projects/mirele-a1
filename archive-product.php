<?php

/**
 * The Templates for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/archive-product.php.
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

use Mirele\Framework\Buffer;
use Mirele\Framework\Customizer;

# Include scripts and styles
wp_enqueue_script('woocommerceui_products');

# Create shadows of products
//$shadows = new Buffer();

# Generator
foreach (wc_get_products([
    'numberposts'    => 'limit',
    'post_status'    => 'status',
    'post_parent'    => 'parent',
    'posts_per_page' => get_option( 'posts_per_page' ),
    'paged'          => (get_query_var('paged')) ? get_query_var('paged') : 1
]) as $product) {
//    $shadows->append((object) [
//        'name' => $product->get_name(),
//        'description' => $product->get_description(),
//        'price' => $product->get_price(),
//        'regular_price' => $product->get_regular_price(),
//        'sale_price' => $product->get_sale_price(),
//        'weight' => $product->get_weight(),
//        'width' => $product->get_width(),
//        'height' => $product->get_height(),
//        'image' => wp_get_attachment_url(get_post_thumbnail_id($product->get_id())),
//        'meta' => $product->get_meta(),
//        'link' => $product->get_permalink()
//    ]);
}


# Render
use Mirele\Compound\Engine\Document as App;

App::render('Compound/Engine/Applications/Public/Module/Woocommerce/products.html.twig', [
    'ww2as'         => get_option('mrl_wp_sidebar_width_2_active', 2),
    'ww1as'         => get_option('mrl_wp_sidebar_width_1_active', 4),
    'ars'           => is_active_sidebar('right-side-list-products', 'false') == 'true' ? true : false,
    'als'           => is_active_sidebar('left-side-list-products', 'false') == 'true' ? true : false,
    'hsmp'          => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
    'rsbn'          => 'right-side-list-products',
    'lsbn'          => 'left-side-list-products',
    'show_header'   => apply_filters('woocommerce_show_page_title', true),
    'show_carousel' => Customizer::get('@wc-shop', 'mrl_wp_show_carousel', []),
//    'shadows'       => $shadows->getBuffer(),
    'grid' => [
        'columns' => get_option( 'woocommerce_catalog_columns', 4 ),
        'rows' => get_option( 'woocommerce_catalog_rows', 8 ),
    ]
]);