<?php


namespace Mirele;


use Spyc;


/**
 * Web Methods
 *
 * @method static Router get(string $route, Callable $callback)
 * @method static Router post(string $route, Callable $callback)
 * @method static Router put(string $route, Callable $callback)
 * @method static Router delete(string $route, Callable $callback)
 * @method static Router options(string $route, Callable $callback)
 * @method static Router head(string $route, Callable $callback)
 */

final class Router
{
    /**
     * @var bool
     */
    public static $halts = false;
    public static $static_dir = false;
    public static $static_uri = false;
    /**
     * @var array
     */
    public static $routes = array();
    /**
     * @var array
     */
    public static $methods = array();
    /**
     * @var array
     */
    public static $callbacks = array();
    /**
     * @var array
     */
    public static $maps = array();
    /**
     * @var string[]
     */
    public static $patterns = array(
        ':any' => '[^/]+',
        ':num' => '[0-9]+',
        ':all' => '.*'
    );
    /**
     * @var
     */
    public static $error_callback;
    /**
     * @var
     */
    public static $root;
    public static $middleware = array();

    /**
     * Loners should not be cloned.
     */

    protected function __clone() { }


    /**
     * Single units should not be recovered from lines.
     *
     * @throws Exception
     */

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    /**
     * @param $method
     * @param $params
     */
    public static function __callstatic($method, $params)
    {

        if ($method == 'map')
        {
            $maps = array_map('strtoupper', $params[0]);
            $uri = strpos($params[1], '/') === 0 ? $params[1] : '/' . $params[1];
            $callback = $params[2];
        }
        else
        {
            $maps = null;
            $uri = strpos($params[0], '/') === 0 ? $params[0] : '/' . $params[0];
            $callback = $params[1];
        }

        array_push(self::$maps, $maps);
        array_push(self::$routes, $uri);
        array_push(self::$methods, strtoupper($method));
        array_push(self::$callbacks, $callback);
    }

    /**
     * @param $callback
     */
    public static function error($callback)
    {
        self::$error_callback = $callback;
    }

    /**
     * @param bool $flag
     */
    public static function haltOnMatch($flag = true)
    {
        self::$halts = $flag;
    }

    public static function staticFiles ($uri='/public/(:all)', $path='') {

        self::$static_dir = $path;
        self::$static_uri = $uri;

        if (is_dir(self::$static_dir)) {

            # Setup router
            self::get($uri, function ($filename) {

                if(!empty($filename)) {
                    if (self::$static_dir) {

                        $file = realpath(self::$static_dir . '/' . $filename);

                        if ($file and (is_file($file) or is_dir($file))) {

                            $ignoreFile = realpath(self::$static_dir . '/.ignore');
                            $ignoreFiles = [];

                            if (file_exists($ignoreFile)) {
                                $ignoreFiles = file($ignoreFile);
                            }

                            if ($ignoreFiles != []) {
                                foreach ($ignoreFiles as $source) {
                                    if (strpos($filename, $source) === 0) {
                                        http_response_code(404);
                                        exit;
                                    }
                                }
                            }

                            if (is_file($file)) {

                                header('Content-Type: ' . mime_content_type($file));
                                http_response_code(200);

                                print file_get_contents($file);
                                exit;

                            } else if (is_dir($file)) {
                                exit;
                            }

                            exit;

                        } else {
                            http_response_code(404);
                            exit;
                        }

                    } else {
                        http_response_code(404);
                        exit;
                    }
                } else {
                    $file = realpath(self::$static_dir . '/index.html');

                    if ($file and (is_file($file) or is_dir($file))) {
                        header('Content-Type: ' . mime_content_type($file));
                        http_response_code(403);

                        print file_get_contents($file);
                        exit;
                    } else {
                        http_response_code(404);
                        exit;
                    }
                }
            });

        } else {
            return false;
        }

    }

    /**
     * @param false $uri
     */
    public static function dispatch($uri = false)
    {
        $uri = $uri ? $uri : rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) , '/');
        if (!empty(self::$root) && self::$root !== '/')
        {
            self::$root = rtrim(self::$root, '/');
            if (self::$root === $uri)
            {
                $uri = '/';
            }
            else
            {

                $uri = substr_replace($uri, '', strpos($uri, self::$root) , strlen(self::$root));
            }
        }
        $method = $_SERVER['REQUEST_METHOD'];

        $searches = array_keys(static::$patterns);
        $replaces = array_values(static::$patterns);

        if (is_array(self::getMiddlewares()) or is_object(self::getMiddlewares())) {
            foreach (self::getMiddlewares() as $middleware)
            {
                if (is_callable($middleware))
                {
                    call_user_func($middleware, $uri, $method);
                }
            }
        }

        $found_route = false;

        self::$routes = preg_replace('/\/+/', '/', self::$routes);

        if (in_array($uri, self::$routes))
        {
            $route_pos = array_keys(self::$routes, $uri);
            foreach ($route_pos as $route)
            {

                if (self::$methods[$route] == $method || self::$methods[$route] == 'ANY' || (!empty(self::$maps[$route]) && in_array($method, self::$maps[$route])))
                {
                    $found_route = true;

                    if (!is_object(self::$callbacks[$route]))
                    {

                        $parts = explode('/', self::$callbacks[$route]);

                        $last = end($parts);

                        $segments = explode('@', $last);

                        $controller = new $segments[0]();

                        $controller->{$segments[1]}();

                        if (self::$halts) return;
                    }
                    else
                    {

                        call_user_func(self::$callbacks[$route]);

                        if (self::$halts) return;
                    }
                }
            }
        }
        else
        {

            $pos = 0;
            foreach (self::$routes as $route)
            {
                if (strpos($route, ':') !== false)
                {
                    $route = str_replace($searches, $replaces, $route);
                }

                if (preg_match('#^' . $route . '$#', $uri, $matched))
                {
                    if (self::$methods[$pos] == $method || self::$methods[$pos] == 'ANY' || (!empty(self::$maps[$pos]) && in_array($method, self::$maps[$pos])))
                    {
                        $found_route = true;

                        array_shift($matched);

                        if (!is_object(self::$callbacks[$pos]))
                        {

                            $parts = explode('/', self::$callbacks[$pos]);

                            $last = end($parts);

                            $segments = explode('@', $last);

                            $controller = new $segments[0]();

                            if (!method_exists($controller, $segments[1]))
                            {
                                echo "controller and action not found";
                            }
                            else
                            {
                                call_user_func_array(array(
                                    $controller,
                                    $segments[1]
                                ) , $matched);
                            }

                            if (self::$halts) return;
                        }
                        else
                        {
                            call_user_func_array(self::$callbacks[$pos], $matched);

                            if (self::$halts) return;
                        }
                    }
                }
                $pos++;
            }
        }

        if ($found_route == false)
        {
            if (!self::$error_callback)
            {
                self::$error_callback = function ()
                {
                    header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
                    echo '404';
                };
            }
            else
            {
                if (is_string(self::$error_callback))
                {
                    self::get($_SERVER['REQUEST_URI'], self::$error_callback);
                    self::$error_callback = null;
                    self::dispatch();
                    return;
                }
            }
            call_user_func(self::$error_callback);
        }
    }


    public static function readConfigFile($src=false)
    {

        if ($src and file_exists($src)) {
            return json_decode(file_get_contents($src));
        } else {
            if (class_exists('Spyc') and file_exists(TEMPLATE_PATH . '/Router.yaml')) {
                return Spyc::YAMLLoad(TEMPLATE_PATH . '/Router.yaml');
            } else if (file_exists(TEMPLATE_PATH . '/Router.json')) {
                return json_decode(file_get_contents(TEMPLATE_PATH . '/Router.json'));
            } else {
                return false;
            }
        }

    }

    public static function plugDependencies ($name, callable $callback)
    {

        $history = [];
        $routes = self::readConfigFile();

        if (is_array($routes)) {
            foreach ($routes as $id => $route) {
                if (is_array($route)) {
                    foreach ($route as $type => $elements) {
                        foreach ($elements as $alias => $src) {

                            $glossary = array(
                                '$root' => TEMPLATE_URI,
                                '~' => $type,
                                '-> ' => $id . "-",
                                '->' => $id,
                            );

                            $src = str_replace(array_keys($glossary), array_values($glossary), $src);
                            $alias = str_replace(array_keys($glossary), array_values($glossary), $alias);

                            if ($id == $name or (is_array($name) and in_array($id, $name))) {

                                if (is_array($src)) {

                                    foreach ($src as $child_alias => $child) {
                                        $glossary['=> '] = $alias . "-";
                                        $glossary['=>'] = "$alias";

                                        $child_alias = str_replace(array_keys($glossary), array_values($glossary), $child_alias);

                                        call_user_func($callback, $id, $type, $child_alias, $child, $history);

                                        if (!isset($history[$type])) {
                                            $history[$type] = [];
                                        }

                                        array_push($history[$type], $child_alias);
                                    }

                                } else {

                                    call_user_func($callback, $id, $type, $alias, $src, $history);

                                    if (!isset($history[$type])) {
                                        $history[$type] = [];
                                    }

                                    array_push($history[$type], $alias);

                                }
                            }

                        }
                    }
                }
            }
        }

    }

    /**
     * @param bool $halts
     */
    public static function setHalts($halts)
    {
        self::$halts = $halts;
    }

    /**
     * @param array $routes
     */
    public static function setRoutes($routes)
    {
        self::$routes = $routes;
    }

    /**
     * @param array $methods
     */
    public static function setMethods($methods)
    {
        self::$methods = $methods;
    }

    /**
     * @param array $callbacks
     */
    public static function setCallbacks($callbacks)
    {
        self::$callbacks = $callbacks;
    }

    /**
     * @param array $maps
     */
    public static function setMaps($maps)
    {
        self::$maps = $maps;
    }

    /**
     * @param string[] $patterns
     */
    public static function setPatterns($patterns)
    {
        self::$patterns = $patterns;
    }

    /**
     * @param mixed $error_callback
     */
    public static function setErrorCallback($error_callback)
    {
        self::$error_callback = $error_callback;
    }

    /**
     * @param mixed $root
     */
    public static function setRoot($root)
    {
        self::$root = $root;
    }

    /**
     * @return bool
     */
    public static function isHalts()
    {
        return self::$halts;
    }

    /**
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * @return array
     */
    public static function getMethods()
    {
        return self::$methods;
    }

    /**
     * @return array
     */
    public static function getCallbacks()
    {
        return self::$callbacks;
    }

    /**
     * @return array
     */
    public static function getMaps()
    {
        return self::$maps;
    }

    /**
     * @return string[]
     */
    public static function getPatterns()
    {
        return self::$patterns;
    }

    /**
     * @return mixed
     */
    public static function getErrorCallback()
    {
        return self::$error_callback;
    }

    /**
     * @return mixed
     */
    public static function getRoot()
    {
        return self::$root;
    }

    public static function getMiddlewares()
    {
        return self::$middleware;
    }

    public static function addMiddleware(callable $middleware)
    {
        self::$middleware[] = $middleware;
    }


}

