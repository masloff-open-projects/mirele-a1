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

namespace Mirele\AJAX;

class Connector
{

    /**
     * The single object is stored in a static class field. This field is an array, so...
     * how we let our Lonely have subclasses * All the elements of it.
     * the arrays will be copies of specific subclasses of Single. Don't worry,
     * we're about to get to know how it works
     */

    private static $instances = [];
    private $ajax = [];


    /**
     * Loners should not be cloned.
     */

    protected function __clone() { }


    /**
     * Single units should not be recovered from lines.
     *
     * @throws Exception
     */

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }


    /**
     * Сonstruct Single must always be hidden to prevent
     * creating an object through the operator new.
     */

    protected function __construct() { }


    /**
     * It's a static method that controls access to a single instance. At .
     * the first run, it creates an instance of a loner and puts it in *
     * static field. On subsequent launches, it returns the object to the client,
     * stored in a static field *
     *
     * This implementation allows you to extend the Singles class by saving everywhere
     * only one copy of each subclass.
     *
     * @return mixed|static
     */

    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    /**
     * The function registers the AJAX method.
     * This method works based on an embedded private variable.
     * It is routed through the all method.
     *
     * @param string $action
     * @param null $function
     * @param bool $private
     * @return bool|object
     */

     public function register ($action="ajax", $function=null, $private=false) {

        if (!isset($this->ajax[$private][$action]) and !empty($action)) {

            return $this->ajax[$private][$action] = (object) array(
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