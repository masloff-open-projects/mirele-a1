<?php

/**
 * Script for sending analytical data for debugging purposes
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

class MAnalysis {

    /**
     * Post-Install Action
     *
     * @version: 1.0.0
     */

    function do_install ($product='Mirele', $version='1.0.0') {

        if (MIRELE_SEND_ANALYSIS && MIRELE_FORCED_DISABLE_ANALYSIS == false) {

            $ch = curl_init(MIRELE_ANALYSIS_IP . '/do/install/' . $product . '/' . $version);

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

            curl_close($ch);

        }

    }

    function do_activate ($product='Mirele', $action='nothing') {

        if (MIRELE_SEND_ANALYSIS && MIRELE_FORCED_DISABLE_ANALYSIS == false) {

            $ch = curl_init(MIRELE_ANALYSIS_IP . '/do/activate/' . $product . '/' . $action);

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

            curl_close($ch);

        }

    }

    function do_search ($product='Mirele', $what='nothing', $request='none') {

        if (MIRELE_SEND_ANALYSIS && MIRELE_FORCED_DISABLE_ANALYSIS == false) {

            $ch = curl_init(MIRELE_ANALYSIS_IP . '/do/search/' . $product . '/' . $what . '/' . $request);

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

            curl_close($ch);

        }

    }

    /**
     * User Data Identification
     *
     * @version: 1.0.0
     */

    function me ($category='wordpress', $data=null, $value=null) {

        if (MIRELE_SEND_ANALYSIS && MIRELE_FORCED_DISABLE_ANALYSIS == false) {

            $ch = curl_init(MIRELE_ANALYSIS_IP . '/me/' . $category . '/' . $data . '/' . $value );

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

            curl_close($ch);

        }

    }

}