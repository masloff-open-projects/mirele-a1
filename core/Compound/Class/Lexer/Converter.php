<?php


namespace Mirele\Compound\Children;

use Mirele\Compound\Directive;


/**
 * @param string $XML
 * @return XMLElement|mixed
 */

function XTO (string $XML)
{
    $parser = xml_parser_create();
    
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, $XML, $values);
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
