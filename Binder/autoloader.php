<?php
# Creating a virtual environment of constants
define ("AUTOLOADER_ID_531680", 'ID531680');
define ("AUTOLOADER_PATH_531680", dirname (__FILE__));

# Initialization of module connection function
function __autoloader_ID531680 ($file)
{
  $__path__ = TEMPLATE_PATH . '/' . $file;
  if (file_exists($__path__) and is_file($__path__) and is_readable($__path__)) {
    return require_once $__path__;
  } else {
    return wp_die ("File ('$__path__') not found, but required as this is a module");
  }

}

return array (
  '3023421079:531680' => __autoloader_ID531680 ("Binder/Component/Navbar/Children/menu.php"),
  '2247559007:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Forms/Children/Billing/component.php"),
  '7841334583:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Forms/Children/Shipping/component.php"),
  '7800698960:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Table/Children/Cart/component.php"),
  '4220533191:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Table/Children/Downloads/component.php"),
  '3122240901:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Table/Children/Orders/component.php"),
  '4493421325:531680' => __autoloader_ID531680 ("Binder/Component/Navbar/Children/Before/component.php"),
  '2709472349:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Placeholders/Cart/component.php"),
  '6668971389:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Placeholders/Downloads/component.php"),
  '1845216677:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Placeholders/Orders/component.php"),
  '3536120109:531680' => __autoloader_ID531680 ("Binder/Component/Navbar/Children/menu.php"),
  '3874810246:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Carousel/component.php"),
  '2318740351:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Gallery/component.php"),
  '6628339395:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Note/component.php"),
  '1349534530:531680' => __autoloader_ID531680 ("Binder/Component/Woocommerce/Step/component.php"),
  '3122919899:531680' => __autoloader_ID531680 ("Binder/Component/Button/component.php"),
  '5670581120:531680' => __autoloader_ID531680 ("Binder/Component/Cart/component.php"),
  '4821495246:531680' => __autoloader_ID531680 ("Binder/Component/Checkbox/component.php"),
  '1347349514:531680' => __autoloader_ID531680 ("Binder/Component/Editor/component.php"),
  '2169972047:531680' => __autoloader_ID531680 ("Binder/Component/Footer/component.php"),
  '1490141811:531680' => __autoloader_ID531680 ("Binder/Component/FormField/component.php"),
  '5687233149:531680' => __autoloader_ID531680 ("Binder/Component/HTMLTag/component.php"),
  '7336347369:531680' => __autoloader_ID531680 ("Binder/Component/Input/component.php"),
  '7622267966:531680' => __autoloader_ID531680 ("Binder/Component/Label/component.php"),
  '7582779624:531680' => __autoloader_ID531680 ("Binder/Component/Meta/component.php"),
  '2009443972:531680' => __autoloader_ID531680 ("Binder/Component/Navbar/component.php"),
  '3206003507:531680' => __autoloader_ID531680 ("Binder/Component/Notice/component.php"),
  '2700854965:531680' => __autoloader_ID531680 ("Binder/Component/Radio/component.php"),
  '5231946030:531680' => __autoloader_ID531680 ("Binder/Component/Select/component.php"),
  '7968557451:531680' => __autoloader_ID531680 ("Binder/Component/Sidebar/component.php"),
  '2311637091:531680' => __autoloader_ID531680 ("Binder/Component/Text/component.php"),
  '6027218675:531680' => __autoloader_ID531680 ("Binder/Component/Textarea/component.php"),
  '6501583946:531680' => __autoloader_ID531680 ("Binder/Component/WidgetFactory/component.php"),
  '4639072777:531680' => __autoloader_ID531680 ("Binder/Template/Bootstrap/template.php"),
  '2162931383:531680' => __autoloader_ID531680 ("Binder/Template/Emptys/template.php"),
  '2056178412:531680' => __autoloader_ID531680 ("Binder/Template/Headers/template.php"),
  '5755156985:531680' => __autoloader_ID531680 ("Binder/Option/Authorization/login/mrl_wp_description_login.php"),
  '7509315483:531680' => __autoloader_ID531680 ("Binder/Option/Authorization/login/mrl_wp_title_login.php"),
  '6852804290:531680' => __autoloader_ID531680 ("Binder/Option/Authorization/recovery_password/mrl_wp_description_recovery_password.php"),
  '7782389779:531680' => __autoloader_ID531680 ("Binder/Option/Authorization/recovery_password/mrl_wp_title_recovery_password.php"),
  '2455250008:531680' => __autoloader_ID531680 ("Binder/Option/Authorization/signup/mrl_wp_description_signup.php"),
  '7646495587:531680' => __autoloader_ID531680 ("Binder/Option/Authorization/signup/mrl_wp_title_signup.php"),
  '6616601997:531680' => __autoloader_ID531680 ("Binder/Option/Woocommerce/Card/woocommerce_catalog_columns.php"),
  '4853322476:531680' => __autoloader_ID531680 ("Binder/Option/Woocommerce/Card/woocommerce_catalog_rows.php"),
  '4992814988:531680' => __autoloader_ID531680 ("Binder/Option/Woocommerce/Cart/woocommerce_table_summary.php"),
  '4568903668:531680' => __autoloader_ID531680 ("Binder/Option/Woocommerce/Shop/mrl_wp_show_carousel.php"),
  '4946323720:531680' => __autoloader_ID531680 ("Binder/Option/Basic/mrl_wp_navbar_fixed.php"),
  '6468472384:531680' => __autoloader_ID531680 ("Binder/Option/Basic/mrl_wp_navbar_type.php"),
  '6680080688:531680' => __autoloader_ID531680 ("Binder/Option/Basic/mrl_wp_sidebar_hide_mobile.php"),
  '4975142710:531680' => __autoloader_ID531680 ("Binder/Option/Basic/mrl_wp_sidebar_width_1_active.php"),
  '7517743129:531680' => __autoloader_ID531680 ("Binder/Option/Basic/mrl_wp_sidebar_width_2_active.php"),
  '4761399265:531680' => __autoloader_ID531680 ("Binder/Option/vendor.php"),
);
