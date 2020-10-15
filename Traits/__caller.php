<?php

namespace Mirele\Framework\Traits;


trait __caller
{

    protected $data = [];

    /**
     * is triggered when invoking inaccessible methods in an object context.
     *
     * @param $name string
     * @param $arguments array
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public function __call($name, $arguments)
    {
        if (isset($this->data[$name]) and is_callable($this->data[$name])) {
            return call_user_func($this->data[$name], $arguments);
        } else {
            return false;
        }
    }


}