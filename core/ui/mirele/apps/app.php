<?php

/**
 * Apps = page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('mirele_ui_app', function ($e=null) {

    if ($e != false and $e != null) {

        global $mapps;

        ?>

        <div class="wrap">
            <div class="root">
                <?php

                if ($mapps->app_exists($e)) {
                    if (!$mapps->app($e)) {
                        echo "app `$e` is not executable";
                    }
                } else {
                    echo 'app not found';
                }

                ?>
            </div>
        </div>

        <?php

    }

});