<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(true)
    ->setName("mrl_wp_show_carousel")
    ->setTitle("Show slider at the top of the store's page")
    ->setDescription("If this option is enabled, the product page at the top of the page will show the slider of your shares or offers. You can customize its content in the Compound Sliders tab, you can customize its appearance in this tab. ")
    ->setNamespace('woocommerce_shop')
);
