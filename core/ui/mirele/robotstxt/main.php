<?php

/**
 * Robots TXT app page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action('ui_mirele_app_robotstxt', function() {

    ?>

    <div class="wrap">

        <div class="wp-mrl-column-1">

            <hr class="wp-header-end">
            <br>

            <div>
                <form action="options.php" method="post" data-form-ajax-settings="true" class="inline-form">
                    <?php settings_fields('mirele_site'); ?>
                    <input type="hidden" value="default_" class="button" name="action_">
                    <input type="submit" value="Generate and save default robots.tx file" class="button" name="action">
                </form>

                <form action="options.php" method="post" data-form-ajax-settings="true" class="inline-form">
                    <?php settings_fields('mirele_site'); ?>
                    <input type="hidden" value="google_" class="button" name="action_">
                    <input type="submit" value="Generate and save robots.tx file for Google" class="button" name="action">
                </form>
            </div>

            <hr>

            <form action="options.php" method="post" data-form-ajax-settings="true">

                <?php settings_fields('mirele_site'); ?>

                <textarea name="mirele_robotstxt" width="100%" height="100%" style="width: 100%; height: 700px"><?php echo get_option('mirele_robotstxt'); ?></textarea>

                <hr>

                <div>
                    <input type="submit" value="Save" class="button-primary" name="action">
                </div>

            </form>

        </div>

        <div class="wp-mrl-column-2">

            <div class="wp-mrl-box">
                <div class="inner">

                    <h2>Welcome to RobotsTXT!</h2>

                    <p>Create a file to index your site in 1 minute</p>
                    <p>Select one of the types of Robots files prepared in advance for your site:</p>

                    <h3>Resources</h3>
                    <ul>
                        <li>
                            <a href="https://irtex-web.github.io" target="_blank">
                                <i aria-hidden="true" class="dashicons dashicons-external"></i> Documentation
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>


    </div>

    <?php

});