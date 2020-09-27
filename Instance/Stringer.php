<?php


namespace Mirele\Framework;


/**
 * Class Stringer
 * @package Mirele\Framework
 */
final class Stringer
{

    /**
     * @var string
     */
    private static $string;

    /**
     * Stringer constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        self::$string = $string;
    }

    /**
     * @param array $array
     * @return string|string|string[]
     */
    static public function format (array $array) {
        return str_replace(array_keys($array), array_values($array), self::$string);
    }

    /**
     * @param $string
     * @return string
     */
    public static function get($string)
    {
        return (self::$string).$string;
    }

}