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

use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Lexer;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Framework;
use Mirele\Framework\Stringer;
use Mirele\Router;
use Mirele\TWIG;

# Checking the compatibility and legality of the file call
defined('ABSPATH') or die('Not defined ABSPATH');

# Main Constants
include_once 'Adjustment.php';

# Compatibility check
if (version_compare(PHP_VERSION, MIRELE_REQUIRED['PHP']) <= 0) {

    # The current server configuration is not suitable for starting Mirele
    add_action(
    /**
     * @param $wp_admin_bar
     */ 'admin_bar_menu', function ($wp_admin_bar) {
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
    /**
     *
     */ 'MIRELE', 'Mirele Repair', 'edit_themes', 'mirele_repair', function () {
        echo "Install PHP " . MIRELE_REQUIRED['PHP'] . " or next";
    }, '', 1);

    return;
}

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

# Show errors
if (wp_doing_ajax() == true and true) {
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

    # Connection of all prototypes and instances
    include_once 'Traits/vendor.php';
    include_once 'Interface/vendor.php';
    include_once 'Instance/vendor.php';
    include_once 'Сontroller/vendor.php';
    include_once 'Prototypes/vendor.php';
    include_once 'Patterns/vendor.php';

    # Main Core
    include_once 'Framework/Converter.php';
    include_once 'Framework/WPGNU.php';
    include_once 'Framework/WP.php';

    # Arrhitectural Classes Sets (Mirele)
    include_once 'Framework/MCache.php';
    include_once 'Framework/MNotification.php';

    # Meta
    include_once "meta.php";


    # UI components must be connected strictly after
    # all building cores are ready for use.

    # Connecting Vendor files except Composer
    include_once 'Components/vendor.php';
    include_once 'Routes/vendor.php';
    include_once 'Templates/vendor.php';
    include_once 'Options/vendor.php';
    include_once 'Tags/vandor.php';

} else {

    # Initially, Mirele needs to create its own infostructure,
    # which will already be used within the elements and components
    # of the interest.

    # Connection of all prototypes and instances
    include_once 'Traits/vendor.php';
    include_once 'Interface/vendor.php';
    include_once 'Instance/vendor.php';
    include_once 'Сontroller/vendor.php';
    include_once 'Prototypes/vendor.php';
    include_once 'Patterns/vendor.php';
    include_once 'Prototypes/vendor.php';
    include_once 'Components/vendor.php';
    include_once 'Templates/vendor.php';

    # Main core
    include_once 'Framework/WPGNU.php';

    # Connecting Vendor files except Composer
    include_once 'Routes/vendor.php';
    include_once 'Options/vendor.php';
    include_once 'Tags/vandor.php';

}

# Setup an error handler
set_error_handler(

/**
 * @param $errno
 * @param $errstr
 * @param $errfile
 * @param $errline
 */

    function ($errno, $errstr, $errfile, $errline) {
        $logger = new Logger(MIRELE_LOG_FILE);
        $logger->warning("(line $errline:$errfile) >>> $errstr");
    }

);


# Another error handler
register_shutdown_function(/**
 *
 */ function () {

    if (error_get_last()) {
        $error = (object)error_get_last();
        $logger = new Logger(MIRELE_LOG_FILE);
        $logger->error("(line $error->line:$error->file) >>> $error->message");
    }

});

# Rest Redirect
add_action(
/**
 *
 */ 'rest_api_init', function () {

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
add_action(/**
 *
 */ 'wp_ajax_nopriv_mirele_endpoint_v1', function () {

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
add_action(/**
 *
 */ 'wp_ajax_mirele_endpoint_v1', function () {

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
/**
 *
 */ 'init', function () {

    global $post;

    # Registration of some components of the Compound
    add_shortcode('Component', function ($attr, $content) {
        Store::call($attr['name'], array_merge((array)$attr, ['attr' => (array)$attr], (array)['context_content' => $content]));
    });

    add_shortcode('Compound', function ($attr, $content) {});

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

    # We will register all necessary scripts in the future.
    wp_register_script('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js', array('jquery'), '', true);
    wp_register_script('vue', 'https://cdn.jsdelivr.net/npm/vue', array('jquery'), '', true);
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'), '', true);
    wp_register_script('axios', 'https://unpkg.com/axios/dist/axios.min.js', array('jquery'), '', true);
    wp_register_script('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), '', true);
    wp_register_script('mirele_admin', '/public/js/admin.min.js', array('jquery', 'vue'), '', true);
    wp_register_script('mireleapi', '/public/js/API.min.js', array('jquery', 'vue'), '', true);
    wp_register_script('AIK', '/public/js/AIK.js', array('jquery', 'vue'), '', true);

    wp_register_script('compound', '/public/js/compound.min.js', array('jquery', 'vue'), '', true);
    wp_register_script('compound_form_props', '/public/js/compound/form/props.min.js', array('jquery', 'vue'), '', true);
    wp_register_script('compound_form_insertComponent', '/public/js/compound/form/insertComponent.min.js', array('jquery', 'vue'), '', true);
    wp_register_script('compound_form_insertTemplate', '/public/js/compound/form/insertTemplate.min.js', array('jquery', 'vue'), '', true);
    wp_register_script('compound_form_propsTemplate', '/public/js/compound/form/propsTemplate.min.js', array('jquery', 'vue'), '', true);

    wp_register_script('woocommerceui_product', '/public/js/woocommerceui_product.min.js', array('jquery', 'vue', 'mireleapi'), '', true);
    wp_register_script('woocommerceui_products', '/public/js/woocommerceui_products.min.js', array('jquery', 'vue', 'mireleapi'), '', true);
    wp_register_script('woocommerceui_login', '/public/js/woocommerceui_login.min.js', array('jquery', 'vue', 'mireleapi'), '', true);
    wp_register_script('woocommerceui_signup', '/public/js/woocommerceui_signup.min.js', array('jquery', 'vue', 'mireleapi'), '', true);
    wp_register_script('woocommerceui_recovery_password', '/public/js/woocommerceui_recovery_password.min.js', array('jquery', 'vue', 'mireleapi'), '', true);

    # We will register all styles necessary in the future. (long)
    wp_register_style('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css');
    wp_register_style('bootsrtap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false);

    // TODO: Redirect to public
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

    # The script works in the visibility area of the Compound editor
    $wp_page = get_post((MIRELE_GET)['page_id']);
    if ($wp_page) {
        wp_localize_script(
            'compound', 'Compound',
            [
                'page_on_edit' => (MIRELE_GET)['page_id'],
                'page' => !empty($post->ID) ? $post->ID : 0,
                'page_on_edit_url' => !empty($wp_page->guid) ? $wp_page->guid : 0
            ]
        );
    }


    # If support for WooCommerce is provided,
    # we reassign the routing of code shorts.
    if (WOOCOMMERCE_SUPPORT) {

        remove_shortcode("woocommerce_my_account");
        add_shortcode("woocommerce_my_account", function () {

            # If the user is authorized, let's display the page of his account.
            if (is_user_logged_in() === true) {

                # User requests a page to edit the client profile
                if (is_wc_endpoint_url('edit-account')) {

                    # User Generation
                    $user = (object)wp_get_current_user();
                    $user->avatar = get_avatar_url($user->ID);

                    # Render
                    TWIG::Render('Woocommerce/account/edit/profile', [
                        'user' => (object)$user,
                    ]);

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
                    TWIG::Render('Woocommerce/order', [
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
                    ]);


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
                    ));

                    foreach ($orders as $order) {
                        $orders[(new Stringer(strtoupper($order->post_status)))->format(['WC-' => 'ORDERS_'])]++;
                    }

                    # Render
                    TWIG::Render('Woocommerce/account', [
                        'account' => (object)[
                            'user' => (object)$user,
                            'orders' => (array)$orders,
                            'downloads' => (array)$downloads
                        ]
                    ]);

                }

                # Otherwise we will send to the authorization page
            } else {

                # Render
                # Checking to see if a page has been opened purposefully
                # or if a user has accessed it in order to access the account.
                if (isset((MIRELE_GET)['action'])) {

                    switch ((MIRELE_GET)['action']) {

                        case 'login':

                            # Include scripts and styles
                            wp_enqueue_script('woocommerceui_login');

                            # Render page
                            TWIG::Render('@login', [
                                'content' => [
                                    'title' => Framework\Customizer::get('@wc-login', 'mrl_wp_title_login', []),
                                    'description' => Framework\Customizer::get('@wc-login', 'mrl_wp_description_login', []),
                                ]
                            ]);
                            break;

                        case 'register':

                            # Include scripts and styles
                            wp_enqueue_script('woocommerceui_signup');

                            # Render page
                            TWIG::Render('@signup', [
                                'content' => [
                                    'title' => Framework\Customizer::get('@wc-signup', 'mrl_wp_title_signup', []),
                                    'description' => Framework\Customizer::get('@wc-signup', 'mrl_wp_description_signup', [])
                                ]
                            ]);
                            break;

                        default:

                            # Include scripts and styles
                            wp_enqueue_script('woocommerceui_login');

                            # Render page
                            TWIG::Render('@login', [
                                'content' => [
                                    'title' => Framework\Customizer::get('@wc-login', 'mrl_wp_title_login', []),
                                    'description' => Framework\Customizer::get('@wc-login', 'mrl_wp_description_login', [])
                                ]
                            ]);
                            break;
                    }

                } else {

                    if (false) {

                    } # User requests a password recovery page
                    elseif (is_wc_endpoint_url('lost-password')) {

                        # Include scripts and styles
                        wp_enqueue_script('woocommerceui_recovery_password');

                        # Render
                        TWIG::Render('@passwordRecovery', [
                            'content' => [
                                'title' => Framework\Customizer::get('@wc-recovery', 'mrl_wp_title_recovery_password', []),
                                'description' => Framework\Customizer::get('@wc-recovery', 'mrl_wp_description_recovery_password', [])
                            ]
                        ]);

                    } else {

                        # Redirect the user to the authorization,
                        # as he is not authorized and entered the page
                        # without a specific purpose.

                        # Include scripts and styles
                        wp_enqueue_script('woocommerceui_login');

                        # Render page
                        TWIG::Render('@login', [
                            'content' => [
                                'title' => Framework\Customizer::get('@wc-login', 'mrl_wp_title_login', []),
                                'description' => Framework\Customizer::get('@wc-login', 'mrl_wp_description_login', [])
                            ]
                        ]);

                    }


                }

            }

        });

    }

    # Writing data filters
    # Register URL
    add_filter('register_url', function ($data) {
        return get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=register';
    }, 1, 1);

    # Login URL
    add_filter('login_url', function ($data) {
        return get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=login';
    }, 1, 1);

    Router::error(function () { });
    Router::dispatch(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

});

# Admin front-end
add_action(
/**
 *
 */ 'admin_enqueue_scripts', function () {

    wp_enqueue_script('axios');
    wp_enqueue_script('mireleapi');
    wp_enqueue_script('AIK');
    wp_enqueue_script('vue');
    wp_enqueue_script('mirele_admin');
    wp_enqueue_script('compound');
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-draggable');
    wp_enqueue_script('jquery-ui-droppable');
    wp_enqueue_script('jquery-ui-selectable');

    wp_enqueue_script('compound_form_props');
    wp_enqueue_script('compound_form_insertComponent');
    wp_enqueue_script('compound_form_insertTemplate');
    wp_enqueue_script('compound_form_propsTemplate');

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('admin_style');

    wp_enqueue_media();

});

# User front-end
add_action(
/**
 *
 */ 'wp_enqueue_scripts', function () {

    # Scripts and styles for all pages
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

# Admin front end
add_action(
/**
 *
 */ 'admin_menu', function () {

    add_thickbox();

    add_menu_page(
        'MIRELE', 'Mirele Center', MIRELE_RIGHTS['page']['edit'], 'mirele_center', function () {
        if (current_user_can(MIRELE_RIGHTS['page']['edit'])) {
            \Mirele\TWIG::Render('Main/center');
        } else {
            \Mirele\TWIG::Render('Main/no-access');
        }
    }, '', 1);

    add_menu_page(
        'MIRELE', 'Mirele Apps', MIRELE_RIGHTS['page']['edit'], 'mirele_apps', function () {

    }, 'dashicons-screenoptions', 2);

    add_menu_page(
        'MIRELE', 'Compound Editor', MIRELE_RIGHTS['page']['edit'], 'сompound_render_editor', function () {

        if (isset((MIRELE_GET)['page_id']) ? (MIRELE_GET)['page_id'] : false) {

            # Vars
            $Markup = [];
            $page = get_post((MIRELE_GET)['page_id']);

            # Generate a block editing page
            if (has_shortcode($page->post_content, 'Compound')) {

                # Create a code vocabulary parsing object
                $Lexer = new Lexer($page->post_content);

                # Return the page with the template
                $lex = $Lexer->parse();

                # We check the essence of the lecturer
                if ((object)$lex) {

                    # Variable $lex has full markup of
                    # all data that the user has marked
                    # up in the code, BUT
                    # it has no possible fields that were missed by the user.
                    #
                    # Signature lex:
                    # (id of template) dc2cebec9a14a69c103f5e0d3076269c:
                    #   (object) props:
                    #       name => value
                    #   (array) fields:
                    #       (index of template):
                    #           (template)

                    $Layout = $lex->getLayout();

                    foreach ($Layout as $ID => $Template) {

                        $fields = [];
                        $_fields = [];

                        # We will get all the registered fields
                        # in the template, already from them we
                        # will get the markup from the token data.

                        if (isset($Template->props->name)) {

                            $template = Grider::findById($Template->props->name);

                            if ($template instanceof Template) {

                                foreach ($template->getFields() as $index => $field) {
                                    if ($field instanceof Field) {
                                        $fields[$field->getName()] = $field;
                                    }
                                }

                                $_fields = $template->getFields();

                            }

                        }


                        # Adding templates with unindexed
                        # objects is the best solution that
                        # allows you not to worry about sorting problems.

                        $Markup[] = (object)[
                            'name' => (string)$Template->props->name,
                            'ID' => (string)$ID,
                            'lex' => $Template,
                            'fields' => $fields,
                            'template' => [
                                'fields' => $_fields
                            ]
                        ];

                    }

                }

                # Render Page Editor
                TWIG::Render('Compound/editor', [
                    'page' => $page,
                    'markup' => $Markup,
                    'layout' => $lex->getLayout(),
                    'store' => [
                        'templates' => Grider::all(),
                        'components' => Store::all(),
                        'getFamilies' => Store::getFamilies(true),
                        'templatesTypes' => Grider::getTypes(),
                        'templatesFamilies' => Grider::getFamilies(),
                        'templatesFolders' => Grider::getFolders(),
                    ]
                ]);

            }

        } else {

            # Render list of all pages or welcome message if there are no pages
            TWIG::Render('Compound/main', [
                'pages' => get_pages(array(
                    'meta_key' => '_wp_page_template',
                    'meta_value' => COMPOUND_CANVAS
                )),
                'templates' => Grider::all()
            ]);

        }

    }, 'dashicons-welcome-write-blog', 3);

    add_submenu_page(
        'сompound_render_editor', 'MIRELE', 'Demos', MIRELE_RIGHTS['page']['edit'], 'сompound_render_demos', function () {

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