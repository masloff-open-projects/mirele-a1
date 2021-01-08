<?php

namespace Mirele\Compound\Adapter;


use Mirele\Compound\Network;
use Mirele\Compound\Response;

class AJAX
{

    final public static function run()
    {

        // Wordpress Event Processing
        $POST = MIRELE_POST;

        if (isset($POST['action']) and isset($POST['method']))
        {

            $run = Network::run((MIRELE_POST)['method'], [
                'verify_nonce' => wp_verify_nonce($_REQUEST['nonce'], MIRELE_NONCE)]
            );

            if ($run instanceof Response)
            {
                http_response_code($run->getCode());
                wp_send_json($run->getBody());
            } elseif (is_bool($run))
            {
                if ($run === true)
                {
                    wp_send_json_success([]);
                } elseif ($run === false)
                {
                    wp_send_json_error([]);
                } else
                {
                    wp_send_json([]);
                }
            } elseif (is_object($run) or is_array($run))
            {
                wp_send_json($run);
            } else
            {
                print $run;
            }

            exit;

        }

    }

}