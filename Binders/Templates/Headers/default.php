<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Compound\Template;

$Template = new Template();
$Template->setId('default_header');
$Template->setProps([
    'color' => 'red']);
$Template->setFolder('Header');


// Fields
$Template->setField('label', (new Field())->setName('label')->setComponent(Store::get('default_abstract_label')));

$Template->setMeta('name', 'Header');
$Template->setMeta('editor', (new Config())->setData('title', 'Header'));

$Template->setTwig('Templates/Headers/default');

Grider::save($Template);