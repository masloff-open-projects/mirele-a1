/**
 * Video border extension system.
 * It is optimized, but freezes can happen, as it is enough
 * resource-intensive
 *
 * @version 1.0.0
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {
    $(document).ready(function() {
        if ($(`.theme-video-presentation > div > video[video_no_border]`).length !== 0) {

            var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

            var cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame

            const animation_video_border_extension_type = $('.theme-video-presentation > div > video').attr('video_border_extension');

            const animation_video_border_extension_width = $('.theme-video-presentation > div > video').width();
            const animation_video_border_extension_height = $('.theme-video-presentation > div > video').height();
            const animation_video_border_extension_width_center = $('.theme-video-presentation > div > video').width() / 2;
            const animation_video_border_extension_width_column_4 = $('.theme-video-presentation > div > video').width() / 4;

            function anim_video_no_frames() {

                if (animation_video_border_extension_type == 'primitive') {

                    $('.theme-video-presentation').css({
                        background: fac.getColor($('.theme-video-presentation > div > video')[0]).rgba,
                        transition: '.2s'

                    });

                } else if (animation_video_border_extension_type == 'primitive-and-shadow') {

                    $('.theme-video-presentation').css({
                        background: fac.getColor($('.theme-video-presentation > div > video')[0]).rgba,
                        transition: '.2s'
                    });

                    $('.theme-video-presentation > div > video').css({
                        boxShadow: `0px 0px 48px 7px rgb(56, 59, 63)`
                    });

                } else if (animation_video_border_extension_type == 'primitive-extended') {

                    var left = fac.getColor($('.theme-video-presentation > div > video')[0], {
                        left: 0,
                        top: 0,
                        width: animation_video_border_extension_width_center,
                        height: animation_video_border_extension_height
                    }).hexa;

                    var right = fac.getColor($('.theme-video-presentation > div > video')[0], {
                        left: animation_video_border_extension_width_center,
                        top: 0,
                        width: animation_video_border_extension_width,
                        height: animation_video_border_extension_height
                    }).hexa;

                    $('.theme-video-presentation').css({
                        background: `linear-gradient(to right, ${left} 0%, ${right} 100%)`
                    });


                } else if (animation_video_border_extension_type == 'primitive-extended-4-column') {

                    var column_1 = fac.getColor($('.theme-video-presentation > div > video')[0], {
                        left: 0,
                        top: 0,
                        width: animation_video_border_extension_width_column_4,
                        height: animation_video_border_extension_height
                    }).hexa;

                    var column_2 = fac.getColor($('.theme-video-presentation > div > video')[0], {
                        left: animation_video_border_extension_width_column_4,
                        top: 0,
                        width: animation_video_border_extension_width_column_4 * 2,
                        height: animation_video_border_extension_height
                    }).hexa;

                    var column_3 = fac.getColor($('.theme-video-presentation > div > video')[0], {
                        left: animation_video_border_extension_width_column_4 * 2,
                        top: 0,
                        width: animation_video_border_extension_width_column_4 * 3,
                        height: animation_video_border_extension_height
                    }).hexa;

                    var column_4 = fac.getColor($('.theme-video-presentation > div > video')[0], {
                        left: animation_video_border_extension_width_column_4 * 3,
                        top: 0,
                        width: animation_video_border_extension_width,
                        height: animation_video_border_extension_height
                    }).hexa;

                    $('.theme-video-presentation').css({
                        background: `linear-gradient(to right, ${column_1} 0%, ${column_2} 25%, ${column_3} 75%, ${column_4} 100%)`
                    });

                } else if (animation_video_border_extension_type == 'neon-color') {

                    var bottom = fac.getColor($('.theme-video-presentation > div > video')[0], {
                        left: 0,
                        top: animation_video_border_extension_height - (animation_video_border_extension_height / 4),
                        width: animation_video_border_extension_width,
                        height: animation_video_border_extension_height
                    }).hexa;

                    $('.theme-video-presentation > div > video').css({
                        boxShadow: `0px 24px 48px -24px ${bottom}`
                    });

                }

            }

            $('.theme-video-presentation > div > video')[0].onplay = function() {
                async_execute(function() {
                    window.requestAnimationVideoNoFrame = setInterval(() => {
                        anim_video_no_frames();
                    }, 100);
                });
            }

            $('.theme-video-presentation > div > video')[0].onpause = function() {
                clearInterval(window.requestAnimationVideoNoFrame);
            }

        }
    });
}