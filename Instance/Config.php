<?php


namespace Mirele\Compound;


class Config
{

    private $data;

    /**
     * Config constructor.
     */
    function __construct() {
        $this->data = [];
    }

    /**
     * @param string $key
     * @param $data
     * @return $this
     */
    public function setData(string $key, $data)
    {
        if (!isset($this->data[$key])) {
            $this->data[$key] = $data;
        }

        return $this;
    }

    /**
     * @param $key
     * @return false|mixed
     */

    public function getData($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return false;
    }

}