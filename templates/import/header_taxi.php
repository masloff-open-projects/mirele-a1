<?php

/**
 * Rosemary Template: Taxi Header;
 */

rosemary_register('taxi_header', function ($event=null) {
?>

<section class="theme-classic-taxi" <?php if (get_header_image()) { $url = get_header_image(); echo "style='background-image: url($url)'"; } ?>>

    <div>
        
        <h1> <?php echo rosemary_register_element("title", [
            'value' => "FAST & SAFE SERVICE",
            'type' => 'text'
        ]); ?> </h1>
        <p>  <?php echo rosemary_register_element("subtitle", [
            'value' => "Quick taxi order! Or something else",
            'type' => 'text'
        ]); ?> </p>

        <i class="fas fa-chevron-down navigate-to-bottom"></i>

    </div>
    
</section>

<?php }, array(
    'title' => 'Header Taxi',
    'description' => 'Plain header with text in the middle',
    'author' => 'Mirele Package Classic'
)); ?>