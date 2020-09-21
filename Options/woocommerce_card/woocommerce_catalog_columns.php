<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add( (new Option)
    ->setType("int")
    ->setDefault(get_option( 'woocommerce_catalog_columns', 4 ))
    ->setName("woocommerce_catalog_columns")
    ->setTitle("Product Card Column Width")
    ->setDescription("The page is divided into 12 columns. Specify the number of columns, which will occupy one product card.")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 12
    ])
    ->setNamespace('woocommerce_card')
);

