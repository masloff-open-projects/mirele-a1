<?php


namespace Mirele\Framework;


class Store extends Iterator
{

    private static $store = [];

    static public function add (Component $Component) {

        if ($Component instanceof Component) {

            if (!isset(self::$store[$Component->getId()])) {
                self::$store[$Component->getId()] = $Component;
            } else {
                throw new \Exception((new Stringer("The component with identifier {ID} already exists"))::format([
                    '{ID}' => $Component->getId()
                ]));
            }

        } else {
            throw new \TypeError('The passed class does not match the class of the component');
        }

    }

    static public function call (string $id, array $props) {
        if (isset(self::$store[$id])) {
            return self::$store[$id]->render($props ? (array) $props : []);
        }
    }

}

