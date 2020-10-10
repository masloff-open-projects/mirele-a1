<?php


namespace Mirele\Compound\Patterns;

use Mirele\Compound\Component;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Lexer;
use Mirele\Compound\Tag;
use Mirele\Compound\Template;
use Mirele\Framework\Prototypes\Pattern;


class propsTemplate extends Pattern
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

            if ($lex) {

                $template = $lex->getRootInstanceById($this->template);

                if (is_object($template) and !empty($template->props->name)) {

                    $Template = Grider::findById($template->props->name);

                    if ($Template instanceof Template) {
                        return array_merge(
                            (array) $Template->getProps(),
                            (array) $template->props
                        );
                    }

                }

            }

        }

        return false;

    }

}