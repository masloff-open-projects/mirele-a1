<?php

/**
 *
 * @package WordPress
 * @subpackage Mirele
 * @version 1.0.0
 */

\Mirele\TWIG::Render('mirele/single', [
    'ww2as'       => get_option('mrl_wp_sidebar_width_2_active', 2),
    'ww1as'       => get_option('mrl_wp_sidebar_width_1_active', 4),
    'ars'         => is_active_sidebar('right-side-single', 'false') == 'true' ? true : false,
    'als'         => is_active_sidebar('left-side-single', 'false') == 'true' ? true : false,
    'hsmp'        => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
    'rsbn'        => 'right-side-single',
    'lsbn'        => 'left-side-single'
]);