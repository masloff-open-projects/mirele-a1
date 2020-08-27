if (typeof jQuery == 'function' && jQuery.fn.jquery) {

    try {
        $.mobile.autoInitializePage = false;
    } catch (e) {
        console.group('Mirele Syntax Error!');
        console.warn(e);
        console.groupEnd();
    }

    $(window).on("load", function() {

        try {
            window.fac = new FastAverageColor();
        } catch (e) {
            console.group('Mirele Syntax Error!');
            console.warn(e);
            console.groupEnd();
        }

        if (typeof AOS == 'object') {
            AOS.init();
        }

        if (typeof lazyload == 'function') {
            let lazy = lazyload($('[data-loading="lazy"]'));
        }

    });

}
