<?php


namespace Mirele\Compound;


use Mirele\Framework\Iterator;
use Mirele\Compound\Tag;
use Mirele\Framework\Stringer;


class TagsManager extends Iterator
{

    private static $store = [];

    /**
     * @param \Mirele\Compound\Tag $Tag
     * @throws \Exception
     */
    static public function add (Tag $Tag) {

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
    static public function call (string $id, array $props) {
        if (isset(self::$store[$id])) {
            return self::$store[$id];
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

