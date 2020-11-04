<?php

/**
* Template Name: Mirele Canvas
*
* @package: WordPress
* @subpackage: Mirele
* @since: Mirele Canvas 1
*/

use Mirele\Compound\Component;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Lexer;
use Mirele\Compound\Store;
use Mirele\Compound\Tag;
use Mirele\Compound\Template;
use Mirele\Framework\Buffer;
use \Mirele\Compound\Document;
use Mirele\TWIG;

global $post;

if (isset($post) and is_object($post)) {

    $HTML = '';
    $components = [];
    $document = new Document();

    foreach ($document->document($post->post_content) as $container_name => $container) {

        foreach ($container as $area_name => $area) {

            foreach ($area as $component) {


                $Component = Store::get($component['component']);

                if ($Component instanceof Component) {

                    $object = clone $Component;
                    $object->setProps(array_merge(
                        $component['attributes'],
                        [
                            'value' => $component['value']
                        ]
                    ));

                    $components[$area_name][] = $object;

                }

            }

            $HTML .= Grider::call($container_name, array_merge(
                (array) [],
                (array) [
                    'call' => [
                        'components' => $components
                    ],
                ]
            ), true);

            $components = [];

        }

    }

    TWIG::Render('Compound/Engine/Application/canvas.html.twig', [
        'markup' => $HTML
    ]);

} else {

    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ". get_bloginfo('url'));
    exit;

}