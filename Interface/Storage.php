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
    public static function add ($Abstract);

    /**
     * @param $Abstract
     * @param $Data
     * @return mixed
     */
    public static function call ($Abstract, $Data);
}