<?php
load_theme_textdomain('mirele', TEMPLATE_PATH . '/Languages');


//add_image_size('portfolio-full', 940, 400, true);
//add_image_size('recent-posts', 660, 405, true);

add_action('init', function () {

    # Turn off unnecessary scripts through filters.
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');

});

add_action('widgets_init', function () {

    # Let's register the Navbars
    register_nav_menus(array(
        'navbar' => 'Navbar'
    ));

    register_nav_menus(array(
        'footer' => 'Footer'
    ));

    # Let`s register sidebar
    register_sidebar(array(
        'name' => __('Right sidebar (page)', ''),
        'id' => 'right-side-page',
        'description' => __('Sidebar is displayed on the pages', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Left sidebar (page)', ''),
        'id' => 'left-side-page',
        'description' => __('Sidebar is displayed on the pages', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Right sidebar (post)', ''),
        'id' => 'right-side-single',
        'description' => __('Sidebar is displayed on the blog post page.', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Left sidebar (post)', ''),
        'id' => 'left-side-single',
        'description' => __('Sidebar is displayed on the blog post page.', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Right sidebar (product)', ''),
        'id' => 'right-side-product',
        'description' => __('Sidebar is displayed on the product page.', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Left sidebar (product)', ''),
        'id' => 'left-side-product',
        'description' => __('Sidebar is displayed on the product page.', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Right sidebar (list products)', ''),
        'id' => 'right-side-list-products',
        'description' => __('Sidebar is displayed on the products list page.', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Left sidebar (list products)', ''),
        'id' => 'left-side-list-products',
        'description' => __('Sidebar is displayed on the products list page.', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Under the product (single product)', ''),
        'id' => 'single-product-bar-after-form',
        'description' => __('', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Under the product page (single product)', ''),
        'id' => 'single-product-bar-after-page',
        'description' => __('', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Over product (single product)', ''),
        'id' => 'single-product-bar-before-form',
        'description' => __('', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer #1', ''),
        'id' => 'footer-1',
        'description' => __('Sidebar is displayed on footer section', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer #2', ''),
        'id' => 'footer-2',
        'description' => __('Sidebar is displayed on footer section', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer #3', ''),
        'id' => 'footer-3',
        'description' => __('Sidebar is displayed on footer section', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer #4', ''),
        'id' => 'footer-4',
        'description' => __('Sidebar is displayed on footer section', ''),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    # Let`s register wp supports
    add_theme_support('post-thumbnails');
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width' => 300,

        'product_grid' => array(
            'default_rows' => 8,
            'min_rows' => 2,
            'max_rows' => 8,
            'default_columns' => 4,
            'min_columns' => 4,
            'max_columns' => 12,
        ),
    ));

    add_image_size('mirele-thumbnail', 80, 80);

});

function is_wc ()
{
    if (is_admin()) {
        return false;
    }
    if (function_exists("is_woocommerce") && is_woocommerce()) {
        return true;
    }
    $woocommerce_keys = array("woocommerce_shop_page_id",
        "woocommerce_terms_page_id",
        "woocommerce_cart_page_id",
        "woocommerce_checkout_page_id",
        "woocommerce_pay_page_id",
        "woocommerce_thanks_page_id",
        "woocommerce_myaccount_page_id",
        "woocommerce_edit_address_page_id",
        "woocommerce_view_order_page_id",
        "woocommerce_change_password_page_id",
        "woocommerce_logout_page_id",
        "woocommerce_lost_password_page_id");

    foreach ($woocommerce_keys as $wc_page_id) {
        if (get_the_ID() == get_option($wc_page_id, 0)) {
            return true;
        }
    }
    return false;
}