<?php

/**
 * Rosemary Template: Light Partners;
 */

rosemary_register('light_partners', function ($event=null) {
?>

<section class="theme-section-partners padding-section">

    <?php
    $title = rosemary_register_element("title", [
        'value' => 'Among our customers',
        'type' => 'text',
        'visible' => ""
    ]);
    ?>
    
    <?php if ( rosemary_get_visible(rosemary_get_full_id("title")) ): ?>
        <h1 class="text-center text-title text-shadow color-dark">
    <?php echo $title; ?> </h1>
    
    <?php endif; ?>


    <div class="constructor-overflow-x box-shadow-curved box-border-block text-center background-space-light">
        <div class="constructor-max-width text-center">

        <?php for ($i=1; $i < 21; $i++): ?>

            <?php $partner = rosemary_register_element("partner_$i", [
                'value' => '',
                'type' => 'src'
            ], [
                'url' => '',
                'height' => '128px'
            ]);

            $partner = explode('|', $partner);

            foreach ($partner as $src) {
                if (!empty($src)) {
                    $partner = $src;
                    break;
                }
            }

            $options = rosemary_get_options();  ?>

                <?php if ( rosemary_get_visible(rosemary_get_full_id("partner_$i")) ): ?>
                    <img class="brand effect effect-hover-opacity" src="<?php echo wp_get_attachment_url($partner); ?>" style="height: <?php echo $options->height; ?>;" onclick='location.href="<?php echo $options->url; ?>"'>
                <?php endif; ?>

        <?php endfor; ?>

        </div>
    </div>

</section>

<?php }, array(
    'title' => 'Light Partners or customers',
    'description' => 'Do you use Envato? Or maybe he is your business partner? You should definitely add all your partners to a separate block on the site. For this, this block was created. (Maximum number of partners - 20)',
    'author' => 'Mirele Package Light'
)); ?>