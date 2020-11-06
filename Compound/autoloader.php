<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_167167", 'ID167167');
define ("AUTOLOADER_PATH_167167", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID167167 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '7837072682:167167' => __autoloader_ID167167 ("Compound/Instance/Protector.php"),
  '4714976552:167167' => __autoloader_ID167167 ("Compound/Interface/CompoundComponent.php"),
  '4386462563:167167' => __autoloader_ID167167 ("Compound/Interface/NetworkRequest.php"),
  '5549056256:167167' => __autoloader_ID167167 ("Compound/Trait/__caller.php"),
  '1012903594:167167' => __autoloader_ID167167 ("Compound/Trait/__getter.php"),
  '5613807753:167167' => __autoloader_ID167167 ("Compound/Trait/__isset.php"),
  '4505295961:167167' => __autoloader_ID167167 ("Compound/Trait/__setter.php"),
  '1022354486:167167' => __autoloader_ID167167 ("Compound/Trait/__unset.php"),
  '4189869164:167167' => __autoloader_ID167167 ("Compound/Instance/Component.php"),
  '4574512771:167167' => __autoloader_ID167167 ("Compound/Instance/Config.php"),
  '4876027999:167167' => __autoloader_ID167167 ("Compound/Instance/Construction.php"),
  '5678254736:167167' => __autoloader_ID167167 ("Compound/Instance/Data.php"),
  '1685407177:167167' => __autoloader_ID167167 ("Compound/Instance/Directive.php"),
  '6854183905:167167' => __autoloader_ID167167 ("Compound/Instance/Document.php"),
  '4177393490:167167' => __autoloader_ID167167 ("Compound/Instance/Field.php"),
  '6800479585:167167' => __autoloader_ID167167 ("Compound/Instance/Option.php"),
  '3046369506:167167' => __autoloader_ID167167 ("Compound/Instance/Protector.php"),
  '1802181223:167167' => __autoloader_ID167167 ("Compound/Instance/Request.php"),
  '2677670282:167167' => __autoloader_ID167167 ("Compound/Instance/Response.php"),
  '6270535409:167167' => __autoloader_ID167167 ("Compound/Instance/Strategy.php"),
  '7480759999:167167' => __autoloader_ID167167 ("Compound/Instance/Stringer.php"),
  '7794641786:167167' => __autoloader_ID167167 ("Compound/Instance/Tag.php"),
  '6736288534:167167' => __autoloader_ID167167 ("Compound/Instance/Template.php"),
  '3455703466:167167' => __autoloader_ID167167 ("Compound/Prototype/Pattern.php"),
  '1396819078:167167' => __autoloader_ID167167 ("Compound/Module/Converter.php"),
  '4800723496:167167' => __autoloader_ID167167 ("Compound/Module/Option.php"),
  '3661977387:167167' => __autoloader_ID167167 ("Compound/Module/WP.php"),
  '3464664304:167167' => __autoloader_ID167167 ("Compound/Module/WPGNU.php"),
  '6636972711:167167' => __autoloader_ID167167 ("Compound/Сontroller/Apps.php"),
  '3383459878:167167' => __autoloader_ID167167 ("Compound/Сontroller/Constructor.php"),
  '2994835487:167167' => __autoloader_ID167167 ("Compound/Сontroller/Customizer.php"),
  '3036466083:167167' => __autoloader_ID167167 ("Compound/Сontroller/Grider.php"),
  '6190002664:167167' => __autoloader_ID167167 ("Compound/Сontroller/Lexer.php"),
  '1622082213:167167' => __autoloader_ID167167 ("Compound/Сontroller/Network.php"),
  '3875036450:167167' => __autoloader_ID167167 ("Compound/Сontroller/Router.php"),
  '4935530307:167167' => __autoloader_ID167167 ("Compound/Сontroller/Session.php"),
  '1986664224:167167' => __autoloader_ID167167 ("Compound/Сontroller/Store.php"),
  '7809454510:167167' => __autoloader_ID167167 ("Compound/Сontroller/TWIG.php"),
  '7346087395:167167' => __autoloader_ID167167 ("Compound/Сontroller/TagsManager.php"),
  '2335159388:167167' => __autoloader_ID167167 ("Compound/Adapter/AJAX.php"),
  '7810357290:167167' => __autoloader_ID167167 ("Compound/Strategy/admin.php"),
  '4024439158:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/__for_develop.php"),
  '7763078317:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/cloneTemplate.php"),
  '7871415104:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/createPage.php"),
  '2115925241:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/insertComponent.php"),
  '3546768683:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/insertTemplate.php"),
  '1044488067:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/propsPage.php"),
  '6091434398:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/propsTemplate.php"),
  '5289830916:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/removeTemplate.php"),
  '5514278738:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/sortOrder.php"),
  '7144434944:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/updatePage.php"),
  '4142517098:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/updateProps.php"),
  '1322136796:167167' => __autoloader_ID167167 ("Compound/Pattern/Compound/updateTemplateProps.php"),
  '7275539541:167167' => __autoloader_ID167167 ("Compound/Engine/Application.php"),
);
