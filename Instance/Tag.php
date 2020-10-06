<?php


namespace Mirele\Compound;


/**
 * Class Tag
 * @package Mirele\Compound
 */
class Tag
{

    /**
     * @var
     */
    private $tag;
    /**
     * @var
     */
    private $essence;
    /**
     * @var
     */
    private $reference;
    /**
     * @var
     */
    private $attributes;

    /**
     * @param string $name
     * @param $value
     * @return $this
     */
    public function setAttribute(string $name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param string $name
     * @return false|mixed
     */
    public function getAttribute(string $name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return mixed
     * @deprecated
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function setTag(string $tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTagName()
    {
        return $this->tag;
    }

    /**
     * @return mixed
     */
    public function getEssence()
    {
        return $this->essence;
    }

    /**
     * @param $essence
     * @return $this
     */
    public function setEssence($essence)
    {
        $this->essence = $essence;
        return $this;
    }

}