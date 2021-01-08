<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add((new Option)
    ->setType("select")
    ->setDefault(true)
    ->setName("mrl_wp_navbar_type")
    ->setTitle("Hide Sidebar on mobile device")
    ->setDescription("On all devices, whose screen is already 576px sidebars will be completely hidden")
    ->setNamespace('@basic')
    ->setData([
        [
            'text' => 'Darkness',
            'value' => 'darkness-08'
        ]
    ])
);
