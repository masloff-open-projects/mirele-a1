<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('darkness_navbar');
$Component->setProps([]);
$Component->setHandler('output', function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/darkness_navbar', $props);

});

Store::add($Component);
