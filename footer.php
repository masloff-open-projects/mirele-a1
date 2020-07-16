<?php

    global $mrouter;
    global $mstyler;

    do_action('mirele_footer_before');

    if (get_option('mrl_wp_footer_enabled', 'true') == 'true') {
        mirele_execute_component_logic('footer', get_option('mrl_wp_footer', 'standart'));
        mirele_execute_component('footer', get_option('mrl_wp_footer', 'standart'));
    }

    if (is_page_template(ROSEMARY_CANVAS)) {
        $mstyler->execute('mirele_canvas');
    }

    if (get_option('mrl_wp_js_disabled_warning', false)) {
        mirele_execute_component('no_js_box', get_option('mrl_wp_no_js_box', 'standart'));
    }

    if (get_option('mrl_wp_cookies_warning', false)) {

        global $mdata;
        $mdata->js_set('verify_allow_cookie', 'true');

        mirele_execute_component('cookie_box', get_option('mrl_wp_cookie_box', 'standart'));

    }

    $mrouter->execute('any-footer');
    $mrouter->execute('site-footer');

    $mstyler->execute('any');

    wp_footer();


?>

</body>

</html>