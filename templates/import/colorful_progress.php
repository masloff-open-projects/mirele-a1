<?php

/**
 * Rosemary Template: Progress;
 */

rosemary_register('colorful_progress', function ($event=null) {
?>

<section class="theme theme-section-progress padding-block" animation_id="progress_section">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 limit-right-middle">
                <h2 class="text-inside padding-block-title">
                    <?php echo rosemary_register_element("title", [
                        'value' => 'Excellent performance',
                        'type' => 'text',
                        'visible' => ""
                    ]); ?> </h2>
                <p class="color-space-light">
                    <?php echo rosemary_register_element("description", [
                        'value' => mb_strimwidth(Lorem::ipsum(2), 0, ROSEMARY_VARCHAR_SIZE_DB / 4, '&hellip;'),
                        'type' => 'text',
                        'visible' => ""
                    ]); ?> </h2></p>

                <div class="visible-xs separator-middle"></div>
                <div class="visible-sm separator-middle"></div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                
            <?php for ($i=1; $i < 9; $i++): ?>

                <?php $progress = rosemary_register_element("progress_$i", [
                    'value' => rand(50, 100),
                    'type' => 'int',
                    'visible' => $i < 5 ? '1' : '0'
                ], [
                    'title' => mb_strimwidth(Lorem::ipsum(1), 0, ROSEMARY_VARCHAR_SIZE_DB / 18, '&hellip;'),
                    'duration' => 3000
                ]);

                $options = rosemary_get_options();  ?>

                    <?php if ( rosemary_get_visible(rosemary_get_full_id("progress_$i")) ): ?>
                        
                        <p class="color-space-light text-bold"> <?php echo $options->title; ?> </p>
                        <div class="progress">
                            <div class="progress-bar" progress="<?php echo $progress; ?>" style="width: <?php echo $progress; ?>%;"></div>
                        </div>

                    <?php endif; ?>

            <?php endfor; ?>

            </div>

        </div>
    </div>
</section>

<?php }, array(
    'title' => 'Colorful Progress',
    'description' => 'Have something to show about your business in charts? Use this block to create a section with progress bars.',
    'author' => 'Mirele Package Colorful'
)); ?>