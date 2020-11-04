<?php

namespace Mirele\Templates;

use Mirele\Compound\Component;
use Mirele\Compound\Config;
use Mirele\Compound\Template;

new Template([

    'id'   => 'matrix',
    'name' => 'matrix',
    'meta' => [
        'editor' => ((new Config)->setData('name', 'Matrix')->setData('description',
            'Create your own pages using a matrix.'
        )->setData('picture', '/public/img/covers/templates/template-matrix-cover-6x6.jpg')->setData('features', [
            array(
                'name' => 'Columns',
//                    'value' => $matrix[0]
            ),
            array(
                'name' => 'Rows',
//                    'value' => $matrix[1]
            )
        ]
        ))
    ],

    'template'  => "Binders/Component/Cart/template.html.twig",

    # Once the component is created in the system and registered.
    # Not called when creating a component with an empty constructor
    'construct' => function (Component $self) {

    },

    # Once the component is ready to appear on the page,
    # but not yet created as an HTML entity.
    'created'   => function (Component $self) {

    },

    # Once the component is created and already shown on the user page.
    # Interaction with it in this state is no longer possible.
    'mounted'   => function (Component $self) {

    }

]
);
