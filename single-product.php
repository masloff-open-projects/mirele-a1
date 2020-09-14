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

function product_filter ($product) {

    $productObject = array();

    $productObject['get_type'] = $product->get_type();
    $productObject['get_name'] = $product->get_name();
    $productObject['get_slug'] = $product->get_slug();
    $productObject['get_date_created'] = $product->get_date_created();
    $productObject['get_date_modified'] = $product->get_date_modified();
    $productObject['get_status'] = $product->get_status();
    $productObject['get_featured'] = $product->get_featured();
    $productObject['get_catalog_visibility'] = $product->get_catalog_visibility();
    $productObject['get_description'] = $product->get_description();
    $productObject['get_short_description'] = $product->get_short_description();
    $productObject['get_sku'] = $product->get_sku();
    $productObject['get_price'] = $product->get_price();
    $productObject['get_regular_price'] = $product->get_regular_price();
    $productObject['get_sale_price'] = $product->get_sale_price();
    $productObject['get_date_on_sale_from'] = $product->get_date_on_sale_from();
    $productObject['get_date_on_sale_to'] = $product->get_date_on_sale_to();
    $productObject['get_total_sales'] = $product->get_total_sales();
    $productObject['get_tax_status'] = $product->get_tax_status();
    $productObject['get_tax_class'] = $product->get_tax_class();
    $productObject['get_manage_stock'] = $product->get_manage_stock();
    $productObject['get_stock_quantity'] = $product->get_stock_quantity();
    $productObject['get_stock_status'] = $product->get_stock_status();
    $productObject['get_backorders'] = $product->get_backorders();
    $productObject['get_low_stock_amount'] = $product->get_low_stock_amount();
    $productObject['get_sold_individually'] = $product->get_sold_individually();
    $productObject['get_weight'] = $product->get_weight();
    $productObject['get_length'] = $product->get_length();
    $productObject['get_width'] = $product->get_width();
    $productObject['get_height'] = $product->get_height();
    $productObject['get_dimensions'] = $product->get_dimensions();
    $productObject['get_upsell_ids'] = $product->get_upsell_ids();
    $productObject['get_cross_sell_ids'] = $product->get_cross_sell_ids();
    $productObject['get_parent_id'] = $product->get_parent_id();
    $productObject['get_reviews_allowed'] = $product->get_reviews_allowed();
    $productObject['get_purchase_note'] = $product->get_purchase_note();
    $productObject['get_default_attributes'] = $product->get_default_attributes();
    $productObject['get_menu_order'] = $product->get_menu_order();
    $productObject['get_post_password'] = $product->get_post_password();
    $productObject['get_category_ids'] = $product->get_category_ids();
    $productObject['get_tag_ids'] = $product->get_tag_ids();
    $productObject['get_virtual'] = $product->get_virtual();
    $productObject['get_gallery_image_ids'] = $product->get_gallery_image_ids();
    $productObject['get_shipping_class_id'] = $product->get_shipping_class_id();
    $productObject['get_downloads'] = $product->get_downloads();
    $productObject['get_download_expiry'] = $product->get_download_expiry();
    $productObject['get_downloadable'] = $product->get_downloadable();
    $productObject['get_download_limit'] = $product->get_download_limit();
    $productObject['get_image_id'] = $product->get_image_id();
    $productObject['get_image_src'] = $product->get_image_src;
    $productObject['get_placeholder_src'] = wc_placeholder_img_src();
    $productObject['get_rating_counts'] = $product->get_rating_counts();
    $productObject['get_average_rating'] = $product->get_average_rating();
    $productObject['get_review_count'] = $product->get_review_count();
    $productObject['get_title'] = $product->get_title();
    $productObject['get_permalink'] = $product->get_permalink();
    $productObject['get_children'] = $product->get_children();
    $productObject['get_stock_managed_by_id'] = $product->get_stock_managed_by_id();
    $productObject['get_price_html'] = $product->get_price_html();
    $productObject['get_formatted_name'] = $product->get_formatted_name();
    $productObject['get_min_purchase_quantity'] = $product->get_min_purchase_quantity();
    $productObject['get_max_purchase_quantity'] = $product->get_max_purchase_quantity();
    $productObject['get_image'] = $product->get_image();
    $productObject['get_shipping_class'] = $product->get_shipping_class();
    $productObject['get_rating_count'] = $product->get_rating_count();
    $productObject['get_file'] = $product->get_file();
    $productObject['get_price_suffix'] = $product->get_price_suffix();
    $productObject['get_availability'] = $product->get_availability();
    $productObject['get_variation_default_attributes'] = $product->get_variation_default_attributes();
    $productObject['get_gallery_attachment_ids'] = $product->get_gallery_attachment_ids();
    $productObject['get_related'] = $product->get_related();
    $productObject['get_price_html_from_text'] = $product->get_price_html_from_text();
    $productObject['get_price_including_tax'] = $product->get_price_including_tax();
    $productObject['get_display_price'] = $product->get_display_price();
    $productObject['get_price_excluding_tax'] = $product->get_price_excluding_tax();
    $productObject['get_categories'] = $product->get_categories();
    $productObject['get_tags'] = $product->get_tags();
    $productObject['get_post_data'] = $product->get_post_data();
    $productObject['get_parent'] = $product->get_parent();
    $productObject['get_upsells'] = $product->get_upsells();
    $productObject['get_cross_sells'] = $product->get_cross_sells();
    $productObject['get_variation_id'] = $product->get_variation_id();
    $productObject['get_variation_description'] = $product->get_variation_description();
    $productObject['get_total_stock'] = $product->get_total_stock();
    $productObject['get_formatted_variation_attributes'] = $product->get_formatted_variation_attributes();
    $productObject['get_matching_variation'] = $product->get_matching_variation();
    $productObject['get_rating_html'] = $product->get_rating_html();
    $productObject['get_files'] = $product->get_files();
    $productObject['get_data_store'] = $product->get_data_store();
    $productObject['get_id'] = $product->get_id();
    $productObject['get_data'] = $product->get_data();
    $productObject['get_data_keys'] = $product->get_data_keys();
    $productObject['get_extra_data_keys'] = $product->get_extra_data_keys();
    $productObject['get_meta_data'] = $product->get_meta_data();
    $productObject['get_meta'] = $product->get_meta();
    $productObject['get_object_read'] = $product->get_object_read();
    $productObject['get_changes'] = $product->get_changes();
    $productObject['get_permalink'] = get_permalink($product->get_id());
    $productObject['get_available_variations'] = $product->is_type('variable') ? $product->get_available_variations() : [];
    $productObject['get_gallery_image_urls'] = $product->get_gallery_image_urls;
    $productObject['get_gallery_image_urls_thumbnails'] = $product->get_gallery_image_urls_thumbnails;

    return $productObject;

}

function product_add ($product) {

    $product->get_gallery_image_urls = array_map(function ($attachment_id) {
        return wp_get_attachment_url( $attachment_id );
    }, $product->get_gallery_image_ids());
    $product->get_gallery_image_urls_thumbnails = array_map(function ($attachment_id) {
        return wp_get_attachment_image_url($attachment_id, 'woocommerce_gallery_thumbnail');
    }, $product->get_gallery_image_ids());
    $product->get_image_src = wp_get_attachment_url(get_post_thumbnail_id($product->get_id()));

    return $product;

}

$product =  product_add(wc_get_product(((object) $post)->ID));

$productObject = product_filter($product);

# Include scripts and styles
wp_enqueue_script('woocommerceui_product');

# Localization and declaration of external variables
wp_localize_script(
    'woocommerceui_product', 'WOOCOMMERCE',
    [
        'product'     => (object) $productObject,
        'post'        => (object) $post
    ]
);

# Render
\Mirele\TWIG::Render('Woocommerce/product', [
    'ww2as'         => get_option('mrl_wp_sidebar_width_2_active', 2),
    'ww1as'         => get_option('mrl_wp_sidebar_width_1_active', 4),
    'ars'           => is_active_sidebar('right-side-product', 'false') == 'true' ? true : false,
    'als'           => is_active_sidebar('left-side-product', 'false') == 'true' ? true : false,
    'hsmp'          => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
    'rsbn'          => 'right-side-product',
    'lsbn'          => 'left-side-product',
    'product'       => (object) $product,
    'post'          => (object) $post,
    'productObject' => (object) $productObject
]);