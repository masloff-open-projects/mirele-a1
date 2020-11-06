<?php


namespace Mirele\Network;


use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;
use Mirele\Framework\Strategy;


class Request_Compound__insertComponent extends Request
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

            $pattern = new Patterns\insertComponent();
            $pattern->page = (MIRELE_POST)['page'];
            $pattern->component = (MIRELE_POST)['component'];
            $pattern->field = (MIRELE_POST)['field'];
            $pattern->template = (MIRELE_POST)['template'];

            $buffer = $pattern();

            if ($buffer)
            {

                return new Response([
                    'result' => $buffer
                ], 200
                );

            } else
            {

                return new Response([
                    'result' => $buffer
                ], 500
                );

            }

        }
        )->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        }
        )();

    }

}