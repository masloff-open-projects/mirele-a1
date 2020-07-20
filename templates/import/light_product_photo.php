<?php

/**
 * Rosemary Template: Light Photo block with text;
 */

rosemary_register('light_photo_block_with_text', function ($event=null) {
?>

<section>
    <div class="container">
        
        <div class="separator-big"></div>

        <div class="row">
        
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 limit-right-middle">
                <h3 class="color-dark text-thin"> <?php echo rosemary_register_element("title", [
                        'value' => 'Block header',
                        'type' => 'text'
                    ]); ?> </h3>

                <p class="text-thin">  <?php echo rosemary_register_element("description", [
                        'value' => Lorem::ipsum(1),
                        'type' => 'text'
                    ]); ?>  </p>

                <div class="separator-middle"></div>

            </div>

            
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <?php
                $image = rosemary_register_element('image', [
                    'type' => 'src',
                    'value' => ''
                ]);

                $image = explode('|', $image);

                foreach ($image as $src) {
                    if (!empty($src)) {
                        $image = $src;
                        break;
                    }
                }
                ?>
            
                <img async_src="<?php echo wp_get_attachment_url($image); ?>" alt="" >

            </div>
            
        </div>

        <div class="separator-big"></div>

    </div>
</section>

<?php }, array(
    'title' => 'Light Photo block with text',
    'description' => 'Block with text (title and description) on the left and a picture on the right',
    'author' => 'Mirele Package Light'
)); ?>