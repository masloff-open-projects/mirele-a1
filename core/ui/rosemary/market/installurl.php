<?php

add_action ('mirele_ui_market_manager_install_from_url', function ($e=null) {

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
                <p class="install-help">If you have a direct link to the block you want to install, paste it here</p>

                <form onsubmit="return false;" method="post" enctype="multipart/form-data" class="wp-upload-form" action="<?php echo MIRELE_URL ?>">
                    <input type="text" id="themeurl" name="themeurl" style="width: -webkit-fill-available;" placeholder="URL">
                    <button type="submit" class="button" onclick="$(this).attr('data-url', $('#themeurl').val()); $(this).attr('data-action', 'rosemary_install_market'); $(document.body).trigger('form-ajax-load'); $(this).click();" > Install Now </button>
                </form>

            </div>

        </div>
    </div>

    <?php

});

