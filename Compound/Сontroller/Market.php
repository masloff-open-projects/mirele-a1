<?php


namespace Mirele\Compound;


use Exception;
use Mirele\Framework\Iterator;
use Mirele\Framework\Stringer;
use TypeError;


/**
 * Class Market
 * @package Mirele\Compound
 */
class Market
{

    private static $templates;
    private static $components;
    private static $opitions;

    /**
     * @param mixed $data
     */
    static public function registerTemplate($name, $data)
    {
        self::$templates[$name] = $data;
    }

    /**
     * @param mixed $data
     */
    static public function registerComponent($name, $data)
    {
        self::$components[$name] = $data;
    }

    /**
     * @param mixed $data
     */
    static public function registerOption($name, $data)
    {
        self::$opitions[$name] = $data;
    }

    /**
     * @return mixed
     */
    static public function getComponent($name)
    {
        return self::$components[$name];
    }

    /**
     * @return mixed
     */
    static public function getTemplate($name)
    {
        return self::$templates[$name];
    }

    /**
     * @return mixed
     */
    static public function getOption($name)
    {
        return self::$opitions[$name];
    }

    /**
     * @return mixed
     */
    public static function getTemplates()
    {
        return self::$templates;
    }

    /**
     * @return mixed
     */
    public static function getComponents()
    {
        return self::$components;
    }

    /**
     * @return mixed
     */
    public static function getOpitions()
    {
        return self::$opitions;
    }

}

