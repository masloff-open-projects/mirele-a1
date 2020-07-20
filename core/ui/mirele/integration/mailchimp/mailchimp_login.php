<?php

/**
 * MailChimp login page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_mailchimp_login', function () {

    ?>

    <div class="wrap">
        <div class="root">

            <div class="integrate-body">

                <img src="<?php echo PATH_INTEGRATION_MC_IMG; ?>" width="120px" class="app-icon">

                <h1 class="app-title">MailChimp integration</h1>

                <form method="post" enctype="multipart/form-data" action="options.php" id="app_mailchimp_auth">

                    <?php echo settings_fields('mirele_web_integrate_mc'); ?>

                    <input type="text" name="mrltkn_mc" placeholder="Token">

                    <input type="submit" value="Login to account" class="button-primary">

                </form>

            </div>

        </div>
    </div>

    <?php

});
