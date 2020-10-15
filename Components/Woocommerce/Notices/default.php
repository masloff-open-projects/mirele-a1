<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_notice');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Woocommerce/default_notice', $props);

});

Store::add($Component);
