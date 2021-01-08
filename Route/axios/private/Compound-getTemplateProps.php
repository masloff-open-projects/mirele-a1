<?php


namespace Mirele\Network;


use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;

/**
 * Class Request_Compound__getTemplateProps
 * @package Mirele\Network
 * @alias Compound/getTemplateProps
 * @description The endpoint serves to obtain the parameters of a particular template.
 * @version 1.0.0
 */
class Request_Compound__getTemplateProps extends Request
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

            $pattern = new Patterns\propsTemplate();
            $pattern->template = (MIRELE_POST)['template'];
            $pattern->page = (MIRELE_POST)['page'];

            return new Response([
                'props' => $pattern()
            ], 200
            );

        }
        )->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        }
        )();

    }

}