<?php


/**
 * MailChimp main page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_mailchimp_main', function () {

    ?>

    <div class="wrap">

        <div class="wp-mrl-column-1">

            <hr class="wp-header-end">

            <div class="root">

                <table class="wp-list-table widefat fixed striped posts">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>WebID</th>
                        <th>Name</th>
                        <th>Date created</th>
                        <th>Subscribers</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach (MIMailChimp::lists(get_option('mrltkn_mc'))->lists as $list): ?>
                        <tr>
                            <th>
                                <b> <?php echo $list->id; ?> </b>
                            </th>
                            <th> <?php echo $list->web_id; ?> </th>
                            <th> <?php echo $list->name; ?> </th>
                            <th> <?php echo date_format(date_create($list->date_created), "Y/m/d H:i:s"); ?> </th>
                            <th> <?php echo $list->stats->member_count ?> </th>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>

        <div class="wp-mrl-column-2">

            <div class="wp-mrl-box">
                <div class="inner">

                    <h2>Welcome to MailChimp!</h2>

                    <p>You are in the administrative integration control panel.</p>
                    <p>Here you can configure the application and get the necessary statistics.</p>
                    <p>Integration manuals you can find in the knowledge base</p>

                    <h3>Resources</h3>
                    <ul>
                        <li>
                            <a href="https://irtex-web.github.io" target="_blank">
                                <i aria-hidden="true" class="dashicons dashicons-external"></i> Documentation
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="footer">
                    Thanks for choosing Mirele's MailChimp solution.
                </div>
            </div>

        </div>

    </div>

    <?php

});
