<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_688543", 'ID688543');
define ("AUTOLOADER_PATH_688543", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID688543 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '1626831545:688543' => __autoloader_ID688543 ("Compound/Instance/Protector.php"),
  '2707259555:688543' => __autoloader_ID688543 ("Compound/Interface/IRequest.php"),
  '7811316622:688543' => __autoloader_ID688543 ("Compound/Interface/Seller.php"),
  '6423511234:688543' => __autoloader_ID688543 ("Compound/Interface/Storage.php"),
  '1464099560:688543' => __autoloader_ID688543 ("Compound/Trait/__caller.php"),
  '7086350018:688543' => __autoloader_ID688543 ("Compound/Trait/__getter.php"),
  '7034706344:688543' => __autoloader_ID688543 ("Compound/Trait/__isset.php"),
  '1063148334:688543' => __autoloader_ID688543 ("Compound/Trait/__setter.php"),
  '1640777931:688543' => __autoloader_ID688543 ("Compound/Trait/__unset.php"),
  '4393355850:688543' => __autoloader_ID688543 ("Compound/Instance/Component.php"),
  '4394596334:688543' => __autoloader_ID688543 ("Compound/Instance/Config.php"),
  '1590290217:688543' => __autoloader_ID688543 ("Compound/Instance/Construction.php"),
  '5193018586:688543' => __autoloader_ID688543 ("Compound/Instance/Data.php"),
  '1752812461:688543' => __autoloader_ID688543 ("Compound/Instance/Directive.php"),
  '6794345618:688543' => __autoloader_ID688543 ("Compound/Instance/Document.php"),
  '6377137214:688543' => __autoloader_ID688543 ("Compound/Instance/Field.php"),
  '3917566200:688543' => __autoloader_ID688543 ("Compound/Instance/Layout.php"),
  '6486623961:688543' => __autoloader_ID688543 ("Compound/Instance/Option.php"),
  '3357093015:688543' => __autoloader_ID688543 ("Compound/Instance/Protector.php"),
  '7723338498:688543' => __autoloader_ID688543 ("Compound/Instance/Request.php"),
  '1715329757:688543' => __autoloader_ID688543 ("Compound/Instance/Response.php"),
  '4315502599:688543' => __autoloader_ID688543 ("Compound/Instance/Strategy.php"),
  '7575810199:688543' => __autoloader_ID688543 ("Compound/Instance/Stringer.php"),
  '1695326094:688543' => __autoloader_ID688543 ("Compound/Instance/Tag.php"),
  '4203329495:688543' => __autoloader_ID688543 ("Compound/Instance/Template.php"),
  '2670694101:688543' => __autoloader_ID688543 ("Compound/Prototype/Pattern.php"),
  '7580862644:688543' => __autoloader_ID688543 ("Compound/Module/Converter.php"),
  '3686525953:688543' => __autoloader_ID688543 ("Compound/Module/Option.php"),
  '1283572583:688543' => __autoloader_ID688543 ("Compound/Module/WP.php"),
  '3091359558:688543' => __autoloader_ID688543 ("Compound/Module/WPGNU.php"),
  '1687973130:688543' => __autoloader_ID688543 ("Compound/Сontroller/Apps.php"),
  '2231265650:688543' => __autoloader_ID688543 ("Compound/Сontroller/Constructor.php"),
  '2723826863:688543' => __autoloader_ID688543 ("Compound/Сontroller/Controller.php"),
  '5090711689:688543' => __autoloader_ID688543 ("Compound/Сontroller/Customizer.php"),
  '5096403222:688543' => __autoloader_ID688543 ("Compound/Сontroller/Grider.php"),
  '2033647223:688543' => __autoloader_ID688543 ("Compound/Сontroller/Lexer.php"),
  '7893078863:688543' => __autoloader_ID688543 ("Compound/Сontroller/Network.php"),
  '5048238509:688543' => __autoloader_ID688543 ("Compound/Сontroller/Router.php"),
  '1626043954:688543' => __autoloader_ID688543 ("Compound/Сontroller/Session.php"),
  '1911107973:688543' => __autoloader_ID688543 ("Compound/Сontroller/Store.php"),
  '7099821323:688543' => __autoloader_ID688543 ("Compound/Сontroller/TWIG.php"),
  '5074527061:688543' => __autoloader_ID688543 ("Compound/Сontroller/TagsManager.php"),
  '5783114644:688543' => __autoloader_ID688543 ("Compound/Adapter/AJAX.php"),
  '5067312528:688543' => __autoloader_ID688543 ("Compound/Strategy/admin.php"),
  '2300767262:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/__for_develop.php"),
  '6077818728:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/cloneTemplate.php"),
  '4398304695:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/createPage.php"),
  '2395406847:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/insertComponent.php"),
  '7383768869:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/insertTemplate.php"),
  '1796572728:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/propsPage.php"),
  '1822470567:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/propsTemplate.php"),
  '1764364008:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/removeTemplate.php"),
  '6329041021:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/sortOrder.php"),
  '6061992598:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/updatePage.php"),
  '4172767563:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/updateProps.php"),
  '1548235013:688543' => __autoloader_ID688543 ("Compound/Pattern/Compound/updateTemplateProps.php"),
  '4589603786:688543' => __autoloader_ID688543 ("Compound/Engine/Application.php"),
);
