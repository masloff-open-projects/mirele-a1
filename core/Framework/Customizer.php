<?php


namespace Mirele\Framework;


class Customizer extends Iterator
{

    private static $globalNamespace = "*";
    private static $lastNamespace = "*";
    private static $options = [];

    static private function _namespace ($namespace) {
        return (new Stringer($namespace))::format([
            '{LAST}' => self::$lastNamespace,
            '{GLOBAL}' => self::$globalNamespace
        ]);
    }

    static public function add (Option $Option) {

        if ($Option instanceof Option) {

            $namespace = self::_namespace($Option->getNamespace());

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

    static public function call (string $namespace, string $name, array $props) {

        $namespace = self::_namespace($namespace);

        if (isset(self::$options[$namespace][$name])) {
            return (object) self::$options[$namespace][$name]->build();
        } else {
            return false;
        }

    }

    static public function all ($namespace='{GLOBAL}') {

        $namespace = self::_namespace($namespace);

        if (isset(self::$options[$namespace])) {
            return (object) self::$options[$namespace];
        } else {
            return false;
        }
    }

    static public function namespaces () {
        return array_keys(self::$options);
    }

}