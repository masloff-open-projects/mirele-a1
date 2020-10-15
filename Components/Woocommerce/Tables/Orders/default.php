<?php

namespace Mirele\Components;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\TWIG;

$Component = new Component ();
$Component->setId('default_orders_table');
$Component->setProps([]);
$Component->setHandler("output", function ($props) {

    $props = (object) $props;

    if (isset($props->orders) and $props->orders) {
        $props->orders = (array) $props->orders;
    } else {

        $props->posts = (array) get_posts(array(
            'numberposts' => -1,
            'meta_key'    => '_customer_user',
            'meta_value'  => get_current_user_id(),
            'post_type'   => wc_get_order_types(),
            'post_status' => array_keys( wc_get_order_statuses() ))
        );

        foreach ($props->posts as $index => $order) {
            $props->orders[$index] = wc_get_order($order);
            $props->orders[$index]->formated_time = wc_format_datetime($props->orders[$index]->get_date_created());
            $props->orders[$index]->status_name = wc_get_order_status_name($props->orders[$index]->get_status());
            $props->orders[$index]->format_total_price = woocommerce_price($props->orders[$index]->get_total());
        }

    }

    TWIG::Render('Components/Woocommerce/default_orders_table', $props);

});

Store::add($Component);