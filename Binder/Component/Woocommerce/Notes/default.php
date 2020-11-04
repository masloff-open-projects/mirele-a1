<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_note');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object)$props;

    TWIG::Render('Binders/Component/Woocommerce/default_note', $props);

}
);

Store::add($Component);
