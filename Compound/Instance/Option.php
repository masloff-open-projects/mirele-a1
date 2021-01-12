<?php


namespace Mirele\Framework;


use Mirele\Compound\Repository;
use Mirele\Framework\ClassExtends\Storage;


class Option extends Storage {

    protected $id;
    protected $default;

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
    public function __construct($object = false)
    {

        if (is_array($object) or is_object($object)) {

            $object = (object)$object;

            if (isset($object->id)) {
                $this->id = $object->id;
            }

            if (isset($object->default)) {
                $this->default = $object->default;
            }

            foreach ($object as $name => $value) {
                $this->{$name} = $value;
            }

            Repository::registerOption($this->id, $this);

        }

    }


}