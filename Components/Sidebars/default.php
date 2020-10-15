<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;

$Component = new Component ();
$Component->setId('default_sidebar');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    if (isset($props->name) and $props->name) {
        dynamic_sidebar ($props->name);
    }

});

Store::add($Component);