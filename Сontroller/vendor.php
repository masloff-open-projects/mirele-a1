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
 * @vendor Controller
 * @version 1.0.0
 * @author Mirele
 * @alias vendor-controller
 * @template vendor
 */

include_once 'Logger.php';
include_once 'TWIG.php';
include_once 'Customizer.php';
include_once 'Constructor.php';
include_once 'Grider.php';
include_once 'Lexer.php';
include_once 'Store.php';
include_once 'Router.php';
include_once 'Apps.php';
include_once 'TagsManager.php';