<?php

/**
 * Class for working with a Mirele account.
 * Mirele Account is a small system for controlling user actions.
 * It may require a password to perform an action, such as updating a system,
 * downloading a block from Marketplace.
 * Password stored as a hash in Wordpress memory
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

define('MAUTH_ERROR_PASSWORD', "The password you provided is not correct");
define('MAUTH_ERROR_NOT_ACCOUNT', "You are not registered in the system");

class MAccount {

    /**
     * Universal function to get a hash from a string.
     * it is used for password hashing, since storing
     * a password in clear text is not safe
     *
     * @param string $string
     * @return string
     */

    static private function get_hash ($string='') {
        return hash('sha512', $string);
    }


    /**
     * Function for authorization of user password.
     * It receives a password as a function parameter,
     * and if it matches the password in WordPress,
     * a success message will be displayed
     *
     * @param string $password
     * @return bool
     */

    static public function auth ($password='') {

        if (self::get_hash($password) == get_option('mrl_mpa', false)) {
            return true;
        } else {
            return false;
        }

    }


    /**
     * Function for registering a Mirele account.
     * Since the MIrele account has nothing to do
     * with the WordPress account,
     * it also needs a separate registration function.
     * It accepts the login password and checks
     * if the user is registered in the system.
     * If not, saves the password as a hash string.
     *
     * @param string $password
     * @return bool
     */

    static public function register ($password='') {

        if (get_option('mrl_mpa', false) === false) {
            return update_option('mrl_mpa', self::get_hash($password)) ? true : false;
        } else {
            return false;
        }

    }


    /**
     * Function that checks if the user is
     * registered in the system
     *
     * @return bool
     */

    static public function is_registered () {
        return get_option('mrl_mpa', false) === false ? false : true;
    }


    /**
     * The function calls back if the password from the Mirele
     * account has been transmitted correctly.
     * If the password passed is not true,
     * the function will return the essence
     * of the error (not only False or True)
     *
     * @param null $function
     * @param string $password
     * @return bool|mixed|string[]
     */

    static public function execute ($function=null, $password='') {

        if (self::is_registered ()) {

            if (self::auth($password)) {

                if (is_callable($function)) {
                    return call_user_func($function);
                } else {
                    return false;
                }

            } else {

                return MAUTH_ERROR_PASSWORD;

            }

        } else {

            return MAUTH_ERROR_NOT_ACCOUNT;

        }

    }

}
