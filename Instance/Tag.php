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
     * @param string $tag
     * @return $this
     */
    public function setTag(string $tag)
    {
        $this->tag = $tag;
        return $this;
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
     * @param mixed $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getTag()
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

}