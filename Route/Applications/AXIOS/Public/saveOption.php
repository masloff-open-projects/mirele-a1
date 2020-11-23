<?php


namespace Mirele\Network;

use Mirele\Compound\Response;
use Mirele\Framework\Request;


# Endpoint to save or update options
# Endpoint Version: 1.0.0
# Distributors: Axios
class Request_center__saveOption extends Request
{

    const STRAEGY = 0x342;

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

        # If user login in and have permission
        if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit']))
        {

            # Request validation
            if (isset((MIRELE_POST)['name']) and (MIRELE_POST)['namespace'] and (MIRELE_POST)['value'])
            {

                wp_send_json([
                    'data' => update_option((MIRELE_POST)['name'], (MIRELE_POST)['value'])
                ]
                );

            } else
            {
                wp_send_json([
                    'error' => 'Request is not valid'
                ]
                );
            }

        } else
        {

            return new Response([
                'message' => 'Access to this endpoint is not available to you'
            ], 403
            );

        }
    }


}