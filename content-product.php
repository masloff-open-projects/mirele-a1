<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/content-product.php.
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
 */

use Mirele\Compound\Document\TWIG as App;

defined('ABSPATH') || exit;

# Verify and correct the virtual environment
if (!isset($product)) {
    global $product;
}

# Add vars
$product->get_image_src = wp_get_attachment_url(get_post_thumbnail_id($product->get_id()));
$product->get_placeholder_src = wc_placeholder_img_src();

# If the product exists and is not hidden - output the product template
if (!(empty($product) || !$product->is_visible())) {

App::render('Compound/Templates/Module/Woocommerce/product-cart.twig', []);
}