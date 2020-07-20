<?php

/**
 * Function for caching data
 * Element caching class.
 * Any.
 * Being a String Number Float Array or JSON cache,
 * it can store any values and return them in the
 * same form as they were cached
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

class MCache {

    private $dir = "cache";
    public $time = 1;

    /**
     * Function for setting data in the cache.
     * As a result,
     * it returns the data that was passed to it.
     * If the cache is still active, the function will not write to the cache cell
     *
     * @author: Mirele
     * @version: 1.0.0
     * @param string $key
     * @param string $value
     * @return mixed|string
     */

    public function set ($key='default', $value='default') {

        $file = sprintf ("%s/%s/%s.mc", MIRELE_CORE_DIR, $this->dir, md5($key));

        if (file_exists($file) && time() - filectime($file) < 60 * 60 * $this->time && filesize($file) > 0) {

            return json_decode(base64_decode(MFile::read($file)));

        } else {

            if (is_writable($file) and file_exists($file)) {
                MFile::write($file, base64_encode(json_encode($value)));
            } elseif (!file_exists($file)) {
                MFile::write($file, base64_encode(json_encode($value)));
            }

            return $value;

        }

    }


    /**
     * Function for getting data from the cache.
     * It returns the value that was cached.
     * The value will not lose its data type
     *
     * @author: Mirele
     * @version: 1.0.0
     * @param string $key
     * @return bool|mixed
     */

    public function get ($key='default') {

        $file = sprintf ("%s/%s/%s.mc", MIRELE_CORE_DIR, $this->dir, md5($key));

        if (file_exists($file) && time() - filectime($file) < 60 * 60 * $this->time && filesize($file) > 0) {

            return json_decode(base64_decode(MFile::read($file)));

        } else {

            return false;

        }

    }


    /**
     * Function for performing a function with consideration and writing output to the cache.
     * Attention! If your function does not use return to return a value,
     * it will not be encrypted, and you will get null as a result of data output from the cache
     *
     * @author: Mirele
     * @version: 1.0.0
     * @param string $key
     * @param null $function
     * @return bool|mixed|string
     */

    public function execute ($key='default', $function=null) {

        if ( self::get($key) != false ) {
            return self::get($key);
        } else {

            if (is_callable($function)) {
                return self::set($key, call_user_func ($function, $key));
            } else {
                return false;
            }

        }

    }

}