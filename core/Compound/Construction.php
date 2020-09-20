<?php


namespace Mirele\Compound;


class Construction
{
    private $name;
    private $handler;
    private $data;


    /**
     * @param mixed $data
     */
    private function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param callable $handler
     */
    public function setHandler(callable $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    public function call (array $props)
    {
        if (is_callable($this->getHandler())) {
            return call_user_func($this->handler, $props);
        }

        return false;
    }



}