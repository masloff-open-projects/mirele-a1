<?php

namespace Mirele\Templates;

use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Compound\Template;

$Template = new Template();
$Template->setId('default_header');
$Template->setProps([
    'color' => 'red'
]);

$Template->setTwig('Templates/Headers/default');

Grider::add($Template);