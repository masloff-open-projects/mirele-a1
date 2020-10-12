<?php


namespace Mirele\Framework\Prototypes;

use Mirele\Compound\Lexer;
use Mirele\Framework\Traits;


/**
 * Class Pattern
 * @package Mirele\Framework\Prototypes
 */
class Pattern
{

    /**
     * @var Lexer|null
     */
    protected $lexer = null;

    use Traits\__getter;
    use Traits\__setter;
    use Traits\__isset;
    use Traits\__unset;

    /**
     *
     */
    const ERROR_PAGE_NOT_FOUND = 1001;
    /**
     *
     */
    const ERROR_INSUFFICIENT_PARAMETERS = 1002;
    /**
     *
     */
    const ERROR_PAGE_IS_DAMAGED = 1003;

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct($data=array()) {

        $this->lexer = $Lexer = new Lexer('');

        if (!empty($data) and is_array($data)) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

    }


    /**
     * @param int $page
     * @return false|int|\Mirele\Compound\Layout|object
     */
    protected function __get_lex (int $page)
    {

        $wp_page = $this->__get_page($page);

        if (is_object($wp_page)) {

            if (isset($wp_page->post_content)) {

                $this->lexer->loadCodeFromString($wp_page->post_content);
                $lex = $this->lexer->parse();

                if ($lex) {
                    return $lex;
                } else {
                    return false;
                }

            } else {

                return self::ERROR_PAGE_IS_DAMAGED;

            }

        } else {

            return $wp_page;

        }

    }

    /**
     * @param int $id
     * @return int|object
     */
    protected function __get_page (int $id)
    {
        $buffer = get_post($id);

        if ($buffer !== null) {
            return (object) get_post($id);
        } else {
            return self::ERROR_PAGE_NOT_FOUND;
        }
    }

    protected function __update_page (int $id, array $props)
    {

        return wp_update_post(array_merge($props, [
            'ID' => $id
        ]));

    }

    protected function __update_page_meta (int $id, string $name, $value)
    {
        return update_post_meta(
            $id,
            $name,
            $value
        );
    }

    protected function __UDAPTE_META (int $id, array $props)
    {

        $props = array_merge(
            [
                '_wp_page_template' => COMPOUND_CANVAS
            ],
            (array) $props
        );

        foreach ($props as $key => $value) {
            $this->__update_page_meta($id, (string) $key, (string) $value);
        }

        return true;

    }

    protected function __UPDATE (int $id, array $props, $meta=[])
    {

        $code = $this->lexer->generateCode();

        if ($code) {

            if ($this->__update_page($id, array_merge(
                (array) $props,
                [
                    "post_content" => "[Compound role='editor'] \n $code \n [/Compound]"
                ]
            ))) {

                return $this->__UDAPTE_META($this->page, (array) $meta);

            } else {
                return false;
            }

        } else {
            return false;
        }

    }

}