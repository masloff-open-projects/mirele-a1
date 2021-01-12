<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_600778", 'ID600778');
define ("AUTOLOADER_PATH_600778", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID600778 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '1660809068:600778' => __autoloader_ID600778 ("Binder/Component/Navbar/Children/menu.php"),
  '2148235404:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Forms/Children/Billing/component.php"),
  '2286588193:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Forms/Children/Shipping/component.php"),
  '3726977472:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Table/Children/Cart/component.php"),
  '3981490942:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Table/Children/Downloads/component.php"),
  '1810766909:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Table/Children/Orders/component.php"),
  '7204805635:600778' => __autoloader_ID600778 ("Binder/Component/Navbar/Children/Before/component.php"),
  '1253244512:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Placeholders/Cart/component.php"),
  '2680868662:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Placeholders/Downloads/component.php"),
  '7729287535:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Placeholders/Orders/component.php"),
  '5978912166:600778' => __autoloader_ID600778 ("Binder/Component/Navbar/Children/menu.php"),
  '5046084137:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Carousel/component.php"),
  '4643198050:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Gallery/component.php"),
  '6803334802:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Note/component.php"),
  '1990534462:600778' => __autoloader_ID600778 ("Binder/Component/Woocommerce/Step/component.php"),
  '6995034652:600778' => __autoloader_ID600778 ("Binder/Component/Button/component.php"),
  '2865676939:600778' => __autoloader_ID600778 ("Binder/Component/Cart/component.php"),
  '4087364449:600778' => __autoloader_ID600778 ("Binder/Component/Checkbox/component.php"),
  '7605911264:600778' => __autoloader_ID600778 ("Binder/Component/Editor/component.php"),
  '7013378780:600778' => __autoloader_ID600778 ("Binder/Component/Footer/component.php"),
  '6143490639:600778' => __autoloader_ID600778 ("Binder/Component/FormField/component.php"),
  '6825950548:600778' => __autoloader_ID600778 ("Binder/Component/HTMLTag/component.php"),
  '4066171271:600778' => __autoloader_ID600778 ("Binder/Component/Input/component.php"),
  '7069785888:600778' => __autoloader_ID600778 ("Binder/Component/Label/component.php"),
  '2341125272:600778' => __autoloader_ID600778 ("Binder/Component/Meta/component.php"),
  '7423712438:600778' => __autoloader_ID600778 ("Binder/Component/Navbar/component.php"),
  '3608886565:600778' => __autoloader_ID600778 ("Binder/Component/Notice/component.php"),
  '6861134429:600778' => __autoloader_ID600778 ("Binder/Component/Radio/component.php"),
  '7427891102:600778' => __autoloader_ID600778 ("Binder/Component/Select/component.php"),
  '6230712671:600778' => __autoloader_ID600778 ("Binder/Component/Sidebar/component.php"),
  '4034411466:600778' => __autoloader_ID600778 ("Binder/Component/Text/component.php"),
  '5219295499:600778' => __autoloader_ID600778 ("Binder/Component/Textarea/component.php"),
  '6698456655:600778' => __autoloader_ID600778 ("Binder/Component/WidgetFactory/component.php"),
  '1467841830:600778' => __autoloader_ID600778 ("Binder/Template/Bootstrap/template.php"),
  '7663217935:600778' => __autoloader_ID600778 ("Binder/Template/Emptys/template.php"),
  '4025916267:600778' => __autoloader_ID600778 ("Binder/Template/Headers/template.php"),
  '7590747346:600778' => __autoloader_ID600778 ("Binder/Option/Developer.php"),
);
