<?php

/**
 * Rosemary Template: Colorful Product Insert Left;
 * Version: 1.0.0;
 * Author: Mirele;
 */

rosemary_register('colorful_product_insert_left', function ($event=null) {

$button = rosemary_register_element('button', [
    'type' => 'text',
    'value' => 'More details'
], [
    'url' => '#'
]);

$options_button = rosemary_get_options(); 

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

<section class="theme">

    <div class="separator-big"></div>

    <div class="container">

        <div class="row">
            
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-center">
                <img async_src="<?php echo wp_get_attachment_url($image); ?>" class="image-product-present-left" <?php echo $options_image->dynamic_shadow == 'yes' ? 'dynamic-shadow="dynamic-shadow"' : '' ?> dynamic-shadow-type="<?php echo $options_image->dynamic_shadow_type ?>" dynamic-shadow-timeout="<?php echo $options_image->dynamic_shadow_timeout ?>">
                
                <div class="separator-middle"></div>

            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <h1 class="color-dark text-bold margin-none"> <?php echo rosemary_register_element("title", [
                    'value' => 'Excellent product worth buying',
                    'type' => 'text'
                ]); ?> </h1>

                <div class="separator-middle"></div>

                <ul class="ul-mark-padding-bottom" possible-classes="ul-without-mark">

                    <?php for ($i=1; $i < 12; $i++): ?>

                        <?php $item = rosemary_register_element("item_$i", [
                            'value' => mb_strimwidth(Lorem::ipsum(1), 0, ROSEMARY_VARCHAR_SIZE_DB / 8, '&hellip;'),
                            'type' => 'text'
                        ]);

                        $options = rosemary_get_options();  ?>

                        <?php if ( rosemary_get_visible(rosemary_get_full_id("item_$i")) ): ?>
                        <li class="text-thin color-dark-light text-dynamic-size-small"> <?php echo $item; ?> </li>
                        <?php endif; ?>

                    <?php endfor; ?>
                    
                </ul>

                <?php if ( rosemary_get_visible(rosemary_get_full_id("button")) ): ?>
                    <a href=" <?php echo $options_button->url ?> "><p><?php echo $button; ?></p></a>
                <?php endif; ?>
                

            </div>
            
        </div>

    </div>

    <div class="separator-big"></div>

</section>

<?php }, array(
    'title' => 'Colorful Product Insert Left',
    'description' => 'A beautiful header with effects, but not as loaded as the regular version of the header.',
    'author' => 'Mirele Package Colorful'
)); ?>