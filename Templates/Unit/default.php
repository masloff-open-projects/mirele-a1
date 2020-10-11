<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Template;

new Template([
    'id' => 'Unit',
    'name' => 'Unit',
    'meta' => [
        'editor' => (
            (new Config)
                ->setData('name', 'Unit')
                ->setData('description', 'Hello')
        )
    ]
]);