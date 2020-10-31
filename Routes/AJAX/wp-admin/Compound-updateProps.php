<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;
use Mirele\Framework\Strategy;


class WPAJAX_Compound__updateProps extends Request
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

            # Implementation of an event pattern created as
            # an abstract object in the "Mirele\Compound\Patterns" namespace
            $pattern = new Patterns\updateProps();
            $pattern->template = (MIRELE_POST)['template'];
            $pattern->component = (MIRELE_POST)['component'];
            $pattern->field = (MIRELE_POST)['field'];
            $pattern->page = (MIRELE_POST)['page'];
            $pattern->props = (MIRELE_POST)['props'];
            $pattern->type = (MIRELE_POST)['type'];

            $execute = $pattern();

            # Return the results of the pattern
            if ($execute)
            {

                return new Response([
                    'result' => $execute], 200);

            } else
            {

                return new Response([
                    'result' => $execute], 500);

            }

        })->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        })();

    }

}
