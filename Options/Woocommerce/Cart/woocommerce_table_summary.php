<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add( (new Option)
    ->setType("switch")
    ->setDefault(false)
    ->setName("woocommerce_table_summary")
    ->setTitle("Summarize the cost of all goods at the end of the table")
    ->setDescription("If this option is enabled, at the end of the shopping cart table a summary of the value of all items and the total value of all purchased items with discounts and coupons will be summed up.")
    ->setNamespace('@wc-cart')
);
