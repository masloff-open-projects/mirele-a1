<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_abstract_button');
$Component->setAlias('@button');
$Component->setProps([
    'value' => 'Hello world'
]);
$Component->setMeta('editor',
    (new Config())
        ->setData('title', 'Button')
        ->setData('description', '')
        ->setData('alias', '')
);
$Component->setFunction(function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_button', $props);

});

Store::add($Component);