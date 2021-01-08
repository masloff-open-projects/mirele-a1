<?php

namespace Mirele;

use Mirele\Compound\Component;
use Mirele\Compound\Engine\Application;
use Mirele\Compound\Field;
use Mirele\Compound\Market;
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
//        "Compound/Engine/Applications/Public/Module/Woocommerce/Login/login.html.twig" => 'Woocommerce/authorization/login',
//        "@signup" => 'Woocommerce/authorization/signup',
//        "@passwordRecovery" => 'Woocommerce/authorization/password_recovery',
//        "application@footer" => 'Compound/Engine/Applications/Public/footer.html.twig',
//        "application@header" => 'Compound/Engine/Applications/Public/header.html.twig',
//        "application@layout" => 'Compound/Engine/Applications/Public/layout.html.twig',
    ];

    /**
     *
     */
    public static function init () {



    }


    /**
     * @param string $template
     * @param array $params
     * @param false $noPrint
     * @return false
     */
    public static function Render ($template="main", $params=Array(), $renderIntoVariable=false) {
//
//        # If TWIG is not already
//        /**
//         * @depreacted
//         */
//        if (!self::$ready) {
//            self::init();
//        }
//
//        /**
//         * @depreacted
//         */
//        # Processing template name
//        $template =  ((new Stringer($template))::format(self::$alias));
//
//        $ext = pathinfo($template, PATHINFO_EXTENSION);
//        $path = $template . (empty($ext) ? '.twig' : '');
//
//        $params = array_merge(
//            array (
//                'ww2as' => get_option('mrl_wp_sidebar_width_2_active', 2),
//                'ww1as' => get_option('mrl_wp_sidebar_width_1_active', 4),
//                'hsmp' => get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? true : false,
//                'source' => MIRELE_SOURCE_DIR,
//                'url_without_params' => MIRELE_URL,
//                'GET' => MIRELE_GET,
//                'page_id' => isset($_GET['page']) ? $_GET['page'] : false,
//                'url' => [
//                    'registration' => wp_registration_url(),
//                    'login' => wp_login_url(),
//                    'logout' => wp_logout_url(),
//                    'lost_password' => wp_lostpassword_url(),
//                    'checkout' => WOOCOMMERCE_SUPPORT ? esc_url(wc_get_checkout_url()) : '',
//                    'profile' => [
//                        'edit' => get_edit_profile_url(),
//                    ],
//                    'customer' => [
//                        'edit' => WOOCOMMERCE_SUPPORT ? wc_customer_edit_account_url() : '',
//                    ],
//                    'service' => MIRELE_URLS
//                ]
//            ),
//            (array) $params
//        );
//
//        if ($renderIntoVariable) {
//            return self::$twig->render($path, $params);
//        } else {
//            print self::$twig->render($path, $params);
//        }
//

    }

}