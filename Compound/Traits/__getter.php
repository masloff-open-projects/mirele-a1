<?php


namespace Mirele\Framework\Traits;


trait __getter
{

    protected $data = [];

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return $this->data[$name];
    }


}