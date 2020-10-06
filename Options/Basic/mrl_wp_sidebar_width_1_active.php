<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add((new Option)
    ->setType("integer")
    ->setDefault(3)
    ->setName("mrl_wp_sidebar_width_1_active")
    ->setTitle("Sidebar width at 1 active sidebar")
    ->setDescription("Specify the width of the sidebar when only 1 sidebar is active on the page. Page grid consists of 12 columns")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 4
    ])
    ->setNamespace('@basic')
);
