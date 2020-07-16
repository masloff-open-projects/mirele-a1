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

defined( 'ABSPATH' ) || exit;

global $product;
global $bootstrap;
global $loop_type;
$loop_type = 'product';

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<?php 

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

    $bootstrap = (object) array(
        'xs' => 12,
        'sm' => $colums_for_sm,
        'md' => $colums_for_md,
        'lg' => $colums_for_lg,
    );

    mirele_get_components_by_type ('woo_product_cart_loop')[get_option('woo_product_card_theme', 'woo-product-card-theme-gray')](function (){

    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );

    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    do_action( 'woocommerce_before_shop_loop_item_title' );

    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    do_action( 'woocommerce_shop_loop_item_title' );

    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    do_action( 'woocommerce_after_shop_loop_item_title' );

    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    do_action( 'woocommerce_after_shop_loop_item' );

});
?>
