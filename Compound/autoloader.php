<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_452730", 'ID452730');
define ("AUTOLOADER_PATH_452730", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID452730 (string $file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '1992764617:452730' => __autoloader_ID452730 ("Compound/Interface/IRequest.php"),
  '5413373307:452730' => __autoloader_ID452730 ("Compound/Interface/Iterator_Interface.php"),
  '5844348878:452730' => __autoloader_ID452730 ("Compound/Interface/Seller.php"),
  '5820183260:452730' => __autoloader_ID452730 ("Compound/Interface/Storage.php"),
  '1966482814:452730' => __autoloader_ID452730 ("Compound/Traits/__caller.php"),
  '5588140244:452730' => __autoloader_ID452730 ("Compound/Traits/__getter.php"),
  '6457000633:452730' => __autoloader_ID452730 ("Compound/Traits/__isset.php"),
  '5878188678:452730' => __autoloader_ID452730 ("Compound/Traits/__setter.php"),
  '4765627006:452730' => __autoloader_ID452730 ("Compound/Traits/__unset.php"),
  '7885120367:452730' => __autoloader_ID452730 ("Compound/Instance/Buffer.php"),
  '6915752937:452730' => __autoloader_ID452730 ("Compound/Instance/Cache.php"),
  '7831343677:452730' => __autoloader_ID452730 ("Compound/Instance/Component.php"),
  '3481703602:452730' => __autoloader_ID452730 ("Compound/Instance/Config.php"),
  '3273066360:452730' => __autoloader_ID452730 ("Compound/Instance/Construction.php"),
  '6803285010:452730' => __autoloader_ID452730 ("Compound/Instance/Directive.php"),
  '2703148986:452730' => __autoloader_ID452730 ("Compound/Instance/Document.php"),
  '1206636888:452730' => __autoloader_ID452730 ("Compound/Instance/Field.php"),
  '4125027981:452730' => __autoloader_ID452730 ("Compound/Instance/Inter.php"),
  '1926617142:452730' => __autoloader_ID452730 ("Compound/Instance/Iterator.php"),
  '5553027933:452730' => __autoloader_ID452730 ("Compound/Instance/Layout.php"),
  '4663762160:452730' => __autoloader_ID452730 ("Compound/Instance/Lex.php"),
  '3021582731:452730' => __autoloader_ID452730 ("Compound/Instance/MFile.php"),
  '7756830316:452730' => __autoloader_ID452730 ("Compound/Instance/Option.php"),
  '1190181484:452730' => __autoloader_ID452730 ("Compound/Instance/Request.php"),
  '1563106566:452730' => __autoloader_ID452730 ("Compound/Instance/Response.php"),
  '5588567306:452730' => __autoloader_ID452730 ("Compound/Instance/Strategy.php"),
  '2897702576:452730' => __autoloader_ID452730 ("Compound/Instance/Stringer.php"),
  '3101798062:452730' => __autoloader_ID452730 ("Compound/Instance/Tag.php"),
  '4400566363:452730' => __autoloader_ID452730 ("Compound/Instance/Template.php"),
  '1663287696:452730' => __autoloader_ID452730 ("Compound/Prototypes/Pattern.php"),
  '4979391245:452730' => __autoloader_ID452730 ("Compound/Сontroller/AJAX.php"),
  '4413777284:452730' => __autoloader_ID452730 ("Compound/Сontroller/Apps.php"),
  '6746825945:452730' => __autoloader_ID452730 ("Compound/Сontroller/Constructor.php"),
  '1850438637:452730' => __autoloader_ID452730 ("Compound/Сontroller/Customizer.php"),
  '2323613374:452730' => __autoloader_ID452730 ("Compound/Сontroller/Grider.php"),
  '1327120445:452730' => __autoloader_ID452730 ("Compound/Сontroller/Lexer.php"),
  '6077058725:452730' => __autoloader_ID452730 ("Compound/Сontroller/Router.php"),
  '7950428804:452730' => __autoloader_ID452730 ("Compound/Сontroller/Session.php"),
  '5629943752:452730' => __autoloader_ID452730 ("Compound/Сontroller/Store.php"),
  '1098057959:452730' => __autoloader_ID452730 ("Compound/Сontroller/TWIG.php"),
  '7281532847:452730' => __autoloader_ID452730 ("Compound/Сontroller/TagsManager.php"),
  '6106643455:452730' => __autoloader_ID452730 ("Compound/Strategys/admin.php"),
  '6013011775:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/__for_develop.php"),
  '1964280857:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/cloneTemplate.php"),
  '2391098183:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/createPage.php"),
  '1143815525:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/insertComponent.php"),
  '7886065462:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/insertTemplate.php"),
  '4532468718:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/propsPage.php"),
  '3247771797:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/propsTemplate.php"),
  '1140499615:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/removeTemplate.php"),
  '1889247352:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/sortOrder.php"),
  '1242421893:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/updatePage.php"),
  '6999329692:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/updateProps.php"),
  '1087666323:452730' => __autoloader_ID452730 ("Compound/Patterns/Compound/updateTemplateProps.php"),
  '6409096664:452730' => __autoloader_ID452730 ("Compound/Engine/Application.php"),
  '3095826077:452730' => __autoloader_ID452730 ("Compound/Engine/Render.php"),
);
