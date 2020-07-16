/**
 * Registration of all events for which
 * Tracking scrolling is required.
 * Including theme packs of Classic, Minimalistic blocks
 *
 * @version 1.0.0
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {

    $(document).ready(function () {

        var scroll;

        var showed_bin = false;
        var showed_binflat = false;
        var showed_bindark = false;
        var showed_progress = false;
        var showed_bind = false;
        var showed_cinema = false;
        var showed_center_product_screen_image_bottom = false;
        var showed_video_presentation = false;

        var margin_top_header_picture = parseInt($('[animation_id="header"] > div > div > div.col-xs-12.col-sm-6.col-md-6.col-lg-6.parallax-move > img').css('margin-top'));
        var margin_left_header_picture = parseInt($('[animation_id="header"] > div > div > div.col-xs-12.col-sm-6.col-md-6.col-lg-6.parallax-move > img').css('margin-left'));

        $(window).scroll(function() {

            /**
             * Search for objects that require
             * color-dependent shadow stroke
             *
             * @version 1.0.0
             */

            if ($(`[data-dynamic-shadow]`).length !== 0) {

                for (const iterator of document.querySelectorAll('[data-dynamic-shadow]')) {

                    if ($(iterator).attr('src')) {

                        if (window.scrollY + window.innerHeight - ($(iterator).innerHeight() * 1) > $(iterator).offset().top) {

                            function shadow_render(iterator) {

                                if ($(iterator).attr('data-dynamic-shadow-type') == 'filter') {

                                    let color = window.fac.getColor(iterator);

                                    $(iterator).css({
                                        transition: '.3s'
                                    });

                                    $(iterator).css({
                                        filter: `drop-shadow(0px 0px 64px ${color.hexa})`
                                    });

                                } else if ($(iterator).attr('data-dynamic-shadow-type') == 'shadow') {

                                    let color = window.fac.getColor(iterator);

                                    $(iterator).css({
                                        transition: '.3s'
                                    });

                                    $(iterator).css({
                                        'box-shadow': `0 8px 64px -5px ${color.hexa}`
                                    });

                                } else if ($(iterator).attr('data-dynamic-shadow-type') == 'shadow-and-border') {

                                    let color = window.fac.getColor(iterator);

                                    $(iterator).css({
                                        transition: '.3s'
                                    });

                                    $(iterator).css({
                                        'box-shadow': `0 8px 64px -5px ${color.hexa}`,
                                        borderColor: color.hex
                                    });

                                } else if ($(iterator).attr('data-dynamic-shadow-type') == 'filter-shadow-bottom') {

                                    let color = window.fac.getColor(iterator);

                                    $(iterator).css({
                                        transition: '.3s'
                                    });

                                    $(iterator).css({
                                        filter: `drop-shadow(0px 72px 36px ${color.hexa})`
                                    });

                                }

                            }

                            if (parseInt($(iterator).attr('data-dynamic-shadow-timeout')) > 0) {
                                setTimeout(function(event) {

                                    try { shadow_render(iterator); } catch (e) {}

                                }, parseInt($(iterator).attr('data-dynamic-shadow-timeout')));
                            } else {

                                try { shadow_render(iterator); } catch (e) {}

                            }

                        }


                    }

                }

            }


            /**
             * Registration of the flat block "Business in numbers"
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="business_in_numbers_minimalism"]`).length !== 0 && showed_binflat == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="business_in_numbers_minimalism"]').innerHeight() * 0.8) > $('[animation_id="business_in_numbers_minimalism"]').offset().top) {

                    var delay = 1;
                    for (const iterator of $('.flat-number > [number-to]')) {

                        $({ numberValue: Number($(iterator).text()) }).delay((delay * 1000) * 0.45).animate({ numberValue: $(iterator).attr('number-to') }, {

                            duration: Number($(iterator).attr('duration')),
                            easing: "linear",

                            step: function(event) {
                                $(iterator).text(Math.ceil(event));
                            }

                        });

                        delay++;

                    }

                    showed_binflat = true;
                }
            }


            /**
             * Registering BIN DARK Block Animations
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="business_in_numbers_dark"]`).length !== 0 && showed_bindark == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="business_in_numbers_dark"]').innerHeight() * 0.8) > $('[animation_id="business_in_numbers_dark"]').offset().top) {

                    var delay = 1;

                    $('[animation_id="business_in_numbers_dark"] > div > div > div').animate({
                        opacity: 1
                    }, 2000);

                    for (const iterator of $('[animation_id="business_in_numbers_dark"] > div > div > div > [number-to]')) {

                        $(iterator).animate({
                            opacity: 1
                        });

                        $({ numberValue: Number($(iterator).text()) }).delay((delay * 1000) * 0.45).animate({ numberValue: $(iterator).attr('number-to') }, {

                            duration: Number($(iterator).attr('duration')),
                            easing: "easeInOutQuad",

                            step: function(event) {
                                $(iterator).text(Math.ceil(event));
                            }

                        });

                        delay++;

                    }

                    showed_bindark = true;
                }
            }


            /**
             * Registering BIN Block Animations
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="business_in_numbers"]`).length !== 0 && showed_bin == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="business_in_numbers"]').innerHeight() * 0.8) > $('[animation_id="business_in_numbers"]').offset().top) {

                    var delay = 1;

                    $('[animation_id="business_in_numbers"] > div > div > div').animate({
                        opacity: 1
                    }, 800);

                    for (const iterator of $('[animation_id="business_in_numbers"] > div > div > div > [number-to]')) {

                        $({ numberValue: Number($(iterator).text()) }).delay((delay * 1000) * 0.45).animate({ numberValue: $(iterator).attr('number-to') }, {

                            duration: Number($(iterator).attr('duration')),
                            easing: "linear",

                            step: function(event) {
                                $(iterator).text(Math.ceil(event));
                            }

                        });

                        delay++;

                    }

                    showed_bin = true;
                }
            }


            /**
             * Registering Progress Block Animations
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="progress_section"]`).length !== 0 && showed_progress == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="progress_section"]').innerHeight() * 0.8) > $('[animation_id="progress_section"]').offset().top) {

                    var delay = 1;

                    for (const iterator of $(`[animation_id="progress_section"] > div > div > div:nth-child(2) > div > div`)) {

                        $({ numberValue: 0 }).delay((delay * 1000) * 0.45).animate({ numberValue: $(iterator).attr('progress') }, {

                            duration: Number($(iterator).attr('duration')),
                            easing: "easeInOutQuad",

                            step: function(event) {
                                $(iterator).css({
                                    width: `${Math.ceil(event)}%`
                                })
                            }

                        });

                        $(iterator).delay((delay * 1000) * 0.45).animate({
                            opacity: 1
                        });

                        delay++;

                    }

                    showed_progress = true;
                }
            }


            /**
             * Registering BIN Desert block animation
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="business_in_numbers_desert"]`).length !== 0 && showed_bind == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="business_in_numbers_desert"]').innerHeight() * 0.8) > $('[animation_id="business_in_numbers_desert"]').offset().top) {

                    var delay = 1;

                    $('[animation_id="business_in_numbers_desert"] > div > div > div').animate({
                        opacity: 1
                    }, 800);

                    for (const iterator of $('[animation_id="business_in_numbers_desert"] > div > div > div > [number-to]')) {

                        $({ numberValue: Number($(iterator).text()) }).delay((delay * 1000) * 0.45).animate({ numberValue: $(iterator).attr('number-to') }, {

                            duration: Number($(iterator).attr('duration')),
                            easing: "linear",

                            step: function(event) {
                                $(iterator).text(Math.ceil(event));
                            }

                        });

                        delay++;

                    }

                    showed_bind = true;
                }

            }


            /**
             * Registration of animation of the appearance of products in the section
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="cinematographic_presentation"]`).length !== 0 && showed_cinema == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="cinematographic_presentation"]').innerHeight() * 0.2) > $('[animation_id="cinematographic_presentation"]').offset().top) {

                    var delay = 1;

                    for (const iterator of $('[animation_id="cinematographic_presentation"] > div > div > img')) {

                        setTimeout(function() {
                            $(iterator).attr('animation_play', true);
                        }, (delay * 1000) * 0.15);

                        delay++;

                    }

                    /**
                     * If there are more than 5 elements, then you need to give
                     * ability to scroll elements so that you can
                     * see all presented products
                     *
                     * @version 1.0.0
                     */

                    if ($('[animation_id="cinematographic_presentation"] > div > .cinematographic-items-block > img').length > 5) {

                        var position_x = 0;
                        var count = $('[animation_id="cinematographic_presentation"] > div > .cinematographic-items-block > img').length;
                        var width = $('[animation_id="cinematographic_presentation"] > div > .cinematographic-items-block > img').width();

                        $('.cinematographic_presentation_placeholder').delay(1000).animate({
                            opacity: 1
                        });

                        $('[animation_id="cinematographic_presentation"] > div > .cinematographic-items-block').mousewheel(function(event) {

                            if ((count * width) > position_x && (count * width) * -1 < position_x) {

                                if (event.deltaY < 0 || event.deltaX < 0) {

                                    position_x = position_x + 1 * 10 * 8;

                                    $('.cinematographic_presentation_element').css({
                                        transtition: '2s cubic-bezier(0.215, 0.610, 0.355, 1.000)',
                                        '-webkit-transform': `translateX(${position_x}px)`
                                    })

                                } else {

                                    position_x = position_x - 1 * 10 * 8;

                                    $('.cinematographic_presentation_element').css({
                                        transtition: '2s cubic-bezier(0.215, 0.610, 0.355, 1.000)',
                                        '-webkit-transform': `translateX(${position_x}px)`
                                    })

                                }

                            } else {
                                position_x = position_x / 4;
                            }

                            $('.cinematographic_presentation_placeholder').delay(4000).animate({
                                opacity: 0
                            });

                            return false;

                        });

                        $('[animation_id="cinematographic_presentation"]').on("swipeleft", function() {

                            position_x = position_x - 1 * 10 * 18;

                            $('.cinematographic_presentation_element').css({
                                transtition: '.3s cubic-bezier(0.215, 0.610, 0.355, 1.000)',
                                '-webkit-transform': `translateX(${position_x}px)`
                            });

                            $('.cinematographic_presentation_placeholder').delay(4000).animate({
                                opacity: 0
                            });

                        });


                        $('[animation_id="cinematographic_presentation"]').on("swiperight", function() {

                            position_x = position_x + 1 * 10 * 18;

                            $('.cinematographic_presentation_element').css({
                                transtition: '.3s cubic-bezier(0.215, 0.610, 0.355, 1.000)',
                                '-webkit-transform': `translateX(${position_x}px)`
                            });

                            $('.cinematographic_presentation_placeholder').delay(4000).animate({
                                opacity: 0
                            });

                        });

                    }

                    $('[animation_id="cinematographic_presentation"]').disableSelection();

                    showed_cinema = true;

                }

            }


            /**
             * If the video border extension animation was enabled, then
             * if the user does not look at her,
             * it must be destroyed in order not to load the site
             *
             * @version 1.0.0
             */

            if ($(`.theme-video-presentation > div > video[video_no_border]`).length !== 0) {

                if (window.scrollY + window.innerHeight - ($(`.theme-video-presentation > div > video[video_no_border]`).innerHeight() * 0.2) > $(`.theme-video-presentation > div > video[video_no_border]`).offset().top) {
                    // alert (1);
                } else {

                    if ('requestAnimationVideoNoFrame' in window) {
                        clearInterval(window.requestAnimationVideoNoFrame);
                        delete window.requestAnimationVideoNoFrame;

                        $(`.theme-video-presentation > div > video[video_no_border]`)[0].pause();

                    }

                }

            }


            /**
             * We are looking for components and prescribe animation
             * scroll for component with colorful
             * text
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="center_product_screen_image_bottom"]`).length !== 0 && showed_center_product_screen_image_bottom == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="center_product_screen_image_bottom"]').innerHeight() * 0.2) > $('[animation_id="center_product_screen_image_bottom"]').offset().top) {

                    karlin('[animation_id="center_product_screen_image_bottom"] > div > h1').animate({
                        transform: 'scale(1) translateY(0px)'
                    }, '.6s', '0s', 'cubic-bezier(0.250, 0.460, 0.450, 0.940)');

                    showed_center_product_screen_image_bottom = true;

                }

            }


            /**
             * Animation of a video presentation block.
             *
             * @version 1.0.0
             */

            if ($(`[animation_id="video-presentation"]`).length !== 0 && showed_video_presentation == false) {

                if (window.scrollY + window.innerHeight - ($('[animation_id="video-presentation"]').innerHeight() * 0.2) > $('[animation_id="video-presentation"]').offset().top) {

                    karlin('[animation_id="video-presentation"] > div > video').animate({
                        transform: 'scale(1) translateY(0px)'
                    }, '.6s', '0s', 'cubic-bezier(0.250, 0.460, 0.450, 0.940)');

                    showed_video_presentation = true;

                }

            }


            /**
             * Registration "swimming" product photos
             *
             * @version 1.0.0
             */

            if (window.scrollY - window.innerHeight < 0 && window.innerWidth > 768) {

                $('[animation_id="header"] > div > div > div > img[float-animation]').css({
                    marginTop: ((window.scrollY / 4) - margin_top_header_picture) * -1,
                    marginLeft: ((window.scrollY / 100) - margin_left_header_picture) * -1,
                    transform: `rotate(${window.scrollY / 80}deg)`,
                    transtition: 'all 1s cubic-bezier(0.4, 0, 0.2, 1) 0s'
                })

            }

        });


        /**
         * Preparation of all necessary
         * animations that cannot be done using
         * only cycle above
         *
         * @version 1.0.0
         */

        if ($(".mirele-preloader").length !== 0) {
            if ($(".mirele-preloader").attr('data-animation-out')) {

                if ($(".mirele-preloader").attr('data-animation-out') == "transparency-out") {
                    $(".mirele-preloader").delay(typeof $(".mirele-preloader").attr('data-animation-timeout') != "undefined" ? $(".mirele-preloader").attr('data-animation-timeout') : 300).animate({
                        opacity: 0
                    }, 600, function () {
                        $(".mirele-preloader").delay(typeof $(".mirele-preloader").attr('data-animation-timeout') != "undefined" ? $(".mirele-preloader").attr('data-animation-timeout') : 300).remove();
                    });
                } else if ($(".mirele-preloader").attr('data-animation-out') == "none") {
                    $(".mirele-preloader").delay(typeof $(".mirele-preloader").attr('data-animation-timeout') != "undefined" ? $(".mirele-preloader").attr('data-animation-timeout') : 1200).remove();
                } else if ($(".mirele-preloader").attr('data-animation-out') == "stay") {
                }

            } else {
                $(".mirele-preloader").delay(300).slideUp('slow');
            }

            $('body').css({
                'visibility': ''
            });

        }

    });
}