<?php


class MDemos
{

    static function all () {

        global $rosemary_demos_meta;
        return $rosemary_demos_meta;

    }

    static function export ($page=null, $data=array()) {

        if (is_array($data) or is_object($data)) {

            global $self_page;

            $self_page = $page;

            $data = (object) $data;

            foreach ($data as $__) {
                $template = rosemary_get_meta_block_by ('uid', $__);

                if (is_array($template) or is_object($template)) {
                    rosemary_template(rosemary_last_instance($template->id), null, 'depressed');
                }
            }

        } else {

            return false;

        }

    }

}