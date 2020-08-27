<?php


namespace Mirele\Framework;


class TWIG
{

    public function header () {
        get_header();
    }

    public function e ($text, $namespace='mirele') {
        return _e($text, $namespace);
    }

    public function esc_url ($url) {
        return esc_url($url);
    }

    public function wp_head () {
        wp_head();
    }

    public function wp_footer () {
        wp_footer();
    }

    public function language_attributes () {
        language_attributes();
    }

    public function bloginfo (string $name) {
        bloginfo($name);
    }

    public function wp_body_open () {
        wp_body_open();
    }

    public function footer () {
        get_footer();
    }

    #
    function settings_fields ($id='') {
        return settings_fields($id);
    }

    #
    function date_format ($time='', $format="Y/m/d H:i:s") {
        return date_format(date_create($time), $format);
    }

    #
    function get_option ($option="", $default=false) {
        return get_option($option, $default);
    }

    #
    function do_action ($action='', $data='') {
        return do_action ($action, $data);
    }

    #
    function woocommerce_header () {
        woocommerce_page_title();
    }

    #
    function page () {

        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_title();
                the_content();
            }
        }

    }

    #
    function canvas () {

        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        }

    }

    #
    function rosemary_pages_table ($markup) {

        $table = \Mirele\Framework\MWPUI::Table();

        $table->setActionsOnID (array(
            'edit' => sprintf('<a href="{URL}?page={PAGE}&page_id={ID}">Edit</a>', MIRELE_URL, MIRELE_GET['page']),
            'view' => sprintf('<a href="{URL}?page={PAGE}&page_id={ID}">Create WP page</a>', MIRELE_URL, MIRELE_GET['page']),
            'trash' => sprintf('<a href="{URL}?page={PAGE}&page_id={ID}">Delete</a>', MIRELE_URL, MIRELE_GET['page']),
        ));


        $table->setSortableColumns(array(
            'name'  => array('name', false),
            'id'    => array('id', false),
            'count' => array('count', false),
        ));
        $table->setColumns(array(
            'id'          => 'ID',
            'name'        => 'Name',
            'count'       => 'Blocks count',
            'shortcode'   => 'Shortcode'
        ));

        foreach ($markup as $name => $data) {
            $table->appendData(array(
                'id'    => isset($data['page']['id']) ? $data['page']['id'] : 'undefined',
                'name'  => $name,
                'count' => count($data) - 1,
                'shortcode' => "<code>[rosemary page=\"$name\"]</code>"
            ));
        }

        $table->prepare_items();
        $table->render();

    }

}