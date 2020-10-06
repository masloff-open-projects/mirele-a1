<?php

use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Lexer;
use Mirele\Compound\Store;
use Mirele\Compound\Tag;
use Mirele\Router;


# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
Router::post('/ajax_endpoint_v1/Compound-getProps', function () {

    # If user login in and have permission
    if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

        $props = array(
            'template' => (MIRELE_POST)['template'],
            'component' => (MIRELE_POST)['component'],
            'field' => (MIRELE_POST)['field'],
            'page' => (MIRELE_POST)['page'],
        );

        $wp_page = (object)get_post($props['page']);

        $Lexer = new Lexer($wp_page->post_content);
        $lex = $Lexer->parse();

        $root = (object)$lex->getRootInstanceById($props['template']);

        if (isset($root->fields) and is_array($root->fields)) {
            if (isset($root->fields[$props['field']])) {
                foreach ($root->fields[$props['field']] as $tag) {
                    if ($tag instanceof Tag) {
                        $name = $tag->getAttribute('name');
                        if (!empty($name)) {
                            $component = Store::get($name);
                            if ($component instanceof Component) {
                                $propsOfComponent = (array)$component->getProps();
                                $propsOfTag = (array)$tag->getAttributes();
                                $propsOfMeta = array();
                                $meta = $component->getMeta('editor');
                                if ($meta instanceof Config) {
                                    $propsOfMeta['meta'] = $meta->all();
                                }
                                $props = array_merge($propsOfMeta, [
                                    'props' => array_merge($propsOfComponent, $propsOfTag)
                                ]);
                                ksort($props);
                                unset($props['props']['name']);
                                unset($props['props']['id']);
                                wp_send_json_success($props);
                                return;
                            }
                        }
                    }
                }
            }
        }

        wp_send_json_error([]);
        return;

    }

});