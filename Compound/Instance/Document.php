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

            $document = xml_parser_create();

            xml_parser_set_option($document, XML_OPTION_CASE_FOLDING, 0);
            xml_parser_set_option($document, XML_OPTION_SKIP_WHITE, 1);
            xml_parser_set_option($document, XML_OPTION_TARGET_ENCODING, 'UTF-8');
            xml_parse_into_struct($document, $data, $values);
            xml_parser_free($document);

            $area = false;
            $container = false;

            foreach($values as $XKey => $XValue)
            {

                if($XValue["type"] == "complete")
                {

                    if ($area and $container) {

                        # Component
                        $uuid = $this->__uid();
                        $component = $XValue['tag'];
                        $value = $XValue['value'];
                        $attributes = isset($XValue['attributes']) ? $XValue['attributes'] : [];

                        $this->document[$container][$area][$uuid] = array(
                            'component' => $component,
                            'value' => $value,
                            'attributes' => $attributes,
                        );

                    }

                }
                elseif($XValue["type"] == "open")
                {

                    switch ($XValue["tag"]) {
                        case 'area':
                            if ($area == false) {
                                if (isset($XValue['attributes']['id'])) {
                                    $area = $XValue['attributes']['id'];
                                } else {
                                    $area = false;
                                }
                            } else {
                                throw new \Exception('Within a tag area, no other area can be created');
                            }
                            break;

                        case 'container':
                            if ($container == false) {
                                if (isset($XValue['attributes']['template'])) {
                                    $container = $XValue['attributes']['template'];
                                } else {
                                    $container = false;
                                }
                            } else {
                                throw new \Exception('Within a tag container, no other container can be created');
                            }
                            break;
                    }

                }
                elseif($XValue["type"] == "close")
                {

                    switch ($XValue["tag"]) {
                        case 'area':
                            $area = false;
                            break;

                        case 'container':
                            $container = false;
                            break;
                    }

                }

            }

            return $this->document;

        } else {
            return false;
        }
    }

    public function document (string $document) {
        return $this->__processing($document);
    }

}