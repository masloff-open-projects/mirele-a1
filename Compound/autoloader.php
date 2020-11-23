<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_493110", 'ID493110');
define ("AUTOLOADER_PATH_493110", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID493110 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '6548800885:493110' => __autoloader_ID493110 ("Compound/Instance/Protector.php"),
  '1140013479:493110' => __autoloader_ID493110 ("Compound/Interface/CompoundComponent.php"),
  '4310880265:493110' => __autoloader_ID493110 ("Compound/Interface/NetworkRequest.php"),
  '6471885827:493110' => __autoloader_ID493110 ("Compound/Trait/__caller.php"),
  '3314143674:493110' => __autoloader_ID493110 ("Compound/Trait/__getter.php"),
  '6992982153:493110' => __autoloader_ID493110 ("Compound/Trait/__isset.php"),
  '3751308534:493110' => __autoloader_ID493110 ("Compound/Trait/__setter.php"),
  '3446222760:493110' => __autoloader_ID493110 ("Compound/Trait/__unset.php"),
  '2972883356:493110' => __autoloader_ID493110 ("Compound/Instance/Component.php"),
  '7068780135:493110' => __autoloader_ID493110 ("Compound/Instance/Config.php"),
  '7130819519:493110' => __autoloader_ID493110 ("Compound/Instance/Construction.php"),
  '1230826369:493110' => __autoloader_ID493110 ("Compound/Instance/Data.php"),
  '6010109239:493110' => __autoloader_ID493110 ("Compound/Instance/Directive.php"),
  '4152459049:493110' => __autoloader_ID493110 ("Compound/Instance/Document.php"),
  '7244975837:493110' => __autoloader_ID493110 ("Compound/Instance/Field.php"),
  '7669886533:493110' => __autoloader_ID493110 ("Compound/Instance/Option.php"),
  '5437751891:493110' => __autoloader_ID493110 ("Compound/Instance/Protector.php"),
  '7183080689:493110' => __autoloader_ID493110 ("Compound/Instance/Request.php"),
  '4247551831:493110' => __autoloader_ID493110 ("Compound/Instance/Response.php"),
  '1405177355:493110' => __autoloader_ID493110 ("Compound/Instance/Strategy.php"),
  '3404779082:493110' => __autoloader_ID493110 ("Compound/Instance/Stringer.php"),
  '1896151431:493110' => __autoloader_ID493110 ("Compound/Instance/Tag.php"),
  '4431784444:493110' => __autoloader_ID493110 ("Compound/Instance/Template.php"),
  '7384909271:493110' => __autoloader_ID493110 ("Compound/Prototype/Pattern.php"),
  '1689906959:493110' => __autoloader_ID493110 ("Compound/Module/Converter.php"),
  '3511809736:493110' => __autoloader_ID493110 ("Compound/Module/Option.php"),
  '4777587420:493110' => __autoloader_ID493110 ("Compound/Module/WP.php"),
  '6221381726:493110' => __autoloader_ID493110 ("Compound/Module/WPGNU.php"),
  '4160630643:493110' => __autoloader_ID493110 ("Compound/Сontroller/Apps.php"),
  '7385144215:493110' => __autoloader_ID493110 ("Compound/Сontroller/Constructor.php"),
  '3502543315:493110' => __autoloader_ID493110 ("Compound/Сontroller/Customizer.php"),
  '5307619838:493110' => __autoloader_ID493110 ("Compound/Сontroller/Grider.php"),
  '2292662598:493110' => __autoloader_ID493110 ("Compound/Сontroller/Lexer.php"),
  '6228125638:493110' => __autoloader_ID493110 ("Compound/Сontroller/Network.php"),
  '2965210435:493110' => __autoloader_ID493110 ("Compound/Сontroller/Router.php"),
  '3288080691:493110' => __autoloader_ID493110 ("Compound/Сontroller/Session.php"),
  '4598201805:493110' => __autoloader_ID493110 ("Compound/Сontroller/Store.php"),
  '6191596958:493110' => __autoloader_ID493110 ("Compound/Сontroller/TWIG.php"),
  '2966832837:493110' => __autoloader_ID493110 ("Compound/Сontroller/TagsManager.php"),
  '5748865991:493110' => __autoloader_ID493110 ("Compound/Adapter/AJAX.php"),
  '7888593778:493110' => __autoloader_ID493110 ("Compound/Strategy/CompoundPrivate.php"),
  '1633853851:493110' => __autoloader_ID493110 ("Compound/Strategy/__strategy_admin.php"),
  '6853772491:493110' => __autoloader_ID493110 ("Compound/Strategy/any.php"),
  '2266453088:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/__for_develop.php"),
  '5781024661:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/cloneTemplate.php"),
  '3237552965:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/createPage.php"),
  '7795119909:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/insertComponent.php"),
  '2724913752:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/insertTemplate.php"),
  '6764711392:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/propsPage.php"),
  '4854385549:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/propsTemplate.php"),
  '1036441897:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/removeTemplate.php"),
  '6998558067:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/sortOrder.php"),
  '6484845099:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/updatePage.php"),
  '7069046929:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/updateProps.php"),
  '2139609983:493110' => __autoloader_ID493110 ("Compound/Pattern/Compound/updateTemplateProps.php"),
  '7478255814:493110' => __autoloader_ID493110 ("Compound/Engine/Applications/Document/Modules/Extension.php"),
  '2363663540:493110' => __autoloader_ID493110 ("Compound/Engine/Applications/Document/Document.php"),
  '1347525024:493110' => __autoloader_ID493110 ("Compound/Engine/Applications/Document/Layout.php"),
  '5318847581:493110' => __autoloader_ID493110 ("Compound/Engine/Application.php"),
);
