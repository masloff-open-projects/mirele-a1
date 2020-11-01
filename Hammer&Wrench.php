<?php

namespace HammerWrench;

class PHP {

    protected $indent = 0;

    protected function __function ($name="undefined", $props=['$name'], $content="")
    {

        $indent = str_repeat("  ", $this->indent);
        $indentContent = str_repeat("  ", $this->indent + 1);
        $props = join(', ',  $props);
        return "{$indent}function {$name} ({$props})\n{$indent}{\n{$indentContent}{$content}\n{$indent}}\n";

    }

    protected function __define ($name="undefined", $content="")
    {

        $indent = str_repeat("  ", $this->indent);
        return "{$indent}define (\"{$name}\", {$content});\n";

    }

    protected function __comment ($content="")
    {

        $indent = str_repeat("  ", $this->indent);
        return "{$indent}# {$content}\n";

    }

    protected function __var ($name="undefined", $content="")
    {

        $indent = str_repeat("  ", $this->indent);
        return "{$indent}\${$name} = {$content};\n";

    }

    protected function __if ($expression="undefined", $then="", $else="")
    {

        $indent = str_repeat("  ", $this->indent);
        $indentContent = str_repeat("  ", $this->indent + 1);

        return "{$indent}if ({$expression}) {\n{$indentContent}{$then}\n{$indent}} else {\n{$indentContent}{$else}\n{$indent}}\n";

    }

    protected function __array ($return="", $content=[])
    {

        $indent = str_repeat("  ", $this->indent);
        $indentContent = str_repeat("  ", $this->indent + 1);
        $_ = "{$indent}{$return}array (\n";
        foreach ($content as $key => $value) {
            $_ .= "{$indentContent}'{$key}' => {$value},\n";
        }
        $_ .= ");\n";

        return $_;

    }

}

class Autoloader extends PHP {

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
    public function __construct($paths = [], $file="", $workdir="")
    {

        # Define
        $uid = rand(100000, 900000);

        # Define
        $define = join("", [
            $this->__comment("Creating a virtual environment of constants"),
            $this->__define("AUTOLOADER_ID_{$uid}", "'ID{$uid}'"),
            $this->__define("AUTOLOADER_PATH_{$uid}", "dirname (__FILE__)")
        ]);

        # ...
        $loader = join("", [
            $this->__comment("Initialization of module connection function"),
            $this->__function("__autoloader_ID{$uid}", [
                "string \$file"
            ], join("", [
                $this->__var("__path__", "TEMPLATE_PATH . '/' . \$file"),
                ($this->indent++ ? "" : ""),
                $this->__if(
                    'file_exists($__path__) and is_file($__path__) and is_readable($__path__)',
                    'return require_once $__path__;',
                    'return wp_die ("File (\'$__path__\') not found, but required as this is a module");'
                ),
                ($this->indent-- ? "" : ""),
            ]))
        ]);

        # Compiller
        $modules = [];
        foreach ($paths as $path) {
            foreach (glob($path) as $module) {
                $module = str_replace($workdir, "", $module);
                $modules[rand(1000010000, 8000010000) . ":{$uid}"] = "__autoloader_ID{$uid} (\"{$module}\")";
            }
        }

        $vendor = $this->__array('return ', $modules);

        file_put_contents($file, join("\n", [
            "<?php",
            $define,
            $loader,
            $vendor
        ]));

    }

}

if ($argv) {

    foreach (array_values($argv) as $arg) {
        switch ($arg) {

            case '--binders':
                new Autoloader([
                    'Binders/Components/*/Children/*.php',
                    'Binders/Components/*/*.php',
                    'Binders/Templates/*/*.php',
                    'Binders/Templates/*.php',
                ], 'Binders/autoloader.php');

                print "[ OK ] Compilation was successful\n";
                break;

            case '--compound':
                new Autoloader([
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
                ], 'Compound/autoloader.php');

                print "[ OK ] Compilation was successful\n";
                break;

            case '--requests':

                new Autoloader([
                    'Routes/*/*.php',
                    'Routes/*/*/*.php'
                ], 'Routes/autoloader.php');

                print "[ OK ] Compilation was successful\n";
                break;
        }
    }

}