<?php


namespace Mirele\Framework;


interface CompoundComponent
{
    public function __construct($object = false);
    public function __call($name, $arguments);
    public function __invoke(array $props);
    public function __debugInfo();
    public function __get($name);
    public function __set($name, $value);
    public function __isset($name);
    public function __unset($name);
    public function isIndex();
    public function render(array $props);
}