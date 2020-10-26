<?php

/**
 *
 * ██╗   ██╗███████╗███╗   ██╗██████╗  ██████╗ ██████╗
 * ██║   ██║██╔════╝████╗  ██║██╔══██╗██╔═══██╗██╔══██╗
 * ██║   ██║█████╗  ██╔██╗ ██║██║  ██║██║   ██║██████╔╝
 * ╚██╗ ██╔╝██╔══╝  ██║╚██╗██║██║  ██║██║   ██║██╔══██╗
 *  ╚████╔╝ ███████╗██║ ╚████║██████╔╝╚██████╔╝██║  ██║
 *   ╚═══╝  ╚══════╝╚═╝  ╚═══╝╚═════╝  ╚═════╝ ╚═╝  ╚═╝
 *
 * Vendor files are used to subclick a whole set
 * of target bit files included in the complex.
 * Vendor files always lie in the root directory
 * of the complex target bit divisions into separate files.
 * Vendor files always specify the target file and cannot
 * connect foreign files to the system, they cannot subdivide through the loop
 *
 * @vendor Controller
 * @version 1.0.0
 * @author Mirele
 * @alias vendor-controller
 * @template vendor
 */

if (is_file("autoloader.php")) {
    file_put_contents("autoloader.php", "");
}

$uni = uniqid('autoloader_');
file_put_contents("autoloader.php", "<?php\n
/**
 * Module Injection Function
 * 
 * @version: 1.0.0
 * @param string \$file
 * @return Exception|mixed
 */
function __$uni (string \$file) {
    
    # Current dir
    \$dir = dirname(__FILE__);
    \$abs = \"\$dir/\$file\";
    
    # Include
    if (file_exists(\$abs) and is_file(\$abs) and is_readable(\$abs)) {
        return include_once \"\$abs\";
    } else {
        return new Exception(\"File ('\$abs') not found, but required as this is a module\");
    }
    
}" . PHP_EOL . PHP_EOL, FILE_APPEND);

foreach (['Interface/*.php', 'Traits/*.php', 'Instance/*.php', 'Сontroller/*.php'] as $mask) {

    file_put_contents("autoloader.php", PHP_EOL . "# $mask" . PHP_EOL, FILE_APPEND);

    foreach (glob($mask) as $path) {

        $iteration = uniqid('include_');
        $code = "__$uni(\"$path\"); # Include: $iteration";

        file_put_contents("autoloader.php", $code . PHP_EOL, FILE_APPEND);
    }
}

file_put_contents("autoloader.php", "" . PHP_EOL, FILE_APPEND);
