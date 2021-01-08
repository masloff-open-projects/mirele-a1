<?php


namespace Mirele\Network;

use Couchbase\Document;
use Mirele\Compound\DOM;
use Mirele\Compound\Helpers\Compound;
use Mirele\Compound\Layout;
use Mirele\Compound\Repository;
use Mirele\Compound\Response;
use Mirele\Compound\Template;
use Mirele\Framework\Request;
use Mirele\Framework\Strategists\CompoundPrivate;
use Mirele\Framework\Strategy;

/**
 * Class Request_CompoundPrivate__component
 * @package Mirele\Network
 * @alias CompoundPrivate/template
 * @description Endpoint serves to obtain a markup of the Compound template.
 * @version 1.0.0
 */
class Request_CompoundPrivate__template extends Request
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

                $template = Repository::getTemplate((MIRELE_POST)['template']);

                if ($template instanceof Template) {

                    // Get markup of document
                    $dom = new DOM($template, [], []);
                    $areas = (array) $dom->getAreas();
                    $document = (array) $document->getDocument();

                    $insertAreas = [];

                    foreach ($areas as $key => $value) {
                        $insertAreas[$key] = [];
                        foreach ($value as $k => $component) {
                            $insertAreas[$key][$component['attrs']['id']] = [
                                'component' => $component['component'],
                                'attributes' => array_merge([
                                    'value' => $component['value']
                                ], $component['attrs'])
                            ];
                        }
                    }

                    $document[][(MIRELE_POST)['template']] = $insertAreas;

                    $document = new \Mirele\Compound\Document($document);

                    $r = Compound::updatePageContent((MIRELE_POST)['PageID'], $document->getCXML());

                    return new Response([
                        $r
                    ], 200);

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