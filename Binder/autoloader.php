<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_214793", 'ID214793');
define ("AUTOLOADER_PATH_214793", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID214793 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '5661513523:214793' => __autoloader_ID214793 ("Binder/Component/Navbar/Children/menu.php"),
  '3263623670:214793' => __autoloader_ID214793 ("Binder/Component/Button/component.php"),
  '3697514413:214793' => __autoloader_ID214793 ("Binder/Component/Cart/component.php"),
  '5625183907:214793' => __autoloader_ID214793 ("Binder/Component/Checkbox/component.php"),
  '5363720485:214793' => __autoloader_ID214793 ("Binder/Component/Editor/component.php"),
  '3323464824:214793' => __autoloader_ID214793 ("Binder/Component/Footer/component.php"),
  '4476822277:214793' => __autoloader_ID214793 ("Binder/Component/FormField/component.php"),
  '2148376262:214793' => __autoloader_ID214793 ("Binder/Component/HTMLTag/component.php"),
  '3451080910:214793' => __autoloader_ID214793 ("Binder/Component/Input/component.php"),
  '1295054540:214793' => __autoloader_ID214793 ("Binder/Component/Label/component.php"),
  '1563767306:214793' => __autoloader_ID214793 ("Binder/Component/Navbar/component.php"),
  '3405760557:214793' => __autoloader_ID214793 ("Binder/Component/Notice/component.php"),
  '3599514246:214793' => __autoloader_ID214793 ("Binder/Component/Radio/component.php"),
  '4542075559:214793' => __autoloader_ID214793 ("Binder/Component/Select/component.php"),
  '7834725416:214793' => __autoloader_ID214793 ("Binder/Component/Sidebar/component.php"),
  '1994924080:214793' => __autoloader_ID214793 ("Binder/Component/Textarea/component.php"),
  '2371552415:214793' => __autoloader_ID214793 ("Binder/Component/WidgetFactory/component.php"),
  '5167518675:214793' => __autoloader_ID214793 ("Binder/Component/Navbar/Children/menu.php"),
  '6210647115:214793' => __autoloader_ID214793 ("Binder/Component/Woocommerce/Carousel/component.php"),
  '4018685237:214793' => __autoloader_ID214793 ("Binder/Component/Woocommerce/Gallery/component.php"),
  '4166291145:214793' => __autoloader_ID214793 ("Binder/Component/Woocommerce/Note/component.php"),
  '5650588946:214793' => __autoloader_ID214793 ("Binder/Component/Woocommerce/Step/component.php"),
  '6521505179:214793' => __autoloader_ID214793 ("Binder/Component/Woocommerce/Placeholders/Cart/component.php"),
  '3743430052:214793' => __autoloader_ID214793 ("Binder/Component/Woocommerce/Placeholders/Downloads/component.php"),
  '4440063636:214793' => __autoloader_ID214793 ("Binder/Component/Woocommerce/Placeholders/Orders/component.php"),
  '7301390284:214793' => __autoloader_ID214793 ("Binder/Template/Emptys/template.php"),
  '1331332770:214793' => __autoloader_ID214793 ("Binder/Template/Grid/template.php"),
  '5773188149:214793' => __autoloader_ID214793 ("Binder/Template/Headers/template.php"),
  '5125070249:214793' => __autoloader_ID214793 ("Binder/Template/Matrix/4x4.php"),
  '7008250959:214793' => __autoloader_ID214793 ("Binder/Template/Matrix/6x6.php"),
);
