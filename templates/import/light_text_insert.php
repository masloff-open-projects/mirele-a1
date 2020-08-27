<?php

/**
 * Rosemary Template: Text insertion;
 */

rosemary_register('light_text_insertion', function ($event=null) {
?>

<section class="theme-text-insert">

    <div class="container">

        <h1 class='text-center text-thin'> <?php echo rosemary_register_element('title', [
            'value' => 'Get ready for an adventure',
            'type' => 'text'
        ]); ?> </h1>

    </div>

</section>

<?php }, array(
    'title' => 'Light Text insertion',
    'description' => 'A small block with parallax effect on the background image and text in the foreground',
    'author' => 'Mirele Package Light'
)); ?>