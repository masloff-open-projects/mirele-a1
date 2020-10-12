<?php


namespace Mirele\Compound\Patterns;


use Mirele\Framework\Prototypes\Pattern;


class updateTemplateProps extends Pattern
{

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {
        if (isset($this->template) and isset($this->page) and isset($this->props)) {

            $lex = $this->__get_lex((int) $this->page);

            if ($lex) {

                if ($lex->updateLayoutProps($this->template, (array) $this->props))
                {
                    $this->__UPDATE($this->page, []);
                } else {
                    return false;
                }

            } else {
                return false;
            }

        } else {
            return false;
        }
    }

}
