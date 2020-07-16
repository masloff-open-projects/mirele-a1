<?php

/**
 * Rosemary Template: Template;
 */

rosemary_register('template', function() {

$title = rosemary_register_element('title', [
    'type' => 'text',
    'value' => 'Section header'
], [
    'color' => '#232323',
    'font' => 'Roboto'
]);

$options = rosemary_get_options();

echo $options->font != 'Roboto' ? MResources::include_font($options->font) : '';

?>

<section class="theme theme-white">
    <div class="container">

        <h1 class="text-center text-title text-shadow color-dark" style="color: <?php echo $options->color; ?>; font-family: '<?php echo $options->font; ?>' " > <?php echo $title ?> </h1>

        <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                <?php echo rosemary_register_element('content', [
                    'type' => 'text',
                    'value' => 'Your content. It could be a shortcode'
                ]); ?>

            </div>
            
        </div>
        
        <div class="separator-big"></div>

    </div>
</section>

<?php
}, array(
    'title' => 'Template',
    'description' => 'Page for your custom content. It has a title, has an area for content.',
    'author' => 'Mirele Package'
));