<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_abstract_label');
$Component->setProps([
    'text' => 'Hello world'
]);
$Component->setAlias('@label');
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_label', $props);

});

Store::add($Component);