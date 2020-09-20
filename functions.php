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
use Mirele\Compound\Store;
use Mirele\Compound\Grider;
use Mirele\Compound\Lexer;
use Mirele\Compound\Duplicator;
use Mirele\Compound\Component;
use Mirele\Compound\Template;
use Mirele\Compound\Field;
use Mirele\Framework\Stringer;
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
define('COMPOUND_VARCHAR_SIZE_DB', 512);
define('COMPOUND_VARCHAR_INT_DB', 64);
define('WOOCOMMERCE_SUPPORT', function_exists('is_woocommerce'));

# Meta Constants
define('MIRELE_VERSION', "1.0.0");
define('COMPOUND_VERSION', "1.0.1");
define('COMPOUND_INSTANCES', 'SMART');
define('MIRELE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . explode('?', $_SERVER['REQUEST_URI'], 2)[0]);

# Constants regulators
define('MIRELE_MIN_PERMISSIONS_FOR_EDIT', 'edit_themes');
define('MIRELE_RIGHTS', [
    'page' => [
        'create' => 'edit_themes',
        'edit' => 'edit_themes',
        'remove' => 'edit_themes',
    ]
]);
define('COMPOUND_FORBIDDEN_SYMBOLS', array(':', '/', "@"));
define('COMPOUND_RIGHTS_FOR_VISUAL_EDIT', 'edit_themes');
define('COMPOUND_CANVAS', 'canvas.php');
define('MIRELE_NONCE', 'mrl-wp-nonce');

# File path constants
define('COMPOUND_TEMPLATES_DIR', get_template_directory() . '/templates');
define('COMPOUND_TWIG_DIR', get_template_directory() . '/twig');
define('COMPOUND_TEMPLATES_HTML_DIR', get_template_directory() . '/rosemary_html');
define('MIRELE_CORE_DIR', get_template_directory() . '/core');
define('MIRELE_SOURCE_DIR', get_template_directory_uri() . '/source');
define('MIRELE_SOURCE_PATH', get_template_directory() . '/source');
define('MIRELE_LOG_FILE', get_template_directory() . '/logger.log');
define('MIRELE_ERROR_FILE', get_template_directory() . '/.error');

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

        # Main Core
        include_once 'core/class/Router.php';
        include_once 'core/class/TWIG.php';
        include_once 'core/Framework/Iterator.php';
        include_once 'core/Framework/WPGNU.php';
        include_once 'core/Framework/Buffer.php';
        include_once 'core/Framework/String.php';
        include_once 'core/Framework/Storage.php';
        include_once 'core/Framework/TWIG.php';
        include_once 'core/Framework/TWIGWoocommerce.php';
        include_once 'core/Framework/Customizer.php';
        include_once 'core/Framework/Option.php';
        include_once 'core/Compound/Class/TagsManager.php';
        include_once 'core/Compound/Class/Constructor.php';
        include_once 'core/Compound/Class/Lexer.php';
        include_once 'core/Compound/Class/Lexer/Converter.php';
        include_once 'core/Compound/Config.php';
        include_once 'core/Compound/Construction.php';
        include_once 'core/Compound/Tag.php';
        include_once 'core/Compound/Signature.php';
        include_once 'core/Compound/Directive.php';
        include_once 'core/Compound/Component.php';
        include_once 'core/Compound/Store.php';
        include_once 'core/Compound/Grider.php';
        include_once 'core/Compound/Field.php';
        include_once 'core/Compound/Duplicator.php';
        include_once 'core/Compound/Template.php';

        # Arrhitectural Classes Sets (Mirele)
        include_once 'core/class/MFile.php';
        include_once 'core/class/MApps.php';
        include_once 'core/class/MCache.php';
        include_once 'core/class/MHubSpot.php';
        include_once 'core/class/MMailChimp.php';
        include_once 'core/class/MSafe.php';
        include_once 'core/class/MBBPress.php';
        include_once 'core/class/MDemos.php';
        include_once 'core/class/MNotification.php';
        include_once 'core/class/MLogger.php';

        # Meta
        include_once "meta.php";

        # Abstract core files
        include_once 'core/Option.php';
        include_once 'core/Tags.php';

    # UI components must be connected strictly after
    # all building cores are ready for use.

        # Components
        include_once 'Components/Abstract/Inputs/default.php';
        include_once 'Components/Abstract/Textareas/default.php';
        include_once 'Components/Abstract/Selects/default.php';
        include_once 'Components/Abstract/Buttons/default.php';
        include_once 'Components/Abstract/Checkboxs/default.php';
        include_once 'Components/Abstract/Radios/default.php';

        include_once 'Components/Grids/default.php';
        include_once 'Components/Carts/default.php';
        include_once 'Components/Sidebars/default.php';
        include_once 'Components/Footers/default.php';
        include_once 'Components/Navbars/default.php';
        include_once 'Components/Menus/default_navbar.php';
        include_once 'Components/Woocommerce/Notes/default.php';
        include_once 'Components/Woocommerce/Steps/default.php';
        include_once 'Components/Woocommerce/Field/default.php';
        include_once 'Components/Woocommerce/Forms/default_billing.php';
        include_once 'Components/Woocommerce/Forms/default_shipping.php';
        include_once 'Components/Woocommerce/Carousel/default.php';
        include_once 'Components/Woocommerce/Notices/default.php';
        include_once 'Components/Woocommerce/Gallerys/default.php';
        include_once 'Components/Woocommerce/Tables/Orders/default.php';
        include_once 'Components/Woocommerce/Tables/Downloads/default.php';
        include_once 'Components/Woocommerce/Tables/Cart/default.php';
        include_once 'Components/Woocommerce/Placeholders/Orders/default.php';
        include_once 'Components/Woocommerce/Placeholders/Downloads/default.php';
        include_once 'Components/Woocommerce/Placeholders/Cart/default.php';

        # Connecting Vendor files except Composer
        include_once 'Routes/vendor.php';
        include_once 'Templates/vendor.php';
        include_once 'Prototypes/vendor.php';

} else {

    # Initially, Mirele needs to create its own infostructure,
    # which will already be used within the elements and components
    # of the interest.

        # Arrhitectural Classes Sets (Mirele)
        include_once 'core/class/MFile.php';

        # Main core
        include_once 'core/class/Router.php';
        include_once 'core/class/MLogger.php';
        include_once 'core/Framework/Iterator.php';
        include_once 'core/Framework/WPGNU.php';
        include_once 'core/Framework/Buffer.php';
        include_once 'core/Framework/String.php';
        include_once 'core/Framework/Int.php';
        include_once 'core/Framework/Storage.php';
        include_once 'core/Compound/Component.php';
        include_once 'core/Framework/Option.php';
        include_once 'core/Framework/Customizer.php';

        # Abstract core files
        include_once 'core/Option.php';
        include_once 'core/Router.php';

        # Connecting Vendor files except Composer
        include_once 'Routes/vendor.php';


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
        add_shortcode('Component', function ($attr, $content) {
            Store::call($attr['name'], array_merge((array) $attr, ['attr' => (array) $attr], (array) ['context_content' => $content]));
        });

        # Registration of some components in VM grid of the Compound
        add_shortcode('Compound', function ($attr, $content) {

            # Create a code vocabulary parsing object
            $Lexer = new Lexer("[Compound role=\"\"] $content [/Compound]");
            $lex = $Lexer->parse();

            # Create an environment for template renderer
            $Buffer = new Framework\Buffer();

            foreach ($lex->getTemplates() as $name => $template) {
                foreach ($template as $instance) {
                    if (isset($instance['field']) and (is_array($instance['field']) or is_object($instance['field']))) {

                        $components = [];

                        foreach ($instance['field'] as $field => $content) {
                            foreach ($content as $index => $component) {
                                if ($component instanceof \Mirele\Compound\Tag) {

                                    $attr = (object) $component->getAttributes();

                                    if (isset($attr->name)) {

                                        $component_ = Store::get($attr->name);

                                        if ($component_ instanceof Component) {

                                            $instance_ = new Duplicator();
                                            $instance_->setProps((array) $component->getAttributes());
                                            $instance_->setFieldName($field);
                                            $instance_->setComponent($component_);
                                            $components[] = $instance_;

                                        }
                                    }

                                }
                            }

                        }
                    }

                    $Buffer->append(Grider::call($name, array_merge(
                        (array) $attr,
                        (array) [
                            'call' => [
                                'components' => $components
                            ],
                        ],
                        (array) $instance['prop']
                    ), true));

                    unset($components);

                }
            }

            # Return the page with the template
            return $Buffer->toString('*', '');


        });

        # Disable unnecessary scripts
        wp_dequeue_style( 'woocommerce_frontend_styles' );
        wp_dequeue_style( 'woocommerce-general');
        wp_dequeue_style( 'woocommerce-layout' );
        wp_dequeue_style( 'woocommerce-smallscreen' );
        wp_dequeue_style( 'woocommerce_fancybox_styles' );
        wp_dequeue_style( 'woocommerce_chosen_styles' );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

        wp_deregister_script( 'selectWoo' );

        wp_dequeue_script( 'selectWoo' );
        wp_dequeue_script( 'wc-add-payment-method' );
        wp_dequeue_script( 'wc-lost-password' );
        wp_dequeue_script( 'wc_price_slider' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-add-to-cart' );
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'wc-credit-card-form' );
        wp_dequeue_script( 'wc-checkout' );
        wp_dequeue_script( 'wc-add-to-cart-variation' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-cart' );
        wp_dequeue_script( 'wc-chosen' );
        wp_dequeue_script( 'woocommerce' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
        wp_dequeue_script( 'jquery-blockui' );
        wp_dequeue_script( 'jquery-placeholder' );
        wp_dequeue_script( 'jquery-payment' );
        wp_dequeue_script( 'fancybox' );
        wp_dequeue_script( 'jqueryui' );

        # Turn off unnecessary scripts through filters.
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

         # We will register all necessary scripts in the future.
        wp_register_script('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js', array('jquery'), '', true);
        wp_register_script('vue', 'https://cdn.jsdelivr.net/npm/vue', array('jquery'), '', true);
        wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'), '', true);
        wp_register_script('axios', 'https://unpkg.com/axios/dist/axios.min.js', array('jquery'), '', true);
        wp_register_script('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), '', true);
        wp_register_script('babel', 'https://unpkg.com/@babel/standalone/babel.min.js', array('jquery'), '', true);
        wp_register_script('mirele_admin', MIRELE_SOURCE_DIR . '/js/admin.min.js', array('jquery', 'vue'), '', true);
        wp_register_script('mireleapi', MIRELE_SOURCE_DIR . '/js/API.min.js', array('babel', 'jquery', 'vue'), '', true);
        wp_register_script('babelui', MIRELE_SOURCE_DIR . '/js/babel.js', array('babel', 'jquery'), '', true);

        wp_register_script('woocommerceui_product', MIRELE_SOURCE_DIR . '/js/woocommerceui_product.min.js', array('babel', 'jquery', 'vue', 'mireleapi'), '', true);
        wp_register_script('woocommerceui_products', MIRELE_SOURCE_DIR . '/js/woocommerceui_products.min.js', array('babel', 'jquery', 'vue', 'mireleapi'), '', true);
        wp_register_script('woocommerceui_login', MIRELE_SOURCE_DIR . '/js/woocommerceui_login.min.js', array('babel', 'jquery', 'vue', 'mireleapi'), '', true);
        wp_register_script('woocommerceui_signup', MIRELE_SOURCE_DIR . '/js/woocommerceui_signup.min.js', array('babel', 'jquery', 'vue', 'mireleapi'), '', true);
        wp_register_script('woocommerceui_recovery_password', MIRELE_SOURCE_DIR . '/js/woocommerceui_recovery_password.min.js', array('babel', 'jquery', 'vue', 'mireleapi'), '', true);

        # We will register all styles necessary in the future.
        wp_register_style('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css');
        wp_register_style('bootsrtap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false);
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

        # If support for WooCommerce is provided,
        # we reassign the routing of code shorts.
        if (WOOCOMMERCE_SUPPORT) {

            remove_shortcode ("woocommerce_my_account");
            add_shortcode ("woocommerce_my_account", function () {

                # If the user is authorized, let's display the page of his account.
                if (is_user_logged_in() === true) {

                    # User requests a page to edit the client profile
                    if (is_wc_endpoint_url('edit-account')) {

                        # User Generation
                        $user = (object) wp_get_current_user();
                        $user->avatar = get_avatar_url($user->ID);

                        # Render
                        TWIG::Render('Woocommerce/account/edit/profile', [
                            'user' => (object) $user,
                        ]);

                    }

                    # Viewing a specific order
                    elseif (is_wc_endpoint_url('view-order')) {

                        # Globalize
                        global $wp;

                        # User Generation
                        $user = (object) wp_get_current_user();
                        $user->avatar = get_avatar_url($user->ID);

                        # Generating order
                        $order = wc_get_order($wp->query_vars['view-order']);

                        # Render
                        TWIG::Render('Woocommerce/order', [
                            'user'   => (object) $user,
                            'id'     => (integer) $wp->query_vars['view-order'],
                            'order'  => $order,
                            'note'   => wc_get_order_notes(['order_id' => (integer) $wp->query_vars['view-order']]),
                            'access' => $user->ID === $order->get_user_id(),
                            'time'   => [
                                'modified' => date("m.d.y H:i", strtotime($order->get_date_modified())),
                                'created' => date("m.d.y H:i", strtotime($order->get_date_created())),
                                'paid' => $order->get_date_paid()
                            ]
                        ]);


                    }

                    # User does not ask for anything.
                    else {

                        # User Generation
                        $user = (object) wp_get_current_user();
                        $user->avatar = get_avatar_url($user->ID);

                        # Generation of user downloads
                        $downloads = wc_get_customer_available_downloads($user->ID);

                        # Generation of user orders
                        $orders = get_posts(array(
                            'numberposts' => -1,
                            'meta_key'    => '_customer_user',
                            'meta_value'  => get_current_user_id(),
                            'post_type'   => wc_get_order_types(),
                            'post_status' => array_keys( wc_get_order_statuses() )
                        ));

                        foreach ($orders as $order) {
                            $orders[(new Stringer(strtoupper($order->post_status)))->format(['WC-' => 'ORDERS_'])]++;
                        }

                        # Render
                        TWIG::Render('Woocommerce/account', [
                            'account'=> (object) [
                                'user' => (object) $user,
                                'orders' => (array) $orders,
                                'downloads' => (array) $downloads
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
                                        'title' => Framework\Customizer::get('authorization_login', 'mrl_wp_title_login', []),
                                        'description' => Framework\Customizer::get('authorization_login', 'mrl_wp_description_login', []),
                                    ]
                                ]);
                                break;

                            case 'register':

                                # Include scripts and styles
                                wp_enqueue_script('woocommerceui_signup');

                                # Render page
                                TWIG::Render('@signup', [
                                    'content' => [
                                        'title' => Framework\Customizer::get('authorization_signup', 'mrl_wp_title_signup', []),
                                        'description' => Framework\Customizer::get('authorization_signup', 'mrl_wp_description_signup', [])
                                    ]
                                ]);
                                break;

                            default:

                                # Include scripts and styles
                                wp_enqueue_script('woocommerceui_login');

                                # Render page
                                TWIG::Render('@login', [
                                    'content' => [
                                        'title' => Framework\Customizer::get('authorization_login', 'mrl_wp_title_login', []),
                                        'description' => Framework\Customizer::get('authorization_login', 'mrl_wp_description_login', [])
                                    ]
                                ]);
                                break;
                        }

                    } else {

                        if (false) {

                        }

                        # User requests a password recovery page
                        elseif (is_wc_endpoint_url('lost-password')) {

                            # Include scripts and styles
                            wp_enqueue_script('woocommerceui_recovery_password');

                            # Render
                            TWIG::Render('@passwordRecovery', [
                                'content' => [
                                    'title' => Framework\Customizer::get('authorization_recovery_password', 'mrl_wp_title_recovery_password', []),
                                    'description' => Framework\Customizer::get('authorization_recovery_password', 'mrl_wp_description_recovery_password', [])
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
                                    'title' => Framework\Customizer::get('authorization_login', 'mrl_wp_title_login', []),
                                    'description' => Framework\Customizer::get('authorization_login', 'mrl_wp_description_login', [])
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

        Router::error(function () {});
        Router::dispatch(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

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

# User front-end body open tag
add_action(
    'wp_body_open', function () {

        if (is_page_template(COMPOUND_CANVAS)) {

        }

});

# Admin front end
add_action(
    'admin_menu', function () {

        add_thickbox();

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

                if (isset((MIRELE_GET)['page_id']) ? (MIRELE_GET)['page_id'] : false) {

                    $page = get_post((MIRELE_GET)['page_id']);
                    $is = (object) [
                        'template' => has_shortcode($page->post_content, 'Compound')
                    ];

                    $document = (object) [
                        'fields' => []
                    ];

                    # If a shortcode is found on the page
                    if ($is->template) {

                        # Create a code vocabulary parsing object
                        $Lexer = new Lexer($page->post_content);

                        # Return the page with the template
                        $lex = $Lexer->parse();

                        if ($lex) {

                            foreach ($lex->getTemplates() as $name => $layout) {

                                foreach ($layout as $id => $instance) {

                                    $Template = Grider::get($name);

                                    if ($Template instanceof Template) {

                                        $fields = $Template->getFields();

                                        if ($fields) {

                                            foreach ($fields as $field => $object) {

                                                if ($object instanceof Field) {

                                                    $local = $lex->getTemplateField((string) $name, $object->getName(), $id);

                                                    $document->fields[$name][$id][$object->getName()] = (object) [
                                                        'field' => (object) [
                                                            'name' => $field,
                                                            'instance' => $object
                                                        ],
                                                        'package' => is_array($local) ? $local : []
                                                    ];

                                                }

                                            }

                                        }
                                    }

                                }

                            }

                        }

                    }

                    # Render Page Editor
                    TWIG::Render('Compound/editor', [
                        'page' => $page,
                        'is_template' => has_shortcode($page->post_content, 'Compound'),
                        'lex' => [
                            'templates' => $is->template ? $lex->getTemplates() : (object) []
                        ],
                        'document' => $is->template ? $document : (object) [],
                        'templates' => Grider::all()
                    ]);

                } else {

                    # Render list of all pages or welcome message if there are no pages
                    TWIG::Render('Compound/main', [
                        'pages' => get_pages( array(
                            'meta_key' => '_wp_page_template',
                            'meta_value' => COMPOUND_CANVAS
                        )),
                        'templates' => Grider::all()
                    ]);

                }

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