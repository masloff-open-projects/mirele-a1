<?php

/**
* Template Name: Mirele Canvas
*
* @package: WordPress
* @subpackage: Mirele
* @since: Mirele Canvas 1
*/

use Mirele\Compound\Document;
use Mirele\Compound\DOM;
use Mirele\Compound\Document\TWIG as App;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Repository;
use Mirele\Compound\Tag;
use Mirele\Compound\Template;
use Mirele\Framework\Buffer;

global $post;

if (isset($post) and is_object($post)) {

    $HTML = '';
    $document = new Document($post->post_content);

    foreach ($document->getDocument() as $instance) {

        foreach ($instance as $name => $container) {

            $Tempalte = Repository::getTemplate($name);

            if ($Tempalte instanceof Template) {

                $DOMDocument = new DOM($Tempalte, [], $container);

                if ($DOMDocument->getDocument()) {
                    $HTML .= $DOMDocument->getDocument();
                }

            } else {
                wp_die("Template with identifier `{$name}` was not found in the system ", "Template not found");
            }

        }

    }

    App::render('Compound/Templates/canvas.html.twig', [
        'markup' => $HTML
    ]);

} else {

    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ". get_bloginfo('url'));
    exit;

}