<?php

/**
 * Class MRouter
 *
 * A class for managing external batch files,
 * such as CSS, JS, HTML, XML, JSON, etc.
 * Usually used for flexible connection of styles on a page
 *
 * @version 1.0.0
 * @author Mirele
 * @package Mirele
 */

class MRouter
{

    private $javascript = array ();
    private $css = array ();
    private $dependencies = array ();

    public function __construct()
    {

        $this->javascript = (object) array (
            'defer' => (get_option('mirele_core_use_defer_js', 'true') == 'true'),
            'async' => (get_option('mirele_core_use_async_js', 'true') == 'true'),
        );

        $this->css = (object) array (
            'async' => (get_option('mirele_core_use_async_css', 'true') == 'true'),
        );

    }

    /**
     * Function for connecting a style
     * with parameters and user attributes,
     * bypassing the header.
     *
     * @version 1.0.0
     * @author Mirele
     * @param null $src
     * @param null $attr
     */

    private function wp_include_style ($src=null, $attr=null) {
        echo "<link rel=\"stylesheet\" href=\"$src\" $attr>";
    }


    /**
     * Function for connecting a script
     * with parameters and user attributes,
     * bypassing the header.
     *
     * @version 1.0.0
     * @author Mirele
     * @param null $src
     * @param null $attr
     */

    private function wp_include_script ($src=null, $attr=null) {
        echo "<script src='$src' $attr></script>";
    }


    /**
     * Function for connecting user style or script to HTML page
     * Pass an array as a parameter for style_uri to connect the style
     * via wp_enqueue_*, pass the string to connect via private MRouter wp_include_*,
     * pass a function to execute it as a routing
     *
     * @version 1.0.0
     * @author Mirele
     * @param string $page
     * @param string $type
     * @param string $style_uri
     */

    public function register ($page='rosemary_render_editor', $type='css', $style_uri='localhost') {
        if (is_array($style_uri) or is_object($style_uri)) {
            $this->dependencies[$page][$type][] = $style_uri;
        } else {
            $this->dependencies[$page][$type][] = $style_uri;
        }
    }

    /**
     * Function to execute scripts and styles
     * on the page. usually it serves to
     * connect user scripts in the header of the site
     *
     * @version 1.0.0
     * @author Mirele
     * @param string $page
     * @return array|bool
     */

    public function execute ($page='rosemary_render_editor') {

        if (!empty($page)) {
            if (isset($this->dependencies[$page])) {

                $return = [];

                if (isset($this->dependencies[$page]['js'])) {

                    foreach ($this->dependencies[$page]['js'] as $file) {

                        if (is_callable($file)) {
                            call_user_func($file, (object) array(
                                'self' => self
                            ));
                        } elseif (is_array($file) or is_object($file)) {
                            foreach ($file as $link) {
                                wp_enqueue_script (sha1($link), $link);
                            }
                        } else {

                            $attr = '';

                            if ($this->javascript->defer) {
                                $attr .= ' defer';
                            }

                            if ($this->javascript->async) {
                                $attr .= ' async';
                            }

                            self::wp_include_script($file, $attr);
                        }

                        $return['js'][] = $file;
                    }
                }

                if (isset($this->dependencies[$page]['css'])) {
                    foreach ($this->dependencies[$page]['css'] as $file) {
                        if (is_callable($file)) {
                            call_user_func($file, (object) array(
                                'self' => self
                            ));
                        } elseif (is_array($file) or is_object($file)) {
                            foreach ($file as $link) {
                                wp_enqueue_style (sha1($link), $link);
                            }
                        } else {

                            $attr = '';

                            if ($this->css->async) {
                                $attr .= ' media="none" onload="if(media!=\'all\')media=\'all\'"';
                            }

                            self::wp_include_style($file, $attr);
                        }
                        $return['css'][] = $file;
                    }
                }

                return $return;

            } else {
                return false;
            }
        } else {
            return false;
        }

    }


    /**
     * The function checks the rule of the router for its existence.
     *
     * @version 1.0.0
     * @author Mirele
     * @param string $page
     * @return bool
     */

    public function exists ($page='rosemary_render_editor') {
        return isset($this->dependencies[$page]);
    }

}