<?php

/**
 * Rosemary Template: Colorful Gallery;
 */

rosemary_register('colorful_gallery', function ($event=null) {
?>

<section class="theme theme-gallery">

    <div class="container">

        <h2 class="text-center text-subtitle text-shadow color-space-light">
                    <?php echo rosemary_register_element("title", [
                        'value' => 'You can look at the product.',
                        'type' => 'text'
                    ]); ?>  </h2>
        <h1 class="text-center text-inside text-shadow">
                    <?php echo rosemary_register_element("subtitle", [
                        'value' => 'In our gallery',
                        'type' => 'text'
                    ]); ?> </h1>

        <div class="separator-big"></div>

        <div class="row container-gallery text-center">
            <?php if (is_array(get_option('kristen_gallery_grid', array())) or is_object(get_option('kristen_gallery_grid', array()))): ?>
                <?php foreach (get_option('kristen_gallery_grid', array()) as $grid): ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <?php foreach ($grid as $img): ?>
                            <img data-src="<?php echo $img; ?>" alt="<?php echo $img; ?>" class="gallery-picture" data-loading="lazy" onclick="karlin('body').lightboximage('<?php echo $img; ?>')">
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

    <div class="separator-middle"></div>

</section>

<?php }, array(
    'title' => 'Colorful Photo gallery',
    'description' => 'Photo gallery that immerses the user in viewing photos! Attention, you will need the plugin to use the gallery. If you bought a template, it should be delivered in the archive with the theme',
    'author' => 'Mirele Package Colorful'
)); ?>