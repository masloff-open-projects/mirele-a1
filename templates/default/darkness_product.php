<?php

/**
 * Rosemary Template: Colorful Gallery;
 */

rosemary_register('colorful_product', function ($event=null) {
    ?>

    <section class="theme theme-dark">

        <div class="container">
            
            <h1 class="text-center text-inside text-shadow text-subtitle">
                <?php echo rosemary_register_element("subtitle", [
                    'value' => 'In our gallery',
                    'type' => 'text'
                ]); ?> </h1>

            <div class="separator-big"></div>

            <div class="row">

                <img data-src="<?php echo MIRELE_SOURCE_DIR . '/img/default/dark-product.jpg' ; ?>" data-loading="lazy">

            </div>

        </div>

        <div class="separator-middle"></div>

    </section>

<?php }, array(
    'title' => 'Colorful Dark Product',
    'description' => 'Photo gallery that immerses the user in viewing photos! Attention, you will need the plugin to use the gallery. If you bought a template, it should be delivered in the archive with the theme',
    'author' => 'Mirele Package Colorful'
)); ?>