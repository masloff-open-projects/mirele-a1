<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_cart');
$Component->setProps([
    'title' => 'New cart',
    'description' => 'New card successfully created',
    'button' => [
        'link' => '#',
        'text' => 'Learn more'
    ]
]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    TWIG::Render('Components/default_cart', $props);

});

Store::add($Component);