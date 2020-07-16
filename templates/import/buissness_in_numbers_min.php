<?php

/**
 * Rosemary Template: Business in numbers Classic;
 */

rosemary_register('business_in_numbers_minimalism', function ($event=null) {
?>

<section class="theme-flat-numbers" animation_id="business_in_numbers_minimalism">

    <div class="separator-middle"></div>

    <div class="container">

        <h1 class="text-center color-dark">
            <?php echo rosemary_register_element("title", [
                'value' => 'My business in numbers',
                'type' => 'text'
            ]); ?> </h1>

        <div class="flat-number-block">

            <?php for ($i=1; $i < 9; $i++): ?>

            <?php $number = rosemary_register_element("number_$i", [
                'value' => rand(100, 1000),
                'type' => 'int'
            ], [
                'title' => "INDEX",
                'duration' => 3000
            ]);

            $options = rosemary_get_options();  ?>

            <?php if ( rosemary_get_visible(rosemary_get_full_id("number_$i")) ): ?>
            <div class="flat-number">

                <h2 class="color-dark-light" number-to="<?php echo $number; ?>"
                    duration="<?php echo $options->duration; ?>">0</h2>
                <p> <?php echo $options->title; ?> </p>

            </div>
            <?php endif; ?>

            <?php endfor; ?>

        </div>

    </div>

    <div class="separator-big"></div>

</section>

<?php }, array(
    'title' => 'Business in numbers',
    'description' => 'A small block for those who want to show without much puffos what their business represents in numbers. (The block supports animations)',
    'author' => 'Mirele Package Minimalism'
)); ?>