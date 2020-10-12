<?php


namespace Mirele\Compound\Patterns;


use Mirele\Compound\Component;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Layout;
use Mirele\Compound\Lexer;
use Mirele\Compound\Tag;
use Mirele\Compound\Template;
use Mirele\Framework\Prototypes\Pattern;


/**
 * Class insertTemplate
 *
 * @package Mirele\Compound\Patterns
 */
class insertTemplate extends Pattern
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

                $template = Grider::findById($this->template);

                if ($template instanceof Template) {

                    $this->lexer->getSignature()->markupTemplate(null, (string) $this->template);
                    $fields = $template->getFields();

                    if (is_array($fields) or is_object($fields)) {

                        foreach ($fields as $field => $object) {

                            if ($object instanceof Field) {

                                $component = $object->getComponent();
                                if ($component instanceof Component) {

                                    $tag = new Tag();
                                    $tag->setTag('component');
                                    $tag->setAttributes((array) $object->getComponentProps());

                                    $tag->setAttribute('name', $component->getAlias() ? $component->getAlias() : $component->getId());

                                    $this->lexer->getSignature()->setLayoutField((string) $id, $object->getName(), [clone $tag]);

                                }

                            }
                        }

                    } else {
                        return false;
                    }

                }

            } else {
                return false;
            }

            $this->__UPDATE($this->page, []);


        } else {
            return false;
        }

    }

}