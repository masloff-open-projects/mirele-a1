<?php

/**
 * @root_dir Binders
 * @root_file Binders/autoloader.php
 * @version 1.0.0
 * @author Mirele
 */

define('__RELATIVE__autoloader_5f970cb27fb27', dirname(__FILE__));

/**
 * Module Injection Function (autoloader_5f970cb27fb27)
 * 
 * @version: 1.0.0
 * @param string $file
 * @return Exception|mixed
 */
function __autoloader_5f970cb27fb27 (string $file) {
    
    # Current dir
    $module = __RELATIVE__autoloader_5f970cb27fb27 . '/' . $file;
    
    # Include
    if (file_exists($module) and is_file($module) and is_readable($module)) {
        return require_once  ("$module");
    } else {
        return new Exception("File ('$module') not found, but required as this is a module");
    }
    
}

return array(

    /**
     * @mask: Binders/Components/(:any)/Children/(:any).php
     * @version: 1.0.0
     */

    'Binders/Components/(:any)/Children/(:any).php' => array(
        'Binders/Components/Navbar/Children/menu.php' => __autoloader_5f970cb27fb27('Components/Navbar/Children/menu.php'), # Priority: 1, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Binders/Components/(:any)/(:any).php
     * @version: 1.0.0
     */

    'Binders/Components/(:any)/(:any).php' => array(
        'Binders/Components/Button/component.php' => __autoloader_5f970cb27fb27('Components/Button/component.php'), # Priority: 2, Reading Time (file): 0.0001 s
        'Binders/Components/Cart/component.php' => __autoloader_5f970cb27fb27('Components/Cart/component.php'), # Priority: 3, Reading Time (file): 0.0001 s
        'Binders/Components/Checkbox/component.php' => __autoloader_5f970cb27fb27('Components/Checkbox/component.php'), # Priority: 4, Reading Time (file): 0.0001 s
        'Binders/Components/Footer/component.php' => __autoloader_5f970cb27fb27('Components/Footer/component.php'), # Priority: 5, Reading Time (file): 0.0001 s
        'Binders/Components/FormField/component.php' => __autoloader_5f970cb27fb27('Components/FormField/component.php'), # Priority: 6, Reading Time (file): 0.0001 s
        'Binders/Components/HTMLTag/component.php' => __autoloader_5f970cb27fb27('Components/HTMLTag/component.php'), # Priority: 7, Reading Time (file): 0.0001 s
        'Binders/Components/Input/component.php' => __autoloader_5f970cb27fb27('Components/Input/component.php'), # Priority: 8, Reading Time (file): 0.0001 s
        'Binders/Components/Label/component.php' => __autoloader_5f970cb27fb27('Components/Label/component.php'), # Priority: 9, Reading Time (file): 0.0001 s
        'Binders/Components/Navbar/component.php' => __autoloader_5f970cb27fb27('Components/Navbar/component.php'), # Priority: 10, Reading Time (file): 0.0001 s
        'Binders/Components/Notice/component.php' => __autoloader_5f970cb27fb27('Components/Notice/component.php'), # Priority: 11, Reading Time (file): 0.0001 s
        'Binders/Components/Radio/component.php' => __autoloader_5f970cb27fb27('Components/Radio/component.php'), # Priority: 12, Reading Time (file): 0.0001 s
        'Binders/Components/Select/component.php' => __autoloader_5f970cb27fb27('Components/Select/component.php'), # Priority: 13, Reading Time (file): 0.0001 s
        'Binders/Components/Sidebar/component.php' => __autoloader_5f970cb27fb27('Components/Sidebar/component.php'), # Priority: 14, Reading Time (file): 0.0001 s
        'Binders/Components/Textarea/component.php' => __autoloader_5f970cb27fb27('Components/Textarea/component.php'), # Priority: 15, Reading Time (file): 0.0001 s
        'Binders/Components/WidgetFactory/component.php' => __autoloader_5f970cb27fb27('Components/WidgetFactory/component.php'), # Priority: 16, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Binders/Templates/(:any)/(:any).php
     * @version: 1.0.0
     */

    'Binders/Templates/(:any)/(:any).php' => array(
        'Binders/Templates/Emptys/default.php' => __autoloader_5f970cb27fb27('Templates/Emptys/default.php'), # Priority: 17, Reading Time (file): 0.0001 s
        'Binders/Templates/Grid/default.php' => __autoloader_5f970cb27fb27('Templates/Grid/default.php'), # Priority: 18, Reading Time (file): 0.0001 s
        'Binders/Templates/Headers/default.php' => __autoloader_5f970cb27fb27('Templates/Headers/default.php'), # Priority: 19, Reading Time (file): 0.0001 s
        'Binders/Templates/Matrix/4x4.php' => __autoloader_5f970cb27fb27('Templates/Matrix/4x4.php'), # Priority: 20, Reading Time (file): 0.0001 s
        'Binders/Templates/Matrix/6x6.php' => __autoloader_5f970cb27fb27('Templates/Matrix/6x6.php'), # Priority: 21, Reading Time (file): 0.0001 s
        'Binders/Templates/Matrix/template.php' => __autoloader_5f970cb27fb27('Templates/Matrix/template.php'), # Priority: 22, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Binders/Templates/(:any).php
     * @version: 1.0.0
     */

    'Binders/Templates/(:any).php' => array(
    ),
);

# Reading time of all modules 0.0022 s
