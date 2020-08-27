<?php

namespace Mirele;

use \Twig\Extension\AbstractExtension;
use \Twig\TwigFunction;

class TWIG
{


    /**
     * The single object is stored in a static class field. This field is an array, so...
     * how we let our Lonely have subclasses * All the elements of it.
     * the arrays will be copies of specific subclasses of Single. Don't worry,
     * we're about to get to know how it works
     */

    private static $instances = [];
    private static $twig;
    private static $ready;


    /**
     * Loners should not be cloned.
     */

    protected function __clone() { }


    /**
     * Single units should not be recovered from lines.
     *
     * @throws Exception
     */

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }


    /**
     * Сonstruct Single must always be hidden to prevent
     * creating an object through the operator new.
     */

    protected function __construct() { }


    /**
     * It's a static method that controls access to a single instance. At .
     * the first run, it creates an instance of a loner and puts it in *
     * static field. On subsequent launches, it returns the object to the client,
     * stored in a static field *
     *
     * This implementation allows you to extend the Singles class by saving everywhere
     * only one copy of each subclass.
     *
     * @return mixed|static
     */

    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }


    static public function init () {

        self::$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader(ROSEMARY_TWIG_DIR), [
            'cache' => false,
            # 'cache' => ROSEMARY_TEMPLATES_DIR . '/cache',
        ]);
        self::$twig->addGlobal('wp', new \Mirele\Framework\TWIG);
        self::$twig->addGlobal('woocommerce', new \Mirele\Framework\TWIGWoocommerce);

        self::$twig->addExtension (new class extends AbstractExtension
        {
            public function getFunctions()
            {
                return [
                    new TwigFunction('Component', [$this, 'Component']),
                ];
            }

            public function Component (string $id, array $props) {
                \Mirele\Framework\Store::call($id, $props);
            }

            public function getName() {
                return 'MireleFramework';
            }
        });

        self::$ready = true;

    }


    static public function Render ($template="main", $params=Array()) {

        # If TWIG is not already
        if (!self::$ready) {
            self::init();
        }

        $template = pathinfo($template);

        if (file_exists(ROSEMARY_TWIG_DIR . '/' . $template['dirname'] . '/' . $template['basename'] . '.twig')) {

            $params = array_merge(
                array (
                    'source' => MIRELE_SOURCE_DIR,
                    'url_without_params' => MIRELE_URL,
                    'page_id' => isset($_GET['page']) ? $_GET['page'] : false,
                ),
                (array) $params
            );

            print self::$twig->render($template['dirname'] . '/' . $template['basename'] . '.twig', $params);

        } else {

            return false;
        }

    }

}