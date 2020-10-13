/**
 * Welcome to the source code
 *
 * ░██╗░░░░░░░██╗░█████╗░░█████╗░░█████╗░░█████╗░███╗░░░███╗███╗░░░███╗███████╗██████╗░░█████╗░███████╗      ██╗░░░██╗██╗
 * ░██║░░██╗░░██║██╔══██╗██╔══██╗██╔══██╗██╔══██╗████╗░████║████╗░████║██╔════╝██╔══██╗██╔══██╗██╔════╝      ██║░░░██║██║
 * ░╚██╗████╗██╔╝██║░░██║██║░░██║██║░░╚═╝██║░░██║██╔████╔██║██╔████╔██║█████╗░░██████╔╝██║░░╚═╝█████╗░░      ██║░░░██║██║
 * ░░████╔═████║░██║░░██║██║░░██║██║░░██╗██║░░██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝░░██╔══██╗██║░░██╗██╔══╝░░      ██║░░░██║██║
 * ░░╚██╔╝░╚██╔╝░╚█████╔╝╚█████╔╝╚█████╔╝╚█████╔╝██║░╚═╝░██║██║░╚═╝░██║███████╗██║░░██║╚█████╔╝███████╗      ╚██████╔╝██║
 * ░░░╚═╝░░░╚═╝░░░╚════╝░░╚════╝░░╚════╝░░╚════╝░╚═╝░░░░░╚═╝╚═╝░░░░░╚═╝╚══════╝╚═╝░░╚═╝░╚════╝░╚══════╝      ░╚═════╝░╚═╝
 *
 * @package Mirele
 * @author Mirele
 * @version 1.0.0
 * @instance Product Page
 */

"use strict";

new app.interface({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#productObject']
    },
    ready: function (init, $) {

        // If this variable was defined - the script is connected to the product page.
        // This variable should not exist on any other page.
        if (typeof WOOCOMMERCE === "object") {

            const Product = WOOCOMMERCE.product;

            window.p = new Vue({
                delimiters: ['{', '}'],
                el: "#productObject",
                data: {
                    price: Product.get_price,
                    regularPrice: Product.get_regular_price,
                    sku: Product.get_sku,
                    image: Product.get_image_src || Product.get_placeholder_src,
                    gallery: Product.get_gallery_image_urls || [],
                    variations: Product.get_available_variations || [],
                    variation: {},
                    variation_id: 0,
                    enabled: true
                },
                mounted: Event => {

                },
                methods: {
                    addToCart: function (Event) {

                        this.enabled = false;

                        app.request('WCAddToCart', {
                            product_id: WOOCOMMERCE.product.get_id,
                            product_quantity: 1,
                            product_variation_id: this.variation_id || 0,
                            product_variation: this.variation || {}
                        }).then(Event => {
                            this.enabled = true;
                        }).catch(Event => {
                            this.enabled = true;
                        })

                    },
                    show: function (Event) {
                        this.image = Event || this.image || '';
                    }
                },
                watch: {
                    variation: {
                        deep: true,

                        // Product version update
                        handler: function (attributes) {

                            var сoincidence = false;
                            for (const [id, variant] of Object.entries(Product.get_available_variations || [])) {

                                for (const [attribute, value] of Object.entries(Object.freeze(variant.attributes))) {
                                    сoincidence = !value || attributes[attribute] == value;

                                    // Product parameters did not match on 1 property
                                    if (сoincidence == false) {
                                        break;
                                    }
                                }

                                // The product parameters coincided with one of the product variations
                                if (сoincidence == true) {
                                    this.variation_id = id;
                                    this.price = variant.display_regular_price;
                                    this.sku = variant.sku;
                                    this.image = variant.image.src || Product.get_image_src || Product.get_placeholder_src;
                                    break;
                                }
                            }

                            // The product parameters did NOT coincide with one of the product variations.
                            if (сoincidence == false) {
                                this.variation_id = 0;
                                this.price = Product.get_price;
                                this.sku = Product.get_sku;
                                this.image = Product.get_image_src || Product.get_image_src || Product.get_placeholder_src;
                            }

                        }
                    }
                }
            });

        }

    }
});