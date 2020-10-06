<?php


namespace Mirele\Framework;


/**
 * Class Inter
 * @package Mirele\Framework
 */
class Inter
{
    /**
     * @var float
     */
    private static $int;

    /**
     * Inter constructor.
     * @param $int
     */
    public function __construct($int)
    {
        self::$int = floatval($int);
    }

    /**
     * @return float|int
     */
    public static function ABS()
    {
        return abs(self::$int);
    }
}