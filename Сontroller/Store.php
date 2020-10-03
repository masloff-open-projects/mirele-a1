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
    private static $alias = [];
    private static $families = [];

    /**
     * @param \Mirele\Compound\Component $Component
     * @throws \Exception
     */
    public static function add (Component $Component) {

        if ($Component instanceof Component) {

            if (!isset(self::$store[$Component->getId()])) {
                if ($Component->getAlias()) {
                    self::$alias[$Component->getAlias()] = $Component->getId();
                }

                $parent = $Component->getParent() ? $Component->getParent() : 'global';
                self::$families[$parent][] = $Component->getId();
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
     * @return array
     */
    public static function getFamilies($sort=false)
    {
        $sort = self::$families;
        if ($sort) {
            ksort($sort);
        }
        return $sort;
    }

    /**
     * @param string $id
     * @param array $props
     * @return false
     */
    public static function call (string $id, array $props) {

        $id = str_replace(array_keys(self::$alias), array_values(self::$alias), $id);

        if (isset(self::$store[$id])) {
            return self::$store[$id]->render($props ? (array) $props : []);
        }
        return false;
    }

    /**
     * @param string $id
     * @return false|mixed
     */
    public static function get (string $id) {

        $id = str_replace(array_keys(self::$alias), array_values(self::$alias), $id);

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

