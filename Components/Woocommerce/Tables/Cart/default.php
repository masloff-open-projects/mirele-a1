<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_cart_table');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    if (isset($props->cart) and $props->cart) {
        $props->cart = (array) $props->cart;
    } else {

        # Formatting table
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

            # Create product
            $product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

            # Create meta
            $id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
            $url = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key);
            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image() , $cart_item, $cart_item_key );
            $thumbnail_url = the_post_thumbnail_url($id) ? the_post_thumbnail_url($id) : wc_placeholder_img_src();
            $visible = $product && $product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key);
            $title  = wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $product->get_name(), $cart_item, $cart_item_key ) );
            $price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $product ), $cart_item, $cart_item_key );
            $is_sold_individually = $product->is_sold_individually();
            $subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

            # Create html meta
            $cartitem = esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) );

            # Create object
            $props->cart[] = [
                'product' => $product,
                'id' => $id,
                'url' => $url,
                'thumbnail' => $thumbnail,
                'thumbnail_url' => $thumbnail_url,
                'visible' => $visible,
                'title' => $title,
                'price' => $price,
                'quantity' => $cart_item['quantity'],
                'max_quantity' => $product->get_max_purchase_quantity(),
                'subtotal' => $subtotal,
                'is_sold_individually' => $is_sold_individually,
                'html' => [
                    'cartitem' => $cartitem,
                ],
                'iterator' => [
                    'item' => $cart_item,
                    'key' => $cart_item_key
                ]
            ];

        }

        #WC
        $props->wc_cart = WC()->cart->get_cart();
        $props->wc = WC();

    }

    TWIG::Render('Components/Woocommerce/default_cart_table', $props);

});

Store::add($Component);