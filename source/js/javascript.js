/**
 * Central Independent Management Script
 * Mirele content. This script does not oversee the work.
 * Rosemary, There is a separate file for this
 * 
 * @author Mirele
 * @package Mirele
 * @version 1.0.0
 */

document.addEventListener("DOMContentLoaded", function() {

    for (tag in document.querySelectorAll("section[theme='product']")) {

        try {

            document.querySelectorAll("section[theme='product'] > div > div")[tag].style.backgroundPosition = document.querySelectorAll("section[theme='product']")[tag].getAttribute('image-position') ? document.querySelectorAll("section[theme='product']")[tag].getAttribute('image-position') : 'right';
            document.querySelectorAll("section[theme='product'] > div > div")[tag].style.backgroundRepeat = "no-repeat";
            document.querySelectorAll("section[theme='product'] > div > div")[tag].style.backgroundSize = "contain";

            if (!document.querySelectorAll("section[theme='product'] > div > div")[tag].id) {
                ID = `tag_${(new Integer).random(1, 10000)}`;
                document.querySelectorAll("section[theme='product'] > div > div")[tag].id = ID;
            } else {
                ID = document.querySelectorAll("section[theme='product'] > div > div")[tag].id;
            }


            let style = `@media (max-width: 575.98px) { 
                #${ID} {
                    background-image: none;
                }
            }
            
            @media (min-width: 576px) and (max-width: 767.98px) {
                #${ID} {
                    background-image: none;
                }
            }
            
            @media (min-width: 768px) and (max-width: 991.98px) { 
                #${ID} {
                    background-image: url(${document.querySelectorAll("section[theme='product']")[tag].getAttribute('image-small')});
                }
            }
            
            @media (min-width: 992px) and (max-width: 1199.98px) {
                #${ID} {
                    background-image: url(${document.querySelectorAll("section[theme='product']")[tag].getAttribute('image-small')});
                }
            }
            
            @media (min-width: 1200px) {
                #${ID} {
                    background-image: url(${document.querySelectorAll("section[theme='product']")[tag].getAttribute('image')});
                }
            }`;

            let stl = document.createElement('style');
            stl.type = 'text/css';
            stl.innerHTML = style;

            document.getElementsByTagName('head')[0].append(stl);

        } catch (error) {}
    }

});

if (typeof jQuery == 'function' && jQuery.fn.jquery) {

    window.fac = new FastAverageColor();
    $.mobile.autoInitializePage = false;


    /**
     * Small bootloader for initialization and rendering
     * DOM elements per page
     * 
     * @version 1.0.0
     */

    $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip();

        /**
         * Render cookie box
         *
         * @version 1.0.0
         */

        if ($("#cookie_box").length !== 0) {

            if (typeof localStorage.allow_cookie == "undefined") {

                $("#cookie_box").fadeIn();

                if ($('#allow_use_cookie').length !== 0) {
                    $("#allow_use_cookie").click(function() {
                        localStorage.allow_cookie = 'allow';
                        $("#cookie_box").fadeOut();
                    });
                }

            }

        }


        /**
         * The function logs events
         * switching forms in the zone
         * authorization 
         *
         * @version 1.0.0
         */

        if ($(`#register-form-load`).length !== 0) {

            $('#register-form-load').click(function(e) {

                e.preventDefault();

                $('#account-form-login').hide(100, function() {

                });

                $('#account-form-register').show(100, function() {

                });

            });
        }


        if ($(`#login-form-load`).length !== 0) {

            $('#login-form-load').click(function(e) {

                e.preventDefault();

                $('#account-form-register').hide(100, function() {

                });

                $('#account-form-login').show(100, function() {

                });

            });
        }


        /**
         * The function logs events when switching
         * product variations
         *
         * @version 1.0.0
         */

        if ($(`#product-form`).length !== 0) {

            var product = woo_product($('form#product-form').attr('product_id'));

            if (product.variations_format) {

                function render() {

                    var form = karlin("#product-form").form();
                    var variant = false;

                    /**
                     * The first cycle determines which
                     * User selected option. If such an option exists,
                     * then it will be written into a variable and processed by the second cycle
                     * 
                     * @version 1.0.0
                     */

                    for (const key in product.variations_format) {
                        if (product.variations_format.hasOwnProperty(key)) {
                            const attr = product.variations_format[key];
                            var _true = 1;

                            for (const key in attr.attributes) {
                                if (attr.attributes.hasOwnProperty(key)) {
                                    const element = attr.attributes[key];
                                    if (form[key] == element || element == "") {
                                        _true++;

                                    }
                                }
                            }

                            if (_true == Object.keys(form).length) {
                                variant = attr;
                            }

                        }
                    }


                    /**
                     * If the user has selected options that fall under
                     * one of the options, the script needs to be updated
                     * contents in the product card. This is what this script does.
                     * 
                     * @version 1.0.0
                     */

                    if (variant) {

                        $('#product_option_warning').hide(300, function() {});


                        /**
                         * Parameter update: SKU
                         */

                        $('#product-sku').text(variant.sku);


                        /**
                         * Parameter update: Price
                         */

                        if ($('#price').text() != variant.display_price) {

                            $({ numberValue: Number($('#price').text()) }).animate({ numberValue: variant.display_price }, {

                                duration: 1000,
                                easing: "linear",

                                step: function(event) {
                                    $("#price").text(Math.ceil(event));
                                }

                            });
                        }


                        /**
                         * Parameter update: Picture
                         */

                        if ($('#product-picture').attr('src') != variant.image.src) {

                            clearTimeout(timeout);

                            $("#product").carousel(0).carousel('pause');

                            $('#product-picture').animate({
                                opacity: 0
                            }, 500, function() {
                                $("#product-picture").attr('src', variant.image.src);

                                $('#product-picture').animate({
                                    opacity: 1
                                }, 500);

                            });

                            var timeout = setTimeout(() => {
                                $("#product").carousel('cycle');
                            }, 20000);

                        }


                        /**
                         * Parameter update: Description
                         */

                        if ($('#product-short-description').html() != variant.variation_description) {

                            $('#product-short-description').animate({
                                opacity: 0
                            }, function() {

                                $('#product-short-description').html(variant.variation_description);

                                $('#product-short-description').animate({
                                    opacity: 1
                                }, function() {

                                });

                            });
                        }


                        /**
                         * Parameter update: Stock Note
                         */

                        if ($('#stock-note').html() != variant.availability_html) {

                            $('#stock-note').animate({
                                opacity: 0
                            }, function() {

                                $('#stock-note').html(variant.availability_html);

                                $('#stock-note').animate({
                                    opacity: 1
                                }, function() {

                                });

                            });
                        }

                    } else {
                        $('#product_option_warning').show(300, function() {});
                    }

                }

                $('#product-form').change(function(e) {
                    e.preventDefault();
                    render();
                });

                render();

                setTimeout(() => {
                    $('#woo_ajax_loader').remove();
                    $('div#form-product-container').animate({
                        opacity: 1
                    }, 1000);
                }, 1000);

            }

        }


        /**
         * Join a pseudo situation.
         * When you open the site on a mobile device, all styles
         * will be removed for components with the attribute
         * 
         * @version 1.0.0
        */
        
        for (const iterator of $('[remove_all_styles_in_mobile_version]')) {

            if (window.innerWidth < 768) {

                $(iterator).removeAttr('style');
                $(iterator).removeAttr('remove_all_styles_in_mobile_version');

            } 

        }

        if ($('[data-open-tab]').length !== 0) {

            $(`[data-tab]`).hide();
            if ($(`[data-tab="main"]`).length !== 0) {
                $(`[data-tab="main"]`).show();
            }

            for (const tab of $('[data-open-tab]')) {
                $(tab).click(function () {
                    $(`[data-tab]`).hide();
                    $(`[data-tab="${$(this).attr('data-open-tab')}"]`).show();
                });
            }
        }

        if ($('[data-html-part]').length !== 0) {
            for (const part of $('[data-html-part]')) {

                $.ajax({
                    type: "POST",
                    url: '',
                    data: {
                        'mrl_action': '.html_part_' + $(part).attr('data-html-part')
                    },
                    success: function (data) {
                        $(part).html(data);
                    }
                });

            }
        }

    });

}