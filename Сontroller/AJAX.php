<?php


class AJAX
{

    const prefix = '\Mirele\WPAJAX\WPAJAX_';

    static public function run (string $controller, array $props)
    {

        $controllerName = self::prefix . str_replace('/', '__', $controller);
        if (class_exists($controllerName))
        {
            $controllerObject = new $controllerName();

            $props = array_merge(
                (array) $props,
                (array) $_REQUEST,
            );

            if (method_exists($controllerObject, '__set')) {
                foreach ($props as $key => $value)
                {
                    $controllerObject->{$key} = $value;
                }
            }

            if (method_exists($controllerObject, 'handler'))
            {
                return $controllerObject->handler($_REQUEST);
            } elseif (method_exists($controllerObject, '__invoke')) {
                return $controllerObject($_REQUEST);
            }
        }

        return false;
    }

}