/**
 * Feature to Update FastCart
 *
 * @param {Cart Data} event
 * @version 1.0.0
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {

    function woo_update_fastcart(event) {

        for (const product of event.cart) {

            if ($(`.woo-fastcart-item[product-id='${product.id}']`).length === 0) {

                div = $('<div>');
                card = $('<div>', { class: 'woo-fastcart-item', 'product-id': String(product.id), css: { opacity: 0 } }).appendTo('.woo-fastcart-body');
                a = $('<a>', { text: '×', class: 'woo-fastcart-item-remove', href: 'javascript:;', 'product-id': String(product.id), 'cart-item-key': String(product.cart_item_key) }).appendTo(card);
                img = $('<img>', { class: 'woo-fastcart-item-picture', src: String(product.image), alt: '...' }).appendTo(card);
                p = $('<p>', { text: product.name, class: 'woo-fastcart-item-text' }).appendTo(card);

                $(card).animate({
                    opacity: 1,
                }, 300);

                $(a).click(function(event) {

                    $(`div.woo-fastcart-item[product-id="${$(event.target).attr('product-id')}"]`).animate({
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
                                    $(`div.woo-fastcart-item[product-id="${$(event.target).attr('product-id')}"]`).fadeOut(300, function() {
                                        $(`div.woo-fastcart-item[product-id="${$(event.target).attr('product-id')}"]`).remove();
                                        $("#mirele_fast_cart_total").html(" - " + response.total);
                                    });
                                }
                            },
                            error: function() {
                                $(`div.woo-fastcart-item[product-id="${$(event.target).attr('product-id')}"]`).animate({
                                    opacity: 1,
                                }, 300);
                            }
                        });
                    });
                });

            }

        }

        if ($("#mirele_fast_cart_total").length > 0) {
            $("#mirele_fast_cart_total").html(" - " + event.total);
        }

    }

    /**
     * Function for receiving information about the current WooCommerce product (or ID),
     * if the user is on the WooCommerce page and sweeps
     * product in sight
     *
     * @version 1.0.0
     */

    function woo_product(id = null) {

        return $.ajax({
            type: "POST",
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: 'current_product',
                id: id
            },
            dataType: "json",
            async: false
        }).responseJSON;

    }

    /**
     * Function hangs attributes and
     * fast cart events
     *
     * @version 1.0.0
     */

    if ($(`.woo-fastcart-body`).length !== 0) {


        /**
         * If the site is open on small screens,
         * then FastCart will be hidden from view, since
         * it takes up almost 30% of the screen
         */

        if (window.innerWidth < 768) {
            $('.woo-fastcart').hide();
        } else {

            function woo_get_fast_cart_data() {
                $.ajax({
                    type: "POST",
                    url: wc_add_to_cart_params.ajax_url,
                    data: {
                        action: "fastcart"
                    },
                    dataType: "json",
                    success: function(response) {
                        woo_update_fastcart(response);
                    }
                });
            }

            document.body.added_to_cart = function () { woo_get_fast_cart_data(); }
            document.body.removed_from_cart = function () { woo_get_fast_cart_data(); }

            woo_get_fast_cart_data();
        }

    }


}