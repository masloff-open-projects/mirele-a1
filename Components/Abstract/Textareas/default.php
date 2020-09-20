<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_abstract_textarea');
$Component->setProps([

]);
$Component->setFunction(function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Abstract/default_textarea', $props);

});

Store::add($Component);