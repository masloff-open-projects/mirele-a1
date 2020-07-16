<?php

/**
 * HubSpot settings page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_integration_hubspot_settings', function () {

    ?>

    <div class="wrap">
        <div class="root">

            <form method="post" enctype="multipart/form-data" action="options.php">

                <?php echo settings_fields('mirele_web_integrate_hs_data'); ?>

                <h3>General</h3>

                <div>
                    <p>
                        <input type="checkbox" name="mrli_hs_cache"
                            <?php echo get_option('mrli_hs_cache', false) ? 'checked' : '' ?>>
                        <label>Cache HubSpot Data</label>
                    </p>
                    <small>
                        Attention! Some data, such as the owners list, is cached anyway,<br>
                        as it is requested too often. When caching is enabled, forms on the<br>
                        site will be updated with a delay
                    </small>
                </div>

                <div>
                    <p>
                        <input type="checkbox" name="mrli_hs_ajax_table"
                            <?php echo get_option('mrli_hs_ajax_table', false) ? 'checked' : '' ?>>
                        <label>Use AJAX for load tables</label>
                    </p>
                </div>

                <h3>WooCommerce Integration Settings</h3>

                <div>
                    <p>
                        <input type="checkbox" name="mrli_hs_wc_deals"
                            <?php echo get_option('mrli_hs_wc_deals', true) ? 'checked' : '' ?>>
                        <label>Save WooCommerce Transactions in CRM</label>
                    </p>
                </div>

                <div>
                    <p>
                        <input type="checkbox" name="mrli_hs_wc_deals_create_products"
                            <?php echo get_option('mrli_hs_wc_deals_create_products', false) ? 'checked' : '' ?>>
                        <label>Create products for an order</label>
                    </p>
                    <small>
                        When creating an order (specifically when creating a new order), products that
                        match the products in the order will be created in HubSpot. <br>
                        If this function is disabled, the list of products will be passed to the order
                        description
                    </small>
                </div>

                <div>
                    <p>
                        <input type="checkbox" name="mrli_hs_wc_register_in_crm"
                            <?php echo get_option('mrli_hs_wc_register_in_crm', false) ? 'checked' : '' ?>>
                        <label>Save new site users to CRM</label>
                    </p>
                    <small>
                        If this option is enabled, all users who create an account on <br>
                        the site will automatically enter CRM as a contact
                    </small>
                </div>

                <input type="submit" value="Save" class="button-primary">

            </form>

        </div>
    </div>

    <?php

});
