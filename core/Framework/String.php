<?php


namespace Mirele\Framework;


final class Stringer
{

    private static $string;

    public function __construct(string $string)
    {
        self::$string = $string;
    }

    static public function format (array $array) {
        return str_replace(array_keys($array), array_values($array), self::$string);
    }

}