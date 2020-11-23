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

global $logger;
global $modules;

use Mirele\Compound\Adapter\AJAX;
use Mirele\Compound\Engine\Document as App;
use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Framework;
use Mirele\Framework\Stringer;
use Mirele\Router;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

# Checking the compatibility and legality of the file call
defined('ABSPATH') or die('Not defined ABSPATH');

# Main Constants
include_once 'environment.php';

# Debug?
if (file_exists(dirname(__FILE__) . '/.debug') and file_exists(dirname(__FILE__) . '/Hammer&Wrench.php')) {
    include_once 'Hammer&Wrench.php';
}

# Compatibility check
if (version_compare(PHP_VERSION, MIRELE_REQUIRED['PHP']) <= 0) {

    # The current server configuration is not suitable for starting Mirele
    add_action('admin_bar_menu', function ($wp_admin_bar) {
        $wp_admin_bar->add_node(array(
                'id' => 'mcp',
                'title' => '<b>[WARNING]</b> Mirele compatibility problems!',
                'href' => '#',
                'parent' => '',
                'meta' => ['class' => 'incompatibility-dummy-wp-menu'],
                'group' => false
            )
        );
    }
    );

    # Create page
    add_menu_page('MIRELE', 'Mirele Repair', 'edit_themes', 'mirele_repair', function () {
        echo "Install PHP " . MIRELE_REQUIRED['PHP'] . " or next";
    }, '', 1
    );

    return;
}

# Ini
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

# Show errors
if (wp_doing_ajax() == false and true) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

# In order not to clog up Axios requests with empty file connections,
# Mirele connects all necessary Axios scripts separately from the UI
# version scripts
if (wp_doing_ajax() === false) {

    $modules = array(

        # The composer connects first - it
        # is like a separate system inside MIrele

        # Include composer
        'composer' => include_once 'vendor/autoload.php',

        # Initially, Mirele needs to create its own infostructure,
        # which will already be used within the elements and components
        # of the interest.

        # Connection of all prototypes and instances
        'Compound' => include_once 'Compound/autoloader.php',

        # Meta
        'meta' => include_once "meta.php",

        # UI components must be connected strictly after
        # all building cores are ready for use.

        # Connecting Vendor files except Composer
        'Binders' => include_once 'Binder/autoloader.php',
        'Route' => include_once 'Route/autoloader.php',
        'Options' => include_once 'Option/vendor.php'

    );

} else {

    $modules = array(

        # Initially, Mirele needs to create its own infostructure,
        # which will already be used within the elements and components
        # of the interest.

        # Connection of all prototypes and instances
        'Compound' => include_once 'Compound/autoloader.php',
        'Binders' => include_once 'Binder/autoloader.php',

        # Connecting Vendor files except Composer
        'Route' => include_once 'Route/autoloader.php',
        'Options' => include_once 'Option/vendor.php'

    );

}

# Setting enviroment
if (wp_doing_ajax() == false) {
    $logger = new Logger('Mirele');
    $logger->pushHandler(new StreamHandler(MIRELE_LOG_FILE, Logger::WARNING));
}

Router::staticFiles('/public/(:all)', TEMPLATE_PATH . '/Public/');
App::init();

# Setup an error handler
if (true) {

    set_error_handler(

        function ($errno, $errstr, $errfile, $errline) {
            if (wp_doing_ajax() == false) {
                global $logger;

                if ($logger) {
                    $logger->warning("(line $errline:$errfile) >>> $errstr");
                }
            }
        }

    );

    # Another error handler
    register_shutdown_function(function () {

        if (error_get_last()) {
            if (wp_doing_ajax() == false) {
                $error = (object)error_get_last();

                // create a log channel
                $log = new Logger('Mirele');
                $log->pushHandler(new StreamHandler(MIRELE_LOG_FILE, Logger::WARNING));
                $log->error("(line $error->line:$error->file) >>> $error->message");
            }

        }

    }
    );

}


# Rest Redirect
add_action('rest_api_init', function () {

    register_rest_route('Main/api/v1/', '(?P<package>[a-zA-Z0-9-]+)/(?P<method>[a-zA-Z0-9-]+)', [
            'methods' => 'GET',
            'callback' => function ($event) {
                $props = (object)$event->get_params();
                Router::dispatch("/rest_endpoint_v1/$props->package/$props->method");
            },
            'show_in_rest' => true
        ]
    );

}
);

# Init WP
add_action('init', function () {

    global $post;

    # Registration of some components of the Compound
    add_shortcode('Component', function ($attr, $content) {
        Store::call($attr['name'],
            array_merge((array)$attr, ['attr' => (array)$attr], (array)['context_content' => $content])
        );
    }
    );

    add_shortcode('Compound', function ($attr, $content) {
    }
    );

    # Disable unnecessary scripts
    wp_dequeue_style('woocommerce_frontend_styles');
    wp_dequeue_style('woocommerce-general');
    wp_dequeue_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-smallscreen');
    wp_dequeue_style('woocommerce_fancybox_styles');
    wp_dequeue_style('woocommerce_chosen_styles');
    wp_dequeue_style('woocommerce_prettyPhoto_css');

    wp_deregister_script('selectWoo');

    wp_dequeue_script('selectWoo');
    wp_dequeue_script('wc-add-payment-method');
    wp_dequeue_script('wc-lost-password');
    wp_dequeue_script('wc_price_slider');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-add-to-cart');
    wp_dequeue_script('wc-cart-fragments');
    wp_dequeue_script('wc-credit-card-form');
    wp_dequeue_script('wc-checkout');
    wp_dequeue_script('wc-add-to-cart-variation');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-cart');
    wp_dequeue_script('wc-chosen');
    wp_dequeue_script('woocommerce');
    wp_dequeue_script('prettyPhoto');
    wp_dequeue_script('prettyPhoto-init');
    wp_dequeue_script('jquery-blockui');
    wp_dequeue_script('jquery-placeholder');
    wp_dequeue_script('jquery-payment');
    wp_dequeue_script('fancybox');
    wp_dequeue_script('jqueryui');

    # Writing data filters
    # Register URL
    add_filter('register_url', function ($data) {
        return get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=register';
    }, 1, 1
    );

    # Login URL
    add_filter('login_url', function ($data) {
        return get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=login';
    }, 1, 1
    );

    Router::error(function () {
    }
    );

    Router::dispatch(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

}
);

add_action('wp', function () {


    # If support for WooCommerce is provided,
    # we reassign the routing of code shorts.
    if (WOOCOMMERCE_SUPPORT) {

        remove_shortcode('woocommerce_my_account');

        add_shortcode('woocommerce_my_account', function () {

            # If the user is authorized, let's display the page of his account.
            if (is_user_logged_in() === true) {

                # User requests a page to edit the client profile
                if (is_wc_endpoint_url('edit-account')) {

                    # User Generation
                    $user = (object)wp_get_current_user();
                    $user->avatar = get_avatar_url($user->ID);

                    # Render
                    // FIXME
                    App::render('Woocommerce/account/edit/profile', ['user' => (object)$user,]);

                } # Viewing a specific order
                elseif (is_wc_endpoint_url('view-order')) {

                    # Globalize
                    global $wp;

                    # User Generation
                    $user = (object)wp_get_current_user();
                    $user->avatar = get_avatar_url($user->ID);

                    # Generating order
                    $order = wc_get_order($wp->query_vars['view-order']);

                    # Render
                    // FIXME
                    App::render('Woocommerce/order', [
                            'user' => (object)$user,
                            'id' => (integer)$wp->query_vars['view-order'],
                            'order' => $order,
                            'note' => wc_get_order_notes(['order_id' => (integer)$wp->query_vars['view-order']]),
                            'access' => $user->ID === $order->get_user_id(),
                            'time' => [
                                'modified' => date("m.d.y H:i", strtotime($order->get_date_modified())),
                                'created' => date("m.d.y H:i", strtotime($order->get_date_created())),
                                'paid' => $order->get_date_paid()
                            ]
                        ]
                    );


                } # User does not ask for anything.
                else {

                    # User Generation
                    $user = (object)wp_get_current_user();
                    $user->avatar = get_avatar_url($user->ID);

                    # Generation of user downloads
                    $downloads = wc_get_customer_available_downloads($user->ID);

                    # Generation of user orders
                    $orders = get_posts(array(
                            'numberposts' => -1,
                            'meta_key' => '_customer_user',
                            'meta_value' => get_current_user_id(),
                            'post_type' => wc_get_order_types(),
                            'post_status' => array_keys(wc_get_order_statuses())
                        )
                    );

                    foreach ($orders as $order) {
                        $orders[(new Stringer(strtoupper($order->post_status)))->format(['WC-' => 'ORDERS_'])]++;
                    }

                    # Render


                    App::render('Compound/Engine/Applications/Public/Module/Woocommerce/account.html.twig', [
                            'account' => (object)[
                                'user' => (object)$user,
                                'orders' => (array)$orders,
                                'downloads' => (array)$downloads
                            ]
                        ]
                    );

                }

                # Otherwise we will send to the authorization page
            } else {

                # Render
                # Checking to see if a page has been opened purposefully
                # or if a user has accessed it in order to access the account.
                if (isset((MIRELE_GET)['action'])) {

                    switch ((MIRELE_GET)['action']) {

                        case 'login':

                            # Render page
                            App::render('Compound/Engine/Applications/Public/Module/Woocommerce/Login/login.html.twig', [
//                                    'content' => [
//                                        'title' => Framework\Customizer::get('@wc-login', 'mrl_wp_title_login', []),
//                                        'description' => Framework\Customizer::get('@wc-login', 'mrl_wp_description_login',
//                                            []
//                                        ),
//                                    ]
                                ]
                            );
                            break;

                        case 'register':

                            # Include scripts and styles
                            wp_enqueue_script('woocommerceui_signup');

                            # Render page


                            App::render('@signup', [
                                    'content' => [
                                        'title' => Framework\Customizer::get('@wc-signup', 'mrl_wp_title_signup', []),
                                        'description' => Framework\Customizer::get('@wc-signup',
                                            'mrl_wp_description_signup', []
                                        )
                                    ]
                                ]
                            );
                            break;

                        default:

                            # Include scripts and styles
                            wp_enqueue_script('woocommerceui_login');

                            # Render page
                            App::render('Compound/Engine/Applications/Public/Module/Woocommerce/Login/login.html.twig', [
                                    'content' => [
                                        'title' => Framework\Customizer::get('@wc-login', 'mrl_wp_title_login', []),
                                        'description' => Framework\Customizer::get('@wc-login', 'mrl_wp_description_login',
                                            []
                                        )
                                    ]
                                ]
                            );
                            break;
                    }

                } else {

                    if (false) {

                    } # User requests a password recovery page
                    elseif (is_wc_endpoint_url('lost-password')) {

                        # Include scripts and styles
                        wp_enqueue_script('woocommerceui_recovery_password');

                        # Render
                        App::render('@passwordRecovery', [
                                'content' => [
                                    'title' => Framework\Customizer::get('@wc-recovery',
                                        'mrl_wp_title_recovery_password', []
                                    ),
                                    'description' => Framework\Customizer::get('@wc-recovery',
                                        'mrl_wp_description_recovery_password', []
                                    )
                                ]
                            ]
                        );

                    } else {

                        # Redirect the user to the authorization,
                        # as he is not authorized and entered the page
                        # without a specific purpose.

                        # Include scripts and styles
                        wp_enqueue_script('woocommerceui_login');

                        # Render page
                        App::render('Compound/Engine/Applications/Public/Module/Woocommerce/Login/login.html.twig', [
                                'content' => [
                                    'title' => Framework\Customizer::get('@wc-login', 'mrl_wp_title_login', []),
                                    'description' => Framework\Customizer::get('@wc-login', 'mrl_wp_description_login', [])
                                ]
                            ]
                        );

                    }


                }

            }
        });

    }

}
);

add_action('wp_ajax_nopriv_mirele_endpoint_v1', function () {
    AJAX::run();
}
);

add_action('wp_ajax_mirele_endpoint_v1', function () {
    AJAX::run();
}
);

add_action('init', function () {

    if (wp_doing_ajax() == false) {

        Router::plugDependencies([
            is_admin() ? 'private' : 'public',
            is_wc() ? 'woocommerce' : false
        ], function ($id, $type, $alias, $src, $history) {

            switch ($type) {
                case 'scripts':
                    wp_enqueue_script($alias, $src, (array)$history[$type], MIRELE_VERSION, true);
                    break;

                case 'styles':
                    wp_enqueue_style($alias, $src, (array)$history[$type], MIRELE_VERSION, 'all');
                    break;

                case 'localize':

                    if ($src === 'main') {

                        wp_localize_script($alias, 'x33707', [
                                'urls' => [
                                    'ajax' => esc_url(admin_url('admin-ajax.php')),
                                    'rest' => esc_url(get_rest_url())
                                ],
                                'configs' => [],
                                'security' => ['ajax' => ['nonce' => wp_create_nonce('main')]],
                                'AXIOS' => [
                                    'URL' => esc_url(admin_url('admin-ajax.php'))
                                ]
                            ]
                        );

                    } else if ($src === 'Compound') {

                        global $post;

                        $wp_page = (object)get_post((MIRELE_GET)['page_id']);

                        wp_localize_script($alias, 'x27511', [
                                'page_on_edit' => (MIRELE_GET)['page_id'],
                                'page' => !empty($post->ID) ? $post->ID : 0,
                                'page_on_edit_url' => !empty($wp_page->guid) ? $wp_page->guid : 0
                            ]
                        );
                    } else if ($src === 'woocommerce') {

                        global $post;

                        wp_localize_script(
                            $alias, 'x70460',
                            [
                                'product' => (object)[],
                                'post' => (object)$post
                            ]
                        );

                    }

                    break;

            }
        }
        );
    }

}
);

# Admin front-end
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_media();
}
);

# User front-end
add_action('wp_enqueue_scripts', function () {

    // FIXIT
    wp_enqueue_style('fontAwesome');
    wp_enqueue_style('bootsrtap4');
    wp_enqueue_style('main_style');

}
);

# Admin front end
add_action('admin_menu', function () {

    // Init all
    add_thickbox();

    // Compound editor
    add_menu_page('MIRELE', 'Compound Editor', MIRELE_RIGHTS['page']['edit'], 'сompound_render_editor', function () {
        if (current_user_can(MIRELE_RIGHTS['page']['edit'])) {
            App::render('Compound/Engine/Applications/Compound/index.html.twig', [

                ]
            );
        }
    }, 'dashicons-welcome-write-blog', 3
    );

    // Mirele center
    add_menu_page('MIRELE', 'Mirele Center', MIRELE_RIGHTS['page']['edit'], 'mirele_center', function () {
//        if (current_user_can(MIRELE_RIGHTS['page']['edit'])) {
//            App::render('Main/center');
//        } else {
//            App::render('Main/no-access');
//        }
    }, '', 1
    );

    // Mirele apps
    add_menu_page('MIRELE', 'Mirele Apps', MIRELE_RIGHTS['page']['edit'], 'mirele_apps', function () {
        App::render('Apps/main', []);

    }, 'dashicons-screenoptions', 2
    );


//    add_action('admin_bar_menu', function ($wp_admin_bar) {
//        $wp_admin_bar->add_node(array(
//                'id' => 'rpage',
//                'title' => 'Compound Page',
//                'href' => MIRELE_URL . '?page=rosemary_render_editor',
//                'parent' => 'new-content'
//            )
//        );
//    }
//    );

}
);

