<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_step');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object)$props;

    TWIG::Render('Binder/Component/Woocommerce/default_step', $props);

}
);

Store::add($Component);