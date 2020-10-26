<?php


namespace Mirele\Framework;


/**
 * Interface Iterator_Interface
 * @package Mirele\Framework
 */
interface Iterator_Interface
{
    /**
     * @return mixed
     */
    public function rewind();

    /**
     * @return mixed
     */
    public function current();

    /**
     * @return mixed
     */
    public function key();

    /**
     * @return mixed
     */
    public function next();

    /**
     * @return mixed
     */
    public function valid();
}