<?php


namespace MireleCompiler;


use Mirele\Compound\Response;
use Mirele\Compound\Template;

/**
 * Root path to the autoloader initialization folder
 */

$__RELATIVE__ = dirname(__FILE__);

abstract class PerentBuilder {

    protected $autoloader_dir = '';
    protected $autoloader_path = '';
    protected $version = "1.0.0";
    protected $UID = 'autoloader_zero';

    protected function __write ($string)
    {
        if ($this->autoloader_path) {
            return file_put_contents($this->autoloader_path, $string . PHP_EOL, FILE_APPEND);
        }
    }

    protected  function __dump ()
    {
        if ($this->autoloader_path) {
            return file_put_contents($this->autoloader_path, "");
        }
    }

    protected  function __decorator () {
        return "<?php";
    }

    protected  function __comment ($lines = [], $indent = 0) {
        $line = "\n" . $this->__indent($indent) . "/**";
        foreach ($lines as $line_) {
            $line .= "\n" . $this->__indent($indent) . " * $line_";
        }
        $line .= "\n" . $this->__indent($indent) . " */\n";
        return $line;
    }

    protected function __indent ($m = 1)
    {
        return str_repeat("    ", $m);
    }

    protected function __header ()
    {
        return "/**
 * @root_dir {$this->autoloader_dir}
 * @root_file {$this->autoloader_path}
 * @version {$this->version}
 * @author Mirele
 */";
    }

    protected function __function_loader ()
    {

        return "
/**
 * Module Injection Function ($this->UID)
 * 
 * @version: 1.0.0
 * @param string \$file
 * @return Exception|mixed
 */
function {$this->__function_loader_name()} (string \$file) {
    
    # Current dir
    \$module = {$this->__const_relative()} . '/' . \$file;
    
    # Include
    if (file_exists(\$module) and is_file(\$module) and is_readable(\$module)) {
        return require_once  (\"\$module\");
    } else {
        return new Exception(\"File ('\$module') not found, but required as this is a module\");
    }
    
}";
    }

    protected function __function_loader_call ($file, $closure=";")
    {
        return "{$this->__function_loader_name()}('$file'){$closure}";
    }

    protected function __const_relative ()
    {
        return "__RELATIVE__$this->UID";
    }

    protected function __function_loader_name ()
    {
        return "__$this->UID";
    }

    protected function __function_add_action ($action, $code)
    {
        return "add_action('$action', function (\$event=null) {
    
    // Wordpress Event Processing
    $code
            
});";
    }

    protected function __vars ()
    {
        return "define('{$this->__const_relative()}', dirname(__FILE__));";
    }

    protected function __define ($name, $value)
    {
        return "define('{$name}', {$value});";
    }

    protected function __network_redirect ()
    {
        return "\$POST = MIRELE_POST;
                
    if (isset(\$POST['action']) and isset(\$POST['method'])) {
    
        \$run = AJAX::run((MIRELE_POST)['method'], [
            'verify_nonce' => wp_verify_nonce(\$_REQUEST['nonce'], MIRELE_NONCE)
        ]);
    
        if (\$run instanceof Response) {
            http_response_code(\$run->getCode());
            wp_send_json(\$run->getBody());
        } elseif (is_bool(\$run)) {
            if (\$run === true) {
                wp_send_json_success([]);
            } elseif (\$run === false) {
                wp_send_json_error([]);
            } else {
                wp_send_json([]);
            }
        } elseif (is_object(\$run) or is_array(\$run)) {
            wp_send_json(\$run);
        } else {
            print \$run;
        }
    
        exit;
    
    }";
    }

}

class BuilderAbstractAutolaoder extends PerentBuilder
{


    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct($path, $argv)
    {

        $i = 0;
        $worktime = 0;

        $argv = array_unique($argv);

        $this->UID = uniqid('autoloader_');
        $this->autoloader_path = $path;
        $this->autoloader_dir = dirname($path);

        $this->__dump();
        $this->__write($this->__decorator());
        $this->__write("\n" . $this->__header() . "\n");
        $this->__write($this->__vars());
        $this->__write($this->__function_loader());

        $this->__write("\nreturn array(");

        foreach ($argv as $mask) {

            $safe_mask = str_replace('*', '(:any)', $mask);

            $this->__write($this->__comment([
                "@mask: $safe_mask",
                "@version: 1.0.0"
            ], 1));

            $this->__write(
                $this->__indent(1) .
                "'$safe_mask' => array("
            );

            foreach (glob($mask) as $module) {

                $i++;
                $start = microtime(true);
                file($module);
                $reading_time = round(microtime(true) - $start, 4);
                $worktime = $worktime + $reading_time;

                $this->__write(
                    $this->__indent(2) .
                    "'$module' => " .
                    $this->__function_loader_call(
                        str_replace("{$this->autoloader_dir}/", "", $module),
                        ", # Priority: $i, Reading Time (file): $reading_time s"
                    )
                );
            }

            $this->__write(
                $this->__indent(1) .
                "),"
            );

        }

        $this->__write(");");

        $this->__write("\n# Reading time of all modules $worktime s");

    }

    /**
     * PHP 5 introduces a destructor concept similar to that of other object-oriented languages, such as C++.
     * The destructor method will be called as soon as all references to a particular object are removed or
     * when the object is explicitly destroyed or in any order in shutdown sequence.
     *
     * Like constructors, parent destructors will not be called implicitly by the engine.
     * In order to run a parent destructor, one would have to explicitly call parent::__destruct() in the destructor body.
     *
     * Note: Destructors called during the script shutdown have HTTP headers already sent.
     * The working directory in the script shutdown phase can be different with some SAPIs (e.g. Apache).
     *
     * Note: Attempting to throw an exception from a destructor (called in the time of script termination) causes a fatal error.
     *
     * @return void
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }




}

class BuilderCodeTemplate
{

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct($argv)
    {
        echo $this->__header() . PHP_EOL;
        foreach ($argv as $prop => $value) {
            echo $this->__arg($prop, $value) . PHP_EOL;
        }
        echo $this->__footer() . PHP_EOL;
    }

    private function __arg ($name, $value="null")
    {
        return "    '{$name}' => {$value},";
    }

    private function __header ()
    {
        return "new Template([";
    }

    private function __footer ()
    {
        return "]);";
    }


}

class BuilderNetwork extends PerentBuilder
{

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct($path, $argv)
    {

        $o = 0;
        $worktime = 0;

        $argv = array_unique($argv);

        $this->UID = uniqid('autoloader_');
        $this->autoloader_path = $path;
        $this->autoloader_dir = dirname($path);

        $this->__dump();
        $this->__write($this->__decorator());
        $this->__write("\nuse Mirele\Compound\Response;
use Mirele\Router;");
        $this->__write("\n" . $this->__header() . "\n");
        $this->__write($this->__vars());
        $this->__write($this->__define('__ROUTES_DIR__', 'dirname(__FILE__)'));
        $this->__write($this->__define('__WORDPRESS_AJAX_REDIRECT__', '["wp_ajax_nopriv_mirele_endpoint_v1", "wp_ajax_mirele_endpoint_v1"]'));
        $this->__write($this->__function_loader());
        $this->__write($this->__comment([
            "Registration of request interception handlers",
            "@version: 1.0.0"
        ]));

        foreach (["wp_ajax_nopriv_mirele_endpoint_v1", "wp_ajax_mirele_endpoint_v1"] as $i) {
            $this->__write( $this->__function_add_action($i,
                    $this->__network_redirect()
                ) . PHP_EOL);
        }

        $this->__write("\nreturn array(");

        foreach ($argv as $mask) {

            $safe_mask = str_replace('*', '(:any)', $mask);

            $this->__write($this->__comment([
                "@mask: $safe_mask",
                "@version: 1.0.0"
            ], 1));

            $this->__write(
                $this->__indent(1) .
                "'$safe_mask' => array("
            );

            foreach (glob($mask) as $module) {

                $o++;
                $start = microtime(true);
                preg_match("~(class (.*?) extends Request)~", file_get_contents($module), $m);
                if (isset($m[2]) and $m[2]) {

                } else {
                    $this->__write(PHP_EOL . $this->__indent(2) . "// TODO: The method of registration is outdated");
                }

                $pos =  strpos(file_get_contents($module), 'new Response');
                if ($pos < 0 or (!$pos)) {
                    $this->__write(PHP_EOL . $this->__indent(2) . "// TODO: Use new methods of returning a response to the server (new Response)");
                }

                $reading_time = round(microtime(true) - $start, 4);
                $worktime = $worktime + $reading_time;



                $this->__write(
                    $this->__indent(2) .
                    "'$module' => " .
                    $this->__function_loader_call(
                        str_replace("{$this->autoloader_dir}/", "", $module),
                        ", # Priority: $o, Reading Time (file): $reading_time s"
                    )
                );
            }

            $this->__write(
                $this->__indent(1) .
                "),"
            );

        }

        $this->__write(");");

        $this->__write("\n# Reading time of all modules $worktime s");

    }

}


if ($argv) {

    foreach (array_values($argv) as $arg) {
        switch ($arg) {

            case '--binders':
                new BuilderAbstractAutolaoder('Binders/autoloader.php', [
                    'Binders/Components/*/Children/*.php',
                    'Binders/Components/*/*.php',
                    'Binders/Templates/*/*.php',
                    'Binders/Templates/*.php',
                ]);
                print "[ OK ] Compilation was successful\n";
                break;

            case '--compound':
                new BuilderAbstractAutolaoder('Compound/autoloader.php', [
                    'Compound/Interface/*.php',
                    'Compound/Traits/*.php',
                    'Compound/Instance/*.php',
                    'Compound/Prototypes/*.php',
                    'Compound/Сontroller/*.php',
                    'Compound/Strategys/*.php',
                    'Compound/Strategys/*/*.php',
                    'Compound/Patterns/*/*/*.php',
                    'Compound/Patterns/*/*.php',
                    'Compound/Patterns/*.php',
                    'Compound/Engine/*/*.php',
                    'Compound/Engine/*.php',
                ]);
                print "[ OK ] Compilation was successful\n";
                break;

            case '--requests':
                include_once 'Compound/autoloader.php';

                new BuilderNetwork('Routes/autoloader.php', [
                    'Routes/*/*.php',
                    'Routes/*/*/*.php',
//                    'Routes/*.php',
                ]);

                print "[ OK ] Compilation was successful\n";
                break;

            case '--create-template':

                include_once 'Compound/Instance/Template.php';

                $reflect = new \ReflectionClass(new Template);
                $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
                $template = [];

                foreach ($props as $prop) {
                    if (in_array($prop->getName(), ['id', 'name', 'twig'])) {
                        $template[$prop->getName()] = '"' . readline("{$prop->getName()}: ") . '"';
                    } else {
                        $template[$prop->getName()] = '""';
                    }
                }

                new BuilderCodeTemplate($template);

                print "[ OK ] Compilation was successful\n";
                break;

        }
    }

}