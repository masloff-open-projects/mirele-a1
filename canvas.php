<?php

/**
* Template Name: Mirele Canvas
*
* @package: WordPress
* @subpackage: Mirele
* @since: Mirele Canvas 1
*/

get_header();

initialize_templates(true) or die('Mirele Blocks were not connected. Bootloader problem');

$mrouter->execute('any');
$mrouter->execute('mirele_canvas_header');

while ( have_posts() ) :
    the_post();
    the_content();
endwhile;

get_footer();
