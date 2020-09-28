<?php


namespace Mirele\Compound;


use Mirele\Framework\Buffer;
use Mirele\Framework\Stringer;
use Mirele\Compound\Lex;
use Mirele\Compound\Children;
use voku\helper\AntiXSS;


/**
 * Class Lexer
 * @package Mirele\Compound
 */
class Lexer
{
    /**
     * @var string
     */
    private $fragment = "";
    /**
     * @var array
     */
    private $directives = [];
    /**
     * @var array
     */
    private $entities = [];
    /**
     * @var Signature
     */
    private $signature = [];

    /**
     * @var string[]
     */
    private $glossary = [
        // "indent" => "\t",
        "indent" => "   ",
        "space" => " ",
        "delimiter" => "\n"
    ];
    /**
     * @var int
     */
    private $indent = 1;
    /**
     * @var string
     */
    private $source_code = "";
    /**
     * @var int
     */
    private $level = 0;

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
     * @param $attr
     * @return string
     */
    private function __xml_array2attr ($attr) {
        return implode(' ', array_map(
            function ($k, $v) { return $k .'="'. htmlspecialchars($v) .'"'; },
            array_keys($attr), $attr
        ));
    }

    /**
     * @param string $tag
     * @param object $attrs
     */
    private function __xml_add_open_tag (string $tag, object $attrs) {
        $indent = str_repeat($this->glossary['indent'], ((int) $this->level) * $this->indent);
        $delimiter = $this->glossary['delimiter'];
        $attrs_inline = $this->__xml_array2attr((array) $attrs);
        $this->source_code .= "$indent<$tag $attrs_inline>$delimiter";
        $this->level = ((int) $this->level) + 1;
    }

    /**
     * @param string $tag
     * @param object $attrs
     */
    private function __xml_add_close_tag (string $tag, object $attrs) {
        $this->level = ((int) $this->level) - 1;
        $indent = str_repeat($this->glossary['indent'], ((int) $this->level) * $this->indent);
        $delimiter = $this->glossary['delimiter'];
        $attrs_inline = $this->__xml_array2attr((array) $attrs);
        $this->source_code .= "$indent</$tag $attrs_inline>$delimiter";
    }

    /**
     * @param string $tag
     * @param object $attrs
     */
    private function __xml_add_single_tag (string $tag, object $attrs) {
        $indent = str_repeat($this->glossary['indent'], ((int) $this->level) * $this->indent);
        $delimiter = $this->glossary['delimiter'];
        $attrs_inline = $this->__xml_array2attr((array) $attrs);
        $this->source_code .= "$indent<$tag $attrs_inline/>$delimiter";
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

                        # Generate
                        $id = $iterator->getAttribute('id') ? $iterator->getAttribute('id') : (string) md5(rand(0, PHP_INT_MAX));
                        $next = $iterator->getNext();
                        $name = $iterator->getAttribute('name');
                        $instance = $iterator->getAttribute('instance') ? $iterator->getAttribute('instance') : md5(rand(0, PHP_INT_MAX));
                        $props = $iterator->getAttributes();

                        $Signature->markupTemplate($id, $name);

                        $Signature->setLayoutProps((string) $id, (array) $props);

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
                                            $Signature->setLayoutField($id, $field_name, $package);
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

    /**
     * @param string $name
     * @param Directive $directive
     * @return $this
     */
    public function addDirective(string $name, Directive $directive)
    {
        $this->directives[$name] = $directive;
        return $this;
    }

    /**
     * @return string
     */
    public function generateCode ($minify=false) {

        // TODO IT;

        # Get signature
        $signature = $this->getSignature();

        if ($signature instanceof Signature) {

            $this->source_code = "";

            $this->__xml_add_open_tag('root', (object) array());

            $Layout = $signature->getLayout();
            
            if (is_array($Layout) or is_object($Layout)) {
                foreach ($Layout as $index => $template) {
                    /**
                     * @deprecated
                     */
                    $this->__xml_add_open_tag('template', (object) $template->props);

                        /// Props
                        $this->__xml_add_open_tag((string) 'props', (object) []);

                        foreach ($template->props as $key => $value) {
                            $this->__xml_add_single_tag('prop', (object) array(
                                'name' => (string) $key,
                                'value' => (string) $value,
                            ));
                        }

                        $this->__xml_add_close_tag((string) 'props', (object) array());

                        /// Fields
                        foreach ($template->fields as $name => $components) {

                            $this->__xml_add_open_tag((string) 'field', (object) [
                                'name' => (string) $name
                            ]);

                            foreach ($components as $index => $tag) {

                                if ($tag instanceof Tag) {

                                    if (isset($tag->getAttributes()['name'])) {
                                        $this->__xml_add_single_tag($tag->getTagName(), (object) array_merge(
                                            (array) $tag->getAttributes(),
                                            (array) array(
                                                'name' => $tag->getAttributes()['name']
                                            ))
                                        );
                                    }

                                }

                            }

                            $this->__xml_add_close_tag((string) 'field', (object) array());

                        }

                    $this->__xml_add_close_tag('template', (object) array());
                }
            }

            $this->__xml_add_close_tag('root', (object) array());

            return $this->source_code;

        }

    }

    /**
     * @return array
     */
    public function getDirectives()
    {
        return $this->directives;
    }

}