<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;


/**
 * Class WPAJAX_Compound__cloneTemplate
 * @package Mirele\WPAJAX
 * @alias Compound/cloneTemplate
 * @description The Endpoint serves to create a copy of the Instance Template.
 * @version 1.0.0
 */
class WPAJAX_Compound__cloneTemplate extends Request
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

            # Implementation of an event pattern created as
            # an abstract object in the "Mirele\Compound\Patterns" namespace
            $pattern = new Patterns\cloneTemplate();
            $pattern->template = (MIRELE_POST)['template'];
            $pattern->page = (MIRELE_POST)['page'];

            $biffer = $pattern();

            if ($biffer)
            {

                return new Response([
                    'result' => $biffer], 200);

            } else
            {

                return new Response([
                    'result' => $biffer], 500);

            }


        })->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        })();

    }

}
