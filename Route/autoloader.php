<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_501771", 'ID501771');
define ("AUTOLOADER_PATH_501771", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID501771 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '6109011402:501771' => __autoloader_ID501771 ("Route/Applications/Compound/component.php"),
  '5167768008:501771' => __autoloader_ID501771 ("Route/Applications/Compound/markup.php"),
  '1661645734:501771' => __autoloader_ID501771 ("Route/Applications/Compound/store.php"),
  '2780995738:501771' => __autoloader_ID501771 ("Route/Applications/Compound/template.php"),
  '6231056749:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-cloneTemplate.php"),
  '5758608860:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-createPage.php"),
  '5768470276:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-getMarkup.php"),
  '4422375989:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-getPage.php"),
  '5499655622:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-getProps.php"),
  '7413592293:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-getTemplateProps.php"),
  '6761143902:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-insertComponent.php"),
  '7614211893:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-insertTemplate.php"),
  '1187198635:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-removeTemplate.php"),
  '5311147790:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-sortOrder.php"),
  '4290431515:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-updatePage.php"),
  '4982489326:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-updateProps.php"),
  '4478640913:501771' => __autoloader_ID501771 ("Route/axios/private/Compound-updateTemplateProps.php"),
  '2307329227:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/HTTP.php"),
  '5942231501:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/WCAddToCart.php"),
  '3945911030:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/login.php"),
  '1508579202:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/namespaces.php"),
  '1983529233:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/options.php"),
  '2518473633:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/product.php"),
  '4628406505:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/recoveryPassword.php"),
  '5345525920:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/saveOption.php"),
  '6607778608:501771' => __autoloader_ID501771 ("Route/Applications/AXIOS/Public/signup.php"),
);
