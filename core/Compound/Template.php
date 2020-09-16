<?php


namespace Mirele\Compound;


use Mirele\TWIG;


class Template
{

    private $id;
    private $name;
    private $props;
    private $components;
    private $componentsProps;
    private $twig;

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

    /**
     * @return mixed
     */
    public function setComponent(string $name, Component $component)
    {
        $this->components[$name] = $component;
        return $this;
    }

    /**
     * @param mixed $componentsProps
     */
    public function setComponentProps(string $name, array $componentsProps)
    {
        $this->componentsProps[$name] = $componentsProps;
    }

    /**
     * @return mixed
     */
    public function removeComponent(string $name)
    {
        unset($this->components[$name]);
        return $this;
    }

    /**
     * @return mixed
     */
    public function addComponent(Component $component)
    {
        $this->components[] = $component;
        return $this;
    }

    /**
     * @param mixed $twig
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
            'componentProps' => (object) $this->componentsProps
        ]), $np);
    }

    public function build () {
        return $this;
    }

}