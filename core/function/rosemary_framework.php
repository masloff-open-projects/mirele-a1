<?php

function rf_e () {

}

function rf_text ($id='default_rf_component', $default_text='Edit me', $options=array()) {

    if (function_exists('rosemary_register_element')) {

        global $mstyler;

        $content = rosemary_register_element ($id, array(
            'type' => 'text',
            'value' => $default_text
        ), array_unique(array_merge(array(
            'font_size_em' => '1',
            'font_color' => '',
            'font' => 'Roboto',
            'font_weight' => 'normal',
            'animate' => 'none',
        ), is_array($options) ? $options : [])));

        $options = (object) rosemary_get_options();

        $mstyler->register('mirele_canvas', "#mirele_styler_$id", array(
            'color' => isset($options->font_color) ? $options->font_color : '',
            'font-size' => (isset($options->font_size_em) ? $options->font_size_em : '') . "em",
            'font-weight' => (isset($options->font_weight) ? $options->font_weight : ''),
        ));

        MPackage::single_font($options->font);

        ?>
        <span id="mirele_styler_<?php echo $id?>"><?php echo $content?></span>
        <?php

    } else {
        return false;
    }

}