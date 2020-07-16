<?php

/**
 * Rosemary Template: Blank;
 */
 
 
rosemary_register('blank', function() {

    ?>

    <section class="theme theme-white">
        <div class="container">

            <?php echo rosemary_register_element('content'); ?>

        </div>
    </section>

    <?php
}, array(
    'title' => 'Blank',
    'description' => 'Absolutely blank page. On it you can call out an arbitrary shortcode, write text (it will not be formatted). Page has no title',
    'author' => 'Mirele Package'
));
