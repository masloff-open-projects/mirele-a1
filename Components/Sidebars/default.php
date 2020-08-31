<?php

namespace Mirele\Components;

use Mirele\Framework\Component;
use Mirele\Framework\Store;

$Component = new Component ();
$Component->setId('default_sidebar');
$Component->setProps([]);
$Component->setFunction(function ($props) {

    $props = (object) $props;

    if (isset($props->name) and $props->name) {
        dynamic_sidebar ($props->name);
    }

});

Store::add($Component);