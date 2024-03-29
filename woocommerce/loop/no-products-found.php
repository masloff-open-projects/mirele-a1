<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

?>


<div class="text-center woo-content-center">
    <img width="64px" src="<?php echo MIRELE_SOURCE_DIR . '/img/icons/cart.png' ?>" alt="You cart is empty!" class="el_698985002">
    <h2>You cart is empty!</h2>
    <p>Let`s go back to the store and start shopping?</p>
</div>

<p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'Woocommerce' ); ?></p>
