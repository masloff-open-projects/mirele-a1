<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add( (new Option)
    ->setType("int")
    ->setDefault(get_option( 'woocommerce_catalog_rows', 8 ))
    ->setName("woocommerce_catalog_rows")
    ->setTitle("Number of lines with product blocks on one page")
    ->setDescription("Specify the number of lines with product blocks, which will be displayed on one page of the product catalog.")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 12
    ])
    ->setNamespace('woocommerce_card')
);