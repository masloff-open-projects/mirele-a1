<?php


namespace Mirele\Compound;


/**
 * Class Config
 * @package Mirele\Compound
 */
class Config
{

    /**
     * @var array
     */
    private $data;

    /**
     * Config constructor.
     */
    function __construct() {
        $this->data = [];
    }

    /**
     * is triggered by calling isset() or empty() on inaccessible members.
     *
     * @param $name string
     * @return bool
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * is invoked when unset() is used on inaccessible members.
     *
     * @param $name string
     * @return void
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return $this->getData($name);
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param $name string
     * @param $value mixed
     * @return void
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __set($name, $value)
    {
        $this->setData((string) $name, $value);
    }


    /**
     * @param string $key
     * @param $data
     * @return $this
     */
    public function setData(string $key, $data)
    {
        if (!isset($this->data[$key])) {
            $this->data[$key] = $data;
        }

        return $this;
    }

    /**
     * @param $key
     * @return false|mixed
     */

    public function getData($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return false;
    }

    /**
     * @return array
     */
    public function all() {
        return $this->data;
    }

}