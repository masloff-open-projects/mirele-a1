<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

defined('ABSPATH') || exit;

# Verify and correct the virtual environment
if (!isset($product)) {
    global $product;
}

# If the product exists and is not hidden - output the product template
if (!(empty($product) || !$product->is_visible())) {
	\Mirele\TWIG::Render('woocommerce/product-cart', [
		'product' => $product
	]);
}