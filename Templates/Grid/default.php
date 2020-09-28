<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Compound\Field;

$Template = new Template();
$Template->setId('default_grid');
$Template->setProps([
    'grid' => 5
]);

$Template->setComponent('input', Store::get('default_abstract_input'));
$Template->setComponent('button', Store::get('default_abstract_button'));

// Fields
foreach (range(1, $Template->getProp('grid')) as $i) {
    $Template->setField("col$i",
        clone (new Field())
            ->setName("col$i")
            ->setMeta('editor', ((new Config())
                ->setData('grid', 'inline')
            ))
    );
}


$Template->setMeta('name', 'Grid');

$Template->setTwig('Templates/Grid/default');

Grider::add(clone $Template);