<?php


namespace Mirele\Compound;


class Field
{
    private $id;
    private $name;
    private $props;
    private $component;
    private $data;
    private $componentProps;

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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @param $key
     * @return mixed
     */
    public function getData($key)
    {
        return $this->data[$key];
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
    public function getName()
    {
        return $this->name;
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
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @return mixed
     */
    public function getComponentProps()
    {
        return $this->componentProps;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}