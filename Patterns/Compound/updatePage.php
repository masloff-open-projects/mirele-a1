<?php


namespace Mirele\Compound\Patterns;


use Mirele\Framework\Prototypes\Pattern;


class updatePage extends Pattern
{

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {
        if (isset($this->props) and is_array($this->props) and isset($this->page)) {
            return $this->__UDAPTE_META($this->page, $this->props);
        } else {
            return false;
        }
    }

}