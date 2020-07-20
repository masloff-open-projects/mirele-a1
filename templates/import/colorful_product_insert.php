<?php

/**
 * Rosemary Template: Product insert;
 */

rosemary_register('colorful_product_insert', function ($event=null) {
?>

<?php $image = rosemary_register_element("image", [
    'value' => '',
    'type' => 'src'
], [
    'big_image' => "",
    'middle_image' => "",
    'position' => 'right'
]);

$options = rosemary_get_options();

$image = explode('|', $image);

if (isset($image[1]) && isset($image[2])) {
    $big = $image[1];
    $middle = $image[2];
} 

if (!empty($options->big_image) && !empty($options->middle_image)) {
    $big = $options->big_image;
    $middle = $options->middle_image;
}


?>

<section class="theme-section-promotion" theme="product" image="<?php echo wp_get_attachment_url($big); ?>"
    image-small="<?php echo wp_get_attachment_url($middle); ?>" image-position="<?php echo $options->position; ?>">
    <div class="container">
        <div class="row padding-block">

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-6">

                <h2 class="text-inside padding-block-title color-dark-light">
                    <?php echo rosemary_register_element("title", [
                        'value' => 'Just great product',
                        'type' => 'text'
                    ]); ?> </h2>
                <p class="color-space-light color-space-dark">
                    <?php echo rosemary_register_element("description", [
                        'value' => Lorem::ipsum(1),
                        'type' => 'text'
                    ]); ?> </p>

                <div class="separator-small"></div>

                <?php $types = ['ignore', 'accept', 'dismiss', 'info']; ?>
                <?php for ($i=1; $i < 4; $i++): ?>

                <?php $button = rosemary_register_element("button-$i", [
                    'value' => 'Button',
                    'type' => 'text'
                ], [
                    'url' => ""
                ]);

                $options = rosemary_get_options();  ?>

                    <?php if ( rosemary_get_visible(rosemary_get_full_id("button-$i")) ): ?>
                        <button class="button button-<?php echo $types[$i] ?>" onclick='location.href="<?php echo $options->url; ?>"'> <?php echo $button; ?> </button>
                    <?php endif; ?>

                <?php endfor; ?>

            </div>

        </div>
    </div>
</section>

<?php }, array(
    'title' => 'Colorful Product Insert',
    'description' => 'Hint has become easier! This block will help you to hint at the purchase of goods, showing its main quality.',
    'author' => 'Mirele Package Colorful'
)); ?>