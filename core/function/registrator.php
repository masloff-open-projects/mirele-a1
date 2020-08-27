<?php

/**
 * A set of functions for registering blocks and elements
 * for subsequent rendering on the page.
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */


/**
 * Function for registering a block. As arguments
 * requires a block ID, other functions will then be accessed
 * and the function that will render the block
 *
 * @version: 1.0.0
 * @package: Mirele
 * @author: Mirele
 */

function rosemary_register ($id='null', $function=null, $meta=null) {

    global $rosemary_templates;
    global $rosemary_templates_meta;
    global $rosemary_ready_markup;

    $meta['unique_color'] = '#' . substr(md5($id), 5, 6);

    if (empty($rosemary_templates[$id])) {


        if (ROSEMARY_INSTANCES == 'SMART') {

            /**
             * This cycle is rubber and allows the user to create as many blocks as he wants.
             * It allows you to create an unlimited number of blocks on any page.
             * The logic is this: a page 1 time receives information about the current
             * page layout and receives all the blocks that are on the pages and their number.
             * 1 block is added to each block.
             * It is his user who will create by clicking on the 'Add' button.
             * After creating the block, the procedure will be repeated again and
             * will create several more instances for existing blocks.
             *
             * @version: 1.0.0
             */

            if (isset($rosemary_ready_markup['blocks'][$id]) and is_numeric($rosemary_ready_markup['blocks'][$id])) {

                for ($i = 1; $i <= ($rosemary_ready_markup['blocks'][$id] + 1); $i++) {
                    $rosemary_templates[$id . "@" . $i] = $function;
                }

            } else {
                $rosemary_templates[$id . "@1"] = $function;
            }

        } else {

            /**
             * Without this loop, which creates instances of blocks.
             * Without these instances, there can only be 1 block per page!
             *
             * @version: 1.0.0
             */

            for ($i = 1; $i <= ROSEMARY_INSTANCES; $i++) {
                $rosemary_templates[$id . "@" . $i] = $function;
            }

        }

        $meta = array_merge((array) $meta, array(
            'uid' => sha1($id)
        ));

        $rosemary_templates_meta[$id] = (object) $meta;

    } else {
        return false;
    }

}


/**
 * The function that is responsible for registering the item.
 * It has global variables for interacting with a map of elements.
 * Based on this function, a set will be created in the database
 * block elements for further editing
 *
 * @author: Mirele
 * @version: 1.0.0.
 * @package: Mirele
 */

function rosemary_register_element ($id=null, $data=null, $options=array()) {

    global $rosemary_elements;
    global $rosemary_available_element_types;
    global $rosemary_elements_options;
    global $rosemary_element_options;
    global $rosemary_elements_visible;
    global $rosemary_element_visible;
    global $self_page;
    global $self_block;
    global $page_content;
    global $block_content;
    global $rm;
    global $uid;

    $id = str_ireplace(ROSEMARY_FORBIDDEN_SYMBOLS, '_', $id);
    $element_id = "$self_page:$self_block:$id";

    $rosemary_elements[$self_page][$self_block][$element_id] = $data;

    // Content Registration
    if (!empty($block_content['elements'][$element_id])) {

        $content = $block_content['elements'][$element_id]->element_value;
        $rosemary_elements_options[$element_id] = json_decode($block_content['elements'][$element_id]->element_options);
        $rosemary_element_options = $rosemary_elements_options[$element_id];
        $rosemary_elements_visible[$element_id] = $block_content['elements'][$element_id]->element_visible;
        $rosemary_element_visible = $block_content['elements'][$element_id]->element_visible;

    } else {

        $rm->add_element($element_id, $self_block, $self_page, is_array($data) ? (object) $data : (object) ['value' => 'Edit me', 'type' => 'text', 'visible' => '1'], (object) $options);
        $rosemary_elements_options[$element_id] = (object) $options;
        $rosemary_element_options = (object) $options;
        $rosemary_elements_visible[$element_id] = 1;
        $rosemary_element_visible = 1;

        $content = ((object) $data)->value;
    }

    if ($rosemary_element_visible == '') {
        $content = '';
    }

    // Component Type Registration
    if (!is_array($rosemary_available_element_types)) { $rosemary_available_element_types = array(); }
    if (is_array($data) ) {
        if (!empty($data['type'])) {
            if (!in_array($data['type'], $rosemary_available_element_types)) {
                $rosemary_available_element_types[] = $data['type'];
            }
        }
    }

    $content = apply_filters('rosemary_element_content', $content, $id, $data);

    return do_shortcode(htmlspecialchars_decode($content));

}


/**
 * The function for register template for option
 *
 * @author: Mirele
 * @version: 1.0.0.
 * @package: Mirele
 */

function rosemary_register_option ($option=null, $type="text", $available=array(), $title=false, $note=false) {

    global $rosemary_options;

    return $rosemary_options[$option] = (object) array (
        'avaiable' => $available,
        'note' => $note,
        'type' => $type,
        'title' => $title
    );


}


/**
 * Wrapper for rosemary_register_element function
 */

function rre ($id='null', $data=null, $options=array()){
    return rosemary_register_element($id, $data, $options);
}


/**
 * Function to get registered elements
 * block from memory.
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_register_elements_of_block ($id='null', $page='null') {

    global $rosemary_elements;
    $elements = $rosemary_elements[$page][$id];

    return is_array($elements) ? $elements : false;

}


/**
 * Function for getting possible types of components.
 * These types are registered with the elements and transmitted
 * as a function return in the form of a sheet
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_available_element_types () {

    global $rosemary_available_element_types;

    return is_array($rosemary_available_element_types) ? $rosemary_available_element_types : false;

}


/**
 * Function to get all available
 * templates that are registered within the system
 * and available for rendering
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_available_blocks () {

    global $rosemary_templates;
    global $rosemary_templates_meta;

    return (object) array(
        'blocks_functions' => $rosemary_templates,
        'blocks_meta' => $rosemary_templates_meta
    );

}


/**
 * -
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_block ($id) {

    global $rosemary_templates_meta;

    return (object) $rosemary_templates_meta[$id];

}

function rosemary_get_meta_block_by ($key='uid', $value=null) {

    global $rosemary_templates_meta;

    if (is_array($rosemary_templates_meta) or is_object($rosemary_templates_meta)) {
        foreach ($rosemary_templates_meta as $id => $block) {

            $block = (array) $block;

            if (isset($block[$key]) and $block[$key] == $value) {
                return (object) array_merge((array) $block, array(
                    'id' => $id
                ));
            }
        }
    }

    return false;

}

function rosemary_last_instance ($id=null) {

    global $rosemary_templates;

    if (isset($rosemary_templates) and (is_array($rosemary_templates) or is_object($rosemary_templates))) {

        foreach ($rosemary_templates as $instance => $___) {

            $template = explode('@', $instance)[0];
            $instance_ = (int) explode('@', $instance)[1];

            if ($template == $id) {
                $instance__ = $instance_ + 1;
                if (isset($rosemary_templates[$template . '@' . $instance__])) {
                    continue;
                } else {
                    return $template . '@' . $instance_;
                }
            } else {
                continue;
            }
        }

    } else {
        return false;
    }

}


/**
 * @param $id
 * @return object
 */

function rosemary_get_element_meta ($id='') {

    global $rosemary_elements;
    global $self_page;
    global $self_block;

    if (!empty($id)) {
        return (object) $rosemary_elements[$self_page][$self_block][$id];
    } else {
        return (array) $rosemary_elements[$self_page][$self_block];
    }

}


/**
 * Function to get item options.
 * If you do not pass the block ID, the newly registered block will be used.
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_options ($id=null) {

    global $rosemary_element_options;
    global $rosemary_elements_options;

    if ($id) {

        if (!empty($rosemary_elements_options[$id])) {
            return (object) $rosemary_elements_options[$id];
        } else {
            return false;
        }

    } else {
        return (object) $rosemary_element_options;
    }
}


/**
 * Function to get item options as HTML code.
 * If you do not pass the block ID, the newly registered block will be used.
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_options_html ($options) {

    function form ($options) {

        $content = '<table width="100%" cellspacing="0" cellpadding="5">';

        foreach ($options as $option => $value) {

            $option_ = rosemary_get_option($option);

            if (is_object($option_) and $option_->type == 'choice') {

                $edit = "<select style='float: right;' name='$option'>";

                foreach ($option_->avaiable as $item) {

                    if (is_object($item) or is_array($item)) {

                        $item = (object) $item;

                        $selected = ($item->value == $value ? "selected" : "");
                        $edit .= "<option value='$item->value' $selected>$item->title</option>";

                    } else {

                        $selected = ($item == $value ? "selected" : "");
                        $edit .= "<option value='$item' $selected>$item</option>";

                    }



                }

                $edit .= "</select>";


            } elseif (is_object($option_) and $option_->type == 'number') {

                $edit = "<input value='$value' type='number' name='$option' placeholder='$value' style='float: right;'>";

            } elseif (is_object($option_) and $option_->type == 'float') {

                $edit = "<input value='$value' type='number' name='$option' placeholder='$value' step='$option_->avaiable' style='float: right;'>";

            } elseif (is_object($option_) and $option_->type == 'color') {

                $edit = "<input type='text' value='$value' class='select-color' name='$option' style='float: right;'>";

            } elseif (is_object($option_) and $option_->type == 'hints') {

                $edit = "<div style='float: right;'>";
                $edit .= "<input type='text' value='$value' name='$option' placeholder='$value' max='82' maxlength='82'>";

                if (is_object($option_->avaiable) or is_array($option_->avaiable)) {

                    $edit .= "<div>";
                    foreach ($option_->avaiable as $item) {
                        $edit .= "<a href='javascript:;' data-hint='$item'>$item</a> ";
                    }
                    $edit .= "</div>";

                }
                $edit .= "</div>";

            } elseif (is_object($option_) and $option_->type == 'function') {

                $edit = is_callable($option_->avaiable) ? call_user_func($option_->avaiable, array('option' => $option, 'value' => $value)) : 'Function is not callable';

            } elseif (is_object($option_) and $option_->type == 'image') {

                $edit = "<input type='hidden' value='$value' name='$option'>";

            } else {

                $edit = "<input value='$value' type='text' name='$option' placeholder='$value' max='82' maxlength='82' style='float: right;'>";

            }

            $title = (is_object($option_) and $option_->title and $option_->title != false) ? $option_->title : ucfirst(str_replace("_", " ", $option));
            $note = (is_object($option_) and $option_->note and $option_->note != false) ? "<small><font color='gray'>$option_->note</font></small>" : '';

            $content .= "<tr> 
            
                <td width='50%' valign='center' align='left'>
                    <p>$title</p>
                    $note
                </td>
                
                <td valign='top' align='right'>
                    $edit
                </td>
                
            </tr>";

        }

        $content .= '</table>';

        return $content;

    }

    return form ($options);

}


/**
 * Function to get block visibility.
 * Attention! Use this function after registering a block, as the site may appear
 * artifacts
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_visible ($id=null) {

    global $rosemary_elements_visible;
    global $rosemary_element_visible;

    if ($id) {

        if (!empty($rosemary_elements_visible[$id])) {
            return (object) $rosemary_elements_visible[$id];
        } else {
            return false;
        }

    } else {
        return (object) $rosemary_element_visible;
    }
}


/**
 * Function to get the full block ID
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_full_id ($id=null) {

    global $self_page;
    global $self_block;

    $id = str_ireplace(ROSEMARY_FORBIDDEN_SYMBOLS, '_', $id);

    return "$self_page:$self_block:$id";

}


/**
 * Function for taking a picture
 * published, issued after registration of the element with the type
 * data src
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_single_image ($image="") {

    $image = explode('|', $image);

    foreach ($image as $src) {
        if (!empty($src)) {
            $image = $src;
            break;
        }
    }

    return wp_get_attachment_url($image);

}


/**
 * Function for get registred option
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_get_option ($option="") {

    global $rosemary_options;

    if (!empty($rosemary_options[$option])) {
        return $rosemary_options[$option];
    } else {
        return $rosemary_options;
    }

}


/**
 * Function for setup options for block
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function rosemary_register_block_options ($options=[]) {

    global $self_page;
    global $self_block;
    global $rm;

    $options_ = [];

    foreach ($options as $option => $value) {
        $rm->set_option_of_block($self_page, $self_block, $option, $value);
    }

    foreach ($rm->get_options_of_block($self_page, $self_block) as $option) {
        $options_[$option->block_option] = $option->block_value;
    }

    return $options_;

}


/**
 * Function for get options for block
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 * @param string $page_id
 * @param string $block_id
 * @return array
 */

function rosemary_get_block_options ($page_id='null', $block_id='null') {

    global $rm;

    $options = [];

    foreach ($rm->get_options_of_block($page_id, $block_id) as $option) {
        $options[$option->block_option] = $option->block_value;
    }

    return $options;

}


/**
 * Function on register kit elements
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 * @param string $id
 * @param null $function
 */

function rosemary_register_kit ($id='null', $function=null) {
    if (is_callable($function)) {
        call_user_func($function);
    }
}

function rosemary_page_exists ($id=null) {

    global $rm;
    return !empty($rm->get_page($id));

}

function rosemary_register_demo ($id=null, $data=null, $meta=array()) {

    global $rosemary_demos;
    global $rosemary_demos_meta;

    if (!isset($rosemary_demos[$id]) or empty($rosemary_demos[$id])) {

        $rosemary_demos_meta[$id] = (object) $meta;

    } else {
        return false;
    }

}


function rosemary_te ($html="null") {

    global $rosemary_template_functions;

    $rosemary_template_functions = array(
        'loop' => function ($e=null) {

            if (is_int((int) $e->arguments[0])) {
                $code = "";
                for ($i = 1; $i <= (int) $e->arguments[0]; $i++) {
                    $code .= $e->content;
                }
                return $code;
            }

        },

        'foreach' => function ($e='') {

        }

    );

    $code = $html;

    preg_replace_callback('/\{\{(.*?)\}\}/', function($matches) {
        if (isset($matches[1]) and !empty($matches[1])) {
            return rosemary_register_element($matches[1], array(
                'type' => 'text',
                'value' => 'You can edit this text'
            ));
        }
    },  $code);

    preg_match_all('/@([a-zA-Z0-9-]*[a-zA-Z0-9]);/', $code, $get_vars);

    foreach ($get_vars[1] as $var) {
        preg_match_all ("/@$var:\s(.+?)\;/", $code, $set_vars);
        var_dump($set_vars);
    }
//    preg_match_all('/@([a-zA-Z0-9-]*[a-zA-Z0-9]):\s(.+?)\;/', $code, $vars);
//    var_dump($vars);

//    $code = preg_replace_callback('/@([a-zA-Z0-9-]*[a-zA-Z0-9]);/', function($matches) {
//        if (isset($matches[1]) and !empty($matches[1])) {
//            var_dump($matches);
//        }
//    },  $code);

    $code = preg_replace_callback('/([a-zA-Z0-9-]*[a-zA-Z0-9])\s\((.*?)\)\s\{([^}]+)\}/', function($matches) {

        global $rosemary_template_functions;

        if (isset($rosemary_template_functions[$matches[1]])) {
            if (is_callable($rosemary_template_functions[$matches[1]])) {
                return call_user_func($rosemary_template_functions[$matches[1]], (object) array(
                    'arguments' => strpos($matches[2], 'as') !== false ? preg_split('/(.+?)\sas\s(.+?)/', $matches[2]) : explode(",", $matches[2]),
                    'content' => $matches[3]
                ));
            }
        }

    },  $code);

    return $code;

    //    echo preg_replace_callback('/{{(.*?)}}/', function($matches) {
//
//        global $__ELEMENTS__;
//
//        preg_match('/\{\{(.*?)\}\}/',$matches[0],$out);
//
//        $call = explode('.', $out[1]);
//
//        if (isset($call[1]) and $call[1] == 'option') {
//            $options = (array) rosemary_get_options(rosemary_get_full_id($call[0]));
//            return $options[$call[2]];
//        }
//
//        return rre($call[0], [
//            'type' => $__ELEMENTS__[$call[0]]->type,
//            'value' => $__ELEMENTS__[$call[0]]->value
//        ], $__ELEMENTS__[$call[0]]->options);
//
//    }, $__TEMPLATE__);

}
