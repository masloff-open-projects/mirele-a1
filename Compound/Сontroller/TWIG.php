<?php

namespace Mirele;

use Mirele\Compound\Component;
use Mirele\Compound\Field;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Framework\Customizer;
use Mirele\Framework\Stringer;
use Mirele\Utils\Converter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use voku\helper\AntiXSS;

/**
 * Class TWIG
 * @package Mirele
 */
class TWIG
{

    /**
     * @var
     */
    private static $twig;
    /**
     * @var
     */
    private static $ready;
    /**
     * @var string[]
     */
    private static $alias = [
//        '@woocommerce' => 'Woocommerce',
//        "@login" => 'Woocommerce/authorization/login',
//        "@signup" => 'Woocommerce/authorization/signup',
//        "@passwordRecovery" => 'Woocommerce/authorization/password_recovery',
//        "application@footer" => 'Compound/Engine/Application/footer.html.twig',
//        "application@header" => 'Compound/Engine/Application/header.html.twig',
//        "application@layout" => 'Compound/Engine/Application/layout.html.twig',
    ];

    /**
     *
     */
    public static function init () {

        self::$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader(TEMPLATE_PATH), [
            'cache' => false
        ]);
        self::$twig->addGlobal('wp', new \Mirele\Framework\WP);
        self::$twig->addGlobal('Option', new \Mirele\Framework\Application\Option);
        self::$twig->addGlobal('converter', clone new Converter);
        self::$twig->addExtension (new class extends AbstractExtension
        {

            public function getFilters()
            {
                return [
                    new TwigFilter('xss',         [$this, 'XSS']),
                    new TwigFilter('var_dump',    [$this, 'var_dump']),
                ];
            }

            public function getFunctions()
            {
                return [
                    new TwigFunction('Component', [$this, 'Component']),
                    new TwigFunction('Field',     [$this, 'Field']),
                    new TwigFunction('Tag',       [$this, 'Tag']),
                    new TwigFunction('Option',    [$this, 'Option']),
                    new TwigFunction('App',       [$this, 'App']),
                ];
            }

            public function var_dump ($data) {
                var_dump($data);
            }

            public function XSS ($data) {

                $XSS = new AntiXSS();
                $return = $XSS->xss_clean($data);
                unset($XSS);

                return $return;

            }

            public function Tag (string $tag, ... $props) {

                // FIXME
                // Эттот движок создания комопнентов ужасен по своей сущности!
                // Убрать его чертовой матери

                // input_class = это какаято пораша
                
                $attrs = [];
                $attributes = [];

                # Merge attrs
                foreach ($props as $object) {
                    if (is_array($object) or is_object($object)) {
                        $attrs = array_merge((array) $attrs, (array) $object);
                    }
                }

                foreach ($attrs as $attr => $value) {
                    if (!empty($value) and $value != false and is_string($value)) {
                        $attributes[$attr] = $value;
                    }
                }

                // Вот это параша какя-то
                if (isset($attributes['input_class'])) {

                    if (is_array($attributes['input_class']) or is_object($attributes['input_class'])) {
                        $attributes['class'] = $attributes['class'] . join(' ', $attributes['input_class']);
                    } else {
                        $attributes['class'] = $attributes['class'] . (string) $attributes['input_class'];
                    }

                    unset($attributes['input_class']);

                }

                $inline = (new Converter)->obj2htmlattr((array) $attributes);
                $value = "";

                if (isset($attributes['value'])) {
                    $value = $attributes['value'];

                    if (isset($attributes['text'])) {
                        $value = $attributes['text'];
                    }
                }

                $attr_inline = isset($attributes['inline']) ? $attributes['inline'] : '';

                return "<$tag $inline $attr_inline>$value</$tag>";

            }

            public function Component (string $id, array $props) {
                Store::call($id, $props);
            }

            public function Option (string $name, $namespace="*", $props=[]) {

                return (object) [
                    'perform' => Customizer::perform($namespace, $name, $props)
                ];

            }

            public function Field (string $name, array $props) {
                if ($props and isset($props['template']) and $props['template'] instanceof Template) {

                    $Template = $props['template'];
                    if ($Template instanceof Template) {
                        $Field = $Template->getField($name);

                        if ($Field instanceof Field) {

                            if (isset($props['components'][$name])) {
                                foreach ($props['components'][$name] as $component) {
                                    if ($component instanceof Component) {;
                                        print ($component->build()->render([
                                            'attributes' => array_merge(
                                                (array) $component->getProps(),
                                                (array) isset($props['attr']) ? $props['attr'] : []
                                            )
                                        ]));
                                    }
                                }
                            } elseif (isset($props['default'])) {

                                if ($props['default'] instanceof Component) {
                                    print $props['default']->build()->render([
                                        'attributes' => array_merge(
                                            (array) $props['default']->getProps(),
                                            (array) isset($props['attr']) ? $props['attr'] : []
                                        )
                                    ]);
                                }

                            }
                        }
                    }

                }
            }

            public function App () {
                return (object) array(
                    'User' => (object) wp_get_current_user(),
                    'Blog' => function ($option) {
                        return get_bloginfo($option, 'raw');
                    },
                    'Option' => function ($namespace, $option, $props=[]) {
                        return Customizer::get($namespace, $option, $props);
                    }
                );
            }

            public function getName() {
                return 'MireleFramework';
            }
        });

        self::$ready = true;

    }


    /**
     * @param string $template
     * @param array $params
     * @param false $noPrint
     * @return false
     */
    public static function Render ($template="main", $params=Array(), $renderIntoVariable=false) {

        # If TWIG is not already
        /**
         * @depreacted
         */
        if (!self::$ready) {
            self::init();
        }

        /**
         * @depreacted
         */
        # Processing template name
        $template =  ((new Stringer($template))::format(self::$alias));

        $ext = pathinfo($template, PATHINFO_EXTENSION);
        $path = $template . (empty($ext) ? '.twig' : '');

        $params = array_merge(
            array (
                'ww2as' => get_option('mrl_wp_sidebar_width_2_active', 2),
                'ww1as' => get_option('mrl_wp_sidebar_width_1_active', 4),
                'ars' => is_active_sidebar('right-side-page', 'false') == 'true' ? true : false,
                'als' => is_active_sidebar('left-side-page', 'false') == 'true' ? true : false,
                'hsmp' => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
                'options' => Customizer::all(),
                'source' => MIRELE_SOURCE_DIR,
                'url_without_params' => MIRELE_URL,
                'GET' => MIRELE_GET,
                'page_id' => isset($_GET['page']) ? $_GET['page'] : false,
                "url" => [
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
            (array) $params
        );

        if ($renderIntoVariable) {
            return self::$twig->render($path, $params);
        } else {
            print self::$twig->render($path, $params);
        }


    }

}