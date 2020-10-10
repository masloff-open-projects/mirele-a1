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

            $lex = $this->__get_lex((int) $this->page);
            if (is_array($this->template) or is_object($this->template)) {
                foreach ($this->template as $id) {
                    $lex->removeTemplate($id);
                }
            } else {
                $lex->removeTemplate($this->template);
            }

            $code = $this->lexer->generateCode();

            if ($this->__update_page($this->page, [
                "post_content" => "[Compound role='editor'] \n $code \n [/Compound]"
            ])) {
                return $this->__update_page_meta($this->page, '_wp_page_template', COMPOUND_CANVAS);
            } else {
                return false;
            }


        } else {
            return false;
        }

    }

}