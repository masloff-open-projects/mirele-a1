<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Response;
use Mirele\Framework\Customizer;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;
use Mirele\Framework\Strategy;


/**
 * Class WPAJAX_Compound__cloneTemplate
 * @package Mirele\WPAJAX
 * @alias Compound/cloneTemplate
 * @description The Endpoint serves to create a copy of the Instance Template.
 * @version 1.0.0
 */
class WPAJAX_namespaces extends Request
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

            return new Response([
                'result' => Customizer::namespaces()], 200);

        })->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        })();

    }

}