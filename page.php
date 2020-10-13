<?php

\Mirele\TWIG::Render('Main/page', [
    'ww2as' => get_option('mrl_wp_sidebar_width_2_active', 2),
    'ww1as' => get_option('mrl_wp_sidebar_width_1_active', 4),
    'ars' => is_active_sidebar('right-side-page', 'false') == 'true' ? true : false,
    'als' => is_active_sidebar('left-side-page', 'false') == 'true' ? true : false,
    'hsmp' => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
    'rsbn' => 'right-side-page',
    'lsbn' => 'left-page'
]);