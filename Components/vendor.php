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
 * @vendor Components
 * @version 1.0.0
 * @author Mirele
 * @alias vendor-components
 * @template vendor
 * @vendor
 */

include_once 'Woocommerce/Notes/default.php';
include_once 'Woocommerce/Steps/default.php';
include_once 'Woocommerce/Gallerys/default.php';
include_once 'Woocommerce/Placeholders/Orders/default.php';
include_once 'Woocommerce/Placeholders/Downloads/default.php';
include_once 'Woocommerce/Placeholders/Cart/default.php';

include_once 'HTMLTag/component.php';
include_once 'Button/component.php';
include_once 'Input/component.php';
include_once 'Textarea/component.php';
include_once 'Checkbox/component.php';
include_once 'Radio/component.php';
include_once 'Select/component.php';
include_once 'Label/component.php';
include_once 'FormField/component.php';
include_once 'Cart/component.php';
include_once 'Sidebar/component.php';
include_once 'Notice/component.php';
include_once 'Navbar/component.php';
include_once 'Navbar/Children/menu.php';
include_once 'Footer/component.php';

include_once 'WidgetFactory/component.php';

include_once 'Woocommerce/Carousel/component.php';
include_once 'Woocommerce/Forms/Children/Billing/component.php';
include_once 'Woocommerce/Forms/Children/Shipping/component.php';

include_once 'Woocommerce/Table/Children/Cart/component.php';
include_once 'Woocommerce/Table/Children/Downloads/component.php';
include_once 'Woocommerce/Table/Children/Orders/component.php';