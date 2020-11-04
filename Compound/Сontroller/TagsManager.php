<?php


namespace Mirele\Compound;


use Mirele\Framework\Iterator;
use Mirele\Framework\Stringer;


/**
 * Class TagsManager
 * @package Mirele\Compound
 */
class TagsManager
{

    /**
     * @var array
     */
    private static $store = [];

    /**
     * @param \Mirele\Compound\Tag $Tag
     * @throws \Exception
     */
    public static function add (Tag $Tag) {

        if ($Tag instanceof Tag) {

            if (!isset(self::$store[$Tag->getTag()])) {
                self::$store[$Tag->getTag()] = $Tag;
            } else {
                throw new \Exception((new Stringer("The tag with identifier {ID} already exists"))::format([
                    '{ID}' => $Tag->getTag()
                ]));
            }

        } else {
            throw new \TypeError('The passed class does not match the class of the tag');
        }

    }

    /**
     * @param string $id
     * @param array $props
     * @return false
     */
    public static function call (string $id, array $props) {
        if (isset(self::$store[$id])) {
            return self::$store[$id];
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

