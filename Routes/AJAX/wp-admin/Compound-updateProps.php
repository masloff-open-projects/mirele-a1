<?php

use Mirele\Router;
use Mirele\Compound\Lexer;
use Mirele\Compound\Tag;
use Mirele\Compound\Store;
use Mirele\Compound\Component;

# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-updateProps', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $props = array(
            'template'    => (MIRELE_POST)['template'],
            'component'   => (MIRELE_POST)['component'],
            'field'       => (MIRELE_POST)['field'],
            'page'        => (MIRELE_POST)['page'],
            'props'       => (MIRELE_POST)['props']
        );

        $wp_page = (object) get_post($props['page']);

        $Lexer = new Lexer($wp_page->post_content);
        $lex = $Lexer->parse();

        if ($lex) {

            if (isset((MIRELE_POST)['type']) and (MIRELE_POST)['type'] === 'update') {

                $root = (object) $lex->getRootInstanceById($props['template']);

                if (isset($root->fields) and is_array($root->fields)) {
                    if (isset($root->fields[$props['field']])) {
                        foreach ($root->fields[$props['field']] as $tag) {
                            if ($tag instanceof Tag) {
                                foreach ($props['props'] as $prop => $value) {
                                    $tag->setAttribute($prop, $value);
                                };
                            }
                        }
                    }
                }


            } elseif (isset((MIRELE_POST)['type']) and (MIRELE_POST)['type'] === 'remove') {

                $lex->removeField((string) $props['template'], (string) $props['field']);

            }

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

        wp_send_json_error([]);
        return;

    }

});