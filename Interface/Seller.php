<?php


namespace Mirele\Framework;


/**
 * Interface Seller
 * @package Mirele\Framework
 */
interface Seller {
    /**
     * @param $name
     * @return mixed
     */
    static public function get($name);

    /**
     * @param $Component
     * @return mixed
     */
    static public function add($Component);

    /**
     * @param $namespace
     * @param $name
     * @param $props
     * @return mixed
     */
    static public function call($namespace, $name, $props);

    /**
     * @param $sort
     * @return mixed
     */
    static public function all($sort);
}