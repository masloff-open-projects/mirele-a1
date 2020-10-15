<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
use Mirele\Framework\Request;


class WPAJAX_Compound__updatePage extends Request {

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
        if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

            $pattern = (new Patterns\updatePage([
                'page' => (MIRELE_POST)['page'],
                'props' => (MIRELE_POST)['props']
            ]));

            $buffer = $pattern();

            if ($buffer) {

                return new Response([
                    'result' => $buffer
                ], 200);

            } else {

                return new Response([
                    'result' => $buffer
                ], 500);

            }


        }

    }


}