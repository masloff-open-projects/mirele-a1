<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit; ?>

<?php if (get_option('woo_hide_page_title', 'false') == 'true'): ?>

    <h1>Cart</h1>
    <p>Before placing an order, carefully check the quantity of each necessary product, check all prices. If you can't choose a delivery method on this page, you can choose it on the next page</p>

    <hr>

<?php endif; ?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action('woocommerce_before_cart_table'); ?>

	<?php do_action('woocommerce_cart_mirele_table_order')?>

	<?php do_action('woocommerce_cart_mirele_manager_table_cart')?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<?php if ( get_option('woo_cart_show_totals_block', 'false') == 'true' ): ?>
<div class="cart-collaterals">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>
<?php endif; ?>

<?php if ( get_option('woo_move_the_next_button_to_the_panel_below_the_table', 'false') != 'true' ): ?>
	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_cart' ); ?>
