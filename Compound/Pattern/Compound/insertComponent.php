<?php


namespace Mirele\Compound\Patterns;


use Mirele\Compound\Component;
use Mirele\Compound\Market;
use Mirele\Compound\Tag;
use Mirele\Framework\Prototypes\Pattern;


class insertComponent extends Pattern
{

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {

        if (isset($this->page) and isset($this->component) and isset($this->field) and isset($this->template)) {

            $this->__get_lex($this->page);
            $root = $this->lexer->getSignature()->getRootInstanceById($this->template);


            if (is_object($root)) {

                $component = Market::get($this->component);

                if ($component instanceof Component) {

                    # Generate tag
                    $tag = new Tag();
                    $tag->setTag('component');
                    $tag->setAttributes((array)$component->getProps());
                    $tag->setAttribute('name', $component->getAlias() ? $component->getAlias() : $component->getId());

                    $root->fields[$this->field] = array($tag);

                    $this->lexer->getSignature()->setRootInstanceById($this->template, $root);

                    return $this->__UPDATE($this->page, []);

                } else {

                    return false;

                }

            } else {
                return false;
            }

        } else {

            return self::ERROR_INSUFFICIENT_PARAMETERS;

        }

    }

}