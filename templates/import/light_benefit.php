<?php

/**
 * Rosemary Template: Light Benefit;
 */

rosemary_register('light_benefit', function ($event=null) {
?>

<section class="theme theme-gradient-gray theme-items lazy">
    <div class="container">
        <div class="row">

            <div class="separator-big"></div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">

                <h1 class="text-left text-shadow color-dark">
                    <?php echo rosemary_register_element("title", [
                        'value' => mb_strimwidth(Lorem::ipsum(1), 0, ROSEMARY_VARCHAR_SIZE_DB / 12, '&hellip;'),
                        'type' => 'text'
                    ]); ?> </h1>

                <p> <?php echo rosemary_register_element("subtitle", [
                        'value' => Lorem::ipsum(1),
                        'type' => 'text'
                    ]); ?> </p>

                <div class="separator-small"></div>

                <?php for ($i=1; $i < 7; $i++): ?>

                <?php $item = rosemary_register_element("item_$i", [
                    'value' => mb_strimwidth(Lorem::ipsum(1), 0, ROSEMARY_VARCHAR_SIZE_DB / 4, '&hellip;'),
                    'type' => 'text'
                ], [
                    'icon' => 'fas fa-question',
                    'title' => "Item $i"
                ]);

                $options = rosemary_get_options();  ?>

                    <?php if ( rosemary_get_visible(rosemary_get_full_id("item_$i")) ): ?>
                    <div class="media">

                        <span class="header color-dark <?php echo $options->icon; ?> icon-light icon-offset pull-left"
                            aria-hidden="true"></span>

                        <div class="media-body">
                            <p class="text-inside text-header color-dark"> <?php echo $options->title; ?> </p>
                                <small> <?php echo $item; ?> </small>
                        </div>

                    </div>
                    <?php endif; ?>

                <?php endfor; ?>
    
                <div class="separator-big"></div>

            </div>

        </div>
    </div>
</section>


<?php $image = rosemary_register_element("image", [
    'value' => '',
    'type' => 'text'
]);

$image = explode('|', $image);

foreach ($image as $src) {
    if (!empty($src)) {
        $image = $src;
        break;
    }
}

?> 

<style>
    @media(min-width:992px) {
        .container {
            max-width: 100%;
        }

        .trigger-md-without-background {
            background: none !important;
        }

        .theme-items {
            background-image: url('<?php echo wp_get_attachment_url($image); ?>');
            background-position: 40vw 30vh;
            background-size: contain;
            background-repeat: no-repeat;
        }

    }

    /* Large devices (desktops, 992px and up) */
    @media(min-width:1200px) {
        .trigger-lg-without-background {
            background: none !important;
        }

        .theme-items {
            background-image: url('<?php echo wp_get_attachment_url($image); ?>');
            background-position: 90% 30px;
            background-size: contain;
            background-repeat: no-repeat;
        }

    }
</style>

<?php }, array(
    'title' => 'Light Benefit',
    'description' => 'Want to talk about the benefits of working with you? Or do you have so many good aspects of your business that one block to unlock your potential is not enough? Use this block! he will be able to reveal several more aspects of your business or online store',
    'author' => 'Mirele Package Light'
)); ?>