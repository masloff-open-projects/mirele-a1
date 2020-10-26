<?php

/**
 * Module Injection Function
 * 
 * @version: 1.0.0
 * @param string $file
 * @return Exception|mixed
 */
function __autoloader_5f969f6874ebe (string $file) {
    
    # Current dir
    $dir = dirname(__FILE__);
    $abs = "$dir/$file";
    
    # Include
    if (file_exists($abs) and is_file($abs) and is_readable($abs)) {
        return include_once "$abs";
    } else {
        return new Exception("File ('$abs') not found, but required as this is a module");
    }
    
}


# Interface/*.php
__autoloader_5f969f6874ebe("Interface/IRequest.php"); # Include: include_5f969f68750d4
__autoloader_5f969f6874ebe("Interface/Iterator_Interface.php"); # Include: include_5f969f6875135
__autoloader_5f969f6874ebe("Interface/Seller.php"); # Include: include_5f969f68751a3
__autoloader_5f969f6874ebe("Interface/Storage.php"); # Include: include_5f969f68751d9

# Traits/*.php
__autoloader_5f969f6874ebe("Traits/__caller.php"); # Include: include_5f969f687528f
__autoloader_5f969f6874ebe("Traits/__getter.php"); # Include: include_5f969f68752c7
__autoloader_5f969f6874ebe("Traits/__isset.php"); # Include: include_5f969f68752f6
__autoloader_5f969f6874ebe("Traits/__setter.php"); # Include: include_5f969f6875325
__autoloader_5f969f6874ebe("Traits/__unset.php"); # Include: include_5f969f6875354

# Instance/*.php
__autoloader_5f969f6874ebe("Instance/Buffer.php"); # Include: include_5f969f68753fb
__autoloader_5f969f6874ebe("Instance/Cache.php"); # Include: include_5f969f687542c
__autoloader_5f969f6874ebe("Instance/Component.php"); # Include: include_5f969f687545b
__autoloader_5f969f6874ebe("Instance/Config.php"); # Include: include_5f969f687548a
__autoloader_5f969f6874ebe("Instance/Construction.php"); # Include: include_5f969f68754b8
__autoloader_5f969f6874ebe("Instance/Directive.php"); # Include: include_5f969f68754eb
__autoloader_5f969f6874ebe("Instance/Field.php"); # Include: include_5f969f687551c
__autoloader_5f969f6874ebe("Instance/Inter.php"); # Include: include_5f969f687554c
__autoloader_5f969f6874ebe("Instance/Iterator.php"); # Include: include_5f969f687557f
__autoloader_5f969f6874ebe("Instance/Layout.php"); # Include: include_5f969f68755ae
__autoloader_5f969f6874ebe("Instance/Lex.php"); # Include: include_5f969f68755dd
__autoloader_5f969f6874ebe("Instance/MFile.php"); # Include: include_5f969f687560c
__autoloader_5f969f6874ebe("Instance/Option.php"); # Include: include_5f969f6875639
__autoloader_5f969f6874ebe("Instance/Request.php"); # Include: include_5f969f6875668
__autoloader_5f969f6874ebe("Instance/Response.php"); # Include: include_5f969f6875697
__autoloader_5f969f6874ebe("Instance/Strategy.php"); # Include: include_5f969f68756c4
__autoloader_5f969f6874ebe("Instance/Stringer.php"); # Include: include_5f969f68756f3
__autoloader_5f969f6874ebe("Instance/Tag.php"); # Include: include_5f969f6875721
__autoloader_5f969f6874ebe("Instance/Template.php"); # Include: include_5f969f6875750

# Сontroller/*.php
__autoloader_5f969f6874ebe("Сontroller/AJAX.php"); # Include: include_5f969f68757ef
__autoloader_5f969f6874ebe("Сontroller/Apps.php"); # Include: include_5f969f68758b6
__autoloader_5f969f6874ebe("Сontroller/Constructor.php"); # Include: include_5f969f68758e7
__autoloader_5f969f6874ebe("Сontroller/Customizer.php"); # Include: include_5f969f6875917
__autoloader_5f969f6874ebe("Сontroller/Grider.php"); # Include: include_5f969f6875944
__autoloader_5f969f6874ebe("Сontroller/Lexer.php"); # Include: include_5f969f6875973
__autoloader_5f969f6874ebe("Сontroller/Logger.php"); # Include: include_5f969f68759a5
__autoloader_5f969f6874ebe("Сontroller/Router.php"); # Include: include_5f969f68759d3
__autoloader_5f969f6874ebe("Сontroller/Session.php"); # Include: include_5f969f6875a06
__autoloader_5f969f6874ebe("Сontroller/Store.php"); # Include: include_5f969f6875a35
__autoloader_5f969f6874ebe("Сontroller/TWIG.php"); # Include: include_5f969f6875a64
__autoloader_5f969f6874ebe("Сontroller/TagsManager.php"); # Include: include_5f969f6875a99

