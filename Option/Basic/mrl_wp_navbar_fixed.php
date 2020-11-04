<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

# Fix the navbar at the top of the page when scrolling
Customizer::add((new Option)
    ->setType("switch")
    ->setDefault(false)
    ->setName("mrl_wp_navbar_fixed")
    ->setTitle("Fix the navbar at the top of the page when scrolling")
    ->setDescription("If you enable this option, then when scrolling a page, navbar will always be at the top of the screen and will follow the user. If you turn this option off, napbar will always be at the top of the page and will not follow the user when scrolling a page.")
    ->setProps([])
    ->setNamespace('@basic')
);