<?php


namespace Mirele\Compound;


/**
 * Class Signature
 * @package Mirele\Compound
 */
class Signature
{
    /**
     * @var
     */
    private $templates;
    /**
     * @var
     */
    private $order;

    /**
     * @param array $templates
     * @return $this
     */
    public function setTemplates(array $templates)
    {
        $this->templates = $templates;
        return $this;
    }

    /**
     * @param string $name
     * @param object $props
     * @param int $duplicate
     * @return $this
     */
    public function setTemplateProps(string $name, object $props, $duplicate = 0)
    {
        $this->templates[$name][$duplicate]['prop'] = $props;
        return $this;
    }

    /**
     * @param string $name
     * @param string $field
     * @param array $data
     * @param int $duplicate
     * @return $this
     */
    public function addTemplateField(string $name, string $field, array $data, $duplicate = 0)
    {
        if (!isset($this->templates[$name][$duplicate]['field'][$field])) {
            $this->templates[$name][$duplicate]['field'][$field] = $data;
        }

        return $this;

    }

    /**
     * @param string $name
     * @param $data
     * @param int $duplicate
     * @return $this
     */
    public function addTemplate(string $name, $data, $duplicate = 0)
    {
        $this->templates[$name][$duplicate] = $data;
        $this->order[] = $name;
        return $this;
    }

    /**
     * @param string $name
     * @param string $prop
     * @param $data
     * @param int $duplicate
     * @return $this
     */
    public function addTemplateProp(string $name, string $prop, $data, $duplicate = 0)
    {
        if (!isset($this->templates[$name][$duplicate]['prop'][$prop])) {
            $this->templates[$name][$duplicate]['prop'][$prop] = $data;
            $this->order[] = $name;
        }

        return $this;

    }

    /**
     * @param string $name
     * @param string $prop
     * @param $data
     * @param int $duplicate
     * @return false|mixed
     */
    public function getTemplateProp(string $name, string $prop, $data, $duplicate = 0)
    {
        if (isset($this->templates[$name][$duplicate]['prop'][$prop])) {
            return $this->templates[$name][$duplicate]['prop'][$prop];
        }

        return false;
    }

    /**
     * @param string $name
     * @param string $field
     * @return false|mixed
     */
    public function getTemplateField(string $name, string $field, $duplicate = 0)
    {
        if (isset($this->templates[$name][$duplicate]['field'][$field])) {
            return $this->templates[$name][$duplicate]['field'][$field];
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getTemplates()
    {
        return array_merge(array_flip($this->getOrders()), $this->templates);
    }

    /**
     * @param string $name
     * @return false|mixed
     */
    public function getTemplate(string $name)
    {
        if (isset($this->templates[$name])) {
            return $this->templates[$name];
        }

        return false;
    }

    /**
     * @param false $sort
     * @return array
     */
    public function getOrders($sort=false)
    {

        # Sort the array if necessary.
        # Sorting is usually accepted
        # for human-oriented data generation.
        if ($sort) {
            $sorted = $this->order;
            ksort($sorted);
        }

        return (array) (isset($sorted) ? $sorted : $this->order);
    }

}