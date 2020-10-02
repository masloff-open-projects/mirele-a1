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
     * @var
     */
    private $type;
    /**
     * @var
     */
    private $alias;

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return $this->getProp($name);
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param $name string
     * @param $value mixed
     * @return void
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __set($name, $value)
    {
        $this->setProp((string) $name, $value);
    }

    /**
     * is triggered by calling isset() or empty() on inaccessible members.
     *
     * @param $name string
     * @return bool
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __isset($name)
    {
        return isset($this->props[$name]);
    }

    /**
     * is invoked when unset() is used on inaccessible members.
     *
     * @param $name string
     * @return void
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __unset($name)
    {
        unset($this->props[$name]);
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return (string) json_encode($this->props);
    }

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(array $props)
    {
        return $this->render($props);
    }

    /**
     * This method is called by var_dump() when dumping an object to get the properties that should be shown.
     * If the method isn't defined on an object, then all public, protected and private properties will be shown.
     * @return array
     * @since 5.6
     *
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo
     */
    public function __debugInfo()
    {
        return array(
            'alias' => $this->alias,
            'name' => $this->name,
            'id' => $this->id,
            'props' => $this->props,
            'type' => $this->type,
            'meta' => $this->meta,
        );
    }


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
    public function getComponentsProps()
    {
        return $this->componentsProps;
    }

    /**
     * @param mixed $componentsProps
     * @return Template
     */
    public function setComponentsProps($componentsProps)
    {
        $this->componentsProps = $componentsProps;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Template
     */
    public function setType(string $type)
    {
        $this->type = $type;
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
        if (!is_callable($this->handler)) {
            $this->handler = $handler;
        }
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
     * @param string $name
     * @param $value
     * @return $this
     */
    public function setProp(string $name, $value)
    {
        $this->props[$name] = $value;
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
     * @return mixed
     */
    public function getComponents()
    {
        return $this->components;
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

        # Standart
        $components = [
            'input' => Store::get('@input'),
            'button' => Store::get('@button'),
            'label' => Store::get('@label'),
        ];

        # Render
        return TWIG::Render($this->twig, array_merge((array) $this->props, (array) $props, (array) $components, (array) $this->components, [
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