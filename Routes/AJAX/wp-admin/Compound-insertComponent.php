<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Patterns;
use Mirele\Compound\Response;
use Mirele\Framework\Prototypes\Request;


class WPAJAX_Compound__insertComponent extends Request
{

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {
        # If user login in and have permission
        if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

            $pattern = new Patterns\insertComponent();
            $pattern->page = (MIRELE_POST)['page'];
            $pattern->component = (MIRELE_POST)['component'];
            $pattern->field = (MIRELE_POST)['field'];
            $pattern->template = (MIRELE_POST)['template'];

            $biffer = $pattern();

            if ($biffer) {

                return new Response([
                    'result' => $biffer
                ], 200);

            } else {

                return new Response([
                    'result' => $biffer
                ], 500);

            }

        }
    }

}