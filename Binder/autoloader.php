<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_605567", 'ID605567');
define ("AUTOLOADER_PATH_605567", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID605567 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '6436749449:605567' => __autoloader_ID605567 ("Binder/Component/Navbar/Children/menu.php"),
  '4913826781:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Forms/Children/Billing/component.php"),
  '3524908242:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Forms/Children/Shipping/component.php"),
  '7606820799:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Table/Children/Cart/component.php"),
  '2667996716:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Table/Children/Downloads/component.php"),
  '7704708493:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Table/Children/Orders/component.php"),
  '1457470844:605567' => __autoloader_ID605567 ("Binder/Component/Navbar/Children/Before/component.php"),
  '2831552917:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Placeholders/Cart/component.php"),
  '2487037117:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Placeholders/Downloads/component.php"),
  '5738860979:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Placeholders/Orders/component.php"),
  '2717837679:605567' => __autoloader_ID605567 ("Binder/Component/Navbar/Children/menu.php"),
  '1833634607:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Carousel/component.php"),
  '5193419977:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Gallery/component.php"),
  '2023700442:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Note/component.php"),
  '4338213298:605567' => __autoloader_ID605567 ("Binder/Component/Woocommerce/Step/component.php"),
  '3865811667:605567' => __autoloader_ID605567 ("Binder/Component/Button/component.php"),
  '3235494962:605567' => __autoloader_ID605567 ("Binder/Component/Cart/component.php"),
  '2951726898:605567' => __autoloader_ID605567 ("Binder/Component/Checkbox/component.php"),
  '4079305603:605567' => __autoloader_ID605567 ("Binder/Component/Editor/component.php"),
  '6846187336:605567' => __autoloader_ID605567 ("Binder/Component/Footer/component.php"),
  '3034976530:605567' => __autoloader_ID605567 ("Binder/Component/FormField/component.php"),
  '7322997633:605567' => __autoloader_ID605567 ("Binder/Component/HTMLTag/component.php"),
  '6027685358:605567' => __autoloader_ID605567 ("Binder/Component/Input/component.php"),
  '6684503094:605567' => __autoloader_ID605567 ("Binder/Component/Label/component.php"),
  '7367203938:605567' => __autoloader_ID605567 ("Binder/Component/Meta/component.php"),
  '1910064075:605567' => __autoloader_ID605567 ("Binder/Component/Navbar/component.php"),
  '4199077391:605567' => __autoloader_ID605567 ("Binder/Component/Notice/component.php"),
  '2347161388:605567' => __autoloader_ID605567 ("Binder/Component/Radio/component.php"),
  '5272154264:605567' => __autoloader_ID605567 ("Binder/Component/Select/component.php"),
  '1846623918:605567' => __autoloader_ID605567 ("Binder/Component/Sidebar/component.php"),
  '3498933511:605567' => __autoloader_ID605567 ("Binder/Component/Textarea/component.php"),
  '6817159180:605567' => __autoloader_ID605567 ("Binder/Component/WidgetFactory/component.php"),
  '1413152304:605567' => __autoloader_ID605567 ("Binder/Template/Emptys/template.php"),
  '2675980130:605567' => __autoloader_ID605567 ("Binder/Template/Grid/template.php"),
  '1427575814:605567' => __autoloader_ID605567 ("Binder/Template/Headers/template.php"),
  '3994022395:605567' => __autoloader_ID605567 ("Binder/Template/Matrix/4x4.php"),
  '5921539859:605567' => __autoloader_ID605567 ("Binder/Template/Matrix/6x6.php"),
);
