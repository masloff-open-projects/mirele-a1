<?php


namespace Mirele\Compound;


class Component
{

    private $id;
    private $name;
    private $props;
    private $function;
    private $data;

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
     * @param mixed $data
     */
    public function setData(string $key, $data)
    {
        $this->data[$key] = $data;
        return $this;
    }

    /**
     * @param mixed $data
     */
    public function getData(string $key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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