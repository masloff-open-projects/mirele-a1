<?php
/**
 * Orders table for account page
 * 
 * @package: Mirele
 * @author: iRTEX
 * @version: 1.0.0 
 */

function woocommerce_account_mirele_table_orders_render () {

    $woo = woo();

    ?>
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
			foreach ( $woo->account->orders as $customer_order ) {
                
                $order = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();

                ?>

				<tr>

                    <td>
                        <?php echo $order->get_id(); ?>
                    </td>

                    <td>
                        <time datetime="<?php echo $order->get_date_created(); ?>"> <?php echo wc_format_datetime($order->get_date_created()) ?> </time>
                    </td>

                    <td <?php if ($order->get_status() == 'pending') {echo 'style="color: #F5B947;"';} ?>>
                        <?php echo wc_get_order_status_name( $order->get_status() ); ?>
                    </td>

                    <td>

                        <?php if ($order->get_total_discount() > 0): ?>
                            <span class="woo-discount-span"><?php echo get_woocommerce_currency_symbol() . $order->get_total_discount() ?></span>
                        <?php endif; ?>

                        <?php echo get_woocommerce_currency_symbol() . $order->get_total(); ?>
                    </td>

                    <td>

                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle el_2729771096" type="button" id="woo-dropdown-manager-order" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Order Management
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu woo-dropdown-menu" aria-labelledby="woo-dropdown-manager-order">
                            <?php
                                $actions = wc_get_account_orders_actions( $order );

                                if ( ! empty( $actions ) ) {
                                    foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
                                        echo '<li><a href="' . esc_url( $action['url'] ) . '">' . esc_html( $action['name'] ) . '</a>';
                                    }
                                }
                            ?>  
                            </ul>
                        </div>
                    
                    </td>

				</tr>
				<?php
			}
			?>
        </tbody>
    </table>
    <?php
}