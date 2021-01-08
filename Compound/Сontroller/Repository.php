<?php


namespace Mirele\Compound;


final class Repository
{

    private static $data;
    private static $templates;
    private static $components;
    private static $opitions;

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param string $name
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    static public function __set($name, $value)
    {
        self::$data[$name] = $value;
    }

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

}

