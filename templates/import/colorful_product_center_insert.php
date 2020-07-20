<?php

/**
 * Rosemary Template: Colorful Product Insert Center;
 */

rosemary_register('colorful_product_insert_center', function ($event=null) {

$image = rosemary_register_element('image', [
    'type' => 'src',
    'value' => ''
], [
    'dynamic_shadow' => 'yes',
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

<section class="theme" animation_id='colorful_product_center_insert'>

    <div class="separator-big"></div>
    
        <div class="container">

            <h1 class="text-center color-dark"> <?php echo rosemary_register_element("title", [
                        'value' => 'Product title',
                        'type' => 'text'
                    ]); ?> </h1>

            <p class="color-dark text-center margin-none"> <?php echo rosemary_register_element("description", [
                        'value' => mb_strimwidth(Lorem::ipsum(3), 0, ROSEMARY_VARCHAR_SIZE_DB / 4, '&hellip;'),
                        'type' => 'text'
                    ]); ?> </p>
            
            <div class="separator-big"></div>
            
            <img async_src="<?php echo wp_get_attachment_url($image); ?>" alt="" class='product-center-insert' <?php echo $options_image->dynamic_shadow == 'yes' ? 'dynamic-shadow="dynamic-shadow"' : '' ?> dynamic-shadow-type="<?php echo $options_image->dynamic_shadow_type ?>" dynamic-shadow-timeout="<?php echo $options_image->dynamic_shadow_timeout ?>">

        </div>

    <div class="separator-big"></div>

</section>

<?php }, array(
    'title' => 'Colorful Product Insert Center',
    'description' => 'Locate your product in the  center of the page and provide a link to the product so that people can buy it in one click',
    'author' => 'Mirele Package Colorful'
)); ?>