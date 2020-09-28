<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Compound\Field;

$Template = new Template();
$Template->setId('default_empty');

// Fields
$Template->setField("field",
    clone (new Field())
        ->setName("field")
        ->setMeta('editor', ((new Config())
            ->setData('grid', 'inline')
        ))
);

$Template->setMeta('name', 'Empty');

$Template->setTwig('Templates/Grid/default');

Grider::add(clone $Template);
