<?php


namespace Mirele\Compound;


use Mirele\TWIG;


class Template
{

    private $id;
    private $name;
    private $props;
    private $components;
    private $fields;
    private $componentsProps;
    private $twig;

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