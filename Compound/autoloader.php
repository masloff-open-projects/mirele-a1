<?php

/**
 * @root_dir Compound
 * @root_file Compound/autoloader.php
 * @version 1.0.0
 * @author Mirele
 */

define('__RELATIVE__autoloader_5f970cb27d09b', dirname(__FILE__));

/**
 * Module Injection Function (autoloader_5f970cb27d09b)
 * 
 * @version: 1.0.0
 * @param string $file
 * @return Exception|mixed
 */
function __autoloader_5f970cb27d09b (string $file) {
    
    # Current dir
    $module = __RELATIVE__autoloader_5f970cb27d09b . '/' . $file;
    
    # Include
    if (file_exists($module) and is_file($module) and is_readable($module)) {
        return require_once  ("$module");
    } else {
        return new Exception("File ('$module') not found, but required as this is a module");
    }
    
}

return array(

    /**
     * @mask: Compound/Interface/(:any).php
     * @version: 1.0.0
     */

    'Compound/Interface/(:any).php' => array(
        'Compound/Interface/IRequest.php' => __autoloader_5f970cb27d09b('Interface/IRequest.php'), # Priority: 1, Reading Time (file): 0.0001 s
        'Compound/Interface/Iterator_Interface.php' => __autoloader_5f970cb27d09b('Interface/Iterator_Interface.php'), # Priority: 2, Reading Time (file): 0.0001 s
        'Compound/Interface/Seller.php' => __autoloader_5f970cb27d09b('Interface/Seller.php'), # Priority: 3, Reading Time (file): 0.0001 s
        'Compound/Interface/Storage.php' => __autoloader_5f970cb27d09b('Interface/Storage.php'), # Priority: 4, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Compound/Traits/(:any).php
     * @version: 1.0.0
     */

    'Compound/Traits/(:any).php' => array(
        'Compound/Traits/__caller.php' => __autoloader_5f970cb27d09b('Traits/__caller.php'), # Priority: 5, Reading Time (file): 0.0001 s
        'Compound/Traits/__getter.php' => __autoloader_5f970cb27d09b('Traits/__getter.php'), # Priority: 6, Reading Time (file): 0.0001 s
        'Compound/Traits/__isset.php' => __autoloader_5f970cb27d09b('Traits/__isset.php'), # Priority: 7, Reading Time (file): 0.0001 s
        'Compound/Traits/__setter.php' => __autoloader_5f970cb27d09b('Traits/__setter.php'), # Priority: 8, Reading Time (file): 0.0001 s
        'Compound/Traits/__unset.php' => __autoloader_5f970cb27d09b('Traits/__unset.php'), # Priority: 9, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Compound/Instance/(:any).php
     * @version: 1.0.0
     */

    'Compound/Instance/(:any).php' => array(
        'Compound/Instance/Buffer.php' => __autoloader_5f970cb27d09b('Instance/Buffer.php'), # Priority: 10, Reading Time (file): 0.0001 s
        'Compound/Instance/Cache.php' => __autoloader_5f970cb27d09b('Instance/Cache.php'), # Priority: 11, Reading Time (file): 0.0001 s
        'Compound/Instance/Component.php' => __autoloader_5f970cb27d09b('Instance/Component.php'), # Priority: 12, Reading Time (file): 0.0001 s
        'Compound/Instance/Config.php' => __autoloader_5f970cb27d09b('Instance/Config.php'), # Priority: 13, Reading Time (file): 0.0001 s
        'Compound/Instance/Construction.php' => __autoloader_5f970cb27d09b('Instance/Construction.php'), # Priority: 14, Reading Time (file): 0.0001 s
        'Compound/Instance/Directive.php' => __autoloader_5f970cb27d09b('Instance/Directive.php'), # Priority: 15, Reading Time (file): 0.0001 s
        'Compound/Instance/Document.php' => __autoloader_5f970cb27d09b('Instance/Document.php'), # Priority: 16, Reading Time (file): 0.0001 s
        'Compound/Instance/Field.php' => __autoloader_5f970cb27d09b('Instance/Field.php'), # Priority: 17, Reading Time (file): 0.0001 s
        'Compound/Instance/Inter.php' => __autoloader_5f970cb27d09b('Instance/Inter.php'), # Priority: 18, Reading Time (file): 0.0001 s
        'Compound/Instance/Iterator.php' => __autoloader_5f970cb27d09b('Instance/Iterator.php'), # Priority: 19, Reading Time (file): 0.0001 s
        'Compound/Instance/Layout.php' => __autoloader_5f970cb27d09b('Instance/Layout.php'), # Priority: 20, Reading Time (file): 0.0001 s
        'Compound/Instance/Lex.php' => __autoloader_5f970cb27d09b('Instance/Lex.php'), # Priority: 21, Reading Time (file): 0.0001 s
        'Compound/Instance/MFile.php' => __autoloader_5f970cb27d09b('Instance/MFile.php'), # Priority: 22, Reading Time (file): 0.0001 s
        'Compound/Instance/Option.php' => __autoloader_5f970cb27d09b('Instance/Option.php'), # Priority: 23, Reading Time (file): 0.0001 s
        'Compound/Instance/Request.php' => __autoloader_5f970cb27d09b('Instance/Request.php'), # Priority: 24, Reading Time (file): 0.0001 s
        'Compound/Instance/Response.php' => __autoloader_5f970cb27d09b('Instance/Response.php'), # Priority: 25, Reading Time (file): 0.0001 s
        'Compound/Instance/Strategy.php' => __autoloader_5f970cb27d09b('Instance/Strategy.php'), # Priority: 26, Reading Time (file): 0.0001 s
        'Compound/Instance/Stringer.php' => __autoloader_5f970cb27d09b('Instance/Stringer.php'), # Priority: 27, Reading Time (file): 0.0001 s
        'Compound/Instance/Tag.php' => __autoloader_5f970cb27d09b('Instance/Tag.php'), # Priority: 28, Reading Time (file): 0.0001 s
        'Compound/Instance/Template.php' => __autoloader_5f970cb27d09b('Instance/Template.php'), # Priority: 29, Reading Time (file): 0.0002 s
    ),

    /**
     * @mask: Compound/Prototypes/(:any).php
     * @version: 1.0.0
     */

    'Compound/Prototypes/(:any).php' => array(
        'Compound/Prototypes/Pattern.php' => __autoloader_5f970cb27d09b('Prototypes/Pattern.php'), # Priority: 30, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Compound/Сontroller/(:any).php
     * @version: 1.0.0
     */

    'Compound/Сontroller/(:any).php' => array(
        'Compound/Сontroller/AJAX.php' => __autoloader_5f970cb27d09b('Сontroller/AJAX.php'), # Priority: 31, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Apps.php' => __autoloader_5f970cb27d09b('Сontroller/Apps.php'), # Priority: 32, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Constructor.php' => __autoloader_5f970cb27d09b('Сontroller/Constructor.php'), # Priority: 33, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Customizer.php' => __autoloader_5f970cb27d09b('Сontroller/Customizer.php'), # Priority: 34, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Grider.php' => __autoloader_5f970cb27d09b('Сontroller/Grider.php'), # Priority: 35, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Lexer.php' => __autoloader_5f970cb27d09b('Сontroller/Lexer.php'), # Priority: 36, Reading Time (file): 0.0002 s
        'Compound/Сontroller/Logger.php' => __autoloader_5f970cb27d09b('Сontroller/Logger.php'), # Priority: 37, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Router.php' => __autoloader_5f970cb27d09b('Сontroller/Router.php'), # Priority: 38, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Session.php' => __autoloader_5f970cb27d09b('Сontroller/Session.php'), # Priority: 39, Reading Time (file): 0.0001 s
        'Compound/Сontroller/Store.php' => __autoloader_5f970cb27d09b('Сontroller/Store.php'), # Priority: 40, Reading Time (file): 0.0001 s
        'Compound/Сontroller/TWIG.php' => __autoloader_5f970cb27d09b('Сontroller/TWIG.php'), # Priority: 41, Reading Time (file): 0.0001 s
        'Compound/Сontroller/TagsManager.php' => __autoloader_5f970cb27d09b('Сontroller/TagsManager.php'), # Priority: 42, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Compound/Strategys/(:any).php
     * @version: 1.0.0
     */

    'Compound/Strategys/(:any).php' => array(
        'Compound/Strategys/admin.php' => __autoloader_5f970cb27d09b('Strategys/admin.php'), # Priority: 43, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Compound/Strategys/(:any)/(:any).php
     * @version: 1.0.0
     */

    'Compound/Strategys/(:any)/(:any).php' => array(
    ),

    /**
     * @mask: Compound/Patterns/(:any)/(:any)/(:any).php
     * @version: 1.0.0
     */

    'Compound/Patterns/(:any)/(:any)/(:any).php' => array(
    ),

    /**
     * @mask: Compound/Patterns/(:any)/(:any).php
     * @version: 1.0.0
     */

    'Compound/Patterns/(:any)/(:any).php' => array(
        'Compound/Patterns/Compound/__for_develop.php' => __autoloader_5f970cb27d09b('Patterns/__for_develop.php'), # Priority: 44, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/cloneTemplate.php' => __autoloader_5f970cb27d09b('Patterns/cloneTemplate.php'), # Priority: 45, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/createPage.php' => __autoloader_5f970cb27d09b('Patterns/createPage.php'), # Priority: 46, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/insertComponent.php' => __autoloader_5f970cb27d09b('Patterns/insertComponent.php'), # Priority: 47, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/insertTemplate.php' => __autoloader_5f970cb27d09b('Patterns/insertTemplate.php'), # Priority: 48, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/propsPage.php' => __autoloader_5f970cb27d09b('Patterns/propsPage.php'), # Priority: 49, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/propsTemplate.php' => __autoloader_5f970cb27d09b('Patterns/propsTemplate.php'), # Priority: 50, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/removeTemplate.php' => __autoloader_5f970cb27d09b('Patterns/removeTemplate.php'), # Priority: 51, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/sortOrder.php' => __autoloader_5f970cb27d09b('Patterns/sortOrder.php'), # Priority: 52, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/updatePage.php' => __autoloader_5f970cb27d09b('Patterns/updatePage.php'), # Priority: 53, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/updateProps.php' => __autoloader_5f970cb27d09b('Patterns/updateProps.php'), # Priority: 54, Reading Time (file): 0.0001 s
        'Compound/Patterns/Compound/updateTemplateProps.php' => __autoloader_5f970cb27d09b('Patterns/updateTemplateProps.php'), # Priority: 55, Reading Time (file): 0.0001 s
    ),

    /**
     * @mask: Compound/Patterns/(:any).php
     * @version: 1.0.0
     */

    'Compound/Patterns/(:any).php' => array(
    ),

    /**
     * @mask: Compound/Engine/(:any)/(:any).php
     * @version: 1.0.0
     */

    'Compound/Engine/(:any)/(:any).php' => array(
    ),

    /**
     * @mask: Compound/Engine/(:any).php
     * @version: 1.0.0
     */

    'Compound/Engine/(:any).php' => array(
        'Compound/Engine/Application.php' => __autoloader_5f970cb27d09b('Engine/Application.php'), # Priority: 56, Reading Time (file): 0.0001 s
        'Compound/Engine/Render.php' => __autoloader_5f970cb27d09b('Engine/Render.php'), # Priority: 57, Reading Time (file): 0.0001 s
    ),
);

# Reading time of all modules 0.0059 s
