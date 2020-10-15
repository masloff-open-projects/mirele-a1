<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_abstract_select');
$Component->setProps([

]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_select', $props);

});

Store::add($Component);