<?php

/**
 * Rosemary Template: Light Card;
 */

rosemary_register('light_card', function ($event=null) {
?>

<section>

    <div class="container">
        
        <div class="separator-big"></div>

        <div class="row">

        <?php for ($i=1; $i < 4; $i++): ?>

            <?php $card = rosemary_register_element("card_$i", [
                'value' => mb_strimwidth(Lorem::ipsum(1), 0, ROSEMARY_VARCHAR_SIZE_DB / 4, '&hellip;'),
                'type' => 'text'
            ], [
                "title" => "Great card",
                "link_title" => "Open",
                "link" => "#",
                "img" => ""
            ]);

            $options = rosemary_get_options();  ?>

                <?php if ( rosemary_get_visible(rosemary_get_full_id("card_$i")) ): ?>
            
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 light-card">
                        <img async_src="<?php echo rosemary_get_single_image($options->img); ?>" alt="">
                        <h3 class="color-black-light text-300"> <?php echo $options->title; ?> </h3>
                        <p class="color-black-light text-300"> <?php echo $card; ?> </p>
                        <a href="<?php echo $options->link; ?>"> <?php echo $options->link_title; ?>  <i class="fas fa-chevron-right svg-icon-small"></i> </a>
                    </div>

                <?php endif; ?>

        <?php endfor; ?>
            
        </div>

        <div class="separator-big"></div>

    </div>

</section>

<?php }, array(
    'title' => 'Light Cards',
    'description' => '...',
    'author' => 'Mirele Package Light'
)); ?>