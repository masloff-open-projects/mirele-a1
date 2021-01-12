<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_618826", 'ID618826');
define ("AUTOLOADER_PATH_618826", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID618826 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '7321229508:618826' => __autoloader_ID618826 ("Route/Compound/component.php"),
  '7100395364:618826' => __autoloader_ID618826 ("Route/Compound/markup.php"),
  '6759574557:618826' => __autoloader_ID618826 ("Route/Compound/store.php"),
  '4767021353:618826' => __autoloader_ID618826 ("Route/Compound/template.php"),
  '5824076292:618826' => __autoloader_ID618826 ("Route/Public/HTTP.php"),
  '5641886704:618826' => __autoloader_ID618826 ("Route/Public/WCAddToCart.php"),
  '5610319241:618826' => __autoloader_ID618826 ("Route/Public/login.php"),
  '2987002526:618826' => __autoloader_ID618826 ("Route/Public/namespaces.php"),
  '5891412207:618826' => __autoloader_ID618826 ("Route/Public/options.php"),
  '3079005305:618826' => __autoloader_ID618826 ("Route/Public/product.php"),
  '6178514388:618826' => __autoloader_ID618826 ("Route/Public/recoveryPassword.php"),
  '7624940934:618826' => __autoloader_ID618826 ("Route/Public/saveOption.php"),
  '7861833672:618826' => __autoloader_ID618826 ("Route/Public/signup.php"),
);
