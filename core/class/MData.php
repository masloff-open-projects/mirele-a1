<?php

/**
 * This script is responsible for storing
 * data inside WP. It registers settings, allows you to store a small amount of data
 * inside WP global variables
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

class MData {

    private $data = array();


    /**
     * Adds the passed value to the side without
     * a space at the end or beginning
     *
     * @param null $key
     * @param null $value
     * @return string
     */

    public function append ($key=null, $value=null) {
        if (isset($this->data[$key]) and !empty($this->data[$key])) {
            return $this->data[$key] = $this->data[$key] . $value;
        } else {
            $this->data[$key] = $value;
        }
    }


    /**
     * Sets the value of the selected variable.
     * If the variable contained any content,
     * it will be overwritten
     *
     * @param null $key
     * @param null $value
     * @return null
     */

    public function set ($key=null, $value=null) {
        return $this->data[$key] = $value;
    }


    /**
     * Gets the value of a variable
     *
     * @param null $key
     * @param bool $ifNull
     * @return bool|mixed
     */

    public function get ($key=null, $ifNull=false) {
        if (isset($this->data[$key]) and !empty($this->data[$key])) {
            return $this->data[$key];
        } else {
            return $ifNull;
        }
    }


    /**
     * Working with variables in JavaScript.
     * All variables set by the Data:: js_set method
     * will be available from the window variable in JavaScript.
     *
     * @version: 1.0.0
     * @param null $key
     * @param null $value
     */

    public function js_set ($key=null, $value=null) {

        global $mirele_js_var;
        $mirele_js_var[$key] = $value;

    }

}