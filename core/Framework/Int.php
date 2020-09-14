<?php


namespace Mirele\Framework;


class Inter
{
    private static $int;

    public function __construct($int)
    {
        self::$int = floatval($int);
    }

    static public function ABS () {
        return abs(self::$int);
    }
}