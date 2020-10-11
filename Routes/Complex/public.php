<?php

use Mirele\Router;

# This router redirects all requests
# to the public directory to a folder with external resources.
Router::get('/public/(:all)', function ($path) {

    # Check which directory is the directory with public resources.
    if (is_dir(get_template_directory() . '/Public')) {
        $dir = get_template_directory() . '/Public';
        $file = $dir . '/' . $path;
    } elseif (is_dir(get_template_directory() . '/Source')) {
        $dir = get_template_directory() . '/Source';
        $file = $dir . '/' . $path;
    } else {
        http_response_code(404);
        exit;
    }

    # Checking for file availability
    if ($file and file_exists($file)) {

        $ignore = [];
        if (file_exists($dir . '/.ignore')) {
            $ignore = file($dir . '/.ignore');
        }

        foreach ($ignore as $source) {
            if (($dir . '/' . $source) == $file) {

                http_response_code(404);
                exit;

            } elseif (is_dir($dir . '/' . $source)) {

                if (dirname($file) === realpath($dir . '/' . $source)) {

                    http_response_code(404);
                    exit;

                }

            }
        }

        http_response_code(200);
        header('Content-Type: ' . mime_content_type($file));

        print file_get_contents($file);
        exit;

    } else {

        http_response_code(404);
        exit;

    }


});