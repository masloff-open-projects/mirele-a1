<?php


namespace Mirele\Network;


use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Lexer;
use Mirele\Compound\Response;
use Mirele\Compound\Market;
use Mirele\Compound\Tag;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;


/**
 * Class Request_Compound__getProps
 * @package Mirele\Network
 * @alias Compound/getProps
 * @description The endpoint is used to obtain parameters about a component.
 * @version 1.0.0
 */
class Request_Compound__getProps extends Request
{

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

        return $this->useAuthorizationStrategy(new __strategy_admin)->next(function ($a) {

            $props = array(
                'template'  => (MIRELE_POST)['template'],
                'component' => (MIRELE_POST)['component'],
                'field'     => (MIRELE_POST)['field'],
                'page'      => (MIRELE_POST)['page'],
            );

            $wp_page = (object)get_post($props['page']);

            $Lexer = new Lexer($wp_page->post_content);
            $lex = $Lexer->parse();

            $root = (object)$lex->getRootInstanceById($props['template']);

            if (isset($root->fields) and is_array($root->fields))
            {
                if (isset($root->fields[$props['field']]))
                {
                    foreach ($root->fields[$props['field']] as $tag)
                    {
                        if ($tag instanceof Tag)
                        {
                            $name = $tag->getAttribute('name');
                            if (!empty($name))
                            {
                                $component = Market::get($name);
                                if ($component instanceof Component)
                                {
                                    $propsOfComponent = (array)$component->getProps();
                                    $propsOfTag = (array)$tag->getAttributes();
                                    $propsOfMeta = array();
                                    $meta = $component->getMeta('editor');
                                    if ($meta instanceof Config)
                                    {
                                        $propsOfMeta['meta'] = $meta->all();
                                    }
                                    $props = array_merge($propsOfMeta, [
                                        'props' => array_merge($propsOfComponent, $propsOfTag)
                                    ]
                                    );
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

        }
        )->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        }
        )();

    }

}