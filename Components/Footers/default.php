<?php

namespace Mirele\Components;

use Mirele\Framework\Component;
use Mirele\Framework\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_footer');
$Component->setProps([]);
$Component->setFunction(function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/default_footer', []);

});

Store::add($Component->build());