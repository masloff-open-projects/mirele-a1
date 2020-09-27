<?php


namespace Mirele\Framework;


/**
 * Interface Storage
 * @package Mirele\Framework
 */
interface Storage
{
    /**
     * @param $Abstract
     * @return mixed
     */
    static public function add ($Abstract);

    /**
     * @param $Abstract
     * @param $Data
     * @return mixed
     */
    static public function call ($Abstract, $Data);
}