<?php

namespace Mirele\Components;

use Mirele\Compound\Component;


new Component([

    'data' => [
        'id'    => 'default_downloads_table',
        'alias' => '@woo_downloads_table',
        'props' => []
    ],

    'template'  => "Binder/Component/Woocommerce/Table/Children/Downloads/template.html.twig",

    # Once the component is created in the system and registered.
    # Not called when creating a component with an empty constructor
    'construct' => function (Component $self) {

    },

    # Once the component is ready to appear on the page,
    # but not yet created as an HTML entity.
    'created'   => function (Component $self) {

        $props = (object)$self->getProps();

        if (isset($props->downloads) and $props->downloads)
        {
            $props->downloads = (array)$props->downloads;
        } else
        {

            $props->posts = WC()->customer->get_downloadable_products();

            foreach ($props->posts as $index => $download)
            {
                $props->downloads[$index] = $download;
            }

        }

        $self->setProps((array)$props);

    },

    # Once the component is created and already shown on the user page.
    # Interaction with it in this state is no longer possible.
    'mounted'   => function (Component $self) {

    }

]
);