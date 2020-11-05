<?php


namespace Mirele\Compound;


use Mirele\Framework\CompoundComponent;
use Mirele\TWIG;

class Component
{

    protected $index = true;
    protected $id = null;
    protected $template = null;
    protected $name = null;
    protected $props = [];
    protected $meta = [];
    protected $alias = null;
    protected $parent = null;

    protected $construct;
    protected $created;
    protected $mounted;
    protected $middleware;

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

    public function __construct($object = false)
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
        return $this->props[$name];
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
        $this->props[(string)$name] = $value;
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
     * @param array $props
     * @return mixed
     */
    public function render(array $props)
    {

        /**
         * Create a component and initialize user events
         */

        $args = array_merge(
            (array) $this->props,
            (array) $props
        );

        /**
         * @todo this
         * @deprecated
         */
        foreach ($args as $k => $v) {
            $this->{$k} = $v;
        }

        $this->self = $args;

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

    /*
     * Getters
     */


    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return |null
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @return null
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getConstruct()
    {
        return $this->construct;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getMounted()
    {
        return $this->mounted;
    }

    /**
     * @return mixed
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

}