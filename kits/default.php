<?php

add_action('init', function() {

    rosemary_register_kit ('default', function () {

        function components () {

            /**
             * Registration of all standard types of ** NavBars **
             *
             * @version 1.0.0
             * @author Mirele
             * @package Mirele
             */

            mirele_register_component_logic('standart', function ($e=null) {

                if (!is_page_template(ROSEMARY_CANVAS)) {
                    global $mdata;
                    $mdata->append('body_classes', ' body-margin-standart-header');
                }

            }, [
                'type' => 'navbar'
            ]);

            mirele_register_component_logic('standart_woo', function ($e=null) {

                if (!is_page_template(ROSEMARY_CANVAS)) {
                    global $mdata;
                    $mdata->append('body_classes', ' body-margin-standart-header');
                }

            }, [
                'type' => 'navbar'
            ]);

            mirele_register_component("standart", function ($e=null) {

                ?>

                <nav class="navbar navbar-glass navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                            <span class="fa fa-bars color-space"></span>
                        </button>
                        <a class="navbar-brand visible-xs" href="#"><b><?php echo get_bloginfo('name'); ?></b></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-main">
                        <?php

                        wp_nav_menu(array(
                            'theme_location' => 'header',
                            'container'=> false,
                            'menu_id' => 'top-nav-ul',
                            'items_wrap' => '<ul class="nav navbar-nav %2$s">%3$s</ul>',
                            'menu_class' => 'top-menu',
                            'walker' => false));

                        ?>
                    </div>
                </nav>

                <?php

            }, [
                'type' => 'navbar',
                'title' => 'Standart Dark/White Navbar'
            ]);

            mirele_register_component("standart_woo", function ($e=null) {

                ?>

                <div class="modal fade" id="quick_basket" tabindex="-1" role="dialog" aria-labelledby="quick_basket" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content woo_quick_basket">

                            <h4>Quick cart <small class="woo_quick_basket_total"></small></h4>

                            <div class="woo_quick_basket_content">

                            </div>

                            <div class="woo_quick_basket-loader">
                                <img src="<?php echo MIRELE_SOURCE_DIR . '/img/loaders/standart.svg'; ?>" alt="loading" width="26px">
                                <small class="woo-loading-text">LOADING</small>
                            </div>

                            <h6 class="woo_quick_basket_go_cart">
                                <a href="<?php echo wc_get_cart_url(); ?>">Go to cart</a>
                            </h6>

                        </div>


                    </div>
                </div>

                <nav class="navbar navbar-glass navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                            <span class="fa fa-bars color-space"></span>
                        </button>
                        <a class="navbar-brand visible-xs" href="#"><b><?php echo get_bloginfo('name'); ?></b></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-main">

                        <?php

                        wp_nav_menu(array(
                            'depth' => 1,
                            'theme_location' => 'header',
                            'container'=> false,
                            'menu_id' => 'top-nav-ul',
                            'items_wrap' => '<ul class="nav navbar-nav %2$s">%3$s</ul>',
                            'menu_class' => 'top-menu',
                            'walker' => false));

                        ?>

                        <ul class="nav navbar-nav navbar-right">

                            <?php if (get_option('woo_quickcart_enabled', 'true') == 'true'): ?>

                                <li>
                                    <a href="javascript:;" data-action="open_quick_cart" data-toggle="modal" data-target="#quick_basket">
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 0.8em;"></i> <span class="visible-xs">Open quick basket</span>
                                        <span> <?php echo number_format(WC()->cart->total, 2) ?> </span>
                                    </a>
                                </li>

                            <?php endif; ?>

                            <li>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                                    <i class="fas fa-user-circle" style="font-size: 0.8em;"></i>
                                    <?php if(wp_get_current_user()->display_name): ?>

                                        <span style="margin-left: 8px;"> <?php echo wp_get_current_user()->display_name; ?> </span>

                                    <?php else: ?>

                                        <span class="visible-xs">Go to account</span>

                                    <?php endif; ?>
                                </a>
                            </li>

                        </ul>

                    </div>
                </nav>

                <?php

            }, [
                'type' => 'navbar',
                'title' => 'Standart Dark/White Navbar with WooCommerce support'
            ]);

            mirele_register_component("flat_static", function ($e=null) {

                ?>

                <nav class="navbar navbar-flat" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                            <span class="fa fa-bars color-space"></span>
                        </button>
                        <a class="navbar-brand visible-xs" href="#"><b><?php echo get_bloginfo('name'); ?></b></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-main">

                        <?php

                        wp_nav_menu(array(
                            'theme_location' => 'header',
                            'container'=> false,
                            'menu_id' => 'top-nav-ul',
                            'items_wrap' => '<ul class="nav navbar-nav %2$s">%3$s</ul>',
                            'menu_class' => 'top-menu',
                            'walker' => false));
                        ?>

                        <ul class="nav navbar-nav navbar-right">
                            <li data-toggle="tooltip" data-html="true" data-placement="bottom" title="Click to open quick basket">
                                <a href="javascript:;" data-action="open_quick_cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>

                <?php

            }, [
                'type' => 'navbar',
                'title' => 'Flat Light Navbar'
            ]);


            /**
             * Registration of all standard types of ** Footers **
             *
             * @version 1.0.0
             * @author Mirele
             * @package Mirele
             */

            mirele_register_component('standart', function ($e=null) {

                ?>

                <footer>

                    <div class="footer">
                        <div class="container">
                            <div class="row">

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-1');
                                    ?>
                                </div>


                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-2');
                                    ?>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="sub-footer">
                        <div class="container">
                            <div class="row">

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-3');
                                    ?>
                                </div>


                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-4');
                                    ?>
                                </div>


                            </div>
                        </div>
                    </div>

                </footer>

                <?php

            }, [
                'type' => 'footer',
                'title' => 'Minimalistic white'
            ]);

            mirele_register_component('darkness', function ($e=null) {

                ?>

                <footer>

                    <div class="footer footer-darkness">

                        <div class="container">
                            <div class="row">

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-1');
                                    ?>
                                </div>


                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-2');
                                    ?>
                                </div>


                            </div>
                        </div>

                        <div class="container">
                            <div class="row">

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-3');
                                    ?>
                                </div>


                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                    dynamic_sidebar('footer-4');
                                    ?>
                                </div>


                            </div>
                        </div>

                    </div>

                </footer>

                <?php

            }, [
                'type' => 'footer',
                'title' => 'Darkness'
            ]);


            /**
             * Registration of all standard types of ** Sidebar **
             *
             * @version 1.0.0
             * @author Mirele
             * @package Mirele
             */

            mirele_register_component('white', function ($e=null) {

                if ($e and true) {
                    dynamic_sidebar($e);
                }

            }, [
                'type' => 'sidebar',
                'title' => 'White'
            ]);


            /**
             * Registration of all standard types of ** Placeholders **
             *
             * @version 1.0.0
             * @author Mirele
             * @package Mirele
             */

            mirele_register_component_logic(['darkness_signature', 'darkness'], function($e=null) {
                global $mrouter;
                $mrouter->register('site', 'css', get_template_directory_uri() . '/source/css/kit/preloader/darkness-dist.css');
            }, [
                'type' => 'preloader'
            ]);

            mirele_register_component_logic(['blur', 'blur_loader'], function($e=null) {
                global $mrouter;
                $mrouter->register('site', 'css', get_template_directory_uri() . '/source/css/kit/preloader/blur-dist.css');
            }, [
                'type' => 'preloader'
            ]);

            mirele_register_component_logic(['orange_cubes', 'blue_cubes'], function($e=null) {
                global $mrouter;
                $mrouter->register('site', 'css', get_template_directory_uri() . '/source/css/kit/preloader/cubes-dist.css');
            }, [
                'type' => 'preloader'
            ]);

            mirele_register_component("orange_cubes", function ($e=null) {

                ?>

                <div class="mirele-preloader orange-cubepreloader" data-animation-out="transparency-out">
                    <div class="orange-cubepreloader-folding-cube">
                        <div class="orange-cubepreloader-cube1 orange-cubepreloader-cube"></div>
                        <div class="orange-cubepreloader-cube2 orange-cubepreloader-cube"></div>
                        <div class="orange-cubepreloader-cube4 orange-cubepreloader-cube"></div>
                        <div class="orange-cubepreloader-cube3 orange-cubepreloader-cube"></div>
                    </div>
                </div>

                <?php

            }, [
                'type' => 'preloader',
                'title' => 'Orange cubes'
            ]);

            mirele_register_component("blue_cubes", function ($e=null) {

                ?>

                <div class="mirele-preloader blue-cubepreloader" data-animation-out="transparency-out">
                    <div class="blue-cubepreloader-body">
                        <span class="span-blue-cubepreloader"></span>
                        <span class="span-blue-cubepreloader"></span>
                        <span class="span-blue-cubepreloader"></span>
                        <span class="span-blue-cubepreloader"></span>
                    </div>
                </div>

                <?php

            }, [
                'type' => 'preloader',
                'title' => 'Blue cubes'
            ]);

            mirele_register_component("darkness_signature", function ($e=null) {

                ?>

                <div class="mirele-preloader mirele-preloader-background-dark">

                    <h1>Please wait ..</h1>

                    <?php if (get_option('mrl_wp_js_disabled_warning', false)): ?>
                        <noscript>
                            <br>
                            <small>This load will last forever since you turned off JavaScript support</small>
                        </noscript>
                    <?php endif; ?>

                </div>

                <?php

            }, [
                'type' => 'preloader',
                'title' => 'Darkness signature'
            ]);

            mirele_register_component("darkness", function ($e=null) {

                ?>

                <div class="mirele-preloader mirele-preloader-background-dark">

                    <img src="<?php echo MIRELE_SOURCE_DIR . '/img/loaders/standart.svg'; ?>" class='icon' width="26px">

                    <?php if (get_option('mrl_wp_js_disabled_warning', false)): ?>
                        <noscript>
                            <br>
                            <small>This load will last forever since you turned off JavaScript support</small>
                        </noscript>
                    <?php endif; ?>


                </div>

                <?php

            }, [
                'type' => 'preloader',
                'title' => 'Darkness  preloader'
            ]);

            mirele_register_component("blur", function ($e=null) {

                ?>

                <div class="mirele-preloader mirele-preloader-background-blur" data-animation-out="transparency-out">

                    <?php if (get_option('mrl_wp_js_disabled_warning', false)): ?>
                        <noscript>
                            <br>
                            <small>This load will last forever since you turned off JavaScript support</small>
                        </noscript>
                    <?php endif; ?>

                </div>

                <?php

            }, [
                'type' => 'preloader',
                'title' => 'Blur preloader'
            ]);

            mirele_register_component("blur_loader", function ($e=null) {

                ?>

                <div class="mirele-preloader mirele-preloader-background-blur" data-animation-out="transparency-out">
                    <img src="<?php echo MIRELE_SOURCE_DIR . '/img/loaders/standart.svg'; ?>" class='icon' width="26px">

                    <?php if (get_option('mrl_wp_js_disabled_warning', false)): ?>
                        <noscript>
                            <br>
                            <small>This load will last forever since you turned off JavaScript support</small>
                        </noscript>
                    <?php endif; ?>

                </div>

                <?php

            }, [
                'type' => 'preloader',
                'title' => 'Blur loader preloader'
            ]);

            mirele_register_component("white", function ($e=null) {

                ?>

                <div class="mirele-preloader mirele-white-placeholder" data-animation-out="none" data-animation-timeout="1400" style="background: white">

                    <?php if (get_option('mrl_wp_js_disabled_warning', false)): ?>
                        <noscript>
                            <br>
                            <small>This load will last forever since you turned off JavaScript support</small>
                        </noscript>
                    <?php endif; ?>

                </div>

                <?php

            }, [
                'type' => 'preloader',
                'title' => 'Simulation of waiting',
                'description' => 'With this preloader, your site will wait for the full loading of content and images, and after that it will appear abruptly completely loaded'
            ]);


            /**
             * Registration of all standard types of ** Woocommerce product card **
             *
             * @version 1.0.0
             * @author Mirele
             * @package Mirele
             */

            mirele_register_component('woo-product-card-theme-gray', function ($e=null) {

                global $bootstrap;

                ?>

                <div class="woo-product col-xs-12 col-sm-<?php echo $bootstrap->sm; ?> col-md-<?php echo $bootstrap->md; ?> col-lg-<?php echo $bootstrap->lg; ?>">
                    <div class="woo-product-cart woo-product-card-theme-gray">
                        <?php
                        if (is_callable($e)) {
                            call_user_func($e, array());
                        }; ?>
                    </div>
                </div>

                <?php


            }, [
                'type' => 'woo_product_cart_loop',
                'title' => 'Gray gradient'
            ]);

            mirele_register_component('woo-product-card-theme-white', function ($e=null) {

                global $bootstrap;

                ?>

                <div class="woo-product col-xs-12 col-sm-<?php echo $bootstrap->sm; ?> col-md-<?php echo $bootstrap->md; ?> col-lg-<?php echo $bootstrap->lg; ?>">
                    <div class="woo-product-cart woo-product-card-theme-white">
                        <?php
                        if (is_callable($e)) {
                            call_user_func($e, array());
                        }; ?>
                    </div>
                </div>

                <?php

            }, [
                'type' => 'woo_product_cart_loop',
                'title' => 'Minimalistic white'
            ]);

            mirele_register_component('woo-product-card-theme-full', function ($e=null) {

                global $bootstrap;
                global $product;

                global $loop_type;

                ?>

                <div class="woo-product col-xs-12 col-sm-<?php echo $bootstrap->sm; ?> col-md-<?php echo $bootstrap->md; ?> col-lg-<?php echo $bootstrap->lg; ?>">
                    <div>

                        <?php if ($loop_type == 'product'): ?>

                            <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="null-link">

                                <img src="<?php echo $product->get_image_id() ? wp_get_attachment_url($product->get_image_id()) : wc_placeholder_img_src(); ?>" class="woo-product-full-cart-loop" style="background-image: url('<?php echo wp_get_attachment_url($product->get_image_id()); ?>')">

                                <div class="woo-content-full">
                                    <div class="title"><?php echo $product->get_name(); ?></div>
                                    <div class="price"><?php echo get_woocommerce_currency_symbol() . ' ' . $product->get_price(); ?></div>
                                </div>

                            </a>

                        <?php endif; ?>

                    </div>
                </div>

                <?php

            }, [
                'type' => 'woo_product_cart_loop',
                'title' => 'No frames',
                'description' => 'Product card in the full width and height of the product. No frames.'
            ]);


            /**
             * Registration of all standard types of ** Modal Box of Cookies **
             *
             * @version 1.0.0
             * @author Mirele
             * @package Mirele
             */

            mirele_register_component_logic(['darkness', 'colorful'], function($e=null) {
                global $mrouter;
                $mrouter->register('site', 'css', get_template_directory_uri() . '/source/css/kit/cookies/kit-dist.css');
            }, [
                'type' => 'cookie_box'
            ]);

            mirele_register_component('darkness', function ($e=null) {

                ?>

                <div class="mrl-use-cookie-note-darkness" id="cookie_box" style="display: none">

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-1 hidden-xs">
                                <img src="<?php echo MIRELE_SOURCE_DIR . '/img/icons/cookies.png' ?>" alt="cookies">
                            </div>
                            <div class="col-sm-11 col-xs-12">
                                <small> <?php echo get_option('mrl_wp_cookie_box_text', "This website uses cookies.") ?> <br>
                                    <?php echo get_option('mrl_wp_cookie_box_text', "A cookie is a small text file that the website you are visiting stores on your computer. Cookies are used by a lot of websites to give visitors access to various functions. It is possible to use the information in the cookie to follow the user’s surfing.<br>
                                    To avoid cookies, you can change the security settings in your web browser. How these are adjusted depends on which web browser you have. <br>
                                    On this website we use cookies to enable you as a visitor to adapt the appearance of the website. <br>
                                    The majority are the so called “session cookies”. They will be automatically deleted after the visit on the website. Cookies do not cause any harm to your computer and do not contain viruses.") ?>
                                </small>

                                <div>
                                    <a href="javascript:;" id="allow_use_cookie" >Accept</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <?php

            }, [
                'type' => 'cookie_box',
                'title' => 'Darkness'
            ]);

            mirele_register_component('colorful', function ($e=null) {

                ?>

                <div class="mrl-use-cookie-note-colorful" id="cookie_box" style="display: none">

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                    <?php echo get_option('mrl_wp_cookie_box_text', "A cookie is a small text file that the website you are visiting stores on your computer. Cookies are used by a lot of websites to give visitors access to various functions. It is possible to use the information in the cookie to follow the user’s surfing.<br>
                                    To avoid cookies, you can change the security settings in your web browser. How these are adjusted depends on which web browser you have. <br>
                                    On this website we use cookies to enable you as a visitor to adapt the appearance of the website. <br>
                                    The majority are the so called “session cookies”. They will be automatically deleted after the visit on the website. Cookies do not cause any harm to your computer and do not contain viruses.") ?>
                                </small>

                                <div>
                                    <a href="javascript:;" id="allow_use_cookie" >Accept</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <?php

            }, [
                'type' => 'cookie_box',
                'title' => 'Colorful'
            ]);


            /**
             * Registration of all standard types of ** Modal Box of JavaScript **
             *
             * @version 1.0.0
             * @author Mirele
             * @package Mirele
             */

            mirele_register_component('standart', function ($e=null) {

                ?>

                <noscript>
                    <div class="mrl-no-js-note">
                        <div class="container">
                            You have disabled JavaScript! Please enable it in your browser settings. <br>
                            <small>Without JavaScript, some elements on the site may not work for you.</small>
                        </div>
                    </div>

                    <style>
                        .mrl-use-cookie-note {
                            display: none !important;
                        }
                    </style>
                </noscript>

                <?php

            }, [
                'type' => 'no_js_box',
                'title' => 'Darkness'
            ]);

        }

        function apps () {

            global $mapps;
            global $mrouter;

            if (get_option('mrli_hs_ajax_table', false)) {
                MPager::ui_part ('mui_hubspot_contacts', function () {

                    ?>

                    <div class="root">

                        <h3>Contacts list</h3>

                        <table class="wp-list-table widefat fixed striped posts">
                            <thead>
                            <tr>
                                <th>VID</th>
                                <th>Added at</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Is Contact</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach (MIHubSpot::contacts(get_option('mrltkn_hs', false), 10)->contacts as $list): ?>
                                <tr>
                                    <th><b> <?php echo $list->vid; ?> </b></th>
                                    <th> <?php echo date("Y/m/d H:i:s", $list->properties->lastmodifieddate->value / 1000); ?> </th>
                                    <th> <?php echo isset($list->properties->lastname->value) ? $list->properties->lastname->value : 'None'; ?> </th>
                                    <th> <?php echo isset($list->properties->firstname->value) ? $list->properties->firstname->value : 'None'; ?> </th>
                                    <th> <?php echo ((array)$list)['is-contact'] == 1 ? 'Yes' : 'No' ?> </th>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>

                    <?php

                });
                MPager::ui_part ('mui_hubspot_forms', function () {

                    ?>

                    <div class="root">

                        <h3>Forms</h3>

                        <table class="wp-list-table widefat fixed striped posts">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Form Type</th>
                                <th>The form is published</th>
                                <th>Version</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach (MIHubSpot::forms(get_option('mrltkn_hs', false), 10) as $list): ?>
                                <tr>
                                    <th><b> <?php echo $list->guid; ?> </b></th>
                                    <th> <?php echo $list->name; ?> </th>
                                    <th> <?php echo $list->formType; ?> </th>
                                    <th> <?php echo $list->isPublished == 1 ? 'Yes' : 'No'; ?> </th>
                                    <th> <?php echo $list->editVersion; ?> </th>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>

                    <?php

                });
                MPager::ui_part ('mui_hubspot_tickets', function () {

                    ?>

                    <div class="root">

                        <h3>Tickets</h3>

                        <table class="wp-list-table widefat fixed striped posts">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created At</th>
                                <th>Title</th>
                                <th>Content</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach (MIHubSpot::tickets(get_option('mrltkn_hs', false))->objects as $list): ?>
                                <tr>
                                    <th><b> <?php echo $list->objectId; ?> </b></th>
                                    <th> <?php echo date("Y/m/d H:i:s", $list->properties->subject->timestamp / 1000); ?> </th>
                                    <th> <?php echo isset($list->properties->subject->value) ? mb_strimwidth($list->properties->subject->value, 0, 128, "...") : 'None'; ?> </th>
                                    <th> <?php echo isset($list->properties->content->value) ? mb_strimwidth($list->properties->content->value, 0, 128, "...") : 'None'; ?> </th>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>

                    <?php

                });
            }

            $mrouter->register("app_kristen_gallery", 'css', MIRELE_SOURCE_DIR . '/css/admin/kristen.css');
            $mrouter->register("app_kristen_gallery", 'js', MIRELE_SOURCE_DIR . '/js/admin/kristen.js');

            $mapps->register('kristen_gallery', function ($e=null) {

                wp_enqueue_media ();

                add_action('wp_ajax_kristen_setup', function () {

                    ob_start();
                    $grid = json_decode(base64_decode($_POST['grid']));
                    wp_send_json(array(
                        'status' => update_option('kristen_gallery_grid', $grid)
                    ));

                });

                ?>

                <h1> Gallery </h1>
                <small>simple, small, nimble gallery</small>

                <div class='gallery_body'>
                    <div class="column" column="1">

                        <button data-action="photo" class="add">Select media file</button>

                    </div>

                    <div class="column" column="2">

                        <button data-action="photo" class="add">Select media file</button>

                    </div>

                    <div class="column" column="3">

                        <button data-action="photo" class="add">Select media file</button>

                    </div>
                </div>

                <?php

            }, array(
                'title' => 'Kristen Gallery',
                'description' => 'Kristen Gallery Application - widescreen galleries for your website',
                'version' => '1.1.0',
                'author' => 'iRTEX',
                'picture' => MIRELE_SOURCE_DIR . '/img/apps/kristen_icon.png'
            ));

            $mapps->register('hubspot', function ($e=null) {

                settings_fields('mirele_web_integrate');

                /**
                 * Checking the initial user actions
                 * that could have been sent via a POST request
                 */

                if ($_POST) {
                    if ($_POST['action'] == 'Log out of this account') {
                        delete_option ('mrltkn_hs');
                        die();
                    }
                }

                MPager::ui_tabs(array(
                    [
                        'content' => 'Home',
                        'id' => 'main'
                    ],
                    [
                        'content' => 'Settings',
                        'id' => 'settings'
                    ]
                ));
                
                if (get_option('mrltkn_hs', false)) {

                    if (MPager::ui_current_tab()->id == 'main') {
                        do_action('ui_mirele_integration_hubspot');
                    } elseif (MPager::ui_current_tab()->id == 'settings') {
                        do_action('ui_mirele_integration_hubspot_settings');
                    }

                } else {
                    do_action('ui_mirele_integration_hubspot_login');
                }



            }, array(
                'title' => 'HubSpot',
                'description' => 'Kristen Gallery Application - widescreen galleries for your website',
                'version' => '1.0.0',
                'author' => 'iRTEX',
                'picture' => MIRELE_SOURCE_DIR . '/img/apps/hubspot_icon.png'
            ));

            $mapps->register('mailchimp', function ($e=null) {

                settings_fields('mirele_web_integrate');

                MPager::ui_tabs(array(
                    [
                        'content' => 'Home',
                        'id' => 'main'
                    ],
                    [
                        'content' => 'Settings',
                        'id' => 'settings'
                    ]
                ));

                if (get_option('mrltkn_mc', false)) {
                    if (MPager::ui_current_tab()->id == 'main') {
                        do_action('ui_mirele_mailchimp_main');
                    } elseif (MPager::ui_current_tab()->id == 'settings') {
                        do_action('ui_mirele_mailchimp_settings');
                    }
                } else {
                    do_action('ui_mirele_mailchimp_login');
                }


            }, array(
                'title' => 'MailChimp',
                'description' => 'Kristen Gallery Application - widescreen galleries for your website',
                'version' => '1.0.0',
                'author' => 'iRTEX',
                'picture' => MIRELE_SOURCE_DIR . '/img/apps/mailchimp_icon.jpg'
            ));

            $mapps->register('robotstxt', function ($e=null) {

                /**
                 * Checking the initial user actions
                 * that could have been sent via a POST request
                 */

                if ($_POST) {

                    if ($_POST['action_'] == "default_") {
                        die(setup_robotstxt ('default'));
                    } elseif ($_POST['action_'] == "google_") {
                        die(setup_robotstxt ('google'));
                    }

                }

                MPager::ui_tabs(array(
                    [
                        'content' => 'Home',
                        'id' => 'main'
                    ]
                ));

                if (MPager::ui_current_tab()->id == 'main') {
                    do_action('ui_mirele_app_robotstxt');
                }


            }, array(
                'title' => 'Robots.txt',
                'description' => 'Need to create a Robots.txt file? Yes Easy! Create optimal Robots.txt files for your site and allow search engines to better understand your site',
                'version' => '1.0.0',
                'author' => 'iRTEX',
                'picture' => MIRELE_SOURCE_DIR . '/img/apps/robottxt_icon.png'
            ));

        }

        function widgets () {

            /**
             * MailChimp widget
             */

            add_action('widgets_init', function () {

                class mirele_widget_mailchimp extends WP_Widget {

                    function __construct() {
                        parent::__construct(
                            'mirele_widget_mailchimp',
                            __('Mirele MailChimp Footer', 'mirele_widget_mailchimp_domain'),
                            array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'mirele_widget_mailchimp_domain' ), )
                        );
                    }

                    public function widget( $args, $instance ) {
                        $title = apply_filters( 'widget_title', $instance['title'] );
                        echo $args['before_widget'];
                        if ( ! empty( $title ) )
                            echo $args['before_title'] . $title . $args['after_title'];

                        echo __( 'Hello, World!', 'mirele_widget_mailchimp_domain' );
                        echo $args['after_widget'];
                    }

                    public function form( $instance ) {
                        if ( isset( $instance[ 'title' ] ) ) {
                            $title = $instance[ 'title' ];
                        }
                        else {
                            $title = __( 'New title', 'mirele_widget_mailchimp_domain' );
                        }

                        ?>


                        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />


                        <?php
                    }

                    public function update( $new_instance, $old_instance ) {
                        $instance = array();
                        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
                        return $instance;
                    }

                }

                register_widget('mirele_widget_mailchimp');

            });

        }

        function demos () {

            rosemary_register_demo('default', array (
                'blocks' => array (
                        ''
                ),
                'plugins' => array ()
            ), array ());

        }

        demos ();
        components ();
        apps();
        widgets();

    });

});

