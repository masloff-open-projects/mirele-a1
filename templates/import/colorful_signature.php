<?php

/**
 * Rosemary Template: Colorful Signature;
 */

rosemary_register('colorful_signature_insert', function ($event=null) {

?>

<section class="theme signature">

    <div class="separator-middle"></div>

    <h2 class="text-center color-dark"> <?php echo rosemary_register_element('text', [
            'value' => 'Lorem ipsum dolor set amen.',
            'type' => 'text'
        ]); ?> </h2>

    <div class="separator-middle"></div>

</section>

<?php }, array(
    'title' => 'Colorful Signature (insert)',
    'description' => 'A small signature, created to place a slogan up to 5 words in length (no limit on the number of words)',
    'author' => 'Mirele Package Colorful'
)); ?>