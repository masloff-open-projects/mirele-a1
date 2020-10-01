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

    private $map = [];
    private $layout;
    private $id;
    private $last;

    /**
     * @param \Mirele\Compound\string $id
     * @param \Mirele\Compound\string $template
     *
     * @return $this
     */
    public function markupTemplate (string $id, string $template)
    {
        $this->layout[$id] = (object) [
            'props' => (array) [
                'name' => $template,
                'id' => $id
            ],
            'fields' => (array) []
        ];
        $this->id = $id;
        return $this;
    }

    /**
     * @return object
     */
    public function getLayout ()
    {
        return $this->layout;
    }

    /**
     * @param string $id
     * @return false|object
     */
    public function getRootInstanceById(string $id) {

        if (isset($this->layout[$id])) {
            return (object) $this->layout[$id];
        }

        return false;

    }

    /**
     * @param string $id
     * @param object $props
     * @return $this
     */
    public function setRootInstanceById(string $id, object $props) {
        $this->layout[$id] = $props;
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function removeTemplate(string $id) {
        unset($this->layout[$id]);
        return $this;
    }

    /**
     * @param string $template
     * @param string $name
     * @return bool
     */
    public function removeField(string $template, string $name) {
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
    public function getRootInstanceByIndex(integer $integer) {

        $keys = array_keys($this->layout);

        if (isset($keys[$integer])) {
            $key = $keys[$integer];
            if (isset($this->layout[$key]->fields)) {
                return (object) $this->layout[$key];
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
    public function setLayoutProps (string $id, array $props)
    {
        if (isset($this->layout[$id])) {
            $this->layout[$id]->props = (object) $props;
        }

        return $this;
    }

    public function setLayoutFields (string $id, array $fields)
    {
        if (isset($this->layout[$id])) {
            $this->layout[$id]->fields = (object) $fields;
        }

        return $this;
    }

    public function setLayoutField (string $id, string $name, $value)
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

    /**
     * @param array $templates
     * @return $this
     * @deprecated
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
     * @deprecated
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
     * @deprecated
     */
    public function addTemplateField(string $name, string $field, array $data, $duplicate = 0, $id = 0)
    {
        if (!isset($this->templates[$id][$name][$duplicate]['field'][$field])) {
            $this->templates[$id][$name][$duplicate]['field'][$field] = $data;
        }

        return $this;

    }

    /**
     * @param string $name
     * @param $data
     * @param int $duplicate
     * @return $this
     * @deprecated
     */
    public function addTemplate(string $name, $data, $duplicate = 0, $id = 0)
    {
        $this->templates[$id][$name][$duplicate] = $data;
        $this->order[] = $name;
        return $this;
    }

    /**
     * @deprecated
     * @param string $name
     * @param string $prop
     * @param $data
     * @param int $duplicate
     * @return $this
     */
    public function addTemplateProp(string $name, string $prop, $data, $duplicate = 0, $id = 0)
    {
        if (!isset($this->templates[$id][$name][$duplicate]['prop'][$prop])) {
            $this->templates[$id][$name][$duplicate]['prop'][$prop] = $data;
            $this->order[] = $name;
        }

        return $this;

    }

    /**
     * @deprecated
     * @param string $name
     * @param string $prop
     * @param $data
     * @param int $duplicate
     * @return false|mixed
     */
    public function getTemplateProp(string $name, string $prop, $data, $duplicate = 0, $id = 0)
    {
        if (isset($this->templates[$id][$name][$duplicate]['prop'][$prop])) {
            return $this->templates[$id][$name][$duplicate]['prop'][$prop];
        }

        return false;
    }

    /**
     * @deprecated
     * @param string $name
     * @param string $field
     * @return false|mixed
     */
    public function getTemplateField(string $name, string $field, $duplicate = 0, $id = 0)
    {
        if (isset($this->templates[$id][$name][$duplicate]['field'][$field])) {
            return $this->templates[$id][$name][$duplicate]['field'][$field];
        }

        return false;
    }

    /**
     * @deprecated
     * @return mixed
     */
    public function getTemplates()
    {
        return array_merge(array_flip($this->getOrders()), $this->templates);
    }

    /**
     * @deprecated
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
     * @deprecated
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