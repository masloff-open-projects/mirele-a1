<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_325709", 'ID325709');
define ("AUTOLOADER_PATH_325709", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID325709 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '5723298096:325709' => __autoloader_ID325709 ("Compound/Instance/Protector.php"),
  '6244984924:325709' => __autoloader_ID325709 ("Compound/Interface/CompoundComponent.php"),
  '5364837606:325709' => __autoloader_ID325709 ("Compound/Interface/NetworkRequest.php"),
  '1631438972:325709' => __autoloader_ID325709 ("Compound/Trait/__caller.php"),
  '2639267238:325709' => __autoloader_ID325709 ("Compound/Trait/__getter.php"),
  '4424702315:325709' => __autoloader_ID325709 ("Compound/Trait/__isset.php"),
  '5285432221:325709' => __autoloader_ID325709 ("Compound/Trait/__setter.php"),
  '7476178446:325709' => __autoloader_ID325709 ("Compound/Trait/__unset.php"),
  '3566688596:325709' => __autoloader_ID325709 ("Compound/Instance/Component.php"),
  '3772938243:325709' => __autoloader_ID325709 ("Compound/Instance/Config.php"),
  '2211539356:325709' => __autoloader_ID325709 ("Compound/Instance/Construction.php"),
  '7878617860:325709' => __autoloader_ID325709 ("Compound/Instance/Data.php"),
  '1010394867:325709' => __autoloader_ID325709 ("Compound/Instance/Document.php"),
  '3742237484:325709' => __autoloader_ID325709 ("Compound/Instance/Option.php"),
  '6843175697:325709' => __autoloader_ID325709 ("Compound/Instance/Protector.php"),
  '5963704743:325709' => __autoloader_ID325709 ("Compound/Instance/Request.php"),
  '5713260292:325709' => __autoloader_ID325709 ("Compound/Instance/Response.php"),
  '7047427149:325709' => __autoloader_ID325709 ("Compound/Instance/Strategy.php"),
  '4714124436:325709' => __autoloader_ID325709 ("Compound/Instance/Stringer.php"),
  '6639592123:325709' => __autoloader_ID325709 ("Compound/Instance/Template.php"),
  '6881115914:325709' => __autoloader_ID325709 ("Compound/Prototype/Pattern.php"),
  '5786583589:325709' => __autoloader_ID325709 ("Compound/Module/Converter.php"),
  '5868665642:325709' => __autoloader_ID325709 ("Compound/Module/Option.php"),
  '7155448238:325709' => __autoloader_ID325709 ("Compound/Module/WP.php"),
  '5723360074:325709' => __autoloader_ID325709 ("Compound/Module/WPGNU.php"),
  '3423515112:325709' => __autoloader_ID325709 ("Compound/Сontroller/Certificate.php"),
  '3748657635:325709' => __autoloader_ID325709 ("Compound/Сontroller/Constructor.php"),
  '7507502525:325709' => __autoloader_ID325709 ("Compound/Сontroller/Customizer.php"),
  '3172893954:325709' => __autoloader_ID325709 ("Compound/Сontroller/Lexer.php"),
  '3213869628:325709' => __autoloader_ID325709 ("Compound/Сontroller/Market.php"),
  '5071137037:325709' => __autoloader_ID325709 ("Compound/Сontroller/Module.php"),
  '4741849096:325709' => __autoloader_ID325709 ("Compound/Сontroller/Network.php"),
  '5240176403:325709' => __autoloader_ID325709 ("Compound/Сontroller/Repository.php"),
  '7860793125:325709' => __autoloader_ID325709 ("Compound/Сontroller/Router.php"),
  '5273392007:325709' => __autoloader_ID325709 ("Compound/Сontroller/Session.php"),
  '6954703825:325709' => __autoloader_ID325709 ("Compound/Сontroller/TWIG.php"),
  '5249842540:325709' => __autoloader_ID325709 ("Compound/Adapter/AJAX.php"),
  '6183542940:325709' => __autoloader_ID325709 ("Compound/Strategy/CompoundPrivate.php"),
  '7776845976:325709' => __autoloader_ID325709 ("Compound/Strategy/__strategy_admin.php"),
  '2816554025:325709' => __autoloader_ID325709 ("Compound/Strategy/any.php"),
  '3626482642:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/__for_develop.php"),
  '4302888671:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/cloneTemplate.php"),
  '2905919831:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/createPage.php"),
  '6876220550:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/insertComponent.php"),
  '1873949154:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/insertTemplate.php"),
  '2052919672:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/propsPage.php"),
  '7601073669:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/propsTemplate.php"),
  '2970655584:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/removeTemplate.php"),
  '4103470617:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/sortOrder.php"),
  '1293908327:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/updatePage.php"),
  '4690486096:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/updateProps.php"),
  '1560085641:325709' => __autoloader_ID325709 ("Compound/Pattern/Compound/updateTemplateProps.php"),
  '5850404074:325709' => __autoloader_ID325709 ("Compound/Engine/Applications/Document/Modules/Extension.php"),
  '5483619862:325709' => __autoloader_ID325709 ("Compound/Engine/Applications/Compound/ModuleKit.php"),
  '4282412615:325709' => __autoloader_ID325709 ("Compound/Engine/Applications/Document/DOM.php"),
  '7330200751:325709' => __autoloader_ID325709 ("Compound/Engine/Applications/Document/Document.php"),
  '3564970824:325709' => __autoloader_ID325709 ("Compound/Engine/Applications/VisualEditor/Editor.php"),
  '4091758717:325709' => __autoloader_ID325709 ("Compound/Engine/Application.php"),
  '4643771650:325709' => __autoloader_ID325709 ("Compound/Helpers/Modules/Compound.php"),
  '2323928928:325709' => __autoloader_ID325709 ("Compound/Helpers/Modules/Document.php"),
  '4716397041:325709' => __autoloader_ID325709 ("Compound/Helpers/Modules/HTML.php"),
  '2291126867:325709' => __autoloader_ID325709 ("Compound/Helpers/Modules/URL.php"),
  '1325716484:325709' => __autoloader_ID325709 ("Compound/Helpers/Modules/WP.php"),
  '2491691180:325709' => __autoloader_ID325709 ("Compound/Helpers/Helpers.php"),
);
