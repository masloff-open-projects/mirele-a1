<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$pages = get_pages( array(
    'meta_key' => '_wp_page_template',
    'meta_value' => COMPOUND_CANVAS
));

foreach ($pages as $page) {

    $Component = new Component ();
    $Component->setId('default_multi_template_' . $page->ID);
    $Component->setAlias("@prototype" . $page->ID);
    $Component->setParent('Prototype');
    $Component->setFunction(function ($props) {



    });

    Store::add(clone $Component);

}
