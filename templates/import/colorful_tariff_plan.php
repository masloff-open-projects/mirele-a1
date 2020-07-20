<?php

/**
 * Rosemary Template: Colorful Tariffs;
 */

rosemary_register('colorful_tariffs', function ($event=null) {
?>

<section class="theme theme-tariff">
    <div class="container">

        <h1 class="text-center text-title text-shadow color-dark">
            <?php echo $e['58AE749F25EDED36F486BC85FEB3F0AB']->element_data_text; ?> </h1>

        <div class="row">

            <?php for ($i=1; $i < 4; $i++): ?>

                <?php $tariffs = rosemary_register_element("tariff_$i", [
                    'value' => "Privilege 1|Privilege 2|Privilege 3|Privilege 4|Privilege 5",
                    'type' => 'list'
                ], [
                    'title' => 'Privilege level',
                    'price' => '100$',
                    'button' => 'Choose a tariff plan',
                    'url' => ''
                ]);

                $options = rosemary_get_options();  ?>

                    <?php if ( rosemary_get_visible(rosemary_get_full_id("tariff_$i")) ): ?>
                        
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 margin-x-md">
                            <div class="card-tariff text-center">
                                <h4 class="color-space-light text-uppercase padding-md text-bold"> <?php echo $options->title; ?> </h4>
                                <div class="banner">
                                    <?php echo $options->price; ?>
                                </div>

                                <div class="caption">
                                    <ol class="text-left">
                                        <?php 
                                        
                                        foreach (explode('|', $tariffs) as $item) {
                                            ?> <li> <?php echo $item; ?> </li> <?php
                                        }

                                        ?>
                                    </ol>

                                </div>

                                <button class="button-buy" <?php echo $options->url; ?> onclick='location.href="<?php echo $options->url; ?>"'> <?php echo $options->button; ?> </button>

                            </div>
                        </div>

                    <?php endif; ?>

            <?php endfor; ?>

        </div>

        <div class="separator-big"></div>

    </div>
</section>

<?php }, array(
    'title' => 'Colorful Tariff Plans',
    'description' => 'You can place the tariff plans of your business in this block. Maximum tariff plans - 3',
    'author' => 'Mirele Package Colorful'
)); ?>