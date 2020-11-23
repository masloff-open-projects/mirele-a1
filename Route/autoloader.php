<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_414244", 'ID414244');
define ("AUTOLOADER_PATH_414244", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID414244 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '6199777281:414244' => __autoloader_ID414244 ("Route/Applications/Compound/markup.php"),
  '7564941240:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-cloneTemplate.php"),
  '5220959016:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-createPage.php"),
  '2742093327:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-getMarkup.php"),
  '3149564291:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-getPage.php"),
  '7955896608:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-getProps.php"),
  '4941664817:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-getTemplateProps.php"),
  '4056974585:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-insertComponent.php"),
  '2858557774:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-insertTemplate.php"),
  '7706187018:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-removeTemplate.php"),
  '5996491366:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-sortOrder.php"),
  '6662354777:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-updatePage.php"),
  '5964790662:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-updateProps.php"),
  '1888284667:414244' => __autoloader_ID414244 ("Route/axios/private/Compound-updateTemplateProps.php"),
  '4608951636:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/HTTP.php"),
  '6187447183:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/WCAddToCart.php"),
  '7322761462:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/login.php"),
  '7562947872:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/namespaces.php"),
  '3216047878:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/options.php"),
  '2970005184:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/product.php"),
  '5773322349:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/recoveryPassword.php"),
  '5485072299:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/saveOption.php"),
  '7781613057:414244' => __autoloader_ID414244 ("Route/Applications/AXIOS/Public/signup.php"),
);
