<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_abstract_radio');
$Component->setProps([

]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_radio', $props);

});

Store::add($Component);