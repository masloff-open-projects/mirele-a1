<?php


namespace Mirele\Compound;


class Signature
{
    private $templates;

    /**
     * @param mixed $templates
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;
    }

    public function addTemplate(string $name, $data, $duplicate = 0)
    {
        $this->templates[$name][$duplicate] = $data;
    }


    /**
     * @param string $name
     * @param string $field
     * @param $data
     * @param int $duplicate
     */
    public function addTemplateField(string $name, string $field, $data, $duplicate = 0)
    {
        if (!isset($this->templates[$name][$duplicate]['field'][$field])) {
            $this->templates[$name][$duplicate]['field'][$field] = $data;
        }
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
        return $this->templates;
    }

}