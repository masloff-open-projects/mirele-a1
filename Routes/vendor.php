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
 * @vendor Routes
 * @version 1.0.0
 * @author Mirele
 * @alias vendor-routes
 * @template vendor
 */

// Complex
require_once 'Complex/wp-admin/Compound-createPage.php';
require_once 'Complex/wp-admin/Compound-insertTemplate.php';

// AJAX
require_once 'AJAX/namespaces.php';
require_once 'AJAX/login.php';
require_once 'AJAX/signup.php';
require_once 'AJAX/recoveryPassword.php';
require_once 'AJAX/options.php';
require_once 'AJAX/product.php';
require_once 'AJAX/WCAddToCart.php';

// REST
require_once 'REST/options/get.php';