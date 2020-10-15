<?php


use Mirele\Framework\Request;

class AJAX
{

    const prefix = '\Mirele\WPAJAX\WPAJAX_';

    static private function __get_controller_name (string $controller)
    {
        return self::prefix . str_replace('/', '__', $controller);
    }

    static public function controllerExists(string $controller)
    {
        # Get controller name
        $controller = self::__get_controller_name($controller);

        # IF class exisst
        if (class_exists($controller))
        {

            # Create controller instance
            $controller = new $controller();

            # IF it do successful
            if ($controller)
            {
                return $controller instanceof Request;
            } else {
                return false;
            }
        }
    }

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