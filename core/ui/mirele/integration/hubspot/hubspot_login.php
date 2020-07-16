<?php

/**
 * HubSpot login page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_integration_hubspot_login', function () {

    ?>

    <div class="wrap">
        <div class="root">

            <div class="integrate-body">

                <img src="<?php echo PATH_INTEGRATION_HS_IMG; ?>" width="120px" class="app-icon">

                <h1 class="app-title">HubSpot integration</h1>

                <form method="post" enctype="multipart/form-data" action="options.php" id="app_hubspot_auth">

                    <?php echo settings_fields('mirele_web_integrate_hs'); ?>

                    <input type="text" name="mrltkn_hs" placeholder="hapi key">

                    <input type="submit" value="Login to account" class="button-primary">

                </form>

                <a href="https://knowledge.hubspot.com/integrations/how-do-i-get-my-hubspot-api-key">How to get it</a>

            </div>

        </div>
    </div>

    <?php

});

