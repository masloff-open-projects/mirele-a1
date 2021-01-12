<?php


namespace Mirele\Network;

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
            $path = explode('/', (MIRELE_POST)['path']);
            $document = new \Mirele\Compound\Document($content);

            if ($document) {

                switch ((MIRELE_POST)['type']) {

                    case 'INSERT':

                        $template = Repository::getTemplate((MIRELE_POST)['template']);

                        if ($template instanceof Template) {

                            // Get markup of document
                            $dom = new DOM($template, [], []);
                            $areas = (array)$dom->getAreas();
                            $document = (array)$document->getDocument();

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

                        break;

                    case 'DUBLICATE':

                        $document = (array)$document->getDocument();

                        if ((MIRELE_POST)['DUBLICATE']) {

                            foreach ((MIRELE_POST)['DUBLICATE'] as $path) {
                                $path = Compound::pathToObject($path);
                                $document[][$path->template] = $document[$path->index][$path->template];
                            }

                            $document = new \Mirele\Compound\Document($document);

                            $r = Compound::updatePageContent((MIRELE_POST)['PageID'], $document->getCXML());

                            return new Response([
                                $r
                            ], 200);

                        }

                        break;

                    case 'DELETE':

                        $document = (array)$document->getDocument();

                        if ((MIRELE_POST)['DELETE']) {

                            foreach ((MIRELE_POST)['DELETE'] as $path) {
                                $path = Compound::pathToObject($path);
                                unset ($document[$path->index][$path->template]);
                            }

                            $document = new \Mirele\Compound\Document($document);

                            $r = Compound::updatePageContent((MIRELE_POST)['PageID'], $document->getCXML());

                            return new Response([
                                $r
                            ], 200);

                        }

                        break;

                    case 'ORDER':

                        $document = (array)$document->getDocument();

                        if (!empty(array_diff([
                            'ORDER'
                        ], array_keys(MIRELE_POST)))) {
                            return new Response(Response::PATTERN_421, 421);
                        }

                        $newDocument = [];

                        foreach ((MIRELE_POST)['ORDER'] as $path) {
                            $path = Compound::pathToObject($path);
                            $newDocument[$path->index] = $document[$path->index];
                        }

                        sort($newDocument);

                        $document = new \Mirele\Compound\Document($newDocument);

                        return new Response([
                            'statusUpdate' => Compound::updatePageContent((MIRELE_POST)['PageID'], $document->getCXML())
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