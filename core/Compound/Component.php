<?php


namespace Mirele\Compound;


class Component
{

    private $id;
    private $name;
    private $props;
    private $function;

    /**
     * @param mixed $id
     */

    public function setId(string $id)
    {
        $this->id = (string) $id;
        return $this;
    }


    /**
     * @return mixed
     */

    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $props
     */

    public function setProps(array $props)
    {
        $this->props = (array) $props;
        return $this;
    }


    /**
     * @param mixed $function
     */

    public function setFunction(callable $function)
    {
        if (is_callable($function)) {
            $this->function = $function;
            return $this;
        } else {
            throw new \Exception("You're not passing on a function");
        }
    }

    public function render (array $props) {
        return ($this->function)(array_merge($this->props, $props));
    }

    public function build () {
        return $this;
    }

}