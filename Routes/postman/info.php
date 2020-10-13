<?php

use Mirele\Compound\Response;
use Mirele\Framework\Traits\__getter;
use Mirele\Framework\Traits\__isset;
use Mirele\Framework\Traits\__setter;
use Mirele\Framework\Traits\__unset;

class WPAJAX_get
{

    use __setter;
    use __getter;
    use __isset;
    use __unset;

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke($request)
    {
        return new Response([
            'key' => $this->key
        ], 200);
    }

}