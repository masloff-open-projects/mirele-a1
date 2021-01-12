<?php


namespace Mirele\Framework\ClassExtends;


class Storage
{

    private $data;

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
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * is triggered by calling isset() or empty() on inaccessible members.
     *
     * @param string $name
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
     * @param string $name
     * @return void
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return json_encode($this->data);
    }

    /**
     * This method is called by var_dump() when dumping an object to get the properties that should be shown.
     * If the method isn't defined on an object, then all public, protected and private properties will be shown.
     *
     * @return array|null
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo
     */
    public function __debugInfo()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    protected function getData()
    {
        return $this->data;
    }


}