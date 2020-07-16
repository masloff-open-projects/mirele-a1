<?php

add_action ('ui_mirele_settings_theme', function () {

    ?>

    <div class="wrap wp-wrap-tabs">
        <table class="vertical-mirele-table-tabs" width="100%" height="80%" border="0" cellspacing="0" cellpadding="0">

            <thead>
                <tr>
                    <td colspan="3">
                        <span>
                            Mirele Theme Settings
                        </span>
                    </td>
                </tr>
            </thead>

            <tbody>
            <tr>
                <td valign="top" class="tabs">

                    <ul>
                        <li><a href="javascript:;" class="tab" data-open-tab="main" data-open-sidebar="">Main</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="seo" data-open-sidebar="seo">SEO</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="preloader" data-open-sidebar="">Preloader</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="navbar" data-open-sidebar="">Navbar</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="sidebar" data-open-sidebar="">Sidebar</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="footer" data-open-sidebar="">Footer</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="fonts" data-open-sidebar="font">Fonts</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="cookies_allow" data-open-sidebar="">Cookie Permission Dialog</a></li>
                        <li><a href="javascript:;" class="tab" data-open-tab="no_js_box" data-open-sidebar="">Javascript Permission Dialog</a></li>


                        <li><span class="dashicons dashicons-arrow-down"></span><a href="javascript:;" class="tab" data-open-tab="woo" data-ul-open-submenu="woocommerce" data-open-sidebar="">WooCommerce</a></li>

                        <ul data-ul-submenu="woocommerce" class="subtab">

                            <li><a href="javascript:;" class="tab" data-open-tab="woo_product_loop" data-open-sidebar="">Product card (loop)</a></li>
                            <li><a href="javascript:;" class="tab" data-open-tab="woo_fastcart" data-open-sidebar="">FastCart</a></li>
                            <li><a href="javascript:;" class="tab" data-open-tab="woo_quickcart" data-open-sidebar="">QuickCart</a></li>

                            <li><a href="javascript:;" class="tab" data-open-tab="woo_product" data-open-sidebar="">Product Page</a></li>
                            <li><a href="javascript:;" class="tab" data-open-tab="woo_products" data-open-sidebar="">Products list Page</a></li>
                            <li><a href="javascript:;" class="tab" data-open-tab="woo_cart" data-open-sidebar="">Cart Page</a></li>
                            <li><a href="javascript:;" class="tab" data-open-tab="woo_account" data-open-sidebar="">Account Page</a></li>

                        </ul>

                    </ul>
                </td>

                <td valign="top" class="content">

                    <div data-tab="welcome">

                        <div class="inner-center-box">
                            <h1>Build your version of the site</h1>
                            <p>
                                To your left are menu items. Select the desired item and adjust the necessary settings to make your site even more perfect!
                            </p>
                        </div>

                        <img src="<?php echo MIRELE_SOURCE_DIR . '/img/forms/settings.jpg'; ?>" class="welcome-image">
                        
                    </div>

                    <div data-tab="main">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_main', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="seo">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_seo', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="preloader">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_placeholder', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="navbar">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_navbar', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="sidebar">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_sidebar', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="footer">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_footer', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="fonts">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_fonts', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="cookies_allow">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_cookies_allow', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="no_js_box">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme_no_js_box', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="tas">
                        <?php MPager::ui_settings ('mirele_wp_edit', 'theme', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woocommerce', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo_product_loop">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woo_product_loop', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo_fastcart">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woo_fastcart', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo_quickcart">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woo_quickcart', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo_products">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woo_products', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo_product">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woo_product', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo_cart">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woo_cart', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                    <div data-tab="woo_account">
                        <?php MPager::ui_settings ('mirele_woo_edit', 'theme_woo_account', 'method="post" enctype="multipart/form-data" action="" data-form-ajax-settings'); ?>
                    </div>

                </td>

                <td valign="top" class="sidebar" width="240px">
                    <div data-sidebar="seo">

                        <label>Hover and wait</label>
                        <p>Below are tips for filling out WooCoommerce variables and WordPress SEO meta information. If you want to insert a var. and not stop typing, click on the field where you want to add a hint, hover over a specific hint and wait 2 seconds. Wowla - variable added to text</p>

                        <h5>WooCommerce</h5>
                        <div id="woocommerce-sidebar">
                            <p>
                                <a href="javascript:return false;" data-content="{product-name}" data-insert-element=':focus' data-hint="1s">{product-name}</a>
                                - Title of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-slug}" data-insert-element=':focus' data-hint="1s">{product-slug}</a>
                                - Slug of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-sku}" data-insert-element=':focus' data-hint="1s">{product-sku}</a>
                                - Sku of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-price}" data-insert-element=':focus' data-hint="1s">{product-price}</a>
                                - Price of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-regular-price}" data-insert-element=':focus' data-hint="1s">{product-regular-price}</a>
                                - Regular price of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-sale-price}" data-insert-element=':focus' data-hint="1s">{product-sale-price}</a>
                                - Sale price of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-total-sales}" data-insert-element=':focus' data-hint="1s">{product-total-sales}</a>
                                - Total product sales
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-stock-quantity}" data-insert-element=':focus' data-hint="1s">{product-stock-quantity}</a>
                                - Stock quantity of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-stock-status}" data-insert-element=':focus' data-hint="1s">{product-stock-status}</a>
                                - Stock status of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-backorders}" data-insert-element=':focus' data-hint="1s">{product-backorders}</a>
                                - Backorders of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-purchase-note}" data-insert-element=':focus' data-hint="1s">{product-purchase-note}</a>
                                - Purchase note of product
                            </p>

                            <p>
                                <a href="javascript:return false;" data-content="{product-review-count}" data-insert-element=':focus' data-hint="1s">{product-review-count}</a>
                                - Review count of product
                            </p>
                        </div>

                    </div>

                    <div data-sidebar="font">

                        <label>Attention</label>
                        <p>Experiment with fonts very carefully. Use font compatibility helper tables. The default font is Roboto.</p>

                    </div>

                </td>

            </tr>

            </tbody>
        </table>
    </div>

    <?php

});
