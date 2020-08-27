<?php

/**
 * Rosemary Template: Colorful Shop;
 */

rosemary_register('colorful_shop', function ($event=null) {

    $title = rosemary_register_element('title', [
        'value' => 'Shop section',
        'type' => 'text'
    ]);

    $shop = rosemary_register_element('shop', [
        'value' => 'Please, edit options',
        'type' => 'woocommerce_shop'
    ], [
        'limit_products' => '5',
        'columns' => '5',
        'orderby' => 'popularity',
        'class' => 'quick-sale',
        'on_sale' => 'true'
    ]);
    
    $options = rosemary_get_options(); 

    ?>

    <section class="theme theme-white">
    
        <div class="container">
            <h1 class="text-center text-title text-shadow color-dark"> <?php echo $title; ?> </h1>
    
            <?php echo do_shortcode("[products limit=\"$options->limit_products\" columns=\"$options->columns\" orderby=\"$options->orderby\" class=\"$options->class\" on_sale=\"$options->on_sale\" ]"); ?>
    
            <div class="separator-big"></div>
    
        </div>
    
    </section>
    
    <?php 
    }, [
        'title' => 'Colorful Shop section',
        'description' => 'This section is used to render the list of WooCommerce products. It displays the specified number of products (they can be changed in the options)',
        'author' => 'Mirele Package Colorful'
    ]);