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

//$Template->setComponent('input', Store::get('default_abstract_input'));
//$Template->setComponent('button', Store::get('default_abstract_button'));

// Fields
$Template->setField('label',
    (new Field())
        ->setName('label')
        ->setComponent(Store::get('default_abstract_label'))
);

$Template->setField('input',
    (new Field())
        ->setName('input')
);

$Template->setField('button',
    (new Field())
        ->setName('button')
);

$Template->setMeta('name', 'Header');

$Template->setTwig('Templates/Headers/default');

Grider::add($Template);