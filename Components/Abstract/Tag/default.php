<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_abstract_tag');
$Component->setProps([
    'tag' => 'h1',
    'value' => 'Hello world',
    'style' => ''
]);
$Component->setMeta('editor',
    (new Config())
        ->setData('title', 'Tag')
        ->setData('description', '')
        ->setData('alias', '')
);
$Component->setAlias('@tag');
$Component->setFunction(function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_tag', (object) [
        'props' => $props
    ]);

});

Store::add($Component);