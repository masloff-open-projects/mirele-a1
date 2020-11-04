<?php


namespace Mirele\Compound;


/**
 * Class Field
 * @package Mirele\Compound
 * @deprecated
 */
class Field
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
    private $component;
    /**
     * @var
     */
    private $data;
    /**
     * @var
     */
    private $componentProps;
    /**
     * @var
     */
    private $meta;

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
     * @param $key
     * @return mixed
     */
    public function getData($key)
    {
        return $this->data[$key];
    }

    /**
     * @param $key
     * @param $data
     */
    public function setData($key, $data)
    {
        $this->data[$key] = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @param array $props
     */
    public function setProps(array $props)
    {
        $this->props = $props;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @param Component $component
     */
    public function setComponent(Component $component)
    {
        $this->component = $component;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComponentProps()
    {
        return $this->componentProps;
    }

    /**
     * @param array $props
     * @return $this
     */
    public function setComponentProps(array $props)
    {
        $this->componentProps = $props;
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}