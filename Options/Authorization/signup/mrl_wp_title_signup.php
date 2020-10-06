<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add((new Option)
    ->setType("text")
    ->setDefault("Welcome to {WEBSITE_NAME}")
    ->setName("mrl_wp_title_signup")
    ->setTitle("Enter the text under the signup form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of login on the site as briefly and locally as possible. ")
    ->setNamespace("@wc-signup")
);
