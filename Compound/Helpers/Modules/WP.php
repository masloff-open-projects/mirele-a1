<?php


namespace Mirele\Compound\Helpers;


class WP
{

    public function User () {
        return 'Looser';
    }

    public function URL ()
    {
        return [
            'registration' => wp_registration_url(),
            'login' => wp_login_url(),
            'logout' => wp_logout_url(),
            'lost_password' => wp_lostpassword_url(),
            'checkout' => WOOCOMMERCE_SUPPORT ? esc_url(wc_get_checkout_url()) : '',
            'profile' => [
                'account' =>  get_permalink(get_option('woocommerce_myaccount_page_id')),
                'edit' => get_edit_profile_url(),
            ],
            'customer' => [
                'edit' => WOOCOMMERCE_SUPPORT ? wc_customer_edit_account_url() : '',
            ],
            'service' => MIRELE_URLS
        ];
    }

}