<?php

add_action ('mirele_ui_market_manager_install_from_zip', function ($e=null) {

    global $error_upload;

    ?>

    <div class="wrap">

        <?php if (!empty($error_upload)): ?>

            <div class="notice notice-warning">
                <p><?php echo $error_upload; ?></p>
            </div>

        <?php endif; ?>

        <div class="root">

            <div class="upload-theme" style="display: block">
                <p class="install-help">If you have a .zip file of Mirele blocks, open it using the form below.</p>

                <form method="post" enctype="multipart/form-data" class="wp-upload-form">
                    <input type="file" id="themezip" name="themezip">
                    <input type="submit" name="install-theme-submit" id="install-theme-submit" class="button" value="Install Now" disabled="">
                </form>

            </div>

        </div>
    </div>

    <?php

});

