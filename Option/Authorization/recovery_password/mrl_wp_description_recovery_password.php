<?php

use Mirele\Framework\Customizer;
use Mirele\Framework\Option;

Customizer::add((new Option)
    ->setType("text")
    ->setDefault("If you forgot your password, we can quickly restore it. Enter your username and email address from your account in the form below. We will send you a link to restore your password. If the email doesn't arrive, check the spam folder in your email")
    ->setName("mrl_wp_description_recovery_password")
    ->setTitle("Enter the text under the signup form header")
    ->setDescription("Enter the text under the title in the authorization form. Try to describe or tell the user the benefits of signup on the site as briefly and locally as possible. ")
    ->setNamespace("@wc-recovery")
);

