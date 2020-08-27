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

    echo $options->font != 'Roboto' ? MPackage::single_font($options->font) : '';

    $block_options = (object) rosemary_register_block_options(array(
        'background_color' => 'white',
        'font_color' => 'black',
        'animate' => 'none'
    ));

    ?>

    <section class="theme theme-white" data-aos="<?php echo $block_options->animate?>" <?php if ($block_options->background_color) { echo "style='background-color: $block_options->background_color'"; } ?>>
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