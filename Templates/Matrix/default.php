<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Grider;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Compound\Field;

$Template = new Template();
$Template->setId('default_matrix');
$Template->setProps([]);

foreach (range(1, 6) as $x) {

    foreach (range(1, 6) as $i) {

        $config = new Config();
        $config->setData('col', 2);

        $Template->setField("position-$x-$i",
            clone (new Field())
                ->setName("position-$x-$i")
                ->setMeta('editor', $config)
        );

    }

}

$Template->setMeta('name', 'Matrix');

$Template->setTwig('Templates/Grid/default');

Grider::add(clone $Template);