<?php

/**
 * Script for registering custom theme components
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

function mirele_register_component_logic ($id=null, $function=null, $data=[]) {

    global $mirele_theme_components_logic;

    if (is_array($id) or is_object($id)) {
        foreach ($id as $_) {
            if (empty($mirele_theme_components_logic[((object) $data)->type][$_])) {
                $mirele_theme_components_logic[((object) $data)->type][$_] = $function;
            }
        }
    } else {
        if (empty($mirele_theme_components_logic[((object) $data)->type][$id])) {
            $mirele_theme_components_logic[((object) $data)->type][$id] = $function;
        }
    }

}

function mirele_register_component ($id=null, $function=null, $data=[]) {

    global $mirele_theme_components;
    global $mirele_theme_components_meta;

    if (empty($mirele_theme_components[((object) $data)->type][$id])) {
        $mirele_theme_components[((object) $data)->type][$id] = $function;
        $mirele_theme_components_meta[((object) $data)->type][$id] = (object) $data;
    }

}

function mirele_get_components_by_type ($type) {

    global $mirele_theme_components;

    return $mirele_theme_components[$type];

}

function mirele_get_components_logic_by_type ($type) {

    global $mirele_theme_components_logic;

    return $mirele_theme_components_logic[$type];

}

function mirele_execute_component_logic ($type=null, $id=null) {

    global $mirele_theme_components_logic;

    if (!empty($mirele_theme_components_logic[$type][$id])) {

        if (is_callable($mirele_theme_components_logic[$type][$id])) {
            call_user_func($mirele_theme_components_logic[$type][$id], array());
        }

    }

}

function mirele_get_components_by_type_meta ($type=null) {

    global $mirele_theme_components_meta;

    return $mirele_theme_components_meta[$type];

}

function mirele_execute_component ($type=null, $id=null, $attr=null) {
    if (isset(mirele_get_components_by_type ($type)[$id])) {
        if (is_callable(mirele_get_components_by_type ($type)[$id])) {
            echo call_user_func(mirele_get_components_by_type ($type)[$id], $attr);
        }
    }
}
