<?php

/**
 * Manager Package data
 *
 * @version 1.0.0
 * @package Mirele
 * @author Mirele
 */

class MPackage {

    private $packages;
    private $files=[];
    private $dir="cache/package";
    private $time=72;
    private $json = array();


    /**
     * Function for saving and caching package files.
     * The function is built on the basis of the normal data caching function Mirele.
     *
     * @version 1.0.0
     * @package Mirele
     * @param $path
     * @return string
     */

    private function getFile ($path='.') {

        if (filter_var($path, FILTER_VALIDATE_URL) and !($_SERVER['SERVER_NAME'] == getDomain($path) or $_SERVER['HTTP_HOST'] == getDomain($path))) {

            $file = sprintf ("%s/%s/%s/%s.package", MIRELE_CORE_DIR, $this->dir, getDomain($path), basename($path));

            if (file_exists($file) && time() - filectime($file) < 60 * 60 * $this->time && filesize($file) > 0) {
                return get_template_directory_uri() . '/core/' . $this->dir . '/' . getDomain($path) . '/' . basename($path) . '.package';
            } else {

                if (!is_dir(MIRELE_CORE_DIR . '/' . $this->dir . '/' . getDomain($path) . '/')) {
                    mkdir(MIRELE_CORE_DIR . '/' . $this->dir . '/' . getDomain($path) . '/');
                }

                if (is_writable($file) or true) {
                    if (MFile::write($file, MFile::read($path))) {
                        return get_template_directory_uri() . '/core/' . $this->dir . '/' . getDomain($path) . '/' . basename($path) . '.package';;
                    } else {
                        return $path;
                    }
                } else {
                    return $path;
                }


            }

        } else {
            return $path;
        }

    }


    /**
     * A function to register the packet data.
     * The function caches batch data before registering
     * it in the batch array. By default, the site runs on
     * cached data for 72 hours, after which it loads again
     *
     * @version 1.0.0
     * @package Mirele
     * @param string $package_type
     * @param array $data
     * @param string $id
     * @return object
     */

    public function register ($package_type="template", $data=array(), $id='') {

        /**
         * Creating new objects for data processing
         */

        $_ = (object) $data;
        $__ = (object) array (
            'css' => [],
            'js' => []
        );


        /**
         * Installing CSS styles and download them to the server
         */

        if (isset($_->css)) {
            foreach ($_->css as $css) {
                $__->css[] = self::getFile($css);
            }
        }


        /**
         * Installing JS styles and download them to the server
         */

        if (isset($_->js)) {
            foreach ($_->js as $js) {
                $__->js[] = self::getFile($js);
            }
        }


        /**
         * Installing JSON data and download them to the server
         */

        if (isset($_->json)) {
            foreach ($_->json as $json) {
                $__->json[] = self::getFile($json);
            }
        }

        return $this->files[$package_type][$id] = (object) $__;

    }


    /**
     * A function for receiving packet data.
     * The data that will be received as a result of
     * calling the function will either be directly directed
     * (the link will lead to the " CDN " server) or to a local copy of the file.
     *
     * @version 1.0.0
     * @package Mirele
     * @param $package_type
     * @param $id
     * @return array|object
     */

    public function get ($package_type, $id) {

        if (!empty($this->files[$package_type][$id])) {
            return (object) $this->files[$package_type][$id];
        } else {
            return [];
        }
    }


    /**
     * This function will perform all CSS, JS,
     * and other scripting connections to the page.
     *
     * @version 1.0.0
     * @package Mirele
     * @param string $package
     * @param string $app
     */

    public function execute ($package_type='app', $app='', $use_router=true) {

        global $mrouter;

        $package = self::get($package_type, $app);
        $return = array ();

        if (isset($package) and !empty($package)) {

            if (isset($package->css) and !empty($package->css)) {
                foreach (self::get($package_type, $app)->css as $path) {
                    if ($use_router) {
                        $mrouter->register($app, 'css', $path);
                    } else {
                        wp_enqueue_style(md5($path), $path);
                    }
                    $return['css'][] = $path;
                }
            }

            if (isset($package->js) and !empty($package->js)) {
                foreach (self::get($package_type, $app)->js as $path) {
                    if ($use_router) {
                        $mrouter->register($app, 'js', $path);
                    } else {
                        wp_enqueue_script(md5($path), $path);
                    }
                    $return['js'][] = $path;
                }
            }

            if (isset($package->json) and !empty($package->json)) {
                foreach (self::get($package_type, $app)->json as $path) {
                    if (!in_array(basename($path), $this->json)) {
                        try {
                            $this->json[basename($path)] = json_decode(MFile::read($path));
                        } catch (Exception $exception) {
                            $this->json[basename($path)] = false;
                        }
                    }
                    $return['json'][] = $path;
                }
            }

            if (isset($package->fonts) and !empty($package->fonts)) {
                foreach (self::get($package_type, $app)->fonts as $path) {
                    $return['font'][] = $path;
                }
            }

            $mrouter->execute($app);

            return $return;

        } else {
            return false;
        }

    }


    /**
     * The function will receive all the JSON data
     * passed to the package manager along with links to other scripts.
     *
     * Print data received as a result of loading it
     * from the 'json' array passed to the package manager
     *
     * @return array
     */

    public function json () {
        return $this->json;
    }


    /**
     * Download Google font by its name on the page.
     *
     * @param string $src
     */

    static public function single_font ($src='name or url') {

        global $mrouter;

        if (filter_var($src, FILTER_VALIDATE_URL)) {
//            $mrouter->register('any-footer', 'css',"https://fonts.googleapis.com/css2?family=$src");
        } else {
            $mrouter->register('any-footer', 'css',"https://fonts.googleapis.com/css2?family=$src&display=swap");
        }


    }


}