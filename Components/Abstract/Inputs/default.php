<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_abstract_input');
$Component->setProps([
    'value' => ''
]);
$Component->setMeta('editor',
    (new Config())
        ->setData('title', 'Input')
        ->setData('description', '')
        ->setData('alias', '')
);

$Component->setAlias('@input');
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_input', $props);

});

Store::add($Component);