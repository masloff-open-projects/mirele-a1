<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<div class="text-center el_809696160">
				<img width="64px" src="<?php echo PATH_EMOJI_DEAD; ?>" alt="error" class="el_698985002">
				<h1>Error. Order not accept.</h1>
				<p> <?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?> </p>
				<p> You can try to <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"><?php esc_html_e( 'pay', 'woocommerce' ); ?></a> for the order again. </p> 
			</div>


		<?php else : ?>

			<div class="text-center el_809696160">
				<img width="64px" src="<?php echo PATH_EMOJI_LOVE; ?>" alt="Thank you very much" class="el_698985002">
				<h1>Thank you</h1>
				<p>
					<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you very much for placing your order! Ordering information you can be found below. You can manage orders from your account.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</p>
			</div>

            <div class="woo-table-order">
                <div class="woo-table-container">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Order number</th>
                            <th>Date</th>
                            <th>Email</th>
                            <th>Total</th>
                            <th>Payment method</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> <?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </td>
                            <td> <?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </td>
                            <td> <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) { echo $order->get_billing_email(); } else { echo 'Hidden'; } ?> </td>
                            <td> <?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </td>
                            <td> <?php if ( $order->get_payment_method_title() ) { echo wp_kses_post( $order->get_payment_method_title() ); } else { echo 'No information'; } ?> </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
			<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

        <?php endif; ?>

        <p style="text-align: center">
            <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">Back to shop</a>
        </p>


	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
