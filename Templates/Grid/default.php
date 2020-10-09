<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Compound\Template;

$Template = new Template();
$Template->setId('default_grid');
$Template->setProps([
    'grid' => 4
]);

$Template->setComponent('input', Store::get('default_abstract_input'));
$Template->setComponent('button', Store::get('default_abstract_button'));

// Fields
foreach (range(1, $Template->getProp('grid')) as $i) {
    $config = new Config();
    $config->col = 12 / $Template->getProp('grid');
    $Template->setField("col$i",
        clone (new Field())
            ->setName("col$i")
            ->setMeta('editor', $config)
    );
}

$Template->setMeta('name', 'Grid');

$Template->setTwig('Templates/Grid/default');

Grider::save(clone $Template);