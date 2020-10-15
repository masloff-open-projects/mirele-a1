<?php

namespace Mirele;

use Automattic\Jetpack\Sync\Modules\Options;
use Mirele\Compound\Component;
use Mirele\Compound\Field;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Framework\Customizer;
use Mirele\Framework\Option;
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
        '@woocommerce' => 'Woocommerce',
        "@login" => 'Woocommerce/authorization/login',
        "@signup" => 'Woocommerce/authorization/signup',
        "@passwordRecovery" => 'Woocommerce/authorization/password_recovery',
    ];

    /**
     *
     */
    public static function init () {

        self::$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader(COMPOUND_TWIG_DIR), [
            'cache' => false
        ]);
        self::$twig->addGlobal('wp', new \Mirele\Framework\WP);
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

                $attrs = [];

                foreach ($props as $object) {
                    if (is_array($object) or is_object($object)) {
                        $attrs = array_merge((array) $attrs, (array) $object);
                    }
                }

                $inline = (new Converter)->obj2htmlattr((array) $attrs);
                $value = "";

                if (isset($attrs['value'])) {
                    $value = $attrs['value'];

                    if (isset($attrs['text'])) {
                        $value = $attrs['text'];
                    }
                }

                $attr_inline = isset($attrs['inline']) ? $attrs['inline'] : '';

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
    public static function Render ($template="main", $params=Array(), $noPrint=false) {

        # If TWIG is not already
        if (!self::$ready) {
            self::init();
        }

        # Processing template name
        $template = (new Stringer($template))::format(self::$alias);

        $template = pathinfo($template);

        if (file_exists(COMPOUND_TWIG_DIR . '/' . $template['dirname'] . '/' . $template['basename'] . '.twig')) {

            $params = array_merge(
                array (
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

            if ($noPrint) {
                return self::$twig->render($template['dirname'] . '/' . $template['basename'] . '.twig', $params);
            } else {
                print self::$twig->render($template['dirname'] . '/' . $template['basename'] . '.twig', $params);
            }

        } else {
            return false;
        }

    }

}