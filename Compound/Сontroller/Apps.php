<?php

/**
 * Class Apps
 * Class for working with Mirele.
 * Mirele applications are like WordPress plugins,
 * only built into the distribution
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

class Apps {

    private $apps = array();

    /**
     * Application registration function.
     * With it, you can register a custom
     * application that users will come to
     * in the Mirele Apps account.
     * Typically, the essence of the application
     * is a set for editing any system components.
     * In standard Mirele applications,
     * there is a trend towards the integration of
     * third-party services for Rosemary blocks
     *
     * @param string $app_id
     * @param null $function
     * @param array $meta
     * @return bool|object
     */

    public function register ($app_id='default', $function=null, $meta=array()) {

        if (!isset($this->apps[$app_id])) {
            return $this->apps[$app_id] = (object) array(
                'app_id' => $app_id,
                'function' => $function,
                'meta' => is_array($meta) ? (object) $meta : (object) array()
            );
        } else {
            return false;
        }

    }


    /**
     * Function to execute the application.
     * She is responsible for rendering content
     * that will be shown to the user as your application
     *
     * @param string $app_id
     * @return bool
     */

    public function app ($app_id='default') {

        if (isset($this->apps[$app_id]) and isset($this->apps[$app_id]->function) and is_callable($this->apps[$app_id]->function)) {

            global $mrouter;

            if ($mrouter->exists("app_$app_id")) {
                $mrouter->execute("app_$app_id");
            }

            call_user_func($this->apps[$app_id]->function);

            return true;

        }else{
            return false;
        }

    }


    /**
     * Get all applications
     * @return array|bool
     */

    public function all () {

        if (!empty($this->apps)) {
            return $this->apps;
        } else {
            return false;
        }

    }


    /**
     * The function checks. is such an application found
     *
     * @param string $app_id
     * @return bool
     */

    public function app_exists ($app_id='default') {
        return isset($this->apps[$app_id]);
    }

}