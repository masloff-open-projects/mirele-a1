<?php


namespace Mirele\Compound;


use Mirele\Framework\Iterator;


/**
 * Class Grider
 * @package Mirele\Compound
 */
class Grider extends Iterator
{

    /**
     * @var array
     */
    private static $store = [];
    private static $alias = [];

    /**
     * @param Template $Template
     * @throws \Exception
     */
    static public function add (Template $Template) {

        if ($Template instanceof Template) {

            if (!isset(self::$store[$Template->getId()])) {

                if ($Template->getAlias()) {
                    self::$alias[$Template->getAlias()] = $Template->getId();
                }

                self::$store[$Template->getId()] = $Template;
            } else {
                throw new \Exception((new Stringer("The component with identifier {ID} already exists"))::format([
                    '{ID}' => $Template->getId()
                ]));
            }

        } else {
            throw new \TypeError('The passed class does not match the class of the component');
        }

    }

    /**
     * @param string $id
     * @param array $props
     * @param bool $np
     * @return false
     */
    static public function call (string $id, array $props, $np=true) {

        $id = str_replace(array_keys(self::$alias), array_values(self::$alias), $id);

        if (isset(self::$store[$id])) {
            return self::$store[$id]->render($props ? (array) $props : [], $np);
        }
        return false;
    }

    /**
     * @param string $id
     * @return false|mixed
     */
    static public function get (string $id) {

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