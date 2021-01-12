<?php


namespace Mirele\Framework\ClassExtends;


class Router
{

    static private $route;

    static public function on ($path, $data)
    {
        self::$route[$path] = $data;
    }

    static public function is ($path)
    {
        return isset(self::$route[$path]);
    }

    static public function go ($path)
    {
        if (isset(self::$route[$path])) {
            return self::$route[$path];
        } else {
            return false;
        }
    }

}