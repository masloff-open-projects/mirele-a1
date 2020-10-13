<?php


namespace Mirele\Compound\Patterns;


use Mirele\Compound\Tag;
use Mirele\Framework\Prototypes\Pattern;


class updateProps extends Pattern
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

            $lex = $this->__get_lex((int)$this->page);

            if ($lex) {

                if (isset($this->type) and $this->type === 'update') {

                    $root = (object)$lex->getRootInstanceById($this->template);

                    if (isset($root->fields) and is_array($root->fields)) {
                        if (isset($root->fields[$this->field])) {
                            foreach ($root->fields[$this->field] as $tag) {
                                if ($tag instanceof Tag) {
                                    foreach ($this->props as $prop => $value) {
                                        $tag->setAttribute($prop, $value);
                                    }
                                }
                            }
                        }
                    }


                } elseif (isset($this->type) and $this->type === 'remove') {
                    $lex->removeField((string)$this->template, (string)$this->field);
                }

                return $this->__UPDATE($this->page, []);

            }

        } else {
            return false;
        }
    }

}