<?php


namespace Mirele\Compound;


/**
 * Class ModuleKit
 * @package Mirele\Compound
 */
class ModuleKit
{


    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return json_encode(get_class_methods($this));
    }

    /**
     * @param $data
     * @return Component
     */
    public function Component($data) {
        return new Component($data);
    }

    /**
     * @param $data
     * @return Template
     */
    public function Template($data) {
        return new Template($data);
    }

}