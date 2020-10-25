<?php


namespace Mirele\Framework\Application;

use Mirele\Framework\Customizer;


class Option
{

    /**
     * is triggered when invoking inaccessible methods in an object context.
     *
     * @param $name string
     * @param $arguments array
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public function __call(string $name, $arguments)
    {

        $namespace = isset($arguments[0]) ? $arguments[0] : "*";
        $props = isset($arguments[1]) ? (array) $arguments[1] : [];

        return Customizer::perform($namespace, $name, $props);

    }

    public function get ($namespace, $name, $props=[])
    {
        return Customizer::perform($namespace, $name, $props);
    }

}