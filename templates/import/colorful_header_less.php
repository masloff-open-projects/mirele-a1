<?php

/**
 * Rosemary Template: Colorful Header Less;
 */

rosemary_register('colorful_header_less', function ($event=null) {

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

<section class="theme theme-header-less">
    
    <div class="container">

        <div class="row padding-offer">
        
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 limit-right-small">
                
                <h1 class="text-thin"> <?php echo rosemary_register_element("title", [
                        'value' => 'Excellent product worth buying',
                        'type' => 'text'
                    ]); ?> </h1>

                <p> <?php echo rosemary_register_element("description", [
                        'value' => Lorem::ipsum(3),
                        'type' => 'text'
                    ]); ?> </p>

            </div>

            
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <img async_src="<?php echo wp_get_attachment_url($image); ?>" srcset="" class="picture-offer" <?php echo $options_image->dynamic_shadow == 'yes' ? 'dynamic-shadow="dynamic-shadow"' : '' ?> dynamic-shadow-type="<?php echo $options_image->dynamic_shadow_type ?>" dynamic-shadow-timeout="<?php echo $options_image->dynamic_shadow_timeout ?>">
            </div>
            

        </div>


    </div>

    <div class="separator-big"></div>

</section>

<?php }, array(
    'title' => 'Colorful Header Less',
    'description' => 'A beautiful header with effects, but not as loaded as the regular version of the header.',
    'author' => 'Mirele Package Colorful'
)); ?>