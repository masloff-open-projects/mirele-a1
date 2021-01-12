<?php

namespace Mirele\Components;

use Mirele\Compound\Component;


new Component([

    'data' => [
        'id'    => 'default_orders_table',
        'alias' => '@woo_orders_table',
        'props' => []
    ],

    'template'  => "Binder/Component/Woocommerce/Table/Children/Cart/template.html.twig",

    # Once the component is created in the system and registered.
    # Not called when creating a component with an empty constructor
    'construct' => function (Component $self) {

    },

    # Once the component is ready to appear on the page,
    # but not yet created as an HTML entity.
    'created'   => function (Component $self) {

        $props = (object)$self->getProps();

        if (isset($props->orders) and $props->orders)
        {
            $props->orders = (array)$props->orders;
        } else
        {

            $props->posts = (array)get_posts(array(
                    'numberposts' => -1,
                    'meta_key'    => '_customer_user',
                    'meta_value'  => get_current_user_id(),
                    'post_type'   => wc_get_order_types(),
                    'post_status' => array_keys(wc_get_order_statuses())
                )
            );

            foreach ($props->posts as $index => $order)
            {
                $props->orders[$index] = wc_get_order($order);
                $props->orders[$index]->formated_time = wc_format_datetime($props->orders[$index]->get_date_created());
                $props->orders[$index]->status_name = wc_get_order_status_name($props->orders[$index]->get_status());
                $props->orders[$index]->format_total_price = woocommerce_price($props->orders[$index]->get_total());
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