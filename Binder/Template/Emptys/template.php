<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Template;

$Template = new Template();
$Template->setId('default_empty');

// Fields
$Template->setField("field",
    clone (new Field())->setName("field")->setMeta('editor', ((new Config())->setData('grid', 'inline')))
);

$Template->setMeta('name', 'Empty');

$Template->setTwig('Binder/Template/Emptys/template.html.twig');

Grider::save(clone $Template);
