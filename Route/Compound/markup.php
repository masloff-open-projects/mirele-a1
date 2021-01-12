<?php


namespace Mirele\Network;

use Mirele\Compound\Layout;
use Mirele\Compound\Response;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\CompoundPrivate;
use Mirele\Framework\Strategy;

/**
 * Class Request_CompoundPrivate__markup
 * @package Mirele\Network
 * @alias CompoundPrivate/markup
 * @description Endpoint serves to obtain a markup of the Compound page.
 * @version 1.0.0
 */
class Request_CompoundPrivate__markup extends Request
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
        return $this->useAuthorizationStrategy(new CompoundPrivate)->next(function ($a) {

            $content = get_post(isset((MIRELE_POST)['id']) ? (MIRELE_POST)['id'] : 0)->post_content;
            $document = new \Mirele\Compound\Document($content);

            if ($document) {

                return new Response([
                    'document' => $document->getDocument()
                ], 200);

            } else {

                return new Response(Response::PATTERN_500, 500);

            }



        }
        )->reject(function ($a) {

            return new Response(Response::PATTERN_403, 403);

        }
        )();

    }

}