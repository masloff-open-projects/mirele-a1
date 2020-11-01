<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_535770", 'ID535770');
define ("AUTOLOADER_PATH_535770", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID535770 (string $file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '2076048769:535770' => __autoloader_ID535770 ("Binders/Components/Navbar/Children/menu.php"),
  '3189524061:535770' => __autoloader_ID535770 ("Binders/Components/Button/component.php"),
  '2287020605:535770' => __autoloader_ID535770 ("Binders/Components/Cart/component.php"),
  '5310091570:535770' => __autoloader_ID535770 ("Binders/Components/Checkbox/component.php"),
  '5577421669:535770' => __autoloader_ID535770 ("Binders/Components/Footer/component.php"),
  '7582983600:535770' => __autoloader_ID535770 ("Binders/Components/FormField/component.php"),
  '1670125804:535770' => __autoloader_ID535770 ("Binders/Components/HTMLTag/component.php"),
  '3770769149:535770' => __autoloader_ID535770 ("Binders/Components/Input/component.php"),
  '4502821655:535770' => __autoloader_ID535770 ("Binders/Components/Label/component.php"),
  '1417637491:535770' => __autoloader_ID535770 ("Binders/Components/Navbar/component.php"),
  '3282833533:535770' => __autoloader_ID535770 ("Binders/Components/Notice/component.php"),
  '3461804834:535770' => __autoloader_ID535770 ("Binders/Components/Radio/component.php"),
  '3564844429:535770' => __autoloader_ID535770 ("Binders/Components/Select/component.php"),
  '2309373335:535770' => __autoloader_ID535770 ("Binders/Components/Sidebar/component.php"),
  '1572029518:535770' => __autoloader_ID535770 ("Binders/Components/Textarea/component.php"),
  '6604454362:535770' => __autoloader_ID535770 ("Binders/Components/WidgetFactory/component.php"),
  '5389790585:535770' => __autoloader_ID535770 ("Binders/Templates/Emptys/default.php"),
  '3027015940:535770' => __autoloader_ID535770 ("Binders/Templates/Grid/default.php"),
  '3974168091:535770' => __autoloader_ID535770 ("Binders/Templates/Headers/default.php"),
  '7222238341:535770' => __autoloader_ID535770 ("Binders/Templates/Matrix/4x4.php"),
  '2811873087:535770' => __autoloader_ID535770 ("Binders/Templates/Matrix/6x6.php"),
  '2940924849:535770' => __autoloader_ID535770 ("Binders/Templates/Matrix/template.php"),
);
