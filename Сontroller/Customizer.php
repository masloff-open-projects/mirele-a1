<?php


namespace Mirele\Framework;


/**
 * Class Customizer
 * @package Mirele\Framework
 */
class Customizer extends Iterator
{

    /**
     * @var string
     */
    private static $globalNamespace = "*";
    /**
     * @var string
     */
    private static $lastNamespace = "*";
    /**
     * @var array
     */
    private static $options = [];
    /**
     * @var string[]
     */
    private static $alias = [
        '@basic' => 'Basic',
        '@wc-login' => 'Page > Authorization login',
        '@wc-recovery' => 'Page > Authorization recovery password',
        '@wc-signup' => 'Page > Authorization signup',
        '@wc-card' => 'Woocommerce > Card',
        '@wc-cart' => 'Woocommerce > Cart',
        '@wc-shop' => 'Woocommerce > Shop',
    ];


    /**
     * @return array
     */
    static private function alias () {
        return [
            '{WEBSITE_NAME}' => get_bloginfo ('name', 'display')
        ];
    }

    /**
     * @param $namespace
     * @return string|string|string[]
     */
    static private function _namespace ($namespace) {
        return (new Stringer($namespace))::format([
            '{LAST}' => self::$lastNamespace,
            '{GLOBAL}' => self::$globalNamespace
        ]);
    }

    /**
     * @param Option $Option
     * @throws \Exception
     */
    static public function add (Option $Option) {

        if ($Option instanceof Option) {

            $namespace = self::_namespace($Option->getNamespace());
            $namespace = (new Stringer((string) $namespace))::format(self::$alias);

            if (!isset(self::$options[$namespace][$Option->getName()])) {
                self::$options[$namespace][$Option->getName()] = $Option;

                register_setting ('Mirele', $Option->getName(), [
                    'description' => $Option->getDescription(),
                    'default' => $Option->getDefault()
                ]);

            } else {
                throw new \Exception((new Stringer("The options with identifier {NAME} already exists"))::format([
                    '{NAME}' => $Option->getName()
                ]));
            }

        } else {
            throw new \TypeError('The passed class does not match the class of the option');
        }

    }

    /**
     * @param string $namespace
     * @param string $name
     * @param array $props
     * @return false|object
     */
    static public function call (string $namespace, string $name, array $props) {

        $namespace = self::_namespace($namespace);
        $namespace = (new Stringer($namespace))::format(self::$alias);

        if (isset(self::$options[$namespace][$name])) {
            return (object) array_merge(
                (array) self::$options[$namespace][$name]->build(),
                (array) $props
            );
        } else {
            return false;
        }

    }

    /**
     * @param string $namespace
     * @param string $name
     * @param array $props
     * @return false|string|string|string[]
     */
    static public function get (string $namespace, string $name, array $props) {

        $namespace = self::_namespace($namespace);
        $namespace = (new Stringer($namespace))::format(self::$alias);

        if (isset(self::$options[$namespace][$name])) {

            $instance = (object) array_merge(
                (array) self::$options[$namespace][$name]->build(),
                (array) $props
            );
            $value = $instance->value;
            $default = $instance->default;

            return (new Stringer((new Stringer($value))::get("") ? $value : $default))::format(self::alias());

        } else {
            return false;
        }

    }

    /**
     * @param string $namespace
     * @return false|object
     */
    static public function all ($namespace='{GLOBAL}') {

        $namespace = self::_namespace($namespace);
        $namespace = (new Stringer($namespace))::format(self::$alias);

        if (isset(self::$options[$namespace])) {
            return (object) self::$options[$namespace];
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    static public function namespaces () {
        return array_keys(self::$options);
    }

}