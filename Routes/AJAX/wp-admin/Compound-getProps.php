<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Lexer;
use Mirele\Compound\Response;
use Mirele\Compound\Store;
use Mirele\Compound\Tag;
use Mirele\Framework\Request;


# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
class WPAJAX_Compound__getProps extends Request {

    /**
     * The __invoke method is used to compile (if necessary) and process a request with the transferred parameters.
     * The query object also supports working with the 'handler' method, but its use is not recommended.
     *
     * PHPDOC: The __invoke method is called when a script tries to call an object as a function.
     *
     * @param $request array $_REQUEST
     * @return object|array|Response|boolean|string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(array $request)
    {
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
                                    return new Response($props, 200);
                                }
                            }
                        }
                    }
                }
            }


        } else {

            return new Response([
                'message' => 'Access to this endpoint is not available to you'
            ], 403);

        }
    }

}