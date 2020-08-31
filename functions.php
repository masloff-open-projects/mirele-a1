<?php
/**
 * Welcome to the source code
 *
 * ███╗░░░███╗██╗██████╗░███████╗██╗░░░░░███████╗      ░█████╗░░█████╗░██████╗░███████╗
 * ████╗░████║██║██╔══██╗██╔════╝██║░░░░░██╔════╝      ██╔══██╗██╔══██╗██╔══██╗██╔════╝
 * ██╔████╔██║██║██████╔╝█████╗░░██║░░░░░█████╗░░      ██║░░╚═╝██║░░██║██████╔╝█████╗░░
 * ██║╚██╔╝██║██║██╔══██╗██╔══╝░░██║░░░░░██╔══╝░░      ██║░░██╗██║░░██║██╔══██╗██╔══╝░░
 * ██║░╚═╝░██║██║██║░░██║███████╗███████╗███████╗      ╚█████╔╝╚█████╔╝██║░░██║███████╗
 * ╚═╝░░░░░╚═╝╚═╝╚═╝░░╚═╝╚══════╝╚══════╝╚══════╝      ░╚════╝░░╚════╝░╚═╝░░╚═╝╚══════╝
 *
 *
 * If you have any problems with the software,
 * go to iRTEX official Envato account and find
 * there a link to technical support.
 *
 *
 * Memo to the developers:
 * 1. GitHub is your friend and savior. Often make `git push`
 * 2. More `If`
 * 3. Document the code.
 */

use Mirele\TWIG;
use Mirele\Framework;
use Mirele\Framework\Store;
use Mirele\Router;

# Checking the compatibility and legality of the file call
defined('ABSPATH') or die('Not defined ABSPATH');

# Compatibility check
if (version_compare(PHP_VERSION, '7.0.0') <= 0) {

    # The current server configuration is not suitable for starting Mirele
    add_action(
        'admin_bar_menu', function ($wp_admin_bar) {
            $wp_admin_bar->add_node(
            array(
                'id' => 'mcp',
                'title' => '<b>[WARNING]</b> Mirele compatibility problems!',
                'href' => '#',
                'parent' => '',
                'meta' => [
                    'class' => 'incompatibility-dummy-wp-menu'
                ],
                'group' => false
            ));
    });

    # Create page
    add_menu_page(
        'MIRELE', 'Mirele Repair', 'edit_themes', 'mirele_repair', function () {
            echo "Install PHP 7.0.0 or next";
    }, '', 1);

    return;
}

# Main Constants
define('MIRELE_GET', $_GET);
define('MIRELE_POST', $_POST);
define('ROSEMARY_VARCHAR_SIZE_DB', 512);
define('ROSEMARY_VARCHAR_INT_DB', 64);

# Meta Constants
define('MIRELE_VERSION', "1.0.0");
define('ROSEMARY_VERSION', "1.0.1");
define('ROSEMARY_INSTANCES', 'SMART');
define('MIRELE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . explode('?', $_SERVER['REQUEST_URI'], 2)[0]);

# Constants regulators
define('MIRELE_MIN_PERMISSIONS_FOR_EDIT', 'edit_themes');
define('ROSEMARY_FORBIDDEN_SYMBOLS', array(':', '/', "@"));
define('ROSEMARY_RIGHTS_FOR_VISUAL_EDIT', 'edit_themes');
define('ROSEMARY_CANVAS', 'canvas.php');

# File path constants
define('ROSEMARY_TEMPLATES_DIR', get_template_directory() . '/templates');
define('ROSEMARY_TWIG_DIR', get_template_directory() . '/twig');
define('ROSEMARY_TEMPLATES_HTML_DIR', get_template_directory() . '/rosemary_html');
define('MIRELE_CORE_DIR', get_template_directory() . '/core');
define('MIRELE_SOURCE_DIR', get_template_directory_uri() . '/source');
define('MIRELE_SOURCE_PATH', get_template_directory() . '/source');
define('MIRELE_LOG_FILE', get_template_directory() . '/logger.log');
define('MIRELE_ERROR_FILE', get_template_directory() . '/.error');

# Show errors
if (wp_doing_ajax() == false and true) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

# In order not to clog up AJAX requests with empty file connections,
# Mirele connects all necessary AJAX scripts separately from the UI
# version scripts
if (wp_doing_ajax() === false) {

    # The composer connects first - it
    # is like a separate system inside MIrele

        # Include composer
        include_once 'vendor/autoload.php';


    # Initially, Mirele needs to create its own infostructure,
    # which will already be used within the elements and components
    # of the interest.

        # Main Core
        include_once 'core/class/TWIG.php';
        include_once 'core/class/Rosemary.php';
        include_once 'core/class/Router.php';
        include_once 'core/class/MLogger.php';
        include_once 'core/Framework/Iterator.php';
        include_once 'core/Framework/WPGNU.php';
        include_once 'core/Framework/Buffer.php';
        include_once 'core/Framework/String.php';
        include_once 'core/Framework/Storage.php';
        include_once 'core/Framework/Component.php';
        include_once 'core/Framework/Option.php';
        include_once 'core/Framework/Customizer.php';
        include_once 'core/Framework/TWIG.php';
        include_once 'core/Framework/TWIGWoocommerce.php';
        include_once 'core/Framework/Store.php';


        # Architecture class sets
        include_once 'core/class/RDeveloper.php';
        include_once 'core/class/RManager.php';

        # Arrhitectural Classes Sets (Mirele)
        include_once 'core/class/MApps.php';
        include_once 'core/class/MCache.php';
        include_once 'core/class/MHubSpot.php';
        include_once 'core/class/MMailChimp.php';
        include_once 'core/class/MSafe.php';
        include_once 'core/class/MVersion.php';
        include_once 'core/class/MRepository.php';
        include_once 'core/class/MRouter.php';
        include_once 'core/class/MAjax.php';
        include_once 'core/class/MPager.php';
        include_once 'core/class/MSettings.php';
        include_once 'core/class/MStyler.php';
        include_once 'core/class/MBBPress.php';
        include_once 'core/class/MDemos.php';
        include_once 'core/class/MNotification.php';

        # Meta
        include_once "meta.php";

    # UI components must be connected strictly after
    # all building cores are ready for use.

        # Components
        include_once 'Components/Sidebars/default.php';
        include_once 'Components/Footers/default.php';
        include_once 'Components/Navbars/default.php';
        include_once 'Components/Menu/default_navbar.php';

} else {

    # Initially, Mirele needs to create its own infostructure,
    # which will already be used within the elements and components
    # of the interest.

        # Main core
        include_once 'core/class/Router.php';
        include_once 'core/class/MLogger.php';
        include_once 'core/Framework/Iterator.php';
        include_once 'core/Framework/WPGNU.php';
        include_once 'core/Framework/Buffer.php';
        include_once 'core/Framework/String.php';
        include_once 'core/Framework/Storage.php';
        include_once 'core/Framework/Component.php';
        include_once 'core/Framework/Option.php';
        include_once 'core/Framework/Customizer.php';

        # Arrhitectural Classes Sets (Mirele)
        include_once 'core/class/MFile.php';

        # Abstract core files
        include_once 'core/Router.php';
        include_once 'core/Option.php';

}


# Setup an error handler
set_error_handler(

    function ($errno, $errstr, $errfile, $errline) {
        $logger = new MLogger(MIRELE_LOG_FILE);
        $logger->warning("(line $errline:$errfile) >>> $errstr");
    }

);

# Another error handler
register_shutdown_function(function () {

    if (error_get_last()) {
        $error = (object) error_get_last();
        $logger = new MLogger(MIRELE_LOG_FILE);
        $logger->error("(line $error->line:$error->file) >>> $error->message");
    }

});

# Rest Redirect
add_action(
    'rest_api_init', function () {

    register_rest_route(
        'Main/api/v1/', '(?P<package>[a-zA-Z0-9-]+)/(?P<method>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => function ($event) {
            $props = (object)$event->get_params();
            \Mirele\Router::dispatch("/rest_endpoint_v1/$props->package/$props->method");
        },
        'show_in_rest' => true
    ]);

});

# AJAX Redirect
add_action('wp_ajax_nopriv_mirele_endpoint_v1', function ()
{

    if (isset((MIRELE_POST)['action']) and isset((MIRELE_POST)['method'])) {

        \Mirele\Router::error(function () {
            wp_send_json([
                'error' => 'Method not found'
            ]);
            wp_die();
        });

        wp_send_json(\Mirele\Router::dispatch('/ajax_endpoint_v1/' . (MIRELE_POST)['method'], function ($object) {
            die($object);
        }));
    }

});
add_action('wp_ajax_mirele_endpoint_v1', function ()
{

    if (isset((MIRELE_POST)['action']) and isset((MIRELE_POST)['method'])) {

        Router::error(function () {
            wp_send_json([
                'error' => 'Method not found'
            ]);
            wp_die();
        });

        wp_send_json(Router::dispatch('/ajax_endpoint_v1/' . (MIRELE_POST)['method'], function ($object) {
            die($object);
        }));
    }

});

# Init WP
add_action(
    'init', function () {

        # Registration of some components of the Compound
        add_shortcode('component_compound', function ($attr) {
            Store::call($attr['name'], (array) $attr);
        });

        # We will register all necessary scripts in the future.
        wp_register_script('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js');
        wp_register_script('vue', 'https://cdn.jsdelivr.net/npm/vue');
        wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
        wp_register_script('axios', 'https://unpkg.com/axios/dist/axios.min.js');
        wp_register_script('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery'));
        wp_register_script('babel', 'https://unpkg.com/@babel/standalone/babel.min.js', array('jquery'), '', false);
        wp_register_script('mirele_admin', MIRELE_SOURCE_DIR . '/js/admin.js', array('jquery', 'vue'), '', false);
        wp_register_script('mireleapi', MIRELE_SOURCE_DIR . '/js/API.js', array('jquery'), '', false);
        wp_register_script('babelui', MIRELE_SOURCE_DIR . '/js/babel.js', array('babel', 'jquery'), '', false);

        # We will register all styles necessary in the future.
        wp_register_style('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css');
        wp_register_style('bootsrtap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', false);
        wp_register_style('main_style', MIRELE_SOURCE_DIR . '/css/style.css', false);
        wp_register_style('admin_style', MIRELE_SOURCE_DIR . '/css/admin.css', false);

        # Localization and declaration of external variables
        wp_localize_script(
            'mireleapi', 'MIRELE',
            [
                'urls' => [
                    'ajax' => esc_url(admin_url('admin-ajax.php')),
                    'rest' => esc_url(get_rest_url())
                ],
                'configs' => [
                ],
                'security' => [
                    'ajax' => [
                        'nonce' => wp_create_nonce('main')
                    ]
                ]
            ]
        );

});

# Admin front-end
add_action(
    'admin_enqueue_scripts', function () {

        wp_enqueue_script('axios');
        wp_enqueue_script('mireleapi');
        wp_enqueue_script('vue');
        wp_enqueue_script('mirele_admin');
        wp_enqueue_script('fontAwesome');

        wp_enqueue_style('fontAwesome');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('admin_style');

        wp_enqueue_media();

});

# User front-end
add_action(
    'wp_enqueue_scripts', function () {

        wp_enqueue_script('vue');
        wp_enqueue_script('axios');
        wp_enqueue_script('babel');
        wp_enqueue_script('popper');
        wp_enqueue_script('babelui');
        wp_enqueue_script('bootstrap4');
        wp_enqueue_script('mireleapi');
        wp_enqueue_script('fontAwesome');

        wp_enqueue_style('fontAwesome');
        wp_enqueue_style('bootsrtap4');
        wp_enqueue_style('main_style');

});

# User front-end body open tag
add_action(
    'wp_body_open', function () {

        if (is_page_template(ROSEMARY_CANVAS)) {

        }

});

# Admin front end
add_action(
    'admin_menu', function () {

        add_menu_page(
            'MIRELE', 'Mirele Center', MIRELE_MIN_PERMISSIONS_FOR_EDIT, 'mirele_center', function () {
            if (current_user_can(MIRELE_MIN_PERMISSIONS_FOR_EDIT)) {
                \Mirele\TWIG::Render('Main/center');
            } else {
                \Mirele\TWIG::Render('Main/no-access');
            }
        }, '', 1);
    
        add_menu_page(
            'MIRELE', 'Mirele Apps', MIRELE_MIN_PERMISSIONS_FOR_EDIT, 'mirele_apps', function () {
    
        }, 'dashicons-screenoptions', 2);
    
        add_menu_page(
            'MIRELE', 'Compound Editor', MIRELE_MIN_PERMISSIONS_FOR_EDIT, 'сompound_render_editor', function () {
            TWIG::Render('Compound/main');
        }, 'dashicons-welcome-write-blog', 3);
    
        add_submenu_page(
            'сompound_render_editor', 'MIRELE', 'Demos', MIRELE_MIN_PERMISSIONS_FOR_EDIT, 'сompound_render_demos', function () {
    
        }, '', 2);
    
        add_action(
            'admin_bar_menu', function ($wp_admin_bar) {
            $wp_admin_bar->add_node(
                array(
                    'id' => 'rpage',
                    'title' => 'Rosemary Page',
                    'href' => MIRELE_URL . '?page=rosemary_render_editor',
                    'parent' => 'new-content'
                ));
        });

});