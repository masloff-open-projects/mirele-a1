<?php

/**
 * Class MFile
 * Class for working with Wordpress file system.
 * It can be used as a class for working with files
 * (writing, reading, adding a new line, deleting)
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

class MFile
{


    /**
     * Safely writes data to a file. If it is not writable,
     * will return false
     *
     * @param string $file
     * @param string $content
     * @return bool
     */

    static function write($file = '', $content = '', $ifPermissionsDenied = false)
    {

        $file = self::getPath() . $file;

        if (file_exists($file) and is_writable($file) and is_file($file)) {

            if (is_writable(dirname($file))) {
                if ($fp = fopen($file, 'w')) {

                    flock($fp, LOCK_EX);
                    fwrite($fp, $content);
                    flock($fp, LOCK_UN);
                    fclose($fp);

                    return true;
                } else {
                    return false;
                }

            } else {
                if ($ifPermissionsDenied and is_callable($ifPermissionsDenied)) {
                    call_user_func($ifPermissionsDenied, $file);
                }
                return false;
            }

            return true;

        } elseif (!file_exists($file)) {

            if (is_writable(dirname($file))) {
                if ($fp = fopen($file, 'w+')) {
                    fwrite($fp, $content);
                    fclose($fp);
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($ifPermissionsDenied and is_callable($ifPermissionsDenied)) {
                    call_user_func($ifPermissionsDenied, $file);
                }
                return false;
            }

        } else {
            return false;
        }

    }


    /**
     * Safely writes data to the end of the file.
     * If it is not writable, will return false
     *
     * @param string $file
     * @param string $content
     * @return bool
     */

    static function append($file = '', $content = '', $ifPermissionsDenied = false)
    {

        $file = self::getPath() . $file;

        if (file_exists($file) and is_writable($file) and is_file($file)) {

            if (is_writable(dirname($file))) {
                if ($fp = fopen($file, 'a')) {
                    flock($fp, LOCK_EX);
                    fwrite($fp, $content);
                    flock($fp, LOCK_UN);
                    fclose($fp);

                    return true;
                } else {
                    return false;
                }
            } else {
                if ($ifPermissionsDenied and is_callable($ifPermissionsDenied)) {
                    call_user_func($ifPermissionsDenied, $file);
                }
                return false;
            }

        } elseif (!file_exists($file)) {

            if (is_writable(dirname($file))) {
                if ($fp = fopen($file, 'a+')) {
                    fwrite($fp, $content);
                    fclose($fp);

                    return true;
                } else {
                    return false;
                }
            } else {
                if ($ifPermissionsDenied and is_callable($ifPermissionsDenied)) {
                    call_user_func($ifPermissionsDenied, $file);
                }
                return false;
            }

        } else {
            return false;
        }

    }


    /**
     * Reads a file safely.
     * If it is not found or is not readable,
     * it will return false
     *
     * @param string $file
     * @return bool|false|string
     */

    static function read($file = '')
    {

        $file = self::getPath() . $file;

        if (file_exists($file) and is_readable($file) and is_file($file)) {

            if ($fp = fopen($file, "r")) {
                $contents = fread($fp, filesize($file));
                fclose($fp);

                return $contents;
            }

        } else {
            return false;
        }

    }


    /**
     * Deletes a file.
     *
     * @param string $file
     * @return bool
     */

    static function delete($file = '')
    {

        $file = self::getPath() . $file;

        if (file_exists($file) and is_file($file)) {
            return unlink($file);
        } else {
            return false;
        }


    }


    /**
     * Checks if file exists
     *
     * @param string $file
     * @return bool
     */

    static function exist($file = '')
    {

        return file_exists(self::getPath() . $file);

    }


    /**
     * Gets file size
     *
     * @param string $file
     * @return bool|false|int
     */

    static function size($file = '')
    {

        $file = self::getPath() . $file;

        if (file_exists($file) and is_file($file)) {
            return filesize($file);
        } else {
            return false;
        }

    }


    /**
     * Gets the label of the last file change
     *
     * @param string $file
     * @return bool|false|int
     */

    static function recent_modify($file = '')
    {

        $file = self::getPath() . $file;

        if (file_exists($file) and is_file($file)) {
            return filectime($file);
        } else {
            return false;
        }

    }


    /**
     * Gets the relative directory
     *
     * @return string
     */

    public static function getPath()
    {
        return '';
    }

}