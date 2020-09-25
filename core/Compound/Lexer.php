<?php


namespace Mirele\Compound;


use Mirele\Framework\Buffer;
use Mirele\Framework\Stringer;
use Mirele\Compound\Lex;
use Mirele\Compound\Children;
use voku\helper\AntiXSS;


class Lexer
{
    private $fragment = "";
    private $directives = [];
    private $entities = [];
    private $signature = [];

    /**
     * Lexer constructor.
     * @param string $data
     */
    function __construct($data) {

        $this->signature = new Signature();

        if ($data instanceof Signature) {
            $this->signature = clone $data;
        }

        if (is_string($data)) {
            $this->fragment = (string) $data;
        }
    }

    /**
     * @return Signature
     */
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
                        $props = $iterator->getAttributes();

                        $Signature->addTemplate($name, [], $instance);

                        $Signature->setTemplateProps($name, (object) $props, $instance);

                        if (is_array($next) or is_object($next)) {

                            $next = (object) $next;

                            foreach ($next as $nesting) {

                                if ($nesting instanceof Directive) {

                                    # The system has a tag alias structure, call the handler
                                    if (Constructor::get($nesting->getTag())) {

                                        $package = Constructor::call((string) $nesting->getTag(), (array) $nesting->getNext());
                                        $field_name = $nesting->getAttribute('name') ? $nesting->getAttribute('name') : 'default';

                                        if ($field_name and $package) {
                                            $Signature->addTemplateField($name, $field_name, $package, $instance);
                                        }

                                    }

                                }

                            }

                        }

                    }

                }
            }

        }

        $this->signature = $Signature;

        return $Signature;

    }

    /**
     * @return Signature
     */
    public function getSignature()
    {
        return $this->signature;
    }

    public function addDirective(string $name, Directive $directive)
    {
        $this->directives[$name] = $directive;
        return $this;
    }

    public function generateCode () {

        // TODO IT;

        $Buffer = new Buffer();

        # Get signature
        $signature = $this->getSignature();

        if ($signature instanceof Signature) {

            $Buffer->append('<root>');

            $templates = $signature->getTemplates();

            if ($templates) {

                foreach ($templates as $name => $template) {

                    foreach ($template as $id => $instance) {

                        $Buffer->append("<template name=\"$name\" instance=\"$id\">");

                        if (isset($instance['field'])) {


                            foreach ($instance['field'] as $field => $tags) {

                                $Buffer->append("<field name=\"$field\">");

                                foreach ($tags as $tag) {
                                    if ($tag instanceof Tag) {
                                        $tagName = $tag->getTag();
                                        $Buffer->append("<$tagName/>");
                                    }
                                }
                                
                                $Buffer->append('</field>');

                            }

                        }

                        $Buffer->append('</template>');

                    }

                }

            }

            $Buffer->append('</root>');

        }

        return $Buffer->toString('*', "\n");

    }

    /**
     * @return array
     */
    public function getDirectives()
    {
        return $this->directives;
    }

}