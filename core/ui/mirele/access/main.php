<?php

/**
 * No-access page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_no_access', function () {

    ?>

    <div class="wrap">
        <div class="root">

            <h1>The page is inaccessible</h1>
            <p>You are not allowed to visit this page for security reasons</p>

        </div>
    </div>

    <?php

});