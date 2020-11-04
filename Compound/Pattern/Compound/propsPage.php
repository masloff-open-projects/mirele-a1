<?php


namespace Mirele\Compound\Patterns;

use Mirele\Framework\Prototypes\Pattern;

class propsPage extends Pattern
{

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {

        if (isset($this->page)) {
            return get_post_meta($this->page);
        }

        return false;

    }

}