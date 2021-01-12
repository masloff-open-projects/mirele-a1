<?php


namespace Mirele\Compound\Document;


use Mirele\Compound\HelpersStore;
use Twig\Environment as Engine;
use Twig\Loader\FilesystemLoader as FS;


final class TWIG
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

            foreach (self::$middleware as $def) {
                if (is_callable($def)) {
                    $document = call_user_func($def, $post);
                    if ($document) {
                        return $document;
                    }
                }
            }

            return self::$twig->render($file, array(
                'attr' => $props,
                'url' => [
                ],
                'wordpress' => [
                    'ww2as' => get_option('mrl_wp_sidebar_width_2_active', 2),
                    'ww1as' => get_option('mrl_wp_sidebar_width_1_active', 4),
                    'hsmp' => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
                    'source' => MIRELE_SOURCE_DIR,
                    'url_without_params' => MIRELE_URL,
                    'GET' => MIRELE_GET,
                    'page_id' => isset($_GET['page']) ? $_GET['page'] : false,
                ]
            ));

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

        self::$twig->addGlobal('wp', new \Mirele\Framework\WP);
        self::$twig->addGlobal('Helpers', clone new HelpersStore);

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
     * @param string $file
     * @param array $props
     * @return false
     */
    public static function renderToString (string $file, $props=array()) {

        if (self::__is_template($file)) {
            return self::__render($file, (array) $props);
        } else {
            return false;
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