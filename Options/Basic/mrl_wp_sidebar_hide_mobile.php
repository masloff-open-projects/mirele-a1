<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(true)
    ->setName("mrl_wp_sidebar_hide_mobile")
    ->setTitle("Hide Sidebar on mobile device")
    ->setDescription("On all devices, whose screen is already 576px sidebars will be completely hidden")
    ->setNamespace('@basic')
);
