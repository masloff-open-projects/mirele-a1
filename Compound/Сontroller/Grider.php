<?php


namespace Mirele\Compound;


/**
 * Class Grider
 * @package Mirele\Compound
 */
final class Grider
{

    /**
     * @var array
     */
    private static $data = [];
    /**
     * @var array[]
     */
    private static $map = ['aliases' => [], 'families' => [], 'types' => [], 'ids' => [], 'folders' => []];

    /**
     * @param Template $Template
     * @throws \Exception
     */
    final public static function save (Template $Template)
    {
        if (!empty($Template->getId()) and (is_string($Template->getId()) or is_numeric($Template->getId()))) {
            if (!isset(self::$data[$Template->getId()]))
            {
                if (!empty($Template->getId()))
                {

                    # Set alias in map
                    if (!empty($Template->getAlias()) and $Template->getAlias() !== false)
                    {
                        if (!isset(self::$map['aliases'][$Template->getAlias()]))
                        {
                            if (mb_substr($Template->getAlias(), 0, 1, 'utf-8') === '@')
                            {
                                self::$map['aliases'][$Template->getAlias()] = $Template->getId();
                            } else {
                                throw new \Exception('Alias template must start with @ symbol.');
                            }
                        } else {
                            throw new \Exception("Alias ({$Template->getAlias()}) already exists and indicates a registered template ({$Template->getId()})");
                        }
                    }

                    # Ancestral registration
                    if (!empty($Template->getParent()) and $Template->getParent() !== false)
                    {
                        self::$map['families'][$Template->getParent()][] = $Template->getId();
                    }

                    # Type registration
                    if (!empty($Template->getType()))
                    {
                        self::$map['types'][$Template->getType()][] = $Template->getId();
                    }

                    # Type registration
                    if (!empty($Template->getId()))
                    {
                        self::$map['ids'][$Template->getId()][] = $Template->getId();
                    }

                    # Create folder
                    if (!empty($Template->getFolder()))
                    {
                        self::$map['folders'][$Template->getFolder()][] = $Template->getId();
                    }

                    self::$data[$Template->getId()] = $Template;

                } else {
                    throw new \Exception("The template will not contain the primary data (id) for its identification");
                }

            }
        }
    }

    /**
     * @param $id
     * @param array $props
     * @param bool $np
     * @return false
     */
    public static function call ($id, array $props, $np=true) {

        $alias = self::__idForAlias($id);

        if ($alias !== false)
        {
            $id = $alias;
        }

        if (isset(self::$data[$id]) and self::$data[$id] instanceof Template)
        {
            if (method_exists(self::$data[$id], 'render'))
            {
                return self::$data[$id]->render($props ? (array) $props : [], $np);
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    /**
     * @param $id
     * @return false|Template
     */
    public static function findById ($id)
    {

        $alias = self::__idForAlias($id);
        $namespace = array_flip(array_keys(self::$map['ids']));

        if ($alias !== false)
        {
            $id = $alias;
        }

        if (isset($namespace[$id]) and self::$data[$id] instanceof Template)
        {
            return clone self::$data[$id];
        } else {
            return false;
        }

    }

    public static function getTypes ()
    {
        return self::$map['types'];
    }

    public static function getFamilies ()
    {
        return self::$map['families'];
    }

    public static function getFolders ()
    {
        return self::$map['folders'];
    }

        /**
     * @param bool $sort
     * @return array
     */
    public static function all($sort=true)
    {
        if ($sort === true or $sort === 'native') {
            $buffer = self::$data;
            ksort($buffer);
            return $buffer;
        } else {
            return self::$data;
        }
    }

    /**
     *
     */
    public static function delete () {

    }

    /**
     * @param $id
     * @return false|mixed
     */
    private static function __idForAlias($id)
    {
        $__aliases = array_flip(array_keys(self::$map['aliases']));

        if (isset($__aliases[$id]))
        {
            return self::$map['aliases'][$id];
        } else {
            if (isset($__aliases["@{$id}"]))
            {
                return self::$map['aliases']["@{$id}"];
            } else {
                return false;
            }
        }
    }

}