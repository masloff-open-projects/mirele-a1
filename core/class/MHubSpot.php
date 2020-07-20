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
 * @package: HubSpot
 * @version 1.0.0
 */

abstract class MIHubSpot {


    /**
     * Getting user account information
     *
     * @version 1.0.0
     */

    static public function account ($token=null) {

        $ch = curl_init("https://api.hubapi.com/integrations/v1/me?hapikey=$token");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


    /**
     * Getting contacts information
     *
     * @version 1.0.0
     */

    static public function contacts ($token=null, $count=10) {

        if (get_option('mrli_hs_cache', false)) {

            $cache = mc_get('hubspot_contacts');

            if (!$cache) {

                $ch = curl_init("https://api.hubapi.com/contacts/v1/lists/all/contacts/all?hapikey=$token&count=$count");

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

                return mc_set('hubspot_contacts', json_decode(curl_exec($ch)));

            } else {
                return $cache;
            }

        } else {

            $ch = curl_init("https://api.hubapi.com/contacts/v1/lists/all/contacts/all?hapikey=$token&count=$count");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

        }


    }


    /**
     * Getting CRM forms
     *
     * @version 1.0.0
     */

    static public function forms ($token=null) {

        if (get_option('mrli_hs_cache', false)) {

            $cache = mc_get('hubspot_forms');

            if (!$cache) {

                $ch = curl_init("https://api.hubapi.com/forms/v2/forms?hapikey=$token");

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

                return mc_set('hubspot_forms', json_decode(curl_exec($ch)));

            } else {
                return $cache;
            }

        } else {

            $ch = curl_init("https://api.hubapi.com/forms/v2/forms?hapikey=$token");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

        }

    }


    /**
     * Getting form by ID
     *
     * @version: 1.0.0
     */

    static public function form ($token=null, $id=null) {

        if (get_option('mrli_hs_cache', false)) {

            $cache = mc_get('hubspot_form_' . $id);

            if (!$cache) {

                $ch = curl_init("https://api.hubapi.com/forms/v2/forms/$id?hapikey=$token");

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

                return mc_set('hubspot_form_' . $id, json_decode(curl_exec($ch)));

            } else {
                return $cache;
            }

        } else {

            $ch = curl_init("https://api.hubapi.com/forms/v2/forms/$id?hapikey=$token");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

        }

    }


    /**
     * Submit form
     *
     * @version: 1.0.0
     */

    static public function submit_form ($token=null, $portalId=null, $guid=null, $data=null) {

        $ch = curl_init("https://api.hsforms.com/submissions/v3/integration/submit/$portalId/$guid?hapikey=$token");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


    /**
     * Create contact
     *
     * @version: 1.0.0
     */

    static public function create_contact ($token=null, $email=null, $firstname=null, $lastname=null, $phone=null) {

        $ch = curl_init("https://api.hubapi.com/contacts/v1/contact?hapikey=$token");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $email
                ),
                array(
                    'property' => 'firstname',
                    'value' => $firstname
                ),
                array(
                    'property' => 'lastname',
                    'value' => $lastname
                ),
                array(
                    'property' => 'phone',
                    'value' => $phone
                )
            )
        )));

        $json = json_decode(curl_exec($ch));

        curl_close($ch);

        return $json;

    }


    /**
     * Gettings Tickets
     *
     * @version 1.0.0
     */

    static public function tickets ($token=null) {

        if (get_option('mrli_hs_cache', false)) {

            $cache = mc_get('hubspot_tickets');

            if (!$cache) {

                $ch = curl_init("https://api.hubapi.com/crm-objects/v1/objects/tickets/paged?hapikey=$token&properties=subject&properties=content&properties=hs_pipeline&properties=hs_pipeline_stage");

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

                return mc_set('hubspot_tickets', json_decode(curl_exec($ch)));

            } else {
                return $cache;
            }

        } else {

            $ch = curl_init("https://api.hubapi.com/crm-objects/v1/objects/tickets/paged?hapikey=$token&properties=subject&properties=content&properties=hs_pipeline&properties=hs_pipeline_stage");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            return json_decode(curl_exec($ch));

        }

    }


    /**
     * Gettings Owners
     *
     * @version 1.0.0
     */

    static public function owners ($token=null) {

        $cache = mc_get('hubspot_owners');

        if (!$cache) {

            $ch = curl_init("https://api.hubapi.com/owners/v2/owners?hapikey=$token");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            $json = curl_exec($ch);

            curl_close($ch);

            return mc_set('hubspot_owners', json_decode($json));

        } else {
            return $cache;
        }

    }


    /**
     * Create product
     *
     * @version: 1.0.0
     */

    static public function create_product ($token=null, $name="WooCommerce", $description="description", $price="10", $sku="WooCommerce") {

        $ch = curl_init("https://api.hubapi.com/crm-objects/v1/objects/products?hapikey=$token");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            [
                "name" => "name",
                "value" => $name
            ],
            [
                "name" => "description",
                "value" => $description
            ],
            [
                "name" => "price",
                "value" => $price
            ],
            [
                "name" => "hs_sku",
                "value" => $sku
            ],
            [
                "name" => "recurringbillingfrequency",
                "value" => "quarterly"
            ]
        ]));

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


    /**
     * Get recent deals
     *
     * @version: 1.0.0
     */

    static public function recent_deals ($token=null) {

        $ch = curl_init("https://api.hubapi.com/deals/v1/deal/recent/modified?hapikey=$token");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $json = curl_exec($ch);

        curl_close($ch);

        return $json;

    }


    /**
     * Create deal
     *
     * @version: 1.0.0
     */

    static public function create_deal ($token=null, $owner=0, $dealname=null, $amount=0, $description=null, $dealtype="existingbusiness", $dealstage="appointmentscheduled") {

        $ch = curl_init("https://api.hubapi.com/deals/v1/deal?hapikey=$token");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "properties" => [
                [
                    "value" => $dealname,
                    "name" => "dealname"
                ],
                [
                    "value" => $dealstage,
                    "name" => "dealstage"
                ],
                [
                    "value" => "default",
                    "name" => "pipeline"
                ],
                [
                    "value" => $owner,
                    "name" => "hubspot_owner_id"
                ],
                [
                    "value" => time(),
                    "name" => "closedate"
                ],
                [
                    "value" => $amount,
                    "name" => "amount"
                ],
                [
                    "value" => $description,
                    "name" => "description"
                ],
                [
                    "value" => $dealtype,
                    "name" => "dealtype"
                ]
            ]
        ]));

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


    /**
     * Update deal status
     *
     * @version: 1.0.0
     */

    static public function update_deal_status ($token=null, $deal_id=null, $dealstage="appointmentscheduled") {

        $ch = curl_init("https://api.hubapi.com/deals/v1/deal/$deal_id?hapikey=$token");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "properties" => [
                [
                    "value" => $dealstage,
                    "name" => "dealstage"
                ]
            ]
        ]));

        return json_decode(curl_exec($ch));

        curl_close($ch);

    }


}