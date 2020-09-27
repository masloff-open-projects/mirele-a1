<?php


namespace Mirele\Compound;


use Mirele\Framework\Iterator;
use Mirele\Compound\Component;


/**
 * Class Store
 * @package Mirele\Compound
 */
class Store extends Iterator
{

    /**
     * @var array
     */
    private static $store = [];

    /**
     * @param \Mirele\Compound\Component $Component
     * @throws \Exception
     */
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

    /**
     * @param string $id
     * @param array $props
     * @return false
     */
    static public function call (string $id, array $props) {
        if (isset(self::$store[$id])) {
            return self::$store[$id]->render($props ? (array) $props : []);
        }
        return false;
    }

    /**
     * @param string $id
     * @return false|mixed
     */
    static public function get (string $id) {
        if (isset(self::$store[$id])) {
            return self::$store[$id];
        }
        return false;
    }

    /**
     * @return array
     */
    public static function all()
    {
        return self::$store;
    }

}

