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
        (MIRELE_POST)['method'] === 'Compound-createPage' and
        isset((MIRELE_GET)['page']) and
        (MIRELE_GET)['page'] === 'сompound_render_editor'
    ) {

        # Create a work environment
        $name     = (MIRELE_POST)['name'];
        $template = (MIRELE_POST)['template'];
        $nonce    = (MIRELE_POST)['nonce'];

        # Security check and anti-spam requests
        if (wp_verify_nonce($nonce, MIRELE_NONCE)) {

            # If user login in and have permission
            if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['create'])) {

                # Create a work sub-environment
                $user = wp_get_current_user();
                $author_id = $user->ID;
                $title = str_replace(COMPOUND_FORBIDDEN_SYMBOLS, '', $name);
                $slug = sanitize_title($title);

                # Lexer object for generating $lex code
                $lexer = new Lexer("");

                # Get template
                $Template = Grider::get($template);

                if ($Template instanceof Template) {

                    $fields = $Template->getFields();

                    if ($fields) {

                        foreach ($fields as $field => $object) {

                            if ($object instanceof Field) {
                                $lexer->getSignature()->addTemplateField($template, $object->getName(), [
                                    (
                                    (new Tag())
                                        ->setTag('component')
                                    )
                                ]);
                            }
                        }
                    }

                    # We generate the code and create the page
                    $code = $lexer->generateCode();

                    # Request validation
                    $uploader_page = array(
                        'comment_status'        => 'closed',
                        'ping_status'           => 'closed',
                        'post_author'           => $author_id,
                        'post_name'             => $slug,
                        'post_title'            => $title,
                        'post_status'           => 'publish',
                        'post_type'             => 'page',
                        'post_content'          => "[Compound role='editor'] \n $code \n [/Compound]",
                        'page_template'     => COMPOUND_CANVAS
                    );

                    $post_id = wp_insert_post( $uploader_page );

                    if ( $post_id && !is_wp_error($post_id) ){
                        update_post_meta( $post_id, '_wp_page_template', COMPOUND_CANVAS );
                    }


                }

            }

        }

    }
});