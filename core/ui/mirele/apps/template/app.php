<?php
add_action ('mirele_ui_apps_template_app', function ($app=null) {

    ?>

    <div class="plugin-card">
        <div class="plugin-card-top">
            <div class="name column-name">
                <h3>
                    <span class="thickbox">
                    <?php echo isset($app->meta->title) ? $app->meta->title : 'Unknown app'?>
                    <img src="<?php echo isset($app->meta->picture) ? $app->meta->picture : (function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src() : '') ?>" class="plugin-icon icon-for-search-block-repo" loading="lazy">
                    </span>
                </h3>
            </div>
            <div class="action-links">
                <ul class="plugin-action-buttons">
                    <li>
                        <a class="install-now button aria-button-if-js" href="<?php echo MIRELE_URL . '?page=' . $_GET['page'] . '&app=' . $app->app_id ?>" role="button">Open</a>
                    </li>
                </ul>
            </div>
            <div class="desc column-description">
                <p><?php echo isset($app->meta->description) ? $app->meta->description : 'No description'?></p>
                <p class="authors">
                    <cite>By
                        <span>
                            <a href="javascript:;"><?php echo isset($app->meta->author) ? $app->meta->author : 'free developer'?></a>
                        </span>
                    </cite>
                </p>
            </div>
        </div>
        <div class="plugin-card-bottom">
            <div class="column-updated">
                <strong>Version</strong>
                <?php echo isset($app->meta->version) ? $app->meta->version : 1?>
            </div>
        </div>
    </div>

    <?php
});