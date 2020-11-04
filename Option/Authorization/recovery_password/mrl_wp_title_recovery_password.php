<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add((new Option)
    ->setType("text")
    ->setDefault("Step by step we will restore your password")
    ->setName("mrl_wp_title_recovery_password")
    ->setTitle("Enter the text under the login form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of login on the site as briefly and locally as possible. ")
    ->setNamespace("@wc-recovery")
);
