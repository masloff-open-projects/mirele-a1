<?php


namespace Mirele\Network;

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

            if (!array_key_exists('PageID', MIRELE_POST) || !array_key_exists('type', MIRELE_POST)) {
                return new Response(Response::PATTERN_421, 421);
            }

            $document = new \Mirele\Compound\Document(get_post((MIRELE_POST)['PageID'])->post_content);

            if (!$document) {
                return new Response(Response::PATTERN_500, 500);
            }

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

                    if (!empty(array_diff([
                        'component',
                        'path'
                    ], array_keys(MIRELE_POST)))) {
                        return new Response(Response::PATTERN_421, 421);
                    }

                    $path = Compound::pathToObject((MIRELE_POST)['path']);
                    $component = Repository::getComponent((MIRELE_POST)['component']);

                    if ($component instanceof Component == false) {
                        return new Response(Response::PATTERN_500, 500);
                    }

                    if (
                        !isset($path->index) or
                        !isset($path->template) or
                        !isset($path->area)
                    ) {
                        return new Response(Response::PATTERN_421, 421);
                    }

                    $document[$path->index][$path->template][$path->area][$component->getId()] = [
                        'component' => $component->getId(),
                        'attributes' => array_merge(
                            [
                                'id' => uniqid()
                            ],
                            (array) $component->getProps()
                        )
                    ];

                    $document = new \Mirele\Compound\Document($document);

                    return new Response([
                        'statusUpdate' => Compound::updatePageContent((MIRELE_POST)['PageID'], $document->getCXML())
                    ], 200);


                    break;

            }


        }
        )->reject(function ($a) {

            return new Response(Response::PATTERN_403, 403);

        }
        )();

    }

}