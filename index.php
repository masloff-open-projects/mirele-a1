<?php

/**
 *
 * @package WordPress
 * @subpackage Mirele
 * @version 1.0.0
 */

\Mirele\TWIG::Render('Compound/Engine/Applications/Public/index.html.twig', [
    'ww2as'       => get_option('mrl_wp_sidebar_width_2_active', 2),
    'ww1as'       => get_option('mrl_wp_sidebar_width_1_active', 4),
    'ars'         => is_active_sidebar('right-main', 'false') == 'true' ? true : false,
    'als'         => is_active_sidebar('left-main', 'false') == 'true' ? true : false,
    'hsmp'        => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
    'rsbn'        => 'right-main',
    'lsbn'        => 'left-main'
]);