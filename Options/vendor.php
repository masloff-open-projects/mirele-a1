<?php

/**
 *
 * ██╗   ██╗███████╗███╗   ██╗██████╗  ██████╗ ██████╗
 * ██║   ██║██╔════╝████╗  ██║██╔══██╗██╔═══██╗██╔══██╗
 * ██║   ██║█████╗  ██╔██╗ ██║██║  ██║██║   ██║██████╔╝
 * ╚██╗ ██╔╝██╔══╝  ██║╚██╗██║██║  ██║██║   ██║██╔══██╗
 *  ╚████╔╝ ███████╗██║ ╚████║██████╔╝╚██████╔╝██║  ██║
 *   ╚═══╝  ╚══════╝╚═╝  ╚═══╝╚═════╝  ╚═════╝ ╚═╝  ╚═╝
 *
 * Vendor files are used to subclick a whole set
 * of target bit files included in the complex.
 * Vendor files always lie in the root directory
 * of the complex target bit divisions into separate files.
 * Vendor files always specify the target file and cannot
 * connect foreign files to the system, they cannot subdivide through the loop
 *
 * @vendor Options
 * @version 1.0.0
 * @author Mirele
 * @alias vendor-options
 * @template vendor
 */

# Enable options with MIRELE (all) support
if (MIRELE_SUPPORT === true) {

    require_once 'Basic/mrl_wp_navbar_type.php';
    require_once 'Basic/mrl_wp_navbar_fixed.php';
    require_once 'Basic/mrl_wp_sidebar_width_1_active.php';
    require_once 'Basic/mrl_wp_sidebar_width_2_active.php';
    require_once 'Basic/mrl_wp_sidebar_hide_mobile.php';

}

# Enable options with WOOCOMMERCE support
if (WOOCOMMERCE_SUPPORT === true) {

    require_once 'Authorization/login/mrl_wp_description_login.php';
    require_once 'Authorization/login/mrl_wp_title_login.php';
    require_once 'Authorization/signup/mrl_wp_title_signup.php';
    require_once 'Authorization/signup/mrl_wp_description_signup.php';
    require_once 'Authorization/recovery_password/mrl_wp_title_recovery_password.php';
    require_once 'Authorization/recovery_password/mrl_wp_description_recovery_password.php';

    require_once 'Woocommerce/Card/woocommerce_catalog_columns.php';
    require_once 'Woocommerce/Card/woocommerce_catalog_rows.php';
    require_once 'Woocommerce/Cart/woocommerce_table_summary.php';
    require_once 'Woocommerce/Shop/mrl_wp_show_carousel.php';

}
