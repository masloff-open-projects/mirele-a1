<?php


namespace Mirele\Compound;


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
     * @var Layout
     */
    private $Layout = [];

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

        $this->signature = new Layout();

        if ($data instanceof Layout) {
            $this->signature = clone $data;
        }

        if (is_string($data)) {
            $this->fragment = (string) $data;
        }
    }

    /**
     * @param string $data
     * @return string
     */
    private function __protection (string $data) {

        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        return $data;

    }

    /**
     * @param string $data
     * @return array|false|mixed
     */
    private function __xml_to_object (string $data) {

        if (function_exists('xml_parser_create')) {

            $parser = xml_parser_create();

            xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
            xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
            xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, 'UTF-8');
            xml_parse_into_struct($parser, $data, $values);
            xml_parser_free($parser);

            $class = array();
            $last = array();
            $Next = &$class;

            foreach($values as $XKey => $XValue)
            {
                $index = count($Next);
                if($XValue["type"] == "complete")
                {

                    $Next[$index] = new Directive;
                    $Next[$index]->setTag((string) $XValue["tag"]);
                    $Next[$index]->setAttributes((object) $XValue["attributes"]);
                    $Next[$index]->setContent($XValue["value"]);

                }
                elseif($XValue["type"] == "open")
                {

                    $Next[$index] = new Directive;
                    $Next[$index]->setTag((string) $XValue["tag"]);
                    $Next[$index]->setAttributes((object) $XValue["attributes"]);
                    $Next[$index]->setContent($XValue["value"]);
                    $Next[$index]->setNext([]);

                    $last[count($last)] = &$Next;
                    $Next = &$Next[$index]->next;

                }
                elseif($XValue["type"] == "close")
                {

                    $Next = &$last[count($last) - 1];
                    unset($last[count($last) - 1]);

                }

            }

            return $class;

        }

        return false;

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
     * @return Layout
     */
    public function parse () {

        $Layout = new Layout();

        # We get the code from the shortscode
        preg_match_all('#\[Compound(.*)\](\s|)(.+?)\[/Compound\]#is', $this->fragment, $fragment);

        # We create code units
        # At the first stage, the token
        # is not ready for processing as an object,
        # it is just a line ready for parsing and lexical analysis.
        $source = (string) str_replace(
            ['“', '”'],
            ['"', '"'],
            $this->__protection(
                stripslashes(
                    stripcslashes(
                        strip_tags(
                            html_entity_decode(isset($fragment[3][0]) ? $fragment[3][0] : $this->fragment),
                            '<root><template><field><component><props>'
                        )
                    )
                )
            )
        );

        # We perform the primary lexical parsing of code on an attached object
        $lexicon = (array) $this->__xml_to_object($source);

        if (isset($lexicon[0])) {

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
                            $name = $iterator->getAttribute('name');
                            $props = $iterator->getAttributes();
                            $next = (object) $iterator->getNext();

                            $Layout->markupTemplate($id, $name);

                            $Layout->setLayoutProps((string) $id, (array) $props);

                            if (is_array($next) or is_object($next)) {

                                foreach ($next as $nesting) {

                                    if ($nesting instanceof Directive) {

                                        $tag = (string) $nesting->getTag();
                                        $next_ = (array) $nesting->getNext();

                                        if (isset($next_) and !empty($next_)) {

                                            # The system has a tag alias structure, call the handler
                                            if (Constructor::get($tag)) {

                                                $package = Constructor::call($tag, $next_);
                                                $field_name = $nesting->getAttribute('name');

                                                if ($field_name and $package) {
                                                    $Layout->setLayoutField($id, $field_name, $package);
                                                }

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }
                }

            }

            $this->signature = $Layout;

            return $Layout;

        }

        return false;

    }

    /**
     * @return Layout
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
        $Layout = $this->getSignature();

        if ($Layout instanceof Layout) {

            $this->source_code = "";

            $this->__xml_add_open_tag('root', (object) array());

            $Layout = $Layout->getLayout();
            
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