<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Config;

new Component([

    'data' => [
        'id'    => 'default_cart',
        'alias' => '@cart',
        'props' => [
            'title'       => 'New cart',
            'description' => 'lorem',
            'button'      => [
                'link' => '#',
                'text' => 'Learn more'
            ]
        ],
        'meta'  => [
            'editor' => (new Config())->setData('title', 'Cart')->setData('description', '')->setData('alias', '')
        ]
    ],

    'template'  => "Binder/Component/Cart/template.html.twig",

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