<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_unit');
$Component->setAlias('@unit');
$Component->setProps(range(1, 20));
$Component->setMeta('editor',
    (new Config())
        ->setData('title', 'Unit')
        ->setData('description', '')
        ->setData('alias', '')
);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_button', $props);

});

Store::add($Component);