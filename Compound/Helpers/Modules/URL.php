<?php


namespace Mirele\Compound\Helpers;


class URL
{

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct()
    {

        global $post;

        $this->registration = wp_registration_url();
        $this->login = wp_login_url();
        $this->logout = wp_logout_url();
        $this->lost_password = wp_lostpassword_url();
        $this->checkout = WOOCOMMERCE_SUPPORT ? esc_url(wc_get_checkout_url()) : '';

        $this->profile = (object) array();
        $this->profile->edit = get_edit_profile_url();

        $this->customer = (object) array();
        $this->profile->edit = WOOCOMMERCE_SUPPORT ? wc_customer_edit_account_url() : '';

    }

}