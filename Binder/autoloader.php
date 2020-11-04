<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_887632", 'ID887632');
define ("AUTOLOADER_PATH_887632", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID887632 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '1708243791:887632' => __autoloader_ID887632 ("Binder/Component/Navbar/Children/menu.php"),
  '3331752891:887632' => __autoloader_ID887632 ("Binder/Component/Button/component.php"),
  '7354549171:887632' => __autoloader_ID887632 ("Binder/Component/Cart/component.php"),
  '1458530708:887632' => __autoloader_ID887632 ("Binder/Component/Checkbox/component.php"),
  '5849043060:887632' => __autoloader_ID887632 ("Binder/Component/Editor/component.php"),
  '7989066611:887632' => __autoloader_ID887632 ("Binder/Component/Footer/component.php"),
  '6575969242:887632' => __autoloader_ID887632 ("Binder/Component/FormField/component.php"),
  '5505162120:887632' => __autoloader_ID887632 ("Binder/Component/HTMLTag/component.php"),
  '3074473480:887632' => __autoloader_ID887632 ("Binder/Component/Input/component.php"),
  '3154311313:887632' => __autoloader_ID887632 ("Binder/Component/Label/component.php"),
  '2012469473:887632' => __autoloader_ID887632 ("Binder/Component/Navbar/component.php"),
  '2961096066:887632' => __autoloader_ID887632 ("Binder/Component/Notice/component.php"),
  '6586964785:887632' => __autoloader_ID887632 ("Binder/Component/Radio/component.php"),
  '6943710731:887632' => __autoloader_ID887632 ("Binder/Component/Select/component.php"),
  '1913254925:887632' => __autoloader_ID887632 ("Binder/Component/Sidebar/component.php"),
  '7686362798:887632' => __autoloader_ID887632 ("Binder/Component/Textarea/component.php"),
  '2299979690:887632' => __autoloader_ID887632 ("Binder/Component/WidgetFactory/component.php"),
  '4750485457:887632' => __autoloader_ID887632 ("Binder/Template/Emptys/template.php"),
  '5655461361:887632' => __autoloader_ID887632 ("Binder/Template/Grid/template.php"),
  '4991419368:887632' => __autoloader_ID887632 ("Binder/Template/Headers/template.php"),
  '2996094061:887632' => __autoloader_ID887632 ("Binder/Template/Matrix/4x4.php"),
  '6412683496:887632' => __autoloader_ID887632 ("Binder/Template/Matrix/6x6.php"),
);
