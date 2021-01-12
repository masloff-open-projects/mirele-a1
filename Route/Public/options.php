<?php


namespace Mirele\Network;


use Mirele\Compound\Response;
use Mirele\Framework\Buffer;
use Mirele\Framework\Customizer;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\__strategy_admin;
use Mirele\Framework\Strategy;


/**
 * Class Request_Compound__cloneTemplate
 * @package Mirele\Network
 * @alias Compound/cloneTemplate
 * @description The Endpoint serves to create a copy of the Instance Template.
 * @version 1.0.0
 */
class Request_options extends Request
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

            # Setting up the environment
            $namespace = isset((MIRELE_POST)['namespace']) ? ((MIRELE_POST)['namespace'] === 'all' ? Customizer::namespaces(
            ) : explode('|', (MIRELE_POST)['namespace'])) : '*';
//            $buffer = new Buffer();

            # Foreach options store
            foreach ($namespace as $name)
            {
                foreach (Customizer::all($name) as $Option)
                {
//                    $buffer->setNamespace($name);
//                    $buffer->append($Option->build());
                }
            }

//            return new Response([
//                'result' => $buffer->getBuffer((MIRELE_POST)['namespace'] === 'all' ? 'all' : (MIRELE_POST)['namespace'])], 200);

        }
        )->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        }
        )();

    }

}
