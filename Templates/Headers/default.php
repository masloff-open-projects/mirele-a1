<?php

namespace Mirele\Templates;

use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Compound\Field;

$Template = new Template();
$Template->setId('default_header');
$Template->setProps([
    'color' => 'red'
]);

$Template->setComponent('input', Store::get('default_abstract_input'));
$Template->setComponent('button', Store::get('default_abstract_button'));

// Fields
$Template->setField('input',
    (new Field())
        ->setName('input')
        ->setComponent(Store::get('default_abstract_input'))
        ->setComponentProps([])
);

$Template->setField('button',
    (new Field())
        ->setName('button')
        ->setComponent(Store::get('default_abstract_button'))
        ->setComponentProps([])
);

$Template->setTwig('Templates/Headers/default');

Grider::add($Template);