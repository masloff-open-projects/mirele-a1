/**
 * Function hangs attributes and
 * quick cart events
 *
 * @version 1.0.0
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {
    $(document).ready(function() {
        if ($(`[data-action="open_quick_cart"]`).length !== 0) {
            for (const iterator of $(`[data-action="open_quick_cart"]`)) {
                $(iterator).click(function () {

                    $('.woo_quick_basket_content').html("");
                    $('.woo_quick_basket_content').hide();
                    $('.woo_quick_basket-loader').show();
                    $(".woo_quick_basket_total").html("");

                    $.ajax({
                        type: "POST",
                        url: wc_add_to_cart_params.ajax_url,
                        data: {
                            action: "woo_quickcart_get"
                        },
                        dataType: "json",
                        success: function(response) {

                            if ('cart' in response) {

                                $(".woo_quick_basket_total").html(response.total);

                                for (const product of response.cart) {

                                    div = $('<div>');
                                    card = $('<div>', { class: 'woo-quick-cart-item', 'product-id': String(product.id), css: { opacity: 0 } }).appendTo('.woo_quick_basket_content');
                                    a = $('<a>', { text: '×', class: 'woo-fastcart-item-remove', href: 'javascript:;', 'product-id': String(product.id), 'cart-item-key': String(product.cart_item_key) }).appendTo(card);
                                    img = $('<img>', { class: 'woo-fastcart-item-picture', src: String(product.image), alt: '...' }).appendTo(card);
                                    p = $('<p>', { text: `${product.name} (${product.qty})`, class: 'woo-fastcart-item-text' }).appendTo(card);

                                    $(card).animate({
                                        opacity: 1,
                                    }, 300);

                                    $(a).click(function(event) {

                                        $(`div.woo-quick-cart-item[product-id="${$(event.target).attr('product-id')}"]`).animate({
                                            opacity: 0.5,
                                        }, 300, function() {
                                            $.ajax({
                                                type: "POST",
                                                url: wc_add_to_cart_params.ajax_url,
                                                data: {
                                                    action: "product_remove",
                                                    product_id: $(event.target).attr('product-id'),
                                                    cart_item_key: $(event.target).attr('cart-item-key')
                                                },
                                                dataType: "json",
                                                success: function(response) {

                                                    if (response.status == 'removed') {
                                                        $(`div.woo-quick-cart-item[product-id="${$(event.target).attr('product-id')}"]`).fadeOut(300, function() {
                                                            $(`div.woo-quick-cart-item[product-id="${$(event.target).attr('product-id')}"]`).remove();
                                                            $("#mirele_fast_cart_total").html(" - " + response.total);
                                                        });
                                                    }

                                                },
                                                error: function() {
                                                    $(`div.woo-quick-cart-item[product-id="${$(event.target).attr('product-id')}"]`).animate({
                                                        opacity: 1,
                                                    }, 300);
                                                }
                                            });
                                        });
                                    });

                                }


                                $('.woo_quick_basket_content').show();
                                $('.woo_quick_basket-loader').hide();

                            } else {
                                $('.woo_quick_basket-loader').hide();
                            }

                        }
                    });
                });
            }
        }
    });
}