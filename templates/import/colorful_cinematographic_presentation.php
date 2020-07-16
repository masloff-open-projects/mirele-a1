<?php

/**
 * Rosemary Template: Colorful Cinematographic presentation;
 */

rosemary_register('colorful_cinematographic_presentation', function ($event=null) {
$count = 0; 
?>

<section class="theme-cinematographic-presentation" animation_id="cinematographic_presentation">

    <div class="container">

        <h1 class="text-center text-title">
        <?php echo rosemary_register_element("title", [
            'value' => "Here are some of our products.",
            'type' => 'text'
        ]); ?> </h1>

        <div class="cinematographic-items-block">

            <?php for ($i=1; $i < 21; $i++): ?>
                
                <?php $image = rosemary_register_element("image_$i", [
                    'value' => '',
                    'type' => 'src'
                ]);
                
                $image = explode('|', $image);

                foreach ($image as $src) {
                    if (!empty($src)) {
                        $image = $src;
                        break;
                    }
                }

                $options = rosemary_get_options(); ?>

                <?php if ( rosemary_get_visible(rosemary_get_full_id("image_$i")) ): $count++; ?>
                    
                    <img async_src="<?php echo wp_get_attachment_url($image); ?>" alt="" srcset="" class="cinematographic_presentation_element">

                <?php endif; ?>
                
            
            <?php endfor; ?>

        </div>

        <?php if ($count > 5): ?>
            <p class="color-white text-center text-title cinematographic_presentation_placeholder" style="opacity: 0"> Scroll down, up, right, or left to see all the items. </p>
        <?php endif; ?>

        <div class="row">

        </div>
    </div>
    
</section>

<?php }, array(
    'title' => 'Colorful Cinematographic presentation',
    'description' => 'Does your product deserve an honorable stand to show all its coolness? Yes, this block can help you realize the most daring undertaking.',
    'author' => 'Mirele Package Colorful'
)); ?>