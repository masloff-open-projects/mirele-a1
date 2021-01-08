<?php

namespace Mirele\Network;

use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
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
class Request_Compound__createPage extends Request
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

            # Create a work environment
            $nonce = (MIRELE_POST)['nonce'];

            # Security check and anti-spam requests
            if (wp_verify_nonce($nonce, MIRELE_NONCE))
            {

                # If user login in and have permission
                if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['create']))
                {

                    $pattern = new Patterns\createPage();
                    $pattern->name = (MIRELE_POST)['name'];

                    $pattern();

                    return new Response([], 200);

                }

            }

            return new Response([], 500);

        }
        )->reject(function ($a) {
            return new Response(Response::PATTERN_403, 403);
        }
        )();

    }

}