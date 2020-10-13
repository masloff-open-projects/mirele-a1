<?php

use Mirele\Compound\Patterns;
use Mirele\Router;

Router::post('/wp-admin/admin.php', function () {
    if (
        isset((MIRELE_POST)['method']) and
        (MIRELE_POST)['method'] === 'Compound/createPage' and
        isset((MIRELE_GET)['page']) and
        (MIRELE_GET)['page'] === 'сompound_render_editor'
    ) {

        # Create a work environment
        $name = (MIRELE_POST)['name'];
        $nonce = (MIRELE_POST)['nonce'];

        # Security check and anti-spam requests
        if (wp_verify_nonce($nonce, MIRELE_NONCE)) {

            # If user login in and have permission
            if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['create'])) {

                $pattern = new Patterns\createPage();
                $pattern->name = $name;
                $pattern();

            }

        }

    }
});