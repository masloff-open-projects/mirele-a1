<?php


namespace Mirele\Utils;


class Converter
{

    /**
     * Converter object to URL params
     *
     * @version 1.0.0
     * @author Mirele
     * @alias obj2params
     * @param array $object
     * @return string
     */

    public function obj2params (array $object) {
        return (string) http_build_query($object);
    }

    /**
     * Converter object to URL string
     *
     * @version 1.0.0
     * @author Mirele
     * @alias obj2url
     * @param array $object
     * @return string
     */

    public function obj2url (array $object, $url) {

        $string_params = (string) (http_build_query($object));
        $string_url    = (string) ($url === false ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : $url);

        return (string) "$string_url?$string_params";
    }

    /**
     * Converter object to HTML attrs string
     *
     * @version 1.0.0
     * @author Mirele
     * @alias obj2htmlattr
     * @param array $object
     * @return string
     */

    public function obj2htmlattr (array $object) {
        return implode(' ', array_map(
            function ($k, $v) { return $k .'="'. htmlspecialchars($v) .'"'; },
            array_keys($object), $object
        ));
    }

}