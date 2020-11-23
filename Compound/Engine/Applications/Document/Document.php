<?php


namespace Mirele\Compound\Engine;

use Mirele\Utils\Converter;
use \Twig\Environment as Engine;
use \Twig\Loader\FilesystemLoader as FS;


final class Document
{

    private static $twig;
    private static $alias;
    private static $middleware;

    /**
     * @param string $file
     * @param array $props
     * @return false
     */
    private static function __render (string $file, array $props) {

        global $post;

        if (self::$twig instanceof Engine) {

            $props = array_merge(
                array (
                    'ww2as' => get_option('mrl_wp_sidebar_width_2_active', 2),
                    'ww1as' => get_option('mrl_wp_sidebar_width_1_active', 4),
                    'hsmp' => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
                    'source' => MIRELE_SOURCE_DIR,
                    'url_without_params' => MIRELE_URL,
                    'GET' => MIRELE_GET,
                    'page_id' => isset($_GET['page']) ? $_GET['page'] : false,
                    'url' => [
                        'registration' => wp_registration_url(),
                        'login' => wp_login_url(),
                        'logout' => wp_logout_url(),
                        'lost_password' => wp_lostpassword_url(),
                        'checkout' => WOOCOMMERCE_SUPPORT ? esc_url(wc_get_checkout_url()) : '',
                        'profile' => [
                            'edit' => get_edit_profile_url(),
                        ],
                        'customer' => [
                            'edit' => WOOCOMMERCE_SUPPORT ? wc_customer_edit_account_url() : '',
                        ],
                        'service' => MIRELE_URLS
                    ]
                ),
                (array) $props
            );

            foreach (self::$middleware as $def) {
                if (is_callable($def)) {
                    $document = call_user_func($def, $post);
                    if ($document) {
                        return $document;
                    }
                }
            }

            return self::$twig->render($file, $props);

        } else {
            return false;
        }
    }

    /**
     * @param $file
     * @return bool
     */
    private static function __is_template ($file) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $file = $file . (empty($ext) ? '.twig' : '');
        $path = realpath(TEMPLATE_PATH . '/' . $file);
        return (file_exists($path) and is_file($path) and is_readable($path));
    }

    /**
     *
     */
    public static function init () {

        self::$twig = new Engine(new FS(TEMPLATE_PATH), [
            'cache' => false
        ]);

        self::$twig->addGlobal('App', new Application);
        self::$twig->addGlobal('wp', new \Mirele\Framework\WP);
        self::$twig->addGlobal('Option', new \Mirele\Framework\Application\Option);
        self::$twig->addGlobal('converter', clone new Converter);

        self::$twig->addExtension (new Extension);


    }

    public static function middleware (callable $callback) {
        self::$middleware[] = $callback;
    }

    /**
     * @param string $file
     * @param array $props
     * @return bool
     */
    public static function render (string $file, $props=array()) {

        if (self::__is_template($file)) {
            echo self::__render($file, (array) $props);
            return true;
        } else {
            wp_die("The template file could not be rendered because it was not found or unavailable ($file)", 'Compound — Not rendered');
        }

    }

    /**
     * @param $name
     * @param $file
     * @return bool
     * @throws \Exception
     */
    public static function alias ($name, $file) {
        if (self::__is_template($file)) {
            if (!isset(self::$alias[$name])) {
                self::$alias[$name] = $file;
                return true;
            } else {
                throw new \Exception("Alias $name already refers to " . self::$alias[$name], 255);
            }
        } else {
            throw new \Exception("Alias $name tries to reference a non-existent template file", 404);
        }

    }

}