<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_680590", 'ID680590');
define ("AUTOLOADER_PATH_680590", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID680590 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '3547534393:680590' => __autoloader_ID680590 ("Compound/Instance/Protector.php"),
  '2352045023:680590' => __autoloader_ID680590 ("Compound/Interface/CompoundComponent.php"),
  '3498824513:680590' => __autoloader_ID680590 ("Compound/Interface/NetworkRequest.php"),
  '2998653180:680590' => __autoloader_ID680590 ("Compound/Trait/__caller.php"),
  '4085875066:680590' => __autoloader_ID680590 ("Compound/Trait/__getter.php"),
  '3673552437:680590' => __autoloader_ID680590 ("Compound/Trait/__isset.php"),
  '3415118228:680590' => __autoloader_ID680590 ("Compound/Trait/__setter.php"),
  '3736931901:680590' => __autoloader_ID680590 ("Compound/Trait/__unset.php"),
  '5455594851:680590' => __autoloader_ID680590 ("Compound/Instance/Component.php"),
  '6270024326:680590' => __autoloader_ID680590 ("Compound/Instance/Config.php"),
  '4647001057:680590' => __autoloader_ID680590 ("Compound/Instance/Construction.php"),
  '1107052901:680590' => __autoloader_ID680590 ("Compound/Instance/Data.php"),
  '2262345909:680590' => __autoloader_ID680590 ("Compound/Instance/Directive.php"),
  '2015954499:680590' => __autoloader_ID680590 ("Compound/Instance/Document.php"),
  '1224010382:680590' => __autoloader_ID680590 ("Compound/Instance/Field.php"),
  '6204574157:680590' => __autoloader_ID680590 ("Compound/Instance/Option.php"),
  '5278328480:680590' => __autoloader_ID680590 ("Compound/Instance/Protector.php"),
  '3397585078:680590' => __autoloader_ID680590 ("Compound/Instance/Request.php"),
  '3917752397:680590' => __autoloader_ID680590 ("Compound/Instance/Response.php"),
  '3419385327:680590' => __autoloader_ID680590 ("Compound/Instance/Strategy.php"),
  '3680137470:680590' => __autoloader_ID680590 ("Compound/Instance/Stringer.php"),
  '1742193826:680590' => __autoloader_ID680590 ("Compound/Instance/Tag.php"),
  '6332396071:680590' => __autoloader_ID680590 ("Compound/Instance/Template.php"),
  '6943414544:680590' => __autoloader_ID680590 ("Compound/Prototype/Pattern.php"),
  '6451062122:680590' => __autoloader_ID680590 ("Compound/Module/Converter.php"),
  '6966936692:680590' => __autoloader_ID680590 ("Compound/Module/Option.php"),
  '7485437220:680590' => __autoloader_ID680590 ("Compound/Module/WP.php"),
  '3368954474:680590' => __autoloader_ID680590 ("Compound/Module/WPGNU.php"),
  '3785103086:680590' => __autoloader_ID680590 ("Compound/Сontroller/Apps.php"),
  '4841888544:680590' => __autoloader_ID680590 ("Compound/Сontroller/Constructor.php"),
  '4192372861:680590' => __autoloader_ID680590 ("Compound/Сontroller/Controller.php"),
  '6530878313:680590' => __autoloader_ID680590 ("Compound/Сontroller/Customizer.php"),
  '4302127083:680590' => __autoloader_ID680590 ("Compound/Сontroller/Grider.php"),
  '4078721395:680590' => __autoloader_ID680590 ("Compound/Сontroller/Lexer.php"),
  '2248048907:680590' => __autoloader_ID680590 ("Compound/Сontroller/Network.php"),
  '4886848107:680590' => __autoloader_ID680590 ("Compound/Сontroller/Router.php"),
  '1477486898:680590' => __autoloader_ID680590 ("Compound/Сontroller/Session.php"),
  '1275444788:680590' => __autoloader_ID680590 ("Compound/Сontroller/Store.php"),
  '3679553124:680590' => __autoloader_ID680590 ("Compound/Сontroller/TWIG.php"),
  '5383872269:680590' => __autoloader_ID680590 ("Compound/Сontroller/TagsManager.php"),
  '3932694503:680590' => __autoloader_ID680590 ("Compound/Adapter/AJAX.php"),
  '5737619479:680590' => __autoloader_ID680590 ("Compound/Strategy/admin.php"),
  '3313399453:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/__for_develop.php"),
  '7721599568:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/cloneTemplate.php"),
  '4479140844:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/createPage.php"),
  '6976084570:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/insertComponent.php"),
  '4624913275:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/insertTemplate.php"),
  '6263423105:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/propsPage.php"),
  '2607734404:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/propsTemplate.php"),
  '5326614522:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/removeTemplate.php"),
  '7416834617:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/sortOrder.php"),
  '2630666386:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/updatePage.php"),
  '5056477453:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/updateProps.php"),
  '4445016138:680590' => __autoloader_ID680590 ("Compound/Pattern/Compound/updateTemplateProps.php"),
  '2121720509:680590' => __autoloader_ID680590 ("Compound/Engine/Application.php"),
);
