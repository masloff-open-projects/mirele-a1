<?php


namespace Mirele\Framework\Traits;


trait __unset
{

    protected $data = [];

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

}