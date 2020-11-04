<?php


namespace Mirele\Compound\Engine;

use Mirele\Framework\Traits\__getter;
use Mirele\Framework\Traits\__isset;
use Mirele\Framework\Traits\__setter;
use Mirele\Framework\Traits\__unset;

class Application
{

    use __setter;
    use __getter;
    use __isset;
    use __unset;

    public function Blog ($name = '')
    {
        return get_bloginfo($name, 'raw');
    }

    public function User ()
    {

        $user = wp_get_current_user();
        $user->avatar = get_avatar_url($user->ID);

        return $user;

    }

    public function Option ()
    {

    }

}