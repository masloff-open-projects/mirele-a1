<?php

namespace Mirele\Framework\Strategists;

use Mirele\Framework\Strategy;

class Any extends Strategy {

    /**
     * @handler
     */
    protected function handler (array $data)
    {
        return true;
    }

}