<?php

/**
 * Rosemary Template: Light Header With People;
 */

rosemary_register('light_header_with_people', function ($event=null) {

    $button = rosemary_register_element('button', [
        'value' => 'Subscribe for free',
        'type' => 'text'
    ], [
        'redirect_url' => '',
        'mailchimp_list' => ''
    ]);

    $options = rosemary_get_options();

?>

<section class="theme theme-light header-light">

    <div class="container">
        <div class="row">
            
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 limit-right-middle">
            
                <h1 class="color-black-light text-300"> <?php echo rosemary_register_element("title", [
                    'value' => "Are you ready to ride our camels?",
                    'type' => 'text'
                ]); ?> </h1>

                <p class="color-black-light text-300">  <?php echo rosemary_register_element("subtitle", [
                    'value' => Lorem::ipsum(1),
                    'type' => 'text'
                ]); ?> </p>

                <div class="margin-x-md">
                    <a href="javascript:;" class="text-300" target="_blank" rel="noopener noreferrer">
                        <?php echo $button ?> <i class="fas fa-chevron-right svg-icon-small"></i>
                    </a>
                </div>
            
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 offer-image hidden-sm">
                <img src="http://192.168.1.130/wordpress/wp-content/themes/mirele_2/img/8-2-happy-girl-free-png-image.png" alt="" srcset="">
            </div>
            
        </div>
    </div>

</section>

<?php }, array(
    'title' => 'Light Header With People',
    'description' => 'Lightweight hat with the ability to insert a photo of a person in the area on the right',
    'author' => 'Mirele Package Light'
)); ?>