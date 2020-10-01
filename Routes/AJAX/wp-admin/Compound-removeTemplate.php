<?php

use Mirele\Router;
use Mirele\Compound\Lexer;
use Mirele\Compound\Tag;
use Mirele\Compound\Store;
use Mirele\Compound\Component;

# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-removeTemplate', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $props = array(
            'template'    => (MIRELE_POST)['template'],
            'id'          => (MIRELE_POST)['id']
        );

        $wp_page = (object) get_post($props['id']);

        $Lexer = new Lexer($wp_page->post_content);
        $lex = $Lexer->parse();

        $lex->removeTemplate($props['template']);

        $code = $Lexer->generateCode();

        wp_update_post(array(
            'ID' => (int)$wp_page->ID,
            'post_content' => (string)"[Compound role='editor'] \n $code \n [/Compound]",
        ));

        update_post_meta(
            (int)$wp_page->ID,
            '_wp_page_template',
            COMPOUND_CANVAS
        );

        wp_send_json_success([]);
        return;

    }

});