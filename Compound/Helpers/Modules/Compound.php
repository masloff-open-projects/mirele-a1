<?php


namespace Mirele\Compound\Helpers;


/**
 * Class Compound
 * @package Mirele\Compound\Helpers
 */
class Compound
{


    /**
     * The standard component package for editor
     */
    const ECOMPONENT = [
        'title' => 'Undefined',
        'description' => 'Undefined',
        'icon' => false,
    ];

    /**
     * @param int $id
     * @param string $name
     * @param $value
     * @return bool|int
     */
    static public function updatePageMeta (int $id, string $name, $value)
    {
        return update_post_meta(
            $id,
            $name,
            $value
        );
    }

    /**
     * @param int $id
     * @param array $props
     * @return bool
     */
    static public  function updateMeta (int $id, array $props)
    {

        $props = array_merge(
            [
                '_wp_page_template' => COMPOUND_CANVAS
            ],
            (array) $props
        );

        foreach ($props as $key => $value) {
            self::updatePageMeta($id, (string) $key, (string) $value);
        }

        return true;

    }

    /**
     * @param int $id
     * @param array $props
     * @return int|\WP_Error
     */
    static public function updatePage (int $id, array $props)
    {

        return wp_update_post(array_merge($props, [
            'ID' => $id
        ]));

    }

    /**
     * @param int $id
     * @param string $content
     * @return bool
     */
    static public function updatePageContent (int $id, string $content)
    {

        if (self::updatePage($id, array_merge(
            (array) $props,
            [
                "post_content" => $content
            ]
        ))) {
            return self::updateMeta($id, []);
        } else {
            return false;
        }

    }


}