/**
 * Deferred page rendering function.
 *
 * @version 1.0.0
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {
    $(document).ready(function () {
        if ($('[data-delayed]').length !== 0) {

            for (const delayed of $('[data-delayed]')) {
                let page = delayed;
                $(delayed).remove();
                $($(page).attr('data-delayed')).delay(0).fadeIn(300);
                delete page;
            }
        }
    });
}

