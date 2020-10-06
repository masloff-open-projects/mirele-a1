<?php

use Mirele\Compound\Lexer;
use Mirele\Router;

Router::post('/wp-admin/admin.php', function () {
    if (
        isset((MIRELE_POST)['method']) and
        (MIRELE_POST)['method'] === 'Compound-insertComponent' and
        isset((MIRELE_GET)['page']) and
        (MIRELE_GET)['page'] === 'сompound_render_editor'
    ) {

        # Create a work environment
        $component = (MIRELE_POST)['component'];
        $page = (MIRELE_POST)['page'];
        $nonce = (MIRELE_POST)['nonce'];
        $field = (MIRELE_POST)['field'];
        $template = (MIRELE_POST)['template'];

        # Security check and anti-spam requests
        if (wp_verify_nonce($nonce, MIRELE_NONCE)) {

            # If user login in and have permission
            if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['create'])) {

                $wp_page = (object)get_post($page);
                $content = $wp_page->post_content;
                $lexer = new Lexer($content);

                $lexer->parse();
                $root = $lexer->getSignature()->getRootInstanceById((string)$template);

                if ($root !== false) {

                    $Component = \Mirele\Compound\Store::get($component);

                    if ($Component instanceof \Mirele\Compound\Component) {

                        $tag = new \Mirele\Compound\Tag();
                        $tag->setTag('component');
                        $tag->setAttributes((array)$Component->getProps());
                        $tag->setAttribute('name', $Component->getAlias() ? $Component->getAlias() : $Component->getId());

                        $root->fields[(string)$field] = (array)[$tag];

                        $lexer->getSignature()->setRootInstanceById((string)$template, $root);

                        $code = $lexer->generateCode();

                        wp_update_post(array(
                            'ID' => (int)$wp_page->ID,
                            'post_content' => (string)"[Compound role='editor'] \n $code \n [/Compound]",
                        ));

                        update_post_meta(
                            (int)$wp_page->ID,
                            '_wp_page_template',
                            COMPOUND_CANVAS
                        );

                    }

                }


//                $pattern = new Patterns\insertComponent();
//                $pattern->setPage($page);
//                $pattern->setComponent($component);
//
//                $pattern->execute();

            }

        }

    }
});