<?php


namespace Mirele\Framework;


use voku\helper\AntiXSS;

class TWIG
{

    public function xxs($string) {
        return (new AntiXSS())->xss_clean($string);
    }

    public function header () {
        get_header();
    }

    public function e ($text, $namespace='Main') {
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
    function do_action ($action='', $data='', $attr='') {
        return do_action ($action, $data, $attr);
    }

    #
    function woocommerce_header () {
        woocommerce_page_title();
    }

    function is_realy_woocommerce_page () {
        if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
            return true;
        }
        $woocommerce_keys = array ( "woocommerce_shop_page_id" ,
            "woocommerce_terms_page_id" ,
            "woocommerce_cart_page_id" ,
            "woocommerce_checkout_page_id" ,
            "woocommerce_pay_page_id" ,
            "woocommerce_thanks_page_id" ,
            "woocommerce_myaccount_page_id" ,
            "woocommerce_edit_address_page_id" ,
            "woocommerce_view_order_page_id" ,
            "woocommerce_change_password_page_id" ,
            "woocommerce_logout_page_id" ,
            "woocommerce_lost_password_page_id" ) ;

        foreach ( $woocommerce_keys as $wc_page_id ) {
            if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                return true ;
            }
        }
        return false;
    }

    #
    function posts () {

        if (have_posts()) {
            while (have_posts()) {
                if (WOOCOMMERCE_SUPPORT and $this->is_realy_woocommerce_page()) {
                    the_post();
                    the_content();
                } else {
                    the_title();
                    the_post();
                    the_content();
                }
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

        $table = WPGNU::Table();

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
            'cb'            =>  '<input type="checkbox" />',
            'id'            => 'ID',
            'name'          => 'Name',
            'status'        => 'Page status',
            'modified'      => 'Page modified',
        ));

        $table->setBulk(array(
            'delte' => 'Delet'
        ));

        foreach ($markup as $name => $data) {

            $data = (object) $data;

            $table->appendData(array(
                'id'    => isset($data->ID) ? $data->ID : 'undefined',
                'name'  => isset($data->post_title) ? $data->post_title : 'undefined',
                'status'  => isset($data->post_status) ? strtoupper($data->post_status) : 'undefined',
                'modified'  => isset($data->post_modified) ? $data->post_modified : 'undefined',
            ));
        }

        $table->prepare_items();
        $table->render();

    }

    # String
    function string ($data) {
        return (new Stringer($data))->get();
    }

    function dump($data) {
        print_r($data);
    }

    function get_the_terms($a, $b) {
        return get_the_terms($a, $b);
    }


    function wc_get_attribute($a) {
        return wc_get_attribute($a);
    }

    function get_term($a) {
        return get_term($a);
    }

    function wp_nonce_field($a, $b) {
        return wp_nonce_field($a, $b);
    }

    function wc_print_notices ($a=false) {
        return wc_print_notices($a);
    }

    function wc_notices () {
        if (WOOCOMMERCE_SUPPORT) {
            return WC()->session->get('wc_notices', array());
        } else {
            return [];
        }
    }

    function products_loop () {

        if ( woocommerce_product_loop() ) {

            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action( 'woocommerce_before_shop_loop' );

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action( 'woocommerce_after_shop_loop' );
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action( 'woocommerce_no_products_found' );
        }

        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );

        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' );

    }

    function nonce () {
        return wp_create_nonce(MIRELE_NONCE);
    }
}