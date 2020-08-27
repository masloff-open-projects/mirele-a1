<?php 

function woocommerce_cart_mirele_table_order_render () { ?>
<table class="table table-bordered table-hover woocommerce-cart-form__contents">
    <thead>
        <tr>
            <th>Picture</th>
            <th>Product name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>
        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
        
                ?>
                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                    <!-- Picture product -->
                    <td>
                    <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image() , $cart_item, $cart_item_key );

                        if ( ! $product_permalink ) {
                            echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                        }
                    ?>
                    </td>

                    <!-- Product name -->
                    <td>
                    <?php
                        if ( ! $product_permalink ) {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                        } else {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                        }

                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                        // Meta data.
                        echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                        // Backorder notification.
                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                        }
                    ?>
                    </td>

                    <!-- Product price -->
                    <td>
                    <?php
                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                    ?>
                    </td>

                    <!-- Product quantity -->
                    <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                    <?php
                    if ( $_product->is_sold_individually() ) {
                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                        $product_quantity = woocommerce_quantity_input(
                            array(
                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                'input_value'  => $cart_item['quantity'],
                                'max_value'    => $_product->get_max_purchase_quantity(),
                                'min_value'    => '0',
                                'product_name' => $_product->get_name(),
                            ),
                            $_product,
                            false
                        );
                    }

                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                    ?>
                    </td>

                    <!-- Product subtotal  -->
                    <td>
                        <?php
                            echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                        ?>
                    </td>

                    <!-- Product manage -->
                    <td>

                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle el_2729771096" type="button" id="woo_menu_manage_product" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Product Management
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu woo-dropdown-menu" aria-labelledby="woo_menu_manage_product">
                                <li><a href="<?php echo wc_get_cart_remove_url( $cart_item_key ); ?>" data-action='remove_product' aria-label="remove" data-product_id="<?php echo $product_id; ?>" data-product_sku="<?php $_product->get_sku(); ?>"><i class="far fa-trash-alt"></i> Remove</a></li>
                            </ul>
                        </div>

                    </td>

                
                </tr>

                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

                <?php
            }
        }
        ?>
        
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
    </tbody>
    <?php if ( get_option('woo_price_results_in_table', 'true') == 'true' ): ?>
    <tfoot>
        <tr>
            <th colspan="6">
                <?php if (WC()->cart->subtotal != WC()->cart->total): ?> 
                    <span class='el_2164897714'> <?php echo wc_price(WC()->cart->subtotal); ?> </span>
                <?php endif; ?>
                <span> <?php echo wc_price(WC()->cart->total); ?> </span>
            </th>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>
<?php } ?>