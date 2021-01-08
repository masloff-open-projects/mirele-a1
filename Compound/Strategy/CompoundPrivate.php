<?php

namespace Mirele\Framework\Strategists;

use Mirele\Framework\Strategy;

class CompoundPrivate extends Strategy {

    /**
     * @handler
     */
    protected function handler (array $data)
    {
        if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {
            return true;
        } else {
            return false;
        }
    }

}