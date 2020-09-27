<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_orders_placeholder');
$Component->setProps([]);
$Component->setFunction(function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Woocommerce/default_orders_placeholder', $props);

});

Store::add($Component);