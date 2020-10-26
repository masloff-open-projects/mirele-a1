<?php


namespace Mirele\Compound;


use Mirele\TWIG;

/**
 * Class Component
 * @package Mirele\Compound
 */
class Component
{

    private $index = true;
    /**
     * @var
     */
    private $id;
    private $template;
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
    private $handlers;
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

    /* ACTIONS */
    private $construct;
    private $created;
    private $mounted;

    private function __call_construct ()
    {
        if (is_callable($this->construct)) {
            return call_user_func($this->construct, $this);
        } else {
            return false;
        }
    }

    private function __call_created ()
    {
        if (is_callable($this->created)) {
            return call_user_func($this->created, $this);
        } else {
            return false;
        }
    }

    private function __call_mounted ()
    {
        if (is_callable($this->mounted)) {
            return call_user_func($this->mounted, $this);
        } else {
            return false;
        }
    }

    function __construct($object = false)
    {
        if (is_array($object) or is_object($object)) {

            $object = (object) $object;

            if (isset($object->data)) {

                foreach ($object->data as $name => $value) {
                    $this->{$name} = $value;
                }

            }

            if (isset($object->construct)) {
                $this->construct = $object->construct;
            }

            if (isset($object->created)) {
                $this->created = $object->created;
            }

            if (isset($object->mounted)) {
                $this->mounted = $object->mounted;
            }

            if (isset($object->template)) {
                $this->template = $object->template;
            }

            Store::add($this);

            $this->__call_construct();

        }

    }

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
        return $this->output($props);
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
        return $this->getProp((string)$name);
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
        $this->setProp((string)$name, (string)$value);
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
     * @return bool
     */
    public function isIndex()
    {
        return $this->index;
    }

    /**
     * @param boolean $index
     * @return Component
     */
    public function setIndex(bool $index)
    {
        $this->index = $index;
        return $this;
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
        $this->id = (string)$id;
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
        $this->props = (array)$props;
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

    public function setHandler($action, callable $function)
    {
        if (!empty($action) and $action) {
            if (is_callable($function)) {
                $this->handlers[$action] = $function;
                return $this;
            } else {
                throw new \Exception("You're not passing on a function");
            }
        } else {
            throw new \Exception("The name of the processor cannot be empty");
        }
    }

    /**
     * @param array $props
     * @return mixed
     */
    public function render(array $props)
    {

        /**
         * Create a component and initialize user events
         */
        $this->setProps(array_merge(
            (array) $this->props,
            (array) $props
        ));

        $this->__call_created();

        /**
         * Render
         */
        if (!empty($this->getTemplate())) {

            $promise = TWIG::Render($this->getTemplate(), $this->props);
            $this->__call_mounted();
            return $promise;

        } else {
//            throw new \Exception('Template for the component is not specified' . $this->getTemplate());
        }

    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return Component
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return Component
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMounted()
    {
        return $this->mounted;
    }

    /**
     * @param mixed $mounted
     * @return Component
     */
    public function setMounted($mounted)
    {
        $this->mounted = $mounted;
        return $this;
    }


    /**
     * @return $this
     */
    public function build()
    {
        return $this;
    }

}