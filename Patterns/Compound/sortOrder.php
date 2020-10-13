<?php


namespace Mirele\Compound\Patterns;

use Mirele\Framework\Prototypes\Pattern;


/**
 * Class createPage
 *
 * @package Mirele\Compound\Patterns
 */
class sortOrder extends Pattern
{

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */

    public function __invoke()
    {
        if (isset($this->page) and isset($this->prototype)) {

            $lex = $this->__get_lex($this->page);
            $lex->prototypeIDsBasedSorting($this->prototype);
            return $this->__UPDATE($this->page, []);

        }

        return false;
    }


}