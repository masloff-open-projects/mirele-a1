<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_254011", 'ID254011');
define ("AUTOLOADER_PATH_254011", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID254011 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '2824664312:254011' => __autoloader_ID254011 ("Compound/Instance/Protector.php"),
  '3208065579:254011' => __autoloader_ID254011 ("Compound/Interface/CompoundComponent.php"),
  '5044840628:254011' => __autoloader_ID254011 ("Compound/Interface/NetworkRequest.php"),
  '2729423540:254011' => __autoloader_ID254011 ("Compound/Trait/__caller.php"),
  '4764739669:254011' => __autoloader_ID254011 ("Compound/Trait/__getter.php"),
  '1464981783:254011' => __autoloader_ID254011 ("Compound/Trait/__isset.php"),
  '1493597431:254011' => __autoloader_ID254011 ("Compound/Trait/__setter.php"),
  '6788392381:254011' => __autoloader_ID254011 ("Compound/Trait/__unset.php"),
  '3619421658:254011' => __autoloader_ID254011 ("Compound/Instance/Component.php"),
  '3057805578:254011' => __autoloader_ID254011 ("Compound/Instance/Config.php"),
  '7990637286:254011' => __autoloader_ID254011 ("Compound/Instance/Construction.php"),
  '3837139101:254011' => __autoloader_ID254011 ("Compound/Instance/Data.php"),
  '7105875383:254011' => __autoloader_ID254011 ("Compound/Instance/Directive.php"),
  '4724259263:254011' => __autoloader_ID254011 ("Compound/Instance/Document.php"),
  '1031365979:254011' => __autoloader_ID254011 ("Compound/Instance/Field.php"),
  '1492725952:254011' => __autoloader_ID254011 ("Compound/Instance/Layout.php"),
  '2426237918:254011' => __autoloader_ID254011 ("Compound/Instance/Option.php"),
  '6427579442:254011' => __autoloader_ID254011 ("Compound/Instance/Protector.php"),
  '3577454358:254011' => __autoloader_ID254011 ("Compound/Instance/Request.php"),
  '6014821806:254011' => __autoloader_ID254011 ("Compound/Instance/Response.php"),
  '6476498428:254011' => __autoloader_ID254011 ("Compound/Instance/Strategy.php"),
  '1160763419:254011' => __autoloader_ID254011 ("Compound/Instance/Stringer.php"),
  '1808279822:254011' => __autoloader_ID254011 ("Compound/Instance/Tag.php"),
  '6057182814:254011' => __autoloader_ID254011 ("Compound/Instance/Template.php"),
  '1247882261:254011' => __autoloader_ID254011 ("Compound/Prototype/Pattern.php"),
  '7794764735:254011' => __autoloader_ID254011 ("Compound/Module/Converter.php"),
  '7354807942:254011' => __autoloader_ID254011 ("Compound/Module/Option.php"),
  '4657418332:254011' => __autoloader_ID254011 ("Compound/Module/WP.php"),
  '5530842282:254011' => __autoloader_ID254011 ("Compound/Module/WPGNU.php"),
  '4297977950:254011' => __autoloader_ID254011 ("Compound/Сontroller/Apps.php"),
  '7566997582:254011' => __autoloader_ID254011 ("Compound/Сontroller/Constructor.php"),
  '6754207668:254011' => __autoloader_ID254011 ("Compound/Сontroller/Controller.php"),
  '1794915922:254011' => __autoloader_ID254011 ("Compound/Сontroller/Customizer.php"),
  '4434462737:254011' => __autoloader_ID254011 ("Compound/Сontroller/Grider.php"),
  '3245366618:254011' => __autoloader_ID254011 ("Compound/Сontroller/Lexer.php"),
  '6351631515:254011' => __autoloader_ID254011 ("Compound/Сontroller/Network.php"),
  '6274271288:254011' => __autoloader_ID254011 ("Compound/Сontroller/Router.php"),
  '6805392286:254011' => __autoloader_ID254011 ("Compound/Сontroller/Session.php"),
  '7802901971:254011' => __autoloader_ID254011 ("Compound/Сontroller/Store.php"),
  '3471491748:254011' => __autoloader_ID254011 ("Compound/Сontroller/TWIG.php"),
  '7534144975:254011' => __autoloader_ID254011 ("Compound/Сontroller/TagsManager.php"),
  '1816286241:254011' => __autoloader_ID254011 ("Compound/Adapter/AJAX.php"),
  '2563090854:254011' => __autoloader_ID254011 ("Compound/Strategy/admin.php"),
  '5197344172:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/__for_develop.php"),
  '2461998725:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/cloneTemplate.php"),
  '5044389309:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/createPage.php"),
  '1001771488:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/insertComponent.php"),
  '3242524510:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/insertTemplate.php"),
  '1391836462:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/propsPage.php"),
  '6163804443:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/propsTemplate.php"),
  '6772962520:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/removeTemplate.php"),
  '4937765030:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/sortOrder.php"),
  '5018630756:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/updatePage.php"),
  '6925930074:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/updateProps.php"),
  '6660415242:254011' => __autoloader_ID254011 ("Compound/Pattern/Compound/updateTemplateProps.php"),
  '3419712937:254011' => __autoloader_ID254011 ("Compound/Engine/Application.php"),
);
