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

include_once 'Abstract/Inputs/default.php';
include_once 'Abstract/Textareas/default.php';
include_once 'Abstract/Selects/default.php';
include_once 'Abstract/Buttons/default.php';
include_once 'Abstract/Checkboxs/default.php';
include_once 'Abstract/Radios/default.php';

include_once 'Grids/default.php';
include_once 'Carts/default.php';
include_once 'Sidebars/default.php';
include_once 'Footers/default.php';
include_once 'Navbars/default.php';
include_once 'Menus/default.php';
include_once 'Woocommerce/Notes/default.php';
include_once 'Woocommerce/Steps/default.php';
include_once 'Woocommerce/Field/default.php';
include_once 'Woocommerce/Forms/default_billing.php';
include_once 'Woocommerce/Forms/default_shipping.php';
include_once 'Woocommerce/Carousel/default.php';
include_once 'Woocommerce/Notices/default.php';
include_once 'Woocommerce/Gallerys/default.php';
include_once 'Woocommerce/Tables/Orders/default.php';
include_once 'Woocommerce/Tables/Downloads/default.php';
include_once 'Woocommerce/Tables/Cart/default.php';
include_once 'Woocommerce/Placeholders/Orders/default.php';
include_once 'Woocommerce/Placeholders/Downloads/default.php';
include_once 'Woocommerce/Placeholders/Cart/default.php';