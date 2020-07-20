<?php

/**
 * Rosemary Template: Darkness Video Presentation;
 */

rosemary_register('darkness_video_presentation', function ($event=null) {
    
$video = rosemary_register_element('video', [
    'type' => 'src',
    'value' => ''
], [
    'video_no_border' => 'no',
    'video_border_extension' => 'primitive'
]);

$options_video = rosemary_get_options(); 

?>

<section class="theme-video-presentation" animation_id="video-presentation">

    <div class="container">

        <h1 class="text-center text-title text-shadow color-white"> <?php echo rosemary_register_element('title', [
            'value' => 'Video presentation',
            'type' => 'text'
        ]); ?> </h1>

        <video contextmenu="" class="video-player-presentation" width="100%" controls loop playsinline video_no_border="<?php echo $options_video->video_no_border ?>" video_border_extension="<?php echo $options_video->video_border_extension ?>" src="<?php echo rosemary_get_single_image($video) ?>" type="video/mp4">

        </video>
        
        <div class="separator-big"></div>

    </div>

</section>

<?php }, array(
    'title' => 'Darkness Video Presentation',
    'description' => 'A block with beautiful animation will help you show your video presentation in all its beauty. (Animation can be changed or disabled)',
    'author' => 'Mirele Package Darkness'
)); ?>