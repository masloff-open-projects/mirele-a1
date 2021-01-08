<?php


namespace Mirele\Network;

use Couchbase\Document;
use Mirele\Compound\Component;
use Mirele\Compound\Helpers\Compound;
use Mirele\Compound\Layout;
use Mirele\Compound\Repository;
use Mirele\Compound\Response;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\CompoundPrivate;
use Mirele\Framework\Strategy;

/**
 * Class Request_CompoundPrivate__component
 * @package Mirele\Network
 * @alias CompoundPrivate/component
 * @description Endpoint serves to obtain a markup of the Compound component.
 * @version 1.0.0
 */
class Request_CompoundPrivate__component extends Request
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

            // Get document
            $content = get_post(isset((MIRELE_POST)['PageID']) ? (MIRELE_POST)['PageID'] : 0)->post_content;
            $document = new \Mirele\Compound\Document($content);

            if ($document) {

                // Get markup of document
                $document = (array) $document->getDocument();

                switch ((MIRELE_POST)['type']) {

                    case 'UPDATE':

                        // Get component markup
                        if (isset($document[(MIRELE_POST)['Index']][(MIRELE_POST)['Template']][(MIRELE_POST)['Area']][(MIRELE_POST)['Component']])) {

                            foreach ((MIRELE_POST)['UPDATE'] as $key => $value) {
                                $document[(MIRELE_POST)['Index']][(MIRELE_POST)['Template']][(MIRELE_POST)['Area']][(MIRELE_POST)['Component']]['attributes'][$key] = $value;
                            }


                            $document = new \Mirele\Compound\Document($document);

                            return new Response([
                                'statusUpdate' => Compound::updatePageContent((MIRELE_POST)['PageID'], $document->getCXML())
                            ], 200);

                        } else {

                            return new Response(Response::PATTERN_404, 404);

                        }

                        break;

                    case 'INSERT':

                        $component = Repository::getComponent((MIRELE_POST)['component']);

                        if ($component instanceof Component) {

                            $document[(MIRELE_POST)['Index']][(MIRELE_POST)['Template']][(MIRELE_POST)['Area']][$component->getId()] = [
                                'component' => $component->getId(),
                                'attributes' => array_merge(
                                    [
                                        'id' => uniqid('cpd')
                                    ],
                                    (array) $component->getProps()
                                )
                            ];

                            $document = new \Mirele\Compound\Document($document);

                            return new Response([
                                'statusUpdate' => Compound::updatePageContent((MIRELE_POST)['PageID'], $document->getCXML())
                            ], 200);

                        }

                        break;

                }


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