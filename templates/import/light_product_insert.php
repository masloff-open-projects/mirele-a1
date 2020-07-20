<?php

/**
 * Rosemary Template: Light Product insert block;
 */

rosemary_register('light_product_insert', function ($event=null) {
?>

<section>

    <div class="container">
        
        <div class="separator-big"></div>

        <div class="row product-light-insert product-insert-background">
    
            <div class="col-xs-9 col-sm-6 col-md-6 col-lg-6 padding-offer-left-block padding-left-none">
                
                <h3 class="color-black-light text-300 margin-none"> <?php echo rosemary_register_element("title", [
                        'value' => 'Block header',
                        'type' => 'text'
                    ]); ?> </h3>
                    
                <p class="color-black-light text-300 margin-top-md"> <?php echo rosemary_register_element("description", [
                        'value' => Lorem::ipsum(1),
                        'type' => 'text'
                    ]); ?> </p>

            </div>
    
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                
            </div>
        

        </div>

        <div class="separator-big"></div>

    </div>

</section>

<?php }, array(
    'title' => 'Light Product insert',
    'description' => '...',
    'author' => 'Mirele Package Light'
)); ?>