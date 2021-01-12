<?php


namespace Mirele\Compound;


class Document extends Protector
{

    protected $document;

    private function __uid ()
    {
        return sprintf( '%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    private function __processing ($data)
    {

        if (function_exists('xml_parser_create')) {

            $data = "<root>$data</root>";

            $document = xml_parser_create();

            xml_parser_set_option($document, XML_OPTION_CASE_FOLDING, 0);
            xml_parser_set_option($document, XML_OPTION_SKIP_WHITE, 1);
            xml_parser_set_option($document, XML_OPTION_TARGET_ENCODING, 'UTF-8');
            xml_parse_into_struct($document, $data, $values);
            xml_parser_free($document);

            $area = false;
            $container = false;
            $index = 0;

            foreach($values as $XKey => $XValue)
            {

                if($XValue["type"] == "complete")
                {

                    if ($area and $container) {

                        $component = $XValue['tag'];
                        $value = $XValue['value'];
                        $attributes = isset($XValue['attributes']) ? $XValue['attributes'] : [];
                        $uuid = isset($attributes['id']) ? $attributes['id'] : $this->__uid();

                        $this->document[$index][$container][$area][$uuid] = array(
                            'component' => $component,
                            'value' => $value,
                            'attributes' => $attributes,
                        );

                    }

                }
                elseif($XValue["type"] == "open")
                {

                    switch ($XValue["tag"]) {
                        case 'root':
                            break;

                        case 'area':
                            if ($area == false) {
                                if ($container) {
                                    if (isset($XValue['attributes']['id'])) {
                                        $area = $XValue['attributes']['id'];
                                        $this->document[$index][$container][$area] = array();
                                    } else {
                                        throw new \Exception('No `id` attribute is set for the area');
                                    }
                                } else {
                                    throw new \Exception('The area tag cannot be opened outside the container tag');
                                }
                            } else {
                                throw new \Exception('Within a tag area, no other area can be created');
                            }
                            break;

                        case 'container':
                            $index++;
                            if ($container == false) {
                                if (isset($XValue['attributes']['template'])) {
                                    $container = $XValue['attributes']['template'];
                                    $this->document[$index][$container] = array();
                                } else {
                                    throw new \Exception('No `template` attribute is set for the container');
                                }
                            } else {
                                throw new \Exception('Within a tag container, no other container can be created');
                            }
                            break;

                        default:
                            throw new \Exception('The tag does not exist');
                    }

                }
                elseif($XValue["type"] == "close")
                {

                    switch ($XValue["tag"]) {
                        case 'root':
                            break;

                        case 'area':
                            $area = false;
                            break;

                        case 'container':
                            $container = false;
                            break;

                        default:
                            throw new \Exception('The tag does not exist');
                    }

                }

            }

            return $this->document;

        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @return string
     */
    public function getCXML ()
    {

        $document = "";

        foreach ($this->document as $instance) {
            foreach ($instance as $templateName => $template) {
                $document .= "<container template=\"{$templateName}\">\n";
                foreach ($template as $areaName => $area) {
                    $document .= "    <area id=\"{$areaName}\">\n";
                    foreach ($area as $componentName => $component) {
                        $attr = Helpers\HTML::arrayToAttrs((array) $component['attributes']);
                        $document .= "<{$component['component']} {$attr}/>\n";
                    }
                    $document .= "    </area>\n";
                }
                $document .= "</container>\n";
            }
        }

        return $document;

    }

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct($document)
    {

        if (is_array($document) or is_object($document)) {
            $this->document = $document;
        } else {
            $this->__processing($document);
        }

    }


}