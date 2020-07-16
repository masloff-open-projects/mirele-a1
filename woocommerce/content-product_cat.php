<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $loop_type;
$loop_type = 'category';

// Get columns for different screen resolutions and other settings
$default = get_option('woo_column', 'auto');
$theme = get_option('woo_product_card_theme', 'woo-product-card-theme-gray');

switch ($default) {
	case 'auto':
		$colums_for_lg = 'five';
		$colums_for_md = 4;
		$colums_for_sm = 6;
		break;

	case 6:
		$colums_for_lg = 2;
		$colums_for_md = 3;
		$colums_for_sm = 4;
		break;
	
	case 4:
		$colums_for_lg = 3;
		$colums_for_md = 3;
		$colums_for_sm = 6;
		break;
	
	case 2:
		$colums_for_lg = 6;
		$colums_for_md = 6;
		$colums_for_sm = 6;
		break;

	default:
		$colums_for_lg = 2;
		$colums_for_md = 3;
		$colums_for_sm = 4;
		break;
}

mirele_get_components_by_type ('woo_product_cart_loop')[get_option('woo_product_card_theme', 'woo-product-card-theme-gray')](function () {

    /**
     * woocommerce_before_subcategory hook.
     *
     * @hooked woocommerce_template_loop_category_link_open - 10
     */
    do_action('woocommerce_before_subcategory', $category);

    /**
     * woocommerce_before_subcategory_title hook.
     *
     * @hooked woocommerce_subcategory_thumbnail - 10
     */
    do_action('woocommerce_before_subcategory_title', $category);

    /**
     * woocommerce_shop_loop_subcategory_title hook.
     *
     * @hooked woocommerce_template_loop_category_title - 10
     */
    do_action('woocommerce_shop_loop_subcategory_title', $category);

    /**
     * woocommerce_after_subcategory_title hook.
     */
    do_action('woocommerce_after_subcategory_title', $category);

    /**
     * woocommerce_after_subcategory hook.
     *
     * @hooked woocommerce_template_loop_category_link_close - 10
     */
    do_action('woocommerce_after_subcategory', $category);

}); ?>