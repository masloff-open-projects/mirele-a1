<?php

/**
 * Apps home page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_apps', function () {

    global $mapps;

    if (isset($_GET['app']) and !empty($_GET['app'])) {
        do_action('mirele_ui_app', $_GET['app']);
    } else {
        ?>

        <div class="wrap">
            <div class="root">

                <h1 class="wp-heading-inline">Welcome to Mirele apps</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus eveniet expedita explicabo facilis fugit, impedit, incidunt ipsam magni maxime mollitia nam nemo neque officia quam quia sit soluta totam vero.</p>

                <hr class="wp-header-end">

                <div id="the-list"> <?php
                    foreach ($mapps->all() as $app) {
                        do_action('mirele_ui_apps_template_app', $app);
                    }
                    ?> </div>

            </div>
        </div>

        <?php
    }

});