<?php

/**
 * Rosemary Template: Business in numbers;
 */

rosemary_register('buissness_in_numbers_light_flat_small', function ($event=null) {
?>

<section class="theme-numbers-flat-under-desert" animation_id="business_in_numbers_desert">

    <div class="container">

        <div class="flat-under-desert-number-block">

            <?php for ($i=1; $i < 4; $i++): ?>

            <?php $number = rosemary_register_element("number_$i", [
                'value' => rand(100, 1000),
                'type' => 'int'
            ], [
                'title' => "INDEX",
                'duration' => 3000
            ]);

            $options = rosemary_get_options();  ?>

            <?php if ( rosemary_get_visible(rosemary_get_full_id("number_$i")) ): ?>
            <div class="flat-under-desert-number">

                <h2 class="color-dark-light" number-to="<?php echo $number; ?>"
                    duration="<?php echo $options->duration; ?>">0</h2>
                <p> <?php echo $options->title; ?> </p>

            </div>
            <?php endif; ?>

            <?php endfor; ?>

        </div>

    </div>

</section>

<?php }, array(
    'title' => 'Business in numbers',
    'description' => 'Minimalistic block "Your business in numbers." It was created to complement the "Header Desert" block',
    'author' => 'Mirele Package Classic'
)); ?>