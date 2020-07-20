<?php

/**
 * Development salvation
 *
 * @version: 1.0.0 Beta
 * @author: Mirele
 * @package: Mirele
 */

abstract class RDevelop {

    /**
     * Get all files from the template folder
     *
     * @version 1.0.0
     * @return array
     */

    function get_files () {

        $files = [];

        foreach (glob(ROSEMARY_TEMPLATES_DIR . '/developer/*.php') as $r) {
            $code = MFile::read($r);
            preg_match('/Rosemary Template: (.+?);/', $code, $matches);

            if (!empty($matches[1])) {
                $files[] = $r;
            }
        }

        return $files;

    }


    /**
     * Get file
     *
     * @version 1.0.0
     * @param $name
     * @return false|string
     */

    function get_file ($name) {
        return MFile::read (ROSEMARY_TEMPLATES_DIR . '/developer/' . $name . '.php');
    }


    /**
     * Write code to file
     *
     * @version 1.0.0
     * @param null $name
     * @param null $content
     * @return false|int
     */

    function write_file ($name=null, $content=null) {

        $fp = fopen(ROSEMARY_TEMPLATES_DIR . '/developer/' . $name . '.php', 'w');
        $r = fwrite($fp, $content);
        fclose($fp);

        return $r;

    }


    /**
     * Write code to file (safe)
     *
     * @version 1.0.0
     * @param null $name
     * @param null $content
     * @return false|int
     */

    function write_file_safe ($name=null, $content=null) {

        if ( !file_exists(ROSEMARY_TEMPLATES_DIR . '/developer/' . $name . '.php') ) {

            $fp = fopen(ROSEMARY_TEMPLATES_DIR . '/developer/' . $name . '.php', 'w');
            $r = fwrite($fp, $content);
            fclose($fp);

            return $r;

        }

    }

}