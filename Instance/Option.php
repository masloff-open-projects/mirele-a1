<?php


namespace Mirele\Framework;


/**
 * Class Option
 * @package Mirele\Framework
 */
class Option
{
    /**
     * @var string
     */
    private $namespace = '*';
    /**
     * @var string
     */
    private $type = 'toggle';
    /**
     * @var string
     */
    private $name = '';
    /**
     * @var string
     */
    private $default = 'false';
    /**
     * @var string
     */
    private $description = '';
    /**
     * @var string
     */
    private $title = '';
    /**
     * @var array
     */
    private $props = [];
    /**
     * @var bool
     */
    private $warning = false;

    /**
     * @param array $warning
     */
    public function setWarning(array $warning)
    {
        $this->warning = (object)$warning;
        return $this;
    }

    /**
     * @return array
     */
    public function getWarning()
    {
        return $this->warning;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
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
     * @return array
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = (new Stringer($namespace))::format([
            '{NAME}' => $this->name,
            '{TYPE}' => $this->type,
            '{DEFAULT}' => $this->default,
        ]);
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|bool|array|integer|float $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return object
     */
    public function build()
    {
        return (object)[
            'namespace' => $this->namespace,
            'title' => $this->title,
            'name' => $this->name,
            'warning' => $this->warning,
            'type' => $this->type,
            'default' => $this->default,
            'description' => $this->description,
            'props' => (object)$this->props,
            'value' => get_option($this->name, $this->default)
        ];
    }

}