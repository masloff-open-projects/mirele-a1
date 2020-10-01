<?php

/**
* Templates Name: Mirele Canvas
*
* @package: WordPress
* @subpackage: Mirele
* @since: Mirele Canvas 1
*/

use Mirele\Compound\Lexer;
use Mirele\Compound\Grider;
use Mirele\Compound\Template;
use Mirele\Compound\Field;
use Mirele\Compound\Tag;
use Mirele\Compound\Store;
use Mirele\Compound\Component;
use Mirele\Framework\Buffer;

global $post;

if (is_object($post)) {

    $Buffer = new Buffer();
    $Lexer = new Lexer($post->post_content);

    # Return the page with the template
    $lex = $Lexer->parse();

    # We check the essence of the lecturer
    if ((object) $lex) {

        # Variable $lex has full markup of
        # all data that the user has marked
        # up in the code, BUT
        # it has no possible fields that were missed by the user.
        #
        # Signature lex:
        # (id of template) dc2cebec9a14a69c103f5e0d3076269c:
        #   (object) props:
        #       name => value
        #   (array) fields:
        #       (index of template):
        #           (template)

        $Layout = $lex->getLayout();

        foreach ($Layout as $ID => $Template) {

            $fields = [];
            $components = [];

            # We will get all the registered fields
            # in the template, already from them we
            # will get the markup from the token data.

            if (isset($Template->props->name)) {

                $template = clone Grider::get($Template->props->name);

                if ($template instanceof Template) {

                    foreach ($template->getFields() as $index => $field) {
                        if ($field instanceof Field) {
                            $fields[$field->getName()] = $field;
                        }
                    }

                }

                if (isset($Template->fields)) {
                    foreach ($Template->fields as $field_name => $tags) {
                        foreach ($tags as $index => $tag) {
                            if ($tag instanceof Tag) {
                                if ($tag->getTagName() === 'component') {

                                    $component = Store::get($tag->getAttributes()['name']);

                                    if ($component instanceof Component) {

                                        $component = clone $component;
                                        $component->setProps($tag->getAttributes());

                                        $components[$field_name][] = $component;

                                    }

                                }
                            }
                        }
                    }
                }

                $Buffer->append(Grider::call($Template->props->name, array_merge(
                    (array) [],
                    (array) [
                        'call' => [
                            'components' => $components
                        ],
                    ]
                ), true));

            }


        }


        \Mirele\TWIG::Render('Main/canvas', [
            'markup' => $Buffer->toString('*', '')
        ]);

    }

}