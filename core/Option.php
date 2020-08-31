<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

# Sidebar settings.
# Side bar width settings for 1 active bar
Customizer::add( (new Option)
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
    ->setNamespace('basic')
);

# Sidebar settings.
# Side bar width settings for 2 active bar
Customizer::add( (new Option)
    ->setType("integer")
    ->setDefault(3)
    ->setName("mrl_wp_sidebar_width_2_active")
    ->setTitle("Sidebar width at 2 active sidebar")
    ->setDescription("Specify the width of the sidebar when all 2 sidebar is active on the page. Page grid consists of 12 columns")
    ->setProps([
        'step' => 1,
        'min' => 1,
        'max' => 4
    ])
    ->setNamespace('basic')
);

# Sidebar settings.
# Hide Sidebar on mobile device
Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(true)
    ->setName("mrl_wp_sidebar_hide_mobile")
    ->setTitle("Hide Sidebar on mobile device ")
    ->setDescription("On all devices, whose screen is already 576px sidebars will be completely hidden ")
    ->setNamespace('basic')
);

//Customizer::add( (new Option)
//    ->setType("integer")
//    ->setDefault(true)
//    ->setName("636")
//    ->setProps([
//        'step' => 5,
//        'min' => 10,
//        'max' => 123
//    ])
//    ->setWarning([
//        'type' => 'warning',
//        'title' => 'Hello',
//        'description' => ''
//    ])
//    ->setNamespace('basic')
//);
