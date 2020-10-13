<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
use Mirele\Framework\Prototypes\Request;


# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
class WPAJAX_Compound__getTemplateProps extends Request {

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {
        if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

            $pattern = new Patterns\propsTemplate();
            $pattern->template = (MIRELE_POST)['template'];
            $pattern->page = (MIRELE_POST)['page'];

            return new Response([
                'props' => $pattern()
            ], 200);

        } else {

            return new Response([
                'message' => 'Access to this endpoint is not available to you'
            ], 403);

        }
    }

}