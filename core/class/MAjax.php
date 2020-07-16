<?php

/**
 * This class works with AJAX methods,
 * but makes it a little more controlled.
 * Some forms of AJAX will work without JS,
 * since I set the rules for finding the
 * standard parameters of a WP form in a POST request.
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

class MAjax
{

    private $ajax = array();


    /**
     * The function registers the NORMAL AJAX method.
     * This method will not be routed through the function self::all ()
     *
     * @param string $action
     * @param null $function
     * @param bool $private
     */

    static public function register ($action="ajax", $function=null, $private=false) {

        if ($private) {
            add_action("wp_ajax_$action", $function);
        } else {
            add_action("wp_ajax_$action", $function);
            add_action("wp_ajax_nopriv_$action", $function);
        }
    }


    /**
     * The function registers the AJAX method.
     * This method works based on an embedded private variable.
     * It is routed through the all method.
     *
     * @param string $action
     * @param null $function
     * @param bool $private
     * @return bool
     */

    public function register_ajax ($action="ajax", $function=null, $private=true) {

        if (!isset($this->ajax[$private][$action]) and !empty($action)) {

            $this->ajax[$private][$action] = (object) array(
                'action' => $action,
                'function' => $function,
                'private' => $private
            );

        } else {
            return false;
        }

    }


    /**
     * The function will return a list of all registered Ajax methods
     *
     * @param bool $private
     * @return bool|mixed
     */

    public function all ($private=true)
    {
        if (isset($this->ajax[$private])) {
            return $this->ajax[$private];
        } else {
            return false;
        }
    }
}