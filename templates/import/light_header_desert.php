<?php

/**
 * Rosemary Template: Light Desert Header;
 */

rosemary_register('light_desert_header', function ($event=null) {
?>

<section class="theme-classic-desert" <?php if (get_header_image()) { $url = get_header_image(); echo "style='background-image: none'"; } ?> async_background_image="<?php if (get_header_image()) { $url = get_header_image(); echo $url; } else { echo get_template_directory_uri() . "/img/background.header.desert.jpg"; }?>" >

    <div>
        
        <h1> <?php echo rosemary_register_element("title", [
            'value' => "Are you ready to ride our camels?",
            'type' => 'text'
        ]); ?> </h1>

        <p>  <?php echo rosemary_register_element("subtitle", [
            'value' => "We offer you a camel trip for $ 49",
            'type' => 'text'
        ]); ?> </p>


    </div>
    
</section>

<?php }, array(
    'title' => 'Light Header Desert',
    'description' => 'Plain header with text in the middle',
    'author' => 'Mirele Package Light'
)); ?>