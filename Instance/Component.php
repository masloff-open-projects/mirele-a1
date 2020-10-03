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
    /**
     * @var
     */
    private $alias;
    private $parent;

    /**
     * is triggered when invoking inaccessible methods in an object context.
     *
     * @param $name string
     * @param $arguments array
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public function __call($name, $arguments)
    {
    }

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke($props)
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
            'data' => $this->data,
            'meta' => $this->meta,
        );
    }


    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return $this->getProp((string) $name);
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
        $this->setProp((string) $name, (string) $value);
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
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param string $parent
     * @return Component
     */
    public function setParent(string $parent)
    {
        $this->parent = $parent;
        return $this;
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
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setProp(string $name, string $value)
    {
        $this->props[$name] = $value;
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
     * @param string $key
     * @return false|mixed
     */
    public function getProp(string $key)
    {
        if (isset($this->props[$key])) {
            return $this->props[$key];
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