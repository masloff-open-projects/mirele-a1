<?php

namespace Mirele\Components;

use Mirele\Compound\Component;


new Component([

    'data' => [
        'id'    => 'default_form_shipping',
        'alias' => '@woo_form_shipping',
        'props' => [],

    ],

    'template'  => "Binder/Component/Woocommerce/Forms/Children/Shipping/template.html.twig",

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