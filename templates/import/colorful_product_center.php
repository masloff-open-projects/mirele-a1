<?php

/**
 * Rosemary Template: Colorful Center Product Bottom;
 */

rosemary_register('colorful_product_center_bottom', function ($event=null) {

$image = rosemary_register_element('image', [
    'type' => 'src',
    'value' => ''
], [
    'dynamic_shadow' => 'no',
    'dynamic_shadow_type' => 'filter',
    'dynamic_shadow_timeout' => 0
]);

$options_image = rosemary_get_options(); 
$image = explode('|', $image);

foreach ($image as $src) {
    if (!empty($src)) {
        $image = $src;
        break;
    }
}

?>

<section class="theme-header-center" animation_id="center_product_screen_image_bottom">
    
    <div class="container">

        <h1 class="text-bold color-dark-light text-center colorful-text-h1"> <?php echo rosemary_register_element("title", [
                'value' => 'Excellent product worth buying',
                'type' => 'text'
            ]); ?> </h1>

        <br>

        <img src="<?php echo wp_get_attachment_url($image); ?>" lightboximage <?php echo $options_image->dynamic_shadow == 'yes' ? 'dynamic-shadow="dynamic-shadow"' : '' ?> dynamic-shadow-type="<?php echo $options_image->dynamic_shadow_type ?>" dynamic-shadow-timeout="<?php echo $options_image->dynamic_shadow_timeout ?>">
    
    </div>


</section>

<?php }, array(
    'title' => 'Colorful Center Product Bottom',
    'description' => 'Lacanic and white block, allowing you to place a colorful header and product',
    'author' => 'Mirele Package Colorful'
)); ?>