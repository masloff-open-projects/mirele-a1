<?php

/**
 * Hammer&Wrench is a tool for debugging
 * and developing modules, templates,
 * components for Mirele.
 *
 * @see https://github.com/irtex-mirele/Hammer-Wrench
 * @package HammerWrench
 * @version 1.0.0-alpha
 */

namespace HammerWrench;

use Mirele\Compound\Grider;
use Mirele\Compound\Market;
use Mirele\Router;
use PHPMailer\PHPMailer\Exception;
use TypeError;

# Init
defined('MIRELE_DEBUG_DIR') or define('MIRELE_DEBUG_DIR', dirname(__FILE__) . '/.Debug');
is_dir(MIRELE_DEBUG_DIR) or mkdir(MIRELE_DEBUG_DIR);

/**
 * Interface Constructor
 * @package HammerWrench
 */
interface Constructor
{

}

/**
 * Interface Generator
 * @package HammerWrench
 */
interface Generator
{

    /**
     * Generator constructor.
     * @param array $paths
     * @param string $file
     */
    public function __construct($paths = [], $file = "");
}


/**
 * Class LoggerColor
 * @package HammerWrench
 */
class LoggerColor
{

    /**
     * Glossary of color palette
     */
    const F_COLORS = array(
        'black'        => '0;30',
        'dark_gray'    => '1;30',
        'blue'         => '0;34',
        'light_blue'   => '1;34',
        'green'        => '0;32',
        'light_green'  => '1;32',
        'cyan'         => '0;36',
        'light_cyan'   => '1;36',
        'red'          => '0;31',
        'light_red'    => '1;31',
        'purple'       => '0;35',
        'light_purple' => '1;35',
        'brown'        => '0;33',
        'yellow'       => '1;33',
        'light_gray'   => '0;37',
        'white'        => '1;37',
        'transparent'  => null);

    /**
     * Glossary of color palette
     */
    const B_COLORS = array(
        'black'       => '40',
        'red'         => '41',
        'green'       => '42',
        'yellow'      => '43',
        'blue'        => '44',
        'magenta'     => '45',
        'cyan'        => '46',
        'light_gray'  => '47',
        'transparent' => null);

    /**
     * @param string $string
     * @param null $font_color
     * @param null $bg_color
     * @return string
     */
    protected function print_c($string = "", $font_color = null, $bg_color = null)
    {
        $colored_string = "";

        $colors = [
            self::F_COLORS,
            self::B_COLORS];

        if (isset($colors[0][$font_color]))
        {
            $colored_string .= "\033[".$colors[0][$font_color]."m";
        }

        if (isset($colors[1][$bg_color]))
        {
            $colored_string .= "\033[".$colors[1][$bg_color]."m";
        }

        $colored_string .= $string."\033[0m";

        return $colored_string;

    }

}

class Tree {

    private $text = "";
    private $indent = 0;
    
    private function __inside ($tree__) {

        foreach ((array) $tree__ as $key => $value){
            if(is_array($value) or is_object($value)){
                $this->text .= "\n ├" . str_repeat("─", $this->indent) . " $key: ";
                $this->indent++;
                $this->__inside($value);
                $this->indent--;

            } else{
                $this->text .= "\n ├" . str_repeat("─", $this->indent) . " $key: " . $value;
            }
        }
    }
    
    public function render ($tree,  $title='Tree') {

        $this->text = " ┌ [$title] ";
        $this->__inside($tree);
        return $this->text;

    }

}

/**
 * Class Logger
 * @package HammerWrench
 */
class Logger extends LoggerColor
{

    const STATUS = [
        'x7d744' => [
            'name'       => 'ERROR',
            'font_color' => 'red',
            'bg_color'   => 'transparent'],
        'x7d734' => [
            'name'       => 'COMPILED',
            'font_color' => 'green',
            'bg_color'   => 'transparent'],
        'x7d721' => [
            'name'       => 'COMPILATION ERROR',
            'font_color' => 'red',
            'bg_color'   => 'transparent'],
        'x7d764' => [
            'name'       => 'COMPILATION WARNING',
            'font_color' => 'yellow',
            'bg_color'   => 'transparent'],
        'x6d163' => [
            'name'       => 'INFO',
            'font_color' => 'gray',
            'bg_color'   => 'transparent'],

    ];

    /**
     * @param string $status
     * @param $text
     */
    public function log($status, $text, $font = [
        'gray',
        null])
    {
        if (isset(self::STATUS[$status]['name']))
        {
            $status = $this->print_c(self::STATUS[$status]['name'], self::STATUS[$status]['font_color'], self::STATUS[$status]['bg_color']);
            return sprintf("[%s] %s\n", $status, $this->print_c($text, $font[0], $font[1]));
        } else
        {
            throw new Exception('Transmitted type not found');
        }
    }

    /**
     * @param $status
     * @param $text
     * @param array $font
     * @throws Exception
     */
    final public function printf($status, $text, $font = [
        'gray',
        null])
    {
        echo $this->log($status, $text, $font);
    }

    /**
     * @param string $string
     * @param null $font_color
     * @param null $bg_color
     * @return string
     */
    final public function print_c($string = "", $font_color = null, $bg_color = null)
    {
        return parent::print_c($string, $font_color, $bg_color);
    }

}

/**
 * Class ARGV
 * @package HammerWrench
 */
class ARGV
{

    /**
     * @var array
     */
    static protected $arg = [];

    /**
     * @param $arg
     * @param callable $handler
     * @param array $meta
     */
    static public function register($arg, callable $handler, array $meta)
    {
        self::$arg[$arg] = [
            $handler,
            $meta];
    }

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    static public function call($argv)
    {
        foreach (array_values($argv) as $arg)
        {
            if (isset(self::$arg[$arg]))
            {
                if (is_callable(self::$arg[$arg][0]))
                {
                    call_user_func(self::$arg[$arg][0], $argv);
                } else
                {
                    throw new TypeError('The object is not a function ');
                }
            }

        }
    }

    /**
     * @return array
     */
    public static function glossary()
    {
        return self::$arg;
    }

}


/**
 * Class PHP
 *
 * PHP code constructor
 * @package HammerWrench
 */
class PHP implements Constructor
{

    /**
     * @var int
     */
    protected $indent = 0;

    /**
     * @param string $name
     * @param string[] $props
     * @param string $content
     * @return string
     */
    protected function __function($name = "undefined", $props = ['$name'], $content = "")
    {

        $indent = str_repeat("  ", $this->indent);
        $indentContent = str_repeat("  ", $this->indent + 1);
        $props = join(', ', $props);
        return "{$indent}function {$name} ({$props})\n{$indent}{\n{$indentContent}{$content}\n{$indent}}\n";

    }

    /**
     * @param string $name
     * @param string $content
     * @return string
     */
    protected function __define($name = "undefined", $content = "")
    {

        $indent = str_repeat("  ", $this->indent);
        return "{$indent}define (\"{$name}\", {$content});\n";

    }

    /**
     * @param string $content
     * @return string
     */
    protected function __comment($content = "")
    {

        $indent = str_repeat("  ", $this->indent);
        return "{$indent}# {$content}\n";

    }

    /**
     * @param string $name
     * @param string $content
     * @return string
     */
    protected function __var($name = "undefined", $content = "")
    {

        $indent = str_repeat("  ", $this->indent);
        return "{$indent}\${$name} = {$content};\n";

    }

    /**
     * @param string $expression
     * @param string $then
     * @param string $else
     * @return string
     */
    protected function __if($expression = "undefined", $then = "", $else = "")
    {

        $indent = str_repeat("  ", $this->indent);
        $indentContent = str_repeat("  ", $this->indent + 1);

        return "{$indent}if ({$expression}) {\n{$indentContent}{$then}\n{$indent}} else {\n{$indentContent}{$else}\n{$indent}}\n";

    }

    /**
     * @param string $return
     * @param array $content
     * @return string
     */
    protected function __array($return = "", $content = [])
    {

        $indent = str_repeat("  ", $this->indent);
        $indentContent = str_repeat("  ", $this->indent + 1);
        $_ = "{$indent}{$return}array (\n";
        foreach ($content as $key => $value)
        {
            $_ .= "{$indentContent}'{$key}' => {$value},\n";
        }
        $_ .= ");\n";

        return $_;

    }

}

/**
 * Class Autoloader
 *
 * Generator of the classic Autoload, the heir to Vendor
 * @package HammerWrench
 */
class Autoloader extends PHP implements Generator
{

    /**
     * Autoloader constructor.
     *
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * @param array $paths
     * @param string $file
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct($paths = [], $file = "")
    {

        # Define
        $uid = rand(100000, 900000);

        # Define
        $define = join("", [
            $this->__comment("Creating a virtual environment of constants"),
            $this->__define("AUTOLOADER_ID_{$uid}", "'ID{$uid}'"),
            $this->__define("AUTOLOADER_PATH_{$uid}", "dirname (__FILE__)")]);

        # ...
        $loader = join("", [
            $this->__comment("Initialization of module connection function"),
            $this->__function("__autoloader_ID{$uid}", [
                "\$file"], join("", [
                $this->__var("__path__", "TEMPLATE_PATH . '/' . \$file"),
                ($this->indent++ ? "" : ""),
                $this->__if('file_exists($__path__) and is_file($__path__) and is_readable($__path__)', 'return require_once $__path__;', 'return wp_die ("File (\'$__path__\') not found, but required as this is a module");'),
                ($this->indent-- ? "" : ""),]))]);

        # Compiller
        $modules = [];
        foreach ($paths as $path)
        {
            foreach (glob($path) as $module)
            {
                $modules[rand(1000010000, 8000010000).":{$uid}"] = "__autoloader_ID{$uid} (\"{$module}\")";
            }
        }

        $vendor = $this->__array('return ', $modules);

        file_put_contents($file, join("\n", [
            "<?php",
            $define,
            $loader,
            $vendor]));

    }

}

class Networker extends PHP implements Generator
{

    /**
     * Autoloader constructor.
     *
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * @param array $paths
     * @param string $file
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct($paths = [], $file = "")
    {

        # Define
        $uid = rand(100000, 900000);

        # Define
        $define = join("", [
            $this->__comment("Creating a virtual environment of constants"),
            $this->__define("AUTOLOADER_ID_{$uid}", "'ID{$uid}'"),
            $this->__define("AUTOLOADER_PATH_{$uid}", "dirname (__FILE__)")]);

        # ...
        $loader = join("", [
            $this->__comment("Initialization of module connection function"),
            $this->__function("__autoloader_ID{$uid}", [
                "\$file"], join("", [
                $this->__var("__path__", "TEMPLATE_PATH . '/' . \$file"),
                ($this->indent++ ? "" : ""),
                $this->__if('file_exists($__path__) and is_file($__path__) and is_readable($__path__)', 'return require_once $__path__;', 'return wp_die ("File (\'$__path__\') not found, but required as this is a module");'),
                ($this->indent-- ? "" : ""),]))]);

        # Compiller
        $modules = [];
        foreach ($paths as $path)
        {
            foreach (glob($path) as $module)
            {
                $modules[rand(1000010000, 8000010000).":{$uid}"] = "__autoloader_ID{$uid} (\"{$module}\")";
            }
        }

        $vendor = $this->__array('return ', $modules);

        file_put_contents($file, join("\n", [
            "<?php",
            $define,
            $loader,
            $vendor]));

    }

}

/**
 * CLI
 */
if ($argv)
{
    global $project;
    global $staticenv;

    $meta = (object) [
        'documentation' => 'https://github.com/irtex-mirele/Hammer-Wrench'
    ];

    if (!file_exists(dirname(__FILE__) . '/project.json'))
    {
        $logger_cli = new Logger();
        return $logger_cli->printf('x7d744', "Launch of the utility is aborted. The 'project.json' file is not found. Documentation: {$meta->documentation}", ['red', null]);
    }

    $project = json_decode(file_get_contents(dirname(__FILE__) . '/project.json'));

    if (!isset($project->HammerWrench))
    {
        $logger_cli = new Logger();
        return $logger_cli->printf('x7d744', "The 'HammerWrench' key was not found in the project static environment file (project.json). Documentation: {$meta->documentation}", ['red', null]);
    }

    $staticenv = (object) $project->HammerWrench;

    ARGV::register('--binders', function () {

        global $staticenv;

        $logger_cli = new Logger();

        # Print META information
        $logger_cli->printf('x6d163', "Start compilation ...", ['green', null]);
        $logger_cli->printf('x6d163', "Initializing file include priorities  ...", ['blue', null]);

        # Init env pkg
        $pkg = (array) $staticenv->binders;

        foreach ($pkg['masks'] as $priority => $mask)
        {
            $priority++;

            $path = [
              count(glob($mask))
            ];

            $logger_cli->printf('x6d163', "Priority: {$priority} ⸺  {$mask} ({$path[0]} items)");
        }

        if (new Autoloader($pkg['masks'], $pkg['output']))
        {
            $logger_cli->printf('x6d163', "Output: {$pkg['output']}", ['white', null]);
            $logger_cli->printf('x7d734', "The compilation of autolaoder was a success");
        }

    }, ['Compilation of all types `binders`: templates, components, modules. Creates autoloader.php files, heirs of vendor.php']);

    ARGV::register('--Compound', function () {

        global $staticenv;

        $logger_cli = new Logger();

        # Print META information
        $logger_cli->printf('x6d163', "Start compilation ...", ['green', null]);
        $logger_cli->printf('x6d163', "Initializing file include priorities  ...", ['blue', null]);

        # Init env pkg
        $pkg = (array) $staticenv->compound;

        foreach ($pkg['masks'] as $priority => $mask)
        {
            $priority++;

            $path = [
              count(glob($mask))
            ];

            $logger_cli->printf('x6d163', "Priority: {$priority} ⸺  {$mask} ({$path[0]} items)");
        }

        if (new Autoloader($pkg['masks'], $pkg['output']))
        {
            $logger_cli->printf('x6d163', "Output: {$pkg['output']}", ['white', null]);
            $logger_cli->printf('x7d734', "The compilation of autolaoder was a success");
        }

    }, ['Compiles the autoloader file of all modules of the compund framework']);

    ARGV::register('--network', function () {

        global $staticenv;

        $logger_cli = new Logger();

        # Print META information
        $logger_cli->printf('x6d163', "Start compilation ...", ['green', null]);
        $logger_cli->printf('x6d163', "Initializing file include priorities  ...", ['blue', null]);

        # Init env pkg
        $pkg = (array) $staticenv->network;

        foreach ($pkg['masks'] as $priority => $mask)
        {
            $priority++;

            $path = [
              count(glob($mask))
            ];

            $logger_cli->printf('x6d163', "Priority: {$priority} ⸺  {$mask} ({$path[0]} items)");
        }

        if (new Autoloader($pkg['masks'], $pkg['output']))
        {
            $logger_cli->printf('x6d163', "Output: {$pkg['output']}", ['white', null]);
            $logger_cli->printf('x7d734', "The compilation of autolaoder was a success");
        }

    }, ['Creates and connects network request handlers']);

    ARGV::register('--help', function () {

        $mask = str_repeat('─', 19)."┼".str_repeat('─', 42)."\n%18.18s │ %s\n";

        foreach (ARGV::glossary() as $arg => $pkg)
        {
            printf($mask, $arg, join("\n", $pkg[1]));
        }

    }, ['Screen output about commands']);

    ARGV::register('--monitor.network', function ($argv) {

        $logger_cli = new Logger();

        $object = json_decode(file_get_contents(MIRELE_DEBUG_DIR . '/network.json'));

        foreach ($object as $request) {
            print $logger_cli->print_c("[{$request->REQUEST_METHOD}]", 'yellow', null) .
                  $logger_cli->print_c(" {$request->REQUEST_URI} ", 'white', null) .
                  $logger_cli->print_c("({$request->REQUEST_TIME})", 'white', null) .
                  ((isset($request->_REQUEST) and in_array('--monitor.body', $argv)) ? $logger_cli->print_c(sprintf("\n%s\n", json_encode($request->_REQUEST, JSON_PRETTY_PRINT)), 'white', null) : '').
                  PHP_EOL;
        }

    }, ['Shows map printout of web requests routed through internal router']);

    ARGV::register('--watch.errors', function ($argv) {

        // TODO
        $logger_cli = new Logger();

        $object = json_decode(file_get_contents(MIRELE_DEBUG_DIR . '/errors.json'));

//        foreach ($object as $request) {
//            print $logger_cli->print_c("[{$request->REQUEST_METHOD}]", 'yellow', null) .
//                  $logger_cli->print_c(" {$request->REQUEST_URI} ", 'white', null) .
//                  $logger_cli->print_c("({$request->REQUEST_TIME})", 'white', null) .
//                  ((isset($request->_REQUEST) and in_array('--monitor.body', $argv)) ? $logger_cli->print_c(sprintf("\n%s\n", json_encode($request->_REQUEST, JSON_PRETTY_PRINT)), 'white', null) : '').
//                  PHP_EOL;
//        }

    }, ['Shows all new errors and warnings in real time. (for better performance, we recommend integrating the tool).']);

    ARGV::register('--watch.network', function ($argv) {

        $logger_cli = new Logger();
        $object = $_object = json_decode(file_get_contents(MIRELE_DEBUG_DIR . '/network.json'), true);

        while (true) {

            $object = json_decode(file_get_contents(MIRELE_DEBUG_DIR . '/network.json'), true);

            if ($_object != $object) {
                $request = (object) end($object);
                $_object = $object;

                if ($request) {

                    $time = date("H:i:s", $request->REQUEST_TIME * 1000 || 0);

                    print $logger_cli->print_c("[{$request->REQUEST_METHOD}]", 'yellow', null) .
                        $logger_cli->print_c(" ({$time})", 'white', null) .
                        $logger_cli->print_c(" {$request->REQUEST_URI} ", 'white', null) .
                        ((isset($request->_REQUEST) and in_array('--watch.body', $argv)) ? $logger_cli->print_c(sprintf("\n%s\n",
                            (new Tree())->render((array) $request->_REQUEST, "REQUEST BODY")
                        ), 'white', null) : '').
                        ((isset($request->_REQUEST) and in_array('--watch.session', $argv)) ? $logger_cli->print_c(sprintf("\n%s\n",
                            (new Tree())->render((array) $request->_SESSION, "SESSION")
                        ), 'white', null) : '').
                        ((isset($request->_REQUEST) and in_array('--watch.cookies', $argv)) ? $logger_cli->print_c(sprintf("\n%s\n",
                            (new Tree())->render((array) $request->_COOKIE, "COOKIES")
                        ), 'white', null) : '').
                        PHP_EOL;

                }
            }

        }

    }, ['Shows all router requests in real time. Requires integration']);

    ARGV::call($argv);

} else {

    defined('ABSPATH') or die('Not defined ABSPATH');
    defined('MIRELE') or die('Not defined MIRELE');

    error_reporting(-1);

    if (!file_exists(MIRELE_DEBUG_DIR . '/errors.json')) {
        file_put_contents(MIRELE_DEBUG_DIR . '/errors.json', "{}");
    }

    if (!file_exists(MIRELE_DEBUG_DIR . '/network.json')) {
        file_put_contents(MIRELE_DEBUG_DIR . '/network.json', "{}");
    }

    set_error_handler (
        function($errno, $errstr, $errfile, $errline) {

            $object = json_decode(file_get_contents(MIRELE_DEBUG_DIR . '/errors.json'), true);
            $object[] = [
                'errno' => $errno,
                'errstr' => $errstr,
                'errfile' => $errfile,
                'errline' => $errline
            ];

            file_put_contents(MIRELE_DEBUG_DIR . '/errors.json', json_encode($object),  LOCK_EX);

        }
    );

    add_action('wp', function () {

    });

    add_action('init', function () {

        Router::addMiddleware(function ($uri, $method) {

            $object = json_decode(file_get_contents(MIRELE_DEBUG_DIR . '/network.json'));
            $_SERVER['_REQUEST'] = $_REQUEST;
            $_SERVER['_COOKIE'] = $_COOKIE;
            $_SERVER['_SESSION'] = $_SESSION;
            $object->{$_SERVER['REQUEST_TIME']} = $_SERVER;

            file_put_contents(MIRELE_DEBUG_DIR . '/network.json', json_encode($object),  LOCK_EX);

        });

    });

}

