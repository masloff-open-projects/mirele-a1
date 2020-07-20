<?php

/**
 * Class for working with settings.
 * It controls the settings form, not the settings themselves
 *
 * @version 1.0.0
 * @author Mirele
 * @package Mirele
 */

class MSettings {

    private $settings = [];


    /**
     * Function for registering settings.
     * Used to render theme and distribution settings
     *
     * @param string $key
     * @param array $settings
     * @return int
     */

    public function register ($key='default', $settings=array()) {

        if (isset($this->settings[$key]) and is_array($this->settings[$key])) {
            return array_push($this->settings[$key], $settings);
        } else {
            $this->settings[$key] = array();
            return array_push($this->settings[$key], $settings);
        }

    }


    /**
     * Get settings data by their key
     *
     * @param string $key
     * @return mixed|null
     */

    public function get ($key='default') {

        if (isset($this->settings[$key])) {
            if (is_array($this->settings[$key])) {
                return $this->settings[$key];
            } else {
                return null;
            }
        } else {
            return null;
        }

    }

}