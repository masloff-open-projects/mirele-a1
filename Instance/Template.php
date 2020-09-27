<?php


namespace Mirele\Compound;


use Mirele\TWIG;


/**
 * Class Template
 * @package Mirele\Compound
 */
class Template
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
    private $components;
    /**
     * @var
     */
    private $fields;
    /**
     * @var
     */
    private $componentsProps;
    /**
     * @var
     */
    private $twig;
    /**
     * @var
     */
    private $meta;
    /**
     * @var
     */
    private $handler;

    /**
     * Template constructor.
     */
    function __construct() {
        $this->setHandler(function ($event) {
            return $event;
        });
    }

    /**
     * @param callable $handler
     * @return $this
     */
    public function setHandler(callable $handler)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
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
     * @param string $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->id = (string) $id;
        return $this;
    }

    /**
     * @param string $name
     * @param $field
     * @return $this
     */
    public function setField(string $name, $field)
    {
        $this->fields[$name] = $field;
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function addField($field)
    {
        $this->fields[] = $field;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getField($name)
    {
        return $this->fields[$name];
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param array $props
     * @return $this
     */
    public function setProps(array $props)
    {
        $this->props = (array) $props;
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
     * @param $key
     * @return false|mixed
     */

    public function getProp($key)
    {
        if (isset($this->props[$key])) {
            return $this->props[$key];
        }
        return false;
    }



    /**
     * @param string $name
     * @param Component $component
     * @return $this
     */
    public function setComponent(string $name, Component $component)
    {
        $this->components[$name] = $component;
        return $this;
    }

    /**
     * @param string $name
     * @param array $componentsProps
     */
    public function setComponentProps(string $name, array $componentsProps)
    {
        $this->componentsProps[$name] = $componentsProps;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function removeComponent(string $name)
    {
        unset($this->components[$name]);
        return $this;
    }

    /**
     * @param Component $component
     * @return $this
     */
    public function addComponent(Component $component)
    {
        $this->components[] = $component;
        return $this;
    }

    /**
     * @param string $twig
     * @return $this
     */
    public function setTwig(string $twig)
    {
        $this->twig = $twig;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * @param array $props
     * @param bool $np
     * @return false
     */
    public function render (array $props, $np=true) {

        # Check if a handler is available and call it if it is.
        if (is_callable($this->getHandler())) {
            call_user_func($this->getHandler(), $this);
        }

        # Render
        return TWIG::Render($this->twig, array_merge((array) $this->props, (array) $props, (array) $this->components, [
            'components' => (object) array_merge(
                (array) $this->components,
                (array) [
                    'error' => Store::get('default_error')
                ]
            ),
            'props' => (object) array_merge(
                (array) $this->props,
                (array) $props
            ),
            'componentProps' => (object) $this->componentsProps,
        ], [
            'template' => [
                'id' => $this->getId(),
                'name' => $this->getName(),
                'fields' => $this->getFields()
            ],
            'this' => $this
        ]), $np);
    }

    /**
     * @return $this
     */
    public function build () {
        return $this;
    }

}