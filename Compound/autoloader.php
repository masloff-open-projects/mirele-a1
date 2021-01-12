<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_357054", 'ID357054');
define ("AUTOLOADER_PATH_357054", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID357054 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '6950167387:357054' => __autoloader_ID357054 ("Compound/Extends/Router.php"),
  '1248846226:357054' => __autoloader_ID357054 ("Compound/Extends/Storage.php"),
  '4885387986:357054' => __autoloader_ID357054 ("Compound/Instance/Protector.php"),
  '5355080749:357054' => __autoloader_ID357054 ("Compound/Interface/CompoundComponent.php"),
  '7664105329:357054' => __autoloader_ID357054 ("Compound/Interface/NetworkRequest.php"),
  '4968995638:357054' => __autoloader_ID357054 ("Compound/Trait/__caller.php"),
  '4484904622:357054' => __autoloader_ID357054 ("Compound/Trait/__getter.php"),
  '5442667097:357054' => __autoloader_ID357054 ("Compound/Trait/__isset.php"),
  '3565036165:357054' => __autoloader_ID357054 ("Compound/Trait/__setter.php"),
  '3220440992:357054' => __autoloader_ID357054 ("Compound/Trait/__unset.php"),
  '7506812509:357054' => __autoloader_ID357054 ("Compound/Instance/Component.php"),
  '2335343851:357054' => __autoloader_ID357054 ("Compound/Instance/Document.php"),
  '4778664599:357054' => __autoloader_ID357054 ("Compound/Instance/Option.php"),
  '3960285063:357054' => __autoloader_ID357054 ("Compound/Instance/Protector.php"),
  '6320554595:357054' => __autoloader_ID357054 ("Compound/Instance/Request.php"),
  '6843753170:357054' => __autoloader_ID357054 ("Compound/Instance/Response.php"),
  '6249060225:357054' => __autoloader_ID357054 ("Compound/Instance/Strategy.php"),
  '7863257282:357054' => __autoloader_ID357054 ("Compound/Instance/Template.php"),
  '5982072781:357054' => __autoloader_ID357054 ("Compound/Module/Converter.php"),
  '7035362020:357054' => __autoloader_ID357054 ("Compound/Module/Option.php"),
  '6343907972:357054' => __autoloader_ID357054 ("Compound/Module/WP.php"),
  '1098225555:357054' => __autoloader_ID357054 ("Compound/Module/WPGNU.php"),
  '5712892893:357054' => __autoloader_ID357054 ("Compound/Сontroller/Certificate.php"),
  '1268250923:357054' => __autoloader_ID357054 ("Compound/Сontroller/Constructor.php"),
  '7939659515:357054' => __autoloader_ID357054 ("Compound/Сontroller/Customizer.php"),
  '2611850755:357054' => __autoloader_ID357054 ("Compound/Сontroller/Lexer.php"),
  '5392735831:357054' => __autoloader_ID357054 ("Compound/Сontroller/Market.php"),
  '1266278224:357054' => __autoloader_ID357054 ("Compound/Сontroller/Module.php"),
  '7460505081:357054' => __autoloader_ID357054 ("Compound/Сontroller/Network.php"),
  '4548744331:357054' => __autoloader_ID357054 ("Compound/Сontroller/Repository.php"),
  '7370492709:357054' => __autoloader_ID357054 ("Compound/Сontroller/Router.php"),
  '3858733698:357054' => __autoloader_ID357054 ("Compound/Сontroller/Session.php"),
  '2469763243:357054' => __autoloader_ID357054 ("Compound/Сontroller/TWIG.php"),
  '7075631460:357054' => __autoloader_ID357054 ("Compound/Adapter/AJAX.php"),
  '2434099940:357054' => __autoloader_ID357054 ("Compound/Strategy/CompoundPrivate.php"),
  '3538544597:357054' => __autoloader_ID357054 ("Compound/Strategy/__strategy_admin.php"),
  '2397167904:357054' => __autoloader_ID357054 ("Compound/Helpers/Modules/Compound.php"),
  '4184488654:357054' => __autoloader_ID357054 ("Compound/Helpers/Modules/Document.php"),
  '3844987414:357054' => __autoloader_ID357054 ("Compound/Helpers/Modules/HTML.php"),
  '6947523675:357054' => __autoloader_ID357054 ("Compound/Helpers/Modules/URL.php"),
  '6189805656:357054' => __autoloader_ID357054 ("Compound/Helpers/Modules/WP.php"),
  '3360511090:357054' => __autoloader_ID357054 ("Compound/Helpers/Helpers.php"),
  '6499502878:357054' => __autoloader_ID357054 ("Compound/Document/Extension.php"),
  '3806232207:357054' => __autoloader_ID357054 ("Compound/Document/Prepare.php"),
  '6004445638:357054' => __autoloader_ID357054 ("Compound/Document/Route.php"),
  '6876345500:357054' => __autoloader_ID357054 ("Compound/Document/TWIG.php"),
);
