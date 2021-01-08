<?php


namespace Mirele\Compound\Helpers;


class HTML
{

    static public function arrayToAttrs (array $array)
    {

        $attrs = "";

        foreach ($array as $key => $value) {
            $value = htmlspecialchars_decode($value);
            $attrs .= " {$key}=\"{$value}\"";
        }

        return $attrs;

    }

    static public function objectToAttrs (object $array)
    {
        return str_replace("=", '="', http_build_query((array) $array, null, '" ', PHP_QUERY_RFC3986)).'"';

    }

}