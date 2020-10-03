<?php


namespace Mirele\Compound;


use Mirele\Framework\Iterator;
use Mirele\Compound\Construction;
use Mirele\Framework\Stringer;


/**
 * Class Constructor
 * @package Mirele\Compound
 */
class Constructor extends Iterator
{

    /**
     * @var array
     */
    private static $store = [];

    /**
     * @param \Mirele\Compound\Tag $Tag
     * @throws \Exception
     */
    public static function add (Construction $Construction) {

        if ($Construction instanceof Construction) {

            if (!isset(self::$store[$Construction->getName()])) {
                self::$store[$Construction->getName()] = $Construction;
            } else {
                throw new \Exception((new Stringer("The construction with identifier {ID} already exists"))::format([
                    '{ID}' => $Construction->getName()
                ]));
            }

        } else {
            throw new \TypeError('The passed class does not match the class of the Construction');
        }

    }

    /**
     * @param string $id
     * @param array $props
     * @return false
     */
    public static function call ($id, array $props) {
        if (isset(self::$store[$id])) {
            return self::$store[$id]->call($props);
        }
        return false;
    }

    /**
     * @param string $id
     * @return false|mixed
     */
    public static function get (string $id) {
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

