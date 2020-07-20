/**
 * Register hooks for detailed image viewing
 *
 * @version 1.0.0
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {

    $(document).ready(function () {

        for (const iterator of $('[data-lightboximage]')) {

            $(iterator).dblclick(function () {
                karlin('body').lightboximage($(iterator).attr('src'));
            });

            $(iterator).on('doubletap', function () {
                karlin('body').lightboximage($(iterator).attr('src'));
            });

        }

    });

}