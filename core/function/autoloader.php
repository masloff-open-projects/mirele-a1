<?php

/**
 * A script to initialize template objects.
 * It automatically checks the file for the presence of meta information in it
 * and if he considers it a template - loads into memory
 *
 * @author: Mirele
 * @version: 1.0.0.
 * @package: Mirele
 */


/**
 * Initialization function of all templates and connection
 * them to the system
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 * @executetime: 0.000027894973754883 s
 */

function initialize_templates ($verify_signature=false) {

    set_exception_handler(function($exception) {
        var_dump($exception);
    });

    global $rosemary_templates_autoload;
    global $msafe;

    if (empty($rosemary_templates_autoload)) {
        $rosemary_templates_autoload = array();
    }

    if (class_exists('RecursiveIteratorIterator') and function_exists('realpath')) {

        $path = realpath(ROSEMARY_TEMPLATES_DIR);
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);

        foreach($objects as $name => $object){
            if (is_file($name) and mime_content_type($name) == 'text/x-php') {

                $code = MFile::read($name);

                preg_match('/Rosemary Template: (.+?);/', $code, $COMMENT_TEMPLATE);

                if (isset($COMMENT_TEMPLATE[1]) and !empty($COMMENT_TEMPLATE[1]) and empty($rosemary_templates_autoload) or !in_array($COMMENT_TEMPLATE[1], $rosemary_templates_autoload)) {
                    $rosemary_templates_autoload[$COMMENT_TEMPLATE[1]] = (object) array(
                        'name' => $COMMENT_TEMPLATE[1],
                        'filename' => $name
                    );

                    if ($msafe->verify_source_code($name, $code)) {

                        if ($verify_signature and $msafe->verify_signature($name, $code)) {
                            try {
                                include_once $name;
                            } catch (\Exception $e) {
                                echo $COMMENT_TEMPLATE[1] . ' => ',  $e->getMessage(), "\n";
                            }
                        } elseif (!$verify_signature) {
                            try {
                                include_once $name;
                            } catch (\Exception $e) {
                                echo $COMMENT_TEMPLATE[1] . ' => ',  $e->getMessage(), "\n";
                            }
                        }

                    }
                }

            }
        }

    } else {

        foreach (glob(ROSEMARY_TEMPLATES_DIR . '/*/*.php') as $r) {

            $code = MFile::read($r);
            preg_match('/Rosemary Template: (.+?);/', $code, $matches);

            if (isset($matches[1]) and !empty($matches[1]) and empty($rosemary_templates_autoload) or !in_array($matches[1], $rosemary_templates_autoload)) {

                $rosemary_templates_autoload[$matches[1]] = (object) array(
                    'name' => $matches[1],
                    'filename' => $r
                );

                if ($msafe->verify_source_code($r, $code)) {

                    if ($verify_signature and $msafe->verify_signature($r, $code)) {
                        try {
                            include_once $r;
                        } catch (\Exception $e) {
                            echo $matches[1] . ' => ',  $e->getMessage(), "\n";
                        }
                    } elseif (!$verify_signature) {
                        try {
                            include_once $r;
                        } catch (\Exception $e) {
                            echo $matches[1] . ' => ',  $e->getMessage(), "\n";
                        }
                    }

                }

            }
        }

    }

    return $rosemary_templates_autoload;

}