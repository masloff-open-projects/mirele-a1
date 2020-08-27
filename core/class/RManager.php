<?php

/**
 * Rosemary (Mirele builder) Block Management Class.
 *
 * * WARNING: Linguistic shock may occur from reading comments
 *
 * @author: Mirele
 * @package: Rosemary
 * @version: 1.0.0
 */

class RManager {

    /**
     * Get all the layout of blocks and components inside
         * of each block. Decency is also provided,
         * according to the order inside the visual editor
     *
     * @version: 1.0.0
     * @executetime: 0.0021 s
     */

    public function markup () {

        global $wpdb;

        $markup = array();

        $base = $wpdb->get_results("SELECT * FROM `rosemary_elements`");
        foreach ($base as $data) {
            if ($data->block_id && $data->element_id && $data->page_id) {
                $markup[$data->page_id][$data->block_id]['elements'][$data->element_id] = $data;
                $markup[$data->page_id]['page']['id'] = $data->page_id;
                $markup[$data->page_id][$data->block_id]['block']['id'] = $data->block_id;
                $markup[$data->page_id][$data->block_id]['block']['index'] = $data->block_index;
                $markup[$data->page_id][$data->block_id]['block']['visible'] = $data->block_visible;
            }
        }

        return $markup;

    }


    /**
     * Get all blocks in sorted form and with meta
         * information is not a problem. Bridge function receives data with 'Markup'
         * and wraps them in the desired wrapper
     *
     * @version: 1.0.0
     * @executetime: 0.0019 s
     */

    public function bridge_content ($type='classic') {

        switch ($type) {
            case 'classic':
                $markup = self::markup();
                $content = [];

                foreach ($markup as $i => $block) {
                    $block = array_shift($block);

                    if ($block['info']['block_visible'] == '1') {
                        $content[$block['info']['block_id']] = $block;
                    }
                }

                return $content;
                break;

            default:
                return trigger_error('Non-bridge type');
                break;
        }

    }


    /**
     * Function for markup tables in a WordPress database.
         * It creates a table if it is not in the database. Re-layout
         * existing table is not possible
     *
     * @version: 1.0.0
     * @executetime: 0.001 s
     */

    public function database_markup ($varchar_size=ROSEMARY_VARCHAR_SIZE_DB, $int_size=ROSEMARY_VARCHAR_INT_DB) {

        global $wpdb;

        $elements = $wpdb->get_results("CREATE TABLE IF NOT EXISTS `rosemary_elements` (
            `page_id` VARCHAR($varchar_size) NULL DEFAULT 'default',
            
            `block_id` VARCHAR($varchar_size) NULL DEFAULT 'default',
            `block_index` INT($int_size) NULL DEFAULT '100',
            `block_visible` INT($int_size) NULL DEFAULT '1',
            `block_options` VARCHAR($varchar_size) NULL DEFAULT '{}',

            `element_id` VARCHAR($varchar_size) NOT NULL DEFAULT 'default',
            `element_visible` VARCHAR($varchar_size) NOT NULL DEFAULT '1',
            `element_value` VARCHAR($varchar_size) NULL DEFAULT 'Default text',
            `element_type` VARCHAR($varchar_size) NULL DEFAULT 'text',
            `element_options` VARCHAR($varchar_size) NULL DEFAULT '{}')");

        $blocks = $wpdb->get_results("CREATE TABLE IF NOT EXISTS `rosemary_blocks_meta` (
            `page_id` VARCHAR($varchar_size) NULL DEFAULT 'default',
            
            `block_id` VARCHAR($varchar_size) NULL DEFAULT 'default',
            `block_option` VARCHAR($varchar_size) NULL DEFAULT 'default',
            `block_value` VARCHAR($varchar_size) NULL DEFAULT 'default')");

        $elements_meta = $wpdb->get_results("CREATE TABLE IF NOT EXISTS `rosemary_elements_meta` (
            `page_id` VARCHAR($varchar_size) NULL DEFAULT 'default',
            `block_id` VARCHAR($varchar_size) NULL DEFAULT 'default',
            
            `element_id` VARCHAR($varchar_size) NULL DEFAULT 'default',
            `element_option` VARCHAR($varchar_size) NULL DEFAULT 'default',
            `element_value` VARCHAR($varchar_size) NULL DEFAULT 'default')");

        return (object) array (
            'elements' => $elements,
            'blocks' => $blocks,
            'elements_meta' => $elements_meta
        );

    }


    /**
     * Function to delete a table with data.
         *
         * Attention! The function will delete the entire table, all data will be lost without the possibility
         * recovery
     *
     * @version: 1.0.0
     */

    public function database_truncate () {

        global $wpdb;

        $wpdb->get_results("TRUNCATE TABLE `rosemary_elements`");
        $wpdb->get_results("TRUNCATE TABLE `rosemary_elements_meta`");
        $wpdb->get_results("TRUNCATE TABLE `rosemary_blocks_meta`");

    }


    /**
     * Function for re-partitioning the database.
         *
         * Attention! Function FULLY DELETE TABLE and creates ABSOLUTELY WAY
         * a new table, based on the actual markup database_markup ()
     *
     * @version: 1.0.0
     */

    public function database_remarkup () {

        global $wpdb;

        $wpdb->get_results("DROP TABLE `rosemary_elements`");
        $wpdb->get_results("DROP TABLE `rosemary_elements_meta`");
        $wpdb->get_results("DROP TABLE `rosemary_blocks_meta`");

        return self::database_markup();

    }


    /**
     * The absolute function of getting blocks inside a page by its identifier.
         * If there is a task to correctly receive blocks, as implemented in the block editor
         *
     * @version: 1.0.0
     * @executetime: 0.0012 s
     */

    public function get_page ($page_id='null') {

        global $wpdb;

        $markup = array();

        $base = $wpdb->get_results("SELECT * FROM `rosemary_elements` WHERE page_id='$page_id'");
        foreach ($base as $data) {
            if ($data->block_id && $data->element_id && $data->page_id) {

                $data->element_options = array ();

                foreach (self::get_options_of_element($data->page_id, $data->element_id) as $option) {
                    $data->element_options[$option->element_option] = $option->element_value;
                }

                $data->element_options = json_encode($data->element_options);
                $data->element_options_object = $data->element_options;

                $markup[$data->page_id][$data->block_index][$data->block_id]['elements'][$data->element_id] = $data;
                $markup[$data->page_id][$data->block_index]['page']['id'] = $data->page_id;
                $markup[$data->page_id][$data->block_index][$data->block_id]['block']['id'] = $data->block_id;
                $markup[$data->page_id][$data->block_index][$data->block_id]['block']['index'] = $data->block_index;
                $markup[$data->page_id][$data->block_index][$data->block_id]['block']['visible'] = $data->block_visible;

                ksort($markup[$data->page_id]);
            }
        }

        $content = [];

        if (isset($markup[$page_id])) {

            foreach ($markup[$page_id] as $i => $block) {

                $block = array_shift($block);

                if ($block['block']['visible'] == '1') {
                    $block['block']['options'] = self::get_options_of_block($page_id, $block['block']['id']);
                    $content[$block['block']['id']] = $block;
                }
            }

        }

        return $content;

    }


    /**
     * Function for changing block sequence number
         * when displayed on the page
         *
     * @version: 1.0.0
     */

    public function change_index_block ($id='null', $index=0, $page="null") {

        global $wpdb;

        return $wpdb->get_results(" UPDATE rosemary_elements
                                    SET block_index = $index
                                    WHERE block_id = '$id' AND page_id = '$page';");

    }


    /**
     * Function to remove block information from the database.
     * Attention! The template will not be deleted from the system’s memory,
     * it will only be deleted from the database
         *
     * @version: 1.0.0
     */

    public function remove_block ($page_id='null', $block_id='null') {

        global $wpdb;

        $wpdb->get_results("DELETE FROM `rosemary_blocks_meta`
                                    WHERE block_id = '$block_id' AND page_id = '$page_id';");

        $wpdb->get_results("DELETE FROM `rosemary_elements_meta`
                                    WHERE block_id = '$block_id' AND page_id = '$page_id';");

        return $wpdb->get_results("DELETE FROM `rosemary_elements`
                                    WHERE block_id = '$block_id' AND page_id = '$page_id';");

    }


    /**
     * Function to delete the entire page.
         * Attention! The function will delete the entire page completely. She will stay
         * in the system memory for some time, but all data will be deleted from
         * Database
         *
     * @version: 1.0.0
     */

    public function remove_page ($id='null') {

        global $wpdb;

        $wpdb->get_results("DELETE FROM `rosemary_elements_meta`
                                    WHERE page_id = '$id';");

        return $wpdb->get_results("DELETE FROM `rosemary_elements`
                                    WHERE page_id = '$id';");

    }


    /**
     * Function to replace edit element.
     * As parameters, takes the ID of the element and
         * A set of new parameters.
         * Attention! Old parameters, if empty, will be overwritten by void
     *
     * @version: 1.0.0
     */

    public function update_element ($element_id='null', $data=[]) {

        global $wpdb;


        if (empty($data->type)) {

            return $wpdb->get_results("UPDATE rosemary_elements 
            SET element_value = '$data->value',
                element_visible = '$data->visible'

            WHERE element_id = '$element_id';");

        } else {

            return $wpdb->get_results("UPDATE rosemary_elements 
            SET element_value = '$data->value',
                element_visible = '$data->visible',
                element_type = '$data->type'

            WHERE element_id = '$element_id';");

        }

    }


    /**
     * Function to update item options.
         * Attention! All old options will also be overwritten! All new
         * the object that was transferred will be recorded as new,
         * not editing untouched old options if they were not transferred
         * in the facility
     *
     * @version: 1.0.0
     */

    public function update_options ($element_id='null', $options=[]) {

        global $wpdb;

        $options = json_encode($options);

        return $wpdb->get_results("UPDATE rosemary_elements 
                            SET element_options = '$options'
                            WHERE element_id = '$element_id';");

    }


    /**
     * Function to get all block options on the search page.
     * As a result, the function returns an array in which
     * the keys and values ​​correspond to the block options
     *
     * @version: 1.0.0
     */

    public function get_options_of_block ($page_id='null', $block_id='null') {

        global $wpdb;

        return $wpdb->get_results("SELECT * FROM `rosemary_blocks_meta` 
                            WHERE page_id = '$page_id' AND block_id = '$block_id';");

    }


    /**
     * Function to get single block options on the search page.
     * As a result, the function returns SQL response
     *
     * @version: 1.0.0
     */

    public function get_option_of_block ($page_id='null', $block_id='null', $option='default') {

        global $wpdb;

        return $wpdb->get_results("SELECT * FROM `rosemary_blocks_meta` 
                            WHERE page_id = '$page_id' AND block_id = '$block_id' AND block_option = '$option';");

    }

    public function update_option_of_block ($page_id='null', $block_id='null', $option='default', $value='default') {

        global $wpdb;

        return $wpdb->get_results("UPDATE rosemary_blocks_meta
                            SET block_value = '$value'
                            WHERE page_id = '$page_id' AND block_id = '$block_id' AND block_option = '$option';");

    }

    public function set_option_of_block ($page_id='null', $block_id='null', $option='default', $value='default') {

        global $wpdb;

        if (empty(self::get_option_of_block($page_id, $block_id, $option))) {
            return $wpdb->get_results("INSERT INTO rosemary_blocks_meta (page_id, block_id, block_option, block_value) VALUES ('$page_id', '$block_id', '$option', '$value');");
        } else {
            return false;
        }

    }


    public function get_options_of_element ($page_id='null', $element_id='null') {

        global $wpdb;

        if ($page_id == false) {
            return $wpdb->get_results("SELECT * FROM rosemary_elements_meta 
                            WHERE AND element_id = '$element_id';");
        } else {
            return $wpdb->get_results("SELECT * FROM rosemary_elements_meta 
                            WHERE page_id = '$page_id' AND element_id = '$element_id';");
        }

    }

    public function get_option_of_element ($page_id='null', $element_id='null', $option='default') {

        global $wpdb;

        return $wpdb->get_results("SELECT * FROM rosemary_elements_meta 
                            WHERE page_id = '$page_id' AND element_id = '$element_id' AND element_option = '$option';");

    }

    public function update_option_of_element ($page_id='null', $element_id='null', $option='default', $value='default') {

        global $wpdb;

        if ($page_id == false) {
            return $wpdb->get_results("UPDATE rosemary_elements_meta
                            SET element_value = '$value'
                            WHERE element_id = '$element_id' AND element_option = '$option';");
        } else {
            return $wpdb->get_results("UPDATE rosemary_elements_meta
                            SET element_value = '$value'
                            WHERE page_id = '$page_id' AND element_id = '$element_id' AND element_option = '$option';");
        }

    }

    public function set_option_of_element ($page_id='null', $block_id='null', $element_id='null', $option='default', $value='default') {

        global $wpdb;

        if (empty(self::get_option_of_element($page_id, $element_id, $option))) {
            return $wpdb->get_results("INSERT INTO rosemary_elements_meta (page_id, block_id, element_id, element_option, element_value) VALUES ('$page_id', '$block_id', '$element_id', '$option', '$value');");
        } else {
            return false;
        }

    }


    /**
     * The function of creating an element tied to a block.
     * If an element has already been created, then the request for creation will be rejected.
     *
     * @version: 1.0.0
     */

    public function add_element ($element_id='null', $block='null', $page_id='null', $data = [], $options = array(), $block_options = array ()) {

        global $wpdb;

        $this->database_markup();

        if (!empty($wpdb->get_results("SELECT block_id FROM rosemary_elements WHERE element_id = '$element_id'"))) { return false; }

        $block_index = $wpdb->get_results("SELECT block_index FROM rosemary_elements WHERE block_id = '$block' AND page_id = '$page_id'");

        if (empty($block_index)) {

            if (!empty($data->block_index)) {
                $block_index = $data->block_index;
            } else {
                $block_index = count($wpdb->get_results("SELECT * FROM rosemary_elements WHERE page_id = '$page_id'")) + 3;
            }

        } else {
            $block_index = $block_index[0]->block_index;
        }

        if (isset($data->visible)) {
            $visible = $data->visible;
        } else {
            $visible = '1';
        }


        $block_options = json_encode($block_options);

        if (is_array($options) or is_object($options)) {
            foreach ($options as $option => $value) {
                self::set_option_of_element($page_id, $block, $element_id, $option, $value);
            }
        }

        return $wpdb->get_results("INSERT INTO rosemary_elements (
                                                        block_id,
                                                        block_index,
                                                        block_options,
                                                        page_id,

                                                        element_id,
                                                        element_visible,
                                                        element_value,
                                                        element_type,
                                                        element_options) VALUES (
                                                            
                                                            '$block',
                                                            $block_index,
                                                            '$block_options',
                                                            
                                                            '$page_id',

                                                            '$element_id',
                                                            '$visible',
                                                            '$data->value',
                                                            '$data->type',
                                                            '{}');");

    }

}