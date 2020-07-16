<?php

/**
 * Rosemary Template: Colorful Header;
 * Type: Template;
 * Author: Mirele;
 * Version: 1.0.0;
 */

rosemary_register('colorful_header', function ($event=null) {

    $options_ = (object) rosemary_register_block_options(array(
        'image' => ''
    ));

    $header_image_attr = (isset($options_->image) and !empty($options_->image)) ? $options_->image : (get_header_image() ? get_header_image() : '');

    $button = rosemary_register_element("button", [
        'value' => 'Go to shop',
        'type' => 'button'
    ], [
        'url' => get_permalink(wc_get_page_id( 'shop' ))
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

    ?>

    <section class="theme theme-glass site-header" data-src="<?php echo $header_image_attr ?>" data-loading="lazy">

        <div class="container">

            <div class="row padding-offer">

                <div class="<?php echo rosemary_get_visible(rosemary_get_full_id("image")) ? 'col-xs-12 col-sm-6 col-md-6 col-lg-6' : 'col-xs-12 col-sm-7 col-md-7 col-lg-7'; ?> limit-right-middle">

                    <h1 class="text-uppercase"> <?php echo rosemary_register_element('title', [
                            'value' => 'Lorem ipsum dolor set amen!',
                            'type' => 'text']); ?> </h1>
                    <p> <?php echo rosemary_register_element('description', [
                            'type' => 'text',
                            'value' => Lorem::ipsum(2) ]);; ?> </p>

                    <div class="row">

                    <?php for ($i=1; $i < 4; $i++): ?>

                        <?php $advantage = rosemary_register_element("advantage_$i", [
                            'value' => 10,
                            'type' => 'text'
                        ], [
                            'title' => "Advantage title"
                        ]);

                        $options = rosemary_get_options();  ?>

                        <?php if ( rosemary_get_visible(rosemary_get_full_id("advantage_$i")) ): ?>
                            <div class="col-xs-<?php echo $i != 3 ? 6 : 12; ?> col-sm-4 col-md-4 col-lg-4 text-center">
                                <h1 class="text-light text-dynamic-size-middle"> <?php echo $advantage; ?> </h1>
                                <p> <?php echo $options->title; ?> </p>
                            </div>
                        <?php endif; ?>

                    <?php endfor; ?>

                    </div>

                    <?php if ( rosemary_get_visible(rosemary_get_full_id("button")) ): ?>

                        <hr box_id='header_hr'>

                        <div style="width: 100%" class="text-center">
                            <a href="<?php echo $options_button->url; ?>">
                                <button class="button-glass"> <?php echo $button; ?> </button>
                            </a>
                        </div>

                    <?php endif; ?>


                </div>

                <?php if (rosemary_get_visible(rosemary_get_full_id("image"))): ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <img src="<?php echo rosemary_get_single_image($image); ?>" alt="" srcset="" class="picture-offer" <?php echo $options_image->dynamic_shadow == 'yes' ? 'data-dynamic-shadow="dynamic-shadow"' : '' ?> data-dynamic-shadow-type="<?php echo $options_image->dynamic_shadow_type ?>" data-dynamic-shadow-timeout="<?php echo $options_image->dynamic_shadow_timeout ?>">
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php }, array(
    'title' => 'Colorful Header',
    'description' => 'Beautiful and laconic header for your site. It is perfect for product presentation, counter page for users, etc. You can remove the product picture, in which case the heading becomes universal',
    'author' => 'Mirele Package Colorful'
));
