<?php

/**
 * Rosemary Template: Colorful Product Presentation;
 */

rosemary_register('colorful_app_presentation', function ($event=null) {
?>

<section class="theme-blur">
    <div class="container">
        <div class="row padding-offer">

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-xs-center text-sm-right text-md-right text-lg-right">


                <?php for ($i=1; $i < 5; $i++): ?>

                    <?php $item = rosemary_register_element("item_$i", [
                        'value' => Lorem::ipsum(1),
                        'type' => 'text'
                    ], [
                        'title' => "Item $i"
                    ]);

                    $options = rosemary_get_options();  ?>

                        <?php if ( rosemary_get_visible(rosemary_get_full_id("item_$i")) ): ?>
                        <div class="media media-block">
                            <div class="media-body">
                                <h4 class="text-inside text-header color-dark"> <?php echo $options->title; ?> </h3>
                                    <small> <?php echo $item; ?> </small>
                            </div>
                        </div>
        
                        <div class="separator-vw8"></div>
                        <?php endif; ?>

                <?php endfor; ?>


            </div>


            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center offer-block">

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
            
                <img src="<?php echo wp_get_attachment_url($image); ?>?>" alt="" srcset="" class="picture-offer-center filter-shadow-gray">
            </div>


            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-xs-center text-sm-left text-md-left text-lg-left">

                <?php for ($i=5; $i < 9; $i++): ?>

                <?php $item = rosemary_register_element("item_$i", [
                    'value' => Lorem::ipsum(1),
                    'type' => 'text'
                ], [
                    'title' => "Item $i"
                ]);

                $options = rosemary_get_options();  ?>

                    <?php if ( rosemary_get_visible(rosemary_get_full_id("item_$i")) ): ?>
                    <div class="media media-block">
                        <div class="media-body">
                            <h4 class="text-inside text-header color-dark"> <?php echo $options->title; ?> </h3>
                                <small> <?php echo $item; ?> </small>
                        </div>
                    </div>

                    <div class="separator-vw8"></div>
                    <?php endif; ?>

                <?php endfor; ?>

            </div>

        </div>
    </div>
</section>

<?php }, array(
    'title' => 'Colorful Mobile App',
    'description' => 'Does your store have a mobile app? Or maybe your product is this application itself? This block can present any product that can be placed in the center of the screen. The unit is largely focused on the image of the smartphone in the center',
    'author' => 'Mirele Package Colorful'
)); ?>