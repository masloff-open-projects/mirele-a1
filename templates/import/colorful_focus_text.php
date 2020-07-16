<?php

/**
 * Rosemary Template: Colorful Focus Text;
 */

rosemary_register('colorful_focus_description', function ($event=null) {
?>

<section class="theme">

    <div class="separator-big"></div>
    
        <div class="container">

            <h1 class="text-center color-dark"> <?php echo rosemary_register_element("title", [
                        'value' => 'Small heading',
                        'type' => 'text',
                        'visible' => ""
                    ]); ?> </h1>

            <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                    <h2 class="text-right color-dark margin-none"> <?php echo rosemary_register_element("subtitle", [
                        'value' => 'Subtitle',
                        'type' => 'text',
                        'visible' => ""
                    ]); ?> </h2>

                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                    <p class="text-left color-dark margin-none"> <?php echo rosemary_register_element("description", [
                        'value' => mb_strimwidth(Lorem::ipsum(3), 0, ROSEMARY_VARCHAR_SIZE_DB, '&hellip;'),
                        'type' => 'text',
                        'visible' => ""
                    ]); ?> </p>

                </div>

            </div>

        </div>

    <div class="separator-big"></div>

</section>

<?php }, array(
    'title' => 'Colorful Focus Text',
    'description' => 'The block helps to focus the user`s attention on a particular textual information.',
    'author' => 'Mirele Package Colorful'
)); ?>