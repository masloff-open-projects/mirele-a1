<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Response;
use Mirele\Framework\Request;


/**
 * Class WPAJAX_Compound__cloneTemplate
 * @package Mirele\WPAJAX
 * @alias Compound/cloneTemplate
 * @description The Endpoint serves to create a copy of the Instance Template.
 * @version 1.0.0
 */
class WPAJAX_login extends Request
{

    /**
     * The __invoke method is used to compile (if necessary) and process a request with the transferred parameters.
     * The query object also supports working with the 'handler' method, but its use is not recommended.
     *
     * PHPDOC: The __invoke method is called when a script tries to call an object as a function.
     *
     * @param $request array $_REQUEST
     * @return object|array|Response|boolean|string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(array $request)
    {
        if (is_user_logged_in())
        {

            return new Response([
                'message' => 'The user is already logged in'], 405);


        } else
        {

            $props = array(
                'user_login'    => (MIRELE_POST)['login'],
                'user_password' => (MIRELE_POST)['password'],
                'remember'      => (MIRELE_POST)['remember'] == 'true' ? true : false);

            $user = wp_signon($props);

            if (is_wp_error($user))
            {

                return new Response([
                    'message' => $user->get_error_message()], 401);

            } else
            {

                return new Response([], 200);

            }

        }

    }

}
