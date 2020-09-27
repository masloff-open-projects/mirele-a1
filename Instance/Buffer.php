<?php


namespace Mirele\Framework;


class Buffer
{
    private $buffer = array();
    private $namespace = "*";

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = (string) $namespace;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param $data
     * @param $key
     * @return int
     */
    public function append($data, $key=false)
    {
        if (!isset($this->buffer[$this->getNamespace()])) {
            $this->buffer[$this->getNamespace()] = array();
        }

        if ($key) {
            return array_push($this->buffer[$this->getNamespace()], (object) [
                'key'  => $key,
                'data' => $data
            ]);
        } else {
            return array_push($this->buffer[$this->getNamespace()], $data);
        }
    }

    /**
     * @return array
     */
    public function getBuffer($namespace='*')
    {
        if ($namespace === 'all') {
            return $this->buffer;
        } else {
            return isset($this->buffer[$namespace]) ? $this->buffer[$namespace] : false;
        }
    }


    /**
     * @return array
     */
    public function toString($namespace='*', $separator="\n")
    {
        if ($namespace === 'all') {
            return join($separator, $this->buffer);
        } else {
            return isset($this->buffer[$namespace]) ? join($separator, $this->buffer[$namespace]) : false;
        }
    }



    public function clearBuffer () {
        return $this->buffer = array();
    }

}