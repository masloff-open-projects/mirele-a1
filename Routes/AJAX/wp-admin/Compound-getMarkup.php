<?php

use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Template;
use Mirele\Router;
use Mirele\Compound\Lexer;
use Mirele\Compound\Tag;
use Mirele\Compound\Store;
use Mirele\Compound\Component;
use Mirele\Compound\Config;


# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-getMarkup', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $props = array(
            'page' => (MIRELE_POST)['page'],
        );

        $wp_page = (object) get_post($props['page']);

        $Markup = array();
        $Lexer = new Lexer($wp_page->post_content);
        $lex = $Lexer->parse();

        foreach ($lex->getLayout() as $ID => $Template) {

            $template = Grider::get($Template->props->name);

            if ($template instanceof Template) {

                $fields = $template->getFields();

                foreach ($fields as $name => $field) {

                    if ($field instanceof Field) {

                        $meta['editor'] = $field->getMeta('editor');

                        if ($meta['editor'] instanceof Config) {

                            $Markup[$ID]['fields'][$name]['meta']['editor'] = $meta['editor']->all();

                        }

                        if (isset($Template->fields[$name])) {

                            foreach ($Template->fields[$name] as $tag) {
                                if ($tag instanceof Tag) {
                                    $Markup[$ID]['fields'][$name]['tags'][] = (object) [
                                        'tag' => $tag->getTagName(),
                                        'essence' => $tag->getEssence(),
                                        'attributes' => $tag->getAttributes()
                                    ];
                                }
                            }

                        }


                        $Markup[$ID]['fields'][$name]['field'] = (object) [
                            'id' => $field->getId(),
                            'name' => $field->getName(),
                            'props' => $field->getProps(),
                            'page' => $props['page']
                        ];

                    }

                }


                # Get props
                $Markup[$ID]['props'] = $Template->props;

            }

        }

        wp_send_json_error($Markup);
        return;

    }

});