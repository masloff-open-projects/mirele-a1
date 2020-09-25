<?php


namespace Mirele\Compound;


class Directive {

    private $tag;
    private $attributes;
    private $content;

    var $next;

    /**
     * @return mixed
     */
    public function getNext()
    {
        return $this->next;
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
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute(string $name)
    {

        $attr = (array) $this->attributes;

        if (isset($attr[$name])) {
            return $attr[$name];
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
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
     * @param object $attributes
     * @return $this
     */
    public function setAttributes(object $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param $next
     * @return $this
     */
    public function setNext($next)
    {
        $this->next = $next;
        return $this;
    }
}