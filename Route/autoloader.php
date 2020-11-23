<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_558389", 'ID558389');
define ("AUTOLOADER_PATH_558389", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID558389 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '3852069784:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-cloneTemplate.php"),
  '5386201700:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-createPage.php"),
  '2022947406:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-getMarkup.php"),
  '1603275125:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-getPage.php"),
  '6505332415:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-getProps.php"),
  '2232286573:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-getTemplateProps.php"),
  '7480638747:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-insertComponent.php"),
  '4518150310:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-insertTemplate.php"),
  '5353754474:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-removeTemplate.php"),
  '3592402819:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-sortOrder.php"),
  '3820306582:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-updatePage.php"),
  '2081094673:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-updateProps.php"),
  '6890367456:558389' => __autoloader_ID558389 ("Route/axios/private/Compound-updateTemplateProps.php"),
  '4956004675:558389' => __autoloader_ID558389 ("Route/axios/public/HTTP.php"),
  '4102944955:558389' => __autoloader_ID558389 ("Route/axios/public/WCAddToCart.php"),
  '7471247376:558389' => __autoloader_ID558389 ("Route/axios/public/login.php"),
  '5347432012:558389' => __autoloader_ID558389 ("Route/axios/public/namespaces.php"),
  '1524248317:558389' => __autoloader_ID558389 ("Route/axios/public/options.php"),
  '7009589181:558389' => __autoloader_ID558389 ("Route/axios/public/product.php"),
  '1784435560:558389' => __autoloader_ID558389 ("Route/axios/public/recoveryPassword.php"),
  '3144243999:558389' => __autoloader_ID558389 ("Route/axios/public/saveOption.php"),
  '6519643739:558389' => __autoloader_ID558389 ("Route/axios/public/signup.php"),
);
