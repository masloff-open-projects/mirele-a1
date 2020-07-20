<?php

/**
 * Class for forming styles. It is necessary to create custom
 * CSS styles that will be added to the page as a script tag in the footer
 * The class is used to create styles dynamically in
 * order to avoid huge inline styles for components.
 * The finished file is connected to the footer and
 * after loading the entire DOM page applies all the styles.
 *
 * @version: 1.0.0 Beta
 * @author: Mirele
 * @package: Mirele
 */

class MStyler {

    private $style = [];

    /**
     * @param string $page
     * @param string $element
     * @param array $style
     */

    /**
     * Function to register style.
     *
     * @param string $page
     * @param string $element
     * @param array $style
     */

    public function register ($page='any', $element="*", $style=array()) {

        if (isset($this->style[$page])) {
            $array = is_array($this->style[$page][$element]) ? $this->style[$page][$element] : [];
        } else {
            $array = [];
        }

        if (isset($this->style[$page])) {
            $this->style[$page][$element] = array_unique(array_merge($array, is_array($style) ? $style : []));
        } else {
            $this->style[$page] = array();
            $this->style[$page][$element] = array_unique(array_merge($array, is_array($style) ? $style : []));
        }
    }


    /**
     * Function to execute style (print style tag on page).
     *
     * @param string $page
     * @param string $element
     * @param array $style
     */

    public function execute ($page='any', $script_tag=true) {
        if (isset($this->style[$page])){
            if (is_array($this->style[$page])) {
                if ($script_tag) { echo "<style type='text/css'>"; }
                foreach ($this->style[$page] as $component => $data) {
                    echo "$component {";

                    foreach ($data as $style => $value) {
                        echo "$style : $value;";
                    }

                    echo "}";
                }
                if ($script_tag) { echo "</style>"; }
            }
        }
    }

}