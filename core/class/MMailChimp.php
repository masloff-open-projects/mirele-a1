<?php

/**
 * API for working with the service.
 * This comment is a meta description for all integrations.
 * With this code you can register AJAX requests,
 * PHP classes, plug styles into the header.
 * Integrations connect low enough (bootloader) so you can
 * use the database, Mirele and Rosemary kernels
 *
 * @author: Mirele
 * @package: MailChimp
 * @version 1.0.0
 */

abstract class MIMailChimp {


    /**
     * Getting user account information
     *
     * @version 1.0.0
     */

    static public function account ($token=null) {

        $server = explode('-', $token)[1];

        $ch = curl_init("https://$server.api.mailchimp.com/3.0/");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_USERPWD, 'any:' . $token);

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


    /**
     * Getting user lists
     *
     * @version 1.0.0
     */

    static public function lists ($token=null) {

        $server = explode('-', $token)[1];

        $ch = curl_init("https://$server.api.mailchimp.com/3.0/lists");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_USERPWD, 'any:' . $token);

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


    /**
     * New subscriber
     *
     * @version 1.0.0
     */

    static public function new_sbscribe ($token=null, $list=null, $email=null, $fname=null, $lname=null, $phone=null) {

        $server = explode('-', $token)[1];

        $ch = curl_init("https://$server.api.mailchimp.com/3.0/lists/$list/members");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "email_address" => $email,
            "status" => "subscribed",
            "merge_fields" => [
                "FNAME" => $fname,
                "LNAME" => $lname,
                "PHONE" => $phone
            ]
        ]));
        curl_setopt($ch, CURLOPT_USERPWD, 'any:' . $token);

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


}