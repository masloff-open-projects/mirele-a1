<?php

namespace Mirele\Compound;


use Mirele\Compound\Helpers;


class HelpersStore
{

    private $helpers;

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct()
    {

        $this->helpers = array(
            'WP' => new Helpers\WP(),
            'HTML' => new Helpers\HTML(),
            'URL' => new Helpers\URL(),
        );

    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return json_encode(array(
            'WP' => get_class_methods($this->WP),
            'HTML' => get_class_methods($this->HTML),
            'URL' => get_class_methods($this->URL),
        ));
    }

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param string $name
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return $this->helpers[$name];
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
        return isset($this->helpers[$name]);
    }

}