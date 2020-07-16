<?php add_action( 'woocommerce_single_product_mirele_form', 'woocommerce_single_product_mirele_form_render' ); ?>

<?php function woocommerce_single_product_mirele_form_render() { ?>

    <?php global $product; ?>

    <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <form class="el_1368679798" id="product-form" data-action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->product_url ) ); ?>" method="post" enctype='multipart/form-data' product_id="<?php echo $product->get_id(); ?>">

        <h1 class="el_3996570475"> <?php echo apply_filters('woocommerce_mirele_title_single_product', $product->name); ?> </h1>

        <p>
            <?php 

            $average = $product->get_average_rating();

            if ($average != "0") {
                for ($i=0; $i < intval($average); $i++) {
                    ?>
                    <i class="el_1641092241 fa fa-star" aria-hidden="true"></i>
                    <?php
                }
            }

            ?>

        <p class="el_269226809">SKU: <span id="product-sku"><?php echo apply_filters('woocommerce_mirele_sku_single_product', $product->sku); ?></span></p>

        <h6 id="stock-note"></h6>

        <p id="product-short-description"> <?php echo apply_filters('woocommerce_mirele_short_description_single_product', $product->short_description); ?> </p>
        
        <?php if ($product->width || $product->height || $product->lenght): ?>

            <h5 class='el_3269997622'>Dimensions:</h5>

            <?php if ($product->width): ?>
                <h5 id="product-width">Product width: <span class='el_2302428343'><?php echo apply_filters('woocommerce_mirele_width_single_product', $product->width) . ' ' . get_option( 'woocommerce_dimension_unit' ) ; ?></span> </h5>
            <?php endif; ?>

            <?php if ($product->height): ?>
                <h5 id="product-height">Product height: <span class='el_2302428343'><?php echo apply_filters('woocommerce_mirele_height_single_product', $product->height) . ' ' . get_option( 'woocommerce_dimension_unit' ); ?></span> </h5>
            <?php endif; ?>

            <?php if ($product->length): ?>
                <h5 id="product-length">Product length: <span class='el_2302428343'><?php echo apply_filters('woocommerce_mirele_length_single_product', $product->length) . ' ' . get_option( 'woocommerce_dimension_unit' ); ?></span> </h5>
            <?php endif; ?>

            <?php if ($product->weight): ?>
                <h5 id="product-weight">Product weight: <span class='el_2302428343'><?php echo apply_filters('woocommerce_mirele_weight_single_product', $product->weight) . ' ' . get_option( 'woocommerce_weight_unit' ); ?></span> </h5>
            <?php endif; ?>

        <?php endif; ?>

        <?php

            if ($product->is_type( 'variable' ) === true) {
                
                do_action( 'woocommerce_before_variations_form' );

                foreach ($product->get_variation_attributes() as $attribute_name => $options) {
                    variation_render(
                        array(
                            'options'   => $options,
                            'attribute' => $attribute_name,
                            'product'   => $product,
                        )
                    );
                }

                echo '<div class="el_3438629521" id="product_option_warning">This product variation does not exist.</div>';

                do_action( 'woocommerce_after_variations_form' );

            } else {
            
                if (!empty($product->attributes)) {
                    echo "<h5 class='el_3269997622'>Product Parameters:</h5>";
                    foreach ($product->attributes as $attr) {
                        echo sprintf("<h5>%s: <span class='el_2302428343'>%s</span></h5>", $attr['name'], join(', ', $attr['options']) );
                    }
                }		
            }

            if ($product->is_type( 'grouped' ) === true) {
                $quantites_required      = false;
                $grouped_product_columns = apply_filters(
                    'woocommerce_grouped_product_columns',
                    array(
                        'quantity',
                        'label',
                        'price',
                    ),
                    $product
                );

                do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );
                
                echo "<h3 class='el_3269997622'>Choose a complete set:</h3>";
                
                ?>
                
                <div class="container el_1767720578">
                
                    <?php
                    $recomended = [];
                    foreach ($product->get_children() as $id) {
                        $_product = wc_get_product( $id );

                        ?>
                        <div class="row el_3498439024">
                        
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 el_1056054125 el_150972632">
                                <a href="<?php echo $_product->product_url ?>"> <?php echo $_product->name; ?> </a>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 el_1056054125">
                                <?php echo get_woocommerce_currency_symbol() . '<span id="_price">' . $_product->price ?>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 el_1056054125 el_150972633">
                            
                                <?php
                                if ( ! $_product->is_purchasable() || $_product->has_options() || ! $_product->is_in_stock() ) {
                                    woocommerce_template_loop_add_to_cart();
                                } elseif ( $_product->is_sold_individually() ) {
                                    echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $_product->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" /> Buy';
                                } else {
                                    woocommerce_quantity_input(
                                        array(
                                            'input_class' => 'el_3893731602',
                                            'input_name'  => 'quantity[' . $id . ']',
                                            'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $_product->get_min_purchase_quantity(), $_product ),
                                            'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $_product->get_max_purchase_quantity(), $_product ),
                                            'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $_product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                        )
                                    );
                                }
                                
                                ?>

                            </div>
                        </div>
                        <?php
                        
                    }

                    ?>

                </div>

                <?php

                do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );

            }

        ?>

        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <div class="row el_2218874923">
            
            <div class="el_1200772295" id="price-controller">
                
                <?php if ($product->price) {?>
                    <?php if ($product->regular_price != $product->price && $product->regular_price): ?>
                        <h3 class="el_2180227445"> <?php echo get_woocommerce_currency_symbol() ?><span id="regular_price"><?php echo $product->regular_price ? $product->regular_price : 0 ?> </span> </span> </h3>
                    <?php endif; ?>

                    <h3 class="el_155853530"> <?php echo get_woocommerce_currency_symbol() ?><span id="price"><?php echo $product->price ? $product->price : 0 ?> </span> </h3>
                    
                    <?php 
                        if ($product->stock_status == 'onbackorder') { ?> <h6 class="el_1295556841"> By order only </h6> <?php }
                    ?>
                <?php } else { ?>
                    <h3 class="el_155853530"> Free </h3>
                <?php } ?>

            </div>
            
            <div class="el_4235164145">

                <div class="cart el_150972634">

                    <?php
                    if ($product->is_type( 'external' ) === true) {
                        ?> <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( apply_filters('woocommerce_mirele_add_to_cart_text_single_product', $product->single_add_to_cart_text()) ); ?></button> <?php
                    } elseif ($product->is_type( 'grouped' ) === true) {
                        ?> <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"><?php echo esc_html( apply_filters('woocommerce_mirele_add_to_cart_text_single_product', $product->single_add_to_cart_text()) ); ?></button> <?php
                    } else {

                        do_action( 'woocommerce_before_single_variation' );

                        do_action( 'woocommerce_before_add_to_cart_quantity' );

                        woocommerce_quantity_input(
                            array(
                                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                            )
                        );

                        do_action( 'woocommerce_after_add_to_cart_quantity' );

                        do_action( 'woocommerce_after_single_variation' );

                        ?> <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"><?php echo esc_html( apply_filters('woocommerce_mirele_add_to_cart_text_single_product', $product->single_add_to_cart_text()) ); ?></button> <?php
                        
                        
                    }
            
                    ?>

                
                </div>

            </div>						
            
        </div>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

        <?php if($product->purchase_note): ?>
            <small class="el_1100683714"> * <?php echo apply_filters('woocommerce_mirele_purchase_note_single_product', $product->purchase_note) ?></small>
        <?php endif; ?>
                
    </form>

    <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php } ?>
