<!DOCTYPE html>

<?php
if (get_option('mrl_wp_header_enabled', 'true') == 'true') {
    mirele_execute_component_logic('navbar', get_option('mrl_wp_header', 'standart'));
}
?>

<?php
if (get_option('mrl_wp_preloader_enabled', false) == 'true') {
    mirele_execute_component_logic('preloader', get_option('mrl_wp_preloader', 'without'));
}
?>

<?php mirele_execute_component_logic('cookie_box', get_option('mrl_wp_darkness', 'darkness')); ?>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

    global $mdata;
    global $mrouter;
    global $mirele_js_var;

    MPackage::single_font('Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900');

    wp_head();
    do_action('mirele_header');

    /**
     * Disable scaling of the site.
     * It's not always cool when a site gets smeared because of a double tap
     */

    if (!get_option('mrl_wp_user_scalable', false) == 'true') {
        echo "<meta name=\"viewport\" content=\"width=device-width, user-scalable=no\">";
        echo "<script> document.ontouchmove = function(event){event.preventDefault();} </script>";
        echo "<style>body,html {-webkit-overflow-scrolling: touch;}</style>";
    }

    ?>

    <?php if (is_woocommerce()): ?>

        <?php

        global $mdata;

        $__product = woo()->product;

        if (isset($__product->get_name) and is_callable($__product->get_name)) {
            $seo_keys = array(
                '{product-name}' => woo()->product->get_name(),
                '{product-slug}' => woo()->product->get_slug(),
                '{product-sku}' => woo()->product->get_sku(),
                '{product-price}' => woo()->product->get_price(),
                '{product-regular-price}' => woo()->product->get_regular_price(),
                '{product-sale-price}' => woo()->product->get_sale_price(),
                '{product-total-sales}' => woo()->product->get_total_sales(),
                '{product-stock-quantity}' => woo()->product->get_stock_quantity(),
                '{product-stock-status}' => woo()->product->get_stock_status(),
                '{product-backorders}' => woo()->product->get_backorders(),
                '{product-purchase-note}' => woo()->product->get_purchase_note(),
                '{product-review-count}' => woo()->product->get_review_count(),
            );

            $author = strtr(get_option('mrl_wp_seo_woo_author', $mdata->get('seo_author')), $seo_keys);
            $description = strtr(get_option('mrl_wp_seo_woo_description', $mdata->get('seo_description')), $seo_keys);
            $keywords = strtr(get_option('mrl_wp_seo_woo_keywords', $mdata->get('seo_keywords')), $seo_keys);
        }

        ?>

        <meta name="description" content="<?php echo $author; ?>">
        <meta name="keywords" content="<?php echo $description; ?>">
        <meta name="author" content="<?php echo $keywords; ?>>">
    <?php else: ?>
        <meta name="description" content="<?php global $mdata; echo $mdata->get('seo_description'); ?>">
        <meta name="keywords" content="<?php global $mdata; echo $mdata->get('seo_keywords'); ?>">
        <meta name="author" content="<?php global $mdata; echo $mdata->get('seo_author'); ?>">
    <?php endif; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body <?php body_class($mdata->get('body_classes')); ?> <?php echo $mdata->get('body_attrs', '');?>>

<?php
if (get_option('mrl_wp_preloader_enabled', 'true') == 'true') {
    is_page_template(ROSEMARY_CANVAS) ? mirele_execute_component('preloader', get_option('mrl_wp_preloader', 'without')) : false;
}
?>

<?php wp_body_open(); ?>

<?php
if (get_option('mrl_wp_header_enabled', 'true') == 'true') {
    mirele_execute_component ('navbar', get_option('mrl_wp_header', 'standart'));
}
?>
