<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Template;

$matrix = [
    4,
    4
];

$Template = new Template();
$Template->setId("default_matrix_{$matrix[0]}_{$matrix[1]}");
$Template->setProps([
    'theme' => 'dark'
]
);
$Template->setFolder('Matrix');
$Template->setParent('matrix');
$Template->setAlias("@matrix_".implode('-', $matrix));

foreach (range(1, $matrix[0]) as $x)
{

    foreach (range(1, $matrix[1]) as $i)
    {

        $Template->setField("position-$x-$i", clone (new Field())->setName("position-$x-$i")->setMeta('editor',
            ((new Config())->setData('col', 12 / $matrix[0]))
        )
        );

    }

}

$Template->setMeta('editor',
    ((new Config())->setData('name', 'Matrix')->setData('description', 'Create your own pages using a matrix.'
    )->setData('picture', '/public/img/covers/templates/template-matrix-cover-6x6.jpg')->setData('features', [
        array(
            'name'  => 'Columns',
            'value' => $matrix[0]
        ),
        array(
            'name'  => 'Rows',
            'value' => $matrix[1]
        )
    ]
    ))
);

$Template->setTwig('Template/Matrix/default');

Grider::save(clone $Template);