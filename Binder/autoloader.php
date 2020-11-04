<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_125097", 'ID125097');
define ("AUTOLOADER_PATH_125097", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID125097 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '2816622771:125097' => __autoloader_ID125097 ("Binder/Component/Navbar/Children/menu.php"),
  '1397192394:125097' => __autoloader_ID125097 ("Binder/Component/Button/component.php"),
  '6113660126:125097' => __autoloader_ID125097 ("Binder/Component/Cart/component.php"),
  '1440072538:125097' => __autoloader_ID125097 ("Binder/Component/Checkbox/component.php"),
  '4061056795:125097' => __autoloader_ID125097 ("Binder/Component/Editor/component.php"),
  '1901080031:125097' => __autoloader_ID125097 ("Binder/Component/Footer/component.php"),
  '2009410062:125097' => __autoloader_ID125097 ("Binder/Component/FormField/component.php"),
  '6561601649:125097' => __autoloader_ID125097 ("Binder/Component/HTMLTag/component.php"),
  '7666030395:125097' => __autoloader_ID125097 ("Binder/Component/Input/component.php"),
  '5039064445:125097' => __autoloader_ID125097 ("Binder/Component/Label/component.php"),
  '3236009294:125097' => __autoloader_ID125097 ("Binder/Component/Navbar/component.php"),
  '5107585737:125097' => __autoloader_ID125097 ("Binder/Component/Notice/component.php"),
  '2118926283:125097' => __autoloader_ID125097 ("Binder/Component/Radio/component.php"),
  '3794721444:125097' => __autoloader_ID125097 ("Binder/Component/Select/component.php"),
  '5310014718:125097' => __autoloader_ID125097 ("Binder/Component/Sidebar/component.php"),
  '7621141348:125097' => __autoloader_ID125097 ("Binder/Component/Textarea/component.php"),
  '5822100898:125097' => __autoloader_ID125097 ("Binder/Component/WidgetFactory/component.php"),
  '4808815098:125097' => __autoloader_ID125097 ("Binder/Template/Emptys/default.php"),
  '7959331548:125097' => __autoloader_ID125097 ("Binder/Template/Grid/default.php"),
  '3926633516:125097' => __autoloader_ID125097 ("Binder/Template/Headers/default.php"),
  '3590545125:125097' => __autoloader_ID125097 ("Binder/Template/Matrix/4x4.php"),
  '2938198038:125097' => __autoloader_ID125097 ("Binder/Template/Matrix/6x6.php"),
  '2346277061:125097' => __autoloader_ID125097 ("Binder/Template/Matrix/template.php"),
);
