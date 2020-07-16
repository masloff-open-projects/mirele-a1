<?php

/**
 * Rosemary Template: Benefits Classic;
 */

rosemary_register('benefits_classic', function ($event=null) {
?>

<section class="theme-classic-benefits">
    
    <div class="separator-middle"></div>

    <div class="container">

        <h1 class="text-center color-dark"> 
            <?php echo rosemary_register_element("title", [
                'value' => 'Benefits of working with us',
                'type' => 'text'
            ]); ?> </h1>

        <div class="row">

            
            <?php for ($i=1; $i < 5; $i++): ?>

                <?php $card = rosemary_register_element("card_$i", [
                    'value' => substr(Lorem::ipsum(1), 0, 128),
                    'type' => 'text'
                ], [
                    'icon' => 'fas fa-question',
                    'title' => "Cart No.$i"
                ]);

                $options = rosemary_get_options();  ?>

                <?php if ( rosemary_get_visible(rosemary_get_full_id("card_$i")) ): ?>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="card text-center">
                            
                            <i class="<?php echo $options->icon; ?> icon-card color-dark-light"></i>

                            <h3 class="color-dark-light"> <?php echo $options->title; ?> </h3>
                            <p> <?php echo $card; ?> </p>

                        </div>  
                    </div>
                <?php endif; ?>

            <?php endfor; ?>
            
        </div>
    
    </div>

    <div class="separator-big"></div>

</section>

<?php }, array(
    'title' => 'Benefits Classic',
    'description' => 'The classic block of benefits for your business',
    'author' => 'Mirele Package Classic'
)); ?>