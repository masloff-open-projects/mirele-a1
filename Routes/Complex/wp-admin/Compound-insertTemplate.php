<?php

use \Mirele\Router;
use \Mirele\Compound\Lexer;
use \Mirele\Compound\Tag;
use \Mirele\Compound\Grider;
use \Mirele\Compound\Template;
use \Mirele\Compound\Field;

Router::post('/wp-admin/admin.php', function () {
    if (
        isset((MIRELE_POST)['method']) and
        (MIRELE_POST)['method'] === 'Compound-insertTemplate' and
        isset((MIRELE_GET)['page']) and
        (MIRELE_GET)['page'] === 'сompound_render_editor'
    ) {

        # Create a work environment
        $page     = (MIRELE_POST)['page'];
        $template = (MIRELE_POST)['template'];
        $nonce    = (MIRELE_POST)['nonce'];

        # Security check and anti-spam requests
        if (wp_verify_nonce($nonce, MIRELE_NONCE)) {

            # If user login in and have permission
            if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['create'])) {

                $wp_page = (object) get_post($page);

                if (isset($wp_page->post_content) and $wp_page->post_content) {

                    # Content
                    $content = $wp_page->post_content;

                    # Lexer
                    $lexer = new Lexer($content);

                    # Proccess parsing
                    if ($lexer->parse()) {

                        # Get template
                        $Template = Grider::get($template);

                        if ($Template instanceof Template) {

                            $fields = $Template->getFields();

                            if ($fields) {

                                foreach ($fields as $field => $object) {

                                    if ($object instanceof Field) {
                                        $lexer->getSignature()->addTemplateField(
                                            $template, $object->getName(), [
                                            (
                                            (new Tag())
                                                ->setTag('component')
                                            )
                                        ]);
                                    }
                                }
                            }

                        }

                    }

                    if (isset($wp_page->ID) and $wp_page->ID) {

                        $code = $lexer->generateCode();

                        wp_update_post(array(
                            'ID'           => (int) $wp_page->ID,
                            'post_content' => (string) "[Compound role='editor'] \n $code \n [/Compound]",
                        ));

                        update_post_meta(
                            (int) $wp_page->ID,
                            '_wp_page_template',
                            COMPOUND_CANVAS
                        );

                    }

                }

            }

        }

    }
});