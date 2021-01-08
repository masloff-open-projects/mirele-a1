<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<div class="woo-mini-cart">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		    var_dump();

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</div>


    <div class="woo-mini-cart">
        <?php do_action( 'woocommerce_before_mini_cart_contents' ); ?>

        <?php foreach ( WC()->cart->get_cart() as $item_id => $item ): $product = wc_get_product ( $item['product_id'] ); if ($product): ?>

            <a href="<?php echo get_permalink ($item['product_id']) ?>">
                <img src="<?php echo !empty($product->get_image_id()) ? wp_get_attachment_url ($product->get_image_id()) : wc_placeholder_img_src() ?>" alt="" class="woo-product-picture-small-small-cart" <?php if (get_option('mrl_wp_sidebar_width_1_active', 2) == '1') { echo "style='width: 100%!important'"; } ?>>
            </a>

        <?php endif; endforeach; ?>


        <?php do_action( 'woocommerce_mini_cart_contents' ); ?>
    </div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'Woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
