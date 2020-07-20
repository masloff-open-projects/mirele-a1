<?php

/**
 * The script responsible for rendering the page.
 * Data from render functions is transferred to
 * Shortcodes, on the main page, if necessary.
 *
 * So its render can be displayed in a variable
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */


/**
 * Register a template in the system. Based on registered
 * The final page will be generated through this template function.
 * Patterns are not stored in the database.
 *
 * * Attention! The function does NOT check if there is a template function passed to the registrar as an attribute
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_template ($id=null, $body=null, $priority='classic') {

    global $rosemary_templates;
    global $self_block;
    global $uid;
    global $mpackage;

    $uid++;

    if (isset($rosemary_templates[$id]) and !empty($rosemary_templates[$id]) and is_callable($rosemary_templates[$id])) {

        $mpackage->execute ('template', explode("@", $id)[0]);

        $self_block = $id;

        switch ($priority) {


            /**
             * Outputs a template render to the main thread.
             * Using the function is not recommended for
                     * registrar processing, since the screen will be
                     * filled with template.
             */

            case 'classic':

                return call_user_func($rosemary_templates[$id], $body);

                break;


            /**
             * Suppression of render output.
             * Vanimanie! It is not recommended to use the function
                     * without acute need and with the possibility of getting a conclusion
                     * to the main thread
             */

            case 'depressed':

                @ob_start();
                call_user_func($rosemary_templates[$id], $body);
                @ob_end_clean();

                @ob_end_flush();
                @ob_flush();
                @flush();
                // @ncurses_clear();

                break;


            case 'fork':

                if (function_exists('pcntl_fork') and extension_loaded('pcntl')) {

                    $pid = pcntl_fork();
                    if ($pid == -1) {
                        return false;
                    } else if ($pid) {
                        // we are the parent
                        call_user_func($rosemary_templates[$id], $body);
                        pcntl_wait($status);
                    } else {
                        call_user_func($rosemary_templates[$id], $body);
                    }

                } else {
                    return false;
                }

        }

        return true;

    } else {
        return false;
    }

}


/**
 * Function for rendering a page based on
 * "Page Collection" data and database block data
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_page ($page_id='null', $priority='classic') {

    function main ($page_id='null') {

        global $rm;
        global $self_page;
        global $self_block;
        global $page_content;
        global $block_content;

        $page_content = $rm->get_page($page_id);

        $self_page = $page_id;

        foreach ($rm->get_page($page_id) as $page => $body) {

            $block_content = $body;
            $self_block = $body['block']['id'];
            rosemary_template($page, $body);

        }
    }

    switch ($priority) {


        /**
         * Outputs a template render to the main thread.
         * Using the function is not recommended for
                 * registrar processing, since the screen will be
                 * filled with template.
         */

        case 'classic':

            main ($page_id);

            break;


        /**
         * Suppression of render output.
         * Vanimanie! It is not recommended to use the function
                 * without acute need and with the possibility of getting a conclusion
                 * to the main thread
         */

        case 'depressed':

            @ob_start();
            @main ($page_id);
            @ob_end_clean();

            @ob_end_flush();
            @ob_flush();
            @flush();
            // @ncurses_clear();

            break;
    }

}
