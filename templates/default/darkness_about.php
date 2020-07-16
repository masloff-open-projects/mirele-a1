<?php

/**
 * Rosemary Template: About;
 */

rosemary_register('darkness_about', function ($event=null) {

    $title = rosemary_register_element('title', [
        'value' => 'A bit about this product',
        'type' => 'text']);
    $video = rosemary_register_element('video', [
        'value' => '',
        'type' => 'src'
    ], [
        'dynamic_shadow' => 'no',
        'dynamic_shadow_type' => 'shadow-and-border',
        'dynamic_shadow_timeout' => 1000
    ]);

    $video = rosemary_get_single_image($video);

    $options_video = rosemary_get_options(); 

    ?>

    <section class="theme theme-dark">

        <div class="container">
    
            <h1 class="text-center text-title text-shadow"> <?php echo $title; ?>  </h1>
    
            <div class="row">
    
                <div class="<?php echo rosemary_get_visible(rosemary_get_full_id("video")) ? 'col-xs-12 col-sm-6 col-md-6 col-lg-6 limit-right-small' : 'col-xs-12 col-sm-7 col-md-7 col-lg-12'; ?>" box_id='content'>
                    <h2> <?php echo rosemary_register_element('subtitle', [
                            'value' => 'Quisque leo odio, tristique vel fringilla vel',
                            'type' => 'text'
                        ]); ?> </h2>
                    <p> <?php echo rosemary_register_element('description', [
                            'value' => Lorem::ipsum(1),
                            'type' => 'text'
                        ]); ?>  </p>
    
                    <div class="separator-small"></div>
    
                    <?php for ($i=1; $i < 7; $i++): ?>

                        <?php $item = rosemary_register_element("item_$i", [
                            'value' => Lorem::ipsum(1),
                            'type' => 'text'
                        ], [
                            'icon' => 'fas fa-question',
                            'title' => "Item $i"
                        ]);
                        
                        $options = rosemary_get_options();  ?>

                        <?php if ( rosemary_get_visible(rosemary_get_full_id("item_$i")) ): ?>
                        <div class="media">
                            <span
                                class="<?php echo $options->icon; ?> icon-dark icon-offset pull-left"
                                aria-hidden="true"></span>
        
                            <div class="media-body">
                                <h4 class="text-inside text-header"> <?php echo $options->title; ?> </h4>
                                    <small> <?php echo $item; ?> </small>
                            </div>
                        </div>
                        <?php endif; ?>

                    <?php endfor; ?>
    
                    <div class="visible-sm separator-middle"></div>
    
                </div>

                <?php if ( rosemary_get_visible(rosemary_get_full_id('video')) ): ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 block-top-sticky" >
                        <div class="visible-xs separator-middle"></div>
                        <video async_video="<?php echo wp_get_attachment_url($video); ?>" contextmenu="" class="video-player" width="100%" controls loop playsinline type="video/mp4" <?php echo $options_video->dynamic_shadow == 'yes' ? 'dynamic-shadow="dynamic-shadow"' : '' ?> dynamic-shadow-type="<?php echo $options_video->dynamic_shadow_type ?>" dynamic-shadow-timeout="<?php echo $options_video->dynamic_shadow_timeout ?>" ></video>
                    </div>
                <?php endif; ?>
    
            </div>
            
        </div>
    
        <div class="separator-big"></div>
    
    </section>

    <?php
}, array(
    'title' => 'Darkness about product section',
    'description' => 'The section contains a title and two blocks: several advantages and a video about your product. The video can be turned off.',
    'author' => 'Mirele Package Darkness'
));
