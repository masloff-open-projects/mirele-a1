<?php


namespace Mirele\Compound\Patterns;


use Mirele\Framework\Prototypes\Pattern;


class removeTemplate extends Pattern
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {

        if (isset($this->template) and isset($this->page)) {

            $lex = $this->__get_lex((int)$this->page);
            if (is_array($this->template) or is_object($this->template)) {
                foreach ($this->template as $id) {
                    if (is_string($id) or is_int($id)) {
                        $lex->removeTemplate($id);
                    }
                }
            } else {
                $lex->removeTemplate($this->template);
            }

            return $this->__UPDATE($this->page, []);

        } else {
            return false;
        }

    }

}