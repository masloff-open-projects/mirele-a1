<?php

/**
 * Register shortcode for render page in main
 * or other page.
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package" Mirele
 */

add_shortcode('rosemary', function ($attr) {
    rosemary_page($attr['page']);
});

add_shortcode('rosemary_template', function ($attr) {

    global $post;
    global $self_page;
    global $self_block;
    global $rosemary_elements;

    $self_page = $post->ID;
    $self_block = $attr['template'];

    rosemary_template($attr['template'], null);

});