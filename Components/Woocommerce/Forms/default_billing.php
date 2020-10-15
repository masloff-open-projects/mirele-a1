<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_form_billing');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/Woocommerce/default_form_billing', $props);

});

Store::add($Component);