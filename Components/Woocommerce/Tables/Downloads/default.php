<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_downloads_table');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    if (isset($props->downloads) and $props->downloads) {
        $props->downloads = (array) $props->downloads;
    } else {

        $props->posts = WC()->customer->get_downloadable_products();

        foreach ($props->posts as $index => $download) {
            $props->downloads[$index] = $download;
        }

    }

    TWIG::Render('Components/Woocommerce/default_downloads_table', $props);

});

Store::add($Component);