<?php


namespace Mirele\Framework;


/**
 * Class Iterator
 * @package Mirele\Framework
 */
class Iterator implements Iterator_Interface
{

    /**
     * @var
     */
    private $collection;
    /**
     * @var int
     */
    private $position = 0;
    /**
     * @var false|mixed
     */
    private $reverse = false;

    /**
     * Iterator constructor.
     * @param $collection
     * @param false $reverse
     */
    public function __construct($collection, $reverse = false)
    {
        $this->collection = $collection;
        $this->reverse = $reverse;
    }

    /**
     *
     */
    public function rewind()
    {
        $this->position = $this->reverse ? count($this->collection->getItems()) - 1 : 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->collection->getItems()[$this->position];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     *
     */
    public function next()
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->collection->getItems()[$this->position]);
    }
}
