<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_footer');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/default_footer', []);

});

Store::add($Component);