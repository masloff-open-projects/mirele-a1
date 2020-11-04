<?php


namespace Mirele\Network;

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Layout;
use Mirele\Compound\Lexer;
use Mirele\Compound\Response;
use Mirele\Compound\Tag;
use Mirele\Compound\Template;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;
use Mirele\Framework\Strategy;

/**
 * Class Request_Compound__getMarkup
 * @package Mirele\Network
 * @alias Compound/getMarkup
 * @description Endpoint serves to obtain a markup of the Compound page.
 * @version 1.0.0
 */
class Request_Compound__getMarkup extends Request
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

        /**
         * Create and transmit as a parameter 'strategy' the strategy object.
         * If successful, execute the function passed with the 'next' method,
         * if unsuccessful, execute the function passed with the 'reject' method
         *
         * @param Strategy $strategy Created strategy object
         */
        return $this->useAuthorizationStrategy(new __strategy_admin)->next(function ($a) {

            $props = array(
                'page' => (MIRELE_POST)['page'],
            );

            $wp_page = (object)get_post($props['page']);

            $Markup = array();
            $Lexer = new Lexer($wp_page->post_content);
            $lex = $Lexer->parse();

            if ((object)$lex and $lex instanceof Layout)
            {
                foreach ($lex->getLayout() as $ID => $Template)
                {

                    $template = Grider::findById($Template->props->name);

                    if ($template instanceof Template)
                    {

                        $fields = $template->getFields();

                        foreach ($fields as $name => $field)
                        {

                            if ($field instanceof Field)
                            {

                                $meta['editor'] = $field->getMeta('editor');

                                if ($meta['editor'] instanceof Config)
                                {

                                    $Markup[$ID]['fields'][$name]['meta']['editor'] = $meta['editor']->all();

                                }

                                if (isset($Template->fields[$name]))
                                {

                                    foreach ($Template->fields[$name] as $tag)
                                    {
                                        if ($tag instanceof Tag)
                                        {
                                            $Markup[$ID]['fields'][$name]['tags'][] = (object)[
                                                'tag'        => $tag->getTagName(),
                                                'essence'    => $tag->getEssence(),
                                                'attributes' => $tag->getAttributes()
                                            ];
                                        }
                                    }

                                }


                                $Markup[$ID]['fields'][$name]['field'] = (object)[
                                    'id'    => $field->getId(),
                                    'name'  => $field->getName(),
                                    'props' => $field->getProps(),
                                    'page'  => $props['page']
                                ];

                            }

                        }


                        # Get props
                        $Markup[$ID]['props'] = $Template->props;

                    }

                }
            }

            return new Response($Markup, 200);

        }
        )->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        }
        )();

    }

}