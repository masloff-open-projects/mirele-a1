<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add( (new Option)
    ->setType("text")
    ->setDefault("By creating an account on our site, you can manage your orders, participate in promotions, buy products in two clicks, and much more")
    ->setName("mrl_wp_description_signup")
    ->setTitle("Enter the text under the signup form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of signup on the site as briefly and locally as possible. ")
    ->setNamespace("@wc-signup")
);

