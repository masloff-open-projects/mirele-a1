<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_358484", 'ID358484');
define ("AUTOLOADER_PATH_358484", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID358484 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '4358526619:358484' => __autoloader_ID358484 ("Binder/Component/Navbar/Children/menu.php"),
  '6720344277:358484' => __autoloader_ID358484 ("Binder/Component/Button/component.php"),
  '4591538584:358484' => __autoloader_ID358484 ("Binder/Component/Cart/component.php"),
  '1806875881:358484' => __autoloader_ID358484 ("Binder/Component/Checkbox/component.php"),
  '1175138423:358484' => __autoloader_ID358484 ("Binder/Component/Editor/component.php"),
  '1012674595:358484' => __autoloader_ID358484 ("Binder/Component/Footer/component.php"),
  '4423066739:358484' => __autoloader_ID358484 ("Binder/Component/FormField/component.php"),
  '3652115923:358484' => __autoloader_ID358484 ("Binder/Component/HTMLTag/component.php"),
  '3631337527:358484' => __autoloader_ID358484 ("Binder/Component/Input/component.php"),
  '5609674023:358484' => __autoloader_ID358484 ("Binder/Component/Label/component.php"),
  '2840525770:358484' => __autoloader_ID358484 ("Binder/Component/Navbar/component.php"),
  '2479811164:358484' => __autoloader_ID358484 ("Binder/Component/Notice/component.php"),
  '7237178434:358484' => __autoloader_ID358484 ("Binder/Component/Radio/component.php"),
  '6423407674:358484' => __autoloader_ID358484 ("Binder/Component/Select/component.php"),
  '5797380635:358484' => __autoloader_ID358484 ("Binder/Component/Sidebar/component.php"),
  '7491449036:358484' => __autoloader_ID358484 ("Binder/Component/Textarea/component.php"),
  '3735743631:358484' => __autoloader_ID358484 ("Binder/Component/WidgetFactory/component.php"),
  '2321386870:358484' => __autoloader_ID358484 ("Binder/Component/Navbar/Children/menu.php"),
  '3865415978:358484' => __autoloader_ID358484 ("Binder/Component/Woocommerce/Carousel/component.php"),
  '5288150137:358484' => __autoloader_ID358484 ("Binder/Component/Woocommerce/Gallery/component.php"),
  '5444816053:358484' => __autoloader_ID358484 ("Binder/Component/Woocommerce/Note/component.php"),
  '4121174827:358484' => __autoloader_ID358484 ("Binder/Component/Woocommerce/Step/component.php"),
  '3649501857:358484' => __autoloader_ID358484 ("Binder/Component/Woocommerce/Placeholders/Cart/component.php"),
  '6261147238:358484' => __autoloader_ID358484 ("Binder/Component/Woocommerce/Placeholders/Downloads/component.php"),
  '7899727855:358484' => __autoloader_ID358484 ("Binder/Component/Woocommerce/Placeholders/Orders/component.php"),
  '6412175762:358484' => __autoloader_ID358484 ("Binder/Template/Emptys/template.php"),
  '7361475197:358484' => __autoloader_ID358484 ("Binder/Template/Grid/template.php"),
  '2253190923:358484' => __autoloader_ID358484 ("Binder/Template/Headers/template.php"),
  '6891799177:358484' => __autoloader_ID358484 ("Binder/Template/Matrix/4x4.php"),
  '3170235285:358484' => __autoloader_ID358484 ("Binder/Template/Matrix/6x6.php"),
);
