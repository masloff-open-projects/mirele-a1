<?php

function resizeImage ($filename, $max_width, $max_height) {

    if (
        function_exists('imagecreatetruecolor') &&
        function_exists('imagecreatefromjpeg') &&
        file_exists($filename)
    ) {

        list($orig_width, $orig_height, $type) = getimagesize($filename);

        $width = $orig_width;
        $height = $orig_height;

        # taller
        if ($height > $max_height) {
            $width = ($max_height / $height) * $width;
            $height = $max_height;
        }

        # wider
        if ($width > $max_width) {
            $height = ($max_width / $width) * $height;
            $width = $max_width;
        }

        $image_p = imagecreatetruecolor($width, $height);

        if ($image_p) {

            if ($type == 3) {
                $image = imagecreatefrompng($filename);
            } else {
                $image = imagecreatefromjpeg($filename);
            }


            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

            imagejpeg($image_p, dirname($filename) . '/' . pathinfo($filename, PATHINFO_FILENAME) . '-' . $max_width . 'x' . $max_height . '.' . end(explode('.', $filename)));

            // Free up memory
            imagedestroy($image_p);
            imagedestroy($image);

            return $image_p;

        } else {

            return false;

        }

    } else {
        return false;
    }
}