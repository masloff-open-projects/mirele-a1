<?php

/**
 *
 */
function MIHubSpot_ajax()
{

    /**
     * Register AJAX methods for
     *  * Token authentication
     *  * treatment of user information, etc.
     *
     * @author: Mirele
     * @package: HubSpot
     * @version 1.0.0
     */

    /**
     * Authorization of the user with obtaining data about him.
     *  * Based on this request, authorization works
     *  * on the integration page in the WordPress admin area
     *
     * @author: Mirele
     * @package: HubSpot
     * @version 1.0.0
     */

    add_action('wp_ajax_app_integration_hubspot_auth', function () {

        ajax_protect() or die();

        MIRELE_INTEGRATION_HUBSPOT or die();

        wp_send_json(MIHubSpot::account($_POST['token']));

    });


    /**
     *
     *
     * @author: Mirele
     * @package: HubSpot
     * @version 1.0.0
     */

    function ajax_integrate_hubspot_submit()
    {

        ajax_protect() or die();

        MIRELE_INTEGRATION_HUBSPOT or die();

        wp_send_json(MIHubSpot::submit_form(get_option('mrltkn_hs', false), $_POST['portal_id'], $_POST['guid'], $_POST['json'] ? json_decode(base64_decode($_POST['json'])) : $_POST['data']));

    }

    add_action('wp_ajax_app_integration_hubspot_submit', 'ajax_integrate_hubspot_submit');
    add_action('wp_ajax_nopriv_app_integration_hubspot_submit', 'ajax_integrate_hubspot_submit');

}

function MIMailChimp_ajax()
{

    /**
     * Register AJAX methods for
     *  * Token authentication
     *  * treatment of user information, etc.
     *
     * @author: Mirele
     * @package: MailChimp
     * @version 1.0.0
     */

    /**
     * Authorization of the user with obtaining data about him.
     *  * Based on this request, authorization works
     *  * on the integration page in the WordPress admin area
     *
     * @author: Mirele
     * @package: MailChimp
     * @version 1.0.0
     */

    add_action('wp_ajax_app_integration_mailchimp_auth', function () {

        ajax_protect() or die();

        MIRELE_INTEGRATION_MAILCHIMP or die();

        wp_send_json(MIMailChimp::account($_POST['token']));

    });


    /**
     * Create a new user as a subscriber
     *
     * @author: Mirele
     * @package: MailChimp
     * @version 1.0.0
     */

    function ajax_integrate_mailchimp_subscribe()
    {

        ajax_protect() or die();

        MIRELE_INTEGRATION_MAILCHIMP or die();

        wp_send_json(MIMailChimp::new_sbscribe(get_option('mrltkn_mc', false), $_POST['list'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['phone']));

    }

    add_action('wp_ajax_app_integration_mailchimp_subscribe', 'ajax_integrate_mailchimp_subscribe');
    add_action('wp_ajax_nopriv_app_integration_mailchimp_subscribe', 'ajax_integrate_mailchimp_subscribe');

}

/**
 *
 */

function MAjax()
{

    /**
     * Register AJAX hooks to work in asynchronous mode
     *  * with individual system components.
     *
     * @author: Mirele
     * @version: 1.0.0
     * @package: Mirele
     */

    function ajax_protect()
    {
        return user_can(wp_get_current_user()->ID, 'manage_options');
    }

    /**
     * Function for saving block elements.
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_save_block', function () {

        ajax_protect() or die();

        global $rm;

        /**
         * Translation of settings into a readable form for the program
         *      * After this procedure it will be possible to work with them - they will
         *      * carefully sorted
         *
         * @version: 1.0.0
         * @executetime: Light speed
         */

        $settings = [];

        foreach ($_POST as $key => $value) {

            if ($key == 'action') {
                continue;
            }

            $element = explode('/', $key);
            $id = $element[0];
            $data = $element[1];

            $settings[$id][$data] = htmlspecialchars($value);
        }


        /**
         * Saving settings in the system.
         *      * The processed array is used as input
         *      * form list
         *
         * @version: 1.0.0
         * @executetime: 0.0084 s
         */

        foreach ($settings as $id => $value) {
            $rm->update_element($id, (object)$value);
        }

        die();
    });


    /**
     * Function for create new block.
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_add_block', function () {

        ajax_protect() or die();

        global $self_page;

        $self_page = $_POST['page'];

        initialize_templates(true);

        if (!rosemary_template($_POST['block'])) {
            die('template.no.display');
        } else {
            die('template.is.display');
        }

        die();

    });


    /**
     * Function for delete block.
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_remove_block', function () {

        ajax_protect() or die();

        global $rm;

        wp_send_json([
            'status' => $rm->remove_block($_POST['page'], $_POST['block'])
        ]);

    });


    /**
     * Function for edit element from UI.
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_edit_element', function () {

        ajax_protect() or die();

        global $rm;

        wp_send_json([
            'status' => $rm->remove_block($_POST['page'], $_POST['block'])
        ]);

    });


    /**
     * Function for updating block indices
     * gets a JSON string as INDEX => BLOCK
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_save_index', function () {

        ajax_protect() or die();

        global $rm;

        $json = json_decode(base64_decode($_POST['blocks']));

        if ($json) {
            foreach ($json as $block => $index) {
                $rm->change_index_block($block, $index, $_POST['page']);
            }
        }

        wp_send_json([
            'status' => 1,
            'r' => base64_decode($_POST['blocks'])
        ]);

    });


    /**
     * Function to delete the page.
     *  * All shortcodes on the pages will be
     *  * unavailable after deleting page
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_remove_page', function () {

        ajax_protect() or die();

        global $rm;

        wp_send_json([
            'status' => $rm->remove_page($_POST['page'])
        ]);

        die();

    });


    /**
     * The function creates a WordPress page and embeds a shortcode there.
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_create_wp_page', function () {

        ajax_protect() or die();

        global $rm;

        $page = $_POST['page'];

        $new_page_id = wp_insert_post(array(
            'post_title' => ucfirst($_POST['page']),
            'post_type' => 'page',
            'post_name' => strtolower($_POST['page']),
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_content' => '',
            'post_status' => 'publish',
            'menu_order' => 0,
            'post_content' => "[rosemary page='$page']",
            'page_template' => ROSEMARY_CANVAS
        ));

        wp_send_json([
            'status' => $new_page_id,
            'url' => get_permalink($new_page_id)
        ]);

        die();

    });


    /**
     * Function to get all available registered templates
     *  * inside the system at the time of the request
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_get_available_blocks', function () {

        ajax_protect() or die();

        initialize_templates(true);

        wp_send_json([
            'status' => 'success',
            'body' => rosemary_get_available_blocks()
        ]);

        die();

    });


    /**
     * Function to get information about the block.
     *  * No need to use it in a loop, for
     *  * getting information about blockages is generally better
     *  * use the function above
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_get_block_info', function () {

        ajax_protect() or die();

        initialize_templates(true);

        wp_send_json([
            'status' => 'success',
            'body' => rosemary_get_block($_POST['id'])
        ]);

        die();

    });


    /**
     * Function for getting markup of all page blocks
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_export_blocks', function () {

        ajax_protect() or die();

        global $rm;

        wp_send_json([
            'status' => 'success',
            'body' => $rm->get_page($_POST['page'])
        ]);

        die();

    });


    /**
     * Function for import blocks
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_import_blocks', function () {

        ajax_protect() or die();

        if ($_POST['page'] && $_POST['blocks']) {

            global $rm;

            $rm->remove_page($_POST['page']);

            foreach (json_decode(base64_decode($_POST['blocks'])) as $block_id => $block_body) {

                foreach ($block_body->elements as $element_id => $element_body) {

                    $element_id = explode(':', $element_id);
                    $element_id[0] = $_POST['page'];
                    $element_id = join(":", $element_id);

                    $rm->add_element($element_id, $block_id, $_POST['page'], (object)array(
                        'value' => $element_body->element_value,
                        'visible' => $element_body->element_visible,
                        'type' => $element_body->element_type
                    ), json_decode($element_body->element_options), json_decode($element_body->block_options));
                }

                if (isset($block_body->block->options)) {
                    foreach ($block_body->block->options as $option) {
                        $rm->set_option_of_block($_POST['page'], $option->block_id, $option->block_option, $option->block_value);
                    }
                }

            }

            wp_send_json([
                'status' => 'imported'
            ]);

        } else {
            wp_send_json([
                'status' => 'pass'
            ]);
        }

        wp_send_json([
            'status' => 'pass'
        ]);

        die();

    });


    /**
     * Function to get item options
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_options_element', function () {

        ajax_protect() or die();

        initialize_templates(true);

        rosemary_page($_POST['page'], 'depressed');

        wp_send_json([
            'body' => rosemary_get_options($_POST['id']),
            'html' => rosemary_options_html(rosemary_get_options($_POST['id']))
        ]);

        die();

    });


    /**
     * Function to get block options
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_options_block', function () {

        ajax_protect() or die();

        wp_send_json([
            'body' => rosemary_get_block_options($_POST['page'], $_POST['id']),
            'html' => rosemary_options_html(rosemary_get_block_options($_POST['page'], $_POST['id']))
        ]);

        die();

    });


    /**
     * Function to set new options for element
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_save_options', function () {

        ajax_protect() or die();

        global $rm;

        foreach (json_decode(base64_decode($_POST['options'])) as $option => $value) {
            $rm->update_option_of_element(false, $_POST['id'], $option, $value);
        }

        wp_send_json([
            'status' => $rm->update_options($_POST['id'], json_decode(base64_decode($_POST['options'])))
        ]);

        die();

    });


    /**
     * Function to set new options for block
     *  *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_save_options_block', function () {

        ajax_protect() or die();

        global $rm;

        $returns = [];

        foreach (json_decode(base64_decode($_POST['options'])) as $option => $value) {
            $returns[$option] = $rm->update_option_of_block($_POST['page'], $_POST['id'], $option, $value);
        }

        wp_send_json([
            'status' => $returns
        ]);

        die();

    });


    /**
     * Function to get all
     *  * active pages
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_editor_get_pages', function () {

        ajax_protect() or die();

        global $rm;

        wp_send_json(array_keys($rm->markup()));

    });


    /**
     *  * A method is a method for development.
     *  * It is not dangerous, but all developer functions can be disabled
     *  * Used to get information about a file by name without .php
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_developer_get_file', function () {

        ajax_protect() or die();

        ROSEMARY_DEVELOPER_MODE or die();

        $file = RDevelop::get_file($_POST['file']);

        wp_send_json(array(
            'content' => $file,
            'content_base64' => base64_encode($file),
        ));

    });


    /**
     *  * A method is a method for development.
     *  * It is not dangerous, but all developer functions can be disabled
     *  * Used to save file
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_developer_write_file', function () {

        ajax_protect() or die();

        ROSEMARY_DEVELOPER_MODE or die();

        if (isset($_POST['noRewrite'])) {

            wp_send_json(array(
                'status' => RDevelop::write_file_safe($_POST['file'], base64_decode($_POST['content']))
            ));

        } else {
            wp_send_json(array(
                'status' => RDevelop::write_file($_POST['file'], base64_decode($_POST['content']))
            ));
        }


    });


    /**
     *  * Method for searching for blocks in the repository
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_market_search', function () {

        ajax_protect() or die();

        wp_send_json(MMarket::search('block', $_POST['search']));

    });


    /**
     *  * Method for installing packages from outside sources
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_market_install', function () {

        ajax_protect() or die();

        $return = MAccount::execute(function () {
            return MMarket::install_from_url($_POST['url']);
        }, $_POST['password']);


        switch ($return) {

            case MAUTH_ERROR_PASSWORD:

                die(json_encode(array(
                    'mirele_auth' => 'error_password'
                )));

                break;

            case MAUTH_ERROR_NOT_ACCOUNT:

                die(json_encode(array(
                    'mirele_auth' => 'no_registred'
                )));

                break;

            default:

                die(json_encode($return));

                break;

        }

    });

    /**
     * Method for register new password
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    add_action('wp_ajax_mirele_account_register', function () {

        ajax_protect() or die();

        if (!MAccount::is_registered()) {

            wp_send_json(array(
                'auth' => MAccount::register($_POST['password'])
            ));

        }

    });


    /**
     *  * Method for get json data of Kristen gallery
     *
     * @version: 1.0.0
     * @package: Mirele
     * @author: Mirele
     */

    function gallery_get()
    {

        wp_send_json(array(
            'gallery' => get_option('kristen_gallery_grid', array())
        ), 200);

    }

    add_action('wp_ajax_kristen_get', 'gallery_get');
    add_action('wp_ajax_nopriv_kristen_get', 'gallery_get');

}