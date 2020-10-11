<?php


namespace Mirele\Compound;


/**
 * Class Signature
 * @package Mirele\Compound
 */
class Layout
{

    /**
     * @var array
     */
    protected $map = array();
    /**
     * @var array
     */
    protected $layout = array();
    /**
     * @var string
     */
    protected $last = "";
    /**
     * @var string
     */
    protected $id = "";

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct()
    {
    }

    /**
     * PHP 5 introduces a destructor concept similar to that of other object-oriented languages, such as C++.
     * The destructor method will be called as soon as all references to a particular object are removed or
     * when the object is explicitly destroyed or in any order in shutdown sequence.
     *
     * Like constructors, parent destructors will not be called implicitly by the engine.
     * In order to run a parent destructor, one would have to explicitly call parent::__destruct() in the destructor body.
     *
     * Note: Destructors called during the script shutdown have HTTP headers already sent.
     * The working directory in the script shutdown phase can be different with some SAPIs (e.g. Apache).
     *
     * Note: Attempting to throw an exception from a destructor (called in the time of script termination) causes a fatal error.
     *
     * @return void
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __destruct()
    {
        $this->layout = array();
        $this->map = array();
        $this->last = null;
        $this->id = null;
    }

    /**
     * is triggered when invoking inaccessible methods in a static context.
     *
     * @param $name string
     * @param $arguments array
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
    }

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return boolean
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return false;
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param $name string
     * @param $value mixed
     * @return boolean
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __set($name, $value)
    {
        return false;
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
        return false;
    }

    /**
     * is invoked when unset() is used on inaccessible members.
     *
     * @param $name string
     * @return boolean
     * @link https://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __unset($name)
    {
        return false;
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return false|string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return json_encode($this->layout);
    }

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke($data)
    {
        return $data;
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
        return (array)$this->layout;
    }

    /**
     * When an object is cloned, PHP 5 will perform a shallow copy of all of the object's properties.
     * Any properties that are references to other variables, will remain references.
     * Once the cloning is complete, if a __clone() method is defined,
     * then the newly created object's __clone() method will be called, to allow any necessary properties that need to be changed.
     * NOT CALLABLE DIRECTLY.
     *
     * @return $this
     * @link https://php.net/manual/en/language.oop5.cloning.php
     */
    public function __clone()
    {
        $this->id = null;
        $this->last = null;

        return $this;
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
        return false;
    }

    /**
     * @param string $id
     * @param string $template
     *
     * @return $this
     */
    public function markupTemplate(string $id, string $template)
    {
        $this->layout[$id] = (object)[
            'props' => (array)[
                'name' => $template,
                'id' => $id
            ],
            'fields' => (array)[]
        ];
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getLayout()
    {
        return (array)$this->layout;
    }

    /**
     * @param string $id
     * @return false|object
     */
    public function getRootInstanceById(string $id)
    {

        if (isset($this->layout[$id])) {
            return (object)$this->layout[$id];
        }

        return false;

    }

    /**
     * @param string $id
     * @param object $props
     * @return $this
     */
    public function setRootInstanceById(string $id, object $props)
    {
        $this->layout[$id] = $props;
        return $this;
    }

    /**
     * @param array $prototypes
     * @return $this
     */
    public function prototypeIDsBasedSorting(array $prototypes)
    {
        $sort = [];
        foreach ($prototypes as $id) {
            if (isset($this->layout[$id])) {
                $sort[$id] = $this->layout[$id];
            }
        }
        $this->layout = (array)$sort;
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function removeTemplate(string $id)
    {
        unset($this->layout[$id]);
        return $this;
    }

    /**
     * @param string $template
     * @param string $name
     * @return bool
     */
    public function removeField(string $template, string $name)
    {
        if (isset($this->layout[$template]->fields)) {
            unset($this->layout[$template]->fields[$name]);
            return true;
        }
        return false;
    }

    /**
     * @param integer $integer
     * @return false|mixed
     */
    public function getRootInstanceByIndex(integer $integer)
    {

        $keys = array_keys($this->layout);

        if (isset($keys[$integer])) {
            $key = $keys[$integer];
            if (isset($this->layout[$key]->fields)) {
                return (object)$this->layout[$key];
            }
        }

        return false;

    }

    /**
     * @param string $id
     * @param array $props
     *
     * @return $this
     */
    public function setLayoutProps(string $id, array $props)
    {
        if (isset($this->layout[$id])) {
            $this->layout[$id]->props = (object)$props;
        }

        return $this;
    }

    public function updateLayoutProps(string $id, array $props)
    {
        if (isset($this->layout[$id])) {
            $templateProps = (array)$this->layout[$id]->props;
            foreach ($props as $key => $value) {
                $templateProps[$key] = $value;
            }
            return $this->setLayoutProps($id, $templateProps);
        }

        return $this;
    }

    public function getLayoutProps(string $id)
    {
        if (isset($this->layout[$id]) and isset($this->layout[$id]->props)) {
            return $this->layout[$id]->props;
        }

        return $this;
    }

    /**
     * @param string $id
     * @param array $fields
     * @return $this
     */
    public function setLayoutFields(string $id, array $fields)
    {
        if (isset($this->layout[$id])) {
            $this->layout[$id]->fields = (object)$fields;
        }

        return $this;
    }

    /**
     * @param string $id
     * @param string $name
     * @param $value
     * @return $this
     */
    public function setLayoutField(string $id, string $name, $value)
    {
        if (isset($this->layout[$id])) {
            $this->layout[$id]->fields[$name] = $value;
        }

        return $this;
    }

    /**
     * @param $last
     *
     * @return $this
     */
    private function setLast($last)
    {
        $this->last = $last;
        return $this;
    }

}