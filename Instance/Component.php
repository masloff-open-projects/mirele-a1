<?php


namespace Mirele\Compound;


/**
 * Class Component
 * @package Mirele\Compound
 */
class Component
{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $props;
    /**
     * @var
     */
    private $function;
    /**
     * @var
     */
    private $data;
    /**
     * @var
     */
    private $meta;
    private $alias;


    /**
     * @param $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }
    /**
     * @param string $meta
     * @param mixed $value
     * @return $this
     */
    public function setMeta(string $meta, $value)
    {
        $this->meta[$meta] = $value;
        return $this;
    }

    /**
     * @param string $meta
     * @return false|mixed
     */
    public function getMeta(string $meta)
    {
        if (isset($this->meta[$meta])) {
            return $this->meta[$meta];
        }

        return false;
    }

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

    /**
     * @param array $props
     * @return mixed
     */
    public function render (array $props) {
        return ($this->function)(array_merge($this->props, $props));
    }

    /**
     * @return $this
     */
    public function build () {
        return $this;
    }

}