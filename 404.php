<?php

/**
 *
 * @package WordPress
 * @subpackage Mirele
 * @version 1.0.0
 */


if (rosemary_page_exists('404')) {
    initialize_templates(true);
    rosemary_page('404');
} else {
    \Mirele\TWIG::Render('Main/404', []);
}