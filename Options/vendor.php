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

require_once 'basic/mrl_wp_navbar_fixed.php';
require_once 'basic/mrl_wp_sidebar_width_1_active.php';
require_once 'basic/mrl_wp_sidebar_width_2_active.php';
require_once 'basic/mrl_wp_sidebar_hide_mobile.php';

require_once 'authorization_login/mrl_wp_description_login.php';
require_once 'authorization_login/mrl_wp_title_login.php';

require_once 'authorization_signup/mrl_wp_title_signup.php';
require_once 'authorization_signup/mrl_wp_description_signup.php';

require_once 'authorization_recovery_password/mrl_wp_title_recovery_password.php';
require_once 'authorization_recovery_password/mrl_wp_description_recovery_password.php';

require_once 'woocommerce_card/woocommerce_catalog_columns.php';
require_once 'woocommerce_card/woocommerce_catalog_rows.php';

require_once 'woocommerce_cart/woocommerce_table_summary.php';

require_once 'woocommerce_shop/mrl_wp_show_carousel.php';