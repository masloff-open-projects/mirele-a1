<?php


namespace Mirele\Compound;


use Mirele\Framework\Stringer;
use Mirele\Compound\Children;
use voku\helper\AntiXSS;


class Lexer
{
    private $fragment = "";
    private $directives = [];
    private $entities = [];
    private $signature = [];

    function __construct(string $fragment) {
        $this->fragment = (string) $fragment;
    }

    public function parse () {

        $Signature = new Signature();
        $xss = new AntiXSS();

        # We get the code from the shortscode
        preg_match_all('#\[Compound(.*)\](\s|)(.+?)\[/Compound\]#is', $this->fragment, $fragment);

        # We create code units
        # At the first stage, the token
        # is not ready for processing as an object,
        # it is just a line ready for parsing and lexical analysis.
        $pre_lexicon = (string) str_replace(['“', '”'], ['"', '"'], $xss->xss_clean(stripslashes(stripcslashes(strip_tags(html_entity_decode(isset($fragment[3][0]) ? $fragment[3][0] : $this->fragment), '<root><template><field><component><props>')))));


        # We perform the primary lexical parsing of code on an attached object
        $lexicon = (array) Children\XTO($pre_lexicon);


        if ($lexicon[0]->getTag() == 'root') {
            $root = (array) $lexicon[0]->getNext();
        } else {
            $root = (array) $lexicon;
        }

        # If a root derivative is installed, we iterate it.
        if ($root) {

            # Iteration
            foreach ($root as $index => $iterator) {
                if ($iterator instanceof Directive) {

                    # Top Level Directive - Template
                    if ($iterator->getTag() === 'template') {

                        $next = $iterator->getNext();
                        $name = $iterator->getAttribute('name');
                        $instance = $iterator->getAttribute('instance') ? $iterator->getAttribute('instance') : $index;

                        $Signature->addTemplate($name, [], $instance);

                        if (is_array($next) or is_object($next)) {

                            $next = (object) $next;

                            foreach ($next as $nesting) {

                                if ($nesting instanceof Directive) {

                                    # The system has a tag alias structure, call the handler
                                    if (Constructor::get($nesting->getTag())) {

                                        $package = Constructor::call((string) $nesting->getTag(), (array) $nesting->getNext());
                                        $field_name = $nesting->getAttribute('name') ? $nesting->getAttribute('name') : 'default';

                                        if ($field_name) {

                                            $Signature->addTemplateField($name, $field_name, $package, $instance);
//
//                                            # Add a directive to local memory
//                                            array_push($this->entities, $Signature);

                                        }

                                    }

                                }

                            }

                        }

                    }

                }
            }

        }

        return $Signature;

    }

    /**
     * @return array
     */
    public function getDirectives()
    {
        return $this->directives;
    }

}